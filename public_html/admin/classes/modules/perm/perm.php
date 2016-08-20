<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class perm
{
    function check_login($perm=array('manager'))
    {
        if(!empty($_SESSION['user']) && !empty($_SESSION['pass']))
        {
            $re=mysql_fetch_array(mysql_query("select perm from users where user='".$_SESSION['user']."' and pass='".md5($_SESSION['pass'])."'"));
        	if(!in_array($re['perm'],$perm))
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
    function check_session($perm=array('manager'))
    {
    	$re=mysql_fetch_array(mysql_query("select perm from users where user='".$_SESSION[user]."' and pass='".md5($_SESSION[pass])."'"));
    	if(!in_array($re['perm'],$perm))
    	{
    		goto_('index.php?abdoun=login','عذراً عليك تسجيل الدخول');
    		exit();
    	}
    }
    function get_id_user()
    {
        if(!empty($_SESSION['user']) && !empty($_SESSION['pass']))
        {
            $re=mysql_fetch_array(mysql_query("select id from users where user='".$_SESSION['user']."' and pass='".md5($_SESSION['pass'])."'"));
            if($re['id']=='')
            {
                return false;
            }    
            else
            {
                return $re['id'];
            }
        }
        else
        {
            return false;
        }
    }
    function get_name_user($id)
    {
        $re=mysql_fetch_array(mysql_query("select user from users where id='$id'"));
        if($re['user']=='')
        {
            return false;
        }    
        else
        {
            return $re['user'];
        }    
    }
    function get_perm_user($id)
    {
        if($id===false)
        {
            return false;
        }
        $re=mysql_fetch_array(mysql_query("select perm from users where id='$id'"));
        if($re['perm']=='')
        {
            return false;
        }    
        else
        {
            return $re['perm'];
        }
        return false;
    }
    function get_user($id)
    {
        $res=mysql_fetch_array(mysql_query("select user from uers where id=$id"));
        return $res[user];
    }
    function alert($msg)
    {
    	if($msg!="")
    	 {
    	 	?><script type="text/javascript"><?php
    		print("alert('".$msg."');");
    		?></script><?php
    	 }
    }
}?>