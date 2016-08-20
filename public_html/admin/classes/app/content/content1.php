<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class content
 **/
class content 
{
    protected $params="";
    protected $case="";
    protected $post="";
    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    protected $appearance = Array(1=>'تعطيل',2=>'أسلوب عرض سجلات',3=>'Featured Content Slider by: Chris Coyier',4=>'Featured Content Slider',5=>'jcontent:horizontal,left',6=>'jcontent:horizontal,right',7=>'jcontent:vertical,top',8=>'jcontent:vertical,down',9=>'jcontent:horizontal,button',10=>'jcontent:vertical,button',11=>'شريط شفاف مع صورة كبيرة',12=>'قلاب مع صورة',13=>'عمودين',14=>'صناديق',16=>'Accordion',17=>'Accordion full image');
    protected $appearance_selections= Array(1=>'تعطيل',2=>'أسلوب عرض سجلات',3=>'Featured Content Slider by: Chris Coyier',4=>'Featured Content Slider',5=>'jcontent:horizontal,left',6=>'jcontent:horizontal,right',7=>'jcontent:vertical,top',8=>'jcontent:vertical,down',9=>'jcontent:horizontal,button',10=>'jcontent:vertical,button',11=>'شريط شفاف مع صورة كبيرة',12=>'قلاب مع صورة',13=>'عمودين',14=>'صناديق',15=>'حاويات',16=>'Accordion',17=>'Accordion full image'); 
    protected $appearance_photos = Array(1=>'تعطيل',2=>'أسلوب عرض أيقونات',3=>'Featured Content Slider by: Chris Coyier',4=>'Featured Content Slider',5=>'3DWallGallery',6=>'RevealingPhotoSlider');
    protected $appearance_video = Array(1=>'تعطيل',2=>'أسلوب عرض سجلات',3=>'jcontent video');
    protected $language;
    //protected $type= Array('sec'=>'صفحة متفرعة','body'=>'صفحة محتوى','ext'=>'صفحة خارجية','news'=>'أخبار','files'=>'ملفات','pro'=>'منتجات','vedio'=>'فيديو','image'=>'صور','sound'=>'صوت','link'=>'ارتباط');
    protected $type= Array('sec'=>'صفحة متفرعة','body'=>'صفحة محتوى','ext'=>'تطيبق ويب','news'=>'إخبارية','files'=>'ملفات','pro'=>'منتجات','vedio'=>'فيديو','image'=>'صور','sound'=>'صوت','link'=>'ارتباط','books'=>'كتب','selections'=>'مختارات','sections'=>'أقسام');
    protected $parent;//=Array('main'=>'');
    protected $id_pa;
    //protected $brand;
    
    public function __construct($arr='',$post='')
    {
        $this->params=$arr;
        $this->post=$post;
        $this->get_language();
        $this->get_parent($this->params['id']);
        //$this->get_brand($this->params['id']);
        if(!empty($this->params['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
    }
    protected function get_news_type($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from news_type where enabled>1");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from news_type where id=$id");
            return $re[name][0];
        }        
    }
    protected function get_towns($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from towns where enabled>1");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from towns where id=$id");
            return $re[name][0];
        }        
    }
    protected function get_language()
    {
        $this->language=mysql_db::get_records_to_row("select id,name from languages");
    }
    //protected function get_brand($brand='')
