<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class rss_
 **/
class rss_
{
    protected $params="";
    protected $case="";
    protected $post="";
    
    public function __construct($arr='',$post='')
    {
        $this->params=$arr;
        $this->post=$post;        
        if(!empty($this->params['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
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
        print('RSS ');
        $caption = ob_get_contents();
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        $res=mysql_db::get_records_by_key("select title,keywords,descr from content where id='".$this->params['id']."' and parent='' and enabled=2");
        define('_KEYWORDS',$res['keywords'][0]);
        define('_DESCRIPTION',$res['descr'][0]);
        define('_TITLE_PAGE',$res['title'][0]);
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        print('<script type="text/javascript">location.href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'rss.php?l='.$this->params['l'].'";</script>');        
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',$content,$html);
    }
}?>