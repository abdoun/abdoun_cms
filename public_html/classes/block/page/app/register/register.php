<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class register
 **/
class register
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $status = Array(1=>_YES,2=>_NO);

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
        print(_REGISTER);
        $caption = ob_get_contents();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        //$res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->get['l']."' and enabled=2");
        define('_KEYWORDS',_REGISTER);
        define('_DESCRIPTION',_REGISTER);
        define('_TITLE_PAGE',_REGISTER);
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
        print('<br /><div id="register_result">'.$msg.'</div>');
        ?>
        <script type="text/javascript">
        	function validate_(frm)
            {
            	if(frm.name.value=="")
            	{
                    document.getElementById('register_result').innerHTML='<span><?=addslashes(_NO_NAME);?></span>';
            		frm.name.focus();
            		return false;
            	}
                else if(frm.username.value=="")
            	{
                    document.getElementById('register_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_USER);?></span>';
            		frm.username.focus();
            		return false;
            	}
                else if(frm.password.value=="")
            	{
                    document.getElementById('register_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_PASS);?></span>';
            		frm.password.focus();
            		return false;
            	}
                else if(frm.email.value=="")
            	{
                    document.getElementById('register_result').innerHTML='<span><?=addslashes(_NO_EMAIL);?></span>';
            		frm.email.focus();
            		return false;
            	}
            	else if(frm.code.value=="")
            	{
            	    document.getElementById('register_result').innerHTML='<span><?=_ERROR;?> <?=_CODE;?></span>';
            		frm.code.focus();
            		return false;
            	}
                else
                {
                    //alert('ok');
                    //post('register_form','register_result');
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
        <?php
        if(!empty($_SESSION['username']))
        {
            $res=mysql_db::get_records_by_key("select * from members where username='".$_SESSION['username']."' and active=2");
            $this->post['id']=$res['id'][0];
            $this->post['name']=$res['name'][0];
            $this->post['username']=$res['username'][0];
            $this->post['password']=$res['password'][0];
            $this->post['email']=$res['email'][0];
            //$this->post['picture']=$res['picture'][0];
            $readonly=' disabled="disabled" ';
        }
        ?>
        <form enctype="multipart/form-data" method="post" action="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>?l=<?=$this->get[l];?>&page=register&type=register&event=act" id="register_form" name="register_form" onsubmit="return validate_(this);">
        <table width='600'>
           <tr>
            <td width="120"><?=_NAME ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['name'];?>" name='name' type='text' id="name" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_USER ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['username'];?>" <?=$readonly;?> name='username' type='text' id="username" maxlength='100' onblur="this.value=trim(this.value);get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?l=<?=$this->params[l];?>&page=register&type=register&event=verify&username=' + this.value + '&','username_unique');" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /><span id="username_unique"><?php //print(_CUSTOM_NOTE);?></span></td>
          </tr>
          <tr>
            <td><?=_PASS ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?//=$this->post['password'];?>" name='password' type='password' id="password" maxlength='100' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_EMAIL;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input value="<?=$this->post['email'];?>" name='email' type='text' id="email" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
			<td><?php echo _CODE;?>:<font color="#ff0000" face="tahoma">*</font></td>
			<td><input align="middle" name="code" maxlength="8" size="20" type="text" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);" /></td>
		  </tr>
          <tr>
            <td><font face="Verdana" size="2" color="#000"><a href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>image.php" target="ifr"><?=_CHANGE." "._CODE;?></a></font></td>
			<td><iframe name="ifr" id="ifr" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>image.php" width="90" height="65" scrolling="no" frameborder="0" marginwidth="0"></iframe></td>
   		  </tr>
          <tr>
            <td>
            <input type="hidden" value="<?=$this->post['id'];?>" name="id" />
            <input type="hidden" value="<?=mktime();?>" name="ddate" /></td> 
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
        if((empty($this->post['username']) && empty($this->post['id'])) || (mysql_db::get_rec_no(" members where username='".$this->post['username']."'")>=1 && empty($this->post['id'])))
		{
			$msg="<span>"._ERROR." "._USE_UNIQE."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['password']))
		{
			$msg="<span>"._ERROR." "._PASS."</span><br />";
            $this->case=false;
		}
        if(empty($this->post['email']) || (!validate::verify($_POST['email'],'email')))
		{
			$msg="<span>"._NO_EMAIL."</span><br />";
            $this->case=false;
		}
        $this->post=mysql_db::remove_from_array($this->post,'submit');
        $this->post=mysql_db::remove_from_array($this->post,'rs');
        $this->post=mysql_db::remove_from_array($this->post,'code');
        if($this->case==true)
        {
            if(!mysql_db::add_edit_rec('members',$this->post,$this->post['id']))
            {
                print(mysql_error());
                $msg="<span>"._ERROR."</span><br />";
            }
            else
            {
                //print_r($this->post);
                //$body='<table>';
                //$body.='<tr bgcolor="#f0f0f0"><td>Name:</td><td>'.$this->post['name'].'</td></tr>';
                //$body.='<tr bgcolor="#f0f0f0"><td>Username:</td><td>'.$this->post['username'].'</td></tr>';
                //$body.='<tr bgcolor="#f0f0f0"><td>Password:</td><td>'.$this->post['password'].'</td></tr>';
                //$body.='<tr bgcolor="#f0f0f0"><td>Email:</td><td>'.$this->post['email'].'</td></tr>';
                //$body.='</table>';
                $msg='<div style="border-color: #00ff00;border-style: solid;border-width: 1px;color:#00ff00;background-color: #E5FEDA;width:80%;">'._THANK_YOU.'</div>';
                //if(email::send('New member: '.$this->post['email'],$this->post['email'],$this->post['name'],'info@allmbi.com',$body))
//                {
//                    $msg='<div style="border-color: #00ff00;border-style: solid;border-width: 1px;color:#00ff00;background-color: #E5FEDA;width:80%;">'._THANK_YOU.'</div>';
//                    $_SESSION['new_string']='';
//                    $this->post['name']='';
//                    $this->post['email']='';
//                    $this->post['mobile']='';
//                }
//                else
//                {
//                    $msg="<span>"._ERROR." "._SEND." "._EMAIL."</span><br />";
//                    //$msg=$body;
//                    //$msg=$_FILES['file']['name'];
//                }                                
            }
        }
        else
        {
            $msg="<span>"._ERROR."</span><br />";
        }
    $this->browse($msg);
    }
    protected function verify()
    {
        if(empty($this->get['username']))
        {
            print(' <font color="#C30A0A"> '._USER_NON.'</font>');
        }
        else
        {
            if(mysql_db::get_rec_no(" members where username='".$this->get['username']."'")>=1)
            {
                print(' <font color="#C30A0A"> '._USE_UNIQE.'</font>');
            }
            else
            {
                print(' <font color="#008000"> '._OK.'</font>');
            }
        }        
    }
}?>