//    {
//        $this->brand=mysql_db::get_records("select title from content where id='".$brand."' and parent=''");
//        return $this->brand[0][0];
//    }
    protected function get_parent($id='')
    {
        $id_pa=mysql_db::get_records("select parent from ".$this->params['page']." where id='$id'");
        $this->id_pa=$id_pa[0][0];
        $this->parent=mysql_db::get_records("select title,type from content where id='".$id_pa[0][0]."'");
    }
    protected function add_button()
    {
        //form::add_select('add',array(''=>'')+$this->type,'','','إضافة',' onchange="if(this.value!=\'\'){'.box::popup("page=".$this->params['page']."&class=' + this.value + '&event=form&parent=".$this->params[id]).'}"');
        print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=sec&event=form&parent=".$this->params[id]).'"><img src="images/plus.png" border="0" title="إضافة" /></a></p>');
    }
    protected function get_title()
    {
        if(!empty($this->params[id]))
        {
            $title=mysql_db::get_records("select title from ".$this->params['page']." where id='".$this->params[id]."'");
            print($title[0][0]);
        }
        else
        {
            print("");
        }
    }
    protected function get_any_title($id)
    {
        if(!empty($id))
        {
            $title=mysql_db::get_records("select title from ".$this->params['page']." where id='".$id."'");
            print($title[0][0]);
        }
        else
        {
            print("");
        }
    }
    protected function browse()
    {
        $this->get_title();
        if(!empty($this->params[id]))
        {
            $sql=" and parent='".$this->params['id']."'";
        }
        else
        {
            $sql=" and parent=''";
        }
        print('<table><tr><td valign="top" bgcolor="#cccccc" style="border:solid #969696 1px;">');
        if($this->params['div']!='body'){tree_menu::menu();}        
        print('</td><td valign="top"><div id="body">');
        $this->add_button();
        if($this->post['title']!=''){$sql.=" and title like '%".$this->post['title']."%' ";}
        if($this->post['type']!=''){$sql.=" and `type`='".$this->post['type']."' ";}
        if($this->post['language']!=''){$sql.=" and language =".$this->post['language']." ";}
        if($this->post['enabled']!=''){$sql.=" and enabled =".$this->post['enabled']." ";}
        if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}else{$limit=' limit 50';}
        $re=mysql_db::exec_query("select * from ".$this->params['page']." where 1=1 $sql order by id desc $limit")or print(mysql_error()." <br />"."select * from ".$this->params['page']." $sql order by ordered<br />"); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->params['page']." where 1=1 $sql")or print(mysql_error()); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;">');
        print('<tr bgcolor="#CCCCCC">');
        form::open_form('filter_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&div=body&id='.$this->params['id'],'post',' id="filter_form" onsubmit="'.box::post('filter_form','body').'return false;"');
        print('<td></td><td>');
        form::add_input('title','text','',$this->post['title'],' title="العنوان"');
        print('</td><td>');
        print('</td><td>');
        form::add_select('type',array(''=>'')+$this->type,$this->post['type']);
        print('<td>');
        form::add_select('language',array(''=>'')+$this->language,$this->post['language']);
        print('</td><td>');
        print('</td><td>');
        print('</td><td>');
        form::add_select('enabled',array(''=>'')+$this->status,$this->post['enabled']);
        print('</td><td>');
        form::add_select('permission',array(''=>'')+$this->status,$this->post['permission']);
        print('</td>');
        print('</td><td colspan="3">');
        form::add_input('submitt','submit','','فلتر');
        form::close_form();
        print('</tr>');
        print('<tr bgcolor="#cccccc"><td>الترتيب</td><td>العنوان</td><td>التاريخ</td><td>نوع الصفحة</td><td>اللغة</td><td>التعليقات</td><td>عدد المشاهدات</td><td>ظهور</td><td>للأعضاء</td><td>المجموعات</td><td>تعديل</td><td>حذف</td></tr>');
        if('supervisor'!=perm::get_perm_user(perm::get_id_user())){$delete_img='<img src="images/delete.png" border="0" height="25" />';}
        while($res=mysql_fetch_array($re))
        {
            if($res['type']=='vedio'){$status=$this->appearance_video;}elseif($res['type']=='image'){$status=$this->appearance_photos;}elseif($res['type']=='news' || $res['type']=='books' || $res['type']=='selections' || $res['type']=='sections'){$status=$this->appearance_selections;}else{$status=$this->status;}
            if($res['type']==''){$type=mysql_db::get_records("select `type` from ".$this->params['page']." where id='".$res['parent']."'");$res['type']=$type[0][0];}
            print('<tr bgcolor="#f0f0f0"><td>'.$res['ordered'].'</td><td>'.$res['title'].'</td><td>'.$res['_date'].'</td><td>'.$this->type[$res['type']].'</td><td>'.$this->language[$res[language]].'</td><td><a href="javascript:hpReq.getData(\'main.php?page=comments&class=comments&id_content='.$res['id'].'&d=\'+new Date().getTime(),\'bTarTd\');"><img src="images/comments.png" border="0" height="25" width="35" title="التعليقات" /></a></td><td>'.$res['hits'].'</td><td>'.$status[$res[enabled]].'</td><td>'.$status[$res['permission']].'</td><td><a href="'.box::popup("page=groups_news&class=groups_news&event=form&id=$res[id]").'"><img src="images/user_group.png" border="0" height="25" title="المجموعات" /></a></td><td><a href="'.box::popup("page=".$this->params['page']."&class=".$res['type']."&event=form&id=$res[id]&parent=$res[parent]").'"><img src="images/new_edit_find_replace.png" border="0" height="25" /></a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->params['page']."&class=".$this->params["class"]."&event=delete&id=$res[id]").'}">'.$delete_img.'</a></td></tr>');
        }
        print('<tr bgcolor="#cccccc"><td>'.mysql_num_rows($rec).'</td><td colspan="11">');
        form::open_form('paging_form','main.php?page='.$this->params['page'].'&class='.$this->params['class'].'&div=body&id='.$this->params['id'],'post',' id="paging_form" onsubmit="return false;" title="رقم الصفحة"');
        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.mysql_num_rows($rec).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" title="عدد الأسطر في الصفحة الواحدة"');
        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';'.box::post('paging_form','body').';return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');
        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');
        form::add_input('title','hidden','',$this->post['title']);
        form::add_input('type','hidden','',$this->post['type']);
        form::add_input('language','hidden','',$this->post['language']);
        form::add_input('enabled','hidden','',$this->post['enabled']);
        form::add_input('submitt','submit','','طلب',' onclick="'.box::post('paging_form','body').'return false;"');
        form::close_form();
        print('</td></tr>');
        print('</table>');
        print('</div></td></tr></table>');
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
            form::add_input('id','hidden','',$record[id][0]);
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,title as parent_name from ".$this->params[page]." where id=".$this->params['parent']."");
                $record['parent'][0]=$this->params['parent'];
            }
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['body'][0]='<p dir="rtl"><strong><span style="font-size: 16px"><span style="color: #696969">نموذج</span></span></strong></p>';
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        if(empty($record['parent'][0]) && $this->case=='إضافة')
        {
            print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
        }
        else
        {
            print('<tr><td>اللغة:</td><td>');print($this->language[$record[language][0]]);form::add_input('language','hidden','',$record[language][0]);print('</td></tr>');
        }
        //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
        print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);print($this->parent[0][0].$record['parent_name'][0]);print('</td></tr>');
        //print('<tr><td>نوع الصفحة:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
        //print('<tr><td>المحتوى:</td><td>');form::add_input('body','textarea','',$record[body][0]);print('</td></tr>');
        print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
        print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
        print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
        print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
        //print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
        if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$record['parent'][0]);}
        print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
        print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
    protected function act()
    {
        if(is_uploaded_file($_FILES['icon']['tmp_name']))
        {
            copy($_FILES['icon']['tmp_name'],'../upload/'.$_FILES['icon']['name']);
            $this->post['icon']=$_FILES['icon']['name'];            
        }
        if(empty($this->post["parent"]))
        {
            //$class='sec';
            $class='content';
        }
        else
        {
            $type_parent=mysql_db::get_records_by_key("select type from ".$this->params['page']." where id=".$this->post['parent']."");
            $class=$type_parent[0][0];
        }
        if(empty($this->post['title']) || empty($this->post['language']) || empty($this->post['descr']) || empty($this->post['keywords']))
        {
            box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$class.'&id='.$this->post['parent'].'&div=body','<p align="center">عذراً لم تملأ الحقول الضرورية</p>','error.png','body');
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            if(!mysql_db::add_edit_rec($this->params['page'],$this->post,$this->post['id']))
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$class.'&id='.$this->post['parent'].'&div=body',mysql_error(),'error.png','body');
            }
            else
            {
                if(empty($this->post["parent"]) && empty($this->post['id']))
                {
                    //$last_id=mysql_insert_id(); 
                    //mysql_db::exec_query("update content set `brand`='$last_id' where id='$last_id'")or print(mysql_error());
                    //print("update content set `brand`='$last_id' where id='$last_id'");
                }
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$class.'&id='.$this->post['parent'].'&','<center>شكراً</center>');                
                //box::showSuccesMessage('main.php','&page=content&class='.$class.'&id='.$this->post['parent'].'&','<center>شكراً</center>');
            }
        }//print('&page='.$this->params[page].'&class='.$class.'&id='.$this->post['parent'].'&');
    }
    protected function delete_once()
    {
        if(!empty($this->params[id]))
        {
            //print($this->params[id]."<br />");//
            mysql_db::delete_rec($this->params['page'],$this->params['id']);
            $ids=mysql_db::get_records("select id from ".$this->params['page']." where parent=".$this->params['id']."");
            if($ids!=false)
            {
                for($i=0;$i<count($ids[0]);$i++)
                {
                    $this->params['id']=$ids[0][$i];
                    $this->delete_once();
                }
            }
        }
    }
    protected function delete()
    {
        $this->delete_once();
        box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"].'&id='.$this->id_pa.'&','<center>شكراً تم الحذف بنجاح</center>');
    }
    protected function old_delete_once()
    {
        if(!empty($this->params[id]))
        {
            if(!mysql_db::delete_rec($this->params['page'],$this->params[id]))
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"].'&id='.$this->id_pa.'&div=body','<center>عذراً لم يتم الحذف</center>','body');
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->params[page].'&class='.$this->params["class"].'&id='.$this->id_pa.'&div=body','<center>شكراً تم الحذف بنجاح</center>','body');
            }
        }        
    }
}
class link extends ext
{
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
            form::add_input('id','hidden','',$record[id][0]);
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,title as parent_name from ".$this->params[page]." where id=".$this->params['parent']."");
                $record['parent'][0]=$this->params['parent'];
            }
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['body'][0]='<p dir="rtl"><strong><span style="font-size: 16px"><span style="color: #696969">نموذج</span></span></strong></p>';
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
            $record['body'][0]='';
        }
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        if(empty($record['parent'][0]))
        {
            print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
        }
        else
        {
            print('<tr><td>اللغة:</td><td>');print($this->language[$record[language][0]]);form::add_input('language','hidden','',$record[language][0]);print('</td></tr>');
        }
        
        print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
        //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
        //print('<tr><td>نوع الصفحة:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
        print('<tr><td>الارتباط:</td><td>');form::add_input('body','text','',$record['body'][0],' size="60"');print('</td></tr>');
        print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
        print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
        print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
        print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
        //print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
        //print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
        if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
        print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
        print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
}
class ext extends content
{
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
            form::add_input('id','hidden','',$record[id][0]);
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,title as parent_name from ".$this->params[page]." where id=".$this->params['parent']."");
                $record['parent'][0]=$this->params['parent'];
            }
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['body'][0]='<p dir="rtl"><strong><span style="font-size: 16px"><span style="color: #696969">نموذج</span></span></strong></p>';
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        if(empty($record['parent'][0]))
        {
            print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
        }
        else
        {
            print('<tr><td>اللغة:</td><td>');print($this->language[$record[language][0]]);form::add_input('language','hidden','',$record[language][0]);print('</td></tr>');
        }
        
        print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
        //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
        //print('<tr><td>نوع الصفحة:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],' size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],' size="120"');print('</td></tr>');
        print('<tr><td>التطبيق:</td><td>');form::add_select('body',inclusion::get_name_classes_folder('../classes/block/page/app'),$record[body][0]);print('</td></tr>');
        print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
        print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
        print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
        print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
        print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
        //print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
        if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
        print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
        print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
}
class selections extends content
{
    protected function act()
    {
        $this->post['body']=join(',',$this->post['body']);            
        
        //print($this->post['body']);
        parent::act();
    }
    protected function get_selections_sec($l)
    {
        $arr=mysql_db::get_records_to_row("select id,title from content where (`type`='news' or `type`='books' or `type`='vedio') and enabled>1 and language='".$l."' order by ordered,id asc");
        foreach($arr as $id=>$title)
        {
            $array[$id]=$title;
            //$arra=mysql_db::get_records_to_row("select id,title from content where (`type`='') and enabled>1 and parent='$id' and language='".$l."' order by id desc");
            //foreach($arra as $key=>$value)
            //{
            //    $array[$key]=$title.'>'.$value;
            //}
        }        
        return $array;
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
            form::add_input('id','hidden','',$record[id][0]);
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,title as parent_name from ".$this->params[page]." where id=".$this->params['parent']."");
                $record['parent'][0]=$this->params['parent'];
            }
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        if(empty($record['parent'][0]))
        {
            print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
        }
        else
        {
            print('<tr><td>اللغة:</td><td>');print($this->language[$record[language][0]]);form::add_input('language','hidden','',$record[language][0]);print('</td></tr>');
        }
        
