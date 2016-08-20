<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class languages
 */
class languages 
{
    protected $params="";
    protected $case="";
    protected $post="";
    /**
    * @var languages table
    **/
//    protected $id;
//    protected $name;
//    protected $sitename;
//    protected $enabled;
//    protected $shortcut;
//    protected $flag;
//    protected $keywords;
//    protected $description;
//    protected $default;
    
    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    
    function __construct($arr='',$post='')
    {
        print('<h1 align="right">تحرير اللغات</h1>');
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
        print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=form").'">إضافة</a></p>');
        if($this->post['name']!=''){$sql.=" and name like '%".$this->post['name']."%' ";}
        if($this->post['sitename']!=''){$sql.=" and sitename like '%".$this->post['sitename']."%' ";}
        if($this->post['shortcut']!=''){$sql.=" and shortcut like '%".$this->post['shortcut']."%' ";}
        if($this->post['enabled']!=''){$sql.=" and enabled ='".$this->post['enabled']."' ";}
        if($this->post['default']!=''){$sql.=" and `default` ='".$this->post['default']."' ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->params['page']." where 1=1 $sql $limit")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->params['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0">');
        form::open_form('filter_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'return false;"');
        print('<td></td><td>');
        form::add_input('name','text','',$this->post['name'],' title="اللغة"');
        print('</td><td>');
        form::add_input('sitename','text','',$this->post['sitename'],' title="عنوان الموقع"');
        print('<td>');
        form::add_input('shortcut','text','',$this->post['shortcut']);
        print('</td><td>');
        form::add_select('enabled',array(''=>'')+$this->status,$this->post['enabled']);
        print('</td><td>');
        form::add_select('default',array(''=>'')+$this->status,$this->post['default']);
        print('</td>');
        print('</td><td colspan="2">');
        form::add_input('submitt','submit','','فلتر');
        form::close_form();
        print('</tr>');
        print('<tr bgcolor="#a0a0a0"></td><td><td>اللغة</td><td>اسم الموقع</td><td>اختصار</td><td>الحالة</td><td>افتراضية</td><td>تعديل</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"></td><td><td>'.$res['name'].'</td><td>'.$res['sitename'].'</td><td>'.$res['shortcut'].'</td><td>'.$this->status[$res['enabled']].'</td><td>'.$this->status[$res['default']].'</td><td><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=form&id=$res[id]").'">تعديل</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->params['page']."&class=".$this->params['class']."&event=delete&id=$res[id]").'}"></a></td></tr>');
        }
        print('<tr bgcolor="#a0a0a0"><td>'.mysql_num_rows($rec).'</td><td colspan="8">');
        form::open_form('paging_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('name','hidden','',$this->post['name']);
        form::add_input('email','hidden','',$this->post['email']);
        form::add_input('brand','hidden','',$this->post['brand']);
        form::add_input('ip','hidden','',$this->post['ip']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        form::close_form();
        print('</td></tr>');
        print('<table>');
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#ffffff">');
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
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit"');
        print('<table dir="rtl" bgcolor="#ffffff" align="right">');
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
            box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"],'عذراً لم تملأ الحقول الضرورية');
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            //print_r($this->post);
            //print(mysql_db::add_edit_rec($this->params[page],$this->post,$this->post['id']));
            /**
            * @todo default language
            **/
            if($this->post['default']=='2')
            {
                mysql_db::exec_query("update languages set `default`='1'")or print(mysql_error());
            }
            if(!mysql_db::add_edit_rec($this->params['page'],$this->post,$this->post['id']))
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
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"],'عذراً لم يتم الحذف');
                //print(mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"],'شكراً تم الحذف بنجاح');
            }
        }        
        //$this->browse();        
    }
}?>