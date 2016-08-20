<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright 2012
 * @class side_bar_control
 */
class side_bar_control
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $status = Array(2=>'تفعيل',1=>'تعطيل');
    protected $active = Array('yes'=>'تفعيل','no'=>'تعطيل');
    
    function __construct($arr='',$post='')
    {
        $this->get=$arr;
        $this->post=$post;
        if(!empty($this->get['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
    }
    function get_conf_classes_folder($fold)
    {
        $folder=dir($fold);
        while($files=$folder->read())
        {
            if($files!="." && $files!=".." && $files!=".htaccess" && is_dir("$fold/".$files))
            {
                include_once("$fold/".$files.'/config.php');
                $arr[$files]['sort']=$sort;
                $arr[$files]['enable']=$enable;
                $arr[$files]['name']=$name;
            }
        }
        array_multisort($arr);
        if(count($arr)>0)
        {
            return $arr;
        }
    }
    protected function browse()
    {
        //print('<p align="right"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form").'">إضافة</a></p>');
        print('<h1 align="right">تطبيقات القسم الجانبي</h1>');
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0"><td></td><td>اسم التطبيق</td><td>المجلد</td><td>تفعيل</td><td>الترتيب</td><td>تعديل</td><td>حذف</td></tr>');
        $arr=$this->get_conf_classes_folder('../classes/block/side_menu/parts');
        foreach($arr as $key=>$value)
        {
            print('<tr bgcolor="#f0f0f0">');
            print('<td></td>');
            print('<td>'.$value['name'].'</td><td>'.$key.'</td><td id="'.$key.'">');
            $this->get['part']=$key;
            $this->get['value']=$value['enable'];
            $this->activate('load');
            //print(form::add_select('activate',$this->active,$value['enable'],'','',' onchange="'.box::href('page='.$this->get['page'].'&class='.$this->get['page'].'&event=activate&part='.$key.'&value=\'+this.value+\'',$key).'"'));
            print('</td>');
            print('<td>');
            print($value['sort']);
            print(' &nbsp; <a href="'.box::href("page=".$this->get['page']."&class=".$this->get['class']."&event=sort&no=".($value['sort'])."&state=+1&part=".$this->get['part']).'"><img src="images/sort1.png" border="0" /></a>');
            if($value['sort']>=2)
            {
                print(' &nbsp; <a href="'.box::href("page=".$this->get['page']."&class=".$this->get['class']."&event=sort&no=".($value['sort'])."&state=-1&part=".$this->get['part']).'"><img src="images/sort0.png" border="0" />');
            }
            print('</td>');
            print('<td><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&id=$res[id]").'"><!--قراءة--></a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=delete&id=$key").'}"></a></td></tr>');
        }
        print('<table>');
    }
    protected function sort()
    {
        $filename = "../classes/block/side_menu/parts/".$this->get['part']."/config.php";
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        //$no=$this->get['no'] + ($this->get['state']);
        $contents=str_replace('$sort='.$this->get['no'],'$sort='.($this->get['no'] + ($this->get['state'])),$contents);
        $h = fopen($filename, "w");
        fwrite($h,$contents);
        fclose($h);
        $this->browse();
    }
    protected function activate($s='change')
    {
        if($s=='change')
        {
            $filename = "../classes/block/side_menu/parts/".$this->get['part']."/config.php";
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            if($this->get['value']=='yes')
            {
                $contents=str_replace('$enable="no"','$enable="'.$this->get['value'].'"',$contents);
                $contents=str_replace('$enable=\'no\'','$enable="'.$this->get['value'].'"',$contents);
            }
            else
            {
                $contents=str_replace('$enable="yes"','$enable="'.$this->get['value'].'"',$contents);
                $contents=str_replace('$enable=\'yes\'','$enable="'.$this->get['value'].'"',$contents);
            }
            $h = fopen($filename, "w");
            fwrite($h,$contents);
            fclose($h);
            //print(addslashes($this->get['value']));
            //print_r($this->get);
        }
        if($this->get['value']=='no')
        {
            print('<a href="'.box::href('page='.$this->get['page'].'&class='.$this->get['page'].'&event=activate&part='.$this->get['part'].'&value=yes',$this->get['part']).'"><img src="images/disable.png" border="0" height="20" /></a>');
        }
        else
        {
            print('<a href="'.box::href('page='.$this->get['page'].'&class='.$this->get['page'].'&event=activate&part='.$this->get['part'].'&value=no',$this->get['part']).'"><img src="images/enable.png" border="0" height="20" /></a>');
        }
        //form::add_select('activate',$this->active,$this->get['value'],'','',' onchange="'.box::href('page='.$this->get['page'].'&class='.$this->get['page'].'&event=activate&part='.$this->get['part'].'&value=\'+this.value+\'',$this->get['part']).'"');
    }
    protected function form()
    {
        
    }
    protected function act()
    {
        //print($this->get[page]);
        //print_r($this->post);
        if(empty($this->post['name']) || empty($this->post['company']) || empty($this->post['username']) || empty($this->post['password']))
        {
            box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم تملأ الحقول الضرورية');
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            //print_r($this->post);
            //print(mysql_db::add_edit_rec($this->get[page],$this->post,$this->post['id']));
            if(!mysql_db::add_edit_rec($this->get[page],$this->post,$this->post['id']))
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'شكراً');
            }            
        }        
    }
    protected function delete()
    {
        if(!empty($this->get[id]))
        {
            if(!@mysql_query("delete from ".$this->get['page']." where id='".$this->get[id]."'"))
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get[page],'عذراً لم يتم الحذف');
                //print(mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get[page],'شكراً تم الحذف بنجاح');
            }
        }        
        //$this->browse();        
    }
}?>