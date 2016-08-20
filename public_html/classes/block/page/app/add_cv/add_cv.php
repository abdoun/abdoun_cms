<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class add_cv
 **/
class add_cv
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $status = Array(1=>_YES,2=>_NO);
    protected $gender = Array('m'=>_MALE,'f'=>_FEMALE);
    protected $military = Array('1'=>_EXEMPTED,'2'=>_DEFERRED,'3'=>_FINISHED);
    protected $marital = Array('1'=>_SIGLE,'2'=>_MARRIED,'3'=>_DIVORCED);
    protected $license = Array('2'=>_PRIVATE,'1'=>_PUBLIC);

    public function __construct($get='',$post='')
    {
        $this->get=$get;
        $this->post=$post;
        if(!empty($this->get['event']))
        {
            $this->$get['event']();
        }
        else
        {
            $this->browse();
        }
    }
    protected function get_sec($id='')
    {
        if($id!='')
        {
            $re=mysql_db::get_records("select name from section where enabled=2 and language=".$this->get['l']." and id=$id");
            return $re[0][0];            
        }
        else
        {
            return mysql_db::get_records_to_row("select id,name from section where enabled=2 and language=".$this->get['l']."");
        }
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
        print(_ADD_CV);
        $caption = ob_get_contents();
        $caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        //$res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->get['l']."' and enabled=2");
        define('_KEYWORDS',_ADD_CV);
        define('_DESCRIPTION',_ADD_CV);
        define('_TITLE_PAGE',_ADD_CV);
    }
    protected function browse($msg='')
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        if($this->get['page']!='content')
        {
            $html=$this->navigator($html);
        }
        ob_start();
        //print('<script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>');
        print('<br /><div id="add_cv_result">'.$msg.'</div>');
        ?>
        <script type="text/javascript">
        	function validate_(frm)
            {
            	if(frm.name.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_NO_NAME);?></span>';
            		frm.name.focus();
            		return false;
            	}
                else if(frm.email.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_NO_EMAIL);?></span>';
            		frm.email.focus();
            		return false;
            	}
                else if(frm.address.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_ADDRESS);?></span>';
            		frm.address.focus();
            		return false;
            	}
                else if(frm.birth_town.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_BIRTH_TOWN);?></span>';
            		frm.birth_town.focus();
            		return false;
            	}
                else if(frm.birth_date.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_BIRTH_DATE);?></span>';
            		frm.birth_date.focus();
            		return false;
            	}
                else if(frm.mobile.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_MOBILE);?></span>';
            		frm.mobile.focus();
            		return false;
            	}
                else if(frm.phone.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_PHONE);?></span>';
            		frm.phone.focus();
            		return false;
            	}
                else if(frm.personality.value=="")
            	{
                    document.getElementById('add_cv_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_PERSONALITY);?></span>';
            		frm.personality.focus();
            		return false;
            	}
            	else if(frm.code.value=="")
            	{
            	    document.getElementById('add_cv_result').innerHTML='<span><?=_ERROR;?> <?=_CODE;?></span>';
            		frm.code.focus();
            		return false;
            	}
                else
                {
                    //alert('ok');
                    //post('add_cv_form','add_cv_result');
                    //frm.name.value='';
                    //frm.email.value='';
                    //frm.code.value='';
                    //frm.mobile.value='';
                    //return false;
                    return true;
                }
                //return false;
            }
        </script>
        <form enctype="multipart/form-data" method="post" action="?l=<?=$this->get[l];?>&page=add_cv&type=add_cv&event=act" id="add_cv_form" name="add_cv_form" onsubmit="return validate_(this);">
        <table width='60%'>
        <tr>
            <td><?=_SECTION ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td>
            <?php
            form::add_select('section',$this->get_sec(),$this->post['section']);
            ?>
            </td>
          </tr>
          <tr>
            <td><?=_NAME ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['name'];?>" name='name' type='text' id="name" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_GENDER;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><?php
            form::add_select('gender',$this->gender,$this->post['gender']);
            ?></td>
          </tr>
          <tr>
            <td><?=_EMAIL;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['email'];?>" name='email' type='text' id="email" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_ADDRESS;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['address'];?>" name='address' type='text' id="address" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_BIRTH_TOWN;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['birth_town'];?>" name='birth_town' type='text' id="birth_town" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_BIRTH_DATE;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['birth_date'];?>" name='birth_date' type='text' id="birth_date" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_MOBILE;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['mobile'];?>" name='mobile' type='text' id="mobile" maxlength='30' onkeypress="this.value=trim(this.value.toLowerCase());" onblur="this.value=trim(this.value.toLowerCase());" onkeyup="this.value=trim(this.value.toLowerCase());" /></td>
          </tr>
          <tr>
            <td><?=_PHONE;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['phone'];?>" name='phone' type='text' id="phone" maxlength='30' onkeypress="this.value=trim(this.value.toLowerCase());" onblur="this.value=trim(this.value.toLowerCase());" onkeyup="this.value=trim(this.value.toLowerCase());" /></td>
          </tr>
          <tr>
            <td><?=_PERSONALITY;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['personality'];?>" name='personality' type='text' id="personality" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_MILITARY;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td>
            <?php
            form::add_select('military',$this->military,$this->post['military'],'','',' id="military"');
            ?>
            </td>
          </tr>
          <tr>
            <td><?=_MARITAL_STATUS;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td>
            <?php
            form::add_select('marital',$this->marital,$this->post['marital'],'','',' id="marital"');
            ?>
            </td>
          </tr>
          <tr>
            <td><?=_DRIVING_LICENCE;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td>
            <?php
            form::add_select('license',$this->license,$this->post['license'],'','',' id="license"');
            ?>
            </td>
          </tr>
          <tr>
            <td><?=_SMOKER;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><?php
            form::add_select('smoker',$this->status,$this->post['smoker']);
            ?></td>
          </tr>
          <tr>
            <td><?=_FILE;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='file' type='file' id="file" /></td>
          </tr>
          <tr>
				<td><?php echo _CODE;?>:<font color="#ff0000" face="tahoma">*</font></td>
				<td><input align="middle" name="code" maxlength="8" size="20" type="text" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);" /></td>
		  </tr>
          <tr>
            <td><font face="Verdana" size="2" color="#000"><a href="image.php" target="ifr"><?=_CHANGE." "._CODE;?></a></font></td>
			<td><iframe name="ifr" id="ifr" src="image.php" width="90" height="65" scrolling="no" frameborder="0" marginwidth="0"></iframe></td>
   		  </tr>
          <tr>
            <td>
            <input type="hidden" value="<?=mktime();?>" name="ddate" />
            <input type="hidden" value="<?=$_SERVER["REMOTE_ADDR"];?>" name="ip" /></td> 
            <td><input type='submit' name="submit" value="<?=_SEND;?>" /></td>
          </tr>
        </table>
        </form>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',$content,$html);
    }
    protected function act()
    {
        $msg='';
        $this->case=true;
        if(empty($this->post['code']) || md5($this->post['code'])!=md5($_SESSION['new_string']))
		{
			$msg="<span>"._ERROR." "._CODE."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['name']))
		{
			$msg="<span>"._NO_NAME."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['email']) || (!validate::verify($_POST['email'],'email')))
		{
			$msg="<span>"._NO_EMAIL."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['address']) || (!validate::verify($_POST['address'],'digit')))
		{
			$msg="<span>"._ERROR." "._ADDRESS."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['birth_town']))
		{
			$msg="<span>"._ERROR." "._BIRTH_TOWN."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['birth_date']))
		{
			$msg="<span>"._ERROR." "._BIRTH_DATE."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['mobile']) || (validate::verify($_POST['mobile'],'digit')))
		{
			$msg="<span>"._ERROR." "._MOBILE."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['phone']) || (validate::verify($_POST['phone'],'digit')))
		{
			$msg="<span>"._ERROR." "._PHONE."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['personality']))
		{
			$msg="<span>"._ERROR." "._PERSONALITY."</span><br />";
            $this->case=false;
		}
        if(is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $ext=substr($_FILES['file']['name'],-3);
            $ext_=substr($_FILES['file']['name'],-4);
            if($ext!='doc' && $ext!='txt' && $ext!='pdf' && $ext_!='docx')
            {
                $msg="<span>"._ERROR." "._FILE."</span><br />";
                $this->case=false;
            }
            elseif(filesize($_FILES['file']['tmp_name'])>1048576)
            {
                $msg="<span>"._ERROR." "._OVER_SIZE."1 mb</span><br />";
                $this->case=false;
            }
            else
            {
                $file_name=rand(1,999999).$_FILES['file']['name'];
                copy($_FILES['file']['tmp_name'],'upload/cv/'.$file_name);
                $this->post['file']=$file_name;
            }                        
        }
        else
        {
            $msg="<span>"._ERROR." "._FILE."</span><br />";
            $this->case=false;
        }
        $this->post=mysql_db::remove_from_array($this->post,'submit');
        $this->post=mysql_db::remove_from_array($this->post,'rs');
        $this->post=mysql_db::remove_from_array($this->post,'code');
        if($this->case==true)
        {
            if(!mysql_db::add_edit_rec('cv',$this->post))
            {
                //print(mysql_error());
                $msg="<span>"._ERROR."</span><br />";
            }
            else
            {
                $body='<table>';
                $body.='<tr bgcolor="#f0f0f0"><td>Section:</td><td>'.$this->get_sec($this->post['section']).'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>name:</td><td>'.$this->post['name'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>Gender:</td><td>'.$this->gender[$this->post['gender']].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>email:</td><td>'.$this->post['email'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>address:</td><td>'.$this->post['address'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>Birth Place:</td><td>'.$this->post['birth_town'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>Birth Date:</td><td>'.$this->post['birth_date'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>mobile:</td><td>'.$this->post['mobile'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>phone:</td><td>'.$this->post['phone'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>Personality:</td><td>'.$this->post['personality'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>Military:</td><td>'.$this->military[$this->post['military']].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>Marital:</td><td>'.$this->marital[$this->post['marital']].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>License:</td><td>'.$this->license[$this->post['license']].'</td></tr>';                
                $body.='<tr bgcolor="#f0f0f0"><td>Smoker:</td><td>'.$this->status[$this->post['smoker']].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>CV file:</td><td><a href="http://'.$_SERVER['SERVER_NAME'].'/upload/cv/'.$file_name.'" target="_blank">download</a></td></tr>';
                $body.='</table>';
                if(email::send('CV from: '.$this->post['email'],$this->post['email'],$this->post['name'],'hr@-sy.com',$body))
                {
                    $msg='<div style="border-color: #00ff00;border-style: solid;border-width: 1px;color:#00ff00;background-color: #E5FEDA;width:80%;">'._THANK_YOU.'</div>';
                    $_SESSION['new_string']='';
                    $this->post['name']='';
                    $this->post['email']='';
                    $this->post['mobile']='';
                }
                else
                {
                    $msg="<span>"._ERROR." "._SEND." "._EMAIL."</span><br />";
                    //$msg=$body;
                    //$msg=$_FILES['file']['name'];
                }
                                
            }
        }
        else
        {
            //print('ok');
        }
    $this->browse($msg);
    }
}?>