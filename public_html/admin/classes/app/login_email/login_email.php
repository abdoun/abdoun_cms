<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class login_email
 */
class login_email 
{
    protected $get="";
    protected $case="";
    protected $post="";
    
    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    protected $permission = Array('manager'=>'مشرف عام','admin'=>'مدير','supervisor'=>'مشرف');
    
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
        //print('http://'.$_SERVER['SERVER_NAME'].'/webmail');
        if(perm::check_login(array('manager','admin','supervisor')))
        {
            //print('<iframe frameborder="0" width="100%" height="800" src="https://rlc-damascus.com:2096/" id="email_iframe"></iframe>');
            print('<iframe frameborder="0" width="100%" height="800" src="http://'.$_SERVER['SERVER_NAME'].'/webmail" id="email_iframe" name="email_iframe"
             onload=\'this.contentWindow.document.getElementById("user").value="'.$_SESSION['user'].'";
             this.contentWindow.document.getElementById("pass").value="'.$_SESSION['pass'].'";
             this.contentWindow.document.getElementById("login_form").submit();\'></iframe>');
        }
        //print('<script>document.frames["email_iframe"].document.getElementById("forms").innerHTML="qwer";</script>');
        //document.frames["iframe"].document.forms["MyForm"].Text1.value = "My new Value";
        //print('<script>window.frames["email_iframe"].document.forms["formm"].elements["user"].value="sdf";</script>');
        
    }
}?>