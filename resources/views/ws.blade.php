<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        #status { 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
            font-weight: bold;
        }
        .connecting { background: #ffc107; color: #000; }
        .connected { background: #4caf50; color: #fff; }
        .disconnected { background: #f44336; color: #fff; }
        .error { background: #ff5722; color: #fff; }
        #messages { margin-top: 20px; }
        #messages p { 
            padding: 8px; 
            background: #e3f2fd; 
            margin: 5px 0; 
            border-radius: 3px; 
        }
    </style>
</head>
<body>
<h2>WebSocket Test</h2>
<div id="status" class="connecting">Connecting...</div>
<div id="messages"></div>

<!-- Load Pusher client first -->
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<!-- Then Laravel Echo -->
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1/dist/echo.iife.js"></script>

<script>
  const statusEl = document.getElementById('status');
  
  function updateStatus(message, className) {
      statusEl.textContent = message;
      statusEl.className = className;
      console.log(message);
  }

  console.log('Starting WebSocket setup...');
  
  // Tell Echo which Pusher to use
  window.Pusher = Pusher;

  // Initialize Echo
  window.Echo = new Echo({
    broadcaster: 'reverb',
    key: 'local',
    wsHost: '127.0.0.1',
    wsPort: 8080,
    forceTLS: false,
    disableStats: true,
    enabledTransports: ['ws'],
  });

  // Get the underlying Pusher connection
  const pusher = window.Echo.connector.pusher;

  // Connection state handlers
  pusher.connection.bind('connecting', () => {
      updateStatus('Connecting to WebSocket...', 'connecting');
  });

  pusher.connection.bind('connected', () => {
      updateStatus('Connected to WebSocket!', 'connected');
  });

  pusher.connection.bind('unavailable', () => {
      updateStatus('WebSocket unavailable', 'error');
  });

  pusher.connection.bind('failed', () => {
      updateStatus('Connection failed', 'error');
  });

  pusher.connection.bind('disconnected', () => {
      updateStatus('Disconnected from WebSocket', 'disconnected');
  });

  pusher.connection.bind('error', (err) => {
      updateStatus('Connection error: ' + (err.error?.data?.message || 'Unknown error'), 'error');
      console.error('Connection error:', err);
  });

  // Subscribe to channel
  const channel = Echo.channel('chat');
  
  channel.subscribed(() => {
      console.log('✅ Successfully subscribed to chat channel');
  });

  channel.error((error) => {
      console.error('❌ Channel error:', error);
      updateStatus('Channel error: ' + error, 'error');
  });

  channel.listen('.TestMessage', (e) => {
      console.log("✅ Received message:", e);
      
      const p = document.createElement('p');
      p.textContent = e.message;
      document.getElementById('messages').appendChild(p);
  });

  console.log('WebSocket setup complete');
</script>
</body>
</html>
