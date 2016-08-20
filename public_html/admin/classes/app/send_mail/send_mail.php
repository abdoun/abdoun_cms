<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class send_mail
 */
class send_mail 
{
    protected $get="";
    protected $case="";
    protected $post="";
    
    protected $status = Array(1=>'غير مرسلة',2=>'مرسلة');
    
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
    protected function get_position($id='')
    {
        if($id=='' || $id==0)
        {
            $re=mysql_db::get_records_to_row("select id,name from position where enabled>1");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from position where id=$id");
            return $re[name][0];
        }        
    }
    protected function browse()
    {
        print('<h1 align="right">رسائل النشرة البريدية</h1>');
        print('<span style="margin-right: 10px;width: 200px"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form").'"><img src="images/stock_mail_compose.png" width="80" title="رسالة جديدة" /></a></span>');
        print('<span style="margin-right: 300px;width: 200px"><a href="'.box::href("page=newsletter&class=newsletter&event=browse").'"><img src="images/compose_email.png" width="80" title="العناوين البريدية" /></a></span>');
        if($this->post['name']!=''){$sql.=" and name like '%".$this->post['name']."%' ";}
        if($this->post['sent']!=''){$sql.=" and sent ='".$this->post['sent']."' ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->get['page']." where 1=1 $sql order by sent_date desc $limit")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->get['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;" border="1">');
        form::open_form('filter_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'"');
        print('<tr bgcolor="#cccccc">');
        print('<td>&nbsp;</td><td>');
        form::add_input('subject','text','',$this->post['subject'],' title="الموضوع"');
        print('</td><td>&nbsp;</td><td>&nbsp;</td><td>');
        form::add_select('sent',array(''=>'')+$this->status,$this->post['sent']);
        print('</td><td colspan="3">');
        form::add_input('submitt','submit','','فلتر');
        print('</td></tr>');
        form::close_form();
        print('<tr bgcolor="#cccccc"></td><td><td>الموضوع</td><td>المرسل</td><td>التاريخ</td><td>الحالة</td><td>تعديل</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$res['subject'].'</td><td>'.perm::get_name_user($res['user']).'</td><td>'.$res['sent_date'].'</td><td>'.$this->status[$res['sent']].'</td></td><td><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&id=$res[id]").'"><img src="images/email_compose.png" width="40" title="تعديل" /></a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=delete&id=$res[id]").'}"><img src="images/delete.png" width="40" title="حذف" /></a></td></tr>');
        }
        form::open_form('paging_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        print('<tr bgcolor="#cccccc"><td>'.mysql_num_rows($rec).'</td><td colspan="8">');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('name','hidden','',$this->post['subject']);
        form::add_input('enabled','hidden','',$this->post['sent']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        print('</td></tr>');
        form::close_form();
        print('<table>');
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;">');
        if(!empty($this->get[id]))
        {
            $this->case='تعديل وإرسال';
            print('<h3>تعديل وإرسال</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->get[page]." where id=".$this->get[id]."");
        }
        else
        {
            $this->case='إرسال';
            print('<h3>رسالة جديدة</h3>');            
        }
        //print('<form action="main.php?page='.$this->get[page].'&event=act" method="post" name="add_edit" id="add_edit">');
        form::open_form('add_edit','main.php?page='.$this->get[page].'&class='.$this->get["class"].'&event=act','post',' id="add_edit"');
        //form::open_form('send_form','main.php?page=send_mail&class=send_mail&event=act&','post',' id="send_form" onsubmit="'.box::post('send_form').'"');
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;" dir="rtl" align="right" width="100%">');
        print('<tr><td>');
        form::add_input('subject','text','',$record['subject'][0],' title="الموضوع" size="100"');
        print('</td></tr><tr><td>');
        include_once 'ck-editor/ckeditor/ckeditor.php' ;
        require_once 'ck-editor/ckfinder/ckfinder.php' ;
        //form::add_input('body','textarea');
        if (!class_exists('CKEditor'))
        {
        	printNotFound('CKEditor');
            form::add_input('body','textarea','',$record['body'][0]);
        }
        else
        {
        	$ckeditor = new CKEditor( ) ;
        	$ckeditor->basePath	= 'ck-editor/ckeditor/' ;
        	CKFinder::SetupCKEditor( $ckeditor, 'ck-editor/ckfinder/' ) ;
        	$ckeditor->editor('body',$record['body'][0]);
            //$ckeditor->replaceAll();
        }
        //form::add_input('body','textarea','','','cols="80" rows="10"');
        print('</td></tr><tr><td align="left">');
        form::add_input('id','hidden','',$record[id][0]);
        form::add_input('submit','submit','',$this->case);
        print('</tr>');       
        print('<table>');
        form::close_form();
        //print('</div>');
    }
    protected function act()
    {
        //print($this->get[page]);
        //print_r($_POST);
        if(empty($this->post['subject']) || empty($this->post['body']))
        {
            //box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم تملأ الحقول الضرورية','error.png');
            box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم تملأ الحقول الضرورية','error.png');
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            $now=mysql_fetch_row(mysql_query("select Now();"));
            $this->post['sent_date']=$now[0];
            $this->post['sent']=2;
            $this->post['user']=perm::get_id_user();
            $record=mysql_db::get_records_by_key("select email from newsletter");
            foreach($record[email] as $key=>$value)
            {
                email::send($this->post['subject'],'info@rlcdamascus.com','موقع مجلس قيادة الثورة في دمشق',$value,$this->post['body']);
            }
            
            mysql_db::add_edit_rec($this->get['page'],$this->post,$this->post['id']);
            box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],'شكراً');                        
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