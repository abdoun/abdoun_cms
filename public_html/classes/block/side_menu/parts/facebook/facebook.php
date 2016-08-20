<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright 2013
 * @class facebook
 */
class facebook 
{
    protected $get="";
    protected $post="";
    
    public function __construct($get='',$post='')
    {
        $this->get=$get;
        $this->post=$post;               
        if(!empty($get['event']))
        {
            $this->$get['event']();
        }
        else
        {
            $this->browse($get['l']);
        }
    }
    protected function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    protected function get_url()
    {
        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).'template/');
        $arr=explode('classes',$path);
        return 'classes/'.$arr[1];
    }
    protected function browse()
    {
        ?><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
       	<fb:like-box border_color="#AAAAAA" header="true" href="https://www.facebook.com/R.L.C.Damascus" show_faces="true" stream="true" width="230" height="600"></fb:like-box>
        <?php
    }
    function view($l='')
    {
       
           $html=self::template_include();
           $html=str_replace('<dir_tag />',_DIR,$html);
           $html=str_replace('<title_ />','Facebook',$html);
           ob_start();
           self::browse();
           $content = ob_get_contents();
           ob_end_clean();
           
           //$content.='<div id="down_login">&nbsp;</div>';
           $html=str_replace('<align_ />',_ALIGN_,$html);
           $html=str_replace('<_align_ />',_ALIGN,$html);
           $html=str_replace('<tag />',$content,$html);
       
              
       return $html;
    }
    protected function act()
    {
        		
    }
}?>