<?php
require_once('php/class/basepage.class.php');

class TestPage extends BasePage
{
    protected function init()
    {
        $this->error = false;
        $this->noindex = true;
        $this->title="Show Classses";
        $this->description="Show my Classes";
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
        $html.= $this->Buttons();
        $html.="</section>";
        return $html;
    }
    protected function Buttons()
    {
        $html = "";
        $html.="<h2>Normal Buttons</h2>";
        $html.="<p>class='btn'</p>";
        $html.= $this->getButtons(array(),false).$this->getButtons(array(),true);
        $html.="<h2>Flat Buttons</h2>";
        $html.="<p>class='btn btn-flat'</p>";
        $html.= $this->getButtons(array('btn-flat'),false).$this->getButtons(array('btn-flat'),true);
        $html.="<h2>Raised Buttons</h2>";
        $html.="<p>class='btn btn-raised'</p>";
        $html.= $this->getButtons(array('btn-raised'),false).$this->getButtons(array('btn-raised'),true);
        $html.="<h2>Large Buttons</h2>";
        $html.="<p>class='btn btn-large'</p>";
        $html.= $this->getButtons(array('btn-large'),false).$this->getButtons(array('btn-large'),true);
        $html.="<h2>Buttons width Icons</h2>";
        $html.="<p>class='btn btn-primary'</p>";
        $html.= $this->getIconButtons(array(),false).$this->getIconButtons(array(),true);
        return $html;
    }
    protected function getButtons($classes=array(),$disabled=false)
    {
        $buttons = array("default","primary","danger","accent");
        $html = "<div class='btn-bar' style='margin-top:0'>";
        foreach($buttons as $k => $v)
        {
          $base = array_merge(array('btn'),$classes);
          $base[] = "btn-".$v;
          $html.= "<button class='".implode(" ",$base)."'".($disabled?" disabled":"").">".$v."</button>";
        }
        $base = array_merge(array('btn'),$classes);
        $base[] = "btn-primary";
        $html.= "<a href='#' class='".implode(" ",$base)."'".($disabled?" disabled":"").">link</a>";
        $html .= "</div>";

        return $html;

    }
    protected function getIconButtons($classes=array(),$disabled=false)
    {
        $icons = array("codepen","github","googleplus","facebook");
        $html = "<div class='btn-bar' style='margin-top:0'>";
        foreach($icons as $k => $v)
        {
          $base = array_merge(array('btn','btn-primary'),$classes);
          $html.= "<button class='".implode(" ",$base)."'".($disabled?" disabled":"")."><svg><use xlink:href='#icon-".$v."'></use></svg>".$v."</button>";
        }
        $html .= "</div>";

        return $html;

    }
}
?>
