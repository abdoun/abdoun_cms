<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class search_result
 **/
class search_result
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
        print(_SEARCH.' : '.$this->params['q']);
        $caption = ob_get_contents();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        $res=mysql_db::get_records_by_key("select sitename,keywords,description from languages where id='".$this->params['l']."' and enabled=2");
        define('_KEYWORDS',_SEARCH.' : '.$this->params['q']);
        define('_DESCRIPTION',_SEARCH.' : '.$this->params['q']);
        define('_TITLE_PAGE',_SEARCH.' : '.$this->params['q']);
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        if(empty($this->params['q']))
        {
            print(_NO_SEARCH);
        }
        else
        {   
        	$re=mysql_query("select 
        							a.id,
        							a.title,
        							a.`type`,
        							a.body,
                                    a.descr
        							from content a
                                    where 
        							a.enabled>1
                                    and (a.`type`<>'') 
        							and a.language='".$this->params['l']."'
                                     
        							and (
        								a.title like '%".$this->params['q']."%' 
        								or a.descr like '%".$this->params['q']."%'
                                        or a.keywords like '%".$this->params['q']."%' 
        								or a.body like '%".$this->params['q']."%'
        								)
        							order by a.ordered ")or print(mysql_error()." 81 ");
        	$re_sub=mysql_query("select distinct
        							a.id,
        							a.parent,
        							a.title,
                                    a.descr
        							from content a 
                                    where 
        							a.enabled>1
                                    and a.`type`='' 
        							and a.language='".$this->params['l']."'
                                    
        							and (
        								a.title like '%".$this->params['q']."%' 
        								or a.descr like '%".$this->params['q']."%'
                                        or a.keywords like '%".$this->params['q']."%'
                                        or a._author like '%".$this->params['q']."%'
                                        or a.body like '%".$this->params['q']."%'
        								)
        							order by a.ordered ")or print(mysql_error()." 95 ");
        	$no=mysql_num_rows($re) + mysql_num_rows($re_sub);
        	print(_RESULTS." : ".$no);
            $this->add_search_word($no);
        	$i=1;
        	while($res=mysql_fetch_array($re))
        	{
        	   block_::box_border($i++.'- <font size="2">'.$res['title'].'</font><br /><em>'.$res['descr'].'</em> <a href="?l='.$this->params[l].'&id='.$res[id].'&type='.$res['type'].'&page=content&event=0&title='.clean::clean_url($res['title']).'">'._SHOW.'</a>');        		
        	}
        	while($res=mysql_fetch_array($re_sub))
        	{
        		$re=mysql_fetch_array(mysql_query("select id,title,`type`,body from content where enabled>1 and `type`<>'' and language='".$this->params['l']."' and id=".$res['parent']));
                block_::box_border($i++.'- <font size="2">'.$res['title'].'</font><br /><em>'.$res['descr'].'</em> <a href="?l='.$this->params[l].'&id='.$res[id].'&type='.$re['type'].'&page=content&event=view&title='.clean::clean_url($res['title']).'">'._SHOW.'</a>');
        	}
        
        }        
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',$content,$html);
    }
    protected function add_search_word($no)
    {
        if(empty($no))
        {
            $no=0;
        }
        $id=mysql_db::get_records_by_key("select id from search_words where q='".$this->params[q]."' and language='".$this->params['l']."'");//print(mysql_error());
        if($id==false)
        {
            $sql="insert into search_words set q='".$this->params[q]."',results='$no',ip='".$_SERVER['REMOTE_ADDR']."',search_time=Now(),language='".$this->params['l']."'";
        }
        else
        {
            $sql="update search_words set results='$no',ip='".$_SERVER['REMOTE_ADDR']."',search_time=Now(),no=no+1 where id='".$id['id'][0]."'";
        }
        //mysql_db::add_edit_rec("search_words",Array('q'=>$this->params[q],'results'=>$no,'ip'=>$_SERVER[REMOTE_ADDR],'search_time'=>'Now()'));
        mysql_db::exec_query("$sql ");
        //print(mysql_error());
    }
}?>