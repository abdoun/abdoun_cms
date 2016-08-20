<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class build_sitemap
 */
class build_sitemap 
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $xml='';
    
    function __construct($arr='',$post='')
    {
        $this->get=$arr;
        $this->post=$post;
        if(!empty($this->get['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
    }
    protected function get_brand($brand='')
    {
        if($brand!='')
        {
            $re=mysql_db::get_records_by_key("select title from content where parent='' and brand=$brand");
            return $re['title'][0];
        }
        else
        {
            return mysql_db::get_records_to_row("select id,title from content where parent=''");
        }
    }
    protected function get_date($ddate='')
    {
        $arr=getdate($ddate);
        return ''.$arr['year'].'/'.$arr['mon'].'/'.$arr['mday'].' '.$arr['hours'].'-'.$arr['minutes'].'-'.$arr['seconds'].'';
    }
    protected function browse()
    {        
        print('<br /><br /><p align="center"><a style="font-size:18px;" href="'.box::href("page=".$this->get['page']."&class=".$this->get['class']."&event=act").'"><strong>توليد</strong></a></p><br /><br />');        
    }
    protected function form()
    {
        
    }
    protected function act()
    {
        $this->xml='<?xml version=\'1.0\' encoding=\'utf-8\'?>';
        $this->xml.='<urlset xmlns=\'http://www.sitemaps.org/schemas/sitemap/0.9\'';
        $this->xml.=' xmlns:xsi=\'http://www.w3.org/2001/XMLSchema-instance\'';
        $this->xml.=' xsi:schemaLocation=\'http://www.sitemaps.org/schemas/sitemap/0.9';
        $this->xml.=' http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\'>';
        //$this->xml.='&lt;-- created with  marketing team www.-sy.com.com --&gt;';
        $this->map();
        $this->xml.='</urlset>';
        $handle=fopen('../sitemap.xml','w');
        fwrite($handle,$this->xml);
        fclose($handle);
        print('<br />شكراً تم توليد الملف: ');
        print('<a href="../sitemap.xml" target="_blank">sitemap.xml</a><br />');
    }
    protected function delete()
    {
                
    }
    protected function map($iid='',$l='')
    {
        if($iid=='' && $l=='')
        {
            $sql="select id,type,language,body,title from content where parent='' and enabled=2 and `type`<>'' order by id desc limit 1000";
        }
        else
        {
            $sql="select a.id,a.`type`,a.language,a.body,a.title,b.`type` as ttype from content a inner join content b on a.parent=b.id where a.parent='$iid' and a.enabled=2 and b.enabled=2  and a.language='$l' order by a.id desc limit 1000";
        }        
        $resu1=mysql_query($sql)or print(mysql_error()." 95 ");//print(mysql_num_rows($resu1).'<br />');
        while($resu01=mysql_fetch_array($resu1))
    	{	
		  if($resu01['type']=='redirect')
          {
            $output_link=str_replace('&','&amp;',$resu01['body']) ;            
          }
          elseif($resu01['type']=='')
          {
		  $output_link='';
		  //$output_link=$output_link.'?l='.$resu01['language'].'&amp;id='.$resu01['id'].'&amp;type='.$resu01['ttype'].'&amp;page=content&amp;event=view';
          $output_link=$output_link.''.$resu01['language'].'/'.$resu01['id'].'/'.$resu01['ttype'].'/content/view/'.$resu01['title'];
          }
          else
          {
              $output_link='';
		      //$output_link=$output_link.'?id='.$resu01['id'].'&amp;type='.$resu01['type'].'&amp;l='.$resu01['language'].'&amp;page=content';
              $output_link=$output_link.''.$resu01['language'].'/'.$resu01['id'].'/'.$resu01['type'].'/content/0/'.$resu01['title'];
          }    		  
          $this->xml.='<url><loc>http://www.'.$_SERVER['SERVER_NAME'].'/'.$output_link.'</loc></url>';    		  
    	  $this->map($resu01['id'],$resu01['language']);
    	}
    }
}?>