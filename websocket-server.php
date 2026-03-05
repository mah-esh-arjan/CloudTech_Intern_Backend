<?php
/**
 * Simple Raw WebSocket Server (No Dependencies)
 * Run with: php websocket-server.php
 * Connect from browser: ws://localhost:8081
 */

$host = '0.0.0.0';
$port = 8081;

// Create socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, $host, $port);
socket_listen($socket);

$clients = [];

echo "✅ WebSocket server running on ws://localhost:$port\n";
echo "Press Ctrl+C to stop\n\n";

while (true) {
    $changed = array_merge([$socket], $clients);
    $write = $except = null;
    
    socket_select($changed, $write, $except, 0, 10);
    
    // New connection
    if (in_array($socket, $changed)) {
        $newSocket = socket_accept($socket);
        $clients[] = $newSocket;
        
        $header = socket_read($newSocket, 1024);
        performHandshake($header, $newSocket, $host, $port);
        
        echo "🔗 New connection! Total clients: " . count($clients) . "\n";
        
        // Send welcome message
        $response = json_encode([
            'type' => 'connection',
            'message' => 'Connected to WebSocket server',
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        sendMessage($newSocket, $response);
        
        $key = array_search($socket, $changed);
        unset($changed[$key]);
    }
    
    // Handle messages from clients
    foreach ($changed as $changedSocket) {
        $buf = @socket_read($changedSocket, 1024, PHP_BINARY_READ);
        
        if ($buf === false || $buf === '') {
            // Client disconnected
            $key = array_search($changedSocket, $clients);
            unset($clients[$key]);
            socket_close($changedSocket);
            echo "❌ Client disconnected. Total clients: " . count($clients) . "\n";
            continue;
        }
        
        $message = unmask($buf);
        
        if ($message) {
            echo "📨 Received: $message\n";
            
            // Broadcast to all clients
            $response = json_encode([
                'type' => 'message',
                'message' => $message,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
            
            foreach ($clients as $client) {
                sendMessage($client, $response);
            }
        }
    }
}

socket_close($socket);

// WebSocket handshake
function performHandshake($headers, $socket, $host, $port) {
    $lines = preg_split("/\r\n/", $headers);
    $key = '';
    
    foreach ($lines as $line) {
        if (preg_match('/Sec-WebSocket-Key:\s(.*)$/i', $line, $match)) {
            $key = trim($match[1]);
        }
    }
    
    $acceptKey = base64_encode(pack('H*', sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
    
    $upgrade = "HTTP/1.1 101 Switching Protocols\r\n" .
               "Upgrade: websocket\r\n" .
               "Connection: Upgrade\r\n" .
               "Sec-WebSocket-Accept: $acceptKey\r\n\r\n";
    
    socket_write($socket, $upgrade, strlen($upgrade));
}

// Unmask incoming message
function unmask($text) {
    $length = ord($text[1]) & 127;
    
    if ($length == 126) {
        $masks = substr($text, 4, 4);
        $data = substr($text, 8);
    } elseif ($length == 127) {
        $masks = substr($text, 10, 4);
        $data = substr($text, 14);
    } else {
        $masks = substr($text, 2, 4);
        $data = substr($text, 6);
    }
    
    $text = '';
    for ($i = 0; $i < strlen($data); ++$i) {
        $text .= $data[$i] ^ $masks[$i % 4];
    }
    
    return $text;
}

// Send message to client
function sendMessage($client, $message) {
    $message = frame($message);
    @socket_write($client, $message, strlen($message));
}

// Frame message for WebSocket
function frame($message) {
    $length = strlen($message);
    $frame = chr(129); // Text frame
    
    if ($length <= 125) {
        $frame .= chr($length);
    } elseif ($length <= 65535) {
        $frame .= chr(126) . pack('n', $length);
    } else {
        $frame .= chr(127) . pack('J', $length);
    }
    
    return $frame . $message;
}
