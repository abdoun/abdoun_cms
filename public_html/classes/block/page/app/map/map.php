<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class map
 **/
class map
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
    protected function browse()
    {
        
        $html=$this->template_include();
        ob_start();
        $this->view();
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',block_::box_border($content),$html);
    }
    protected function view($iid='',$nbsp=-1)
    {
        $sql="select * from content where parent='$iid' and enabled=2 and language='".$this->params['l']."' and `type`<>'' order by ordered";
        $resu1=mysql_query($sql)or print(mysql_error()." 95 ");
        $nbsp++;
        while($resu01=mysql_fetch_array($resu1))
    	{
    	   if($resu01['type']=='')
           {
                $re=mysql_fetch_array(mysql_query("select `type` from content where enabled=2 and id='".$resu01['parent']."' and language='".$this->params['l']."'"));
                ?><div id="div_<?=$resu01[id];?>" style="text-align:<?=_ALIGN;?>;color:#000;border:solid 1px #ccc ;margin-top: 2px;padding-<?=_ALIGN;?>:<?php if($nbsp>0){echo($nbsp*20);}?>px" dir="<?php echo _DIR;?>"><a style="color:#000;font-size:16px;font-family:tahoma,arial" href="?l=<?=$this->params['l'];?>&id=<?=$resu01[id];?>&type=<?=$re['type'];?>&page=<?=$this->params['page'];?>&event=view&title=<?php print(clean::clean_url($resu01['title']));?>"><?php print($resu01['title']);?></a><?php //$this->view($resu01['id'],$nbsp);?></div><?php
           }
           else
           {
                ?><div id="div_<?=$resu01[id];?>" style="text-align:<?=_ALIGN;?>;color:#000;border:solid 1px #ccc ;margin-top: 2px;padding-<?=_ALIGN;?>:<?php if($nbsp>0){echo($nbsp*20);}?>px" dir="<?php echo _DIR;?>"><a style="color:#000;font-size:16px;font-family:tahoma,arial" href="?l=<?=$this->params['l'];?>&id=<?=$resu01[id];?>&type=<?=$resu01['type'];?>&page=<?=$this->params['page'];?>&event=0&title=<?php print(clean::clean_url($resu01['title']));?>"><?php print($resu01['title']);?></a></div><?php $this->view($resu01['id'],$nbsp);?><?php
           }    			
    	}				 
    }
}?>