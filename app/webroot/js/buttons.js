if (!window.__BTN) var __BTN = function () {
    var h = {
        act: '/plazas/vote?id=',
        api: '/votes/count?id=',
        css: '/css/buttons.css',
        popup: 'http://',
        submit: 'http://',
    },
    z = {
        impression: 5,
        click: 100
    },
    s = {
        source: "source",
        submitted: "submitted",
        event: "event",
        votes: "votes",
        itemId: "itemId",
        buttons: "buttons",
    },
    i,
    j,
    l = {},
    A = function (a, b) {
        var c,
        d = parseInt(b.votes),
        e = a.firstChild.firstChild.firstChild.firstChild;
        if (d > 9999) d = Math.floor(data.votes / 1E3) + "K";
        else if (d > 999) {
            c = (d += "").charAt(0);
            d = d.replace(c, c+ ",")
        }
        e.appendChild(document.createTextNode(d));
        e.nextSibling.appendChild(document.createTextNode(d == 1 ? "vote": "votes"));
        if (b.id) { 
            a.firstChild.firstChild.className = "db-container";
            Z(a,b);
        }
    },
    v = function (a) {
        function b() {
            for (var f in e) return f
        }
        var c = i.cloneNode(true),
        d = B(a),
        e = {},
        g,
        k;
        c.className += " db-" + d;
        c.getElementsByTagName("SPAN")[2].className += " db-" + d;
        g = C(a);
        if (g.style == false) c.className = "db-clean";
        c.firstChild.onclick = function() {
            var f = this.firstChild;
            f.className = "db-container db-voted";
            if (!k) {
                f = f.firstChild.firstChild;
                j.id ? t(f) : u(f, 0,
                function () {
                    t(f);
                    setTimeout(function() {
                        u(f, 100)
                    },
                    175)
                });
                k = 1
            }
            b() ? n(e, "click") : setTimeout(function() {
                n(e, "click")
            },
            1E3);
            if (g.callback) {
                eval(g.callback)(e)
            } else {
                D(g, e);
            }
        };
        a.parentNode.replaceChild(c,a);
        l[g.url] = l[g.url] || [];
        l[g.url].push(function(f) {
            if (!b()) {
                e = f;
                n(f, "impression");
                A(c, f)
            }
        });
        E(g.url)
    },
    o = function () {
        var a = document.createElement("link"),
        b = document.getElementsByTagName("head")[0] || document.documentElement,
        c = b.firstChild;
        a.setAttribute("rel", "stylesheet");
        a.setAttribute("type", "text/css");
        a.setAttribute("href", h.css);
        c ? b.insertBefore(a, c) : b.appendChild(a);
        o = 0;
    },
    u = function (a, b, c) {
        var d,
        e,
        g = function (f) {
            e = f;
            a.style.opacity = f / 100;
            a.style.filter = "alpha(opacity=" + f +")"
        },
        k = function () {
            if (e == b) c && c();
            else {
                g(e + d);
                setTimeout(k, 15)
            }
        }; (function() {
            d = b ? 5: -5;
            e = b ? 0: 100;
            g(e);
            setTimeout(k, 15)
        })()
    },
    F = function (a) {
        var b = document.createElement("script"),
        c = document.getElementsByTagName("head")[0] || document.documentElement,
        d = c.firstChild;
        b.setAttribute("type", "text/javascript");
        b.setAttribute("async", "true");
        b.setAttribute("src", a);
        d ? c.insertBefore(b, d) : c.appentChild(b)
    },
    E = function (a) {
        F(h.api + a)
    },
    Z = function (a, b) {
        c = h.act + b.id;
        d = a.firstChild.firstChild.firstChild.lastChild;
        d.href = c;
        d.onclick = function() { return false; }
    },
    B = function (a) {
        var b = "large",
        c = " " + a.className + " ",
        d = "";
        if (c.match(/( VoteThisButtonMedium | VoteMedium )/)) b = "medium";
        else if (c.match(/ VoteWide /)) b = "wide";
        else if (c.match(/ VoteLarge /)) b = "large";
        else if (c.match(/ VoteCompact /)) b = "compact";
        else if (c.match(/ VoteIcon /)) b = "icon";
        a = a.getElementsByTagName("IMG");
        if (a[0]) d = a[0].src;
        else return b;
        if (d.match(/voteThis\.(gif|png)/i)) return "large";
        else if (d.match(/voteThisWide\.(gif|png)/i)) return "wide";
        else if (d.match(/voteThisMedium\.(gif|png)/i)) return "medium";
        else if (d.match(/voteThisCompact\.(gif|png)/i)) return "compact";
        else if (d.match(/vote-icon.(gif|png)/i)) return "icon";
        else if (d.match(/voteThisIcon.(gif|png)/i)) return "icon";
        return b
    },
    t = function (a) {
        var b = a.firstChild,
        c = b.nodeValue;
        if (c.indexOf(",") >= 0) b.nodeValue = +c.replace(",", "", "g") + 1;
        else if (!c.match(/k/i)) {
            c = +c + 1;
            b.nodeValue = c;
            a.nextSibling.firstChild.nodeValue = c == 1 ? "vote": "votes"
        }
    },
    D = function (a, b) {
        var c = 480;
        if (b.id) a.itemId = b.id;
        if (a.related === false) c = 335;
        a = h.popup + "confirm" + w(a);
        window.open(a,
        "voteAction", "status=0,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollsbars=0,height=" + c + ",width=700")
    },
    G = function (a) {
        var b,
        c,
        d,
        e = {};
        b = a.indexOf("?");
        if (b > -1) {
            a = a.substr(b + 1).replace("&amp;", "&", "g").split("&");
            b = 0;
            for (c = a.length; b < c; b++) {
                d = a[b].split("=");
                e[d[0]] = d[1]
            }
        }
        return e
    },
    C = function (a) {
        var b = {},
        c;
        if (a.href) b = G(a.href);
        b.title = escape(unescape(b.url ? b.title || "": document.title));
        b.url = escape(unescape(b.url || location.href)).replace("+", "%2b", "g");
        b.related = b.related || true;
        b.style = 
        b.style != "no";
        if (a.rev) {
            c = a.rev.split(",");
            if (c.length > 1) {
                b.rev = c[0].replace("(", "").replace(")", "").replace("'", "", "g");
                b.topic = H(c[1])
            }
        }
        b.bodytext = null;
        if (a = a.getElementsByTagName("span")[0]) b.bodytext = a.innerHTML;
        return b
    },
    I = function () {
        var a,
        b,
        c,
        d,
        e,
        g;
        j = j || {
            ie: !!document.all,
            ie6: this.ie && document.documentElement.style && "maxHeight" in document.documentElement.style
        };
        i = document.createElement("SPAN");
        i.className = "db-wrapper db-clear";
        a = document.createElement("SPAN");
        if (j.ie) {
            a.className = "db-ie";
            if (j.ie6) a.className = 
            "db-ie db-ie6"
        }
        b = document.createElement("SPAN");
        b.className = "db-container db-submit";
        c = document.createElement("SPAN");
        c.className = "db-body";
        d = document.createElement("SPAN");
        d.className = "db-count";
        e = document.createElement("SPAN");
        e.className = "db-copy";
        g = document.createElement("A");
        g.className = "db-anchor";
        i.appendChild(a);
        a.appendChild(b);
        b.appendChild(c);
        c.appendChild(d);
        c.appendChild(e);
        c.appendChild(g);
        g.appendChild(document.createTextNode("vote"))
    },
    w = function (a) {
        var b = [];
        for (prop in a) a[prop] !==
            null && b.push(prop + "=" + a[prop]);
            return "?" + b.join("&") 
    },
    J = function(a) {
        var a;
        for (prop in a) if (s[prop]) {
            b = a[prop];
            delete a[prop];
            a[s[prop]] = b
        }
        return a
    },
    n = function (a, b) {
        a = J({
            chan: "button-v4",
            submitted: !!a.id,
            event: b,
            votes: a.votes,
            itemId: a.id || 0,
            buttons: p
        });
        a = h.analytics + w(a);
        if (Math.floor(Math.random() * 100) + 1 <= z[b])(new Image).src = a
    },
    H = function (a) {
        return a.replace(/^\s+|\s+%/g, "");
    },
    q,
    x,
    p = 0,
    y,
    r = function () {
        o && o();
        i || I();
        y();
        x || setTimeout(r, 500)
    },
    m = function () {
        x = 1
    };
    y = function (a) {
        return a && (a += "").substr(a.indexOf("{")).replace(/\s/g,
        "") == "{[nativecode]}"
    } (document.getElementsByClassName) ?
    function () {
        for (var a = document.getElementsByClassName("VoteThisButton"); a.length;) {
            v(a[0]);
            p++
        }
    }: function () {
        for (var a = document.getElementsByTagName("A"), b = a.length, c = 0, d; c < b; c++) {
            d = " " + a[c].className + " ";
            if (d.indexOf(" VoteThisButton ") >= 0) {
                v(a[c]);
                p++
            }
        }
    };
    r();
    if (window.addEventListener) window.addEventListener("load", m, true);
    else if (window.attachEvent) window.attachEvent("onload", m);
    else {
        q = window.onload;
        window.onload = q ?
        function() {
            q();
            m()
        }: m
    }
    return {
        writeLink: function () {
            var a =
            ['<a class="VoteThisButton'];
            if (window.vote_skin == "compact") a.push(' VoteCompact"');
            else window.vote_skin == "icon" ? a.push(' VoteIcon"') : a.push('"');
            if (window.vote_title) a.push(' href="', h.submit, "url=", escape(vote_url || VOTE_URL || location.href).replace("+", "%2b", "g"), "&title=", escape(vote_title), '"');
            else if (window.vote_url || window.VOTE_URL) a.push(' href="', h.submit, "url=", escape(vote_url || VOTE_URL).replace("+", "%2b", "g"), '"');
            window.vote_media && window.vote_topic && a.push(' rev="', vote_media, ", ", vote_topic, '"');
            a.push(">");
            document.write(a.join(""))
        },
        addButtons: r,
        collectVotes: function (a) {
            for (var b = l[escape(a.url).replace("+", "%2b", "g")], c= b.length, d=0; d < c; d++) b[d](a)
        },
    }
} ();
