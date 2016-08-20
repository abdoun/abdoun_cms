<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 */
class header_menu 
{
    function auto_view($folder)
    {
        $arr=inclusion::get_name_classes_folder($folder);
        $return='<ul class="art-hmenu">';
        sort($arr);
        foreach($arr as $value)
        {
           //eval("\$title=$value::get_title();");
           require_once($folder.'/'.$value.'/config.php');
           if($app_title!='')
           {
                $return.='<li><a href="javascript:hpReq.getData(\'main.php?page='.$value.'&class='.$value.'&d=\'+new Date().getTime(),\'bTarTd\');"><span class="l"></span><span class="r"></span><span class="t">'.$app_title.'</span></a></li>';
           }
        }
        $return.='</ul>';       
        return $return;
    }
}
class extra_header_menu extends header_menu
{
	function auto_view($folder='')
    {
        $return=parent::auto_view($folder);
	    $return.='<table width="100%">';
        $return.='<tr>';
        $return.='<td><a href="javascript:hpReq.getData(\'main.php?page=content&d=\'+new Date().getTime(),\'bTarTd\');">تحرير المحتويات</a></td>';
        $return.='<td><a href="javascript:Ajax_Windows.openMainWindow(\'home.php\',\'\',\'Window\');">رسائل الزوار</a></td>';
        $return.='<td><a href="?page=vote">التصويت</a></td>';
        $return.='<td></td>';
        $return.='</tr>';
        $return.='</table>';
        return $return;
	}
}
?>