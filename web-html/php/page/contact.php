<?php
require_once('php/class/basepage.class.php');

class ContactPage extends BasePage
{
    protected function init()
    {
        $this->error = false;
        $this->html="<h1>Olli's Contact Page</h1>";
        $this->title="Contact";
    }
}
?>
