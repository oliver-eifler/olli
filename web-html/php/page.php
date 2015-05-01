<?php
/*
   Olli PHP Framework
*/
require_once("php/config.php");
/* the one and only page */
class Page {
	protected static $instance = NULL;
	public static function getInstance()
	{
		if (self::$instance === NULL)
		{
			self::load();
		}
		return self::$instance;
	}
    public static function load()
    {
		if (self::$instance !== NULL)
        {
            delete(self::$instance);
            self::$instance = NULL;
        }
        $uri = $_SERVER['REQUEST_URI'];
        $uri = preg_replace('/\?.*/', '', $uri);
        $clean_uri = strtolower(preg_replace('/\..*/', '', $uri));
        if (empty($clean_uri) || $clean_uri == "/" || $clean_uri=="/index")
            $clean_uri="/home";
        $cur_uri = str_replace("/home","",$clean_uri);
        if (empty($cur_uri))
            $cur_uri ="/";

        //extract class
        $base_uri = $class = explode("/",trim($clean_uri,"/"))[0];
        //construct page ?
        if (!file_exists("php/page/".$class.".php"))
            $class="static";
        $classname=ucwords($class)."Page";
        require_once("php/page/".$class.".php");
        $page = new $classname($clean_uri);
        $page->setData("clean_uri",$clean_uri);
        $page->setData("base_uri",$base_uri);
        $page->setData("cur_uri",$cur_uri);
        self::$instance = $page;
        return self::$instance;
    }
	protected function __construct() {}
	private function __clone() {}
}
?>