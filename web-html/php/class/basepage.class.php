<?php
/*
   Olli PHP Framework
*/
class BasePage
{
    protected $uri="";
    protected $error=false;
    protected $html  ="";
    protected $title ="";

    function __construct($uri)
    {
        $this->uri = $uri;
        $this->error = false;
        $this->build = false;
        $this->init();
    }
    //overwrite functions
    protected function init() {}



    //public functions
    public function getError()  {return $this->error;}
    public function getUri()    {return $this->uri;}
    public function getHtml()   {return $this->html;}
    public function getTitle()  {return $this->title;}
}
?>