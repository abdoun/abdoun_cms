<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class participate
 */
class participate 
{
    function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    function get_url()
    {
        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).'template/');
        $arr=explode('classes',$path);
        return 'classes/'.$arr[1];
    }
    function view($l='')
    {
       $html=self::template_include();
       $html=str_replace('<dir_tag />',_DIR,$html);
       $html=str_replace('<align_ />',_ALIGN_,$html);
       $html=str_replace('<_align_ />',_ALIGN,$html);
       $html=str_replace('<title_ />',_PARTICIPATE_US,$html);
       $html=str_replace('<tag />',_JOIN,$html);
       //$html=str_replace('href=""','href="page_'.$_GET['l'].'_0_join_join_'.$_GET['brand'].'_0_'.clean::clean_url(_PARTICIPATE_US).'"',$html);
       $page=str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
       $page=str_replace('backup.php','',$_SERVER['SCRIPT_NAME']);
       //$html=str_replace('href=""','href="http://'.$_SERVER['SERVER_NAME'].$page.'?l='.$_GET['l'].'&id=0&type=join&page=join&event=0&title='.clean::clean_url(_PARTICIPATE_US).'"',$html);
       $html=str_replace('href=""',' href="?l='.$_GET['l'].'&id=0&type=join&page=join&event=0&title='.clean::clean_url(_PARTICIPATE_US).'" ',$html);
       
       ##$html=self::template_include();
       #$html=str_replace('<align_ />',_ALIGN_,$html);
       #$html=str_replace('<_align_ />',_ALIGN,$html);
       #$html=str_replace('<title_ />',_PARTICIPATE_US,$html);
       #$html=str_replace('<tag />',_JOIN,$html);
       ##$html=str_replace('href=""','href="?l='.$_GET['l'].'&brand='.$_GET['brand'].'&page=join&type=join"',$html);
       //ob_start();
//       box::box_caption(_PARTICIPATE_US,$html,'#ffffff',160);
//       $html=ob_get_contents();
//       ob_clean();
       return $html;
    }
}?>