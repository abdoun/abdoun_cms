<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class crypt_aes
{
    public function encrypt($text,$key=Allconstants::_KEY)
    {
        $text=clean::burn($text);
        $res=mysql_fetch_row(mysql_query("select AES_ENCRYPT('".$text."','".$key."')"));
        return $res[0];
    }
    public function decrypt($text,$key=Allconstants::_KEY)
    {
        $text=clean::burn($text);
        $res=mysql_fetch_row(mysql_query("select AES_DECRYPT('".$text."','".$key."')"));
        return $res[0];	
	}
    public function encrypt_array($array)
    {
        if(is_array($array) && count($array)>0)
    	{
    		foreach($array as $key=>$value)
    		{
    			if(!is_array($array[$key]))
    			{
    				$array[$key]=self::encrypt($value);
    			}
                else
                {
                    $array[$key]=self::encrypt_array($array[$key]);
                }
    		}    		
    	}
    	else
    	{
    		$array=self::encrypt($array);
    	}
        return $array;
    }
    public function decrypt_array($array='')
    {
        if(is_array($array) && count($array)>0)
    	{
    		foreach($array as $key=>$value)
    		{
    			if(!is_array($array[$key]))
    			{
    			    $array[$key]=self::decrypt($value);
    			}
                else
                {
                    //print_r($value);
                    $array[$key]=self::decrypt_array($value);
                }
    		}    		
    	}
    	else
    	{
            $array=self::decrypt($array);
    	}
     return $array;
    }
}?>