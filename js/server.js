// Create context using rabbit.js (cfr ZMQ),
// io and the subscriber socket.
var context = require('rabbit.js').createContext(),
    io = require('socket.io').listen(8080),
    sub = context.socket('SUB');

// Set correct encoding.
sub.setEncoding('utf8');

// Connect socket to updates exchange.
sub.connect('updates');

// A websocket is connected (eg: browser).
io.sockets.on('connection', function(socket) {

    // Register handler that hanles incoming data when the socket
    // detects new data on our queues.
    // When receiving data, it gets pushed to the connectec websocket.
    sub.on('data', function(data) {
        var message = JSON.parse(data);
        socket.emit(message.type, message.data);
    });
});
