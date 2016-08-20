<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
define('_PHP_DOT_PRO','ebdbf06090f7fcd532551060tfb9a5543');
if($_POST['id']!='' && !empty($_POST['answerr']) && !isset($_COOKIE['cookie']))
{
	setcookie("cookie",$_POST['id'],mktime()+60*60*24*30);
}
include_once('../../../../init_conf/config.inc.php');
/** 
* @todo Construct modules class 
**/
$modules=inclusion::construct_classes_folder('../../../classes/modules');
/**
* @todo clean All request data
**/
clean::clean_http_sub_arrays();
/**
* @todo get the requested language or default language from db
**/
if(isset($_POST['l'])){$l=$_POST['l'];}else{$l=$_GET['l'];}
if(isset($l) && $l!="")
{
    $get_lang=$modules[mysql_db]->get_records_by_key("select * from languages where id=".$l);    
}
else
{
    $get_lang=$modules[mysql_db]->get_records_by_key("select * from languages where `default`=2 limit 1");
    $l=$get_lang['id'][0];
    $_GET['l']=$get_lang['id'][0];
}
print('<script type="text/javascript" src="js/scripts/jquery.js"></script><script type="text/javascript" src="js/scripts/jquery.corner.js"></script><script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>');
require_once("../../../language/".$get_lang['shortcut'][0].".php");
inclusion::construct_class_file('../../../classes/block/side_menu/parts/'.$_GET['page'].'/'.$_GET['page'].'.php',$_GET,$_POST);
?>