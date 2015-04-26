<?php
/**
 * Olli Framework
 * This file is part of the Olli-Framework
 * Copyright (c) 2012-2013 Oliver Jean Eifler
 *
 * @version 0.0.1
 * @link http://www.framework.dd/
 * @author Oliver Jean Eifler <oliver.eifler@gmx.de>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Registry implements ArrayAccess, Countable, IteratorAggregate
{
   /**
    * @var object Instance of registry class
	*/
	protected static $instance = NULL;
    private $data = array();

	/**
	 * Get an instance of registry class
	 *
	 * @return object Instance of registry class
	 */
	public static function getInstance()
	{
		if (self::$instance === NULL)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * Constructor - start session
	 */
	protected function __construct()
	{
	}
	/**
	 * Clone - prevent additional instances of the class
	 */
	private function __clone() {}
	/**
	 * Magic Method to set a registry variable
	 *
	 * @param  string  $key   Registry array key
	 * @param  string  $value Value of registry key
	 * @return mixed   TRUE on success otherwise FALSE
	 */
	public function __set( $key, $value )
	{
        return $this->offsetSet($key,$value);
	}
	/**
	 * Magic Method to get a registry variable
	 *
	 * @param  string  $key   Registry array key
	 * @return bool    TRUE on success otherwise NULL
	 */
	public function __get( $key )
	{
		return $this->offsetGet($key);
	}
	/**
	 * Unset a registry variable
	 *
	 * @param  string  $key   Registry array key
	 * @return bool    TRUE on success otherwise FALSE
	 */
	public function __unset( $key )
	{
        return $this->offsetUnset($key);
	}
	public function __isset( $key )
	{
        return array_key_exists($key,$this->data);
	}
	/**
	 * Reset registry
	 *
	 * @return bool    TRUE
	 */
	public function reset()
	{
        return $this->clear();
	}
    public function debug()
    {
        return "<p><h1>Registry</h1>".print_r($this->data,true)."</p>";

    }
    //Array Access methods
    public function offsetSet($offset, $value)
    {
        if(is_null($offset))
        {
            $this->data[] = $value;
        }
        else
        {
            $this->data[$offset] = $value;
        }
    }
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return array_key_exists($offset,$this->data) ? $this->data[$offset] : null;
    }
    public function clear()
    {
        $this->data = array();
    }
//Countable members
    public function count()
    {
        return count($this->data);
    }
//Iterator members
   public function getIterator()
   {
        return new ArrayIterator($this->data);
   }
}
?>
