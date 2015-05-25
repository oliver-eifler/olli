function _namespace(a,b){void 0===b&&(b=olli_name);var c,d,e=b.split("."),f=a,g="string"==typeof a.namespace?a.namespace+".":"";for(c=e.length,d=0;c>d;d++)g=g+(d?".":"")+e[d],"undefined"==typeof f[e[d]]&&(f[e[d]]={namespace:g}),f=f[e[d]];return f}function _$(a,b){return b||(b=document),b.querySelector(a)}function _$$(a,b){return b||(b=document),Array.prototype.slice.call(b.querySelectorAll(a))}var olli_name="olli",_isArray=function(a){return Array.isArray(a)},_toArray=function(a){return"string"!=typeof a||_isBlank(a)?Array.isArray(a)?_cleanArray(a):[]:_cleanArray(a.trim().split(/\s*\s\s*/))},_cleanArray=function(a){for(var b=[],c=0,d=a.length;d>c;c++)"string"!=typeof a[c]||_isBlank(a[c])||b.push(a[c].trim());return b};Element.prototype._$=function(a){return this.querySelector(a)},Element.prototype._$$=function(a){return Array.prototype.slice.call(this.querySelectorAll(a))},Object.prototype.extend=function(a){for(var b in a)a.hasOwnProperty(b)&&(this[b]=a[b])},String.prototype._isBlank=function(){return 0===this.length||!/[^\s]+/.test(this)},_w=_root=this,_doc=_w.document,_html=_doc.documentElement,_body=_$("body"),_w[olli_name]={},function(a,b,c){var d=_namespace(a,b);d.extend(c(d))}(this,olli_name,function(a){function b(a,b,c){return c=c||"0",a+="",a.length>=b?a:new Array(b-a.length+1).join(c)+a}var c={maj:0,min:1,build:1},d=function(b){for(var c=[],d=1;d<arguments.length;d++)c.push(arguments[d]);var e=c[0];if(_isArray(e))for(var d=0,f=e.length;f>d;d++)c[0]=e[d],b.apply(this,c);else b.apply(this,c);return a},e=function(a,b){if(_isArray(a)){for(var c=0,d=a.length;d>c;c++)if(b.call(this,a[c],c,a)===!1)return}else b.call(this,a,0,null)},f={namespace:olli_name,version:c,pad:b,getVersion:function(){return""+c.maj+"."+c.min+"."+b(c.build,4)},fn:d,loop:e};return f}),function(a,b,c){var d=_namespace(a,b);d.extend(c(d))}(this,olli_name,function(){function a(){if(!e){e=!0;for(var a=0;a<d.length;a++)d[a].fn.call(window,d[a].ctx);d=[]}}function b(){"complete"===document.readyState&&a()}function c(c,g){return e?void setTimeout(function(){c(g)},1):(d.push({fn:c,ctx:g}),void("complete"===document.readyState||!document.attachEvent&&"interactive"===document.readyState?setTimeout(a,1):f||(document.addEventListener?(document.addEventListener("DOMContentLoaded",a,!1),window.addEventListener("load",a,!1)):(document.attachEvent("onreadystatechange",b),window.attachEvent("onload",a)),f=!0)))}var d=[],e=!1,f=!1,g={docReady:c};return g}),function(a,b,c){var d=_namespace(a,b);d.extend(c(d))}(this,olli_name,function(a,b){var c,d=window,e=/[^\.]*(?=\..*)\.|.*/,f=/\..*/,g="addEventListener",h="removeEventListener",i=document||{},j=i.documentElement||{},k=j[g],l=k?g:"attachEvent",m={},n=Array.prototype.slice,o=function(a,b){return a.split(b||" ")},p=function(a){return"string"==typeof a},q=function(a){return"function"==typeof a},r="click dblclick mouseup mousedown contextmenu mousewheel mousemultiwheel DOMMouseScroll mouseover mouseout mousemove selectstart selectend keydown keypress keyup orientationchange focus blur change reset select submit load unload beforeunload resize move DOMContentLoaded readystatechange message error abort scroll ",s="show input invalid touchstart touchmove touchend touchcancel gesturestart gesturechange gestureend textinput readystatechange pageshow pagehide popstate hashchange offline online afterprint beforeprint dragstart dragenter dragover dragleave drag drop dragend loadstart progress suspend emptied stalled loadmetadata loadeddata canplay canplaythrough playing waiting seeking seeked ended durationchange timeupdate play pause ratechange volumechange cuechange checking noupdate downloading cached updateready obsolete ",t=function(a,b,c){for(c=0;c<b.length;c++)b[c]&&(a[b[c]]=1);return a}({},o(r+(k?s:""))),u=function(){var a="compareDocumentPosition"in j?function(a,b){return b.compareDocumentPosition&&16===(16&b.compareDocumentPosition(a))}:"contains"in j?function(a,b){return b=9===b.nodeType||b===window?j:b,b!==a&&b.contains(a)}:function(a,b){for(;a=a.parentNode;)if(a===b)return 1;return 0},b=function(b){var c=b.relatedTarget;return c?c!==this&&"xul"!==c.prefix&&!/document/.test(this.toString())&&!a(c,this):null==c};return{mouseenter:{base:"mouseover",condition:b},mouseleave:{base:"mouseout",condition:b},mousewheel:{base:/Firefox/.test(navigator.userAgent)?"DOMMouseScroll":"mousewheel"}}}(),v=function(){var a=o("altKey attrChange attrName bubbles cancelable ctrlKey currentTarget detail eventPhase getModifierState isTrusted metaKey relatedNode relatedTarget shiftKey srcElement target timeStamp type view which propertyName"),b=a.concat(o("button buttons clientX clientY dataTransfer fromElement offsetX offsetY pageX pageY screenX screenY toElement")),c=b.concat(o("wheelDelta wheelDeltaX wheelDeltaY wheelDeltaZ axis")),e=a.concat(o("char charCode key keyCode keyIdentifier keyLocation location")),f=a.concat(o("data")),g=a.concat(o("touches targetTouches changedTouches scale rotation")),h=a.concat(o("data origin source")),k=a.concat(o("state")),l=/over|out/,m=[{reg:/key/i,fix:function(a,b){return b.keyCode=a.keyCode||a.which,e}},{reg:/click|mouse(?!(.*wheel|scroll))|menu|drag|drop/i,fix:function(a,c,d){return c.rightClick=3===a.which||2===a.button,c.pos={x:0,y:0},a.pageX||a.pageY?(c.clientX=a.pageX,c.clientY=a.pageY):(a.clientX||a.clientY)&&(c.clientX=a.clientX+i.body.scrollLeft+j.scrollLeft,c.clientY=a.clientY+i.body.scrollTop+j.scrollTop),l.test(d)&&(c.relatedTarget=a.relatedTarget||a[("mouseover"==d?"from":"to")+"Element"]),b}},{reg:/mouse.*(wheel|scroll)/i,fix:function(){return c}},{reg:/^text/i,fix:function(){return f}},{reg:/^touch|^gesture/i,fix:function(){return g}},{reg:/^message$/i,fix:function(){return h}},{reg:/^popstate$/i,fix:function(){return k}},{reg:/.*/,fix:function(){return a}}],n={},p=function(a,b,c){if(arguments.length&&(a=a||((b.ownerDocument||b.document||b).parentWindow||d).event,this.originalEvent=a,this.isNative=c,this.isBean=!0,a)){var e,f,g,h,i,j=a.type,k=a.target||a.srcElement;if(this.target=k&&3===k.nodeType?k.parentNode:k,c){if(i=n[j],!i)for(e=0,f=m.length;f>e;e++)if(m[e].reg.test(j)){n[j]=i=m[e].fix;break}for(h=i(a,this,j),e=h.length;e--;)!((g=h[e])in this)&&g in a&&(this[g]=a[g])}}};return p.prototype.preventDefault=function(){this.originalEvent.preventDefault?this.originalEvent.preventDefault():this.originalEvent.returnValue=!1},p.prototype.stopPropagation=function(){this.originalEvent.stopPropagation?this.originalEvent.stopPropagation():this.originalEvent.cancelBubble=!0},p.prototype.stop=function(){this.preventDefault(),this.stopPropagation(),this.stopped=!0},p.prototype.stopImmediatePropagation=function(){this.originalEvent.stopImmediatePropagation&&this.originalEvent.stopImmediatePropagation(),this.isImmediatePropagationStopped=function(){return!0}},p.prototype.isImmediatePropagationStopped=function(){return this.originalEvent.isImmediatePropagationStopped&&this.originalEvent.isImmediatePropagationStopped()},p.prototype.clone=function(a){var b=new p(this,this.element,this.isNative);return b.currentTarget=a,b},p}(),w=function(a,b){return k||b||a!==i&&a!==d?a:j},x=function(){var a=function(a,b,c,d){var e=function(c,e){return b.apply(a,d?n.call(e,c?0:1).concat(d):e)},f=function(c,d){return b.__beanDel?b.__beanDel.ft(c.target,a):d},g=c?function(a){var b=f(a,this);return c.apply(b,arguments)?(a&&(a.currentTarget=b),e(a,arguments)):void 0}:function(a){return b.__beanDel&&(a=a.clone(f(a))),e(a,arguments)};return g.__beanDel=b.__beanDel,g},b=function(b,c,d,e,f,g,h){var i,j=u[c];"unload"==c&&(d=C(D,b,c,d,e)),j&&(j.condition&&(d=a(b,d,j.condition,g)),c=j.base||c),this.isNative=i=t[c]&&!!b[l],this.customType=!k&&!i&&c,this.element=b,this.type=c,this.original=e,this.namespaces=f,this.eventType=k||i?c:"propertychange",this.target=w(b,i),this[l]=!!this.target[l],this.root=h,this.handler=a(b,d,null,g)};return b.prototype.inNamespaces=function(a){var b,c,d=0;if(!a)return!0;if(!this.namespaces)return!1;for(b=a.length;b--;)for(c=this.namespaces.length;c--;)a[b]==this.namespaces[c]&&d++;return a.length===d},b.prototype.matches=function(a,b,c){return!(this.element!==a||b&&this.original!==b||c&&this.handler!==c)},b}(),y=function(){var a={},b=function(c,d,e,f,g,h){var i=g?"r":"$";if(d&&"*"!=d){var j,k=0,l=a[i+d],m="*"==c;if(!l)return;for(j=l.length;j>k;k++)if((m||l[k].matches(c,e,f))&&!h(l[k],l,k,d))return}else for(var n in a)n.charAt(0)==i&&b(c,n.substr(1),e,f,g,h)},c=function(b,c,d,e){var f,g=a[(e?"r":"$")+c];if(g)for(f=g.length;f--;)if(!g[f].root&&g[f].matches(b,d,null))return!0;return!1},d=function(a,c,d,e){var f=[];return b(a,c,d,null,e,function(a){return f.push(a)}),f},e=function(b){var c=!b.root&&!this.has(b.element,b.type,null,!1),d=(b.root?"r":"$")+b.type;return(a[d]||(a[d]=[])).push(b),c},f=function(c){b(c.element,c.type,null,c.handler,c.root,function(b,c,d){return c.splice(d,1),b.removed=!0,0===c.length&&delete a[(b.root?"r":"$")+b.type],!1})},g=function(){var b,c=[];for(b in a)"$"==b.charAt(0)&&(c=c.concat(a[b]));return c};return{has:c,get:d,put:e,del:f,entries:g}}(),z=function(a){c=arguments.length?a:i.querySelectorAll?function(a,b){return b.querySelectorAll(a)}:function(){throw new Error("Bean: No selector engine installed")}},A=function(a,b){if(k||!b||!a||a.propertyName=="_on"+b){var c=y.get(this,b||a.type,null,!1),d=c.length,e=0;for(a=new v(a,this,!0),b&&(a.type=b);d>e&&!a.isImmediatePropagationStopped();e++)c[e].removed||c[e].handler.call(this,a)}},B=k?function(a,b,c){a[c?g:h](b,A,!1)}:function(a,b,c,d){var e;c?(y.put(e=new x(a,d||b,function(b){A.call(a,b,d)},A,null,null,!0)),d&&null==a["_on"+d]&&(a["_on"+d]=0),e.target.attachEvent("on"+e.eventType,e.handler)):(e=y.get(a,d||b,A,!0)[0],e&&(e.target.detachEvent("on"+e.eventType,e.handler),y.del(e)))},C=function(a,b,c,d,e){return function(){d.apply(this,arguments),a(b,c,e)}},D=function(a,b,c,d){var e,g,h=b&&b.replace(f,""),i=y.get(a,h,null,!1),j={};for(e=0,g=i.length;g>e;e++)c&&i[e].original!==c||!i[e].inNamespaces(d)||(y.del(i[e]),!j[i[e].eventType]&&i[e][l]&&(j[i[e].eventType]={t:i[e].eventType,c:i[e].type}));for(e in j)y.has(a,j[e].t,null,!1)||B(a,j[e].t,!1,j[e].c)},E=function(a,b){var d=function(b,d){for(var e,f=p(a)?c(a,d):a;b&&b!==d;b=b.parentNode)for(e=f.length;e--;)if(f[e]===b)return b},e=function(a){var c=d(a.target,this);c&&b.apply(c,arguments)};return e.__beanDel={ft:d,selector:a},e},F=k?function(a,b,c){var e=i.createEvent(a?"HTMLEvents":"UIEvents");e[a?"initEvent":"initUIEvent"](b,!0,!0,d,1),c.dispatchEvent(e)}:function(a,b,c){c=w(c,a),a?c.fireEvent("on"+b,i.createEventObject()):c["_on"+b]++},G=function(a,b,c){var d,g,h,i,j=p(b);if(j&&b.indexOf(" ")>0){for(b=o(b),i=b.length;i--;)G(a,b[i],c);return a}if(g=j&&b.replace(f,""),g&&u[g]&&(g=u[g].base),!b||j)(h=j&&b.replace(e,""))&&(h=o(h,".")),D(a,g,c,h);else if(q(b))D(a,null,b);else for(d in b)b.hasOwnProperty(d)&&G(a,d,b[d]);return a},H=function(a,d,g,h){var i,j,k,p,r,s,t;{if(g!==b||"object"!=typeof d){for(q(g)?(r=n.call(arguments,3),h=i=g):(i=h,r=n.call(arguments,4),h=E(g,i,c)),k=o(d),this===m&&(h=C(G,a,d,h,i)),p=k.length;p--;)t=y.put(s=new x(a,k[p].replace(f,""),h,i,o(k[p].replace(e,""),"."),r,!1)),s[l]&&t&&B(a,s.eventType,!0,s.customType);return a}for(j in d)d.hasOwnProperty(j)&&H.call(this,a,j,d[j])}},I=function(a,b,c,d){return H.apply(null,p(c)?[a,c,b,d].concat(arguments.length>3?n.call(arguments,5):[]):n.call(arguments))},J=function(){return H.apply(m,arguments)},K=function(a,b,c){var d,g,h,i,j,k=o(b);for(d=k.length;d--;)if(b=k[d].replace(f,""),(i=k[d].replace(e,""))&&(i=o(i,".")),i||c||!a[l])for(j=y.get(a,b,null,!1),c=[!1].concat(c),g=0,h=j.length;h>g;g++)j[g].inNamespaces(i)&&j[g].handler.apply(a,c);else F(t[b],b,a);return a},L=function(a,b,c){for(var d,e,f=y.get(b,c,null,!1),g=f.length,h=0;g>h;h++)f[h].original&&(d=[a,f[h].type],(e=f[h].handler.__beanDel)&&d.push(e.selector),d.push(f[h].original),H.apply(null,d));return a},M={on:H,add:I,one:J,off:G,remove:G,clone:L,fire:K,Event:v,setSelectorEngine:z};if(d.attachEvent){var N=function(){var a,b=y.entries();for(a in b)b[a].type&&"unload"!==b[a].type&&G(b[a].element,b[a].type);d.detachEvent("onunload",N),d.CollectGarbage&&d.CollectGarbage()};d.attachEvent("onunload",N)}return z(),M}),function(a,b,c){var d=_namespace(a,b);d.extend(c(d))}(this,olli_name,function(a){x=classie;var b=function(a,b){return x.has(a,b)},c=function(a,b){x.add(a,b)},d=function(a,b){x.remove(a,b)},e=function(a,b){x.toggle(a,b)},f={hasClass:b,addClass:a.fn.bind(a,c),remClass:a.fn.bind(a,d),toggleClass:a.fn.bind(a,e)};return f});