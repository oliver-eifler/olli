<?php
  require_once("php/config.php");
  require_once("php/page.php");

  $cssupdate = filemtime("css/styles.css");
  $cssfile ="/css/styles_".$cssupdate.".css";
  $jsupdate = filemtime("js/init.js");
  $jsfile ="/js/init_".$jsupdate.".js";
  $svgupdate = filemtime("img/icons.svg");
  $svgfile ="/img/icons_".$svgupdate.".svg";

    $page_links = array(
        array("title" => "Home"         ,"href" => "/"          ),
        array("title" => "Articles"     ,"href" => "/articles"  ),
        array("title" => "About"        ,"href" => "/about"     ),
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

    $page = Page::getInstance();


  header("Content-Type: text/html; charset=utf-8");
  header("X-UA-Compatible: IE=edge");

  if ($page->getError())
  {
    header("HTTP/1.0 404 Not Found");
    error_page();
    exit();
  }
  $modified = max($page->getData('modified'),filemtime('template.php'));
  $status = 200;
  //if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $modified)
  //  $status = 304;

  header ("Last-Modified: ".gmdate("D, d M Y H:i:s", $modified )." GMT",true,$status);


echo HTML();
exit();

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
        $entry["ajax"] = "true";
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
        $entry["ajax"] = "false";
        $entry["class"] = "SocialNav-icon SocialNav-icon--".$icon;
        $entry["content"] = "<svg><use xlink:href='#icon-".$icon."'></use></svg><em>".$title."</em>";
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
        $entry["ajax"] = "false";
        $entry["class"] = "";
        $entry["content"] = "<svg><use xlink:href='#icon-".$icon."'></use></svg>".$title;
        $entry["title"] = $title;
        $entry["href"] = $href;
        $ret[] = $entry;
    }
    return $ret;
}
function getLinkList($type="main")
{
    $page = Page::getInstance();
    $base_uri = $page->getData("base_uri");
    $cur_uri = $page->getData("cur_uri");

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


        if ($base_uri == strtolower($title) || $cur_uri == $href)
            $class[] = "cur";

        $tag = "<a href='".$href."' title='".$title."'";
        if (!empty($class))
            $tag .= " class='".trim(implode(" ",$class))."'";
        if ($link["ajax"]==true)
            $tag .= " ajax='true'";
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
    $cur_uri = $page->getData("cur_uri");
    //Use RDFa breadcrumb, can also be used for microformats etc.
    $bc     =   '<div xmlns:v="http://rdf.data-vocabulary.org/#" id="crums" class="Breadcrumbs">'.$text;
    //Get the website:
    $site   =   (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    //Get all vars en skip the empty ones
    $crumbs =   array_filter( explode("/",$cur_uri));//$_SERVER["REQUEST_URI"]) );
    //Create the home breadcrumb
    $bc    .=   '<span typeof="v:Breadcrumb"><a href="'.$site.'" rel="v:url" property="v:title">'.$home.'</a>'.$sep.'</span>';
    //Count all not empty breadcrumbs
    $nm     =   count($crumbs);
    $i      =   1;
    //Loop the crumbs
    foreach($crumbs as $crumb)
    {
        //Make the link look nice
        if ($i==$nm)
            $link = $page->getData("title");
        else
            $link    =  ucfirst( str_replace( array(".php","-","_"), array(""," "," ") ,$crumb) );
        //Loose the last seperator
        $sep     =  $i==$nm?'':$sep;
        //Add crumbs to the root
        $site   .=  '/'.$crumb;
       //Make the next crumb
        $bc     .=  '<span typeof="v:Breadcrumb"><a href="'.$site.'" rel="v:url" property="v:title">'.$link.'</a>'.$sep.'</span>';
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
  $html.=     "<h1 class='Logo-title'>Oliver Jean Eifler</h1>";
  $html.=     "<p class='Logo-tagline'>Programmierer Techniker Künstler</p>";
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
  $html.=   "<aside class='Sheet-item Footer Footer--crumbs'>";
  $html.=   breadcrumbs();
  $html.=   "</aside>";
  $html.=   "<nav class='Sheet-item Footer Footer--nav'>";
  $html.=   "<ul>";
  $html.= getLinkList("main");
  $html.=   "</ul>";
  $html.=   "<ul> ";
  $html.= getLinkList("socialtext");
  $html.=   "</ul>";
  $html.=   "<ul>";
  $html.= getLinkList("misc");
  $html.=   "</ul>";
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
function SiteContent($p=1)
{
  $page = Page::getInstance();

  $html = "";
  $html.="<article class='Sheet Site-content' itemscope itemtype='http://schema.org/BlogPosting'>";
  $html.=  $page->getHtml();
  $html.="</article>";
  return $html;
}
function PreLoad()
{
global $cssfile;
global $jsfile;
global $svgfile;

  $html = "";
  $html.=  "<style type='text/css'>";
  $html.=    file_get_contents("css/inline.css");
  $html.=  "</style>";


  $html.=  "<script  type='text/javascript'>";
  $html.=    file_get_contents("js/inline.js");
  $html.=  "</script>";

  $html.=  "<noscript><link rel='stylesheet' href='".$cssfile."'></noscript>";
  $html.=  "<link rel='stylesheet' href='".$cssfile."'>";

  return $html;
}
function PostLoad()
{
global $cssfile;
global $jsfile;
global $svgfile;

  $html = "";
  $html.=  "<script  type='text/javascript'>";
  $html.=    "var _cfg = {css:'".$cssfile."',svg:'".$svgfile."'};";
  //$html.=    "loadCSS('".$cssfile."')";
  $html.=  "</script>";
  $html.=  "<script src='".$jsfile."' async></script>";
  $arr = array(
       "@context"       => "http://schema.org",
       "@type"          => "WebSite",
       "name"           => "Oliver 'Jean' Eifler",
       "alternateName"  => "O.J.E. Blog",
       "url"            => "http://".$_SERVER["SERVER_NAME"]
       );
  $html.="<script type='application/ld+json'>".json_encode($arr)."</script>";
  return $html;
}

function HTMLHeader()
{
  $page = Page::getInstance();
  /*
  $title = $page->getData("title");
  $title .= (!empty($title)? " || ":"")."Oliver Jean Eifler";
  $desc = (!empty($page->getData("desc"))?$page->getData("desc"):$title);
  $keywords = explode(",","oliver jean,eifler,web,development,blog");
  if (!empty($page->getData("tags")))
    $keywords = array_merge(explode(",",$page->getData("tags")),$keywords);
  foreach($keywords as $k => $v)
    $keywords[$k] = strtolower(trim($v));
  */
  $title = $page->getPreparedTitle();
  $desc = $page->getPreparedDescription();
  $tags = $page->getPreparedTags();


  $html = "";
  $html.= "<head>";
  $html.=   "<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes'>";
  $html.=   "<meta name='format-detection' content='telephone=no'/>";
  $html.=   "<title>".$title."</title>";
  $html.=   "<meta name=\"author\" content=\"Oliver Jean Eifler\" />";
  $html.=   "<meta name=\"description\" content=\"".$desc."\" />";
  $html.=   "<meta name=\"keywords\" content=\"".$tags."\" />";

  $html.=   PreLoad();
  $html.= "</head>";
  return $html;
}
function HTMLBody()
{
  $html = "<body>";
  $html.=   "<div class='Site'>";

  $html.=     "<div class='Site-headerContainer'>";
  $html.=       SiteHeader();
  $html.=     "</div>";

  $html.=     "<div class='Site-contentContainer'>";
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
  $html.= "<!--[if lte IE 7]><html lang='de' class='no-js ie ie-7 no-content no-flex'><![endif]-->";
  $html.= "<!--[if IE 8]><html lang='de' class='no-js ie ie-8 no-flex'><![endif]-->";
  $html.= "<!--[if IE 9]><html lang='de' class='no-js ie ie-9 no-flex'><![endif]-->";
  $html.= "<!--[if !IE]>--><html  lang='de' class='no-js no-ie'><!--<![endif]-->";
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
?>