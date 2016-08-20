<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class form 
{
    function open_form($name,$action,$method='post',$plus='')
    {
      ?>
    <form name="<?php print($name);?>" method="<?php print($method);?>" action="<?php print($action);?>" <?php print($plus);?>>
    <script type="text/javascript" src="ck-editor/ckfinder/ckfinder.js"></script>
	<script type="text/javascript">

    function BrowseServer(functionData)
    {
        // You can use the "CKFinder" class to render CKFinder in a page:
    	var finder = new CKFinder();
    	finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
    	finder.selectActionFunction = SetFileField;
        // Additional data to be passed to the selectActionFunction in a second argument.
    	// We'll use this feature to pass the Id of a field that will be updated.
    	finder.selectActionData = functionData;
    	finder.popup();
    
    	// It can also be done in a single line, calling the "static"
    	// popup( basePath, width, height, selectFunction ) function:
    	// CKFinder.popup( '../', null, null, SetFileField ) ;
    	//
    	// The "popup" function can also accept an object as the only argument.
    	// CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
    }
    
    // This is a sample function which is called when a file is selected in CKFinder.
    function SetFileField( fileUrl ,data)
    {
        arr=fileUrl.split('upload');
        document.getElementById( data["selectActionData"] ).value = arr[1];
        //document.getElementById('picture').innerHTML='<img src=' + fileUrl + ' border=0 width=200 height=200>';
    }    
    </script>
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
    		?><br /><textarea <?php print($plus);?> name="<?php print($name);?>" id="<?php print($name);?>" rows="5" cols="50"><?php print($value);?></textarea><?php    
    	}
        elseif($type=='file_selector')
        {
            if($value!=''){$value=' value="'.$value.'"';}else{$value='';}
    	  ?><input type="text" <?=$value;?> name="<?php print($name);?>" id="<?php print($name);?>" <?php print($plus);?> /><input type="button" value="استعراض" onclick="BrowseServer('<?=$name;?>');" /><?php
        }
        elseif($type=='file_selector_')
        {
    	  ?><textarea name="<?php print($name);?>" id="<?php print($name);?>" <?php print($plus);?> rows="5" cols="50"><?=$value;?></textarea><input type="button" value="استعراض" onclick="BrowseServer('<?=$name;?>');" /><?php
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
    function add_select_multiple($name,$arr,$selected='',$size='',$caption='',$plus='')
    {
    	print($caption." ");//print_r($selected);
    	?>
    	<select name="<?php print($name);?>" size="<?php print($size);?>" <?php print($plus);?>>
    	<?php foreach($arr as $key=>$option)
    	{?>
    	<option value="<?php print($key);?>" <?php if(in_array($key, $selected)){print("selected");}?>><?php print($option);?></option>
    	<?php 
    	}?>
    	</select>
    	<?php
    }
}?>