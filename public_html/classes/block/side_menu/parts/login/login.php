<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright 2012
 * @class login
 */
class login 
{
    protected $get="";
    protected $post="";
    
    public function __construct($get='',$post='')
    {
        $this->get=$get;
        $this->post=$post;               
        if(!empty($get['event']))
        {
            $this->$get['event']();
        }
        else
        {
            $this->browse($get['l']);
        }
    }
    protected function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    protected function get_url()
    {
        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).'template/');
        $arr=explode('classes',$path);
        return 'classes/'.$arr[1];
    }
    protected function browse($l='')
    {
        ?>
        <script type="text/javascript">
        	function validate__(frm)
            {
            	if(frm.username.value=="")
            	{
                    document.getElementById('login_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_USER);?></span>';
            		frm.username.focus();
            		return false;
            	}
            	else if(frm.password.value=="")
            	{
                    document.getElementById('login_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_PASS);?></span>';
            		frm.password.focus();
            		return false;
            	}
                else
                {
                    //alert('ok');
                    _("#login_result").html("<center><img src='http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>images/loading.gif' border='0'/></center>");
                    _.post("http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/side_menu/ajax.php?l=<?=$_GET['l'];?>&page=login&type=login&event=act&",
                     _("#login_form").serialize(),
                    function(data){
                        _('#login_result').html(data);
                    }, "html");
                    
                    //post('controls_form','controls_result');
                    //frm.name.value='';
                    //frm.title.value='';
                    //frm.notes.value='';
                    //frm.code.value='';
                    //document.getElementById('form_controls').innerHTML='';
                    return false;
                }
                return false;
            }
        </script><?php
           echo '<form name="login_form" id="login_form" onsubmit="return validate__(this);return false;">';
           form::add_input('username','text',_USER.':','',' size="16"');
           print('<br />');
           form::add_input('password','password',_PASS.':','',' size="16"');
           print('<br />');
           //echo '<br /><span id="res_button"><div class="button" id="result" title="'._RESULTS.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$l.'&brand='.$brand.'&page=vote&type=vote&event=result&id='.$res['id'][0].'&\',\'vote_result\');">'._RESULTS.'</div></span>';
           //echo '<span id="submitt"><div class="button" id="submitt" title="'._VOTE.'" onclick="">'._LOGIN.'</div></span>';
           echo '<span id="submitt" style="float:'._ALIGN_.';"><input type="submit" id="submit" value="'._LOGIN.'" name="submit" /></span>';
           echo '</form>';
    }
    protected function browse_for_user($l='')
    {
        ?>
        <script type="text/javascript">
        	function gget(url)
            {
                _("#login_result").html("<center><img src='<?='http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>images/loading.gif' border='0'/></center>");
                _.get(url, function(data) {
                  _('#login_result').html(data);      
                });
                return false;
            }
        </script>
        <?php
        print('<div>'._WELCOME.': '.$_SESSION['username'].'</div>');
        print('<span class="art-button-wrapper"><span class="art-button-l"> </span><span class="art-button-r"> </span>');
        print('<a class="art-button" href="index.php?l=2&id=0&type=register&page=register&event=0&title='._MODIFY.'-'._PROFILE.'">'._MODIFY.' '._PROFILE.'</a>');
        print('</span><br />');
        print('<span class="art-button-wrapper"><span class="art-button-l"> </span><span class="art-button-r"> </span>');
        echo '<button class="art-button" id="submit" title="'._LOGOUT.'" onclick="gget(\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/side_menu/ajax.php?l='.$l.'&page=login&type=login&event=logout&\');">'._LOGOUT.'</button>';
        print('</span>');
    }
    function view($l='')
    {
       
           $html=self::template_include();
           $html=str_replace('<dir_tag />',_DIR,$html);
           $html=str_replace('<title_ />',_LOGIN,$html);
           //$content='<script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>';
           $content.='<div id="login_result"></div>';
           ob_start();
           if(!empty($_SESSION['username']))
           {
            self::browse_for_user($l);
           }
           else
           {
            self::browse($l);
           }           
           $form = ob_get_contents();
           ob_end_clean();
           $content.=$form;
           //$content.='<div id="down_login">&nbsp;</div>';
           $html=str_replace('<align_ />',_ALIGN_,$html);
           $html=str_replace('<_align_ />',_ALIGN,$html);
           $html=str_replace('<tag />',$content,$html);
       
              
       return $html;
    }
    protected function act()
    {
        	if(empty($this->post['username']) || ereg("^ +",trim($this->post['username'])))
			{
				print(_ERROR.' '._USER);
			}
			elseif(empty($this->post['password']) || ereg("^ +",trim($this->post['password'])))
			{
				print(_ERROR.' '._PASS);
			}
			elseif(mysql_db::get_rec_no(" members where username='".$this->post['username']."' and password='".$this->post['password']."' and active=2")<1)
			{
			    print(_ERROR.' '._USER.' '._OR.' '._PASS);
			}
			else
			{
				print('<font color="#99CC00">'._THANK_YOU.'</font>');                
                $_SESSION['username']=$this->post['username'];
                box::goto_('index.php');
			}		
    }
    protected function logout()
    {
        if(!empty($_SESSION['username']))
        {
            $_SESSION['username']='';
            box::goto_('',_LOGOUT);
        }
    }    
}?>