        print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
        //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
        //print('<tr><td>نوع الصفحة:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
        print('<tr><td>المحتوى:</td><td>');form::add_select_multiple('body[]',$this->get_selections_sec($record['language'][0]),explode(',',$record[body][0]),'12','','multiple=""');print('</td></tr>');
        print('<tr><td>ظهور:</td><td>');form::add_select('enabled',$this->appearance_selections,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
        print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
        print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance_selections,$record['main'][0]);print('</td></tr>');
        print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
        print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
        //print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
        if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
        print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
        print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
}
class sections extends content
{
    protected function act()
    {
        $this->post['body']=join(',',$this->post['body']);            
        
        //print($this->post['body']);
        parent::act();
    }
    protected function get_selections_sec($l)
    {
        $arr=mysql_db::get_records_to_row("select id,title from content where (`type`<>'') and enabled>1 and language='".$l."' order by ordered,id asc");
        foreach($arr as $id=>$title)
        {
            $array[$id]=$title;
            //$arra=mysql_db::get_records_to_row("select id,title from content where (`type`='') and enabled>1 and parent='$id' and language='".$l."' order by id desc");
            //foreach($arra as $key=>$value)
            //{
            //    $array[$key]=$title.'>'.$value;
            //}
        }        
        return $array;
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
            form::add_input('id','hidden','',$record[id][0]);
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,title as parent_name from ".$this->params[page]." where id=".$this->params['parent']."");
                $record['parent'][0]=$this->params['parent'];
            }
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        if(empty($record['parent'][0]))
        {
            print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
        }
        else
        {
            print('<tr><td>اللغة:</td><td>');print($this->language[$record[language][0]]);form::add_input('language','hidden','',$record[language][0]);print('</td></tr>');
        }
        
