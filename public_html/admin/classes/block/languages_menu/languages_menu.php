<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2016
 */
class languages_menu 
{
    function view()
    {
        $return='<select onchange="location.href=\'?l=\'+this.value">';
        $folder=dir('language');
        while($files=$folder->read())
        {
            if($files!="." && $files!=".." && $files!=".htaccess" && !is_dir("$fold/".$files))
            {
                list($name,$ext)=explode('.',$files);
                if($name!='index')
                {
                    if($name==$_SESSION['l']){$selected='selected';}else{$selected='';}
                    $return.='<option value="'.$name.'" '.$selected.'>'.$name.'</option>';
                }              
            }
        }
       $return.='</select>';
       return $return;
	}
    function set()
    {
        if(!empty($_GET['l']))
        {
            $_SESSION['l']=$_GET['l'];
            setcookie('l',$_GET['l']);
        }
        else
        {
            if(!empty($_COOKIE['l']))
            {
                $_SESSION['l']=$_COOKIE['l'];
            }
            else
            {
                $_SESSION['l']='en';setcookie('l','en');
            }
        }
        require_once("language/".$_SESSION['l'].".php");
    }
}?>