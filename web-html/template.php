<?php
header("Content-Type: text/html; charset=utf-8");
require_once 'php/faker/autoload.php';
$faker = Faker\Factory::create('olli');
$faker->realTextInit('_assets/text/anhalter.txt');
  $cssupdate = filemtime("css/styles.css");
  $cssfile ="/css/styles_".$cssupdate.".css";
  $jsupdate = filemtime("js/init.js");
  $jsfile ="/js/init_".$jsupdate.".js";
  $svgupdate = filemtime("img/icons.svg");
  $svgfile ="/img/icons_".$svgupdate.".svg";
  /*
  $html.=     "<li><a ".(($clean_uri == "/")?"class='cur' ":"")."href='/' title='Home'>Home</a></li>";
  $html.=     "<li><a ".(($clean_uri == "/articles")?"class='cur' ":"")."href='/articles' title='Articles'>Articles</a></li>";
  $html.=     "<li><a ".(($clean_uri == "/about")?"class='cur' ":"")."href='/about' title='About'>About</a></li>";
  $html.=     "<li><a ".(($clean_uri == "/contact")?"class='cur' ":"")."href='/contact' title='Contact'>Contact</a></li>";
  */
    $page_links = array(
        array("title" => "Home"         ,"href" => "/"          ),
        array("title" => "Articles"     ,"href" => "/articles"  ),
        array("title" => "About"        ,"href" => "/about"     ),
        array("title" => "Contact"      ,"href" => "/contact"   )
    );
/*
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--github' href='#' title='Github'><svg><use xlink:href='#icon-github'></use></svg><em>Github</em></a></li>";
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--codepen' href='#' title='Codepen'><svg><use xlink:href='#icon-codepen'></use></svg><em>Codepen</em></a></li>";
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--googleplus' href='#' title='Google+'><svg><use xlink:href='#icon-googleplus'></use></svg><em>Google+</em></a></li>";
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--facebook' href='#' title='Facebook'><svg><use xlink:href='#icon-facebook'></use></svg><em>Facebook</em></a></li>";
*/
    $social_links = array(
        array("title" => "Github"      ,"href" => "#","icon"=>"github"),
        array("title" => "Codepen"     ,"href" => "#","icon"=>"codepen"  ),
        array("title" => "Google+"     ,"href" => "#","icon"=>"googleplus"),
        array("title" => "Facebook"    ,"href" => "#","icon"=>"facebook"   )
    );
    $links=buildLinkList();



  $uri = $_SERVER['REQUEST_URI'];
  $uri = preg_replace('/\?.*/', '', $uri);
  $clean_uri = preg_replace('/\..*/', '', $uri);

  $file = $clean_uri;
  if (empty($file) || $file == "/" || $file=="/index")
        $file="/home";
  if ($file=="" || !file_exists("pages".$file.".html"))
  {
    header("HTTP/1.0 404 Not Found");
    error_page();
    exit();
  }