        print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
        //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
        //print('<tr><td>نوع الصفحة:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
        print('<tr><td>المحتوى:</td><td>');form::add_select_multiple('body[]',$this->get_selections_sec($record['language'][0]),explode(',',$record[body][0]),'12','','multiple=""');print('</td></tr>');
        print('<tr><td>ظهور:</td><td>');form::add_select('enabled',$this->appearance_selections,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
        print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
        print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance_selections,$record['main'][0]);print('</td></tr>');
        print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
        print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
        //print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
        if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
        print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
        print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
}
class sec extends content
{
    protected function add_button()
    {
        form::add_select('add',array(''=>'')+$this->type,'','','<img src="images/plus.png" align="center" title="إضافة" />',' onchange="if(this.value!=\'\'){'.box::popup("page=".$this->params['page']."&class=' + this.value + '&event=form&parent=".$this->params[id]).'}"');
        //print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params["class"]."&event=form&parent=".$this->params[id]).'">إضافة</a></p>');
    }
}
class body extends content
{
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
            form::add_input('id','hidden','',$record[id][0]);
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,title as parent_name from ".$this->params[page]." where id=".$this->params['parent']."");
                $record['parent'][0]=$this->params['parent'];
            }
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['body'][0]='<p dir="rtl"><strong><span style="font-size: 16px"><span style="color: #696969">نموذج</span></span></strong></p>';
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        if(empty($record['parent'][0]))
        {
            print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
        }
        else
        {
            print('<tr><td>اللغة:</td><td>');print($this->language[$record[language][0]]);form::add_input('language','hidden','',$record[language][0]);print('</td></tr>');
        }
        
        print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
        //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
        //print('<tr><td>نوع الصفحة:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
        //print('<tr><td>المحتوى:</td><td>');form::add_input('body','textarea','',$record['body'][0]);print('</td></tr>');
        print('<tr><td>المحتوى:</td><td>');
        include_once 'ck-editor/ckeditor/ckeditor.php' ;
        require_once 'ck-editor/ckfinder/ckfinder.php' ;
        if (!class_exists('CKEditor'))
        {
        	//printNotFound('CKEditor');
            form::add_input('body','textarea','',$record['body'][0]);
        }
        else
        {
        	$ckeditor = new CKEditor( ) ;
        	$ckeditor->basePath	= 'ck-editor/ckeditor/' ;
        	CKFinder::SetupCKEditor( $ckeditor, 'ck-editor/ckfinder/' ) ;
        	$ckeditor->editor('body', $record['body'][0]);
        }
        print('</td></tr>');
        print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
        print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
        print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
        print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
        print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
        print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
        if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
        print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
        print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
    
}
class image extends content
{
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            print('<h3>تعديل</h3>');
            $record=mysql_db::get_records_by_key("select * from ".$this->params[page]." where id=".$this->params[id]."");
            form::add_input('id','hidden','',$record[id][0]);
        }
        else
        {
            $this->case='إضافة';
            print('<h3>إضافة</h3>');
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,title as parent_name from ".$this->params[page]." where id=".$this->params['parent']."");
                $record['parent'][0]=$this->params['parent'];
            }
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            //$record['body'][0]='<p dir="rtl"><strong><span style="font-size: 16px"><span style="color: #696969">نموذج</span></span></strong></p>';
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        if(empty($record['parent'][0]))
        {
            print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
        }
        else
        {
            print('<tr><td>اللغة:</td><td>');print($this->language[$record[language][0]]);form::add_input('language','hidden','',$record[language][0]);print('</td></tr>');
        }
        
        print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
        //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
        //print('<tr><td>نوع الصفحة:</td><td>');form::add_select('type',$this->type,$record['type'][0]);print('</td></tr>');
        print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
        print('<tr><td>صورة أو مجلد صور:</td><td>');form::add_input('body','file_selector_','',$record[body][0]);print('</td></tr>');
        print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->appearance_photos,$record['enabled'][0]);print('</td></tr>');
        print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
        print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
        print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
        print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
        print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance_photos,$record['main'][0]);print('</td></tr>');
        print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
        print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
        if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
        print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
        print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
        print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
        print('</table>');
        form::close_form();
        print('</div>');
    }
}
class sound extends content
{
    protected function act()
    {
        if(is_uploaded_file($_FILES['body']['tmp_name']))
        {
            move_uploaded_file($_FILES['body']['tmp_name'],'../upload/'.$_FILES['body']['name']);
            $this->post['body']=$_FILES['body']['name'];            
        }
        //print($this->post['body']);
        parent::act();
    }
    protected function add_button()
    {
        print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params["class"]."&event=form&parent=".$this->params[id]).'"><img src="images/plus.png" border="0" title="إضافة" /></a></p>');
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            $record=mysql_db::get_records_by_key("select * from ".$this->params['page']." where id=".$this->params['id']."");
            $type_parent=mysql_db::get_records_by_key("select type from ".$this->params['page']." where id=".$this->params['parent']."");
            $record['type'][0]=$type_parent['type'][0];
            form::add_input('id','hidden','',$record['id'][0]);
        }
        else
        {
            $this->case='إضافة';
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,`type` from ".$this->params[page]." where id=".$this->params['parent']);
            }            
            $record['parent'][0]=$this->params['parent'];
            $record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }        
        if($record['parent'][0]!='')
            {
                if($record['type'][0]=='sec')//vedio category under a parent
                {                    
                    print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                    print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                    print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                    print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                    print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
                }
                else//ended vedio
                {
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                    print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
                    print('<tr><td>الملف:</td><td>');form::add_input('body','file_selector','',$record['body'][0]);print('</td></tr>');
                    print('<tr><td>نوع الصفحة:</td><td>');print($this->type[$this->params['class']]);print('</td></tr>');
                }                
            }
            else//vedio category has not any parent
            {
                print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
                if(!empty($this->params[id])) //edit
                {
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record[language][0],' ');print('</td></tr>');
                }
                else //add
                {
                    print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record['language'][0],' ');print('</td></tr>');
                }
                print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');                
            }
            print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
            //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
            print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
            print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
            print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
            print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
            print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
            print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
            print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
            print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
            if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
            print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
            print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
            print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
            print('</table>');
            form::close_form();
            print('</div>');
    }
}
class vedio extends content
{
    
