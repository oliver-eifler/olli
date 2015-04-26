<?php
require_once('php/class/basepage.class.php');

class ContactPage extends BasePage
{
    protected function init()
    {
        $this->error = !$this->LoadPage($this->uri);
    }
    protected function LoadPage($uri)
    {
        $this->html="<h1>Olli's Contact Page</h1>";
        return true;
    }
}
?>
