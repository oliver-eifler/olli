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
        $this->data['modified'] = filemtime($file);
        $h= file_get_contents($file);

        $regex = "%/?images/(.*?)\.(jpe?g|png|gif|svg)%i";
        $h = preg_replace_callback($regex,"self::mod_imagepath",$h);
        /*Magic: Extract data*/
        $regex = "%\[m\:(.*?)\](.*?)\[\/m\]%i";
        $h = preg_replace_callback($regex,"self::magic_meta",$h);

        //$this->html.="<p><h3>Data</h3>".print_r($this->data,true)."</p>";

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
    private function magic_meta($matches)
    {
        $this->data[$matches[1]] = $matches[2];
        return "";
    }
}
?>
