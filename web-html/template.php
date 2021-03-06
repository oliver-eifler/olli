<?php
  require_once("php/config.php");
  require_once("php/page.php");
  if (isset($_GET['json']) || ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ))
  {
     sendJSONPage();
     exit();
  }
  /* for debug only*/
  $useJS = true;

  $cssupdate = filemtime("css/styles.css");
  $cssfile ="/css/styles_".$cssupdate.".css";
  $jsupdate = filemtime("js/init.js");
  $jsfile ="/js/init_".$jsupdate.".js";
  $svgupdate = filemtime("img/icons.svg");
  $svgfile ="/img/icons_".$svgupdate.".svg";
  $cachecss = (isset($_COOKIE["css"]) && $_COOKIE["css"] == $cssfile);
  $cachecss = false;

    $page_links = array(
        array("title" => "Home"         ,"href" => "/"          ),
        array("title" => "Articles"     ,"href" => "/articles"  ),
        array("title" => "About"        ,"href" => "/about"     ),
        array("title" => "test"        ,"href" => "/foobar"     ),
        array("title" => "Contact"      ,"href" => "/contact"   )
    );
    $social_links = array(
        array("title" => "Github"      ,"href" => "#","icon"=>"github"),
        array("title" => "Codepen"     ,"href" => "#","icon"=>"codepen"  ),
        array("title" => "Google+"     ,"href" => "#","icon"=>"googleplus"),
        array("title" => "Facebook"    ,"href" => "#","icon"=>"facebook"   )
    );
    $links=buildLinkList();
    $links[] = array("type"=>"misc","ajax"=>true,"title" => "Impressum","content" => "Impressum","href" => "/impressum","class"=>"");

  sendHTMLPage();
