<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 */
class header_menu 
{
    function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    function view($l)
    {
       $html=self::template_include();
       $lang=mysql_db::get_records_by_key("select id,name,shortcut,description from languages where enabled>1");
       for($i=0;$i<count($lang['id']);$i++)
       {
        if($lang['id'][$i]==$l){$class=' class="active"';}else{$class='';}
        $content.='<li><a title="'.$lang['description'][$i].'" '.$class.' href="?l='.$lang['id'][$i].'&title='.clean::clean_url($lang['name'][$i]).'"><span class="l"></span><span class="r"></span><span class="t">'.$lang['name'][$i].'</span></a></li><li class="art-hmenu-separator"> </li>';
       }
       $res=mysql_db::get_records_by_key("select id,title,`type`,permission,descr from content where enabled>1 and language='$l' and `type`<>'' and header_menu='2' order by ordered");
       for($i=0;$i<count($res['id']);$i++)
       {
            if($res['id'][$i]==$_GET['id']){$class=' class="active"';}else{$class='';}
           if($res['permission'][$i]==1)
            {
                //$content.='<div><a href="page_'.$l.'_'.$res['id'][$i].'_'.$res['type'][$i].'_content_'.$brand.'_0_'.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a></div>';
                $content.='<li><a title="'.$res['descr'][$i].'" '.$class.' href="?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=0&title='.clean::clean_url($res['title'][$i]).'"><span class="l"></span><span class="r"></span><span class="t">'.$res['title'][$i].'</span></a></li><li class="art-hmenu-separator"> </li>';
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                //$content.='<div><a href="page_'.$l.'_'.$res['id'][$i].'_'.$res['type'][$i].'_content_'.$brand.'_0_'.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a></div>';
                $content.='<li><a title="'.$res['descr'][$i].'" '.$class.' href="?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=0&title='.clean::clean_url($res['title'][$i]).'"><span class="l"></span><span class="r"></span><span class="t">'.$res['title'][$i].'</span></a></li><li class="art-hmenu-separator"> </li>';
            }
            else
            {
                //echo str_replace('<content_tag />','No permission',$html);
            }
        }//echo(membership::content_member($res['id'][$i]));
       $html=str_replace('<tag />',$content,$html);
       return $html;
	}
    function view_for_index($l)
    {
        $html='<div style="padding:5px;text-align:right;"><strong><tag /></strong></div>';
       $lang=mysql_db::get_records_by_key("select id,name,shortcut from languages where enabled=2");
       for($i=0;$i<count($lang['id']);$i++)
       {
        if($lang['id'][$i]==$l){$class=' style="color:#f78d20;text-decoration: none;"';}else{$class=' style="color:#0072bc;text-decoration: none;"';}
        $content.=' &nbsp; <a '.$class.' href="_'.$lang['id'][$i].'_0_'.clean::clean_url($lang['name'][$i]).'">'.$lang['name'][$i].'</a> &nbsp; ';
       }
       $content.=' &nbsp; <a style="color:#0072bc;text-decoration: none;" href="http://.com">Türkçe</a> &nbsp; ';
       $html=str_replace('<tag />',$content,$html);
	   return $html;
    }
}?>