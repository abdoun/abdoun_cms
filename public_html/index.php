<?php error_reporting(0);

session_start();

header("Content-Type: text/html; charset=utf-8");

define('_PHP_DOT_PRO','ebdbf06090f7fcd532551060tfb9a5543');

//set_time_limit(600);

include_once('../init_conf/config.inc.php');

/** 

* @todo Construct modules class 

**/

$modules=inclusion::construct_classes_folder('classes/modules');

/**

* @todo inclusion block class 

**/

inclusion::include_classes_folder('classes/block');        

/**

* @todo clean All request data

**/

///////////////clean::clear_http();

//print($_GET['l']);

clean::clean_http_sub_arrays();

//print($_GET['l']);

/**

* @todo get the requested language or default language from db

**/

if(isset($_POST['l'])){$l=$_POST['l'];}else{$l=$_GET['l'];}

if($l!="")

{

    $get_lang=$modules[mysql_db]->get_records_by_key("select * from languages where id=".$l);    

}

else

{

    $get_lang=$modules[mysql_db]->get_records_by_key("select * from languages where `default`=2 limit 1");

    $l=$get_lang['id'][0];

    $_GET['l']=$get_lang['id'][0];

}

/**

* @todo read the template and fill in it

**/

define('_INDEX_PAGE',basename(__FILE__));

$html=inclusion::get_include_file('template/beanpod/'.$get_lang['shortcut'][0].'/tpl.html');

$html=str_replace('<rss_tag />','rss.php?l='.$l.'',$html);

$html=str_replace('<domain_tag />',$_SERVER['SERVER_NAME'],$html);

require_once("language/".$get_lang['shortcut'][0].".php");

//$html=str_replace('<javascript_tag />','<script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script><script type="text/javascript" src="js/prototype.js"></script><script type="text/javascript" src="js/scriptaculous.js"></script><script type="text/javascript" src="js/lightview.js"></script><link rel="stylesheet" type="text/css" href="css/lightview.css" /><script src="js/scripts/jquery.js"></script>',$html);

$html=str_replace('<javascript_tag />','<script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'js/scripts/javaScript.js"></script><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'js/scripts/jscript.js"></script><script src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'js/scripts/jquery.js"></script><script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4fc556883592dacb"></script>',$html);

if($_GET['type']=='image'){$html=str_replace('<javascript_proto />','<script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'js/prototype.js"></script><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'js/scriptaculous.js"></script><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'js/lightview.js"></script><link rel="stylesheet" type="text/css" href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'css/lightview.css" />',$html);}



$html=str_replace('<shortcut_tag />',$get_lang['shortcut'][0],$html);

//$html=str_replace('<javascript_tag />',js::script(),$html);

$html=str_replace('<header_tag />',header_menu::view($_GET[l]),$html);



$html=str_replace('<footer_tag />',footer_menu::view($_GET[l]),$html);

$html=str_replace('<marquee_tag />',marquee::view($_GET[l]),$html);

$html=str_replace('<cache_tage />',Allconstants::_CACHE,$html);

//define('_TITLE_PAGE',$get_lang['sitename'][0]);

//define('_KEYWORDS',$get_lang['keywords'][0]);

//define('_DESCRIPTION',$get_lang['description'][0]);

$html=str_replace('images','http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'template/beanpod/'.$get_lang['shortcut'][0].'/images',$html);

$html=str_replace('style.','http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'template/beanpod/'.$get_lang['shortcut'][0].'/style.',$html);

$html=str_replace('<right_tag />',side_menu::view($_GET[l]),$html);

$html=uri::get_text_uri($html);

$html=str_replace('<body_tag />',page::view($_GET[l]),$html);

$html=str_replace('<title_tag />',$get_lang['sitename'][0].' - '._TITLE_PAGE,$html);

$html=str_replace('<keywords_tag />',_KEYWORDS,$html);

$html=str_replace('<description_tag />',_DESCRIPTION,$html);

$modules[mysql_db]->close();

echo($html);?>