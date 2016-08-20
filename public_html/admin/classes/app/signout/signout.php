<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class signout
 */
class signout 
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
        if(perm::check_login(array('manager','admin','supervisor')))
        {
            $this->logout();
        }
    }
    protected function logout()
    {
        //print_r($_SESSION);
        $_SESSION[user]='';
        $_SESSION[pass]='';
        session_destroy();
        print('<span style="color:#0a0;font-size:16px;">تم تسجيل الخروج بنجاح</span>');
        box::goto_('index.php');
    }
}?>