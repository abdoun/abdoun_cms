<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class crypt
{
    protected $key;
    protected $iv;
    function __construct()
    {
    	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        $this->iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $this->key=Allconstants::_KEY;
    }
    public function encrypt($text)
    {        
        return  mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $text, MCRYPT_MODE_CBC, $this->iv);
    }
    public function decrypt($crypttext)
    {
		return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $crypttext, MCRYPT_MODE_CBC, $this->iv);	
	}
    public function encrypt_array($array)
    {
        if(is_array($array) && count($array)>0)
    	{
    		foreach($array as $key=>$value)
    		{
    			if(!is_array($array[$key]))
    			{
    				$array[$key]=$this->encrypt($value);
    			}
                else
                {
                    $this->encrypt_array($array[$key]);
                }
    		}    		
    	}
    	else
    	{
    		$array=$this->encrypt($array);
    	}
        return $array;
    }
    public function decrypt_array($array)
    {
        if(is_array($array) && count($array)>0)
    	{
    		foreach($array as $key=>$value)
    		{
    			if(!is_array($array[$key]))
    			{
    				$array[$key]=$this->decrypt($value);
    			}
                else
                {
                    $this->decrypt_array($array[$key]);
                }
    		}    		
    	}
    	else
    	{
    		$array=$this->decrypt($array);
    	}
        return $array;
    }
}?>