<?php
require_once('php/class/basepage.class.php');

class ContactPage extends BasePage
{
    protected function init()
    {
        $this->error = false;
        $this->noindex = true;
        $this->title="Contact Me";
        $this->description="Fill out and submit the form below and I’ll get back to you as soon as I can.";
        $this->html = $this->Html();
    }
    protected function Html()
    {
        $html = "";
        $html.="<header class='Sheet-item content content--header text-center'>";
        $html.=  "<h1 itemprop='headline'>".$this->title."</h1>";
        $html.=  "<p class='content-description'>".$this->description."</p>";
        $html.="</header>";
        $html.="<section class='Sheet-item content'>";
        $html.=  "<p class='text-center'>I’ll really try to get back to everyone, but sometimes it’s hard and I can’t guarantee anything.</p>";
        $html.= $this->Form();
        $html.=  "<p class='text-center'>I’ll really try to get back to everyone, but sometimes it’s hard and I can’t guarantee anything.</p>";
        $html.="</section>";
        return $html;
    }
    protected function Form()
    {
        $html = "";
        $html.="<form class='form'>";
        $html.="<fieldset class='form-group'>";
        $html.="<input class='form-control' type='text' id='name' required>";
        $html.="<label for='name'>your name</label>";
        $html.="</fieldset>";
        $html.="<fieldset class='form-group'>";
        $html.="<input class='form-control' type='text' id='email' required>";
        $html.="<label for='email'>your eMail</label>";
        $html.="</fieldset>";
        $html.=  "<p class='text-center'>I’ll really try to get back to everyone, but sometimes it’s hard and I can’t guarantee anything.</p>";
        $html.="<fieldset class='form-group'>";
        $html.="<textarea class='form-control' name='message' id='message' cols='20' rows='5' required></textarea>";
        $html.="<label for='message'>your message</label>";
        $html.="</fieldset>";
        $html.="</form>";

        return $html;
    }
}
?>
