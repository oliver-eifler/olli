/* THE FINAl APP */
(function (root, ns, factory) {
    var lib = _namespace(root,ns);
    factory(lib);
}(this,olli_name,function ($,undefined) {

var _self = this;
    var ready = function()
    {
        $.on(_body,'click.ajax','a',function(e){
            loadpage(e.currentTarget,e) && e.stop();
        });
        visitedLinks();
    };
    var loadpage = function(link,event) {
      if (link.host == window.location.host && link.pathname != window.location.pathname)
      {
        href = link.getAttribute("href");
        alert("loading "+href+ "via ajax");
        _root.location = href;
        $.loop(_$$('a'),function(el){
          if (el.getAttribute("href") == href)
            $.addClass(el,"cur");
          else
            $.remClass(el,"cur");
        });
      return true;
      }
      return false; //continue default
    }
    var cleanuri = function(path)
    {
        //path = path.split("?")[0];
        path = path.split("#")[0];
        return path;
    }
    var visitedLinks = function()
    {
    // http://joelcalifa.com/blog/revisiting-visited
        localStorage.setItem('visited-'+window.location.pathname.toLowerCase(),true);
        var links = document.getElementsByTagName('a');
        for (i=0;i<links.length;i++)
        {
            var link = links[i];
            if (link.host != window.location.host)
                continue;
            if (olli.hasClass(link,"btn"))
                continue;
            if (link.href.indexOf('#') !== -1 && link.pathname.toLowerCase() == window.location.pathname.toLowerCase())
                continue;
            if (localStorage.getItem('visited-' + link.pathname.toLowerCase())) {
                link.setAttribute('visited','');
            }
        }
    }

$.docReady(ready);
}));
