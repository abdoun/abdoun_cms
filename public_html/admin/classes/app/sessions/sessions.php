<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class sessions
 */
class sessions 
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $type = Array(1=>'مقالي',2=>'موضوعي');
    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    
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
    protected function get_forms($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from forms where enabled>1 order by ordered asc");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from forms where id=$id");
            return $re[name][0];
        }        
    }
    protected function get_members($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from members where active>1 order by name asc");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from members where id=$id");
            return $re[name][0];
        }        
    }
    protected function browse()
    {
        print('<h1 align="right">الاستبانات</h1>');
        //print('<p align="right"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&from=".$this->post['form']).'">إضافة</a></p>');
        if(empty($this->post['form'])){$this->post['form']=$this->get['form'];}
        if($this->post['ip']!=''){$sql.=" and ip like '%".$this->post['ip']."%' ";}
        if($this->post['form']!=''){$sql.=" and `forms`='".$this->post['form']."'";}
        if($this->post['enabled']!=''){$sql.=" and enabled ='".$this->post['enabled']."' ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->get['page']." where 1=1 $sql order by start_date desc $limit")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->get['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        form::open_form('filter_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'"');
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0">');
        print('<td></td><td>');
        form::add_select('form',array(''=>'')+$this->get_forms(),$this->post['form'],'','',' title="الاستمارة"');
        print('</td><td>');
        form::add_select('member',array(''=>'')+$this->get_members(),$this->post['member'],'','',' title="المقيم"');
        print('</td><td>');
        form::add_select('spokesman',array(''=>'')+$this->get_members(),$this->post['spokesman'],'','',' title="الناطق"');
        print('</td><td>');
        //form::add_select('type',array(''=>'')+$this->type,$this->post['type'],'','',' title="نوع السؤال"');
        print('</td><td>');
        form::add_input('ip','text','',$this->post['ip'],' title="IP"');
        print('</td><td>');
        print('</td><td>');
        print('</td><td>');
        print('</td><td colspan="3">');
        form::add_input('submitt','submit','','فلتر');
        print('</tr>');
        //form::close_form();
        print('<tr bgcolor="#a0a0a0"><td>الرقم</td><td>الاستمارة</td><td>المقيم</td><td>الناطق</td><td>التاريخ</td><td>الأي بي</td><td>الجهاز</td><td>الصفحة السابقة</td><td>النتائج</td><td>تعديل</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$this->get_forms($res['forms']).'</td><td>'.$this->get_members($res['member']).'</td><td>'.$this->get_members($res['spokesman']).'</td><td>'.$res['start_date'].'</td><td>ip</td><td>'.$res['device'].'</td><td>'.$res['referrer_page'].'</td><td><a href="'.box::popup("page=results&class=results&event=browse&session=$res[id]").'">النتائج</a></td></td><td><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&id=$res[id]").'"></a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=delete&id=$res[id]").'}">حذف</a></td></tr>');
        }
        //form::open_form('paging_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        print('<tr bgcolor="#a0a0a0"><td>'.mysql_num_rows($rec).'</td><td colspan="11">');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){sessions.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="sessions"></span> &nbsp; ');
        //form::add_input('name','hidden','',$this->post['name']);
        //form::add_input('enabled','hidden','',$this->post['enabled']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        print('</td></tr>');
        print('<table>');
        form::close_form();
    }
    protected function sort()
    {
        if(!empty($this->get['id']) && !empty($this->get['no']) && !empty($this->get['state']))
        {
            $ordered=$this->get['no'] + ($this->get['state']);
            mysql_db::exec_query("update ".$this->get['page']." set ordered='".$ordered."' where id='".$this->get['id']."'");
        }
        $this->browse();
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff">');
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
            $record['form'][0]=$this->get['form'];
        }
        //print('<form action="main.php?page='.$this->get[page].'&event=act" method="post" name="add_edit" id="add_edit">');
        form::open_form('add_edit','main.php?page='.$this->get[page].'&class='.$this->get["class"].'&event=act','post',' id="add_edit"');
        print('<table dir="rtl" align="right">');
        //print('<tr bgcolor="#cccccc"><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record[ordered][0]);print('</td></tr>');
        //print('<tr bgcolor="#cccccc"><td>السؤال:</td><td>');form::add_input('question','text','',$record['question'][0]);print('</td></tr>');
        //print('<tr bgcolor="#cccccc"><td>الاستمارة:</td><td>');form::add_select('form',$this->get_forms(),$this->get_forms($record['form'][0]),'','',' title="الاستمارة"');print('</td></tr>');
        //print('<tr bgcolor="#cccccc"><td>النوع:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        //print('<tr bgcolor="#cccccc"><td>تفعيل:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr bgcolor="#cccccc"><td colspan="2">');form::add_input('id','hidden','',$record[id][0]);form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        //print('</form>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        //print($this->get[page]);
        //print_r($this->post);
        if(empty($this->post['question']))
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