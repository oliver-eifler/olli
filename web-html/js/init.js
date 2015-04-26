!function(a,b,c){function d(a,b){return typeof a===b}function e(){var a,b,c,e,f,g,h;for(var i in s){if(a=[],b=s[i],b.name&&(a.push(b.name.toLowerCase()),b.options&&b.options.aliases&&b.options.aliases.length))for(c=0;c<b.options.aliases.length;c++)a.push(b.options.aliases[c].toLowerCase());for(e=d(b.fn,"function")?b.fn():b.fn,f=0;f<a.length;f++)g=a[f],h=g.split("."),1===h.length?u[h[0]]=e:(!u[h[0]]||u[h[0]]instanceof Boolean||(u[h[0]]=new Boolean(u[h[0]])),u[h[0]][h[1]]=e),w.push((e?"":"no-")+h.join("-"))}}function f(a){var b=x.className,c=u._config.classPrefix||"";if(u._config.enableJSClass){var d=new RegExp("(^|\\s)"+c+"no-js(\\s|$)");b=b.replace(d,"$1"+c+"js$2")}u._config.enableClasses&&(b+=" "+c+a.join(" "+c),x.className=b)}function g(a,b){if("object"==typeof a)for(var c in a)v(a,c)&&g(c,a[c]);else{a=a.toLowerCase();var d=a.split("."),e=u[d[0]];if(2==d.length&&(e=e[d[1]]),"undefined"!=typeof e)return u;b="function"==typeof b?b():b,1==d.length?u[d[0]]=b:(!u[d[0]]||u[d[0]]instanceof Boolean||(u[d[0]]=new Boolean(u[d[0]])),u[d[0]][d[1]]=b),f([(b&&0!=b?"":"no-")+d.join("-")]),u._trigger(a,b)}return u}function h(a,b){return function(){return a.apply(b,arguments)}}function i(){var a=b.body;return a||(a=C("body"),a.fake=!0),a}function j(a,b,c,d){var e,f,g,h,j="modernizr",k=C("div"),l=i();if(parseInt(c,10))for(;c--;)g=C("div"),g.id=d?d[c]:j+(c+1),k.appendChild(g);return e=["&#173;",'<style id="s',j,'">',a,"</style>"].join(""),k.id=j,(l.fake?l:k).innerHTML+=e,l.appendChild(k),l.fake&&(l.style.background="",l.style.overflow="hidden",h=x.style.overflow,x.style.overflow="hidden",x.appendChild(l)),f=b(k,a),l.fake?(l.parentNode.removeChild(l),x.style.overflow=h,x.offsetHeight):k.parentNode.removeChild(k),!!f}function k(a,b){return!!~(""+a).indexOf(b)}function l(a){return a.replace(/([A-Z])/g,function(a,b){return"-"+b.toLowerCase()}).replace(/^ms-/,"-ms-")}function m(b,d){var e=b.length;if("CSS"in a&&"supports"in a.CSS){for(;e--;)if(a.CSS.supports(l(b[e]),d))return!0;return!1}if("CSSSupportsRule"in a){for(var f=[];e--;)f.push("("+l(b[e])+":"+d+")");return f=f.join(" or "),j("@supports ("+f+") { #modernizr { position: absolute; } }",function(a){return"absolute"==getComputedStyle(a,null).position})}return c}function n(a){return a.replace(/([a-z])-([a-z])/g,function(a,b,c){return b+c.toUpperCase()}).replace(/^-/,"")}function o(a,b,e,f){function g(){i&&(delete G.style,delete G.modElem)}if(f=d(f,"undefined")?!1:f,!d(e,"undefined")){var h=m(a,e);if(!d(h,"undefined"))return h}var i,j,l,o,p;for(G.style||(i=!0,G.modElem=C("modernizr"),G.style=G.modElem.style),l=a.length,j=0;l>j;j++)if(o=a[j],p=G.style[o],k(o,"-")&&(o=n(o)),G.style[o]!==c){if(f||d(e,"undefined"))return g(),"pfx"==b?o:!0;try{G.style[o]=e}catch(q){}if(G.style[o]!=p)return g(),"pfx"==b?o:!0}return g(),!1}function p(a,b,c){var e;for(var f in a)if(a[f]in b)return c===!1?a[f]:(e=b[a[f]],d(e,"function")?h(e,c||b):e);return!1}function q(a,b,c,e,f){var g=a.charAt(0).toUpperCase()+a.slice(1),h=(a+" "+z.join(g+" ")+g).split(" ");return d(b,"string")||d(b,"undefined")?o(h,b,e,f):(h=(a+" "+B.join(g+" ")+g).split(" "),p(h,b,c))}function r(a,b,d){return q(a,c,c,b,d)}var s=[],t={_version:"3.0.0-alpha.3",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(a,b){var c=this;setTimeout(function(){b(c[a])},0)},addTest:function(a,b,c){s.push({name:a,fn:b,options:c})},addAsyncTest:function(a){s.push({name:null,fn:a})}},u=function(){};u.prototype=t,u=new u;var v,w=[];!function(){var a={}.hasOwnProperty;v=d(a,"undefined")||d(a.call,"undefined")?function(a,b){return b in a&&d(a.constructor.prototype[b],"undefined")}:function(b,c){return a.call(b,c)}}();var x=b.documentElement;t._l={},t.on=function(a,b){this._l[a]||(this._l[a]=[]),this._l[a].push(b),u.hasOwnProperty(a)&&setTimeout(function(){u._trigger(a,u[a])},0)},t._trigger=function(a,b){if(this._l[a]){var c=this._l[a];setTimeout(function(){var a,d;for(a=0;a<c.length;a++)(d=c[a])(b)},0),delete this._l[a]}},u._q.push(function(){t.addTest=g});var y="Moz O ms Webkit",z=t._config.usePrefixes?y.split(" "):[];t._cssomPrefixes=z;var A=function(b){var d,e=I.length,f=a.CSSRule;if("undefined"==typeof f)return c;if(!b)return!1;if(b=b.replace(/^@/,""),d=b.replace(/-/g,"_").toUpperCase()+"_RULE",d in f)return"@"+b;for(var g=0;e>g;g++){var h=I[g],i=h.toUpperCase()+"_"+d;if(i in f)return"@-"+h.toLowerCase()+"-"+b}return!1},B=t._config.usePrefixes?y.toLowerCase().split(" "):[];t._domPrefixes=B;var C=function(){return"function"!=typeof b.createElement?b.createElement(arguments[0]):b.createElement.apply(b,arguments)},D=function(a){function c(b,c){var e;return b?(c&&"string"!=typeof c||(c=C(c||"div")),b="on"+b,e=b in c,!e&&d&&(c.setAttribute||(c=C("div")),c.setAttribute(b,""),e="function"==typeof c[b],c[b]!==a&&(c[b]=a),c.removeAttribute(b)),e):!1}var d=!("onblur"in b.documentElement);return c}(),E=(t.hasEvent=D,function(){var b=a.matchMedia||a.msMatchMedia;return b?function(a){var c=b(a);return c&&c.matches||!1}:function(b){var c=!1;return j("@media "+b+" { #modernizr { position: absolute; } }",function(b){c="absolute"==(a.getComputedStyle?a.getComputedStyle(b,null):b.currentStyle).position}),c}}()),F=(t.mq=E,{elem:C("modernizr")});u._q.push(function(){delete F.elem});var G={style:F.elem.style};u._q.unshift(function(){delete G.style}),t.testAllProps=q;var H=t.prefixed=function(a,b,c){return 0===a.indexOf("@")?A(a):(-1!=a.indexOf("-")&&(a=n(a)),b?q(a,b,c):q(a,"pfx"))},I=t._config.usePrefixes?" -webkit- -moz- -o- -ms- ".split(" "):[];t._prefixes=I;t.prefixedCSS=function(a){var b=H(a);return b&&l(b)};t.testAllProps=r;var J=(t.testProp=function(a,b,d){return o([a],c,b,d)},t.testStyles=j);u.addTest("flexbox",r("flexBasis","1px",!0)),u.addTest("flexboxlegacy",r("boxDirection","reverse",!0)),u.addTest("flexboxtweener",r("flexAlign","end",!0)),u.addTest("flexwrap",r("flexWrap","wrap",!0)),J('#modernizr{font:0/0 a}#modernizr:after{content:":)";visibility:hidden;font:7px/1 a}',function(a){u.addTest("generatedcontent",a.offsetHeight>=7)}),u.addTest("inlinesvg",function(){var a=C("div");return a.innerHTML="<svg/>","http://www.w3.org/2000/svg"==(a.firstChild&&a.firstChild.namespaceURI)}),e(),delete t.addTest,delete t.addAsyncTest;for(var K=0;K<u._q.length;K++)u._q[K]();a.Modernizr=u}(window,document),function(a,b){function c(a){return a.call.apply(a.bind,arguments)}function d(a,b){if(!a)throw Error();if(2<arguments.length){var c=Array.prototype.slice.call(arguments,2);return function(){var d=Array.prototype.slice.call(arguments);return Array.prototype.unshift.apply(d,c),a.apply(b,d)}}return function(){return a.apply(b,arguments)}}function e(){return e=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?c:d,e.apply(null,arguments)}function f(a,b){this.K=a,this.w=b||a,this.G=this.w.document}function g(a,c,d){a=a.G.getElementsByTagName(c)[0],a||(a=b.documentElement),a&&a.lastChild&&a.insertBefore(d,a.lastChild)}function h(a,b){function c(){a.G.body?b():setTimeout(c,0)}c()}function i(a,b,c){b=b||[],c=c||[];for(var d=a.className.split(/\s+/),e=0;e<b.length;e+=1){for(var f=!1,g=0;g<d.length;g+=1)if(b[e]===d[g]){f=!0;break}f||d.push(b[e])}for(b=[],e=0;e<d.length;e+=1){for(f=!1,g=0;g<c.length;g+=1)if(d[e]===c[g]){f=!0;break}f||b.push(d[e])}a.className=b.join(" ").replace(/\s+/g," ").replace(/^\s+|\s+$/,"")}function j(a,b){for(var c=a.className.split(/\s+/),d=0,e=c.length;e>d;d++)if(c[d]==b)return!0;return!1}function k(a){if("string"==typeof a.na)return a.na;var b=a.w.location.protocol;return"about:"==b&&(b=a.K.location.protocol),"https:"==b?"https:":"http:"}function l(a,b){var c=a.createElement("link",{rel:"stylesheet",href:b,media:"all"}),d=!1;c.onload=function(){d||(d=!0)},c.onerror=function(){d||(d=!0)},g(a,"head",c)}function m(b,c,d,e){var f=b.G.getElementsByTagName("head")[0];if(f){var g=b.createElement("script",{src:c}),h=!1;return g.onload=g.onreadystatechange=function(){h||this.readyState&&"loaded"!=this.readyState&&"complete"!=this.readyState||(h=!0,d&&d(null),g.onload=g.onreadystatechange=null,"HEAD"==g.parentNode.tagName&&f.removeChild(g))},f.appendChild(g),a.setTimeout(function(){h||(h=!0,d&&d(Error("Script load timeout")))},e||5e3),g}return null}function n(a,b){this.Y=a,this.ga=b}function o(a,b,c,d){this.c=null!=a?a:null,this.g=null!=b?b:null,this.D=null!=c?c:null,this.e=null!=d?d:null}function p(a){a=Z.exec(a);var b=null,c=null,d=null,e=null;return a&&(null!==a[1]&&a[1]&&(b=parseInt(a[1],10)),null!==a[2]&&a[2]&&(c=parseInt(a[2],10)),null!==a[3]&&a[3]&&(d=parseInt(a[3],10)),null!==a[4]&&a[4]&&(e=/^[0-9]+$/.test(a[4])?parseInt(a[4],10):a[4])),new o(b,c,d,e)}function q(a,b,c,d,e,f,g,h){this.N=a,this.m=h}function r(a){this.a=a}function s(a){var b=v(a.a,/(iPod|iPad|iPhone|Android|Windows Phone|BB\d{2}|BlackBerry)/,1);return""!=b?(/BB\d{2}/.test(b)&&(b="BlackBerry"),b):(a=v(a.a,/(Linux|Mac_PowerPC|Macintosh|Windows|CrOS|PlayStation|CrKey)/,1),""!=a?("Mac_PowerPC"==a?a="Macintosh":"PlayStation"==a&&(a="Linux"),a):"Unknown")}function t(a){var b=v(a.a,/(OS X|Windows NT|Android) ([^;)]+)/,2);if(b||(b=v(a.a,/Windows Phone( OS)? ([^;)]+)/,2))||(b=v(a.a,/(iPhone )?OS ([\d_]+)/,2)))return b;if(b=v(a.a,/(?:Linux|CrOS|CrKey) ([^;)]+)/,1))for(var b=b.split(/\s/),c=0;c<b.length;c+=1)if(/^[\d\._]+$/.test(b[c]))return b[c];return(a=v(a.a,/(BB\d{2}|BlackBerry).*?Version\/([^\s]*)/,2))?a:"Unknown"}function u(a){var b=s(a),c=p(t(a)),d=p(v(a.a,/AppleWeb(?:K|k)it\/([\d\.\+]+)/,1)),e="Unknown",f=new o,f="Unknown",g=!1;return/OPR\/[\d.]+/.test(a.a)?e="Opera":-1!=a.a.indexOf("Chrome")||-1!=a.a.indexOf("CrMo")||-1!=a.a.indexOf("CriOS")?e="Chrome":/Silk\/\d/.test(a.a)?e="Silk":"BlackBerry"==b||"Android"==b?e="BuiltinBrowser":-1!=a.a.indexOf("PhantomJS")?e="PhantomJS":-1!=a.a.indexOf("Safari")?e="Safari":-1!=a.a.indexOf("AdobeAIR")?e="AdobeAIR":-1!=a.a.indexOf("PlayStation")&&(e="BuiltinBrowser"),"BuiltinBrowser"==e?f="Unknown":"Silk"==e?f=v(a.a,/Silk\/([\d\._]+)/,1):"Chrome"==e?f=v(a.a,/(Chrome|CrMo|CriOS)\/([\d\.]+)/,2):-1!=a.a.indexOf("Version/")?f=v(a.a,/Version\/([\d\.\w]+)/,1):"AdobeAIR"==e?f=v(a.a,/AdobeAIR\/([\d\.]+)/,1):"Opera"==e?f=v(a.a,/OPR\/([\d.]+)/,1):"PhantomJS"==e&&(f=v(a.a,/PhantomJS\/([\d.]+)/,1)),f=p(f),g="AdobeAIR"==e?2<f.c||2==f.c&&5<=f.g:"BlackBerry"==b?10<=c.c:"Android"==b?2<c.c||2==c.c&&1<c.g:526<=d.c||525<=d.c&&13<=d.g,new q(e,0,0,0,0,0,0,new n(g,536>d.c||536==d.c&&11>d.g))}function v(a,b,c){return(a=a.match(b))&&a[c]?a[c]:""}function w(a){this.ma=a||"-"}function x(a,b){this.N=a,this.Z=4,this.O="n";var c=(b||"n4").match(/^([nio])([1-9])$/i);c&&(this.O=c[1],this.Z=parseInt(c[2],10))}function y(a){return a.O+a.Z}function z(a){var b=4,c="n",d=null;return a&&((d=a.match(/(normal|oblique|italic)/i))&&d[1]&&(c=d[1].substr(0,1).toLowerCase()),(d=a.match(/([1-9]00|normal|bold)/i))&&d[1]&&(/bold/i.test(d[1])?b=7:/[1-9]00/.test(d[1])&&(b=parseInt(d[1].substr(0,1),10)))),c+b}function A(a,b){this.d=a,this.q=a.w.document.documentElement,this.Q=b,this.j="wf",this.h=new w("-"),this.ha=!1!==b.events,this.F=!1!==b.classes}function B(a){if(a.F){var b=j(a.q,a.h.e(a.j,"active")),c=[],d=[a.h.e(a.j,"loading")];b||c.push(a.h.e(a.j,"inactive")),i(a.q,c,d)}C(a,"inactive")}function C(a,b,c){a.ha&&a.Q[b]&&(c?a.Q[b](c.getName(),y(c)):a.Q[b]())}function D(){this.C={}}function E(a,b){this.d=a,this.I=b,this.k=this.d.createElement("span",{"aria-hidden":"true"},this.I)}function F(a){g(a.d,"body",a.k)}function G(a){var b;b=[];for(var c=a.N.split(/,\s*/),d=0;d<c.length;d++){var e=c[d].replace(/['"]/g,"");b.push(-1==e.indexOf(" ")?e:"'"+e+"'")}return b=b.join(","),c="normal","o"===a.O?c="oblique":"i"===a.O&&(c="italic"),"display:block;position:absolute;top:-9999px;left:-9999px;font-size:300px;width:auto;height:auto;line-height:normal;margin:0;padding:0;font-variant:normal;white-space:nowrap;font-family:"+b+";"+("font-style:"+c+";font-weight:"+(a.Z+"00")+";")}function H(a,b,c,d,e,f,g,h){this.$=a,this.ka=b,this.d=c,this.o=d,this.m=e,this.I=h||"BESbswy",this.v={},this.X=f||3e3,this.ca=g||null,this.H=this.u=this.t=null,this.t=new E(this.d,this.I),this.u=new E(this.d,this.I),this.H=new E(this.d,this.I),a=new x("serif",y(this.o)),a=G(a),this.t.k.style.cssText=a,a=new x("sans-serif",y(this.o)),a=G(a),this.u.k.style.cssText=a,a=new x("monospace",y(this.o)),a=G(a),this.H.k.style.cssText=a,F(this.t),F(this.u),F(this.H),this.v.serif=this.t.k.offsetWidth,this.v["sans-serif"]=this.u.k.offsetWidth,this.v.monospace=this.H.k.offsetWidth}function I(a,b,c){for(var d in _)if(_.hasOwnProperty(d)&&b===a.v[_[d]]&&c===a.v[_[d]])return!0;return!1}function J(a){var b=a.t.k.offsetWidth,c=a.u.k.offsetWidth;b===a.v.serif&&c===a.v["sans-serif"]||a.m.ga&&I(a,b,c)?Y()-a.oa>=a.X?a.m.ga&&I(a,b,c)&&(null===a.ca||a.ca.hasOwnProperty(a.o.getName()))?L(a,a.$):L(a,a.ka):K(a):L(a,a.$)}function K(a){setTimeout(e(function(){J(this)},a),50)}function L(a,b){a.t.remove(),a.u.remove(),a.H.remove(),b(a.o)}function M(a,b,c,d){this.d=b,this.A=c,this.S=0,this.ea=this.ba=!1,this.X=d,this.m=a.m}function N(a,b,c,d,f){if(c=c||{},0===b.length&&f)B(a.A);else for(a.S+=b.length,f&&(a.ba=f),f=0;f<b.length;f++){var g=b[f],h=c[g.getName()],j=a.A,k=g;j.F&&i(j.q,[j.h.e(j.j,k.getName(),y(k).toString(),"loading")]),C(j,"fontloading",k),j=null,j=new H(e(a.ia,a),e(a.ja,a),a.d,g,a.m,a.X,d,h),j.start()}}function O(a){0==--a.S&&a.ba&&(a.ea?(a=a.A,a.F&&i(a.q,[a.h.e(a.j,"active")],[a.h.e(a.j,"loading"),a.h.e(a.j,"inactive")]),C(a,"active")):B(a.A))}function P(a){this.K=a,this.B=new D,this.pa=new r(a.navigator.userAgent),this.a=this.pa.parse(),this.U=this.V=0,this.R=this.T=!0}function Q(a,b,c,d,e){var f=0==--a.V;(a.R||a.T)&&setTimeout(function(){N(b,c,d||null,e||null,f)},0)}function R(a,b,c){this.P=a?a:b+ab,this.s=[],this.W=[],this.fa=c||""}function S(a){this.s=a,this.da=[],this.M={}}function T(a,b){this.a=new r(navigator.userAgent).parse(),this.d=a,this.f=b}function U(a,b){this.d=a,this.f=b,this.p=[]}function V(a,b){this.d=a,this.f=b,this.p=[]}function W(a,b){this.d=a,this.f=b,this.p=[]}function X(a,b){this.d=a,this.f=b}var Y=Date.now||function(){return+new Date};f.prototype.createElement=function(a,b,c){if(a=this.G.createElement(a),b)for(var d in b)b.hasOwnProperty(d)&&("style"==d?a.style.cssText=b[d]:a.setAttribute(d,b[d]));return c&&a.appendChild(this.G.createTextNode(c)),a};var Z=/^([0-9]+)(?:[\._-]([0-9]+))?(?:[\._-]([0-9]+))?(?:[\._+-]?(.*))?$/;o.prototype.compare=function(a){return this.c>a.c||this.c===a.c&&this.g>a.g||this.c===a.c&&this.g===a.g&&this.D>a.D?1:this.c<a.c||this.c===a.c&&this.g<a.g||this.c===a.c&&this.g===a.g&&this.D<a.D?-1:0},o.prototype.toString=function(){return[this.c,this.g||"",this.D||"",this.e||""].join("")},q.prototype.getName=function(){return this.N};var $=new q("Unknown",0,0,0,0,0,0,new n(!1,!1));r.prototype.parse=function(){var a;if(-1!=this.a.indexOf("MSIE")||-1!=this.a.indexOf("Trident/")){a=s(this);var b=p(t(this)),c=null,d=v(this.a,/Trident\/([\d\w\.]+)/,1),c=p(-1!=this.a.indexOf("MSIE")?v(this.a,/MSIE ([\d\w\.]+)/,1):v(this.a,/rv:([\d\w\.]+)/,1));""!=d&&p(d),a=new q("MSIE",0,0,0,0,0,0,new n("Windows"==a&&6<=c.c||"Windows Phone"==a&&8<=b.c,!1))}else if(-1!=this.a.indexOf("Opera"))a:if(a=p(v(this.a,/Presto\/([\d\w\.]+)/,1)),p(t(this)),null!==a.c||p(v(this.a,/rv:([^\)]+)/,1)),-1!=this.a.indexOf("Opera Mini/"))a=p(v(this.a,/Opera Mini\/([\d\.]+)/,1)),a=new q("OperaMini",0,0,0,s(this),0,0,new n(!1,!1));else{if(-1!=this.a.indexOf("Version/")&&(a=p(v(this.a,/Version\/([\d\.]+)/,1)),null!==a.c)){a=new q("Opera",0,0,0,s(this),0,0,new n(10<=a.c,!1));break a}a=p(v(this.a,/Opera[\/ ]([\d\.]+)/,1)),a=null!==a.c?new q("Opera",0,0,0,s(this),0,0,new n(10<=a.c,!1)):new q("Opera",0,0,0,s(this),0,0,new n(!1,!1))}else/OPR\/[\d.]+/.test(this.a)?a=u(this):/AppleWeb(K|k)it/.test(this.a)?a=u(this):-1!=this.a.indexOf("Gecko")?(a="Unknown",b=new o,p(t(this)),b=!1,-1!=this.a.indexOf("Firefox")?(a="Firefox",b=p(v(this.a,/Firefox\/([\d\w\.]+)/,1)),b=3<=b.c&&5<=b.g):-1!=this.a.indexOf("Mozilla")&&(a="Mozilla"),c=p(v(this.a,/rv:([^\)]+)/,1)),b||(b=1<c.c||1==c.c&&9<c.g||1==c.c&&9==c.g&&2<=c.D),a=new q(a,0,0,0,s(this),0,0,new n(b,!1))):a=$;return a},w.prototype.e=function(){for(var a=[],b=0;b<arguments.length;b++)a.push(arguments[b].replace(/[\W_]+/g,"").toLowerCase());return a.join(this.ma)},x.prototype.getName=function(){return this.N},E.prototype.remove=function(){var a=this.k;a.parentNode&&a.parentNode.removeChild(a)};var _={sa:"serif",ra:"sans-serif",qa:"monospace"};H.prototype.start=function(){this.oa=Y();var a=new x(this.o.getName()+",serif",y(this.o)),a=G(a);this.t.k.style.cssText=a,a=new x(this.o.getName()+",sans-serif",y(this.o)),a=G(a),this.u.k.style.cssText=a,J(this)},M.prototype.ia=function(a){var b=this.A;b.F&&i(b.q,[b.h.e(b.j,a.getName(),y(a).toString(),"active")],[b.h.e(b.j,a.getName(),y(a).toString(),"loading"),b.h.e(b.j,a.getName(),y(a).toString(),"inactive")]),C(b,"fontactive",a),this.ea=!0,O(this)},M.prototype.ja=function(a){var b=this.A;if(b.F){var c=j(b.q,b.h.e(b.j,a.getName(),y(a).toString(),"active")),d=[],e=[b.h.e(b.j,a.getName(),y(a).toString(),"loading")];c||d.push(b.h.e(b.j,a.getName(),y(a).toString(),"inactive")),i(b.q,d,e)}C(b,"fontinactive",a),O(this)},P.prototype.load=function(a){this.d=new f(this.K,a.context||this.K),this.T=!1!==a.events,this.R=!1!==a.classes;var b=new A(this.d,a),c=[],d=a.timeout;b.F&&i(b.q,[b.h.e(b.j,"loading")]),C(b,"loading");var g,c=this.B,h=this.d,j=[];for(g in a)if(a.hasOwnProperty(g)){var k=c.C[g];k&&j.push(k(a[g],h))}for(c=j,this.U=this.V=c.length,a=new M(this.a,this.d,b,d),d=0,g=c.length;g>d;d++)h=c[d],h.L(this.a,e(this.la,this,h,b,a))},P.prototype.la=function(a,b,c,d){var e=this;d?a.load(function(a,b,d){Q(e,c,a,b,d)}):(a=0==--this.V,this.U--,a&&0==this.U?B(b):(this.R||this.T)&&N(c,[],{},null,a))};var ab="//fonts.googleapis.com/css";R.prototype.e=function(){if(0==this.s.length)throw Error("No fonts to load!");if(-1!=this.P.indexOf("kit="))return this.P;for(var a=this.s.length,b=[],c=0;a>c;c++)b.push(this.s[c].replace(/ /g,"+"));return a=this.P+"?family="+b.join("%7C"),0<this.W.length&&(a+="&subset="+this.W.join(",")),0<this.fa.length&&(a+="&text="+encodeURIComponent(this.fa)),a};var bb={latin:"BESbswy",cyrillic:"&#1081;&#1103;&#1046;",greek:"&#945;&#946;&#931;",khmer:"&#x1780;&#x1781;&#x1782;",Hanuman:"&#x1780;&#x1781;&#x1782;"},cb={thin:"1",extralight:"2","extra-light":"2",ultralight:"2","ultra-light":"2",light:"3",regular:"4",book:"4",medium:"5","semi-bold":"6",semibold:"6","demi-bold":"6",demibold:"6",bold:"7","extra-bold":"8",extrabold:"8","ultra-bold":"8",ultrabold:"8",black:"9",heavy:"9",l:"3",r:"4",b:"7"},db={i:"i",italic:"i",n:"n",normal:"n"},eb=/^(thin|(?:(?:extra|ultra)-?)?light|regular|book|medium|(?:(?:semi|demi|extra|ultra)-?)?bold|black|heavy|l|r|b|[1-9]00)?(n|i|normal|italic)?$/;S.prototype.parse=function(){for(var a=this.s.length,b=0;a>b;b++){var c=this.s[b].split(":"),d=c[0].replace(/\+/g," "),e=["n4"];if(2<=c.length){var f,g=c[1];if(f=[],g)for(var g=g.split(","),h=g.length,i=0;h>i;i++){var j;if(j=g[i],j.match(/^[\w-]+$/)){j=eb.exec(j.toLowerCase());var k=void 0;if(null==j)k="";else{if(k=void 0,k=j[1],null==k||""==k)k="4";else var l=cb[k],k=l?l:isNaN(k)?"4":k.substr(0,1);j=j[2],k=[null==j||""==j?"n":db[j],k].join("")}j=k}else j="";j&&f.push(j)}0<f.length&&(e=f),3==c.length&&(c=c[2],f=[],c=c?c.split(","):f,0<c.length&&(c=bb[c[0]])&&(this.M[d]=c))}for(this.M[d]||(c=bb[d])&&(this.M[d]=c),c=0;c<e.length;c+=1)this.da.push(new x(d,e[c]))}};var fb={Arimo:!0,Cousine:!0,Tinos:!0};T.prototype.L=function(a,b){b(a.m.Y)},T.prototype.load=function(a){var b=this.d;"MSIE"==this.a.getName()&&1!=this.f.blocking?h(b,e(this.aa,this,a)):this.aa(a)},T.prototype.aa=function(a){for(var b=this.d,c=new R(this.f.api,k(b),this.f.text),d=this.f.families,e=d.length,f=0;e>f;f++){var g=d[f].split(":");3==g.length&&c.W.push(g.pop());var h="";2==g.length&&""!=g[1]&&(h=":"),c.s.push(g.join(h))}d=new S(d),d.parse(),l(b,c.e()),a(d.da,d.M,fb)},U.prototype.J=function(a){var b=this.d;return k(this.d)+(this.f.api||"//f.fontdeck.com/s/css/js/")+(b.w.location.hostname||b.K.location.hostname)+"/"+a+".js"},U.prototype.L=function(a,b){var c=this.f.id,d=this.d.w,e=this;c?(d.__webfontfontdeckmodule__||(d.__webfontfontdeckmodule__={}),d.__webfontfontdeckmodule__[c]=function(a,c){for(var d=0,f=c.fonts.length;f>d;++d){var g=c.fonts[d];e.p.push(new x(g.name,z("font-weight:"+g.weight+";font-style:"+g.style)))}b(a)},m(this.d,this.J(c),function(a){a&&b(!1)})):b(!1)},U.prototype.load=function(a){a(this.p)},V.prototype.J=function(a){var b=k(this.d);return(this.f.api||b+"//use.typekit.net")+"/"+a+".js"},V.prototype.L=function(a,b){var c=this.f.id,d=this.d.w,e=this;c?m(this.d,this.J(c),function(a){if(a)b(!1);else{if(d.Typekit&&d.Typekit.config&&d.Typekit.config.fn){a=d.Typekit.config.fn;for(var c=0;c<a.length;c+=2)for(var f=a[c],g=a[c+1],h=0;h<g.length;h++)e.p.push(new x(f,g[h]));try{d.Typekit.load({events:!1,classes:!1})}catch(i){}}b(!0)}},2e3):b(!1)},V.prototype.load=function(a){a(this.p)},W.prototype.L=function(a,b){var c=this,d=c.f.projectId,e=c.f.version;if(d){var f=c.d.w;m(this.d,c.J(d,e),function(e){if(e)b(!1);else{if(f["__mti_fntLst"+d]&&(e=f["__mti_fntLst"+d]()))for(var g=0;g<e.length;g++)c.p.push(new x(e[g].fontfamily));b(a.m.Y)}}).id="__MonotypeAPIScript__"+d}else b(!1)},W.prototype.J=function(a,b){var c=k(this.d),d=(this.f.api||"fast.fonts.net/jsapi").replace(/^.*http(s?):(\/\/)?/,"");return c+"//"+d+"/"+a+".js"+(b?"?v="+b:"")},W.prototype.load=function(a){a(this.p)},X.prototype.load=function(a){var b,c,d=this.f.urls||[],e=this.f.families||[],f=this.f.testStrings||{};for(b=0,c=d.length;c>b;b++)l(this.d,d[b]);for(d=[],b=0,c=e.length;c>b;b++){var g=e[b].split(":");if(g[1])for(var h=g[1].split(","),i=0;i<h.length;i+=1)d.push(new x(g[0],h[i]));else d.push(new x(g[0]))}a(d,f)},X.prototype.L=function(a,b){return b(a.m.Y)};var gb=new P(this);gb.B.C.custom=function(a,b){return new X(b,a)},gb.B.C.fontdeck=function(a,b){return new U(b,a)},gb.B.C.monotype=function(a,b){return new W(b,a)},gb.B.C.typekit=function(a,b){return new V(b,a)},gb.B.C.google=function(a,b){return new T(b,a)},this.WebFont||(this.WebFont={},this.WebFont.load=e(gb.load,gb),this.WebFontConfig&&gb.load(this.WebFontConfig))}(this,document),function(a,b){var c=Modernizr,d=["js"];if(d.push("number"==typeof b.documentMode?"ie ie-"+b.documentMode:"no-ie"),!c.generatedcontent&&d.push("no-pseudo"),d.push(((c.flexbox||c.flexboxlegacy||c.flexboxtweener)&&c.flexwrap?"":"no-")+"flex"),b.documentElement.className=d.join(" "),WebFont.load({classes:!1,custom:{families:["Roboto:n4","Roboto Slab:n4"]},active:function(){b.documentElement.className+=" wf-loaded"},fontactive:function(a,b){}}),c.inlinesvg&&"XMLHttpRequest"in a){var e=new XMLHttpRequest;e.open("GET",_cfg.svg,!0),e.send(),e.onreadystatechange=function(){if(4===e.readyState&&(e.status>=200&&e.status<300||304===e.status)){var a=b.createElement("div");a.style.display="none",a.innerHTML=e.responseText,b.body.insertBefore(a,b.body.childNodes[0]),b.documentElement.className+=" svg"}}}}(this,this.document);