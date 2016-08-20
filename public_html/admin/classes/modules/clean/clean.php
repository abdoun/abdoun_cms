<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class clean
{
    protected $input;
    function __construct($array='')
    {
    	if(is_array($array) && count($array)>0)
    	{
    		foreach($array as $key=>$value)
    		{
    			if(!is_array($value))
    			{
    				$array[$key]=$this->reclean($value);
    				$array[$key]=$this->burn($value);
    			}
    		}
    		$this->input=$array;
    	}
    	else
    	{
    		$this->input=$this->burn($array);
    	}
        return $this->input;
    }
    public function clear_array($array)
    {
        if(is_array($array) && count($array)>0)
    	{
    		foreach($array as $key=>$value)
    		{
    		  if($key!='body')
              {
                if(!is_array($array[$key]))
    			{
    				$array[$key]=self::reclean($value);
    				$array[$key]=self::burn($value);
    			}
                else
                {
                    $array[$key]=self::clear_array($array[$key]);
                }
              }    			
    		}    		
    	}
    	else
    	{
    		$array=self::burn($array);
    	}
        return $array;
    }
    public function clear_http()
    {
        if(is_array($_GET) && count($_GET)>0)
    	{
            foreach($_GET as $key=>$value)
            {
                $_GET[$key]=self::burn($value);
            }
        }
        if(is_array($_POST) && count($_POST)>0)
    	{
    	   foreach($_POST as $key=>$value)
            {
                $_POST[$key]=self::burn($value);
            }
        }
        if(is_array($_REQUEST) && count($_REQUEST)>0)
    	{
            foreach($_REQUEST as $key=>$value)
            {
                $_REQUEST[$key]=self::burn($value);
            }
        }
        if(is_array($_SESSION) && count($_SESSION)>0)
    	{
            foreach($_SESSION as $key=>$value)
            {
                $_SESSION[$key]=clean::burn($value);
            }
        }
        if(is_array($_COOKIE) && count($_COOKIE)>0)
    	{
            foreach($_COOKIE as $key=>$value)
            {
                $_COOKIE[$key]=self::burn($value);
            }
        }
    }
    public function clean_http_sub_arrays()
    {
        $_GET=self::clear_array($_GET);
        $_POST=self::clear_array($_POST);
        $_SESSION=self::clear_array($_SESSION);
        $_COOKIE=self::clear_array($_COOKIE);
        $_REQUEST=self::clear_array($_REQUEST);
    }
	public function burn($input)
    {
        if(!empty($input))
        {
            $input=stripslashes($input);//remove spaces and \
    		$input=strip_tags($input);//remove html and php markup
    		$input=htmlspecialchars($input);//replace markup
    		$input=AddSlashes($input);//escape quetes
    		//$input=htmlentities($input);//Convert all applicable characters to HTML entities
    		//$input=escapeshellcmd($input);
    		$input=mysql_real_escape_string($input);
    		$input=trim($input);
            $output=str_replace('meta','',$output);//
            $output=str_replace('EQUIV','',$output);//
            $output=str_replace('location','',$output);//
            $output=str_replace('refresh','',$output);//
    	   return $input;
        }
        else
        {
            return '';
        }	
	}
	public function reclean($output)
    {
		return StripSlashes($output);	
	}
    public function clean_url($output)
    {
        $output=str_replace('_','-',$output);
        $output=str_replace(' ','-',$output);
        $output=str_replace('/','-',$output);
        $output=str_replace('meta','',$output);//
        $output=str_replace('EQUIV','',$output);//
        $output=str_replace('location','',$output);//
        $output=str_replace('href','',$output);//
        $output=str_replace('refresh','',$output);//
        return $output;
    }
}?>