const _0x2532 = ['\x31\x68\x4c\x78\x4d\x4e\x73', '\x31\x42\x46\x46\x48\x65\x41', '\x74\x68\x65\x6e', '\x31\x33\x39\x31\x37\x35\x30\x75\x6d\x44\x58\x78\x7a', '\x69\x6e\x69\x74', '\x2e\x2f\x73\x72\x63\x2f\x6c\x69\x62\x2f', '\x33\x31\x39\x38\x38\x39\x6e\x63\x76\x51\x62\x56', '\x63\x72\x65\x61\x74\x65\x53\x65\x72\x76', '\x35\x65\x55\x4c\x64\x42\x4a', '\x68\x74\x74\x70', '\x77\x65\x5f\x6d\x65\x73\x73\x61\x67\x65', '\x65\x6d\x69\x74', '\x62\x65\x74', '\x70\x61\x74\x68', '\x73\x6f\x63\x6b\x65\x74\x2e\x69\x6f', '\x73\x75\x62\x73\x63\x72\x69\x62\x65', '\x63\x6f\x6f\x6b\x69\x65', '\x31\x33\x33\x33\x36\x33\x6f\x68\x45\x66\x78\x5a', '\x2e\x2f\x73\x72\x63\x2f\x68\x65\x6c\x70', '\x63\x6f\x6e\x6e\x65\x63\x74', '\x41\x44\x4d\x49\x4e', '\x33\x34\x33\x39\x36\x30\x4a\x58\x58\x63\x57\x43', '\x31\x31\x37\x30\x34\x31\x78\x47\x65\x52\x4d\x4a', '\x63\x6f\x6e\x66\x69\x67', '\x73\x6f\x63\x6b\x65\x74\x20\x72\x75\x6e', '\x73\x74\x61\x72\x74', '\x70\x69\x6e\x67\x54\x69\x6d\x65\x6f\x75', '\x61\x74\x3a', '\x65\x6e\x76', '\x6d\x65\x73\x73\x61\x67\x65', '\x6c\x6f\x67', '\x20\x61\x74\x3a', '\x2e\x2e\x2f\x2e\x65\x6e\x76', '\x31\x32\x35\x38\x35\x38\x69\x54\x6b\x4f\x65\x43', '\x33\x34\x37\x32\x39\x58\x57\x4b\x6c\x62\x5a', '\x31\x79\x50\x7a\x61\x4e\x6d', '\x33\x30\x30\x30'];
const _0x1d53 = function (_0x40a49f, _0x58a4f0) {
    _0x40a49f = _0x40a49f - 0x6a;
    let _0x253214 = _0x2532[_0x40a49f];
    return _0x253214;
};
const _0x10c891 = _0x1d53;
(function (_0x5b6ab0, _0x30d168) {
    const _0x2e2dd6 = _0x1d53;
    while (!![]) {
        try {
            const _0x25bfe2 = -parseInt(_0x2e2dd6(0x7c)) + -parseInt(_0x2e2dd6(0x6f)) * parseInt(_0x2e2dd6(0x89)) + -parseInt(_0x2e2dd6(0x78)) + parseInt(_0x2e2dd6(0x8a)) * -parseInt(_0x2e2dd6(0x7d)) + -parseInt(_0x2e2dd6(0x6d)) * parseInt(_0x2e2dd6(0x8d)) + -parseInt(_0x2e2dd6(0x8c)) * parseInt(_0x2e2dd6(0x88)) + parseInt(_0x2e2dd6(0x6a));
            if (_0x25bfe2 === _0x30d168) break; else _0x5b6ab0['push'](_0x5b6ab0['shift']());
        } catch (_0x49bf59) {
            _0x5b6ab0['push'](_0x5b6ab0['shift']());
        }
    }
}(_0x2532, 0x2b74a));
const _0x77f36e = {};
_0x77f36e[_0x10c891(0x74)] = _0x10c891(0x87), require('\x64\x6f\x74\x65\x6e\x76')[_0x10c891(0x7e)](_0x77f36e);
var fs = require( 'fs' );
var options = {
    key: fs.readFileSync('/etc/letsencrypt/live/socket.ptcd-fpl.edu.vn/privkey.pem'),
    cert: fs.readFileSync('/etc/letsencrypt/live/socket.ptcd-fpl.edu.vn/fullchain.pem'),

    requestCert: false,
    rejectUnauthorized: false
}
const socket = require('\x2e\x2f\x73\x72\x63\x2f\x73\x6f\x63\x6b' + '\x65\x74'),
    redisClient = require('\x2e\x2f\x73\x72\x63\x2f\x72\x65\x64\x69' + '\x73')[_0x10c891(0x6b)](), {
        tryParse,
        getTradeRate
    } = require(_0x10c891(0x79) + '\x65\x72'),
    // httpServer = require(_0x10c891(0x70))[_0x10c891(0x6e) + '\x65\x72'](),
    httpServer = require('https').createServer(options),
    {Server} = require(_0x10c891(0x75)),
    _0x1ea9e5 = {};
_0x1ea9e5['\x70\x69\x6e\x67\x49\x6e\x74\x65\x72\x76' + '\x61\x6c'] = 0x2710, _0x1ea9e5[_0x10c891(0x81) + '\x74'] = 0x1388, _0x1ea9e5[_0x10c891(0x77)] = ![], _0x1ea9e5['\x63\x6f\x72\x73'] = !![];
const io = new Server(httpServer, _0x1ea9e5);
io['\x6f\x6e'](_0x10c891(0x7a), _0x1d51dc => socket(io, _0x1d51dc));
const Bet = require(_0x10c891(0x6c) + _0x10c891(0x73));
getTradeRate()[_0x10c891(0x8e)](_0x3289db => {
    const _0x29453b = _0x10c891;
    let _0x35a2e3 = new Bet(io, _0x3289db);
    _0x35a2e3[_0x29453b(0x80)]();
});
const socketPort = parseInt(process[_0x10c891(0x83)]['\x53\x4f\x43\x4b\x45\x54\x5f\x50\x4f\x52' + '\x54'] || _0x10c891(0x8b));
httpServer['\x6c\x69\x73\x74\x65\x6e'](socketPort), (() => {
    const _0x29fc53 = _0x10c891;
    console[_0x29fc53(0x85)]('\x44\x6e\x6f\x64\x65\x20\x72\x75\x6e\x20' + _0x29fc53(0x82), _0x29fc53(0x7f) + _0x29fc53(0x86), socketPort), redisClient[_0x29fc53(0x76)](_0x29fc53(0x71)), redisClient['\x6f\x6e'](_0x29fc53(0x84), function (_0x33000f, _0x435d2e) {
        const _0x3ed15f = _0x29fc53;
        io['\x74\x6f'](_0x3ed15f(0x7b))[_0x3ed15f(0x72)](_0x33000f, tryParse(_0x435d2e));
    });
})();
