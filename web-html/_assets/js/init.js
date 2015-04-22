/* Init.js
init page async
#include components/modernizr-custom.js;
#include components/webfontloaderr.js;
*/
(function(w, d) {

  var m=Modernizr,c=['js'];
  //its ie
  if (typeof d.documentMode === "number")
    c.push("ie ie-"+d.documentMode);
  else
    c.push("no-ie");

  (!m.generatedcontent) && c.push("no-pseudo");
  //(!m.inlinesvg) && c.push("no-svg");
  c.push((((m.flexbox || m.flexboxlegacy ||m.flexboxtweener) && m.flexwrap)?"":"no-")+"flex");
  d.documentElement.className =  c.join(" ");

  WebFont.load({
    classes: false,
    custom: {
      families: ['Roboto:n4','Roboto Slab:n4']
    },
    active: function() {d.documentElement.className+=" wf-loaded";},
    fontactive: function(familyName, fvd) {console.log("font: "+familyName+":"+fvd+" loaded..");}
  });
  if (m.inlinesvg && 'XMLHttpRequest' in w)
  {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", _cfg.svg, true);
    ajax.send();
    ajax.onreadystatechange = function(e) {
    console.log("ajax-status: "+ajax.readyState+":"+ajax.status);
      if (ajax.readyState === 4 && (ajax.status >= 200 && ajax.status < 300 || ajax.status === 304))
      {
        var div = d.createElement("div");
        div.style.display='none';
        div.innerHTML = ajax.responseText;
        d.body.insertBefore(div, d.body.childNodes[0]);
        d.documentElement.className+=" svg";
      }
    }
  }

})(this,this.document);