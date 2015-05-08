<?php
require_once('php/class/basepage.class.php');

class StaticPage extends BasePage
{
    protected function init()
    {
        $this->error = !$this->LoadPage($this->path);
    }
    protected function LoadPage($path)
    {
        $file = "pages".$path.".html";
        if ($path=="" || !file_exists($file))
        {
            $this->html="<h2>".$path." not found</h2>";
            return false;
        }
        $this->modified = filemtime($file);
        $h= file_get_contents($file);

        $regex = "%/?images/(.*?)\.(jpe?g|png|gif|svg)%i";
        $h = preg_replace_callback($regex,"self::mod_imagepath",$h);
        /*Magic: Extract data*/
        $regex = '%<script.*type=("|\')json("|\').*>(.*)</.*script>%i';
        $h = preg_replace_callback($regex,"self::magic_meta",$h);
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
        $meta = json_decode($matches[3]);
        foreach ($meta as $k => $v)
          $this->offsetSet($k,$v);
        return "";
    }
}
?>
