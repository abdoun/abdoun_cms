<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @name side_menu
 */
class side_menu 
{
    function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    function view($l='')
    {
       $html=self::template_include();
       inclusion::include_classes_folder(substr(__FILE__,0,-strlen(basename(__FILE__))).'/parts');
       $parts=inclusion::get_conf_classes_folder(substr(__FILE__,0,-strlen(basename(__FILE__))).'/parts');
       //sort($parts);
       foreach($parts as $value)
       {
            //include_once(substr(__FILE__,0,-strlen(basename(__FILE__))).'/parts/'.$value.'/config.php');
            //if($enable=='yes')
            //{
                @eval("\$content.=".$value."::view(".$l.");");
            //}                    
       }
       //$content='menu';       
       $html=str_replace('<tag />',$content,$html);
	   return $html;
	}
}?>