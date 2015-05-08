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
        $request_url = get_request_url();
        $parts = parse_url($request_url);
        $path = strtolower($parts['path']);
        $request_uri = $path;
        //check & remove extensions
        $path_parts = pathinfo($path);
        if (isset($path_parts['extension']))
            $path = substr($path,0,strlen($path) - (strlen($path_parts["extension"]) + 1) );

        if (empty($path) || $path == "/" || $path=="/index")
            $path="/home";
        //extract cmd :/cmd[/blabla/blabla]
        $_t = explode("/",trim($path,"/"),2);
        $cmd = (isset($_t[0])?$_t[0]:"");
        $param = (isset($_t[1])?$_t[1]:"");

        //construct canonical_url and href
        $uri = str_replace("/home","/",$path);
        $url = get_request_scheme() . '://' . $_SERVER['HTTP_HOST'] .$uri;
        $uri_cmd = "/".str_replace("home","",$cmd);
        $url_cmd = get_request_scheme() . '://' . $_SERVER['HTTP_HOST'] .$uri_cmd;

        $class=$cmd;
        if (!file_exists("php/page/".$class.".php"))
            $class="static";
        $classname=ucwords($class)."Page";
        require_once("php/page/".$class.".php");
        $data = array(
        "path" => $path,
        "cmd" => $cmd,
        "param" => $param,
        "request_url" => $request_url,
        "request_uri" => $request_uri,
        "uri" => $uri,
        "url" => $url,
        "uri_cmd" => $uri_cmd,
        "url_cmd" => $url_cmd,
        );

       $page = new $classname($data);

        self::$instance = $page;
        return self::$instance;
    }
	protected function __construct() {}
	private function __clone() {}
}
?>