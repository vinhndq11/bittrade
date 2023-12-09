const socket = require("socket.io");
const redisClient = require("redis").createClient();
const { tryParse } = require("utils");
const { Server } = require("socket.io");
const fs = require("fs");
const options = {
    key: fs.readFileSync("/etc/letsencrypt/live/socket.ptcd-fpl.edu.vn/privkey.pem"),
    cert: fs.readFileSync("/etc/letsencrypt/live/socket.ptcd-fpl.edu.vn/fullchain.pem")
};
const httpsServer = require("https").createServer(options);

const io = new Server(httpsServer, {
    cors: {
        origin: "*",
        credentials: true,
    },
});

io.on("connection", (socket) => {
    console.log(process.env.PORT);
    const bet = new Bet(io, tryParse(process.env.PORT));
    bet.start();
});

const socketPort = parseInt(process.env.PORT || 8080);

httpsServer.listen(socketPort, () => {
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
