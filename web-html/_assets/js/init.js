/* Init.js
init page async
#include components/modernizr-custom.js;
#include components/webfontloaderr.js;
*/
(function(w, d) {

  var m=Modernizr,c=[];

  //its ie
  if (typeof d.documentMode === "number")
  {
    c.push("ie");
    c.push("ie-"+d.documentMode);
  }
  else
    c.push("no-ie");

  c.push((((m.flexbox || m.flexboxlegacy ||m.flexboxtweener) && m.flexwrap)?"":"no-")+"flex");
  c.push(((m.inlinesvg && 'XMLHttpRequest' in w)?"":"no-")+"svg");
  c.push((isModernBrowser()?"":"no-")+"modern");

  setClasses(c);

  WebFont.load({
    classes: false,
    custom: {
      families: ['Roboto:n4','Roboto Slab:n4']
    },
    active: function() {classie.add(d.documentElement,"wf-loaded");},
    fontactive: function(familyName, fvd) {console.log("font: "+familyName+":"+fvd+" loaded..");}
  });
  if (m.inlinesvg && 'XMLHttpRequest' in w)
  {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", _cfg.svg, true);
    ajax.send();
    ajax.onerror = ajax.ontimeout = function() {noSVG(c);}
    ajax.onreadystatechange = function(e) {
      if (ajax.readyState === 4)
      {
        if (ajax.status >= 200 && ajax.status < 300 || ajax.status === 304)
        {
          var div = d.createElement("div");
          div.style.display='none';
          div.innerHTML = ajax.responseText;
          d.body.insertBefore(div, d.body.childNodes[0]);
        }
        else
        {
          noSVG(c);
        }
      }
    }
  }
  function setClasses(a)
  {
    d.documentElement.className =  "js "+c.join(" ");
    d.cookie = encodeURIComponent("class") + "=" + encodeURIComponent(c.join(" "));
  }
  function noSVG(a)
  {
      for (var i = 0, n = a.length; i < n; i++)
      {
        if (a[i]=="svg")
            a[i] = "no-svg";
      }
      setClasses(a);
 }
 function isModernBrowser()
 {
    return (m.json && m.history && 'XMLHttpRequest' in w && m.queryselector && m.es5array);
 }

})(this,this.document);