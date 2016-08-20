<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 */
class footer_menu 
{
    function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    protected function data_menu($l,& $content='')
    {
       $res=mysql_db::get_records_by_key("select id,title,`type`,permission,descr from content where enabled>1 and language='$l' and `type`<>'' and footer_menu='2' order by ordered");
       for($i=0;$i<count($res['id']);$i++)
       {     
            if($res['permission'][$i]==1)
            {
                //$content.='<div><a href="page_'.$l.'_'.$res['id'][$i].'_'.$res['type'][$i].'_content_'.$brand.'_0_'.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a></div>';
                $content.='<a title="'.$res['descr'][$i].'" href="?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=0&title='.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a> | ';
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                //$content.='<div><a href="page_'.$l.'_'.$res['id'][$i].'_'.$res['type'][$i].'_content_'.$brand.'_0_'.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a></div>';
                $content.='<a title="'.$res['descr'][$i].'" href="?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=0&title='.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a> | ';
            }
            else
            {
                //echo str_replace('<content_tag />','No permission',$html);
            }   
            //$content.=self::data_menu($l,$res['id'][$i],$content);
       }       
    }
    function view($l='')
    {
       $html=self::template_include();
       self::data_menu($l,$content);
       $html=str_replace('<tag />',$content,$html);
       //$html=str_replace('<tag />',_FOOTER,$html);
       $html=str_replace('<tag_copyright />',_FOOTER,$html);
       $html=str_replace('<rss_tag />','http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'rss.php?l='.$l.'',$html);
       //$html=str_replace('<tag />','',$html);
	   return $html;
	}
}
?>