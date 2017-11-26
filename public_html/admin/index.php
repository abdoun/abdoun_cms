<?php error_reporting(0);
define('_PHP_DOT_PRO','ebdbf06090f7fcd532551060tfb9a5543');
session_start();
include_once('../../admin_init_conf/config.inc.php');
/** 
* @todo inclusion modules class
**/
inclusion::include_classes_folder('classes/modules');
/**
* @todo inclusion block class
**/
inclusion::include_classes_folder('classes/block');        
/**
* @todo check permission
**/
$mysql_db=new mysql_db(Allconstants::_DB_NAME,Allconstants::_DB_SERVER,Allconstants::_DB_USERNAME,Allconstants::_DB_PASSWORD);
/**
* @todo clean All request data
**/
clean::clean_http_sub_arrays();
/**
* @todo get the requested language or default language from db
**/
//print_r($_COOKIE);
//print('<br>');
languages_menu::set();
//print_r($_COOKIE);
$html=inclusion::get_include_file('template/adminpage/en/tpl.html');
$html=str_replace('<javascript_tag />',js::script(),$html);
$html=str_replace('<langauge_select_tag />',languages_menu::view(),$html);
$html=str_replace('<admin_page_tag />',_ADMIN_PAGE_TAG,$html);
$html=str_replace('<content_tag />',header_menu::auto_view('classes/app'),$html);
$html=str_replace('<bottomFooter_tag />',footer_menu::manual_view(),$html);
$html=str_replace('images','template/adminpage/'.$_COOKIE['l'].'/images',$html);
$html=str_replace('style.css','template/adminpage/'.$_COOKIE['l'].'/style.css',$html);
//$html=str_replace('jquery.js','template/adminpage/jquery.js',$html);
$html=str_replace('script.js','template/adminpage/'.$_COOKIE['l'].'/script.js',$html);
//$main=inclusion::get_include_contents('main.php');
//$html=str_replace('<bTarTd_tag />',$main,$html);
$html=str_replace('<dir_tag />',_DIR,$html);
$html=str_replace('<align_tag />',_ALIGN,$html);
echo($html);
$mysql_db->exec_query("delete from content where title=''");
$mysql_db->close();?>
<script type="text/javascript">
	javascript:hpReq.getData('main.php?d='+new Date().getTime(),'bTarTd');
    //_.get('main.php?d='+new Date().getTime(), function(data) {
//      _('#bTarTd').html(data);      
//    });
</script>