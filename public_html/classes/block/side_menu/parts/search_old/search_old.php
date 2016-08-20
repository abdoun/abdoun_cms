<?php

if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}

/**

 * @author 

 * @copyright  2010

 * @class search_old

 */

class search_old

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

        $res=mysql_db::get_records_by_key("select q,results from search_words where language='$l' order by search_time desc limit 40");

        foreach($res[q] as $key=>$value)

        {

            $arr[$value]=$res['results'][$key];

        }

        //arsort($arr);

        foreach($arr as $word=>$results)

        {

            $no=mysql_db::get_rec_no(" search_words where q='".$word."' and language='$l'");

            $html.='<a style="text-decoration:underline;font-size:'.($no*2+6).'px;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">'.$word.'('.$results.')</a>,';

        }

        return $html;

    }

    function get_most_results_search_words($l='')

    {

        $res=mysql_db::get_records_by_key("select distinct q from search_words where language='$l' order by results desc limit 10");

        foreach($res[q] as $key=>$value)

        {

            $no=mysql_db::get_rec_no(" search_words where q='".$value."' and language='$l'");

            //$html.='<a style="text-decoration:underline;font-size:11px;" href="?q='.$value.'&l='.$l.'&page=search_result&type=search_result">'.$value.' ('.$res[results][$key].') ('.$no.')</a><br />';

            $html.='<a style="text-decoration:underline;font-size:'.($no*2+6).'px;" href="?search=q&q='.$value.'&l='.$l.'&page=search_result&type=search_result">'.$value.'</a> , ';

        }

        return $html;

    }

    function get_max_search_words($l='')

    {

        $res=mysql_db::get_records_by_key("select q,results from search_words where language='$l'");

        foreach($res[q] as $key=>$value)

        {

            //$no=mysql_db::get_rec_no(" search_words where q='".$value."' and language='$l'");

            $arr['results'][$value]=$res['results'][$key];

            $arr['no'][$value]=++$$value;

            //$html.='<a style="text-decoration:underline;font-size:11px;" href="?q='.$value.'&l='.$l.'&page=search_result&type=search_result">'.$value.' ('.$res[results][$key].') ('.$no.')</a><br />';

            //$html.='<a style="text-decoration:underline;font-size:'.($no*2+6).'px;" href="?q='.$value.'&l='.$l.'&page=search_result&type=search_result">'.$value.' ('.$res[results][$key].')</a> , ';

        }

        arsort($arr['no']);

        $i=0;

        foreach($arr['no'] as $k=>$v)

        {

            $html.='<a style="text-decoration:underline;font-size:'.($v*2+6).'px;" href="?search=q&q='.$k.'&l='.$l.'&page=search_result&type=search_result">'.$k.'('.$arr['results'][$k].')</a>,';

            $i++;

            if($i==10){break;}

        }

        return $html;

    }

    function view($l='')

    {

       $html=self::template_include();

       $html=str_replace('<dir_tag />',_DIR,$html);

       $html=str_replace('<title_ />',_SEARCH,$html);

       $content='<div id="form"><form action="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'" method="get" name="search_form" id="search_form" onsubmit="if(this.q.value==\'\'){alert(\''.addslashes(_NO_SEARCH).'\');this.q.focus();return false;}">';

       $content.='<input type="text" name="q" title="'._SEARCH.'" value="'.$_GET['q'].'" size="20" />';

       $content.='<input type="hidden" name="l" value="'.$_GET['l'].'" />';

       //$content.='<input type="hidden" name="brand" value="'.$_GET['brand'].'" />';

       $content.='<input type="hidden" name="page" value="search_result" />';

       $content.='<input type="hidden" name="type" value="search_result" />';

       $content.='<input type="submit" name="submitt" title="'._SEARCH.'" value="'._SEARCH.'" />';

       $content.='</form></div>';

       //$content.='<hr />'.self::get_last_search_words($_GET['l']).'<hr />'.self::get_max_search_words($_GET['l']);

       $html=str_replace('<tag />',$content,$html);

       return $html;

    }

}?>