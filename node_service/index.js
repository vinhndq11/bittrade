const socket = require('./src/socket');
const redisClient = require('./src/redis');
const { tryParse, getTradeRate } = require('./src/helpers');
const httpServer = require('http').createServer;
const { Server } = require('socket.io');

const serverOptions = {
    pingInterval: 10000,
    pingTimeout: 5000,
    cors: false,
    cookie: true
};

const io = new Server(httpServer(), serverOptions);

io.on('connection', (socket) => {
    console.log('Connected:', socket.id);
    redisClient.on('message', function (channel, message) {
        io.to(socket.id).emit(channel, message);
    });
});

const socketPort = parseInt(process.env.SOCKET_PORT || '3000');

httpServer.listen(socketPort, () => {
    console.log('Server listening at port:', socketPort);
    redisClient.on('error', function (err) {
        console.error('Redis error:', err);
    });
});

getTradeRate().then((tradeRate) => {
    const betInstance = new Bet(io, tradeRate);
    betInstance.start();
});
