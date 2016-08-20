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
        $perm=perm::get_perm_user(perm::get_id_user());
        //print(perm::get_id_user());
        if($perm===false)
        {
            $perm='user';
        }
        foreach($arr as $value)
        {
           //eval("\$title=$value::get_title();");
           $app_perm='';
           require_once($folder.'/'.$value.'/config.php');           
            if(in_array($perm,$app_perm))
            {
                if($app_title!='')
                {
                    if($value==$_GET['page']){$active='';}else{$active='';}
                    //$return.='<li><a href="javascript:hpReq.getData(\'main.php?page='.$value.'&class='.$value.'&d=\'+new Date().getTime(),\'bTarTd\');" '.$active.'><span class="l"></span><span class="r"></span><span class="t">'.$app_title.'</span></a></li>';
                    $return.='<li><a onclick="'.box::href_req('page='.$value.'&class='.$value,'bTarTd').'" href="javascript://" '.$active.'><span class="l"></span><span class="r"></span><span class="t">'.$app_title.'</span></a></li>';
                }
            }           
        }
        $return.='</ul>';       
        return $return;
    }
}?>