    protected function add_button()
    {
        print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params["class"]."&event=form&parent=".$this->params[id]).'"><img src="images/plus.png" border="0" title="إضافة" /></a></p>');
    }
    protected function form()
    {
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            $record=mysql_db::get_records_by_key("select * from ".$this->params['page']." where id=".$this->params['id']."");
            $type_parent=mysql_db::get_records_by_key("select type from ".$this->params['page']." where id=".$this->params['parent']."");
            $record['type'][0]=$type_parent['type'][0];
            form::add_input('id','hidden','',$record['id'][0]);
        }
        else
        {
            $this->case='إضافة';
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,`type`,icon from ".$this->params[page]." where id=".$this->params['parent']);
            }            
            $record['parent'][0]=$this->params['parent'];
            //$record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }        
        if($record['parent'][0]!='')
            {
                if($record['type'][0]=='sec')//vedio category under a parent
                {                    
                    print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                    print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                    print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                    print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
                    print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->appearance_video,$record['enabled'][0]);print('</td></tr>');
                    print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance_video,$record['main'][0]);print('</td></tr>');
                }
                else//ended vedio
                {
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                    print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
                    print('<tr><td>الملف:</td><td>');form::add_input('body','file_selector_','',$record['body'][0]);print('</td></tr>');
                    print('<tr><td>نوع الصفحة:</td><td>');print($this->type[$this->params['class']]);print('</td></tr>');
                    print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
                    print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
                }                
            }
            else//vedio category has not any parent
            {
                print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                if(!empty($this->params[id])) //edit
                {
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record[language][0],' ');print('</td></tr>');
                }
                else //add
                {
                    print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record['language'][0],' ');print('</td></tr>');
                }
                print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
                print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->appearance_video,$record['enabled'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance_video,$record['main'][0]);print('</td></tr>');                
            }
            print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
            //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
            print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
            print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
            print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],'size="120"');print('</td></tr>');
            print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],'size="120"');print('</td></tr>');
            print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
            print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
            print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
            if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
            print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
            print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
            print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
            print('</table>');
            form::close_form();
            print('</div>');
    }
}
class files extends sound
{}
class pro extends news
{}
class books extends news
{
    protected function form()
    {
        print('<link rel="stylesheet" type="text/css" media="all" href="js/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" /><script type="text/javascript" src="js/jscalendar/calendar.js"></script><script type="text/javascript" src="js/jscalendar/lang/calendar-en.js"></script><script type="text/javascript" src="js/jscalendar/calendar-setup.js"></script>');
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            $record=mysql_db::get_records_by_key("select * from ".$this->params['page']." where id=".$this->params['id']."");
            $type_parent=mysql_db::get_records_by_key("select type from ".$this->params['page']." where id=".$this->params['parent']."");
            $record['type'][0]=$type_parent['type'][0];
            form::add_input('id','hidden','',$record['id'][0]);
        }
        else
        {
            $this->case='إضافة';
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,`type`,icon from ".$this->params[page]." where id=".$this->params['parent']);
            }            
            $record['parent'][0]=$this->params['parent'];
            //$record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['body'][0]='<p dir="rtl"><strong><span style="font-size: 16px"><span style="color: #696969">نموذج</span></span></strong></p>';
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }        
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],' size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],' size="120"');print('</td></tr>');
        if($record['parent'][0]!='')
        {
            if($record['type'][0]=='sec')//artilces category under a parent
            {
                print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
                print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->appearance,$record['enabled'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance,$record['main'][0]);print('</td></tr>');
            }
            else//ended an article
            {
                print('<tr><td>المؤلف:</td><td>');form::add_input('_author','text','',$record[_author][0]);print('</td></tr>');
                print('<tr><td>التاريخ:</td><td>');form::add_input('_date','text','',$record[_date][0],'id="_date" dir="ltr"');print('<script type="text/javascript">Calendar.setup({inputField:"_date",button:"_date",align:"Br"});</script>');print('</td></tr>');
                print('<tr><td>الملف:</td><td>');form::add_input('_file','file_selector','',$record[_file][0]);print('</td></tr>');
                print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
                print('<tr><td>المحتوى:</td><td>');
                include_once 'ck-editor/ckeditor/ckeditor.php' ;
                require_once 'ck-editor/ckfinder/ckfinder.php' ;
                if (!class_exists('CKEditor'))
                {
                	//printNotFound('CKEditor');
                    form::add_input('body','textarea','',$record['body'][0]);
                }
                else
                {
                	$ckeditor = new CKEditor( ) ;
                	$ckeditor->basePath	= 'ck-editor/ckeditor/' ;
                	CKFinder::SetupCKEditor( $ckeditor, 'ck-editor/ckfinder/' ) ;
                	$ckeditor->editor('body', $record['body'][0]);
                }
                print('</td></tr>');
                print('<tr><td>نوع الصفحة:</td><td>');print($this->type[$this->params['class']]);print('</td></tr>');
                print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
            }                
        }
            else//articles category has not any parent
            {
                print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                if(!empty($this->params[id])) //edit
                {
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record[language][0],' ');print('</td></tr>');
                }
                else //add
                {
                    print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
                }
                print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
                print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->appearance,$record['enabled'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance,$record['main'][0]);print('</td></tr>');                
            }
            print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
            //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
            
            print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
            print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
            print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
            if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
            print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
            print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
            print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
            print('</table>');
            form::close_form();
            print('</div>');
    }
}
class news extends content
{    
    protected function add_button()
    {
        print('<p align="right"><a href="'.box::popup("page=".$this->params['page']."&class=".$this->params["class"]."&event=form&parent=".$this->params[id]).'"><img src="images/plus.png" border="0" title="إضافة" /></a></p>');
    }
    protected function form()
    {
        print('<link rel="stylesheet" type="text/css" media="all" href="js/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" /><script type="text/javascript" src="js/jscalendar/calendar.js"></script><script type="text/javascript" src="js/jscalendar/lang/calendar-en.js"></script><script type="text/javascript" src="js/jscalendar/calendar-setup.js"></script>');
        print('<div style="text-align:right;background-color:#fff;direction:rtl;font-family:tahoma;">');
        form::open_form('add_edit','main.php?page='.$this->params[page].'&class='.$this->params["class"].'&event=act','post',' id="add_edit" enctype="multipart/form-data"');
        print('<table dir="rtl" width="100%" style="font-size:12px;">');
        if(!empty($this->params[id]))
        {
            $this->case='تعديل';
            $record=mysql_db::get_records_by_key("select * from ".$this->params['page']." where id=".$this->params['id']."");
            $type_parent=mysql_db::get_records_by_key("select type from ".$this->params['page']." where id=".$this->params['parent']."");
            $record['type'][0]=$type_parent['type'][0];
            form::add_input('id','hidden','',$record['id'][0]);
        }
        else
        {
            $this->case='إضافة';
            if(!empty($this->params['parent']))
            {
                $record=mysql_db::get_records_by_key("select language,`type`,icon from ".$this->params[page]." where id=".$this->params['parent']);
            }            
            $record['parent'][0]=$this->params['parent'];
            //$record['icon'][0]='dark_folder_image.png';
            $record['enabled'][0]=2;
            $record['is_control'][0]=2;
            $record['body'][0]='<p dir="rtl"><strong><span style="font-size: 16px"><span style="color: #696969">نموذج</span></span></strong></p>';
            //$now=mysql_fetch_row(mysql_query("select Now();"));
            $record['_date'][0]=date('Y').'-'.date('m').'-'.date('d');
        }        
        print('<tr><td>العنوان:</td><td>');form::add_input('title','text','<font color="#ff0000">*</font>',$record[title][0],'size="120"');print('</td></tr>');
        print('<tr><td>الأيقونة:</td><td>');form::add_input('icon','file_selector','<img id="icon_pic" src="../upload/'.$record['icon'][0].'" width="80" height="80" title="'.$record['icon'][0].'" align="center" />',$record['icon'][0],' onblur="document.getElementById(\'icon_pic\').src= \'../upload/\' + this.value;"');print('</td></tr>');
        print('<tr><td>وصف:</td><td>');form::add_input('descr','text','<font color="#ff0000">*</font>',$record[descr][0],' size="120"');print('</td></tr>');
        print('<tr><td>الكلمات المفتاحية:</td><td>');form::add_input('keywords','text','<font color="#ff0000">*</font>',$record[keywords][0],' size="120"');print('</td></tr>');
        if($record['parent'][0]!='')
        {
            if($record['type'][0]=='sec')//artilces category under a parent
            {
                print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
                print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->appearance,$record['enabled'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance,$record['main'][0]);print('</td></tr>');
            }
            else//ended an article
            {
                print('<tr><td>نوع الخبر:</td><td>');form::add_select('_author',$this->get_news_type(),$record[_author][0]);print('</td></tr>');
                print('<tr><td>التاريخ:</td><td>');form::add_input('_date','text','',$record[_date][0],'id="_date" dir="ltr"');print('<script type="text/javascript">Calendar.setup({inputField:"_date",button:"_date",align:"Br"});</script>');print('</td></tr>');
                print('<tr><td>الحي أو المكان:</td><td>');form::add_select('_file',$this->get_towns(),$record[_file][0]);print('</td></tr>');
                print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record['language'][0]);print('</td></tr>');
                print('<tr><td>نظام تفاعلي:</td><td>');form::add_select('is_control',$this->status,$record['is_control'][0]);print('</td></tr>');
                print('<tr><td>المحتوى:</td><td>');
                include_once 'ck-editor/ckeditor/ckeditor.php' ;
                require_once 'ck-editor/ckfinder/ckfinder.php' ;
                if (!class_exists('CKEditor'))
                {
                	//printNotFound('CKEditor');
                    form::add_input('body','textarea','',$record['body'][0]);
                }
                else
                {
                	$ckeditor = new CKEditor( ) ;
                	$ckeditor->basePath	= 'ck-editor/ckeditor/' ;
                	CKFinder::SetupCKEditor( $ckeditor, 'ck-editor/ckfinder/' ) ;
                	$ckeditor->editor('body', $record['body'][0]);
                }
                print('</td></tr>');
                print('<tr><td>نوع الصفحة:</td><td>');print($this->type[$this->params['class']]);print('</td></tr>');
                print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->status,$record['main'][0]);print('</td></tr>');
            }                
        }
            else//articles category has not any parent
            {
                print('<tr><td>في القائمة:</td><td>');form::add_select('menu',$this->status,$record['menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة السفلية:</td><td>');form::add_select('footer_menu',$this->status,$record['footer_menu'][0]);print('</td></tr>');
                print('<tr><td>في القائمة العلوية:</td><td>');form::add_select('header_menu',$this->status,$record['header_menu'][0]);print('</td></tr>');
                if(!empty($this->params[id])) //edit
                {
                    print('<tr><td>اللغة:</td><td>');print($this->language[$record['language'][0]]);form::add_input('language','hidden','',$record[language][0],' ');print('</td></tr>');
                }
                else //add
                {
                    print('<tr><td>اللغة:</td><td>');form::add_select('language',$this->language,$record[language][0],' ');print('</td></tr>');
                }
                print('<tr><td>نوع الصفحة:</td><td>');form::add_input('type','hidden','',$this->params['class']);print($this->type[$this->params['class']]);print('</td></tr>');
                print('<tr><td>إظهار:</td><td>');form::add_select('enabled',$this->appearance,$record['enabled'][0]);print('</td></tr>');
                print('<tr><td>في الصفحة الرئيسية:</td><td>');form::add_select('main',$this->appearance,$record['main'][0]);print('</td></tr>');                
            }
            print('<tr><td>الصفحة الأب:</td><td>');form::add_input('parent','hidden','',$record['parent'][0]);$this->get_any_title($record['parent'][0]);print('</td></tr>');
            //print('<tr><td>brand:</td><td>');form::add_input('brand','hidden','',$record['brand'][0]);print($this->get_brand($record['brand'][0]));print('</td></tr>');
            
            print('<tr><td>للأعضاء:</td><td>');form::add_select('permission',$this->status,$record['permission'][0]);print('</td></tr>');
            print('<tr><td>إعلان جانبي:</td><td>');form::add_select('ads',$this->status,$record['ads'][0]);print('</td></tr>');
            print('<tr><td>في الشريط المتحرك:</td><td>');form::add_select('marquee',$this->status,$record['marquee'][0]);print('</td></tr>');
            if($record['ordered'][0]==''){$record['ordered'][0]=mysql_db::maxx($this->params[page],'ordered'," where parent=".$this->params[parent]);}
            print('<tr><td>الترتيب:</td><td>');form::add_input('ordered','text','',$record['ordered'][0],' size="3"');print('</td></tr>');
            print('<tr><td>المشاهدات:</td><td>');form::add_input('hits','text','',$record['hits'][0],' size="3" disabled="disabled"');print('</td></tr>');
            print('<tr><td colspan="2">');form::add_input('submit','submit','',$this->case);print('</td></tr>');
            print('</table>');
            form::close_form();
            print('</div>');
    }
}?>