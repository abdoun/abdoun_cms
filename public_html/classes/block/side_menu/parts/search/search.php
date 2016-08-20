<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class search
 */
class search 
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
    function get_last_search_words($l='')
    {
        $res=mysql_db::get_records_by_key("select q,results,no from search_words where language='$l' order by search_time desc limit 10");
        foreach($res[q] as $key=>$word)
        {
            //$html.='<a style="text-decoration:underline;font-size:'.($res['no'][$key]*2+6).'px;" href="?q='.$word.'&l='.$l.'&page=search_result&type=search_result">'.$word.'('.$res['results'][$key].')</a>, ';
            $html.='<a style="text-decoration:underline;font-size:12px;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">'.$word.'('.$res['results'][$key].')</a>, ';
        }
        return $html;
    }
    function get_most_results_search_words($l='')
    {
        $res=mysql_db::get_records_by_key("select q,results,no from search_words where language='$l' order by results desc limit 10");
        foreach($res[q] as $key=>$word)
        {
            //$html.='<a style="text-decoration:underline;font-size:'.($res['no'][$key]*2+6).'px;" href="?q='.$word.'&l='.$l.'&page=search_result&type=search_result">'.$word.'('.$res['results'][$key].')</a>, ';
            $html.='<a style="text-decoration:underline;font-size:12px;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">'.$word.'('.$res['results'][$key].')</a>, ';
        }
        return $html;
    }
    function get_max_search_words($l='')
    {
        $res=mysql_db::get_records_by_key("select q,results,no from search_words where language='$l' order by no desc limit 10");
        foreach($res[q] as $key=>$word)
        {
            //$html.='<a style="text-decoration:underline;font-size:'.($res['results'][$key]*2+6).'px;" href="?q='.$word.'&l='.$l.'&page=search_result&type=search_result">'.$word.'('.$res['no'][$key].')</a>, ';
            $html.='<a style="text-decoration:underline;font-size:12px;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">'.$word.'('.$res['no'][$key].')</a>, ';
        }
        return $html;
    }
    function view($l='')
    {
       $html=self::template_include();
       $html=str_replace('<dir_tag />',_DIR,$html);
       $html=str_replace('<title_ />',_SEARCH,$html);
       $content='<div id="form"><form action="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'" method="get" name="search_form" id="search_form" onsubmit="if(this.q.value==\'\'){alert(\''.addslashes(_NO_SEARCH).'\');this.q.focus();return false;}">';
       //$content.='<input type="hidden" name="search" title="'._SEARCH.'" value="q" size="10" />';
       $content.='<input type="text" name="q" title="'._SEARCH.'" value="'.$_GET['q'].'" size="10" />';
       $content.='<input type="hidden" name="l" value="'.$_GET['l'].'" />';
       //$content.='<input type="hidden" name="brand" value="'.$_GET['brand'].'" />';
       $content.='<input type="hidden" name="page" value="search_result" />';
       $content.='<input type="hidden" name="type" value="search_result" />';
       $content.='<input type="submit" name="submitt" title="'._SEARCH.'" value="'._SEARCH.'" />';
       $content.='</form></div><hr />'._LAST_SEARCH_WORDS.':<br />'.self::get_last_search_words($_GET['l']).'<hr />'._MORE_WORDS_SEARCH_RESULTS.':<br />'.self::get_most_results_search_words($_GET['l']).'<hr />'._MORE_SEARCH_WORDS.':<br />'.self::get_max_search_words($_GET['l']);
       $html=str_replace('<tag />',$content,$html);
       return $html;
    }
}?>