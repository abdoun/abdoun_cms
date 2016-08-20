<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class vote
 */
class vote 
{
    protected $params="";
    protected $case="";
    protected $post="";
    protected $language;
    /**
    * @var vote table
    **/

    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    protected $gender = Array('m'=>'ذكر','f'=>'أنثى');
    
    function __construct($arr='',$post='')
    {
        $this->params=$arr;
        $this->post=$post;
        $this->get_language();
        if(!empty($this->params['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
    }
    protected function get_brand($brand='')
    {
        if($brand!='')
        {
            $re=mysql_db::get_records_by_key("select title from content where parent='' and brand=$brand");
            return $re['title'][0];
        }
        else
        {
            return mysql_db::get_records_to_row("select id,title from content where parent=''");
        }
    }
    protected function get_date($ddate=0)
    {
        if($ddate=="")
        {
            $ddate=0;
        }
        $arr=getdate($ddate);
        return $arr['year'].'/'.$arr['mon'].'/'.$arr['mday'].' '.$arr['hours'].'-'.$arr['minutes'].'-'.$arr['seconds'];
    }
    protected function get_language()
    {
        $this->language=mysql_db::get_records_to_row("select id,name from languages");
    }
    protected function browse()
    {
        print('<h1 align="right">التصويت</h1>');
        print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=form").'">إضافة</a></p>');
        if($this->post['question']!=''){$sql.=" and question like '%".$this->post['question']."%' ";}
        if($this->post['voters']!=''){$sql.=" and voters like '%".$this->post['voters']."%' ";}
        if($this->post['siteId']!=''){$sql.=" and siteId =".$this->post['siteId']." ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->params['page']." where 1=1 $sql $limit")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->params['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0">');
        form::open_form('filter_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'return false;"');
        print('<td></td><td>');
        form::add_input('question','text','',$this->post['question'],' title="السؤال"');
        print('</td><td>');
        form::add_input('voters','text','',$this->post['voters'],' size="4" title="عدد المصوتين"');
        print('<td>');
        form::add_select('siteId',array(''=>'')+$this->language,$this->post['siteId']);
        print('</td><td></td>');
        print('</td><td colspan="2">');
        form::add_input('submitt','submit','','فلتر');
        form::close_form();
        print('</tr>');
        print('<tr bgcolor="#a0a0a0">');
        print('<td></td>');
        print('<td><a href="'.box::href('page='.$this->params['page'].'&class='.$this->params['class'].'&sort=&field=question').'">السؤال</a></td>');
        print('<td><a href="">عدد المصوتين</a></td>');
        print('<td><a href="">اللغة</a></td>');
        print('<td><a href="">الوقت</a></td>');
        print('<td>تعديل</td>');
        print('<td>حذف</td>');
        print('</tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$res['question'].'</td><td>'.$res['voters'].'</td><td>'.$this->language[$res['siteId']].'</td><td dir="ltr">'.$this->get_date($res['insertdate']).'</td><td><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=form&id=$res[id]").'">تعديل</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=delete&id=$res[id]").'}">حذف</a></td></tr>');
        }
        print('<tr bgcolor="#a0a0a0"><td>'.mysql_num_rows($rec).'</td><td colspan="8">');
        form::open_form('paging_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('name','hidden','',$this->post['name']);
        form::add_input('email','hidden','',$this->post['email']);
        form::add_input('language','hidden','',$this->post['language']);
        form::add_input('ip','hidden','',$this->post['ip']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        form::close_form();
        print('</td></tr>');
        print('<table>');
    }
    protected function form()
    {
        print('<div style="text-align:right;direction:rtl;">');
        print('<h1 align="right">التصويت</h1>');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit"');
        if(!empty($this->params['id']))
        {
            $record=mysql_db::get_records_by_key("select * from ".$this->params['page']." where id=".$this->params['id']."");
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            $record['insertdate'][0]=mktime(0,0,0,date("m"),date("d")+7,date("Y"));
        }
        
        print('<table dir="rtl" align="right" style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr><td>السؤال:<font color="#ff0000">*</font></td><td>');form::add_input('question','text','',$record['question'][0]);print(' '.$record['voters'][0]);print('</td></tr>');
        print('<tr><td>الخيار الأول:<font color="#ff0000">*</font></td><td>');form::add_input('an1','text','',$record['an1'][0]);print(' '.$record['vo1'][0]);print('</td></tr>');
        print('<tr><td>الخيار الثاني:<font color="#ff0000">*</font></td><td>');form::add_input('an2','text','',$record['an2'][0]);print(' '.$record['vo1'][0]);print('</td></tr>');
        print('<tr><td>الخيار الثالث:</td><td>');form::add_input('an3','text','',$record['an3'][0]);print(' '.$record['vo3'][0]);print('</td></tr>');
        print('<tr><td>الخيار الرابع:</td><td>');form::add_input('an4','text','',$record['an4'][0]);print(' '.$record['vo4'][0]);print('</td></tr>');
        print('<tr><td>الخيار االخامس:</td><td>');form::add_input('an5','text','',$record['an5'][0]);print(' '.$record['vo5'][0]);print('</td></tr>');
        print('<tr><td>الخيار السادس:</td><td>');form::add_input('an6','text','',$record['an6'][0]);print(' '.$record['vo6'][0]);print('</td></tr>');
        print('<tr><td>الخيار السابع:</td><td>');form::add_input('an7','text','',$record['an7'][0]);print(' '.$record['vo7'][0]);print('</td></tr>');
        print('<tr><td>الخيار الثامن:</td><td>');form::add_input('an8','text','',$record['an8'][0]);print(' '.$record['vo8'][0]);print('</td></tr>');
        print('<tr><td>الخيار التاسع:</td><td>');form::add_input('an9','text','',$record['an9'][0]);print(' '.$record['vo9'][0]);print('</td></tr>');
        print('<tr><td>الخيار العاشر:</td><td>');form::add_input('an10','text','',$record['an10'][0]);print(' '.$record['vo10'][0]);print('</td></tr>');
        print('<tr><td>اللغة:</td><td>');form::add_select('siteId',$this->language,$record['siteId'][0]);print('</td></tr>');
        print('<tr><td>الحالة:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>الوقت:<font color="#ff0000">*</font></td><td>');form::add_input('insertdate','text','',$this->get_date($record['insertdate'][0]),' dir=ltr');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('id','hidden','',$this->params['id']);form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        //print($this->params[page]);
        //print_r($this->post);
        if(empty($this->post['question']) || empty($this->post['an1']) || empty($this->post['an2']) || empty($this->post['insertdate']))
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