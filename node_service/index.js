// Import các thư viện và module cần thiết
const dotenv = require('dotenv');
const socketio = require('socket.io');
const redis = require('redis');
const tryParse = require('try-parse');
const http = require('http');
const socketioServer = require('socket.io');
const Bet = require('./bet');

// Đọc các biến môi trường
dotenv.config();

// Khởi tạo server
const httpServer = http.createServer();
const socketioPort = process.env.SOCKET_PORT || 8080;
const socketioServer = socketio(httpServer, {
    cors: {
        origin: '*',
    },
});

// Xử lý kết nối socket
socketioServer.on('connection', (socket) => {
    console.log('Kết nối socket mới:', socket.id);
});

// Lấy tỉ giá giao dịch
const tradeRate = await getTradeRate();

// Tạo đối tượng Bet
const bet = new Bet(socketioServer, tradeRate);

// Khởi động đối tượng Bet
bet.start();

// Kết nối với Redis
const redisClient = redis.createClient();
redisClient.on('message', (channel, data) => {
    const jsonData = tryParse(data);
    if (jsonData) {
        socketioServer.emit(channel, jsonData);
    }
});

// Khởi động server
httpServer.listen(socketioPort, () => {
    console.log(`Server đã khởi động trên cổng ${socketioPort}`);
});
