const path = require('path');
const dotenv = require('dotenv');
const http = require('http');
const { Server } = require('socket.io');
const socket = require('./src/socket');
const redis = require('./src/redis');
const Bet = require('./src/lib/bet');
const { tryParse, getTradeRate } = require('./src/helper');

// Load environment variables from .env file
dotenv.config();

// Create HTTP server
const httpServer = http.createServer();

// Configure Socket.IO server
const io = new Server(httpServer, {
    pingInterval: 10000,
    pingTimeout: 5000,
    allowUpgrades: false,
    cors: true,
});

// Handle Socket.IO connection
io.on('connection', (socket) => {
    socket(socket, socket);
});

// Initialize Bet instance
getTradeRate().then((tradeRate) => {
    const bet = new Bet(io, tradeRate);
    bet.init();
});

// Start the server
const socketPort = parseInt(process.env.SOCKET_PORT || '3000');
httpServer.listen(socketPort, () => {
    console.log('Socket server is running at:', socketPort);
});

// Redis event handling
const redisClient = redis.createClient();
redisClient.on('message', (channel, message) => {
    io.to(channel).emit(channel, tryParse(message));
});
redisClient.subscribe('we_message');
