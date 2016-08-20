<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class join
 **/
class join
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
        print(_PARTICIPATE_US);
        $caption = ob_get_contents();
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        //$res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->params['l']."' and enabled=2");
        define('_KEYWORDS',_PARTICIPATE_US);
        define('_DESCRIPTION',_PARTICIPATE_US);
        define('_TITLE_PAGE',_PARTICIPATE_US);
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        print('<script type="text/javascript" src="js/scripts/jquery.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>');
        print('<div id="result"></div>');
        ?>
        <script type="text/javascript">
        	function validate_(frm)
            {
            	if(frm.name.value=="")
            	{
                    document.getElementById('result').innerHTML='<span><?=addslashes(_NO_NAME);?></span>';
            		frm.name.focus();
            		return false;
            	}
            	if(frm.email.value=="")
            	{
                    document.getElementById('result').innerHTML='<span><?=addslashes(_NO_EMAIL);?></span>';
            		frm.email.focus();
            		return false;
            	}
            	if(frm.code.value=="")
            	{
            	    document.getElementById('result').innerHTML='<span><?=_ERROR;?> <?=_CODE;?></span>';
            		frm.code.focus();
            		return false;
            	}
                $.post('classes/block/page/ajax.php?l=<?=$this->params[l];?>&brand=<?=$this->params[brand];?>&page=<?=$this->params[page];?>&type=<?=$this->params[type];?>&event=act',function(data){$('#result').html(data);});
                return false;
            }
        </script>
        <form method="post" id="join_us" name="join_us" onsubmit="return validate_(this);">
        <table width='60%'>
          <tr>
            <td><?=_NAME ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='name' type='text' id="name" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_EMAIL;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='email' type='text' id="email" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_COUNTRY;?>:</td>
            <td><input name='country' type='text' id="country" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_CITY;?>:</td>
            <td><input name='city' type='text' id="city" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_CAREER;?>:</td>
            <td><input name='job' type='text' id="job" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_BIRTH_DATE;?>:</td>
            <td><input name='birthdate' type='text' id="birthdate" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_GENDER;?>:</td>
            <td><select name='gender' id="gender">
            <option value="m"><?=_MALE;?></option>
            <option value="f"><?=_FEMALE;?></option>
            </select></td>
          </tr>
          <tr>
            <td><?=_PHONE;?> <?=_OR;?> <?=_MOBILE;?>:</td>
            <td><input name='phone' type='text' id="phone" maxlength='255' onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value=='NaN' || isNaN(parseInt(this.value)))this.value='';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value=='NaN' || isNaN(parseInt(this.value)))this.value='';" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value=='NaN' || isNaN(parseInt(this.value)))this.value='';" /></td>
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
            <td>&nbsp;</td> 
            <td><input type='submit' value="<?=_SEND;?>" /></td>
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
        $this->post=mysql_db::remove_from_array($this->post,'submit');
        if(empty($this->post['code']) || md5($this->post['code'])!=md5($_SESSION['new_string']))
		{
			print("<span>"._ERROR." "._CODE."</span><br />");
            $status=false;
		}
        if(empty($this->post['name']))
		{
			print("<span>"._NO_NAME."</span><br />");
            $status=false;
		}
        if(empty($this->post['email']) || (!validate::verify($_POST[email],'email')))
		{
			print("<span>"._NO_EMAIL."</span><br />");
            $status=false;
		}
        if($status!=false)
        {
            if(!mysql_db::add_edit_rec('contacts',$this->post))
            {
                print(mysql_error());
            }
            else
            {
                print('<center>'._DONE.'</center>');
            }
        }        
    }
}?>