<?php
/*
   Olli PHP Framework
*/
require_once("php/config.php");
class BasePage
{
    protected $uri="";
    protected $error=false;
    protected $html  ="";
    protected $data = array();

    function __construct($uri)
    {
        $this->uri = $uri;
        $this->error = false;
        $this->build = false;
        $this->data['modified'] = time();
        $this->init();
    }
    //overwrite functions
    protected function init() {}



    //public functions
    public function getError()  {return $this->error;}
    public function getUri()    {return $this->uri;}
    public function getHtml()   {return $this->html;}
    public function getData($idx)
    {
        return array_key_exists($idx,$this->data) ? $this->data[$idx] : null;
    }
    public function setData($idx,$value)
    {
        $this->data[$idx]=$value;
    }
    public function getPreparedTitle()
    {
        $config = Config::getInstance();
        $title = $this->getData("title");
        $title .= (!empty($title)? " || ":"").$config->title;
        return $title;
    }
    public function getPreparedDescription()
    {
        $config = Config::getInstance();
        $desc = (!empty($this->getData("desc"))?$this->getData("desc"):$config->desc);
        return $desc;
    }
    public function getPreparedTags()
    {
        return implode(", ",$this->getTagsArray());
    }
    public function getTagsArray()
    {
        $config = Config::getInstance();
        $tags = $config->tags;
        if (!empty($this->getData("tags")))
            $tags = array_merge(explode(",",$this->getData("tags")),$tags);
        foreach($tags as $k => $v)
            $tags[$k] = strtolower(trim($v));
        return $tags;
    }

}
?>