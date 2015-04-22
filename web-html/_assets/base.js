!function(t, e, n)
{
  !function r(t, e, n)
  {
    function i(a, s)
    {
      if(!e[a])
      {
        if(!t[a])
        {
          var c = "function"==typeof require&&require; if(!s&&c)return c(a, !0); if(o)return o(a, !0);
          var u = new Error("Cannot find module '"+a+"'"); throw u.code = "MODULE_NOT_FOUND", u
        }
        var h = e[a] =
        {
        exports:
          {
          }
        }; t[a][0].call(h.exports, function(e)
          {
            var n = t[a][1][e]; return i(n? n: e)
          }
          , h, h.exports, r, t, e, n)
      }
      return e[a].exports
    }
    for(var o = "function"==typeof require&&require, a = 0; a<n.length; a++)i(n[a]); return i
  }
  (
    {
    1: [function(t, e)
        {
          e.exports = function(t, e, n)
          {
            t.addEventListener? t.addEventListener(e, n, !1): t.attachEvent("on"+e, n)
          }
        },
        {
        }
      ], 2: [function(e, r)
        {
          function i()
          {
            if(t.matchMedia)
            {
              var e; Object.keys(h).forEach(function(n)
                {
                  var r = t.matchMedia(h[n]); r.matches&&ga("set", "dimension1", n), r.addListener(function(t)
                    {
                      t.matches&&(clearTimeout(e), e = setTimeout
                        (function()
                          {
                            ga("set", "dimension1", n), ga("send", "event", "Breakpoint", "change", n)
                          }
                          , 1e3)
                      )
                    }
                  )
                }
              )
            }
          }function o()
          {
            c(function()
              {
                this.getAttribute("data-social-network")||s(this)&&(this.target = "_blank", ga("send", "event", "Outbound Link", "click", this.href))
              }
            )
          }
          function a()
          {
            c(function()
              {
                var t = this.getAttribute("data-social-network"); if(t)
                {
                  var e = this.getAttribute("data-social-action"), r = n.href; this.target = "_blank", ga("send", "social", t, e, r)
                }
              }
            )
          }
          function s(t)
          {
            var e = u(t.href), r = u(n.href); return e.origin!=r.origin
          }
          var c = e("./link-clicked"), u = e("./parse-url"), h =
          {
          xs: "(max-width: 419px)", sm: "(min-width: 420px) and (max-width: 569px)", md: "(min-width: 570px) and (max-width: 799px)", lg: "(min-width: 800px) and (max-width: 999px)", xl: "(min-width: 1000px)"
          };
          r.exports =
          {
          track: function()
            {
              i(), o(), a(), ga("send", "pageview")
            }
          }
        }
        ,
        {
        "./link-clicked": 5, "./parse-url": 7
        }
      ], 3: [function(r, i)
        {
          function o(t)
          {
            var e = t.title||t.innerText; return e? e+" — Philip Walton": null
          }
          function a(t)
          {
            var e = this.nextPage.path; if(x[e])return t();
            var n = /(\w+)\.html$/, r = n.test(e)? e.replace(n, "_$1.html"): e+"_index.html", i = new XMLHttpRequest; i.open("GET", r), i.onload = function()
            {
              i.status>=200&&i.status<400? (x[e] = i.responseText, t()): t(new Error("("+i.status+") "+i.response))
            }
            , i.onerror = function()
            {
              t(new Error("Error making request to:"+r))
            }
            , i.send()
          }
          function s()
          {
            var t = x[this.nextPage.path]; f.innerHTML = t
          }
          function c()
          {
            var n = this.nextPage.hash; if(n)var r = e.getElementById(n.slice(1));
            var i = r? r.offsetTop: 0; t.scrollTo(0, i)
          }
          function u()
          {
            ga("set",
              {
              page: this.nextPage.pathname, title: this.nextPage.title
              }
            ), ga("send", "pageview")
          }
          function h(t)
          {
            var e = this.nextPage.href; ga("send", "exception",
              {
              exDescription: t.stack||t.message, exFatal: !1, hitCallback: function()
                {
                  n.href = e
                }
              }
            )
          }
          var f, l = r("./link-clicked"), p = r("./history2"), d = r("./parse-url"), x =
          {
          };
          i.exports =
          {
          init: function()
            {
              if(t.history&&t.history.pushState)
              {
                f = e.querySelector("main"), x[n.pathname] = f.innerHTML;
                var r = (new p).use(a).use(s).use(c).use(u)["catch"](h); l(function(t)
                  {
                    if(!t.metaKey&&!t.ctrlKey)
                    {
                      var e = d(n.href), i = d(this.href); i.href==e.href&&t.preventDefault(), i.origin==e.origin&&i.path!=e.path&&(t.preventDefault(), r.add(i.href, o(this)))
                    }
                  }
                )
              }
            }
          }
        },
        {
        "./history2": 4, "./link-clicked": 5, "./parse-url": 7
        }
      ], 4: [function(n, r)
        {
          function i()
          {
            this.currentPage = o(t.location.href), this.currentPage.title = e.title, history.replaceState(this.currentPage, this.currentPage.title, this.currentPage.href), this._queue =[], t.addEventListener("popstate", function(e)
              {
                var n = e.state, r = n&&n.title; this.add(t.location.href, r, n, e)
              }
              .bind(this))
          }
          var o = n("./parse-url"); i.prototype.add = function(t, e, n, r)
          {
            t!=this.currentPage.href&&(this.nextPage = o(t), this.nextPage.title = e, this.nextPage.state = n, this._processQueue(r))
          }
          , i.prototype.use = function(t)
          {
            return this._queue.push(t), this
          }
          , i.prototype["catch"] = function(t)
          {
            return this._onError = t, this
          }
          , i.prototype._onError = function(t)
          {
            console.error(t.stack)
          }
          , i.prototype._onComplete = function(t)
          {
            t&&"popstate"==t.type||history.pushState(this.nextPage, this.nextPage.title, this.nextPage.href), this.nextPage.title&&(e.title = this.nextPage.title), this.currentPage = this.nextPage, this.nextPage = null
          }
          , i.prototype._processQueue = function(t)
          {
            var e = this, n = 0; !function r()
            {
              function i(t)
              {
                t? e._onError(t): r()
              }
              var o = e._queue[n++], a = o&&!o.length; if(!o)return e._onComplete(t); try
              {
                o.apply(e, a?[]:[i])
              }
              catch(s)
              {
                return e._onError(s)
              }
              a&&r()
            }
            ()
          }
          , r.exports = i
        }
        ,
        {
        "./parse-url": 7
        }
      ], 5: [function(n, r)
        {
          function i(t)
          {
            return t.nodeName&&"a"==t.nodeName.toLowerCase()&&t.href
          }
          function o(t)
          {
            if(i(t))return t; for(;t.parentNode&&1==t.parentNode.nodeType;)
            {
              if(i(t))return t; t = t.parentNode
            }
          }var a = n("./add-listener"); r.exports = function(n)
          {
            a(e, "click", function(e)
              {
                var r = e||t.event, i = r.target||r.srcElement, a = o(i); a&&n.call(a, r)
              }
            )
          }
        },
        {
        "./add-listener": 1
        }
      ], 6: [function(t)
        {
          var n = t("./analytics"), r = t("./content-loader"), i = t("./supports"); i.flexbox()||(e.documentElement.className += " is-legacy"), r.init(), n.track()
        }
        ,
        {
        "./analytics": 2, "./content-loader": 3, "./supports": 8
        }
      ], 7: [function(t, r)
        {
          var i = e.createElement("a"), o =
          {
          };
          r.exports = function(t)
          {
            if(o[t])return o[t];
            var e = /:80$/, r = /:443/; i.href = t;
            var a = i.protocol&&":"!=i.protocol? i.protocol: n.protocol, s = "80"==i.port||"443"==i.port? "": i.port, c = i.host.replace("http:"==a? e: r, ""), u = i.origin? i.origin: a+"//"+c, h = "/"==i.pathname.charAt(0)? i.pathname: "/"+i.pathname; return o[t] =
            {
            hash: i.hash, host: c, hostname: i.hostname, href: i.href, origin: u, path: h+i.search, pathname: h, port: s, protocol: a, search: i.search
            }
          }
        }
        ,
        {
        }
      ], 8: [function(t, n)
        {
          var r =
          {
          }
          , i = e.body.style; n.exports =
          {
          flexbox: function()
            {
              return r.flexbox||(r.flexbox = "flexBasis"in i||"msFlexAlign"in i||"webkitBoxDirection"in i)
            }
          }
        }
        ,
        {
        }
      ]
    }
    ,
    {
    }
    , [6])
}
(window, document, location);