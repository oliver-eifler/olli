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
        $html.=  "<h1>".$this->title."</h1>";
        $html.=  "<p class='content-description'>".$this->description."</p>";
        $html.="</header>";
        $html.="<section class='Sheet-item content'>";
        $html.= $this->Form();
        $html.="</section>";
        return $html;
    }
    protected function Form()
    {
        $html = "";
        $html.="<form class='form' action='#'>";
        $html.="<div class='form-row'>";
        $html.=  "<div class='form-group form-group--name'>";
        $html.=    "<input class='form-control' type='text' id='name' required placeholder='John Doe'>";
        $html.=    "<label for='name'>your name</label>";
        $html.=  "</div>";
        $html.=  "<div class='form-group form-group--email'>";
        $html.=    "<input class='form-control' type='email' id='email' placeholder='johndoe@foo.com' required>";
        $html.=    "<label for='email'>your eMail</label>";
        $html.=  "</div>";
        $html.="</div>";
        $html.="<fieldset class='form-group form-group--message'>";
        $html.=  "<textarea class='form-control' name='message' id='message' cols='20' rows='5' required></textarea>";
        $html.=  "<label for='message'>your message</label>";
        $html.="</fieldset>";
        $html.="<div class='form-buttons text-right'>";
        $html.="<button class='btn btn-raised btn-primary' type='submit'>Submit</button>";
        $html.="<p class='no-gap text-center'><small><em>I’ll really try to get back to everyone, but sometimes it’s hard and I can’t guarantee anything.</em></small></p>";
        $html.="</div>";
        $html.="</form>";

        return $html;
    }
}
?>
