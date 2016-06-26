<?php
namespace Dframe;
use Dframe\BaseException;

/* Autor Sławek Kaleta */

class Config{
 
    protected static $cfg = array();
	public $path;
    
    public function __construct($file){
        $this->path = appDir.'../app/Config/'; // appDir zdefiniowany powinien byc w Config.php

    	$this->file = $file;
    	if (file_exists($this->path.$this->file.'.php') != true)
    		throw new BaseException('Not Found Config '. $this->path.$this->file.'.php');
    
        if(!isset(self::$cfg[$file]))
            self::$cfg[$file] = include($this->path.$this->file.'.php');

    }

    public static function load($file){
        return new Config($file);
    }

    public function get($param = null, $or = null){


    	if($param == null)
    		return (isset(self::$cfg[$this->file]))? self::$cfg[$this->file] : null;

	    return (isset(self::$cfg[$this->file][$param]) AND !empty(self::$cfg[$this->file][$param]))? self::$cfg[$this->file][$param] : $or;
    }


}