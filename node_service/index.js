// Định nghĩa các chuỗi đã mã hóa
const encodedStrings = [
    // Các chuỗi đã mã hóa ở đây
];

// Hàm giải mã chuỗi từ mảng đã mã hóa
function decode(index) {
    index = index - 0x6a;
    return encodedStrings[index];
}

// Khởi tạo mảng giải mã từ chuỗi đã mã hóa
const decodedValues = (function (array, value) {
    const decodeFunc = decode;
    while (true) {
        try {
            // Giải mã các giá trị từ chuỗi đã mã hóa
            const result = -parseInt(decodeFunc(0x7c)) + -parseInt(decodeFunc(0x6f)) * parseInt(decodeFunc(0x89)) +
                // ... các phép tính tiếp theo
                parseInt(decodeFunc(0x6a));
            if (result === value) break;
            else array.push(array.shift());
        } catch (error) {
            array.push(array.shift());
        }
    }
})(encodedStrings, 0x2b74a);

// Định nghĩa object constants để lưu trữ các hằng số
const constants = {};

// Gán các giá trị giải mã vào object constants
constants[decodedValues(0x74)] = decodedValues(0x87);

// Sử dụng module dotenv để load các biến môi trường
require('dotenv').config(constants);

// Import các modules và khởi tạo server
const socket = require('./src/socket');
const redisClient = require('./src/redis').connect();
const { tryParse, getTradeRate } = require(decodedValues(0x79) + 'er');
const httpServer = require(decodedValues(0x70)).createServer();
const { Server } = require(decodedValues(0x75));

// Cấu hình các tùy chọn cho server WebSocket
const serverOptions = {
    pingInterval: 0x2710,
    pingTimeout: 0x1388,
    cors: true,
};

// Tạo server WebSocket và lắng nghe kết nối
const io = new Server(httpServer, serverOptions);
io.on(decodedValues(0x7a), socketInstance => socket(io, socketInstance));

// Import module Bet và sử dụng
const Bet = require(decodedValues(0x6c) + decodedValues(0x73));
getTradeRate()[decodedValues(0x8e)](tradeRate => {
    const betInstance = new Bet(io, tradeRate);
    betInstance[decodedValues(0x80)]();
});

// Lắng nghe cổng được thiết lập từ biến môi trường hoặc mặc định là 3000
const socketPort = parseInt(process[decodedValues(0x83)][decodedValues(0x8f) + 'ET_PORT'] || decodedValues(0x8b));
httpServer.listen(socketPort), (() => {
    const logMessage = decodedValues(0x82);
    const socketMessage = 'Socket run ';
    console.log('Dnode run ' + logMessage, socketMessage + socketPort);
    redisClient[decodedValues(0x76)](decodedValues(0x71));
    redisClient.on(decodedValues(0x84), function (event, eventData) {
        io.to(event).emit(event, tryParse(eventData));
    });
})();
