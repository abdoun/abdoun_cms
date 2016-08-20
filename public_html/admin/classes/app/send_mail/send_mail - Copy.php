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
        print('<h1 align="right">مراسلة الأعضاء</h1>');
        //print('<p align="right"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form").'">إضافة</a></p>');
        
        ?><form name="send_mail" id="send_mail" onsubmit="_.post('main.php?page=send_mail&class=send_mail&event=act&',_('#send_mail').serialize(),function(data){_('#bTarTd').html(data);},'html');return false;"><?
        //form::open_form('send_form','main.php?page=send_mail&class=send_mail&event=act&','post',' id="send_form" onsubmit="'.box::post('send_form').'"');
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr><td>');
        foreach($this->get_position() as $key=>$value)
        {
            //if(in_array($key,$val)){$selected=' checked';}else{$selected='';}
            form::add_input('position'.$key,'checkbox','',$key,' id="position'.$key.'"');
            print($value);
            print('<br />');
        }
        form::add_input('type_2','checkbox','','2');print('التجمعات الداخلية');print('<br />');
        form::add_input('type_3','checkbox','','3');print('التجمعات الخارجية');
        print('</td></tr><tr><td>');
        form::add_input('subject','text','','',' title="الموضوع" size="80"');
        print('</td></tr><tr><td>');
        //include_once 'js/ck-editor/ckeditor/ckeditor.php' ;
        //require_once 'js/ck-editor/ckfinder/ckfinder.php' ;
        //form::add_input('body','textarea');
        //if (!class_exists('CKEditor'))
//        {
//        	printNotFound('CKEditor');
//            form::add_input('body','textarea');
//        }
//        else
//        {
//        	$ckeditor = new CKEditor( ) ;
//        	$ckeditor->basePath	= 'js/ck-editor/ckeditor/' ;
//        	CKFinder::SetupCKEditor( $ckeditor, 'js/ck-editor/ckfinder/' ) ;
//        	$ckeditor->editor('body');
//            //$ckeditor->replaceAll();
//        }
        form::add_input('body','textarea','','','cols="80" rows="10"');
        print('</td></tr><tr><td align="left">');
        form::add_input('submitt','submit','','إرسال');
        print('</tr>');       
        print('</td></tr>');
        print('<table>');
        form::close_form();
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
        }
        //print('<form action="main.php?page='.$this->get[page].'&event=act" method="post" name="add_edit" id="add_edit">');
        form::open_form('add_edit','main.php?page='.$this->get[page].'&class='.$this->get["class"].'&event=act','post',' id="add_edit"');
        print('<table dir="rtl" align="right">');
        print('<tr bgcolor="#cccccc"><td>المجموعة:</td><td>');form::add_input('name','text','',$record[name][0]);print('</td></tr>');
        print('<tr bgcolor="#cccccc"><td>تفعيل:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr bgcolor="#cccccc"><td colspan="2">');form::add_input('id','hidden','',$record[id][0]);form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        //print('</form>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        //print($this->get[page]);
        print_r($_POST);
        $bool=false;
        foreach($this->get_position() as $key=>$value)
        {
            if(!empty($this->post['position'.$key]))
            {
                $bool=true;
                break;
            }
        }
        if(empty($this->post['subject']) || empty($this->post['body']) || (empty($this->post['type_2']) && empty($this->post['type_3']) && !$bool))
        {
            //box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم تملأ الحقول الضرورية','error.png');
            print('<center><img src="images/error.png" /><br />عذراً لم تملأ الحقول الضرورية</center>');
        }
        else
        {
            foreach($this->get_position() as $key=>$value)
            {
                if(!empty($this->post['position'.$key]))
                {
                    $to=mysql_db::get_records_by_key("select AES_DECRYPT(email,'".Allconstants::_KEY."') as email from membership where position like '%".$this->post['position'.$key].",%'");
                    for($i=0;$i<count($to['email']);$i++)
                    {
                        email::send($this->post['subject'],'info@rlc-damascus.com','مكتب العضوية - مجلس قيادة الثورة في دمشق',$to['email'][$i],$this->post['body']);
                    }
                }
            }
            if(!empty($this->post['type_2']))
            {
                $to=mysql_db::get_records_by_key("select AES_DECRYPT(email,'".Allconstants::_KEY."') as email from membership where type_='".$this->post['type_2']."'");
                for($i=0;$i<count($to['email']);$i++)
                {
                    email::send($this->post['subject'],'info@rlc-damascus.com','مكتب العضوية - مجلس قيادة الثورة في دمشق',$to['email'][$i],$this->post['body']);
                }
            }
            if(!empty($this->post['type_3']))
            {
                $to=mysql_db::get_records_by_key("select AES_DECRYPT(email,'".Allconstants::_KEY."') as email from membership where type_='".$this->post['type_3']."'");
                for($i=0;$i<count($to['email']);$i++)
                {
                    email::send($this->post['subject'],'info@rlc-damascus.com','مكتب العضوية - مجلس قيادة الثورة في دمشق',$to['email'][$i],$this->post['body']);
                }
            }
            print('<center><img src="images/error.png" /><br />لم يتم الإرسال</center>');
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