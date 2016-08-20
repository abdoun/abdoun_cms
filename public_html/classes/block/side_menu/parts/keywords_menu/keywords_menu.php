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
    function data_menu($l,& $content='')
    {
        $sql='order by hits,id';
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
       arsort($no);       
       $j=1;
       foreach($no as $word=>$num)
       {
            $content.='<a title="'.$word.'" style="text-decoration:underline;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">';
            $content.=$word;
            $content.='</a>('.$num.')';
            $content.='<br />';
            $j++;
            if($j>=10)break;
       }
    }
    function data_cloud($l,& $content='')
    {
        $sql='order by hits,id';
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
       arsort($no);       
       $j=1;
       foreach($no as $word=>$num)
       {
            $content.='<a title="'.$word.'" style="font-size: 12px;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">';
            $content.=$word;
            $content.='('.$num.')';
            $content.='</a>';
            $content.=' ';
            $j++;
            if($j>=10)break;
       }
    }
    function view($l='')
    {
       $html=self::template_include();
       self::data_cloud($l,$content);
       $html=str_replace('<title_ />',_TAGS,$html);
       $html=str_replace('<tag />',$content,$html);
       $path=self::get_url();       
       $html=str_replace('<path />',$path,$html);
       return $html;
    }
}
class keywords_related extends keywords_menu 
{
    function data_menu($l,$id='',& $content='')
    {
        $sql='and id='.$id;
        $res=mysql_db::get_records_by_key("select keywords,permission from content where language='$l' and enabled>1 $sql");
       for($i=0;$i<count($res['keywords']);$i++)
       {
            if($res['permission'][$i]==1)
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    $word_no=mysql_db::get_rec_no(" content where enabled>1 and language='$l' and keywords like '%".$words."%'");
                    $no[$words]=$word_no;
                }
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    $word_no=mysql_db::get_rec_no(" content where enabled>1 and language='$l' and keywords like '%".$words."%'");
                    $no[$words]=$word_no;
                }
            }
            else
            {
                //echo str_replace('<content_tag />','No permission',$html);
            }            
       }
       foreach($no as $word=>$num)
       {
            $content.='<a title="'.$word.'" style="text-decoration:underline;font-size:11px;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">';
            $content.=$word;
            $content.='</a>('.$num.')';
            $content.=' ';
       }
    }
    function data_cloud($l,$id='',& $content='')
    {
        $sql='and id='.$id;
        $res=mysql_db::get_records_by_key("select keywords,permission from content where language='$l' and enabled>1 $sql");
       for($i=0;$i<count($res['keywords']);$i++)
       {
            if($res['permission'][$i]==1)
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    $word_no=mysql_db::get_rec_no(" content where enabled>1 and language='$l' and keywords like '%".$words."%'");
                    $no[$words]=$word_no;
                }
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    $word_no=mysql_db::get_rec_no(" content where enabled>1 and language='$l' and keywords like '%".$words."%'");
                    $no[$words]=$word_no;
                }
            }
            else
            {
                //echo str_replace('<content_tag />','No permission',$html);
            }            
       }
       foreach($no as $word=>$num)
       {
            $content.='<a title="'.$word.'" style="font-size: 12px;" href="?search=q&q='.$word.'&l='.$l.'&page=search_result&type=search_result">';
            $content.=$word;
            $content.='('.$num.')';
            $content.='</a>';
            $content.=' ';
       }
    }
    function data_related($l,$id='',& $content='')
    {
        $sql='and id='.$id;
        $res=mysql_db::get_records_by_key("select keywords,permission from content where language='$l' and enabled>1 $sql");
       for($i=0;$i<count($res['keywords']);$i++)
       {
            if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
            {
                $keywords=explode('،',str_replace(',','،',$res['keywords'][$i]));
                //$keywords=array_combine($keywords,$keywords);
                foreach($keywords as $words)
                {
                    $related=mysql_db::get_records_by_key("select distinct * from content where enabled>1 and language='$l' and keywords like '%".$words."%' and id<>'".$id."' order by id desc limit 2");
                    foreach($related['id'] as $key=>$value)
                    {
                        if($related['permission'][$key]==1 || ($related['permission'][$key]==2 && $_SESSION['username']!='' && membership::content_member($value)))
                        {
                            if($related['type'][$key]=='')
                            {
                                $type=mysql_db::get_records_by_key("select `type` from content where id='".$related['parent'][$key]."'");
                                $related['type'][$key]=$type['type'][0];
                                $event='view';
                            }
                            else
                            {
                                $event='browse';
                            }
                            //if($related['type'][$key]=='books' || $related['type'][$key]=='news' || $related['type'][$key]=='video' || $related['type'][$key]=='pro'){$event='view';}else{$event='browse';}
                            $content.=++$o.'- ';
                            $content.='<a title="'.$related['title'][$key].'" style="text-decoration:underline;font-size:11px;" href="?l='.$l.'&id='.$related['id'][$key].'&type='.$related['type'][$key].'&page=content&event='.$event.'&title='.$related['title'][$key].'">';
                            $content.=$related['title'][$key];
                            $content.='</a>';
                            $content.='<br /> ';
                        }
                    }
                }
            }            
       }
    }
    function view($l='')
    {
       $html=self::template_include();
       self::data_cloud($l,'',$content);
       $html=str_replace('<title_ />',_TAGS,$html);
       $html=str_replace('<tag />',$content,$html);
       $path=self::get_url();       
       $html=str_replace('<path />',$path,$html);
       return $html;
    }
}?>