<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class questionair
 **/
class questionair
{
    protected $params="";
    protected $case="";
    protected $post="";
    protected $country;
         
    public function __construct($arr='',$post='')
    {
        //if(membership::get_id()!==false)
        //{
            //print_r($_POST);
            $this->params=$arr;
            $this->post=$post;
            $this->country=$this->get_country();
            if(!empty($this->params['event']))
            {
                $this->$arr['event']();
            }
            else
            {
                $this->browse();
            }
        //}
    }
    protected function get_country($code='')
    {
        if($code!='')
        {
            $re=mysql_db::get_records_by_key("select name from countries where enabled=2 and code='$code'");
            return $re[name][0];
        }
        else
        {
            $re=mysql_db::get_records_to_row("select code,name from countries where enabled=2");
            return array(''=>'')+$re;
        }
    }
    protected function get_answer($id='')
    {
        if($id!='')
        {
            $re=mysql_db::get_records_by_key("select answer from answers where enabled>1 and id='$id'");
            return $re['answer'][0];
        }
        else
        {
            $re=mysql_db::get_records_to_row("select id,answer from answers where enabled>1 order by ordered asc");
            return array(''=>'')+$re;
        }
    }
    protected function get_answers($id='')
    {
        if($id!='')
        {
            $re=mysql_db::get_records_to_row("select id,answer from answers where enabled>1 and question=$id order by ordered asc");
            return $re;
        }
        else
        {
            //$re=mysql_db::get_records_to_row("select id,answer from answers where enabled>1 order by ordered asc");
            return array(''=>'');
        }
    }
    protected function get_spokesman($id='')
    {
        if($id!='')
        {
            $re=mysql_db::get_records_by_key("select members.name from members left outer join groups_members on groups_members.members=members.id where members.active>1 and members.id='$id'");
            return $re['name'][0];
        }
        else
        {
            $re=mysql_db::get_records_to_row("select members.id,members.name from members left outer join groups_members on groups_members.members=members.id where members.active>1 and groups_members.groups=1 order by members.name asc");
            return $re;
        }
    }
    protected function get_members($id)
    {
        $re=mysql_db::get_records_to_row("select members.id,members.name from members left outer join groups_members on groups_members.members=members.id where members.active>1 and groups_members.groups=$id order by members.name asc");
        return $re;
    }
    protected function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    protected function get_url($folder='')
    {
        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).$folder.'/');
        $arr=explode('classes',$path);
        return 'classes/'.$arr[1];
    }
    protected function navigator($html)
    {        
        ob_start();
        //print('<h3>مجلس قيادة الثورة في دمشق</h3>');
        //print('<br />');
        $caption = ob_get_contents();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        //$res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->params['l']."' and enabled=2");
        define('_KEYWORDS','استمارة الاستبيان');
        define('_DESCRIPTION','استمارة الاستبيان');
        define('_TITLE_PAGE','استمارة الاستبيان');
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        //if($this->params['page']!='content')
        //{
            $html=$this->navigator($html);
        //}
        ob_start();
        //print('<script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>');
        //print('<br /><div id="questionair_result"></div><br />');
        ?>
        <!--<form method="post" action="classes/block/page/ajax.php?l=<?=$this->params[l];?>&page=questionair&type=questionair&event=act" id="questionair_us" name="questionair_us" onsubmit="return validate_(this);">-->
        <div style="margin-left: auto;margin-right: auto;text-align: center;"><!--<select name='forms' id="forms" onchange="_('#questionair_result').html('<center><img src=\'images/loading.gif\' border=\'0\'/></center>');
                _.get('classes/block/page/ajax.php?l=<?=$this->params[l];?>&page=questionair&type=questionair&event=form&forms=' + this.value, function(data) {
                  _('#fields').html(data);      
                });">-->
                <!--<option></option>-->
            <?$res=mysql_db::get_records_by_key("select id,name,permission from forms where enabled>1 order by ordered asc");
            $i=1;
            foreach($res[id] as $key=>$value)
            {
                if($res['permission'][$key]==1 || ($res['permission'][$key]==2 && $_SESSION['username']!='' && membership::forms_member($value)))
                {
                    //print('<option value="'.$value.'">'.$res['name'][$key].'</option>');
                    print('<a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id=0&page=questionair&type=questionair&event=form&forms='.$value.'">'.$res['name'][$key].'</a><br />');
                    if($i==1)
                    {
                        $id_default=$value;
                    }
                    $i++;
                }
            }?>
        <!--</select>--></div><?print('<br /><div id="questionair_result"></div><br />');?>
        <div id="fields">
        <script type="text/javascript">
            //_('#request_form_result').html('<center><img src=\'images/loading.gif\' border=\'0\'/></center>');
        	//_.get('classes/block/page/ajax.php?l=<?=$this->params[l];?>&page=questionair&type=questionair&event=form&forms=<?=$id_default;?>', function(data) {
            //      _('#fields').html(data);      
            //    });
        </script>
        </div>
        <!--</form>-->
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',$content,$html);
    }
    protected function form()
    {
        if(empty($this->params['forms'])){exit();}
        $this->set_meta_desc();
        $html=$this->template_include();
        //if($this->params['page']!='content')
        //{
            $html=$this->navigator($html);
        //}
        ob_start();
        $res=mysql_db::get_records_by_key("select name,intro from forms where enabled>1 and id='".$this->params['forms']."'");
        print('<h2>'.$res[name][0].'</h2><br /><p><b>'.str_replace('\\','',str_replace('\\n','<br />',str_replace('\\r',' ',$res[intro][0]))).'</b></p><br />');
        ?><script type="text/javascript">
        	function validate_(frm)
            {
            	if(frm.code.value=="")
            	{
            	    document.getElementById('questionair_result').innerHTML='<span><?=_ERROR;?> <?=_CODE;?></span>';
            		frm.code.focus();
            		return false;
            	}
                else
                {
                    _("#questionair_result").html("<center><img src='http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>images/loading.gif' border='0'/></center>");
                    _.post("http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?l=<?=$this->params[l];?>&page=questionair&type=questionair&event=act&",
                     _("#questionair_us").serialize(),
                    function(data){
                        _('#questionair_result').html(data);
                    }, "html");
                    //alert('ok');
                    ////////////post('questionair_us','questionair_result');
                    //frm.name.value='';
                    //frm.email.value='';
                    //frm.code.value='';
                    return false;
                }
                return false;
            }
        </script><style type="text/css">
            <!--
            	#tab1 td
                {
                    font-family: tahoma,arial;
                }
            -->
            </style><form method="post" action="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?l=<?=$this->params[l];?>&page=questionair&type=questionair&event=act" id="questionair_us" name="questionair_us" onsubmit="return validate_(this);">
        <table width='100%' id="tab1">
          <?
          $res=mysql_db::get_records_by_key("select evaluation from forms where enabled>1 and id=".$this->params['forms']."");
          form::add_input('forms','hidden','',$this->params['forms']);
          if($res['evaluation'][0]>0)
          {
              print('<tr><td align="left">الناطق:<font color="#ff0000" face="tahoma">*</font></td><td align="right">');
              form::add_select('spokesman',$this->get_members($res['evaluation'][0]));
              print('</td></tr>');
          }
          $res=mysql_db::get_records_by_key("select * from questions where `form`='".$this->params['forms']."' and enabled>1 order by ordered asc");
          if(count($res[id])<1){die('');}
          foreach($res[id] as $key=>$value)
          {
            if($key%2==0){$bg='bgcolor="#C0C0C0"';}else{$bg='bgcolor="#f0f0f0"';}
            if($res['intro'][$key]!='')
            {
                print('<tr '.$bg.'><td align="center" colspan="2" style="text-align:center;"><br /><b>'.str_replace('\\','',str_replace('\\n','<br />',str_replace('\\r',' ',$res[intro][$key]))).'</b><br /></td></tr>');
            }
            if($res['type'][$key]==2)//موضوعي
            {
                print('<tr '.$bg.'><td align="left">'.$res['question'][$key].':<font color="#ff0000" face="tahoma">*</font></td><td>');
                form::add_select($value,$this->get_answers($value));
                print('</td></tr>');
            }
            elseif($res['type'][$key]==3)//أعضاء
            {
                print('<tr '.$bg.'><td align="left">'.$res['question'][$key].':<font color="#ff0000" face="tahoma">*</font></td><td>');
                form::add_select($value,$this->get_members($res['group'][$key]));
                print('</td></tr>');
            }
            else//مقالي
            {
                print('<tr '.$bg.'><td align="left">'.$res['question'][$key].':<font color="#ff0000" face="tahoma"></font></td><td>');
                form::add_input($value,'text','','','size="80"');
                print('</td></tr>');
            }
          }?><tr>
				<td align="left"><?php echo _CODE;?>:<font color="#ff0000" face="tahoma">*</font></td>
				<td><input align="middle" id="code" name="code" maxlength="8" size="20" type="text" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);" /></td>
    		 </tr>
             <tr>
                <td align="left"><font face="Verdana" size="2" color="#000"><a href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>image.php" target="ifr" id="change_code"><?=_CHANGE." "._CODE;?></a></font></td>
    			<td><iframe name="ifr" id="ifr" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>image.php" width="120" height="80" scrolling="no" frameborder="0" marginwidth="0"></iframe></td>
       		 </tr>
             <tr>
                <td> </td>
                <td><input type='submit' name="submit" value="<?=_SEND;?>" /></td>
              </tr>
            </table></form><div id="questionair_result"></div><?php
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',$content,$html);
    }
    protected function act()
    {
        $this->case=true;
        if(empty($this->post['code']) || md5($this->post['code'])!=md5($_SESSION['new_string']))
		{
			print("<span>"._ERROR." "._CODE."</span><br />");
            print('<script>document.getElementById("change_code").click();_("#code").val("");</script>');
            $this->case=false;
		}
        $this->post=mysql_db::remove_from_array($this->post,'submit');
        $this->post=mysql_db::remove_from_array($this->post,'rs');
        $this->post=mysql_db::remove_from_array($this->post,'code');
        $this->post['device']=$_SERVER["HTTP_USER_AGENT"];
        $now=mysql_fetch_row(mysql_query("select Now();"));
        $this->post['start_date']=$now[0];
        $this->post['referrer_page']=$_SESSION['referrer_page'];
        $this->post['ip']=$_SERVER["REMOTE_ADDR"];
        $this->post['member']=membership::get_id();
        if($this->case==true)
        {
            if(!mysql_db::add_edit_rec('sessions',array('device'=>$this->post['device'],'start_date'=>$this->post['start_date'],'forms'=>$this->post['forms'],'start_date'=>$this->post['start_date'],'referrer_page'=>$this->post['referrer_page'],'ip'=>$this->post['ip'],'member'=>$this->post['member'],'spokesman'=>$this->post['spokesman'])))
            {
                print('<span dir="ltr">خطأ<br /></span><br />');
                print('<script>document.getElementById("change_code").click();_("#code").val("");</script>');
            }
            else
            {
                $session=mysql_insert_id();
                $this->post=mysql_db::remove_from_array($this->post,'device');
                $this->post=mysql_db::remove_from_array($this->post,'start_date');
                $this->post=mysql_db::remove_from_array($this->post,'referrer_page');
                $this->post=mysql_db::remove_from_array($this->post,'ip');
                $this->post=mysql_db::remove_from_array($this->post,'forms');
                $this->post=mysql_db::remove_from_array($this->post,'member');
                $this->post=mysql_db::remove_from_array($this->post,'spokesman');
                foreach($this->post as $q=>$a)
                {
                    mysql_db::exec_query("insert into results set session='".$session."',question='".$q."',answer='".$a."'");
                }//print_r($this->post);
                print('<div style="border-color: #00ff00;border-style: solid;border-width: 1px;color:#00ff00;background-color: #E5FEDA;width:80%;">'._DONE.'</div>');
                $_SESSION['new_string']='';
                $this->post['code']='';print(mysql_error());
                ///email::send('new request at:'.$now[0],'info@rlc-damascus.com','faiselalaga@gmail.com','new request at:'.$now[0]);
                //email::send('new request at:'.$now[0],'info@rlc-damascus.com','hikmat.salman62@gmail.com','new request at:'.$now[0]);
                ///email::send('new request at:'.$now[0],'info@rlc-damascus.com','ibnalsham@gmail.com','new request at:'.$now[0]);
                ///email::send('Your application has been received in the office of Member of RLC Damascus on:'.$now[0],'info@rlc-damascus.com',$email,'تحية طيبة وبعد<br />نشكركم لتقديمكم طلب إنتساب لمجلس قيادة الثورة في دمشق .<br /><br />يسر مجلس دمشق أن يحيطكم علما باضافة معرف السكايب (Skype) الخاص بكم قريبا إلى قائمة الإتصالات لدى مكتب العضوية الخاص بالمجلس ، وذلك بناء على طلب الإنضمام المرسل من قبلكم للمجلس.<br />سكايب مكتب العضوية هو :<br /><br />rlc.damascus<br /><br />سيتم دراسة الطلب والرد عليه عبر الإيميل أو السكايب في أقرب وقت ممكن.<br />-------------------------<br />مكتب العضوية<br /><br />مجلس قيادة الثورة في مدينة دمشق<br />--------------------------<br />هذه رسالة آلية لا تقم بالرد عليها<br />===================');
                print('<script>_("#fields").html("");</script>');
            }
        }
        else
        {
            $this->post['code']='';
            print('<script>_("#code").val("");</script>');
            //print('ok');
        }
    }
}?>