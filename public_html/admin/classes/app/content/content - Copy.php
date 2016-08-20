<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class content
 */
class content 
{
    protected $params="";
    protected $case="";
    protected $post="";
    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    
    public function __construct($arr='',$post='')
    {
        print('<h1 align="right">تحرير المحتويات</h1>');
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
    protected function browse()
    {
        print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&event=form").'">إضافة</a></p>');
        $re=mysql_db::exec_query("select * from ".$this->params['page']."")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        print('<table>');
        print('<tr bgcolor="#969696"><td>العنوان</td><td>نوع الصفحة</td><td>اللغة</td><td>الحالة</td><td>تعديل</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res[title].'</td><td>'.$res[type].'</td><td>'.$this->status[$res[enabled]].'</td><td><a href="'.box::popup("page=".$this->params['page']."&event=form&id=$res[id]").'">تعديل</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->params['page']."&event=delete&id=$res[id]").'}">حذف</a></td></tr>');
        }
        print('<tr bgcolor="#969696"><td colspan="7">&nbsp;</td></tr>');
        print('<table>');
    }
    protected function form()
    {
        print('<div style="text-align:right;">');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');            
        }
        //print('<form action="main.php?page='.$this->params[page].'&event=act" method="post" name="add_edit" id="add_edit">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&event=act','post',' id="add_edit"');
        print('<table dir="rtl">');
        print('<tr><td>اللغة:</td><td>');form::add_input('name','text','',$record[name][0]);print('</td></tr>');
        print('<tr><td>اسم الموقع:</td><td>');form::add_input('sitename','text','',$record[sitename][0]);print('</td></tr>');
        print('<tr><td>الاختصار:</td><td>');form::add_input('shortcut','text','',$record[shortcut][0]);print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','',$record[keywords][0]);print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('description','textarea','',$record[description][0]);print('</td></tr>');
        print('<tr><td>اللغة الافتراضية:</td><td>');form::add_select('default',$this->status,$record['default'][0]);print('</td></tr>');
        print('<tr><td>تفعيل:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('id','hidden','',$record[id][0]);form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        //print('</form>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        //print($this->params[page]);
        //print_r($this->post);
        if(empty($this->post['name']) || empty($this->post['sitename']) || empty($this->post['shortcut']))
        {
            box::showSuccesMessage('عذراً لم تملأ الحقول الضرورية','main.php','&page='.$this->params[page]);
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            //print_r($this->post);
            //print(mysql_db::add_edit_rec($this->params[page],$this->post,$this->post['id']));
            if(!mysql_db::add_edit_rec($this->params[page],$this->post,$this->post['id']))
            {
                box::showSuccesMessage(mysql_error(),'main.php','&page='.$this->params[page]);
            }
            else
            {
                box::showSuccesMessage('شكراً','main.php','&page='.$this->params[page]);
            }            
        }        
    }
    protected function delete()
    {
        if(!empty($this->params[id]))
        {
            if(!@mysql_query("delete from ".$this->params['page']." where id='".$this->params[id]."'"))
            {
                box::showSuccesMessage('عذراً لم يتم الحذف','main.php','&page='.$this->params[page]);
                //print(mysql_error());
            }
            else
            {
                box::showSuccesMessage('شكراً تم الحذف بنجاح','main.php','&page='.$this->params[page]);
            }
        }        
        //$this->browse();        
    }
}?>