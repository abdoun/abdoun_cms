<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @name page
 */
class page 
{
    function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    function get_url($folder='')
    {
        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).$folder.'/');
        $arr=explode('classes',$path);
        return 'classes/'.$arr[1];
    }
    function view($l)
    {
       $html=self::template_include();
       if(!empty($_GET['page']))
        {
            $content=inclusion::construct_class_file_to_string(self::get_url('app').$_GET['page'].'/'.$_GET['page'].'.php',$_GET,$_POST);
        }
        else
        {
            $_GET['type']='main_many';
            $_GET['page']='content';
            $content=inclusion::construct_class_file_to_string(self::get_url('app').$_GET['page'].'/'.$_GET['page'].'.php',$_GET,$_POST);
        }       
       $html=str_replace('<tag />',$content,$html);
	   return $html;
	}
}?>