exit();
function sendJSONPage()
{
  $page = Page::getInstance();
  $error = $page->getError();
  $json = array();
  $json['error']    = $error;
  $json['uri']      = $page->uri;
  $json['uricmd']   = $page->uri_cmd;
  if (!$error) {
    $json['title']    = $page->getPreparedTitle();
    $json['scripts']  = $page->scripts;
    $json['content']  = SiteContent();
    $json['bc']       = breadcrumbs();
  }
  else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  }

  header("Content-type: application/json; charset=utf-8");
  echo json_encode($json);
}
function sendHTMLPage()
{
  $page = Page::getInstance();

  header("Content-Type: text/html; charset=utf-8");
  header("X-UA-Compatible: IE=edge");
  header("X-Powered-By: Olli PHP Framework");
  if ($page->getError())
  {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    error_page();
    exit();
  }
  $modified = max($page->getData('modified'),filemtime('template.php'));
  $status = 200;
  //if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $modified)
  //  $status = 304;
  header ("Last-Modified: ".gmdate("D, d M Y H:i:s", $modified )." GMT",true,$status);
  echo HTML();
}
function get_request_url()
{
    return get_request_scheme() . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function get_request_scheme()
{
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
}

/*Ü*/
function buildLinkList()
{
    global $page_links,$social_links;
    $ret = array();
    $default = array("type"=>"main","ajax"=>false,"title" => "???","content" => "???","href" => "/","class"=>"");

    foreach($page_links as $link)
    {
        $title = $link["title"];
        $href = $link["href"];
        $entry = $default;
        $entry["type"] = "main";
        $entry["ajax"] = true;
        $entry["content"] = $title;
        $entry["title"] = $title;
        $entry["href"] = $href;
        $ret[] = $entry;
    }
    foreach($social_links as $link)
    {
        $icon = $link["icon"];
        $title = $link["title"];
        $href = $link["href"];

        $entry = $default;
        $entry["type"] = "socialicon";
        $entry["ajax"] = false;
        $entry["class"] = "SocialNav-icon SocialNav-icon--".$icon;
        $entry["content"] = "<svg width='16' height='16'><use xlink:href='#icon-".$icon."'></use></svg><em>".$title."</em>";
        $entry["title"] = $title;
        $entry["href"] = $href;
        $ret[] = $entry;
    }
    foreach($social_links as $link)
    {
        $title = $link["title"];
        $icon = $link["icon"];
        $href = $link["href"];

        $entry = $default;
        $entry["type"] = "socialtext";
        $entry["ajax"] = false;
        $entry["class"] = "";
        $entry["content"] = "<svg width='16' height='16'><use xlink:href='#icon-".$icon."'></use></svg>".$title;
        $entry["title"] = $title;
        $entry["href"] = $href;
        $ret[] = $entry;
    }
    return $ret;
}
function getLinkList($type="main")
{
    $page = Page::getInstance();
    global $links;

    $html = "";
    foreach($links as $link)
    {
        if ($type!="" && $type!= $link["type"])
            continue;
        $class = explode(" ",$link["class"]);
        $href = $link["href"];
        $title = $link["title"];
        $content = $link["content"];


        if ($href == $page->uri || $href == $page->uri_cmd)
            $class[] = "cur";

        $tag = "<a href='".$href."' title='".$title."'";
        if (!empty($class))
            $tag .= " class='".trim(implode(" ",$class))."'";
        if ($link["ajax"]==true)
            $tag .= " ajax";
        $tag.=">";
        $tag.= $content;
        $tag.="</a>";

        $html .= "<li>".$tag."</li>";
    }
    return $html;
}
function breadcrumbs($text = 'You are here: ', $sep = ' &raquo; ', $home = 'Home')
{
    $page = Page::getInstance();
    $cur_uri = $page->uri;
    //Use RDFa breadcrumb, can also be used for microformats etc.
    $bc     =   '<div xmlns:v="http://rdf.data-vocabulary.org/#" id="bc" class="Breadcrumbs">'.$text;
    //Get the website:
    $site   =   get_request_scheme() . '://' . $_SERVER['HTTP_HOST'];
    //Get all vars en skip the empty ones
    $crumbs =   array_filter( explode("/",$cur_uri));//$_SERVER["REQUEST_URI"]) );
    //Create the home breadcrumb
    $bc    .=   '<span typeof="v:Breadcrumb"><a href="'.$site.'" rel="v:url" property="v:title">'.$home.'</a></span>';
    //Count all not empty breadcrumbs
    $nm     =   count($crumbs);
    $i      =   1;
    //Loop the crumbs
    foreach($crumbs as $crumb)
    {
        //Make the link look nice
        if ($i==$nm)
            $link = $page->title;
        else
            $link    =  ucfirst( str_replace( array(".php","-","_"), array(""," "," ") ,$crumb) );
        //Loose the last seperator
        //$sep     =  $i==$nm?'':$sep;
        //Add crumbs to the root
        $site   .=  '/'.$crumb;
       //Make the next crumb
        $bc     .=  $sep.'<span typeof="v:Breadcrumb"><a href="'.$site.'" rel="v:url" property="v:title">'.$link.'</a></span>';
    $i++;
    }
    $bc .=  '</div>';
    return $bc;
}
function SiteHeader()
{
  $html = "";
  $html.="<div class='Site-header'>";
  $html.= "<header class='Header'>";

  $html.= "<div class='Header-info'>";
  $html.=   "<a class='Logo' title='Home' href='/'>";
  $html.=     "<div class='h1 Logo-title'>Oliver Jean Eifler</div>";
  $html.=     "<div class='Logo-tagline'>Programmierer Techniker Künstler</div>";
  $html.=   "</a>";
  $html.= "</div>";

  $html.= "<nav class='Header-nav'>";
  $html.=   "<ul class='MainNav'>";
  $html.= getLinkList("main");
  $html.=   "</ul>";
  $html.= "</nav>";

  $html.= "<nav class='Header-social'> ";
  $html.=   "<p class='Header-social-tagline'>Follow me on:</p>";
  $html.=   "<ul class='SocialNav'> ";
  $html.= getLinkList("socialicon");
  $html.=   "</ul>";
  $html.= "</nav>";
  $html.= "</header>";
  $html.="</div>";
  return $html;
}
function SiteInfo()
{
  $html ="";
  $html.=   "<p>Site links</p>";
  $html.=   "<nav class='Sheet-item Footer Footer--nav'>";
  $html.=   breadcrumbs();
  $html.=   "<div class='ident'>";
  $html.=   "<ul>";
  $html.= getLinkList("main");
  $html.=   "</ul>";
  $html.=   "<ul> ";
  $html.= getLinkList("socialtext");
  $html.=   "</ul>";
  $html.=   "<ul>";
  $html.= getLinkList("misc");
  $html.=   "</ul>";
  $html.=   "</div>";
  $html.=   "</nav>";
  return $html;
}
function SiteFooter()
{
  $fromYear = 2014;
  $thisYear = (int)date('Y');
  $Year = $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');
  $html ="";
  $html.=   "<footer class='Sheet-item Footer Footer--real'>";
  $html.=     "<p>";
  $html.=     "&copy; ".$Year." by <a href='#'>Oliver Jean Eifler</a> - <em>for internal use only</em><br>";
  $html.=     "<em><small>Except as otherwise noted, the content of this page is licensed under the Creative Commons Attribution 3.0 License, and code samples are licensed under the Apache 2.0 License.</small></em>";
  $html.=     "</p>";
  $html.=     "<p>".$_SERVER['SERVER_NAME']." is created, written, and maintained with care<sup>*</sup> by <a href='#'>Olli</a></p>";
  $html.=     "<p class='Footer-legende'><small>* Not recommended for or tested with IE &lt; 10 or any other legacy browser</small></p>";
  $html.=   "</footer>";

  return $html;
}
function SiteContent()
{
  $page = Page::getInstance();
  $class = array("Sheet","Site-content");
  if (!empty($page->cmd))
    $class[] = "Site-".$page->cmd;

  $html = "";//$page->debugData();
  $html.="<article id='content' class='".implode(" ",$class)."'".($page->getData("isArticle")?" itemscope itemtype='http://schema.org/BlogPosting'":"").">";
  //$html.=  $page->debugData();
  $html.=  $page->getHtml();
  $html.="</article>";
  return $html;
}
function PreLoad()
{
global $cssfile;
global $jsfile;
global $svgfile;
global $cachecss;
global $useJS;

  $html = "";
  $html.=  "<style type='text/css'>";
  $html.=    file_get_contents("css/inline.css");
  $html.=  "</style>";
  $html.=  "<!--[IF (!IE)|(IE 9)]> -->";		// ==> Code für andere Browser als IE < 9

  if ($useJS)
  {
    $html.=  "<script  type='text/javascript'>";
    $html.=    "var _cfg = {css:'".$cssfile."',svg:'".$svgfile."'};";
    $html.=    file_get_contents("js/inline.js");
    if (!$cachecss)
        $html.=    "loadCSS('".$cssfile."')";
    $html.=  "</script>";

    if (!$cachecss)
        $html.=  "<noscript><link rel='stylesheet' href='".$cssfile."'></noscript>";
    else
        $html.=  "<link rel='stylesheet' href='".$cssfile."'>";

    $html.=  "<script src='".$jsfile."'></script>";
  }
  else
  {
     $html.=  "<link rel='stylesheet' href='".$cssfile."'>";
  }

  $html.=  "<!-- <![ENDIF]-->";  // <== Code für andere Browser als IE < 9
  return $html;
}
function PostLoad()
{
global $cssfile;
global $jsfile;
global $svgfile;
global $useJS;
  if (!$useJS)
    return "";
  $page = Page::getInstance();

  $html = "";
  if (isset($page->scripts))
  {
    foreach($page->scripts as $src)
    {
      $html.=  "<script src='".$src."' async ajax='true'></script>";
    }
  }
  $arr = array(
       "@context"       => "http://schema.org",
       "@type"          => "WebSite",
       "name"           => "Oliver 'Jean' Eifler",
       "alternateName"  => "O.J.E. Blog",
       "url"            => "http://".$_SERVER["SERVER_NAME"]
       );
  $html.="<script type='application/ld+json'>".json_encode($arr)."</script>";
  $html.=  "<script src='/_assets/js/olli/olli.base.js'></script>";
  $html.=  "<script src='/_assets/js/olli/olli.lib.js'></script>";
  $html.=  "<script src='/_assets/js/olli/olli.helper.js'></script>";
  $html.=  "<script src='/_assets/js/olli/olli.ajax.js'></script>";
  $html.=  "<script src='/_assets/js/olli/olli.docready.js'></script>";
  $html.=  "<script src='/_assets/js/olli/olli.dom.js'></script>";
  $html.=  "<script src='/_assets/js/olli/olli.events.js'></script>";
  $html.=  "<script src='/_assets/js/olli/olli.classie.js'></script>";
  $html.=  "<script src='/_assets/js/app.js'></script>";
  return $html;
}

function HTMLHeader()
{
  $page = Page::getInstance();
  $title = htmlentities($page->getPreparedTitle(),ENT_QUOTES|ENT_HTML401);
  $desc = htmlentities($page->getPreparedDescription(),ENT_QUOTES|ENT_HTML401);
  $tags = htmlentities($page->getPreparedTags(),ENT_QUOTES|ENT_HTML401);

  $html = "";
  $html.= "<head>";
  if ($page->noindex)
    $html.= "<meta name='robots' content='noindex'>";
  if ($_SERVER["REQUEST_URI"] != $page->uri)
    $html="<link rel='canonical' href='".$page->uri."' />";
  $html.=   "<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes'>";
  $html.=   "<meta name='format-detection' content='telephone=no'/>";
  $html.=   "<title>".$title."</title>";
  $html.=   "<meta name=\"author\" content=\"Oliver Jean Eifler\" />";
  $html.=   "<meta name=\"description\" content=\"".$desc."\" />";
  $html.=   "<meta name=\"keywords\" content=\"".$tags."\" />";
  $html.= Favicons();
  $html.=   PreLoad();
  $html.= "</head>";
  return $html;
}
function Favicons()
{
  $html = "";
  $html.= "<link rel='apple-touch-icon' sizes='57x57' href='/app/apple-touch-icon-57x57.png'>";
  $html.= "<link rel='apple-touch-icon' sizes='60x60' href='/app/apple-touch-icon-60x60.png'>";
  $html.= "<link rel='apple-touch-icon' sizes='72x72' href='/app/apple-touch-icon-72x72.png'>";
  $html.= "<link rel='apple-touch-icon' sizes='76x76' href='/app/apple-touch-icon-76x76.png'>";
  $html.= "<link rel='apple-touch-icon' sizes='114x114' href='/app/apple-touch-icon-114x114.png'>";
  $html.= "<link rel='apple-touch-icon' sizes='120x120' href='/app/apple-touch-icon-120x120.png'>";
  $html.= "<link rel='icon' type='image/png' href='/app/favicon-32x32.png' sizes='32x32'>";
  $html.= "<link rel='icon' type='image/png' href='/app/favicon-96x96.png' sizes='96x96'>";
  $html.= "<link rel='icon' type='image/png' href='/app/favicon-16x16.png' sizes='16x16'>";
  $html.= "<link rel='manifest' href='/app/manifest.json'>";
  $html.= "<link rel='shortcut icon' href='/app/favicon.ico'>";
  $html.= "<meta name='msapplication-TileColor' content='#221144'>";
  $html.= "<meta name='msapplication-config' content='/app/browserconfig.xml'>";
  $html.= "<meta name='theme-color' content='#221144'>";
  return $html;
}
function HTMLBody()
{
  $html = "<body>";
  $html .= "<a id='STC' href='#content' rel='nofollow' title='Skip to content'>Skip to content</a>";

  $html.=   "<div id='Site' class='Site loading'>";

  $html.=     "<div class='Site-headerContainer'>";
  $html.=       SiteHeader();
  $html.=     "</div>";

  $html.=     "<div id='SCC' class='Site-contentContainer'>";
  $html.=       SiteContent(3);
  $html.=     "</div>";

  $html.=     "<div class='Site-footerContainer'>";
  $html.=       "<div class='Sheet Site-footer'>";
  $html.=         SiteInfo();
  $html.=         "<p>Now it's time for the real footer</p>";
  $html.=         SiteFooter();
  $html.=       "</div>";
  $html.=     "</div>";
  $html.=   "</div>";

  $html.= PostLoad();
  $html.= "</body>";

  return $html;
}
function HTML()
{
  $html = "<!DOCTYPE HTML>";
  /*
  if (isset($_COOKIE["class"]) && !empty($_COOKIE["class"]))
  {
    $html.= "<html  lang='de' class='no-js ".$_COOKIE["class"]." php'>";
  }
  else
  {
    $html.= "<!--[if lte IE 7]><html lang='de' class='no-js ie ie-7 no-flex'><![endif]-->";
    $html.= "<!--[if IE 8]><html lang='de' class='no-js ie ie-8 no-flex'><![endif]-->";
    $html.= "<!--[if IE 9]><html lang='de' class='no-js ie ie-9 no-flex'><![endif]-->";
    $html.= "<!--[if !IE]>--><html  lang='de' class='no-js no-ie'><!--<![endif]-->";
  }
  */
  $html.= "<html  lang='de' class='no-js no-ie'>";

  $html.= HTMLHeader();
  $html.= HTMLBody();
  $html.= "</html>";
  return $html;
}
function error_page()
{
  $html = "<!DOCTYPE HTML>";
  $html.= "<head>";
  $html.=   "<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes'>";
  $html.=   "<meta name='format-detection' content='telephone=no'/>";
  $html.=   "<title>Page Not Found</title>";
  $html.=  "<style type='text/css'>";
  $html.=    file_get_contents("css/404.css");
  $html.=  "</style>";
  $html.= "</head>";
  $html.= "<body>";
  $html.=  "<img src='img/yawn.png' alt=''>";
  $html.=  "<h1>Page Not Found</h1>";
  $html.=  "<p>Sorry, but the page you were trying to view does not exist.</p>";
  $html.=  "<p>&nbsp;</p>";
  $html.=  "<p>Maybe, you try it here:</p>";
  $html.=   "<ul>";
  $html.=   getLinkList("main");
  $html.=   "</ul>";
  $html.= "</body>";
  $html.= "</html>";
  $html.=  "<!-- IE needs 512+ bytes: http://blogs.msdn.com/b/ieinternals/archive/2010/08/19/http-error-pages-in-internet-explorer.aspx -->";

  echo $html;
}
/*
<iframe height='268' scrolling='no' src='//codepen.io/olli/embed/qEKMZm/?height=268&theme-id=0&default-tab=result' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%;'>See the Pen <a href='http://codepen.io/olli/pen/qEKMZm/'>Olli's canvas spinner animation</a> by Oliver Jean Eifler  (<a href='http://codepen.io/olli'>@olli</a>) on <a href='http://codepen.io'>CodePen</a>.
</iframe>



*/
?>