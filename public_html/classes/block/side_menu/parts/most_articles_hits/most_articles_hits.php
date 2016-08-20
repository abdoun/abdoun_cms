<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright 2012
 * @class most_articles_hits
 */
class most_articles_hits 
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
    protected function data_menu($l,& $content='')
    {
       $res=mysql_db::get_records_by_key("select 
                                                a.id,
                                                a.title,
                                                b.`type`,
                                                a.permission,
                                                a.hits,
                                                a.descr from 
                                                content as a left outer join content as b on
                                                a.parent=b.id
                                                 where 
                                                 a.enabled>1 and
                                                 a.language='$l' and 
                                                 a.`type`='' 
                                                 order by a.hits desc
                                                 limit 8");
       for($i=0;$i<count($res['id']);$i++)
       {
            
            if($res['permission'][$i]==1)
            {
                $content.='<a title="'.$res['descr'][$i].'"'.$selected.' id="li_'.$res[id][$i].'" href="'.$href.'?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=view&title='.clean::clean_url($res['title'][$i]).'">';
                $content.=$res['title'][$i];
                $content.='</a> ('.$res['hits'][$i].')<br />';
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                $content.='<a title="'.$res['descr'][$i].'"'.$selected.' id="li_'.$res[id][$i].'" href="'.$href.'?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=view&title='.clean::clean_url($res['title'][$i]).'">';
                $content.=$res['title'][$i];
                $content.='</a> ('.$res['hits'][$i].')<br />';
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
       $html=str_replace('<title_ />',_MOST_READ_ARTICLES,$html);
       $html=str_replace('<tag />',$content,$html);
       $path=self::get_url();       
       $html=str_replace('<path />',$path,$html);
       return $html;
    }
}?>