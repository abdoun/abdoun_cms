<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class view_results
 **/
class view_results
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $status = Array(1=>_YES,2=>_NO);

    public function __construct($get='',$post='')
    {
        if(membership::get_id()!==false)
        {
            $this->get=$get;
            $this->post=$post;
            if(!empty($this->get['event']))
            {
                $this->$get['event']();
            }
            else
            {
                $this->browse();
            }
        }
    }
    protected function get_forms($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from forms where enabled>1 order by ordered asc");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from forms where id=$id");
            return $re[name][0];
        }        
    }
    protected function get_answer($id='')
    {
        if($id!='')
        {
            if(!is_numeric($id))
            {
                return $id;
            }
            else
            {
                $re=mysql_db::get_records_by_key("select answer from answers where enabled>1 and id='$id'");
                return $re['answer'][0];
            }
        }
        else
        {
            //$re=mysql_db::get_records_to_row("select id,answer from answers where enabled>1 order by ordered asc");
            //return array(''=>'')+$re;
            return '';
        }
    }
    protected function get_question($id='')
    {
        if($id!='')
        {
            $re=mysql_db::get_records_by_key("select question from questions where enabled>1 and id='$id'");
            return $re['question'][0];
        }
        else
        {
            $re=mysql_db::get_records_to_row("select id,question from questions where enabled>1 order by ordered asc");
            return array(''=>'')+$re;
        }
    }
    protected function get_members($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from members where active>1 order by name asc");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select name from members where id=$id");
            return $re[name][0];
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
        print(_view_results);
        $caption = ob_get_contents();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        //$res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->get['l']."' and enabled=2");
        define('_KEYWORDS',_view_results);
        define('_DESCRIPTION',_view_results);
        define('_TITLE_PAGE',_view_results);
    }
    protected function browse($msg='')
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        if($this->get['page']!='content')
        {
            $html=$this->navigator($html);
        }
        ob_start();
        $member_type=mysql_db::get_records_by_key("select groups from groups_members where members='".membership::get_id()."'");
        if($member_type['groups'][0]=='1')
        {
            $res=mysql_db::get_records_by_key("select * from sessions where spokesman='".membership::get_id()."'");
        }
        else
        {
            $res=mysql_db::get_records_by_key("select * from sessions where member='".membership::get_id()."' order by srart_date desc");
        }
        print('<div style="margin:10px;"><table width="100%">');
        print('<tr bgcolor="#969696"><td>#</td><td>'._DATE.'</td><td>المقيم</td><td>الناطق</td><td>الاستمارة</td><td>'._MORE.'</td></tr>');
        foreach($res['id'] as $key=>$value)
        {
            if($key%1==0){$bgcolor='bgcolor="#C0C0C0"';}else{$bgcolor='bgcolor="#f0f0f0"';}
            print('<tr '.$bgcolor.'><td>'.$value.'</td><td>'.$res['start_date'][$key].'</td><td>'.$this->get_members($res['member'][$key]).'</td><td>'.$this->get_members($res['spokesman'][$key]).'</td><td>'.$this->get_forms($res['forms'][$key]).'</td><td><a onclick="get(\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/page/ajax.php?l='.$this->get['l'].'&page=view_results&type=view_results&event=view&id='.$value.'&\',\'tr'.$value.'\');" href="javascript://">'._MORE.'</a></td></tr>');
            print('<tr height="0" style="height:0;"><td height="0" style="height:0;" colspan="6" id="tr'.$value.'"></td></tr>');
        }
        print('</table></div>');
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',$content,$html);
    }
    protected function act()
    {
        return '';
    }
    protected function view()
    {
        $res=mysql_db::get_records_by_key("select * from results where session='".$this->get['id']."'");
        print('<div style="margin:10px;"><table width="100%">');
        print('<tr bgcolor="#969696"><td>السؤال</td><td>الجواب</td></tr>');
        foreach($res['id'] as $key=>$value)
        {
            if($key%2==0){$bgcolor='bgcolor="#C0C0C0"';}else{$bgcolor='bgcolor="#f0f0f0"';}
            print('<tr '.$bgcolor.'><td>'.$this->get_question($res['question'][$key]).'</td><td>'.$this->get_answer($res['answer'][$key]).'</td></tr>');
        }
        print('</table></div>');
    }
}?>