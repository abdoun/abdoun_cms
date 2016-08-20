<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 */
class marquee 
{
    function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    protected function path2url($file, $Protocol='http://')
    {
        return $Protocol.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
    }
    protected function replace_url($tag)
    {
        return str_replace('<url_ />','http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/marqree/template',$tag);
    }
    protected function data_menu($l,& $content='')
    {
       $res=mysql_db::get_records_by_key("select 
                                                a.id,
                                                a.title,
                                                a.`type` as type,
                                                b.`type` as parent_type,
                                                a.permission,
                                                a.icon,
                                                a.descr from 
                                                content as a left outer join content as b on
                                                a.parent=b.id
                                                 where 
                                                 a.enabled>1 and
                                                 a.language='$l' and 
                                                 a.`marquee`>1
                                                 order by a.id desc
                                                 limit 10
                                                 ");
       for($i=0;$i<count($res['id']);$i++)
       {
            if(empty($res['type'][$i])){$res['type'][$i]=$res['parent_type'][$i];$event='view';}else{$event='0';}
            if($res['permission'][$i]==1)
            {
                $content.='<a class="marquee" title="'.$res['title'][$i].' '.$res['descr'][$i].'"'.$selected.' href="'.$href.'?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'">';
                $content.=$res['title'][$i];
                $content.='</a>';
                $content.=' <img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/icon.png" align="center" height="20" /> ';
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                $content.='<a class="marquee" title="'.$res['title'][$i].' '.$res['descr'][$i].'"'.$selected.' href="'.$href.'?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'">';
                $content.=$res['title'][$i];
                $content.='</a>';
                $content.=' <img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/icon.png" align="center" height="20" /> ';
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
       $html=str_replace('<tag_align />',_ALIGN,$html);
       //$html=str_replace('<img_tag_ />','<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/icon.png" align="center" height="20" />',$html);//
       $html=self::replace_url($html);
       
       //$html=str_replace('<tag />','',$html);
	   return $html;
	}
}
?>