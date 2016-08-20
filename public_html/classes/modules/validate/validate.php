<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class validate
{
    function verify($field_name,$type,$error="")
    {
    	switch ($type)
    	{ 
    	case "empty":
    	if(empty($field_name) || ereg("^ +",$field_name))
    		{
    		    if(!empty($error) && !ereg("^ +",$error)){print($error."<br /><a href='javascript:history.go(-1);'>للخلف</a>");}
    			return false;
    		}
    		else
    		{
    		  	return true;
    		}
        	break;
    	case "string":
    		if(is_string($field_name))
    		{
    		    if(!empty($error) && !ereg("^ +",$error)){print($error."<br /><a href='javascript:history.go(-1);'>للخلف</a>");}
    			return false;
    		}
    		else
    		{
    		  	return true;
    		}
        	break;
    	case "digit":
    	if(is_numeric($field_name))
    		{
    		    if(!empty($error) && !ereg("^ +",$error)){print($error."<br /><a href='javascript:history.go(-1);'>للخلف</a>");}
    			return false;
    		}
    		else
    		{
    		  	return true;
    		}
        	break;
    	case "email":
    	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $field_name))
    	{
    	if(!empty($error) && !ereg("^ +",$error)){print($error."<br /><a href='javascript:history.go(-1);'>للخلف</a>");}
    	return false;}
    	else
    	{
    	  return true;
    	}
    	    break;    
    default:
    		return true;
    	}
    }
    function check_sesssion($session)
    {
    	if(!empty($session))
    	{
    		if(mysql_db::records(" members where username='".$session."' and active=2")<1)
    		{
    			return false;
    		}
    		else
    		{
    			return true;
    		}
    	}
    	else
    	{
    		return false;
    	}
    }
    function auth($val)
    {
    	if($val=='no')
    	{
    		return true;
    	}
    	else
    	{
    		if(self::check_sesssion($_SESSION[username])==false)
    			{
    				return false;
    			}
    			else
    			{
    				return true;
    			}
    	}
    }
}?>