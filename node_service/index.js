const http = require('http');
const socketio = require('socket.io');
const redis = require('redis');
const { tryParse, getTradeRate } = require('./src/helpers');
const { ADMIN } = require('./src/config');

const port = process.env.PORT || 3000;

const server = http.createServer();
const io = socketio(server);

const redisClient = redis.createClient();

io.on('connection', socket => {
    socket.on('we_message', data => {
        const { bet, get, path } = data;
        const subscribers = tryParse(data.subscribers);
        const cookie = tryParse(data.cookie);

        // Your logic here
    });

    socket.on('disconnect', () => {
        // Handle disconnect event
    });
});

server.listen(port, () => {
    console.log(`Server is running at: http://localhost:${port}`);
});
