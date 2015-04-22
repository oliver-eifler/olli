<?php
if (preg_match("/^(.*)\.(js|css|png|jpg|gif|svg)$/i",$_SERVER['REQUEST_URI']))
{
    $host  = $_SERVER['HTTP_HOST'];
    if (preg_match("/^(.*)\.(png|jpg|gif)$/i",$_SERVER['REQUEST_URI']))
    {
        header('Content-type: image/png',true,200);
        echo file_get_contents("img/baselope.png");
        exit();
    }
    if (preg_match("/^(.*)\.(svg)$/i",$_SERVER['REQUEST_URI']))
    {
        header('Content-type: image/svg+xml',true,200);
        echo file_get_contents("img/lab.svg");
        exit();
    }
    if (preg_match("/^(.*)\.(js)$/i",$_SERVER['REQUEST_URI']))
    {
        header ('Content-type: text/javascript',true,200);
        echo "/* Nothing here */";
        exit();
    }
    if (preg_match("/^(.*)\.(css)$/i",$_SERVER['REQUEST_URI']))
    {
        header ('Content-type: text/css',true,200);
        echo "/* Nothing here */";
        exit();
    }
}
include 'template.php';
?>