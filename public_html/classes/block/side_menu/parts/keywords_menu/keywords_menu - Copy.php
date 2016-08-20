<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright 2012
 * @class keywords_menu
 */
class keywords_menu 
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
    function data_menu($l,$id='',& $content='')
    {
        if(!empty($id))
        {
            $sql='and id='.$id;
        }
        else
        {
            $sql='order by hits,id';
        }
       $res=mysql_db::get_records_by_key("select keywords,permission from content where language='$l' and enabled>1 $sql");
       for($i=0;$i<count($res['keywords']);$i++)
       {
            if($res['permission'][$i]==1)
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    //$keyword[$words]=$words;
                    $no[$words]=++$$words;
                }
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    //$keyword[$words]=$words;
                    $no[$words]=++$$words;
                }
            }
            else
            {
                //echo str_replace('<content_tag />','No permission',$html);
            }            
       }
       if($id==''){arsort($no);}       
       $j=1;
       foreach($no as $word=>$num)
       {
            $content.='<a title="'.$word.'" style="text-decoration:underline;" href="index.php?q='.$word.'&l='.$l.'&page=search_result&type=search_result">';
            $content.=$word;
            $content.='</a>('.$num.')';
            if($id!='')
            {
                $content.=' ';
            }
            else
            {
                $content.='<br />';
            }
            $j++;
            if($j>=10 && $id=='')break;
       }
    }
    function data_cloud($l,$id='',& $content='')
    {
        if(!empty($id))
        {
            $sql='and id='.$id;
        }
        else
        {
            $sql='order by hits,id';
        }
       $res=mysql_db::get_records_by_key("select keywords,permission from content where language='$l' and enabled>1 $sql");
       for($i=0;$i<count($res['keywords']);$i++)
       {
            if($res['permission'][$i]==1)
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    //$keyword[$words]=$words;
                    $no[$words]=++$$words;
                }
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    //$keyword[$words]=$words;
                    $no[$words]=++$$words;
                }
            }
            else
            {
                //echo str_replace('<content_tag />','No permission',$html);
            }            
       }
       if($id==''){arsort($no);}       
       $j=1;
       foreach($no as $word=>$num)
       {
            $content.='<a title="'.$word.'" style="font-size: '.($num*2+8).'px;" href="index.php?q='.$word.'&l='.$l.'&page=search_result&type=search_result">';
            $content.=$word;
            //$content.='('.$num.')';
            $content.='</a>';
            if($id!='')
            {
                $content.=' ';
            }
            else
            {
                $content.=' ';
            }
            $j++;
            if($j>=10 && $id=='')break;
       }
    }
    function view($l='')
    {
       $html=self::template_include();
       self::data_cloud($l,'',$content);
       $html=str_replace('<title_ />','الكلمات الدلالية',$html);
       $html=str_replace('<tag />',$content,$html);
       $path=self::get_url();       
       $html=str_replace('<path />',$path,$html);
       return $html;
    }
}?>