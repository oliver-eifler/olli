/**
 * Olli Framework
 * This file is part of the Olli-Framework
 * Copyright (c) 2012-2015 Oliver Jean Eifler
 *
 * @version 0.0.1
 * @link http://www.oliver-eifler.info/
 * @author Oliver Jean Eifler <oliver.eifler@gmx.de>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * Init Olli Library ;)
 */
(function (root, ns, factory) {
    var lib = _namespace(root,ns);
    lib.extend(factory(lib));
}(this,olli_name,function (_lib,undefined) {

var _self = this
    ,ver={maj:0,min:1,build:1}
    ,domwrap = function(fn) {
        /* ollis bitterböser wrapper für dom.elemente */
        var args = [];
        for (var i = 1;i<arguments.length;i++)
            args.push(arguments[i]);
        var el = args[0];
        if (_isArray(el))
        {
            for (var i = 0, n = el.length; i < n; i++)
            {
                args[0] = el[i];
                fn.apply(this,args);
            }
        }
        else
          fn.apply(this,args);
        return _lib;
    }
    //usage = func: _lib.fn.bind(_lib,element-func)

    ,domloop = function(el,fn) {
        if (_isArray(el))
        {
            for (var i = 0, n = el.length; i < n; i++)
            {
                if (fn.call(this,el[i],i,el) === false)
                    return;
            }
        }
        else
          fn.call(this,el,0,null);
    };

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}//export functions
var exp = {
  namespace: olli_name
  ,version: ver
  ,pad: pad
  ,getVersion: function() {return ""+ver.maj+"."+ver.min+"."+pad(ver.build,4);}
  ,fn: domwrap
  ,loop: domloop
}
return exp;
}));
/*
(function (root, ns, factory) {
    var lib = _namespace(root,olli_name);
    var module = _namespace(olli_name,ns);
    module.extend(factory(lib,module));
}(this,"module",function (lib,module,undefined) {


//export functions
var exp = {
  version:"0.0.1",
  test: function(){console.log("olli-module");}
}
return exp;
}));
*/