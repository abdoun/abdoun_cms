<?php //error_reporting(0);
define('_PHP_DOT_PRO','ebdbf06090f7fcd532551060tfb9a5543');
/**
 * @author 
 * @copyright  2010
 * @name rss
 * @link http://-sy.com/rss.php
 * @version 1.0.0 
 **/
class rss
{
    protected $html='';
    public function __construct($iid,$l)
    {
        $this->rss_content($iid,$l);
        //$this->get_rss();
    }
    public function get_rss()
    {
        return $this->html;
    }
	protected function rss_content($iid,$l)
    {
    $sql="select a.id,a.title,a.type,a.icon,a.descr,a.body,a._date from content a where a.parent='$iid' and a.enabled>1 and a.language='$l' order by a.id desc limit 400";
    //print($sql);
    $resu1=mysql_query($sql)or print(mysql_error()." 95 ");
    while($resu01=mysql_fetch_array($resu1))
    	{	
		  if($resu01['type']=='redirect')
          {
            $output_link=str_replace('&','&amp;',urlencode($resu01['a.body'])) ;            
          }
          elseif($resu01['type']=='')
          {
            $re=mysql_fetch_array(mysql_query("select type from content where id='$iid'"));
              //$output_link='page_';
              $output_link='index.php?l=';
		      //$output_link=$output_link.$l.'_'.$resu01['id'].'_'.$resu01['ttype'].'_content_'.$resu01['brand'].'_view_'.clean::clean_url($resu01['title']);
              //$output_link=$output_link.$l.'&amp;id='.$resu01['id'].'&amp;type='.$re['type'].'&amp;page=content&amp;event=view&amp;title='.clean::clean_url(urlencode($resu01['title']));
              $output_link=$l.'/'.$resu01['id'].'/'.$re['type'].'/content/view/'.clean::clean_url(urlencode($resu01['title']));
          }
          else
          {
		  //$output_link='page_';
          $output_link='index.php?';
		  //$output_link=$output_link.$l.'_'.$resu01['id'].'_'.$resu01['type'].'_content_'.$resu01['brand'].'_0_'.clean::clean_url($resu01['title']);
          //$output_link=$output_link.'l='.$l.'&amp;id='.$resu01['id'].'&amp;type='.$resu01['type'].'&amp;page=content&amp;event=0&amp;title='.clean::clean_url(urlencode($resu01['title']));
          $output_link=$l.'/'.$resu01['id'].'/'.$resu01['type'].'/content/0/'.clean::clean_url(urlencode($resu01['title']));
          }
		  $this->html.='<item>';
		  $this->html.='<title>'.addslashes($resu01['title']).'</title>';
          //$this->html.='<link>http://'.$_SERVER['SERVER_NAME'].'/'.$output_link.'</link>';
          $this->html.='<link>http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).$output_link.'</link>';
          //$this->html.='<link>http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).$output_link.'</link>';
		  $this->html.='<description>'.addslashes($resu01['descr']).'</description>';
          //$this->html.='<pubDate>'.addslashes(date('D M j G:i:s T Y',mktime($resu01['_date']))).'</pubDate>';
          //$this->html.='<image><url>http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'upload/'.$resu01['icon'].'</url><title>'.addslashes($resu01['title']).'</title><link>http://'.$_SERVER['SERVER_NAME'].'</link></image>';
		  $this->html.='</item>';
    	  $this->rss_content($resu01['id'],$l);
    	}				 
    }
}

include_once('../init_conf/config.inc.php');
/** 
* @todo Construct modules class 
**/
$modules=inclusion::construct_classes_folder('classes/modules');

clean::clean_http_sub_arrays();
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
if(!empty($_GET['l'])){$sql=" and language='".$_GET['l']."'";}else{$sql="";}
//$brands=$modules[mysql_db]->get_records_by_key("select id,icon,title,keywords from content where parent='' and enabled=2 $sql limit 1");

  $html='<?xml version=\'1.0\' encoding=\'utf-8\'?>';
  $html.='<rss version=\'2.0\'>';
  $html.='<channel>';
  $html.='<title>'.$get_lang['sitename'][0].'</title>';
  $html.='<link>'.substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'</link>';
  $html.='<description>'.$get_lang['keywords'][0].'</description>';
  $html.='<language>'.$get_lang['shortcut'][0].'</language>';
    $rss=new rss($_GET['id'],$l);
    $html.=$rss->get_rss();
  $html.='</channel>';
  $html.='</rss>';
$html=uri::get_text_uri($html);
echo $html;////////////////////////////////////////////////////

$modules[mysql_db]->close();
?>