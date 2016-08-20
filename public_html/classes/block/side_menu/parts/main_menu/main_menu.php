<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright 2012
 * @class main_menu
 */
class main_menu 
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
    protected function data_menu($l,$parent='',& $content='')
    {
       $res=mysql_db::get_records_by_key("select id,title,`type`,menu,permission,descr from content where enabled>1 and menu='2' and language='$l' and `type`<>'' and parent='$parent' order by ordered");
       //echo count($res[id]).'<br />';
       if(count($res[id])>0)
       {
        if($parent=='')
        {
            $class='class="art-vmenu"';            
        }
        else
        {
            $class='';            
        }
        $content.='<ul '.$class.' id="ul_'.$parent.'">';        
        $tag=true;
       }
       else
       {
        $tag=false;
       }
       for($i=0;$i<count($res['id']);$i++)
       {
            $no=mysql_db::get_rec_no("content where parent='".$res[id][$i]."' and enabled>1 and menu='2' and language='$l' and `type`<>''");
            if($no>0)
            {
                $href='javascript://';
            }
            else
            {
                $href='';
            }
            $sons=mysql_db::get_records("select id from content where parent='".$res[id][$i]."' and type='' and enabled>1 and language='$l'");
            //print_r($sons);
            if($_GET['id']==$res[id][$i] || in_array($_GET['id'],$sons[0]))
            {
                $selected=' class="active"';
                //$content.='<script type="text/javascript">';
//                $content.='_("#ul_'.$parent.'").show();';
//                $bool&=false;
//                $content.='</script>';
            }
            else
            {
                //$bool&=true;
                $selected='';
            }
            if($res['permission'][$i]==1)
            {
                //$content.='<div><a href="page_'.$l.'_'.$res['id'][$i].'_'.$res['type'][$i].'_content_'.$brand.'_0_'.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a></div>';
                $content.='<li>';
                $content.='<a title="'.$res['descr'][$i].'"'.$selected.' id="li_'.$res[id][$i].'" href="'.$href.'?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=0&title='.clean::clean_url($res['title'][$i]).'">';
                if($parent==''){$content.='<span class="l"></span><span class="r"></span><span class="t">';}                
                $content.=$res['title'][$i];
                if($parent==''){$content.='</span>';}                
                $content.='</a>';
                if($no>0)
                {
                    $content.=self::data_menu($l,$res['id'][$i],$content);
                    $content.='<script type="text/javascript">';
                    $content.='_("#li_'.$res[id][$i].'").click(function(){_("#ul_'.$res[id][$i].'").slideToggle(\'slow\');});';
                    $content.='_("#ul_'.$res[id][$i].'").hide();';
                    $content.='</script>';
                }
                $content.='</li><li class="art-vsubmenu-separator-span"></li>';
            }
            elseif($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i]))
            {
                //$content.='<div><a href="page_'.$l.'_'.$res['id'][$i].'_'.$res['type'][$i].'_content_'.$brand.'_0_'.clean::clean_url($res['title'][$i]).'">'.$res['title'][$i].'</a></div>';
                $content.='<li>';
                $content.='<a title="'.$res['descr'][$i].'"'.$selected.' id="li_'.$res[id][$i].'" href="'.$href.'?l='.$l.'&id='.$res['id'][$i].'&type='.$res['type'][$i].'&page=content&event=0&title='.clean::clean_url($res['title'][$i]).'">';
                if($parent==''){$content.='<span class="l"></span><span class="r"></span><span class="t">';}                
                $content.=$res['title'][$i];
                if($parent==''){$content.='</span>';}                
                $content.='</a>';
                if($no>0)
                {
                    $content.=self::data_menu($l,$res['id'][$i],$content);
                    $content.='<script type="text/javascript">';
                    $content.='_("#li_'.$res[id][$i].'").click(function(){_("#ul_'.$res[id][$i].'").slideToggle(\'slow\');});';
                    $content.='_("#ul_'.$res[id][$i].'").hide();';
                    $content.='</script>';
                }
                $content.='</li>';
            }
            else
            {
                //echo str_replace('<content_tag />','No permission',$html);
            }
        //$content.=self::data_menu($l,$res['id'][$i],$content);
       }
       if($tag)
       {
        $content.='</ul>';
       }
    }
    protected function show_grand_father($id,& $content='')
    {
        $pa=mysql_db::get_records_by_key("select parent from content where id='$id'");
        $content.='<script type="text/javascript">';
        $content.='_("#ul_'.$pa[parent][0].'").show();';
        $content.='</script>';
        if($pa[parent][0]!='')
        {
            $content.=self::show_grand_father($pa[parent][0],$content);
        }
    }
    function view($l='')
    {
       $html=self::template_include();
       self::data_menu($l,'',$content);
       if(!empty($_GET['id']))
       {
            self::show_grand_father($_GET['id'],$content);
       }
       $html=str_replace('<tag />',$content,$html);
       $html=str_replace('<title_ />',_MAIN_MENU,$html);
       $path=self::get_url();       
       $html=str_replace('<path />',$path,$html);
       return $html;
    }
}?>