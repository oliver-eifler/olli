function loadCSS(a,b,c){var d=document,e=d.getElementsByTagName("script")[0],f=new XMLHttpRequest;f.open("GET",a,!0),f.onreadystatechange=function(){if(4==f.readyState&&200==f.status){var a=d.createElement("p");a.innerHTML='x<style type="text/css" media='+(c||"all")+">"+f.responseText+"</style>",e.parentNode.insertBefore(a.lastChild,e)}},f.send()}!function(){"hidden"in document.createElement("a")||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video".replace(/\w+/g,function(a){document.createElement(a)})}();