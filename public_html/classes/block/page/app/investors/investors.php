<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class investors
 **/
class investors
{
    protected $get="";
    protected $case="";
    protected $post="";
    
    public function __construct($arr='',$post='')
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
        print('<a href="page_2_222_ext_content_106_0_%D8%A3%D8%B9%D8%B6%D8%A7%D8%A1-%D8%A7%D9%84%D9%85%D8%AC%D9%84%D8%B3">'._COUNCIL_MEMBER.'</a>');
        $caption = ob_get_contents();
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);
    }
    protected function set_meta_desc($about='')
    {
        $res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->get['l']."' and enabled=2");
        define('_KEYWORDS',$res['keywords'][0].','._COUNCIL_MEMBER.','.$about);
        define('_DESCRIPTION',$res['description'][0].'-'._COUNCIL_MEMBER.' '.$about);
        define('_TITLE_PAGE',$res['sitename'][0].'-'._COUNCIL_MEMBER.'-'.$about);
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        //$html=$this->navigator($html);
        ob_start();
        if($this->post['q']!=''){$sql.=" and( name like '%".$this->post['q']."%' or company like '%".$this->post['q']."%' or activity like '%".$this->post['q']."%' or email like '%".$this->post['q']."%') ";}
        
        if($this->post['rec']>0)
        {
            if($this->post['pages']=='')
            {
                $this->post['pages']=0;
            }
            //$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";
            $limit.=" limit ".$this->post['rec'].",".$this->post['pages']."";
        }
        else
        {
            $limit=' limit 0,10';
        }
        $num=mysql_db::get_records_by_key("select id from members where active=2 $sql");
        $res=mysql_db::get_records_by_key("select * from members where active=2 $sql order by ddate desc $limit");
        //form::open_form('seek form','?l='.$this->get['l'].'&page=investors&type=investors&event=browse&id='.$this->get['id'].'&brand='.$this->get['brand'].'&');
        form::open_form('seek form','page_'.$this->get['l'].'_'.$this->get['id'].'_ext_content_'.$this->get['brand'].'_0_'.clean::clean_url(_COUNCIL_MEMBER).'');
        form::add_input('q','text',_SEARCH.': ',$this->post['q']);
        form::add_input('submitt','submit','',_SEARCH);
        form::close_form();
        print('<table>');
        print('<tr bgcolor="#969696"><td>'._NAME.'</td><td>'._COMPANY.'</td><td>'._COMPANY_ACTIVITY.'</td><td>'._EMAIL.'</td><td>'._WEBSITE.'</td><td></td></tr>');
        for($i=0;$i<count($res['id']);$i++)
        {
            print('<tr bgcolor="#f0f0f0"><td>'.$res['name'][$i].'</td><td>'.$res['company'][$i].'</td><td>'.$res['activity'][$i].'</td><td>'.$res['email'][$i].'</td><td><a href="'.$res['website'][$i].'" target="_blank">'.$res['website'][$i].'</a></td><td><a href="page_'.$this->get['l'].'_'.$res['id'][$i].'_investors_investors_'.$this->get['brand'].'_view_'.clean::clean_url($res['company'][$i]).'">'._VIEW.'</a></td></tr>');
        }
        print('<tr bgcolor="#969696"><td>'.count($num['id']).'</td><td colspan="5">');
        if(count($num['id'])>10)
        {
            for($i=0;$i<count($num['id']);$i+=10)
            {
                $page[$i]=$j++;
            }
            form::open_form('paging_form','?l='.$this->get['l'].'&page=content&type=ext&event=browse&id='.$this->get['id'].'&brand='.$this->get['brand'].'&','post',' id="paging_form" onsubmit="return false;"');
            form::add_select('rec',$page,$this->post['rec'],'',_PAGE,' onchange="paging_form.submit();"');
            form::add_input('pages','hidden','',10);
            form::close_form();
        }
        
        print('</td></tr>');
        print('</table>');
        
        $content = ob_get_contents();
        ob_end_clean();
        
        echo str_replace('<content_tag />',$content,$html);
    }
    protected function view()
    {
        
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        print('<br />');
        $res=mysql_db::get_records_by_key("select * from members where id='".$this->get['id']."' and active=2");
        $this->set_meta_desc($res['company'][0]);
        $content=_NAME.': '.$res['name'][0].'<br />';
        $content.=_POSITION.': '.$res['position'][0].'<br />';
        $content.=_COMPANY.': '.$res['company'][0].'<br />';
        $content.=_COMPANY_ACTIVITY.': '.$res['activity'][0].'<br />';
        $content.=_SECTION_NO.': '.$res['section_no'][0].'<br />';
        $content.=_SECTOR_NO.': '.$res['sector_no'][0].'<br />';
        $content.=_FAX.': '.$res['fax'][0].'<br />';
        $content.=_PHONE.': '.$res['phone'][0].'<br />';
        $content.=_EMAIL.': '.$res['email'][0].'<br />';
        $content.=_WEBSITE.': '.$res['website'][0].'<br />';
        $content.=_PER_PIC.': <img src="upload/members/'.$res['picture'][0].'" width="120" align="center"/><br />';
        $content.=_WEBSITE.': <a href="'.$res['website'][0].'" target="_blank">'.$res['website'][0].'</a><br />';
        $content.=_TRADE_REC_NO.': '.$res['trade_rec_no'][0].'<br />';
        $content.=_INDUST_REC_NO.': '.$res['indust_rec_no'][0].'<br />';
        $content.=_MANAGE_LICENSE.': '.$res['manage_license'][0].'<br />';
        box::box_border($content);
        
        $content = ob_get_contents();
        ob_end_clean();        
        echo str_replace('<content_tag />',$content,$html);        
    }    
}?>