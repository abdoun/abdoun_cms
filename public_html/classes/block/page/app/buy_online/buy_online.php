<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class buy_online
 **/
class buy_online
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $status = Array(1=>_YES,2=>_NO);
    
    public function __construct($arr='',$post='')
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
    protected function get_products($id='')
    {
        if($id!='')
        {
            $re=mysql_db::get_records("select name from products where enabled=2 and language=".$this->get['l']." and id=$id");
            return $re[0][0];            
        }
        else
        {
            return mysql_db::get_records_to_row("select id,name from products where enabled=2 and language=".$this->get['l']."");
        }
    }
    protected function get_name_pro($id)
    {
        if($id!='')
        {
            $re=mysql_db::get_records("select name from brand_pro where enabled=2 and id=$id");
            return $re[0][0];            
        }
    }
    protected function get_pro($id='')
    {
        if($id!='')
        {
            return mysql_db::get_records_to_row("select id,name from brand_pro where enabled=2 and products=$id");            
        }
        else
        {
            return mysql_db::get_records_to_row("select id,name from brand_pro where enabled=2");
        }
    }
    protected function get_pro_list()
    {
        return form::add_select('pro',$this->get_pro($this->get['product']),$this->post['pro'],'','',' id="pro"');
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
        print(_BUY_ONLINE);
        $caption = ob_get_contents();
        $caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        //$res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->get['l']."' and enabled=2");
        define('_KEYWORDS',_BUY_ONLINE);
        define('_DESCRIPTION',_BUY_ONLINE);
        define('_TITLE_PAGE',_BUY_ONLINE);
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        if($this->get['page']!='content')
        {
            $html=$this->navigator($html);
        }
        ob_start();
        //print('<script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>');
        print('<br /><div id="buy_online_result"></div>');
        ?>
        <script type="text/javascript">
        	function validate_(frm)
            {
            	if(frm.name.value=="")
            	{
                    document.getElementById('buy_online_result').innerHTML='<span><?=addslashes(_NO_NAME);?></span>';
            		frm.name.focus();
            		return false;
            	}
            	else if(frm.email.value=="")
            	{
                    document.getElementById('buy_online_result').innerHTML='<span><?=addslashes(_NO_EMAIL);?></span>';
            		frm.email.focus();
            		return false;
            	}
                else if(frm.mobile.value=="")
            	{
                    document.getElementById('buy_online_result').innerHTML='<span><?=_ERROR;?> <?=_MOBILE;?></span>';
            		frm.mobile.focus();
            		return false;
            	}
                else if(frm.address.value=="")
            	{
                    document.getElementById('buy_online_result').innerHTML='<span><?=addslashes(_ERROR);?> <?=addslashes(_ADDRESS);?></span>';
            		frm.address.focus();
            		return false;
            	}
                else if(frm.quantity.value=="")
            	{
                    document.getElementById('buy_online_result').innerHTML='<span><?=_ERROR;?> <?=_QUANTITY;?></span>';
            		frm.quantity.focus();
            		return false;
            	}
            	else if(frm.code.value=="")
            	{
            	    document.getElementById('buy_online_result').innerHTML='<span><?=_ERROR;?> <?=_CODE;?></span>';
            		frm.code.focus();
            		return false;
            	}
                else
                {
                    //alert('ok');
                    post('buy_online_form','buy_online_result');
                    //frm.name.value='';
                    //frm.email.value='';
                    //frm.code.value='';
                    return false;
                }
                return false;
            }
        </script>
        <form method="post" action="classes/block/page/ajax.php?l=<?=$this->get[l];?>&page=buy_online&type=buy_online&event=act" id="buy_online_form" name="buy_online_form" onsubmit="return validate_(this);">
        <table width='70%'>
          <tr>
            <td><?=_PRODUCT ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td>
            <?php
            $products_default=$this->get_products();
            form::add_select('products',$products_default,$this->post['products'],'','',' id="products" onchange="javascript:get(\'classes/block/page/ajax.php?l='.$this->get[l].'&page=buy_online&type=buy_online&event=get_pro_list&product=\' + this.value + \'&\',\'pro_list\');"');
            ?>
            </td>
          </tr>
          <tr>
            <td><?=_KIND ;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><div id="pro_list">
            <?php
            foreach($products_default as $key=>$value)
            {
                $array[]=$key;
            }
            form::add_select('pro',$this->get_pro($array[0]),$this->post['pro'],'','',' id="pro"');
            ?>
            </div></td>
          </tr>
          <tr>
            <td><?=_NAME;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='name' type='text' id="name" value="<?=$this->post['name'];?>" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_EMAIL;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='email' type='text' id="email" value="<?=$this->post['email'];?>" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim(this.value);" onkeyup="this.value=trim(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_MOBILE;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='mobile' type='text' id="mobile" value="<?=$this->post['mobile'];?>" maxlength='30' onkeypress="this.value=trim(this.value.toLowerCase());" onblur="this.value=trim(this.value.toLowerCase());" onkeyup="this.value=trim(this.value.toLowerCase());" /></td>
          </tr>
          <tr>
            <td><?=_ADDRESS;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='address' type='text' id="address" value="<?=$this->post['address'];?>" maxlength='255' onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td>
          </tr>
          <tr>
            <td><?=_QUANTITY;?>:<font color="#ff0000" face="tahoma">*</font></td>
            <td><input name='quantity' type='text' id="quantity" value="<?=$this->post['quantity'];?>" maxlength='255' onblur="this.value=trim(this.value);" />
            <?=_QUANTITY_LIMIT;?>
            </td>
          </tr>
          <tr>
            <td><?=_NOTES;?>:<font color="#ff0000" face="tahoma"></font></td>
            <td><textarea name='notes' id="notes" rows="3" cols="30"><?=$this->post['notes'];?></textarea></td>
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
            <input type="hidden" value="<?=$_SERVER["REQUEST_TIME"];?>" name="ddate" />
            <input type="hidden" value="<?=$_SERVER["REMOTE_ADDR"];?>" name="ip" /></td> 
            <td><input type='submit' name="submit" value="<?=_SEND;?>" /></td>
          </tr>
        </table>
        </form>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',box::box_border($content),$html);
    }
    protected function act()
    {
        //print_r($this->post);
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
        if(empty($this->post['mobile']) || (validate::verify($this->post['mobile'],'digit')))
		{
			print("<span>"._ERROR." "._MOBILE."</span><br />");
            $this->case=false;
		}
        if(empty($this->post['address']))
		{
			print("<span>"._ERROR." "._ADDRESS."</span><br />");
            $this->case=false;
		}
        if(empty($this->post['quantity']))
		{
			print("<span>"._ERROR." "._QUANTITY."</span><br />");
            $this->case=false;
		}
        if(empty($this->post['pro'])){$this->post['pro']=$this->post['products'];}
        $products=$this->post['products'];
        $this->post=mysql_db::remove_from_array($this->post,'products');
        $this->post=mysql_db::remove_from_array($this->post,'submit');
        $this->post=mysql_db::remove_from_array($this->post,'rs');
        $this->post=mysql_db::remove_from_array($this->post,'code');
        if($this->case==true)
        {
            if(!mysql_db::add_edit_rec('buy_on_line',$this->post))
            {
                //print(mysql_error());
            }
            else
            {
                $body='<table>';
                $body.='<tr bgcolor="#f0f0f0"><td>products:</td><td>'.$this->get_products($products).'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>type of product:</td><td>'.$this->get_name_pro($this->post['pro']).'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>name:</td><td>'.$this->post['name'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>email:</td><td>'.$this->post['email'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>mobile:</td><td>'.$this->post['mobile'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>Address:</td><td>'.$this->post['address'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>quantity:</td><td>'.$this->post['quantity'].'</td></tr>';
                $body.='<tr bgcolor="#f0f0f0"><td>notes:</td><td>'.$this->post['notes'].'</td></tr>';                
                $body.='</table>';
                if(email::send('Order from: '.$this->post[name],$this->post['email'],$this->post['name'],'sales@-sy.com',$body))
                {
                    print('<div style="border-color: #00ff00;border-style: solid;border-width: 1px;color:#00ff00;background-color: #E5FEDA;width:80%;">'._DONE.'</div>');
                    $_SESSION['new_string']='';
                    $this->post['name']='';
                    $this->post['email']='';
                    $this->post['code']='';
                }
                else
                {
                    print("<span>"._ERROR." "._EMAIL."</span><br />");
                }                                
            }
        }
        else
        {
            //print('false');
        }
    }
}?>