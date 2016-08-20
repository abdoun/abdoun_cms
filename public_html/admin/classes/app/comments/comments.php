<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class comments
 */
class comments 
{
    protected $get="";
    protected $case="";
    protected $post="";
    
    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    
    function __construct($arr='',$post='')
    {
        print('<h1 align="right">تحرير التعليقات</h1>');
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
    protected function get_content($id_content='',& $html='')
    {
        if($id_content!='')
        {
            $sql=" and id=$id_content";
        }
        else
        {
            $sql='';
        }
        $re=mysql_db::get_records_by_key("select id,title,parent from content where 1=1 $sql");
        $html[].=$re['title'][0].'>';
        if($re['parent'][0]!='')
        {
            $this->get_content($re['parent'][0], $html);
        }
        else
        {
            $html=array_reverse($html);
            foreach($html as $value)
    		{
                $content.=$value;
            }
            print $content;
        }
    }
    protected function get_content_array()
    {
        $re=mysql_db::get_records_by_key("select id from content");
        for($i=0;$i<count($re['id']);$i++)
        {
            ob_start();
            $this->get_content($re['id'][$i]);
            $content = ob_get_contents();
            ob_end_clean();
            $arr[$re['id'][$i]]=substr($content,0,40);
        }
        return $arr;
    }
    protected function get_date($ddate='')
    {
        $arr=getdate($ddate);
        return ''.$arr['year'].'/'.$arr['mon'].'/'.$arr['mday'].' '.$arr['hours'].'-'.$arr['minutes'].'-'.$arr['seconds'].'';
    }
    protected function browse()
    {
        print('<p align="right"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form").'"></a></p>');
        if($this->post['name']!=''){$sql.=" and name like '%".$this->post['name']."%' ";}
        if($this->post['title']!=''){$sql.=" and title like '%".$this->post['title']."%' ";}
        if($this->post['enabled']!=''){$sql.=" and enabled ='".$this->post['enabled']."' ";}
        if($this->get['id_content']!=''){$this->post['id_content']=$this->get['id_content'];}
        if($this->post['id_content']!=''){$sql.=" and id_content ='".$this->post['id_content']."' ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->get['page']." where 1=1 $sql $limit")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->get['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0">');
        form::open_form('filter_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'return false;"');
        print('<td></td><td>');
        form::add_input('name','text','',$this->post['name'],' title="الاسم"');
        print('</td><td>');
        form::add_input('title','text','',$this->post['title'],' title="العنوان"');
        print('</td><td>');
        form::add_select('id_content',array(''=>'')+$this->get_content_array(),$this->post['id_content']);
        print('</td><td>');
        form::add_select('enabled',array(''=>'')+$this->status,$this->post['enabled']);
        print('</td><td colspan="2">');
        form::add_input('submitt','submit','','فلتر');
        form::close_form();
        print('</tr>');
        print('<tr bgcolor="#a0a0a0"></td><td><td>الاسم</td><td>العنوان</td><td>المحتوى</td><td>الحالة</td><td>تعديل</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            ob_start();
            $this->get_content($res['id_content']);
            $content = ob_get_contents();
            ob_end_clean();
            print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$res['name'].'</td><td>'.$res['title'].'</td><td>'.$content.'</td><td>'.$this->status[$res['enabled']].'</td><td><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&id=$res[id]").'">تعديل</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=delete&id=$res[id]").'}">حذف</a></td></tr>');
        }
        print('<tr bgcolor="#a0a0a0"><td>'.mysql_num_rows($rec).'</td><td colspan="8">');
        form::open_form('paging_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('name','hidden','',$this->post['name']);
        form::add_input('title','hidden','',$this->post['title']);
        form::add_input('enabled','hidden','',$this->post['enabled']);
        form::add_input('id_content','hidden','',$this->post['id_content']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        form::close_form();
        print('</td></tr>');
        print('<table>');
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#f0f0f0">');
        if(!empty($this->get[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->get[page]." where id=".$this->get[id]."");
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');            
        }
        ob_start();
        $this->get_content($record[id_content][0]);
        $content = ob_get_contents();
        ob_end_clean();
        //print('<form action="main.php?page='.$this->get[page].'&event=act" method="post" name="add_edit" id="add_edit">');
        form::open_form('add_edit','main.php?page='.$this->get[page].'&class='.$this->get["class"].'&event=act','post',' id="add_edit"');
        print('<table dir="rtl" bgcolor="#f0f0f0" align="right">');
        print('<tr><td>الاسم:</td><td>');form::add_input('name','text','',$record[name][0],' disabled="disabled"');print('</td></tr>');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','',$record[title][0],' disabled="disabled"');print('</td></tr>');
        print('<tr><td>المحتوى:</td><td>');print($content);print('</td></tr>');
        print('<tr><td>التعليق:</td><td>');form::add_input('notes','textarea','',$record[notes][0],' disabled="disabled"');print('</td></tr>');
        print('<tr><td>رد التعليق:</td><td>');form::add_input('admin_note','textarea','',$record['admin_note'][0],' ');print('</td></tr>');
        print('<tr><td>IP:</td><td>');form::add_input('IP','text','','',' disabled="disabled"');print('</td></tr>');
        print('<tr><td>وقت التعليق:</td><td>');form::add_input('ddate','text','',$this->get_date($record[ddate][0]),' disabled="disabled"');print('</td></tr>');
        print('<tr><td>تفعيل:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('id','hidden','',$record[id][0]);form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        //print('</form>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        //print($this->get[page]);
        //print_r($this->post);
        if(empty($this->post['enabled']))
        {
            box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم تملأ الحقول الضرورية');
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            
            if(!mysql_db::add_edit_rec($this->get['page'],$this->post,$this->post['id']))
            {
                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],'شكراً');
            }            
        }        
    }
    protected function delete()
    {
        if(!empty($this->get[id]))
        {
            if(!@mysql_query("delete from ".$this->get['page']." where id='".$this->get[id]."'"))
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم يتم الحذف');
                //print(mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'شكراً تم الحذف بنجاح');
            }
        }        
        //$this->browse();        
    }
}?>