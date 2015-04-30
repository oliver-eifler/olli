<?php
require_once('php/class/basepage.class.php');

class StaticPage extends BasePage
{
    protected function init()
    {
        $this->error = !$this->LoadPage($this->uri);
    }
    protected function LoadPage($uri)
    {
        $file = "pages".$uri.".html";
        if ($uri=="" || !file_exists($file))
        {
            $this->html="<h2>".$file." not found</h2>";
            return false;
        }
        $h= file_get_contents($file);
        $regex = "%/?images/(.*?)\.(jpe?g|png|gif|svg)%i";
        $h = preg_replace_callback($regex,"self::mod_imagepath",$h);
        /*Magic: Extract data*/
        $regex = "%\[title\](.*?)\[\/title\]%i";
        $h = preg_replace_callback($regex,"self::magic_title",$h);
        $this->html.=$h;
        return true;
    }
    private function mod_imagepath($matches)
    {
        $path = 'pages/images/'.$matches[1];
        $ext = '.'.$matches[2];
        $update = filemtime($path.$ext);
        if ($update === FALSE)
            return "/img/baselope.png";
        return "/".$path."_".$update.$ext;
    }
    private function magic_title($matches)
    {
        $this->title = $matches[1];
        return "";
    }
}
?>
