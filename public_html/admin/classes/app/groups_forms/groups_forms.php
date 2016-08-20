<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class groups_forms
 */
class groups_forms 
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
    protected function browse()
    {
        print('<h1 align="right">تحرير مجموعات الاستمارات</h1>');
        print('<p align="right"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form").'">إضافة</a></p>');
        if($this->post['name']!=''){$sql.=" and name like '%".$this->post['name']."%' ";}
        if($this->post['enabled']!=''){$sql.=" and enabled ='".$this->post['enabled']."' ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->get['page']." where 1=1 $sql $limit")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select forms from ".$this->get['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#a0a0a0">');
        form::open_form('filter_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="filter_form" onsubmit="'.box::post('filter_form').'"');
        print('<td></td><td>');
        form::add_input('name','text','',$this->post['name'],' title="المجموعة"');
        print('</td><td>');
        form::add_select('enabled',array(''=>'')+$this->status,$this->post['enabled']);
        print('</td><td colspan="2">');
        form::add_input('submitt','submit','','فلتر');
        form::close_form();
        print('</tr>');
        print('<tr bgcolor="#a0a0a0"></td><td><td>المجموعة</td><td>الحالة</td><td>تعديل</td><td>حذف</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$res['name'].'</td><td>'.$this->status[$res['enabled']].'</td><td><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&id=$res[id]").'">تعديل</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=delete&id=$res[id]").'}">حذف</a></td></tr>');
        }
        print('<tr bgcolor="#a0a0a0"><td>'.mysql_num_rows($rec).'</td><td colspan="8">');
        form::open_form('paging_form','main.php?page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="paging_form" onsubmit="return false;" title="عدد الأسطر"');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="رقم الصفحة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('name','hidden','',$this->post['name']);
        form::add_input('email','hidden','',$this->post['enabled']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form').';return false;"');
        form::close_form();
        print('</td></tr>');
        print('<table>');
    }
    protected function form()
    {
        print('<div style="text-align:right;font-family: tahoma;font-size: 10px;">');
        //$record=mysql_db::get_records_by_key("select * from ".$this->get[page]." where members=".$this->get[id]."");
        $records=mysql_db::exec_query("select groups.name as `group`,groups.id as group_id,groups_forms.forms as forms
                                                FROM groups 
                                                left outer join groups_forms ON groups.id=groups_forms.groups and groups_forms.forms='".$this->get[id]."'
                                                left outer join forms ON forms.id=groups_forms.forms and forms.id='".$this->get[id]."' 
                                                where groups.enabled=2");
        form::open_form('add_edit','main.php?page='.$this->get[page].'&class='.$this->get["class"].'&event=act&id='.$this->get[id],'post',' id="add_edit"');
        print('<table dir="rtl" align="right" style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr><td colspan="2" align="center"><h3>المجموعة</h3></td></tr>');
        while($record=mysql_fetch_array($records))
        {
            if(!empty($record['forms'])){$checked=" checked";}else{$checked="";}
            print('<tr bgcolor="#f0f0f0"><td><input type="checkbox" name="group['.$record['group_id'].']" '.$checked.' /></td><td>'.$record['group'].'</td></tr>');
        }
        //form::add_input('id','hidden','',$this->get["id"]);
        print('<tr><td>');
        form::add_input('submit','submit','','تعديل');
        print('</td><td></td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        //print($this->get[page]);
        //print_r($this->post);
        mysql_db::exec_query("delete from ".$this->get['page']." where forms=".$this->get['id']);
        foreach($this->post[group] as $key=>$value)
        {
            //print($key.":".$value."<br />");
            mysql_db::exec_query("insert into ".$this->get['page']." set forms='".$this->get['id']."',groups='".$key."'");
        }
        box::showSuccesMessage('main.php','&page=forms&class=forms','شكراً');
            //if(!mysql_db::add_edit_rec($this->get['page'],$this->post,$this->post['id']))
//            {
//                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],mysql_error());
//            }
//            else
//            {
//                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],'شكراً');
//            }            
                
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