<!doctype html>
<html lang="vi" class="md-theme-default">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="theme-color" content="#F3F5F8">
    <meta name="msapplication-navbutton-color" content="#F3F5F8">
    <meta name="apple-mobile-web-app-status-bar-style" content="#F3F5F8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <base href="/">
    <title>{{ setting('seo_title') }}</title>
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="{{ assetVersion('images/banner_share.png') }}"/>
    <meta property="og:image:alt" content="{{ env('APP_NAME_SUMMARY') }}"/>
    <meta property="og:title" content="{{ setting('seo_title') }}"/>
    <meta property="og:description" content="{{ setting('seo_description') }}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:site_name" content="{{ setting('seo_title') }}"/>
    <meta name="keywords" content="{{ setting('seo_keywords') }}"/>
    <meta name="description" content="{{ setting('seo_description') }}"/>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@<?=env('APP_NAME_SUMMARY')?>">
    <meta name="twitter:creator" content="@<?=env('APP_NAME_SUMMARY')?>">
    <meta name="twitter:title" content="{{ setting('seo_title') }}">
    <meta name="twitter:description" content="{{ setting('seo_description') }}">
    <meta name="twitter:image" content="{{ asset('images/banner_share.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ assetVersion('images/favicon.png') }}">
    <link href="/we_files/bootstrap.min.css" rel="stylesheet">
    <link href="/we_files/winfonts.css" rel="stylesheet">
    <link rel="stylesheet" href="/we_files/swiper.min.css">
    <link rel="stylesheet" href="/we_files/all.min.css">
    <link rel="stylesheet" href="/we_files/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/we_files/helper.css">
    <link rel="stylesheet" href="/we_files/style.css">
    <link rel="stylesheet" href="/we_files/cryptocoins.css">
    <link rel="stylesheet" href="{{ assetVersion('we_files/global.css') }}">
    <link rel="stylesheet" href="/we_files/slick.css">
    <link rel="stylesheet" href="/we_files/slick-theme.css">
    <link href="/static/css/2.17d6f752.chunk.css" rel="stylesheet">
    <link href="/static/css/main.ea061a34.chunk.css" rel="stylesheet">
</head>
<body class="pace-done">
<noscript>You need to enable JavaScript to run this app 13234234345.</noscript>
<script !src="">
    console.log(1);
</script>
<div id="root">
    <div class="loader-container">
        <div class="loader"></div>
    </div>
</div>
<script>!function (e) {
        function r(r) {
            for (var n, i, a = r[0], c = r[1], f = r[2], s = 0, p = []; s < a.length; s++) i = a[s], Object.prototype.hasOwnProperty.call(o, i) && o[i] && p.push(o[i][0]), o[i] = 0;
            for (n in c) Object.prototype.hasOwnProperty.call(c, n) && (e[n] = c[n]);
            for (l && l(r); p.length;) p.shift()();
            return u.push.apply(u, f || []), t()
        }

        function t() {
            for (var e, r = 0; r < u.length; r++) {
                for (var t = u[r], n = !0, a = 1; a < t.length; a++) {
                    var c = t[a];
                    0 !== o[c] && (n = !1)
                }
                n && (u.splice(r--, 1), e = i(i.s = t[0]))
            }
            return e
        }

        var n = {}, o = {1: 0}, u = [];

        function i(r) {
            if (n[r]) return n[r].exports;
            var t = n[r] = {i: r, l: !1, exports: {}};
            return e[r].call(t.exports, t, t.exports, i), t.l = !0, t.exports
        }

        i.e = function (e) {
            var r = [], t = o[e];
            if (0 !== t) if (t) r.push(t[2]); else {
                var n = new Promise((function (r, n) {
                    t = o[e] = [r, n]
                }));
                r.push(t[2] = n);
                var u, a = document.createElement("script");
                a.charset = "utf-8", a.timeout = 120, i.nc && a.setAttribute("nonce", i.nc), a.src = function (e) {
                    return i.p + "static/js/" + ({}[e] || e) + "." + {3: "f2667638"}[e] + ".chunk.js"
                }(e);
                var c = new Error;
                u = function (r) {
                    a.onerror = a.onload = null, clearTimeout(f);
                    var t = o[e];
                    if (0 !== t) {
                        if (t) {
                            var n = r && ("load" === r.type ? "missing" : r.type), u = r && r.target && r.target.src;
                            c.message = "Loading chunk " + e + " failed.\n(" + n + ": " + u + ")", c.name = "ChunkLoadError", c.type = n, c.request = u, t[1](c)
                        }
                        o[e] = void 0
                    }
                };
                var f = setTimeout((function () {
                    u({type: "timeout", target: a})
                }), 12e4);
                a.onerror = a.onload = u, document.head.appendChild(a)
            }
            return Promise.all(r)
        }, i.m = e, i.c = n, i.d = function (e, r, t) {
            i.o(e, r) || Object.defineProperty(e, r, {enumerable: !0, get: t})
        }, i.r = function (e) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
        }, i.t = function (e, r) {
            if (1 & r && (e = i(e)), 8 & r) return e;
            if (4 & r && "object" == typeof e && e && e.__esModule) return e;
            var t = Object.create(null);
            if (i.r(t), Object.defineProperty(t, "default", {
                enumerable: !0,
                value: e
            }), 2 & r && "string" != typeof e) for (var n in e) i.d(t, n, function (r) {
                return e[r]
            }.bind(null, n));
            return t
        }, i.n = function (e) {
            var r = e && e.__esModule ? function () {
                return e.default
            } : function () {
                return e
            };
            return i.d(r, "a", r), r
        }, i.o = function (e, r) {
            return Object.prototype.hasOwnProperty.call(e, r)
        }, i.p = "/", i.oe = function (e) {
            throw console.error(e), e
        };
        var a = this.webpackJsonpreactjs_wefinex = this.webpackJsonpreactjs_wefinex || [], c = a.push.bind(a);
        a.push = r, a = a.slice();
        for (var f = 0; f < a.length; f++) r(a[f]);
        var l = c;
        t()
    }([])</script>
<script src="/static/js/2.21eacae1.chunk.js"></script>
<script src="/static/js/main.60f13500.chunk.js"></script>
</body>
</html>
