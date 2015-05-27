<?php
   $content = "";
   $content.=getHTTPHeaders();
   $json = array();
   $json['title'] = "[AJAX TEST PAGE]";
   $json['content'] = $content;
    header("X-Powered-By: Olli PHP Framework");
    header("Content-type: application/x-javascript");
    echo json_encode($json);
    exit();

function getHTTPHeaders()
{
    $html = "<section class='Sheet-item content'>";
    $html.= "<h2>Headers</h2>";
    $html.= "<ul>";

      foreach ($_SERVER as $name => $value)
      {
           if (substr($name, 0, 5) == 'HTTP_')
           {
               $html.="<li>".$name." = ".$value."</li>";
           }
       }
    $html.= "</ul>";
    $html.="</section>";
    return $html;
}
?>