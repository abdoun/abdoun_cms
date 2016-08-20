<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright 2012
 * @class members
 */
class members
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $status = Array(2=>'تفعيل',1=>'تعطيل');
    
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
    //protected function get_brand($brand='')
//    {
//        if($brand!='')
//        {
//            $re=mysql_db::get_records_by_key("select title from content where parent='' and brand=$brand");
//            return $re['title'][0];
//        }
//        else
//        {
//            return mysql_db::get_records_to_row("select id,title from content where parent=''");
//        }
//    }
    protected function get_date($ddate='')
    {
        $arr=getdate($ddate);
        return ''.$arr['year'].'/'.$arr['mon'].'/'.$arr['mday'].' '.$arr['hours'].'-'.$arr['minutes'].'-'.$arr['seconds'].'';
    }
    protected function browse()
    {
        //print_r($this->post);
        //print('<p align="right"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form").'">إضافة</a></p>');
        print('<h1 align="right">الأعضاء</h1>');
        if($this->post['name']!=''){$sql.=" and name like '%".$this->post['name']."%' ";}
        if($this->post['username']!=''){$sql.=" and username like '%".$this->post['username']."%' ";}
        if($this->post['email']!=''){$sql.=" and email like '%".$this->post['email']."%' ";}
        //if($this->post['brand']!=''){$sql.=" and brand ='".$this->post['brand']."' ";}
        if($this->post['active']!=''){$sql.=" and active ='".$this->post['active']."' ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->get['page']." where 1=1 $sql order by ddate desc $limit")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->get['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0">');
        form::open_form('filter_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'return false;"');
        print('<td></td><td>');
        form::add_input('name','text','',$this->post['name'],' title="الاسم"');
        print('</td><td>');
        form::add_input('username','text','',$this->post['username'],' title="اسم المستخدم"');
        print('</td><td>');
        form::add_input('email','text','',$this->post['email'],' title="البريد الإلكتروني"');
        print('</td><td>');
        //form::add_select('brand',array(''=>'')+$this->get_brand(),$this->post['brand']);
        //print('</td><td>');
        print('</td><td>');
        form::add_select('active',array(''=>'')+$this->status,$this->post['active']);
        print('</td><td colspan="3">');
        form::add_input('submitt','submit','','فلتر');
        form::close_form();
        print('</tr>');
        print('<tr bgcolor="#a0a0a0"><td></td><td>الاسم</td><td>اسم المستخدم</td><td>البريد الإلكتروني</td><td>الوقت</td><td>الحالة</td><td>المجموعات</td><td>تعديل</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$res['name'].'</td><td>'.$res['username'].'</td><td>'.$res['email'].'</td><td dir="ltr">'.$this->get_date($res['ddate']).'</td><td>'.$this->status[$res['active']].'</td><td><a href="'.box::popup("page=groups_members&class=groups_members&event=form&id=$res[id]").'">المجموعات</a></td><td><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&id=$res[id]").'">قراءة</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=delete&id=$res[id]").'}">حذف</a></td></tr>');
        }
        print('<tr bgcolor="#a0a0a0"><td>'.mysql_num_rows($rec).'</td><td colspan="10">');
        form::open_form('paging_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('name','hidden','',$this->post['name']);
        form::add_input('username','hidden','',$this->post['username']);
        form::add_input('email','hidden','',$this->post['email']);
        //form::add_input('brand','hidden','',$this->post['brand']);
        form::add_input('active','hidden','',$this->post['active']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        form::close_form();
        print('</td></tr>');
        print('<table>');
    }
    protected function form()
    {
        if(!empty($this->get[id]))
        {
            $record=mysql_db::get_records_by_key("select * from ".$this->get[page]." where id=".$this->get[id]."");
            $this->case='تعديل';
        }
        print('<div style="text-align:right;direction:rtl;">');
        print('<h1 align="right">معلومات العضو</h1>');
        form::open_form('add_edit','main.php?page='.$this->get[page].'&class='.$this->get["class"].'&event=act','post',' id="add_edit"');
        print('<table dir="rtl" style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr><td>الحالة:</td><td>');form::add_select('active',$this->status,$record['active'][0]);print('</td></tr>');
        print('<tr><td>الاسم:</td><td>');form::add_input('name','text','',$record['name'][0]);print('</td></tr>');
        print('<tr><td>اسم المستخدم:</td><td>');form::add_input('username','text','',$record['username'][0]);print('</td></tr>');
        print('<tr><td>كلمة المرور:</td><td>');form::add_input('password','text','',$record['password'][0]);print('</td></tr>');
        print('<tr><td>البريد الإلكتروني:</td><td>');form::add_input('email','text','',$record['email'][0]);print('</td></tr>');
        print('<tr><td>الوقت:</td><td>');form::add_input('ddate','text','',$this->get_date($record['ddate'][0]),' style="direction:ltr;" disabled="disabled"');print('</td></tr>');
        print('<tr><td>الصورة:</td><td>');print('<a href="../upload/members/'.$record['picture'][0].'" target="_blank"><img src="../upload/members/'.$record['picture'][0].'" width="120" height="120" border="0" /></a>');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('id','hidden','',$record['id'][0]);form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        //print($this->get[page]);
        //print_r($this->post);
        if(empty($this->post['name']) || empty($this->post['username']) || empty($this->post['password']))
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