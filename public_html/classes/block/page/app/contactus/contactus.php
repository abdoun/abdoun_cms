<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class contactus
 **/
class contactus
{
    protected $params="";
    protected $case="";
    protected $post="";
    
    public function __construct($arr='',$post='')
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
        print(_CONTACTUS);
        $caption = ob_get_contents();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        //$res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->params['l']."' and enabled=2");
        define('_KEYWORDS',_CONTACTUS);
        define('_DESCRIPTION',_CONTACTUS);
        define('_TITLE_PAGE',_CONTACTUS);
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        if($this->params['page']!='content')
        {
            $html=$this->navigator($html);
        }
        ob_start();
        //print('<script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>');
        print('<br /><div id="contactus_result"></div>');
        ?>
        <script type="text/javascript">
        	function validate_(frm)
            {
            	if(frm.name.value=="")
            	{
                    document.getElementById('contactus_result').innerHTML='<span><?=addslashes(_NO_NAME);?></span>';
            		frm.name.focus();
            		return false;
            	}
            	else if(frm.email.value=="")
            	{
                    document.getElementById('contactus_result').innerHTML='<span><?=addslashes(_NO_EMAIL);?></span>';
            		frm.email.focus();
            		return false;
            	}
                else if(frm.notes.value=="")
            	{
                    document.getElementById('contactus_result').innerHTML='<span><?=addslashes(_NO_NOTES);?></span>';
            		frm.notes.focus();
            		return false;
            	}
            	else if(frm.code.value=="")
            	{
            	    document.getElementById('contactus_result').innerHTML='<span><?=_ERROR;?> <?=_CODE;?></span>';
            		frm.code.focus();
            		return false;
            	}
                else
                {
                    //alert('ok');
                    post('contactus_us','contactus_result');
                    frm.name.value='';
                    frm.email.value='';
                    frm.code.value='';
                    return false;
                }
                return false;
            }
        </script>
        <form method="post" action="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?l=<?=$this->params[l];?>&page=contactus&type=contactus&event=act" id="contactus_us" name="contactus_us" onsubmit="return validate_(this);">
        <table width='100%'>
          <tr>
            <td><?=_NAME ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='name' value="<?=$this->post['name'];?>" type='text' id="name" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_EMAIL;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='email' value="<?=$this->post['email'];?>" type='text' id="email" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_COUNTRY;?>:</td>
            <td><input name='country' value="<?=$this->post['country'];?>" type='text' id="country" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_GENDER;?>:</td>
            <td><select name='gender' id="gender">
            <option value="m" <?if($this->post['gender']=='m'){echo ' selected';}?>><?=_MALE;?></option>
            <option value="f" <?if($this->post['gender']=='f'){echo ' selected';}?>><?=_FEMALE;?></option>
            </select></td>
          </tr>
          <tr>
            <td><?=_PHONE;?> <?=_OR;?> <?=_MOBILE;?>:</td>
            <td><input name='phone' value="<?=$this->post['phone'];?>" type='text' id="phone" maxlength='255' onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value=='NaN' || isNaN(parseInt(this.value)))this.value='';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value=='NaN' || isNaN(parseInt(this.value)))this.value='';" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value=='NaN' || isNaN(parseInt(this.value)))this.value='';" /></td>
          </tr>
          <tr>
				<td align="<?=_ALIGN_;?>"><?php echo _TYPE_C;?><font color="#ff0000" face="tahoma">*</font></td>
				<td><select name="typee">
				<option value="<?=_INQUIRY;?>"><?=_INQUIRY;?></option>
				<option value="<?=_SUGGESTION;?>"><?=_SUGGESTION;?></option>
				<option value="<?=_COMPLAIN;?>"><?=_COMPLAIN;?></option>
				<!--<option value="<?//=_VACANCIES;?>"><?//=_VACANCIES;?></option>-->
				<option value="<?=_OTHER;?>"><?=_OTHER;?></option>
				</select></td>
		  </tr>
		  <tr>
				<td align="<?=_ALIGN_;?>"><?php echo _NOTES;?>:<font color="#ff0000" face="tahoma">*</font></td>
				<td><textarea name="notes" rows="6" cols="50"></textarea></td>
		  </tr>
          <tr>
				<td><?php echo _CODE;?>:<font color="#ff0000" face="tahoma">*</font></td>
				<td><input align="middle" name="code" maxlength="8" size="20" type="text" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);" /></td>
		  </tr>
          <tr>
            <td><font face="Verdana" size="2" color="#000"><a href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>image.php" target="ifr" style="color: black;text-decoration: underline;"><?=_CHANGE." "._CODE;?></a></font></td>
			<td><iframe name="ifr" id="ifr" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>image.php" width="90" height="65" scrolling="no" frameborder="0" marginwidth="0"></iframe></td>
   		  </tr>
          <tr>
            <td>
            <input type="hidden" value="<?=$_SERVER["REQUEST_TIME"];?>" name="ddate" />
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
    {//print('lllllllll');
        $this->case=true;
        if(empty($this->post['code']) || md5($this->post['code'])!=md5($_SESSION['new_string']))
		{
			print("<span>"._ERROR." "._CODE."</span><br />");
            $this->case=false;
		}
        if(empty($this->post['name']))
		{
			print("<span>"._NO_NAME."</span><br />");
            $this->case=false;
		}
        if(empty($this->post['email']) || (!validate::verify($_POST[email],'email')))
		{
			print("<span>"._NO_EMAIL."</span><br />");
            $this->case=false;
		}
        if(empty($this->post['notes']))
		{
			print("<span>"._NO_NOTES."</span><br />");
            $this->case=false;
		}
        $this->post=mysql_db::remove_from_array($this->post,'submit');
        $this->post=mysql_db::remove_from_array($this->post,'rs');
        $this->post=mysql_db::remove_from_array($this->post,'code');
        if($this->case==true)
        {
            if(!mysql_db::add_edit_rec('contacts',$this->post))
            {
                print(mysql_error());
            }
            else
            {
                print('<div style="border-color: #00ff00;border-style: solid;border-width: 1px;color:#00ff00;background-color: #E5FEDA;width:80%;">'._DONE.'</div>');
                $_SESSION['new_string']='';
                $this->post['name']='';
                $this->post['email']='';
                $this->post['notes']='';
                $this->post['code']='';print(mysql_error());
            }
        }
        else
        {
            //print('ok');
        }
    }
}?>