header("X-UA-Compatible: IE=edge");
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
        $entry = $default;
        $title = $link["title"];
        $icon = $link["icon"];

        $entry["type"] = "socialtext";
        $entry["ajax"] = "false";
        $entry["class"] = "";
        $entry["content"] = "<svg><use xlink:href='#icon-".$icon."'></use></svg>".$title;
        $entry["title"] = $title;
        $ret[] = $entry;
    }
    return $ret;
}
function getLinkList($type="main")
{
    global $uri;
    global $clean_uri;
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


        if ($clean_uri == $href)
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
function SiteHeader()
{
  global $uri;
  global $clean_uri;

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
  /*
  $html.=     "<li><a ".(($clean_uri == "/")?"class='cur' ":"")."href='/' title='Home'>Home</a></li>";
  $html.=     "<li><a ".(($clean_uri == "/articles")?"class='cur' ":"")."href='/articles' title='Articles'>Articles</a></li>";
  $html.=     "<li><a ".(($clean_uri == "/about")?"class='cur' ":"")."href='/about' title='About'>About</a></li>";
  $html.=     "<li><a ".(($clean_uri == "/contact")?"class='cur' ":"")."href='/contact' title='Contact'>Contact</a></li>";
  */
  $html.= getLinkList("main");
  $html.=   "</ul>";
  $html.= "</nav>";

  $html.= "<nav class='Header-social'> ";
  $html.=   "<p class='Header-social-tagline'>Follow me on:</p>";
  $html.=   "<ul class='SocialNav'> ";
  /*
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--github' href='#' title='Github'><svg><use xlink:href='#icon-github'></use></svg><em>Github</em></a></li>";
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--codepen' href='#' title='Codepen'><svg><use xlink:href='#icon-codepen'></use></svg><em>Codepen</em></a></li>";
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--googleplus' href='#' title='Google+'><svg><use xlink:href='#icon-googleplus'></use></svg><em>Google+</em></a></li>";
  $html.=     "<li><a class='SocialNav-icon SocialNav-icon--facebook' href='#' title='Facebook'><svg><use xlink:href='#icon-facebook'></use></svg><em>Facebook</em></a></li>";
  */
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
  $html.=   "<aside class='Sheet-item Footer Footer--info'>";
  $html.=     "<ul><li>HTTP_MOD_DEFLATE: ".$_SERVER['HTTP_MOD_DEFLATE']."</li>";
  $html.=     "<li>HTTP_MOD_REWRITE: ".$_SERVER['HTTP_MOD_REWRITE']."</li>";
  $html.=     "<li>REDIRECT_STATUS: ".(isset($_SERVER['REDIRECT_STATUS'])?$_SERVER['REDIRECT_STATUS']:"200")."</li>";

  $uri = $_SERVER['REQUEST_URI'];
  $i=0;
  foreach($_GET as $k => $v)
  {
        if (!$i)
            $uri.= " =>GET:";
        $uri .= " ".$k."=".$v;
        $i++;
  }
  $html.=     "<li>REQUEST URI: ".$uri."</li>";

  $html.=     "</ul>";


  $html.=   "</aside>";
  $html.=   "<p>Site links</p>";
  $html.=   "<nav class='Sheet-item Footer Footer--nav'>";
  $html.=   "<ul>";
  $html.= getLinkList("main");
  $html.=   "</ul>";
  $html.=   "<ul> ";
  $html.= getLinkList("socialtext");
  $html.=   "</ul>";
  $html.=   "<ul>";
  $html.=     "<li><a href='/impressum' title='Impressum'>Impressum</a></li>";
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
function linkTest()
{
    global $faker;
    $text = $faker->realText(600,2);
    $ar = explode(" ",$text);
    for ($i=0;$i<10;$i++)
    {
        $idx = $faker->numberBetween(1,count($ar)-1);
        $word = $ar[$idx];
        $ar[$idx] = "<a href='#'>".$word."</a>";
    }
    return implode(" ",$ar);
}
function SiteContent($p=1)
{
  global $uri;
  global $clean_uri;
  $file = $clean_uri;
  if (empty($file) || $file == "/" || $file=="/index")
        $file="/home";

  $html = "";
  $html.="<article class='Sheet Site-content'>";
  $html.=  "<aside class='Sheet-item'>";
  $html.=    "<h2>DEBUG</h2>";
  $html.=    "<ul>";
  $html.=      "<li>uri: ".$uri."</li>";
  $html.=      "<li>clean uri: ".$clean_uri."</li>";
  $html.=      "<li>file: pages".$file.".html</li>";
  $html.=    "</ul>";
  $html.=  "</aside>";


  if ($file!="" && file_exists("pages".$file.".html"))
  {
        $h= file_get_contents("pages".$file.".html");
        //$h = str_replace(array("/images/"), '/pages/images/', $h);
        $regex = "%/?images/(.*?)\.(jpe?g|png|gif|svg)%i";

        $h = preg_replace_callback($regex,"mod_imagepath",$h);

        $html.=$h;




  }
  else
        $html.= contentdemo($clean_uri);
  $html.="</article>";
  return $html;
}
function mod_imagepath($matches)
{
   $path = 'pages/images/'.$matches[1];
   $ext = '.'.$matches[2];
   $update = filemtime($path.$ext);
   if ($update === FALSE)
     return "/img/baselope.png";
   return "/".$path."_".$update.$ext;
}
function base62($num) {
  $index = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $res = '';
  do {
    $res = $index[$num % 62] . $res;
    $num = intval($num / 62);
  } while ($num);
  return $res;
}
function contentdemo($title)
{
  global $faker;
  $p=1;
  $html = "";
  //$html.="<article class='Sheet Site-content'>";
  $html.=  "<header class='Sheet-item content content--header'>";
  $html.=    "<h1>".$title." - ".$faker->catchPhrase."</h1>";
  $html.=    "<p class='content-description'>".$faker->realText(80,2)."</p>";
  $html.=  "</header>";
  $html.=  "<section class='Sheet-item content content--entry'>";
  $html.=  "<p>".linkTest()."</p>";
           for ($i=0;$i<$p;$i++)
           {
              if ($i!=0)
               $html.= "<h2>".$faker->catchPhrase."</h2>";
             for ($j=0;$j<$faker->numberBetween(1,5);$j++)
               $html.= "<p>".$faker->realText($faker->numberBetween(200,1200),2)."</p>";
           }
  $html.=  "</section>";
  $html.=  "<aside class='Sheet-item content content--aside'>";
             $html.= "<h2>".$faker->catchPhrase."</h2>";
             $html.= "<p>".$faker->realText($faker->numberBetween(200,1200),2)."</p>";
  $html.=  "</aside>";
  //$html.="</article>";
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
  //Produce Error
  $html.=  "<script src='js/error.js'></script>";
  return $html;
}

function HTMLHeader()
{
  $html = "";
  $html.= "<head>";
  $html.=   "<meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=yes'>";
  $html.=   "<meta name='format-detection' content='telephone=no'/>";
  $html.=   "<title>Olli's Lab</title>";
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
  $html.=         "<p>Some aditional Info</p>";
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