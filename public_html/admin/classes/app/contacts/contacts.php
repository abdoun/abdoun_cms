<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class contacts
 */
class contacts 
{
    protected $params="";
    protected $case="";
    protected $post="";
    /**
    * @var basic_pattern table
    **/

    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    protected $gender = Array('m'=>'ذكر','f'=>'أنثى');
    
    function __construct($arr='',$post='')
    {
        $this->params=$arr;
        $this->post=$post;
        if(!empty($this->params['event']))
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
        //print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=form").'">إضافة</a></p>');
        print('<h1 align="right">طلبات المشتركين</h1>');
        if($this->post['name']!=''){$sql.=" and name like '%".$this->post['name']."%' ";}
        if($this->post['email']!=''){$sql.=" and email like '%".$this->post['email']."%' ";}
        //if($this->post['brand']!=''){$sql.=" and brand ='".$this->post['brand']."' ";}
        if($this->post['ip']!=''){$sql.=" and ip like '%".$this->post['ip']."%' ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->params['page']." where 1=1 $sql order by id desc $limit")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->params['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0">');
        form::open_form('filter_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'return false;"');
        print('<td></td><td>');
        form::add_input('name','text','',$this->post['name'],' title="الاسم"');
        print('</td><td>');
        form::add_input('email','text','',$this->post['email'],' title="البريد الإلكتروني"');
        //print('</td><td>');
        //form::add_select('brand',array(''=>'')+$this->get_brand(),$this->post['brand']);
        print('</td><td></td><td>');
        form::add_input('ip','text','',$this->post['ip'],' title="IP"');
        print('</td><td colspan="2">');
        form::add_input('submitt','submit','','فلتر');
        form::close_form();
        print('</tr>');
        print('<tr bgcolor="#a0a0a0"><td></td><td>الاسم</td><td>البريد الإلكتروني</td><!--<td>brand</td>--><td>الوقت</td><td>IP</td><td>قراءة</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$res['name'].'</td><td>'.$res['email'].'</td><td dir="ltr">'.$this->get_date($res['ddate']).'</td><td>ip</td><td><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=form&id=$res[id]").'">قراءة</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=delete&id=$res[id]").'}">حذف</a></td></tr>');
        }
        print('<tr bgcolor="#a0a0a0"><td>'.mysql_num_rows($rec).'</td><td colspan="8">');
        form::open_form('paging_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('name','hidden','',$this->post['name']);
        form::add_input('email','hidden','',$this->post['email']);
        //form::add_input('brand','hidden','',$this->post['brand']);
        form::add_input('ip','hidden','',$this->post['ip']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        form::close_form();
        print('</td></tr>');
        print('<table>');
    }
    protected function form()
    {
        if(!empty($this->params[id]))
        {
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
        }
        print('<div style="text-align:right;direction:rtl;background-color:#fff;">');
        print('<h1 align="right">طلبات المشتركين</h1>');
        print('<table dir="rtl" style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr><td>الاسم:</td><td>');form::add_input('name','text','',$record['name'][0]);print('</td></tr>');
        print('<tr><td>البريد الإلكتروني:</td><td>');form::add_input('email','text','',$record['email'][0]);print('</td></tr>');
        print('<tr><td>البلد:</td><td>');form::add_input('country','text','',$record['country'][0]);print('</td></tr>');
        print('<tr><td>الجنس:</td><td>');form::add_select('gender',$this->gender,$record['gender'][0]);print('</td></tr>');
        print('<tr><td>الجوال:</td><td>');form::add_input('phone','text','',$record['phone'][0]);print('</td></tr>');
        print('<tr><td>IP:</td><td>');form::add_input('ip','text');print('</td></tr>');
        print('<tr><td>الوقت:</td><td>');form::add_input('ddate','text','',$this->get_date($record['ddate'][0]),' style="direction:ltr;"');print('</td></tr>');
        print('<tr><td>نوع الاتصال:</td><td>');form::add_input('typee','text','',$record['typee'][0]);print('</td></tr>');
        print('<tr><td>ملاحظات:</td><td>');form::add_input('notes','textarea','',$record['notes'][0]);print('</td></tr>');
        print('</table>');
        print('</div>');
    }
    protected function act()
    {
        //print($this->params[page]);
        //print_r($this->post);
        if(empty($this->post['name']) || empty($this->post['sitename']) || empty($this->post['shortcut']))
        {
            box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"],'عذراً لم تملأ الحقول الضرورية');
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            //print_r($this->post);
            //print(mysql_db::add_edit_rec($this->params[page],$this->post,$this->post['id']));
            if(!mysql_db::add_edit_rec($this->params[page],$this->post,$this->post['id']))
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"],mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"],'شكراً');
            }            
        }        
    }
    protected function delete()
    {
        if(!empty($this->params[id]))
        {
            if(!@mysql_query("delete from ".$this->params['page']." where id='".$this->params[id]."'"))
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params[page],'عذراً لم يتم الحذف');
                //print(mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params[page],'شكراً تم الحذف بنجاح');
            }
        }        
        //$this->browse();        
    }
}?>