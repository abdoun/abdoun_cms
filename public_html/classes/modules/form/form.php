<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class form 
{
    function open_form($name,$action,$method='post',$plus='')
    {
      ?>
    <form name="<?php print($name);?>" method="<?php print($method);?>" action="<?php print($action);?>" <?php print($plus);?>>
      <?php
    }
    function close_form()
    {  
     ?></form><?php 
    }
    function add_input($name,$type,$caption='',$value='',$plus='')
    {
      print($caption." ");
      if($type=='textarea')
    	{
    		?><br /><textarea <?php print($plus);?> name="<?php print($name);?>" rows="5" cols="50"><?php print($value);?></textarea><?php    
    	}
    	else
    	{
    	   if($value!=''){$value=' value="'.$value.'"';}else{$value='';}
    	  ?><input type="<?php print($type);?>" <?=$value;?> name="<?php print($name);?>" <?php print($plus);?> /><?php
    	}
    }
    function add_select($name,$arr,$selected='',$size='',$caption='',$plus='')
    {
    	print($caption." ");
    	?>
    	<select name="<?php print($name);?>" size="<?php print($size);?>" <?php print($plus);?>>
    	<?php foreach($arr as $key=>$option)
    	{?>
    	<option value="<?php print($key);?>" <?php if($selected==$key){print("selected");}?>><?php print($option);?></option>
    	<?php 
    	}?>
    	</select>
    	<?php
    }	
}?>