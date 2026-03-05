<!DOCTYPE html>
<html>
<head>
    <title>Native WebSocket Test</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        #status { 
            padding: 15px; 
            margin: 20px 0; 
            border-radius: 5px; 
            font-weight: bold;
            text-align: center;
        }
        .connecting { background: #ffc107; color: #000; }
        .connected { background: #4caf50; color: #fff; }
        .disconnected { background: #f44336; color: #fff; }
        .error { background: #ff5722; color: #fff; }
        
        #controls {
            margin: 20px 0;
            display: flex;
            gap: 10px;
        }
        
        #messageInput {
            flex: 1;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        button {
            padding: 10px 20px;
            background: #2196f3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        
        button:hover { background: #1976d2; }
        button:disabled { 
            background: #ccc; 
            cursor: not-allowed; 
        }
        
        #messages { 
            margin-top: 20px;
            border: 2px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            max-height: 400px;
            overflow-y: auto;
            background: #f9f9f9;
        }
        
        .message { 
            padding: 10px; 
            background: #fff; 
            margin: 5px 0; 
            border-radius: 3px;
            border-left: 4px solid #2196f3;
        }
        
        .message-time {
            color: #666;
            font-size: 12px;
        }
        
        .system-message {
            border-left-color: #4caf50;
            background: #e8f5e9;
        }
        
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>🔌 Native WebSocket API Test</h1>
    
    <div class="info">
        <strong>Server:</strong> ws://localhost:8081<br>
        <strong>Instructions:</strong> Make sure to run <code>php websocket-server.php</code> first!
    </div>

    <div id="status" class="disconnected">Disconnected</div>

    <div id="controls">
        <input 
            type="text" 
            id="messageInput" 
            placeholder="Type a message..." 
            disabled
        />
        <button id="sendBtn" disabled>Send</button>
        <button id="connectBtn">Connect</button>
    </div>

    <h2>Messages (<span id="messageCount">0</span>)</h2>
    <div id="messages"></div>

    <script>
        let ws = null;
        let messageCount = 0;

        const statusEl = document.getElementById('status');
        const messagesEl = document.getElementById('messages');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const connectBtn = document.getElementById('connectBtn');
        const messageCountEl = document.getElementById('messageCount');

        function updateStatus(message, className) {
            statusEl.textContent = message;
            statusEl.className = className;
            console.log(message);
        }

        function addMessage(content, isSystem = false) {
            messageCount++;
            messageCountEl.textContent = messageCount;

            const messageDiv = document.createElement('div');
            messageDiv.className = 'message' + (isSystem ? ' system-message' : '');
            
            const time = new Date().toLocaleTimeString();
            messageDiv.innerHTML = `
                <div class="message-time">${time}</div>
                <div>${content}</div>
            `;
            
            messagesEl.appendChild(messageDiv);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }

        function connect() {
            if (ws && ws.readyState === WebSocket.OPEN) {
                console.log('Already connected');
                return;
            }

            updateStatus('Connecting...', 'connecting');
            
            // Create WebSocket connection
            ws = new WebSocket('ws://localhost:8081');

            // Connection opened
            ws.onopen = (event) => {
                console.log('✅ WebSocket connected!', event);
                updateStatus('✅ Connected to WebSocket', 'connected');
                addMessage('Connected to server', true);
                
                messageInput.disabled = false;
                sendBtn.disabled = false;
                connectBtn.textContent = 'Disconnect';
            };

            // Listen for messages
            ws.onmessage = (event) => {
                console.log('📨 Message received:', event.data);
                
                try {
                    const data = JSON.parse(event.data);
                    
                    if (data.type === 'connection') {
                        addMessage(`🔗 ${data.message}`, true);
                    } else if (data.type === 'message') {
                        addMessage(`💬 ${data.message}`);
                    } else {
                        addMessage(event.data);
                    }
                } catch (e) {
                    addMessage(event.data);
                }
            };

            // Connection closed
            ws.onclose = (event) => {
                console.log('❌ WebSocket closed', event);
                updateStatus('❌ Disconnected', 'disconnected');
                addMessage('Disconnected from server', true);
                
                messageInput.disabled = true;
                sendBtn.disabled = true;
                connectBtn.textContent = 'Connect';
                ws = null;
            };

            // Connection error
            ws.onerror = (error) => {
                console.error('❌ WebSocket error:', error);
                updateStatus('❌ Connection Error', 'error');
                addMessage('Connection error! Make sure the server is running.', true);
            };
        }

        function disconnect() {
            if (ws) {
                ws.close();
            }
        }

        function sendMessage() {
            const message = messageInput.value.trim();
            
            if (!message) {
                alert('Please enter a message');
                return;
            }

            if (!ws || ws.readyState !== WebSocket.OPEN) {
                alert('Not connected to WebSocket server');
                return;
            }

            console.log('📤 Sending:', message);
            ws.send(message);
            messageInput.value = '';
        }

        // Event listeners
        connectBtn.addEventListener('click', () => {
            if (ws && ws.readyState === WebSocket.OPEN) {
                disconnect();
            } else {
                connect();
            }
        });

        sendBtn.addEventListener('click', sendMessage);

        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Auto-connect on page load
        console.log('Page loaded. Click "Connect" to start.');
    </script>
</body>
</html>
