<?php

if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}

/**

 * @author 

 * @copyright  2012

 * @class user_area

 */

class user_area 

{

    protected $get="";

    protected $case="";

    protected $post="";

    

    protected $status = Array(1=>_activate,2=>deactivate);

    protected $permission = Array('manager'=>'manager','admin'=>'admin','supervisor'=>'supervisor');

    

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

            print('<table width="100%">

                    <tr>

                    	<td><h1 align="right">تحرير معلومات الحساب</h1></td>

                    	<td><a href="javascript://" onclick="_.get(\'main.php?page='.$this->get['page'].'&class='.$this->get['page'].'&event=signout&d=\'+new Date().getTime(), function(data) {_(\'#bTarTd\').html(data);});">تسجيل خروج</a></td>

                    </tr>

                    </table>');

            $re=mysql_db::exec_query("select * from users where 1=1 $sql and id='".perm::get_id_user()."' $limit")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());

            $rec=mysql_db::exec_query("select id from users where 1=1 $sql and id='".perm::get_id_user()."'")or print(mysql_error()); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());

            print('<table border="0" style="border-style:solid;border-color:#c6;border-width: 1px;">');

            print('<tr bgcolor="#969696"><td></td><td>'._USER.'</td><td>كلمة المرور</td><td>الصلاحيات</td><td>الحالة</td><td>تعديل</td><td>حذف</td></tr>');

            while($res=mysql_fetch_array($re))

            {

                print('<tr bgcolor="#f0f0f0"><td>'.$res['id'].'</td><td>'.$res['user'].'</td><td></td><td>'.$this->permission[$res['perm']].'</td><td>'.$this->status[$res['enabled']].'</td></td><td><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&id=$res[id]").'">تعديل</a></td><td><a href="javascript:if(confirm(\'هل انت متأكد\')){'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=delete&id=$res[id]").'}"></a></td></tr>');

            }

            print('</table>');

        }

        else

        {

            $this->signin();

        }

    }

    protected function signin()

    {

        if(perm::check_login(array('manager','admin','supervisor'))===false)

        {

            //print('<script>alert("ok");location.href="http://localhost/rlc";</script>');

            print('<h1>'._MEM_ACCESS.'</h1>');

            ?><div id="login_result"></div>

        	  <form name="login_form" id="login_form" onsubmit='_("#login_result").html("<center><img src=images/loading.gif /></center>");

                                                                _.post("main.php?page=user_area&class=user_area&event=login&",

                                                                 _("#login_form").serialize(),

                                                                function(data){

                                                                    _("#login_result").html(data);

                                                                }, "html");return false;'>

              <table border="0" style="border-style:solid;border-color:#c6;border-width: 1px;" dir="<?=_DIR;?>">

              <tr bgcolor="#f0f0f0">

        		  <td valign="top"><?=_USER;?>: </td>

        		  <td valign="top"><input name="username" type="text" onkeypress="this.value=trim(this.value.toLowerCase());" onblur="this.value=trim(this.value.toLowerCase());" onkeyup="this.value=trim(this.value.toLowerCase());" /></td>

        	  </tr>

        	  <tr bgcolor="#f0f0f0">

        		  <td valign="top"><?=_PASS;?>: </td>

        		  <td valign="top"><input name="password" type="password" onkeypress="this.value=trim(this.value.toLowerCase());" onblur="this.value=trim(this.value.toLowerCase());" onkeyup="this.value=trim(this.value.toLowerCase());" /></td>

        	  </tr>

              <tr bgcolor="#f0f0f0">

				<td align="<?=_ALIGN;?>"><?=_CODE;?>: <font color="#ff0000" face="tahoma">*</font></td>

				<td align="<?=_ALIGN;?>"><input align="middle" id="code" name="code" maxlength="4" size="20" type="text" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);" /></td>

		  </tr>

		  <tr bgcolor="#f0f0f0">

			  <td align="<?=_ALIGN;?>">			  

			  <iframe name="ifr" id="ifr" src="../image.php" width="100" height="60" scrolling="no" frameborder="0" marginwidth="0"></iframe>

              <!--<img src="image.php" width="100" height="60" id="ifr" name="ifr" />-->

              </td>

  			<td align="<?=_ALIGN;?>">

			  <font face="Verdana" size="2" color="#ffffff"><a href="../image.php" target="ifr" id="change_code"><?=_CHANGE;?> <?=_CODE;?></a></font></td>

   		  </tr>

        	 <tr bgcolor="#f0f0f0">

        	  <td valign="top" colspan="2" align="center"><input type="submit" name="submitt" id="submitt" value="<?=_LOGIN;?>" /></td>

        	 </tr>        		 

		</table>

        </form><?            

        }

        else

        {

            print('<h4>'._WELCOME.'</h4><br />');

        }

    }

    protected function form()

    {

        print('<div style="text-align:right;">');

        if(!empty($this->get[id]))

        {

            $this->case='تعديل';

            print('<h3>تعديل</h3>');

            $record=mysql_db::get_records_by_key("select * from users where id=".$this->get[id]."");

        }

        else

        {

            $this->case='إضافة';

            print('<h3>إضافة</h3>');            

        }

        //print('<form action="main.php?page='.$this->get[page].'&event=act" method="post" name="add_edit" id="add_edit">');

        form::open_form('add_edit','main.php?page='.$this->get[page].'&class='.$this->get["class"].'&event=act','post',' id="add_edit"');

        print('<table dir="rtl" align="right">');

        print('<tr bgcolor="#cccccc"><td>'._USER.':<font color="#ff0000">*</font></td><td>');form::add_input('user','text','',$record[user][0],'disabled="disabled"');print('</td></tr>');

        print('<tr bgcolor="#cccccc"><td>كلمة المرور:</td><td>');form::add_input('pass','text');print('</td></tr>');

        print('<tr bgcolor="#cccccc"><td>الصلاحيات:</td><td>');form::add_select('perm',$this->permission,$record['perm'][0],'','','disabled="disabled"');print('</td></tr>');

        print('<tr bgcolor="#cccccc"><td>تفعيل:</td><td>');form::add_select('enabled',$this->status,$record['enabled'][0],'','','disabled="disabled"');print('</td></tr>');

        print('<tr bgcolor="#cccccc"><td colspan="2">');form::add_input('id','hidden','',$record[id][0]);form::add_input('submit','submit','',$this->case);print('</td></tr>');

        print('</table>');

        //print('</form>');

        form::close_form();

        print('</div>');

    }

    protected function signout()

    {

        //print_r($_SESSION);

        $_SESSION[user]='';

        $_SESSION[pass]='';

        session_destroy();

        print('<span style="color:#0a0;font-size:16px;">تم تسجيل الخروج بنجاح</span>');

        box::goto_('index.php');

    }

    protected function login()

    {

        //print_r($this->post);

        //print('<br />'.$_SESSION[new_string]);

        if(empty($this->post['username']) || empty($this->post['password']))

		{

			print('<span style="color:#aa0000">'._ERROR.' '._USER.' '._OR.' '._PASS.'</span>');

            print('<script>document.getElementById("change_code").click();_("#code").val("");</script>');

		}

        elseif(empty($this->post['code']) || md5($this->post['code'])!=md5($_SESSION['new_string']))

    	 {

    		print('<span style="color:#aa0000">'._ERROR.' '._CODE.'</span>');

            print('<script>document.getElementById("change_code").click();_("#code").val("");</script>');

    	 }

		elseif(mysql_db::get_rec_no("users where user='".$this->post['username']."' and pass='".md5($this->post['password'])."' and enabled=2")<1)

		{

		    print('<span style="color:#aa0000">'._ERROR.' '._USER.' '._OR.' '._PASS.'</span>');

            print('<script>document.getElementById("change_code").click();_("#code").val("");</script>');

		}

		else

		{

			print('<font color="#99CC00">'._DONE.'</font>');                

            $_SESSION['user']=$this->post['username'];

            $_SESSION['pass']=$this->post['password'];

            $_SESSION['new_string']='';

            box::goto_('index.php');

		}

    }

    protected function act()

    {

        //print($this->get[page]);

        //print_r($this->post);

        if(empty($this->post['pass']))

        {

            box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم تملأ الحقول الضرورية');

        }

        else

        {

            if($this->post['pass']!='')

            {

                $this->post['pass']=md5($this->post['pass']);

            }

            $this->post=mysql_db::remove_from_array($this->post,'submit');

            

            if(!mysql_db::add_edit_rec('users',$this->post,$this->post['id']))

            {

                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],mysql_error());

            }

            else

            {

                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],'شكراً');

            }            

        }        

    }

}?>