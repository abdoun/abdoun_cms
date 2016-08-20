<?php error_reporting(0);
header("Content-Type: text/html; charset=utf-8");
define('_PHP_DOT_PRO','ebdbf06090f7fcd532551060tfb9a5543');
include_once('init_conf/config.inc.php');
set_time_limit(3600);
/** 
* @todo construct modules class 
**/
inclusion::include_classes_folder('classes/modules');
//$modules=inclusion::construct_classes_folder('classes/modules');
/**
* @todo inclusion block class 
**/
inclusion::include_classes_folder('classes/block');

//js::script();
$mysql_db=new mysql_db(Allconstants::_DB_NAME,Allconstants::_DB_SERVER,Allconstants::_DB_USERNAME,Allconstants::_DB_PASSWORD);
/**
* @todo clean All request data
**/
//clean::clean_http_sub_arrays();
clean::clear_array($_GET);
clean::clear_array($_SESSION);
if(!empty($_GET['page']))
{
    $obj=inclusion::construct_class_file('classes/app/'.$_GET['page'].'/'.$_GET['page'].'.php',$_GET,$_POST);
}
else
{
    print('<p align="center">صفحة الإدارة</p>');
}
$mysql_db->close();?>