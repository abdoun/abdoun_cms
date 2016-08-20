<?php error_reporting(0);?>
<?php define('_PHP_DOT_PRO','ebdbf06090f7fcd532551060tfb9a5543');?>
<?php
include_once('init_conf/config.inc.php');
/** 
* @todo inclusion modules class 
**/
inclusion::include_classes_folder('classes/modules');
/**
* @todo inclusion block class 
**/
inclusion::include_classes_folder('classes/block');        
/**
* @todo clean All request data
**/
clean::clean_http_sub_arrays();
$html=inclusion::get_include_file('template/adminpage/tpl.html');
$html=str_replace('<javascript_tag />',js::script(),$html);
$html=str_replace('<content_tag />',header_menu::auto_view('classes/app'),$html);
$html=str_replace('<bottomFooter_tag />',footer_menu::manual_view(),$html);
$html=str_replace('images','template/adminpage/images',$html);
$html=str_replace('style.css','template/adminpage/style.css',$html);
//$html=str_replace('jquery.js','template/adminpage/jquery.js',$html);
$html=str_replace('script.js','template/adminpage/script.js',$html);

//$main=inclusion::get_include_contents('main.php');
//$html=str_replace('<bTarTd_tag />',$main,$html);
echo($html);?>
<script type="text/javascript">
	javascript:hpReq.getData('main.php?d='+new Date().getTime(),'bTarTd');
</script>