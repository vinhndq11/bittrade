const socket = require("socket.io");
const redisClient = require("redis").createClient();
const { tryParse } = require("utils");
const httpServer = require("http").createServer();
const { Server } = require("socket.io");

const io = new Server(httpServer, {
    cors: {
        origin: "*",
        credentials: true,
    },
});

io.on("connection", (socket) => {
    const bet = new Bet(io, tryParse(process.env.PORT));
    bet.start();
});

const socketPort = parseInt(process.env.PORT || 8080);

httpServer.listen(socketPort, () => {
    console.log("Running on port", socketPort);
    redisClient.connect();
    redisClient.on("message", (channel, data) => {
        io.to(channel).emit("message", tryParse(data));
    });
});

class Bet {
    constructor(io, socketPort) {
        this.io = io;
        this.socketPort = socketPort;
    }

    start() {
        this.io.on("bet", (data) => {
            console.log("Received bet", data);
        });
    }
}
