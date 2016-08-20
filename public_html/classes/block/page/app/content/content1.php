<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class content
 **/
class content
{
    protected $params="";
    protected $case="";
    protected $post="";
    
    public function __construct($arr='',$post='')
    {
        $this->params=$arr;
        $this->post=$post;
        if(empty($this->params['rec']))
        {
            $this->params['rec']='0';
        }
        if(!empty($this->params['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
    }
    protected function get_news_type($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from news_type where enabled>1");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from news_type where id=$id");
            return $re[name][0];
        }        
    }
    protected function get_towns($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from towns where enabled>1");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from towns where id=$id");
            return $re[name][0];
        }        
    }
    protected function hits($id)
    {
        $res=mysql_db::get_records("select hits from ".$this->params['page']." where id=$id");
        mysql_db::add_edit_rec($this->params['page'],array('hits'=>$res[0][0]+1),$id);
    }
    protected function template_include($tpl='tpl.html')
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/'.$tpl);
    }
    protected function get_url($folder='')
    {
        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).$folder.'/');
        $arr=explode('classes',$path);
        return 'classes/'.$arr[1];
    }
    protected function get_fathers($id=1,$l=1,& $title_='')
    {
      $res=mysql_fetch_array(mysql_query("select parent,title,id,type from content where id='$id' and enabled>1 and language='$l'"));
      if($res['type']=='')
      {
      	$title_[].="$res[title] >";	
      }
      //elseif($res['parent']=='')
     //{
        //$title_[].="<a href='index_".$l."_".$res['id']."_".clean::clean_url($res[title])."'>$res[title]</a> >";
        //$title_[].="<a href='?l=".$l."&title=".clean::clean_url($res[title])."'>$res[title]</a> >";
     //}
      else
      {// style='color:#005d83;font-size:16px;font-weight:bold;'
    	//$title_[].="<a href='page_".$l."_".$res['id']."_".$res['type']."_".$this->params['page']."_".$this->params['brand']."_0_".clean::clean_url($res[title])."'>$res[title]</a> >";
        //$title_[].="<a href='?l=".$l."&id=".$res['id']."&type=".$res['type']."&page=".$this->params['page']."&event=0&title=".clean::clean_url($res[title])."'>$res[title]</a> >";
        $title_[].="<a href='http://".$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE))."".$l."/".$res['id']."/".$res['type']."/".$this->params['page']."/0/".clean::clean_url($res[title])."'>$res[title]</a> >";
      }
      
      if($res[parent]!='')
      {
    	$this->get_fathers($res['parent'],$l,$title_);
      }
      else
      	{
      		$title_=array_reverse($title_);
            foreach($title_ as $key=>$value)
    		{
    		  if(count($title_)==1){$value=substr($value,0,strlen($value)-1);}
    		  if($key==0){$value=''.$value.' ';}
    		  if($key==count($title_)-1){echo substr($value,0,strlen($value)-1);}
    		  else{echo $value;}    			
    		}            
    	}	
    }
    protected function navigator($html)
    {
        ob_start();
        $this->get_fathers($this->params['id'],$this->params['l']);
        $caption = ob_get_contents();
        ob_end_clean();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        //ob_start();
//        block_::box_border($caption,'#f0f0f0');        
//        $caption = ob_get_contents();
//        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function set_meta_desc()
    {
        $res=mysql_db::get_records_by_key("select title,keywords,descr from content where id='".$this->params['id']."' and enabled>1");
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
        //block_::box_border($this->navigator($html));
        //print('<br />');
        if(!empty($this->params[id]))
        {
            $sql=" where parent='".$this->params[id]."' and enabled>1";
        }
        else
        {
            $sql=" where parent='' and enabled>1";
        }
        $resu=mysql_db::get_records_by_key("select permission,descr from content where id='".$this->params[id]."'");
        $re=mysql_db::exec_query("select id,language,icon,title,type,permission,descr from ".$this->params['page']." $sql order by ordered")or print(mysql_error()." <br />"."select * from ".$this->params['page']." $sql order by ordered<br />"); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        $i=1;
        $box=$this->template_include('boxes.html');
        block_::box_border('<em>'.$resu['descr'][0].'</em>');
        print('<table width="100%"><tr>');
        while($res=mysql_fetch_array($re))
        {
            if($res['permission']==1 || ($res['permission']==2 && $_SESSION['username']!='' && membership::content_member($res['id'])))
            {
                $img=getimagesize('upload/'.$res['icon']);
                //print_r($img);
                if($img[0]>280){$img[0]='120';}
                print('<td align="center" width="33%"><center>');
                $item='<a title="'.$res['descr'].'" href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$res['language'].'&id='.$res['id'].'&type='.$res['type'].'&page='.$this->params['page'].'&event=browse&title='.clean::clean_url($res['title']).'" style="color:#19A9E4;font-weight: bold;"><img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'].'" width="'.$img[0].'" align="top" border="0" alt="'.$res['descr'].'" title="'.$res['descr'].'" /></a>';
                echo str_replace('<title_ />','<b>'.$res['title'].'</b>',str_replace('<tag />',$item,$box));
                print('</center></td>');
                if($i%3==0){print('</tr><tr>');}
                $i++;
            }
        }
        print('</tr></table>');
        $content = ob_get_contents();
        ob_end_clean();
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class link extends ext
{
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select body,permission from content where id='".$this->params['id']."' and enabled>1");
        
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            if($res['body'][0]!='')
            {
                box::goto_($res['body'][0]);
            }
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            if($res['body'][0]!='')
            {
                box::goto_($res['body'][0]);
            }
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class ext extends content
{
    protected function navigator($html)
    {
        ob_start();
        $this->get_fathers($this->params['id'],$this->params['l']);
        $caption = ob_get_contents();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<title_ />',$caption,$html);        
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select body,permission,descr from content where id='".$this->params['id']."' and enabled>1");
        if($res['body'][0]!='')
        {
            //inclusion::get_include_file('classes/block/page/app/'.$res['body'][0].'/'.$res['body'][0].'.php');
            //print(' <em>'.$res[descr][0].'</em>');
            $_GET['type']=$res['body'][0];
            echo inclusion::construct_class_file_to_string('classes/block/page/app/'.$res['body'][0].'/'.$res['body'][0].'.php',$_GET,$_POST);
        }
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class sec extends content
{
    //protected function browse()
//    {
//        ob_start();
//        echo 'aaaaaaaaa';
//        $this->return = ob_get_contents();
//        ob_end_clean();
//    }
}
class body extends content
{    
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select body,is_control,permission,title,`type`,descr,id from content where id='".$this->params['id']."' and enabled>1");
        if($this->params['main']!==true)
        {
            $share='<br /><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END -->';
        }
        else
        {
            $share='<br /><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "
                    addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                    addthis:title="'.$res['title'][0].'"
                    addthis:description="'.$res['descr'][0].'">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END -->';
        }
        keywords_related::data_menu($this->params['l'],$res['id'][0],$keyword);
        keywords_related::data_related($this->params['l'],$res['id'][0],$related);
        block_::box_border($res['body'][0].'<hr />'.$keyword.'<br />'.$share.'<br /><br />'.$related);
        //print($res['body'][0]);
        if($res['is_control'][0]==2 && !$this->params['main'])
        {
            echo controls::view($this->params['id']);
        }        
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        $this->hits($this->params['id']);
    }
}
class image extends content
{
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        $re=mysql_db::get_records_by_key("select title,body,permission,is_control,descr,id,`type` from ".$this->params['page']." where id='".$this->params[id]."' and enabled>1")or print(mysql_error()." <br />"."select * from ".$this->params['page']." $sql order by ordered<br />"); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        if($this->params['main']===true)
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "
                    addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                    addthis:title="'.$res['title'][0].'"
                    addthis:description="'.$res['descr'][0].'">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END --></td></tr>';
        }
        else
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <!-- AddThis Button END --></td></tr>';
        }
        if(substr($re['body'][0],0,4)!='http'){$re['body'][0]='upload/'.$re['body'][0];}
        if(is_dir($re['body'][0]))
        {
            @$files=dir($re['body'][0]);
            block_::box_border('<em>'.$re['descr'][0].' '.$share.'</em>');
            print('<table width="90%" align="center">');print('<tr>');
            $i=1;
            while($file=$files->read())
            {
                if($file!='.' && $file!='..' && $file!='.htaccess' && $file!='index.php' && $file!='index.html' && $file!='index.html')
                {
                    if(is_file($re['body'][0].'/'.$file))
                    {
                        $ext=substr($file,-3);
                        if($ext=='jpg' || $ext=='png' || $ext=='gif')
                        {
                            print('<td valign="top"><a class="lightview" rel="set[myset][image]" href="'.$re['body'][0].'/'.$file.'" title="'.$re['title'][0].'"><img src="'.$re['body'][0].'/'.$file.'" title="'.$re['title'][0].'" border="0" width="200" /></a></td>');
                            if($i%3==0){print('</tr><tr><td colspan="3">&nbsp;</td></tr><tr>');}
                            $i++;
                        }
                    }                
                }            
            }
            $files->close();
            print('</tr>');print('</table>');
        }
        else
        {
            $ext=substr($re['body'][0],-3);
            if($ext=='jpg' || $ext=='png' || $ext=='gif')
            {
                block_::box_border('<a class="lightview" rel="set[yset][image]" href="'.$re['body'][0].'" title="'.$re['title'][0].'"><img src="'.$re['body'][0].'" title="'.$re['title'][0].'" border="0" width="350" align="'._ALIGN.'" />'.$re['descr'][0].'</a> '.$share);
            }
        }
        if($re['is_control'][0]==2 && !$this->params['main'])
        {
            echo controls::view($this->params['id']);
        }
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        $html=str_replace('<_align_ />',_ALIGN,$html);
        if($re['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($re['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class sound extends content
{
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        if(!empty($this->params[id]))
        {
            $sql=" where parent='".$this->params[id]."' and enabled>1";
        }
        $resu=mysql_db::get_records_by_key("select permission,descr from content where id='".$this->params['id']."'");
        $re=mysql_db::exec_query("select title,icon,body,permission,id,descr from ".$this->params['page']." $sql order by id desc")or print(mysql_error()." <br />"."select * from ".$this->params['page']." $sql order by ordered<br />"); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        print('<em>'.$resu['descr'][0].'</em>');
        print('<br /><table>');
        while($res=mysql_fetch_array($re))
        {
            if($res['permission']==1 || ($res['permission']==2 && $_SESSION['username']!='' && membership::content_member($res['id'])))
            {
                
                print('<tr>');
                print('<td height="30" valign="top">'.$res['title'].'</td>');
                print('<td width="10">&nbsp;</td>');
                if(substr($res['body'],0,4)!='http'){$res['body']='upload/'.$res['body'];}
                if(substr($res['body'],-2)=='rm' || substr($res['body'],-3)=='ram')
                {
                    ?><td valign="top" height="30">
                    <object classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="240" height="30">
                    	<param name="src" value="<?=$res['body'];?>" />
                    	<param name="width" value="560" />
                    	<param name="height" value="300" />
                    	<embed type="audio/x-pn-realaudio-plugin" src="<?=$res['body'];?>" width="240" height="30"></embed>
                    </object></td><?
                    //print('<td valign="top" height="30"><object type="application/x-shockwave-flash" data="dewplayer-vol.swf?mp3=upload/'.$res['body'].'" width="240" height="20" id="dewplayer-vol"><param name="wmode" value="transparent" /><param name="movie" value="dewplayer-vol.swf?mp3=upload/'.$res['body'].'" /></object></td>');
                }
                else
                {
                    print('<td valign="top" height="30"><object type="application/x-shockwave-flash" data="dewplayer-vol.swf?mp3='.$res['body'].'" width="240" height="20" id="dewplayer-vol"><param name="wmode" value="transparent" /><param name="movie" value="dewplayer-vol.swf?mp3='.$res['body'].'" /></object></td>');
                }                
                print('</tr>');
            }
        }
        print('</table>');
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        $html=str_replace('<_align_ />',_ALIGN,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class vedio extends content
{
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        if(!empty($this->params[id]))
        {
            $sql=" where parent='".$this->params[id]."' and enabled>1";
        }
        if($this->params['main']===true){$limit=6;}else{$limit=20;}
        if(!empty($this->params['q_sec'])){$sql.=" and (title like '%".$this->params['q_sec']."%' or descr like '%".$this->params['q_sec']."%' or _author like '%".$this->params['q_sec']."%' or body like '%".$this->params['q_sec']."%' or keywords like '%".$this->params['q_sec']."%')";}
        $resu=mysql_db::get_records_by_key("select id,permission,descr,main,enabled from content where id='".$this->params['id']."'");
        $no=mysql_db::get_rec_no(" ".$this->params['page']." $sql");
        $res=mysql_db::get_records_by_key("select id,title,language,body,icon,permission,descr from ".$this->params['page']." $sql order by id desc limit ".$this->params['rec'].",$limit")or print(mysql_error()." <br />"."select * from ".$this->params['page']." $sql order by id limit ".$this->params['rec'].",$limit"); //mysql_query("select * from ".$this->params['page']." ")or print(mysql_error());
        if($this->params['main']===true)
        {
            $fc=$resu['main'][0];
        }
        else
        {
            $fc=$resu['enabled'][0];
        }
        if($fc=='3')
        {
            $_GET['dir']='';//video
            require(''.$_SERVER["DOCUMENT_ROOT"].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/jcontent_examples/jcontent_video.php');
        }
        else
        {
            print('<span style="float: '._ALIGN_.';">');
            print('<a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'rss.php?l='.$this->params['l'].'&id='.$resu[id][0].'"><img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a>');
            form::add_input('q_sec','text','',$this->params['q_sec'],'id="q_sec"');
            form::add_input('req','button','',_SEARCH,'onclick="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$resu['id'][0].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event=0&title='.urlencode($this->params['title']).'&q_sec=\' + getElementById(\'q_sec\').value;"');
            print('</span>');
            print(' <em>'.$resu[descr][0].'</em>');
            //print('<table width="90%"><tr>');
            for($i=0;$i<count($res['id']);$i++)
            {
                if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
                {
                    $img=getimagesize('http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][$i]);
                    if($img[0]>280){$img[0]='180';}
                    //print('<td align="center"><a href="page_'.$res['language'].'_'.$res['id'].'_'.$this->params['type'].'_'.$this->params['page'].'_'.$this->params['brand'].'_view_'.clean::clean_url($res['title']).'">'.$res['title'].'<br /><img src="upload/'.$res['icon'].'" width="'.$img[0].'" align="top" border="0" /></a><br /><br /></td>');
                    ///print('<td align="center"><a href="?l='.$res['language'].'&id='.$res['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event=view&title='.clean::clean_url($res['title']).'">'.$res['title'].'<br /><img src="upload/'.$res['icon'].'" width="'.$img[0].'" align="top" border="0" /></a><br /><br /></td>');
                    block_::box_border('<table width="100%" border="0"><tr><td dir="'._DIR.'" style="vertical-align:top;"><img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res[icon][$i].'" width="'.$img[0].'" title="'.$res[title][$i].'" /></td><td style="font-size:11px;height:80px;vertical-align:top;" width="70%"><font size="2"><b>'.$res[title][$i].'</b></font><br /><em>'.$res['descr'][$i].'</em></td><td style="vertical-align:bottom;"><div class="more"><a href="?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event=view&title='.clean::clean_url($res['title'][$i]).'" style="color:#11a8e7;font-size:11px;">'._MORE.'...</a></td></tr></table>','#ffffff','100%',' valign="middle"');
                    print('<br />');
                    //if($i%3==0){print('</tr><tr>');}
                }
            }
            //print('</tr></table>');
            if(!$this->params['main'])
            {
                for($j=0;$j<$no;$j+=20)
                {
                    $pages[$j]=$j;
                }
                form::add_select('rec',$pages,$this->params['rec'],'',_PAGE,'onchange="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$this->params['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$this->params['event'].'&title='.$this->params['title'].'&rec=\' + this.value;"');
            }
        }
        $content = ob_get_contents();
        ob_end_clean();
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
    protected function view()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select body,icon,permission,is_control,descr,title,`type`,id from content where id='".$this->params['id']."' and enabled>1");
        if($this->params['main']===true)
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "
                    addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                    addthis:title="'.$res['title'][0].'"
                    addthis:description="'.$res['descr'][0].'">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END --></td></tr>';
        }
        else
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <!-- AddThis Button END --></td></tr>';
        }
        
        if(strpos($res['icon'][0],'http')===false){$res['icon'][0]='upload/'.$res['icon'][0];}//else{$res['icon'][0]=$res['icon'][0];}
        if(!empty($res['body'][0]))
        {
            $ext=substr($res['body'][0],-3);//print($ext);
            if($ext=='avi' || $ext=='wmv')
            {
                if(substr($res['body'][0],0,4)!='http'){$res['body'][0]='upload/'.$res['body'][0];}?>
                <object classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" width="560" height="315">
                	<param name="src" value="<?=$res['body'][0];?>" />
                	<param name="width" value="560" />
                	<param name="height" value="315" />
                	<embed type="application/x-mplayer2" src="<?=$res['body'][0];?>" width="560" height="315"></embed>
                </object>    
                <?
            }
            elseif($ext=='mp4')
            {
                if(substr($res['body'][0],0,4)!='http'){$res['body'][0]='upload/'.$res['body'][0];}?>
                <object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0" width="560" height="315">
                	<param name="autoplay" value="true" />
                	<param name="src" value="<?=$res['body'][0];?>" />
                	<param name="width" value="560" />
                	<param name="height" value="315" />
                	<embed type="video/quicktime" autoplay="true" src="<?=$res['body'][0];?>" width="400" height="315"></embed>
                </object>
                <?
            }
            elseif($ext=='flv')
            {
                if(substr($res['body'][0],0,4)!='http'){$res['body'][0]='upload/'.$res['body'][0];}?>
            <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="560" height="315">
        		<param name="movie" value="player.swf" />
        		<param name="allowfullscreen" value="true" />
        		<param name="allowscriptaccess" value="always" />
        		<param name="flashvars" value="file=<?=$res['body'][0];?>&image=<?=$res['icon'][0];?>" />
        		<embed
        			type="application/x-shockwave-flash"
        			id="player2"
        			name="player2"
        			src="player.swf" 
        			width="560" 
        			height="315"
        			allowscriptaccess="always" 
        			allowfullscreen="true"
        			flashvars="file=<?=$res['body'][0];?>&image=<?=$res['icon'][0];?>"/>
            </object>
        <?  }
            elseif($ext=='ram' || substr($res['body'][0],-2)=='rm' || $ext=='mp3')
            {
                if(substr($res['body'][0],0,4)!='http'){$res['body'][0]='upload/'.$res['body'][0];}?>
                <object classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="560" height="300">
            	<param name="src" value="<?=$res['body'][0];?>" />
            	<param name="width" value="560" />
            	<param name="height" value="300" />
            	<embed type="audio/x-pn-realaudio-plugin" src="<?=$res['body'][0];?>" width="400" height="300"></embed>
            </object><?
            }
            else
            {
                echo embed::embed_($res['body'][0]);
            }
            print('<br /><br />');
            keywords_related::data_menu($this->params['l'],$res['id'][0],$keyword);
            keywords_related::data_related($this->params['l'],$res['id'][0],$related);
            block_::box_border($res[descr][0].'<br />'.$keyword.'<br />'.$share.'<br /><hr />'.$related);
            if($res['is_control'][0]==2 && !$this->params['main'])
            {
                echo controls::view($this->params['id']);
            }
        }
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class selections extends books
{
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        if($this->params['main']===true){$limit=3;}else{$limit=6;}
        //if(!empty($this->params['q_sec'])){$sql=" and (a.title like '%".$this->params['q_sec']."%' or a.descr like '%".$this->params['q_sec']."%' or a.body like '%".$this->params['q_sec']."%' or a.keywords like '%".$this->params['q_sec']."%' or c.name like '%".$this->params['q_sec']."%' or b.name like '%".$this->params['q_sec']."%')";}
        $resu=mysql_db::get_records_by_key("select id,permission,descr,enabled,main,body from content where id='".$this->params['id']."' and enabled>1");
        $ids=explode(',',$resu['body'][0]);
        $no=count($ids);
        foreach($ids as $key=>$value)
        {
            $kind=mysql_db::get_records_by_key("select `type` from content where id=".$value);
            if($kind['type'][0]!='')
            {
                if($kind['type'][0]=='news')
                {
                    $arr[]=mysql_db::get_records_by_key("select a.id,a.title,a.icon,a.language,a.descr,a.permission,a._date,b.name as _author,c.name as _file,a.parent,d.`type`,d.title as title_parent
                                                          from content a
                                                          left outer join content d on a.parent=d.id
                                                          left outer join towns c on c.id=a._file
                                                          left outer join news_type b on b.id=a._author
                                                          where a.parent='".$value."' and a.enabled>1 and a.`type`='' order by a.parent,a._date desc limit ".$this->params['rec'].",$limit");
                }
                else
                {
                    $arr[]=mysql_db::get_records_by_key("select a.id,a.title,a.icon,a.language,a.descr,a.permission,a._date,a._author,a._file,a.parent,b.`type`,b.title as title_parent from content as a left outer join content as b on a.parent=b.id where a.parent =".$value." and a.enabled>1 and a.`type`='' order by a.parent,a._date desc limit ".$this->params['rec'].",$limit");
                }
                
            }
            else
            {
                $arr[]=mysql_db::get_records_by_key("select a.id,a.title,a.icon,a.language,a.descr,a.permission,a._date,a._author,a._file,b.`type`,b.title as title_parent from content as a left outer join content as b on a.parent=b.id where a.id =".$value." and a.enabled>1 and a.`type`='' order by a._date desc");
            }
        }
        //print_r($arr);
        foreach($arr as $ke=>$va)
        {
            $ress.='$arr['.$ke.'],';
        }
        $ress=substr($ress,0,-1);//print($ress."<br /><br />");
        //$res=array_merge($ress);
        eval("\$res=array_merge_recursive($ress);");
        $resu['type']=$res['type'];
        //$res=array_merge($ress);
        //print_r($res);
        //$res=mysql_db::get_records_by_key("select id,title,icon,language,descr,permission,_date,_author from content where parent in (".$resu['body'][0].") and enabled>1 and `type`='' order by parent,id desc limit ".$this->params['rec'].",$limit");
        ///switch data appearacne
//        print('<span style="float: '._ALIGN_.';">');
//        print('<a href="rss.php?l='.$this->params['l'].'&id='.$resu[id][0].'"><img src="images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a>');
//        form::add_input('q_sec','text','',$this->params['q_sec'],'id="q_sec"');
//        form::add_input('req','button','',_SEARCH,'class="button" onclick="location.href=\'?l='.$this->params['l'].'&id='.$resu['id'][0].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event=0&title='.urlencode($this->params['title']).'&q_sec=\' + getElementById(\'q_sec\').value;"');
//        print('</span>');
        $this->fc($resu,$no,$res);        
        ///
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class sections extends news
{
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        if($this->params['main']===true){$limit=3;}else{$limit=6;}
        //if(!empty($this->params['q_sec'])){$sql=" and (a.title like '%".$this->params['q_sec']."%' or a.descr like '%".$this->params['q_sec']."%' or a.body like '%".$this->params['q_sec']."%' or a.keywords like '%".$this->params['q_sec']."%' or c.name like '%".$this->params['q_sec']."%' or b.name like '%".$this->params['q_sec']."%')";}
        $resu=mysql_db::get_records_by_key("select id,permission,descr,enabled,main,body from content where id='".$this->params['id']."' and enabled>1");
        $last_chr=substr($resu['body'][0],-1);
        if($last_chr==''){$resu['body'][0]=substr($resu['body'][0],-1);}
        $res=mysql_db::get_records_by_key("select a.id,a.title,a.icon,a.language,a.descr,a.permission,a._date,a._author,a._file,a.`type` from content as a where a.id in (".$resu['body'][0].") and a.enabled>1 and a.`type`<>''");
        $no=count($res['id']);
        $this->fc($resu,$no,$res);        
        ///
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class news extends content
{
    protected function fc($resu,$no,$res)
    {
        if($this->params['main']===true)
        {
            $fc=$resu['main'][0];
        }
        else
        {
            $fc=$resu['enabled'][0];
        }
        $share='<!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style "
                addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                addthis:title="'.$res['title'][0].'"
                addthis:description="'.$res['descr'][0].'">
                <a class="addthis_button_preferred_1"></a>
                <a class="addthis_button_preferred_2"></a>
                <a class="addthis_button_compact"></a>
                <!--<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>-->
                <a class="addthis_counter addthis_bubble_style"></a>                
                </div><!-- AddThis Button END -->';
        switch($fc)
        {
            case "3":
            include($_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/featuredcontentslider/featuredcontentslider/featured_content.php');
            //echo 'ok';
            break;
            case "4":
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/featured_content_slider/featured_content.php');
            break;
            case "5":
            $_GET['v']='horizontal';//horizontal
            $_GET['dir']='next';//left
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/jcontent_examples/jcontent.php');
            break;
            case "6":
            $_GET['v']='horizontal';//horizontal
            $_GET['dir']='prev';//right
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/jcontent_examples/jcontent.php');
            break;
            case "7":
            $_GET['v']='vertical';//vertical
            $_GET['dir']='prev';//right
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/jcontent_examples/jcontent.php');
            break;
            case "8":
            $_GET['v']='vertical';//vertical
            $_GET['dir']='next';//right
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/jcontent_examples/jcontent.php');
            break;
            case "9":
            $_GET['v']='horizontal';//horizontal
            $_GET['dir']='button';//button
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/jcontent_examples/jcontent.php');
            break;
            case "10":
            $_GET['v']='vertical';//vertical
            $_GET['dir']='button';//button
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/jcontent_examples/jcontent.php');
            break;
            case "11"://animated bar and picture
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/fc_bar_pic/main.php');
            break;
            case "12"://Slider and picture
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/fc_bar_pic/home.php');
            break;
            case "16"://Accordion
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/easy_accordion/accordion.php');
            break;
            case "17"://Accordion full image
            include(''.$_SERVER['DOCUMENT_ROOT'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/featured_contents/easy_accordion/accordion_full_image.php');
            break;
            case "13"://Tow columns
            //print('<a href="rss.php?l='.$this->params['l'].'&id='.$resu[id][0].'"><img src="images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a> <em>'.$resu[descr][0].'</em>');
            print('<table width="100%" border="0"><tr>');
            $u=1;
                for($i=0;$i<count($res['id']);$i++)
                {
                    if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
                    {
                        if($res['type'][$i]!='' && $res['type'][$i]!='news' && $res['type'][$i]!='books' && $res['type'][$i]!='video' && $res['type'][$i]!='files' && $res['type'][$i]!='pro')
                        {
                            $this->params['type']=$res['type'][$i];
                            $event='browse';
                        }
                        else
                        {
                            if(mysql_db::get_rec_no("content where parent=".$res['id'][$i])>0)
                            {
                                $this->params['type']=$res['type'][$i];
                                $event='browse';
                            }
                            else
                            {
                                $event='view';
                            }
                        }
                        if(!empty($res['_file'][$i])){if(strpos($res['_file'][$i],'.')===false){$_file=' <span style="background-color:#ccc">'.$res[_file][$i].'</span> ';}else{$_file='';}}else{$_file='';}
                        if(!empty($res['icon'][$i])){$img='<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][$i].'" width="90" align="'._ALIGN.'" />';}
                        print('<td dir="'._DIR.'" style="font-family: tahoma;font-size:11px;vertical-align:top;" width="360" valign="top">'.$img.'<b>'.$res[title][$i].'</b><br /><br /><span style="background-color:#ccc">'.$res[_author][$i].'</span>'.$_file.'<br /><br /><span style="background-color:#ccc">'.$res[_date][$i].'</span><br /><br /><em>'.$res['descr'][$i].'</em> <div class="more"><a href="?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$resu['type'][0].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'" style="color:#8E0707;font-size:11px;">'._MORE.'...</a><br /><br />'.$share.'<br /><hr style="background-color: #ccc;height: 1px;" height="1" color="#cccccc" /></td><td>&nbsp;</td>');
                        if($u%2==0){print('</tr><tr>');}
                        $u++;
                    }
                }
                print('<tr></table>');
                if(!$this->params['main'])
                {
                    for($j=0;$j<$no;$j+=20)
                    {
                        $pages[$j]=$j;
                    }
                    form::add_select('rec',$pages,$this->params['rec'],'',_PAGE,'onchange="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$this->params['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$this->params['event'].'&title='.$this->params['title'].'&q_sec='.$this->params['q_sec'].'&rec=\' + this.value + \'&town='.$this->params['town'].'&news_type='.$this->params['news_type'].'&_date_from='.$this->params['_date_from'].'&_date_to='.$this->params['_date_to'].'\';"');
                }
            break;
            case "14"://boxes
            //print('<a href="rss.php?l='.$this->params['l'].'&id='.$resu[id][0].'"><img src="images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a> <em>'.$resu[descr][0].'</em>');
            $box=$this->template_include('boxes.html');
            print('<table width="100%" border="0"><tr>');
            $u=1;
                for($i=0;$i<count($res['id']);$i++)
                {
                    if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
                    {
                        if($res['type'][$i]!='' && $res['type'][$i]!='news' && $res['type'][$i]!='books' && $res['type'][$i]!='video' && $res['type'][$i]!='files' && $res['type'][$i]!='pro')
                        {
                            $this->params['type']=$res['type'][$i];
                            $event='browse';
                        }
                        else
                        {
                            if(mysql_db::get_rec_no("content where parent=".$res['id'][$i])>0)
                            {
                                $this->params['type']=$res['type'][$i];
                                $event='browse';
                            }
                            else
                            {
                                $event='view';
                            }
                        }
                        if(!empty($res['_file'][$i])){if(strpos($res['_file'][$i],'.')===false){$_file=' <span style="background-color:#ccc">'.$res[_file][$i].'</span> ';}else{$_file='';}}else{$_file='';}
                        if(!empty($res['icon'][$i])){$img='<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][$i].'" width="120" align="center" />';}
                        print('<td dir="'._DIR.'" align="center" style="font-family: tahoma;font-size:11px;vertical-align:top;text-align:center" width="390" valign="top">');
                        echo str_replace('<tag />',$img.'<span style="background-color:#ccc">'.$res[_author][$i].'</span>'.$_file.'<br /><span style="background-color:#ccc">'.$res[_date][$i].'</span><br /><br /><em>'.$res['descr'][$i].'</em> <div class="more"><a href="?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$resu['type'][0].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'" style="color:#8E0707;font-size:11px;">'._MORE.'...</a><br /><br />'.$share,str_replace('<title_ />','<b>'.$res[title][$i].'</b>',$box));
                        print('</td><td>&nbsp;</td>');
                        if($u%2==0){print('</tr><tr>');}
                        $u++;
                    }
                }
                print('<tr></table>');
                if(!$this->params['main'])
                {
                    for($j=0;$j<$no;$j+=20)
                    {
                        $pages[$j]=$j;
                    }
                    form::add_select('rec',$pages,$this->params['rec'],'',_PAGE,'onchange="location.href=\'?l='.$this->params['l'].'&id='.$this->params['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$this->params['event'].'&title='.$this->params['title'].'&q_sec='.$this->params['q_sec'].'&rec=\' + this.value + \'&town='.$this->params['town'].'&news_type='.$this->params['news_type'].'&_date_from='.$this->params['_date_from'].'&_date_to='.$this->params['_date_to'].'\';"');
                }
            break;
            case "15"://web_parts containers
            print('<em>'.$resu[descr][0].'</em>');
            $box=$this->template_include('boxes.html');
            print('<table width="100%" border="0"><tr>');
            $u=1;
                for($i=0;$i<count($res['parent']);$i++)
                {
                    if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
                    {
                        foreach($res as $key=>$value)
                        {
                            $cont[$res['parent'][$i]][$i][$key]=$value[$i];
                        }
                    }
                }
                foreach($cont as $k=>$v)
                {
                    $item='';
                    print('<td dir="'._DIR.'" style="font-family: tahoma;font-size:11px;vertical-align:top;" width="380" valign="top">');
                    foreach($v as $kk=>$vv)
                    {
                        if($vv['type']!='' && $vv['type']!='news' && $vv['type']!='books' && $vv['type']!='video' && $vv['type']!='files' && $vv['type']!='pro')
                        {
                            $this->params['type']=$vv['type'];
                            $event='browse';
                        }
                        else
                        {
                            if(mysql_db::get_rec_no("content where parent=".$vv['id'])>0)
                            {
                                $this->params['type']=$vv['type'];
                                $event='browse';
                            }
                            else
                            {
                                $event='view';
                            }
                        }
                        $item.='- <a title="'.clean::burn($vv[descr]).'" href="?l='.$vv['language'].'&id='.$vv['id'].'&type='.$vv['type'].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($vv['title']).'">'.clean::burn($vv[title]).'</a><br />';
                    }
                    echo str_replace('<title_ />','<b>'.$v[$kk][title_parent].'</b><a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'rss.php?l='.$vv['language'].'&id='.$vv[id].'"><img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a>',str_replace('<tag />',$item,$box));
                    print('</td><td>&nbsp;</td>');
                    if($u%2==0){print('</tr><tr>');}
                    $u++;
                }
                print('<tr></table>');
                if(!$this->params['main'])
                {
                    for($j=0;$j<$no;$j+=20)
                    {
                        $pages[$j]=$j;
                    }
                    form::add_select('rec',$pages,$this->params['rec'],'',_PAGE,'onchange="location.href=\'?l='.$this->params['l'].'&id='.$this->params['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$this->params['event'].'&title='.$this->params['title'].'&q_sec='.$this->params['q_sec'].'&rec=\' + this.value + \'&town='.$this->params['town'].'&news_type='.$this->params['news_type'].'&_date_from='.$this->params['_date_from'].'&_date_to='.$this->params['_date_to'].'\';"');
                }
            break;
            case "2"://records view
            default:
                
                print(' <em>'.$resu[descr][0].'</em>');
                for($i=0;$i<count($res['id']);$i++)
                {
                    if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
                    {
                        if($res['type'][$i]!='' && $res['type'][$i]!='news' && $res['type'][$i]!='books' && $res['type'][$i]!='video' && $res['type'][$i]!='files' && $res['type'][$i]!='pro')
                        {
                            $this->params['type']=$res['type'][$i];
                            $event='browse';
                        }
                        else
                        {
                            if(mysql_db::get_rec_no("content where parent=".$res['id'][$i])>0)
                            {
                                $this->params['type']=$res['type'][$i];
                                $event='browse';
                            }
                            else
                            {
                                $event='view';
                            }
                        }
                        if(!empty($res['icon'][$i])){$img='<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][$i].'" width="100" align="'._ALIGN.'" />';}
                        //print('<div id="news"><img src="upload/'.$res['icon'][$i].'" width="120" border="0" title="'.$res['title'][$i].'" align="center" />'.$res['title'][$i].'<span id="more"><a href="?l='.$res['language'][$i].'&page='.$this->params['page'].'&type='.$this->params['type'].'&id='.$res['id'][$i].'&brand='.$this->params['brand'].'&event=view">'._MORE.'...</a></span></div><br />');
                        //block_::box_border('<div class="news" style="font-size:11px;height:80px;vertical-align:middle;" dir="'._DIR.'"><img src="upload/'.$res['icon'][$i].'" width="120" border="0" title="'.$res['title'][$i].'" align="'._ALIGN.'" valign="middle" /> &nbsp; &nbsp;'.$res['descr'][$i].'<div class="more"><a href="?l='.$res['language'][$i].'&page='.$this->params['page'].'&type=body&id='.$res['id'][$i].'&brand='.$this->params['brand'].'" style="color:#11a8e7;font-size:11px;">'._MORE.'...</a></div></div>','#ffffff','100%',' valign="middle"');
                        //block_::box_border('<table width="100%"><tr><td dir="'._DIR.'" height="80"><img src="upload/'.$res['icon'][$i].'" width="120" border="0" title="'.$res['title'][$i].'" align="'._ALIGN.'" valign="middle" /></td><td style="font-size:11px;height:80px;vertical-align:middle;" width="70%"> &nbsp; &nbsp;'.$res['descr'][$i].'</td><td><div class="more"><a href="page_'.$res['language'][$i].'_'.$res['id'][$i].'_news_'.$this->params['page'].'_'.$this->params['brand'].'_view_'.clean::clean_url($res['title'][$i]).'" style="color:#11a8e7;font-size:11px;">'._MORE.'...</a></td></tr></table>','#ffffff','100%',' valign="middle"');
                        if(!empty($res['_file'][$i])){if(strpos($res['_file'][$i],'.')===false){$_file=' <span style="background-color:#ccc">'.$res[_file][$i].'</span> ';}else{$_file='';}}else{$_file='';}
                        block_::box_border('<table width="100%" border="0">
                        <tr style="font-size:14px;font-family:tahoma;"><td dir="'._DIR.'"><b>'.$res[title][$i].'</b></td><td dir="'._DIR.'"><span style="background-color:#ccc">'.$res[_author][$i].'</span>'.$_file.'</td><td dir="'._DIR.'"><span style="background-color:#ccc">'.$res[_date][$i].'</span></td></tr>
                        <tr><td style="font-size:11px;font-family:tahoma;vertical-align:top;" colspan="3">'.$img.'<br /><em>'.$res['descr'][$i].'</em> <div class="more"><a href="?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$resu['type'][0].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'" style="color:#8E0707;font-size:11px;">'._MORE.'...</a><br /><br />'.$share.'</td></tr>
                        </table>','#ffffff','100%',' valign="middle"');
                        //print('<br />');
                    }
                }
                if(!$this->params['main'])
                {
                    for($j=0;$j<$no;$j+=20)
                    {
                        $pages[$j]=$j;
                    }
                    form::add_select('rec',$pages,$this->params['rec'],'',_PAGE,'onchange="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$this->params['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$this->params['event'].'&title='.$this->params['title'].'&q_sec='.$this->params['q_sec'].'&rec=\' + this.value + \'&town='.$this->params['town'].'&news_type='.$this->params['news_type'].'&_date_from='.$this->params['_date_from'].'&_date_to='.$this->params['_date_to'].'\';"');
                }
        }
        $_GET['v']='';//horizontal
        $_GET['dir']='';//left
    }
    protected function preview()
    {
        $html='<content_tag />';
        ob_start();
        if($this->params['main']===true){$limit=6;}else{$limit=20;}
        if(!empty($this->params['q_sec'])){$sql=" and (a.title like '%".$this->params['q_sec']."%' or a.descr like '%".$this->params['q_sec']."%' or a.body like '%".$this->params['q_sec']."%' or a.keywords like '%".$this->params['q_sec']."%')";}
        if(!empty($this->params['town'])){$sql.=" and a._file='".$this->params['town']."'";}
        if(!empty($this->params['news_type'])){$sql.=" and a._author='".$this->params['news_type']."'";}
        if(!empty($this->params['_date_from']) && !empty($this->params['_date_to'])){$sql.=" and a._date between '".$this->params['_date_from']."' and '".$this->params['_date_to']."'";}
        $resu=mysql_db::get_records_by_key("select id,permission,descr,enabled,main,type from content where id='".$this->params['id']."'");
        $no=mysql_db::get_rec_no(" content a where a.parent='".$this->params['id']."' and a.enabled>1 $sql");
        $res=mysql_db::get_records_by_key("select a.id,a.title,a.icon,a.language,a.descr,a.permission,a._date,b.name as _author,c.name as _file
                                                  from content a
                                                  left outer join towns c on c.id=a._file
                                                  left outer join news_type b on b.id=a._author
                                                  where a.parent='".$this->params['id']."' and a.enabled>1 $sql order by a._date desc limit ".$this->params['rec'].",$limit");
        $this->fc($resu,$no,$res);
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        print('<link rel="stylesheet" type="text/css" media="all" href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" /><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/calendar.js"></script><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/lang/calendar-en.js"></script><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/calendar-setup.js"></script>');
        if($this->params['main']===true){$limit=6;}else{$limit=20;}
        if(!empty($this->params['q_sec'])){$sql=" and (a.title like '%".$this->params['q_sec']."%' or a.descr like '%".$this->params['q_sec']."%' or a.body like '%".$this->params['q_sec']."%' or a.keywords like '%".$this->params['q_sec']."%')";}
        if(!empty($this->params['town'])){$sql.=" and a._file='".$this->params['town']."'";}
        if(!empty($this->params['news_type'])){$sql.=" and a._author='".$this->params['news_type']."'";}
        if(!empty($this->params['_date_from']) && !empty($this->params['_date_to'])){$sql.=" and a._date between '".$this->params['_date_from']."' and '".$this->params['_date_to']."'";}
        $resu=mysql_db::get_records_by_key("select id,permission,descr,enabled,main,type from content where id='".$this->params['id']."'");
        $no=mysql_db::get_rec_no(" content a where a.parent='".$this->params['id']."' and a.enabled>1 $sql");
        $res=mysql_db::get_records_by_key("select a.id,a.title,a.icon,a.language,a.descr,a.permission,a._date,b.name as _author,c.name as _file
                                                  from content a
                                                  left outer join towns c on c.id=a._file
                                                  left outer join news_type b on b.id=a._author
                                                  where a.parent='".$this->params['id']."' and a.enabled>1 $sql order by a._date desc limit ".$this->params['rec'].",$limit");
        ///switch data appearacne
        //$resu['type']=$res['type'];
        print('<span style="float: '._ALIGN_.';">');
        print('<a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'rss.php?l='.$this->params['l'].'&id='.$resu[id][0].'"><img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a>');
        form::add_select('town',array(''=>'')+$this->get_towns(),$this->params['town'],'',_QUARTER,'id="town" title="الحي" style="width:70px"');
        form::add_select('news_type',array(''=>'')+$this->get_news_type(),$this->params['news_type'],'',_NEWS_TYPE,'id="news_type" title="نوع الخبر" style="width:70px"');
        form::add_input('_date_from','text',_FROM.' '._DATE,$this->params[_date_from],'id="_date_from" dir="ltr" size="6"');print('<script type="text/javascript">Calendar.setup({inputField:"_date_from",button:"_date_form",align:"Br"});</script>');
        form::add_input('_date_to','text',_TO.' '._DATE,$this->params[_date_to],'id="_date_to" dir="ltr" size="6" title="إلى"');print('<script type="text/javascript">Calendar.setup({inputField:"_date_to",button:"_date_to",align:"Br"});</script>');
        form::add_input('q_sec','text',_SEARCH.' '._WORD,$this->params['q_sec'],'id="q_sec" size="10"');
        if(empty($this->params['d']))
        {
            form::add_input('req','button','',_SEARCH,'class="button" onclick="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$resu['id'][0].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event=0&title='.urlencode($this->params['title']).'&q_sec=\' + getElementById(\'q_sec\').value + \'&town=\' + getElementById(\'town\').value + \'&news_type=\' + getElementById(\'news_type\').value + \'&_date_from=\' + getElementById(\'_date_from\').value + \'&_date_to=\' + getElementById(\'_date_to\').value;"');
        }
        else
        {
            form::add_input('req','button','',_SEARCH,'class="button" onclick="_(\'#news_id\').html(\'<div style=width:30%;margin-right:auto;margin-left:auto;text-align:center><img src=http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/ajax_loader_gray_64.gif border=0/></div>\');_.get(\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/page/ajax.php?d=\'+new Date().getTime()+\'&l='.$this->params['l'].'&id='.$resu['id'][0].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event=preview&title='.urlencode($this->params['title']).'&q_sec=\' + getElementById(\'q_sec\').value + \'&town=\' + getElementById(\'town\').value + \'&news_type=\' + getElementById(\'news_type\').value + \'&_date_from=\' + getElementById(\'_date_from\').value + \'&_date_to=\' + getElementById(\'_date_to\').value,function(data){_(\'#news_id\').html(data);});"');
        }        
        print('</span><br /><br /><br /><div id="news_id">');
        $this->fc($resu,$no,$res);
        print('</div>');        
        ///
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
    protected function view()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select a.body,a.permission,a.is_control,a.title,a._date,a.keywords,b.name as _author,c.name as _file,a.descr,a.icon,a.`type`,a.id 
                                            from content a 
                                            left outer join news_type b on b.id=a._author 
                                            left outer join towns c on c.id=a._file
                                            where a.id='".$this->params['id']."' and a.enabled>1");
        if($this->params['main']===true)
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "
                    addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                    addthis:title="'.$res['title'][0].'"
                    addthis:description="'.$res['descr'][0].'">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END --></td></tr>';
        }
        else
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <!-- AddThis Button END --></td></tr>';
        }
        keywords_related::data_menu($this->params['l'],$res['id'][0],$keyword);
        keywords_related::data_related($this->params['l'],$res['id'][0],$related);
        if(!empty($res['icon'][0])){$img='<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][0].'" width="120" align="'._ALIGN_.'" />';}
        block_::box_border('<table width="100%" border="0">
                <tr style="font-size:14px;font-family:tahoma;"><td dir="'._DIR.'"><b>'.$res[title][0].'</b></td><td dir="'._DIR.'">'.$res[_author][0].'</td><td dir="'._DIR.'">'.$res[_file][0].'</td><td dir="'._DIR.'">'.$res[_date][0].'</td></tr>
                <tr><td style="font-size:11px;font-family:tahoma;vertical-align:top;" colspan="4"> &nbsp; &nbsp;<em>'.$res['descr'][0].'</em>'.$img.'</td></tr>
                <tr><td style="vertical-align:top;" colspan="4"> &nbsp; &nbsp;'.embed::embed_news($res['body'][0]).' </td></tr>
                <tr><td style="vertical-align:top;" colspan="4">&nbsp;</td></tr>
                <tr><td style="font-size:11px;font-family:tahoma;vertical-align:top;" colspan="3">'.$keyword.'</td><td><a href="" target="_blank"></a></td></tr>
                '.$share.'
                </table><br /><hr />'.$related);
        //print($res['body'][0]);
        if($res['is_control'][0]==2 && !$this->params['main'])
        {
            echo controls::view($this->params['id']);
        }        
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='')
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class books extends news
{   
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        print('<link rel="stylesheet" type="text/css" media="all" href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" /><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/calendar.js"></script><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/lang/calendar-en.js"></script><script type="text/javascript" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'js/jscalendar/calendar-setup.js"></script>');
        if($this->params['main']===true){$limit=6;}else{$limit=20;}
        if(!empty($this->params['q_sec'])){$sql=" and (title like '%".$this->params['q_sec']."%' or descr like '%".$this->params['q_sec']."%' or _author like '%".$this->params['q_sec']."%' or body like '%".$this->params['q_sec']."%' or keywords like '%".$this->params['q_sec']."%')";}
        if(!empty($this->params['_date_from']) && !empty($this->params['_date_to'])){$sql.=" and _date between '".$this->params['_date_from']."' and '".$this->params['_date_to']."'";}
        $resu=mysql_db::get_records_by_key("select id,permission,descr,enabled,main,type from content where id='".$this->params['id']."'");
        $no=mysql_db::get_rec_no(" content where parent='".$this->params['id']."' and enabled>1");
        $res=mysql_db::get_records_by_key("select id,title,icon,language,descr,permission,_date,_author from content where parent='".$this->params['id']."' and enabled>1 $sql order by _date desc limit ".$this->params['rec'].",$limit");
        ///switch data appearacne
        //$resu['type']=$res['type'];
        print('<span style="float: '._ALIGN_.';">');
        print('<a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'rss.php?l='.$this->params['l'].'&id='.$resu[id][0].'"><img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a>');
        if($this->params['main']===true){}else
        {
            form::add_input('_date_from','text',_FROM.' '._DATE,$this->params[_date_from],'id="_date_from" dir="ltr" size="6"');print('<script type="text/javascript">Calendar.setup({inputField:"_date_from",button:"_date_from",align:"Br"});</script>');
            form::add_input('_date_to','text',_TO.' '._DATE,$this->params[_date_to],'id="_date_to" dir="ltr" size="6" title="'._TO.'"');print('<script type="text/javascript">Calendar.setup({inputField:"_date_to",button:"_date_to",align:"Br"});</script>');
            form::add_input('q_sec','text',_SEARCH.' '._WORD,$this->params['q_sec'],'id="q_sec" size="10"');
            form::add_input('req','button','',_SEARCH,'class="button" onclick="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$resu['id'][0].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event=0&title='.urlencode($this->params['title']).'&q_sec=\' + getElementById(\'q_sec\').value + \'&_date_from=\' + getElementById(\'_date_from\').value + \'&_date_to=\' + getElementById(\'_date_to\').value;"');
        }
        print('</span><br /><br /><br />');
        $this->fc($resu,$no,$res);        
        ///
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='' && membership::content_member($this->params['id']))
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
    protected function view()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select body,permission,is_control,keywords,_file,title,_author,_date,`type`,id from content where id='".$this->params['id']."' and enabled>1");
        if($this->params['main']===true)
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "
                    addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                    addthis:title="'.$res['title'][0].'"
                    addthis:description="'.$res['descr'][0].'">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END --></td></tr>';
        }
        else
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END --></td></tr>';
        }
        keywords_related::data_menu($this->params['l'],$res['id'][0],$keyword);
        keywords_related::data_related($this->params['l'],$res['id'][0],$related);
        if(!empty($res['_file'][0]))
        {
            if(substr($res['_file'][0],-4)=='.pdf')
            {
                $viewer='<iframe src="http://docs.google.com/viewer?url='.urlencode('http://'.$_SERVER['SERVER_NAME'].'/upload/'.$res['_file'][0]).'&embedded=true" width="700" height="900" style="border: none;"></iframe>';
                $dwnld_file='';
            }
            else
            {
                $dwnld_file='<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/images/icons/download_file.png" width="100" border="0" alt="تنزيل الملف" title="تنزيل الملف" />';
                $viewer='';
            }
        }
        else
        {
            $dwnld_file='';
            $viewer='';
        }
        block_::box_border('<table width="100%" border="0">
                <tr style="font-size:14px;font-family:tahoma;"><td dir="'._DIR.'"><b>'.$res[title][0].'</b></td><td dir="'._DIR.'">'.$res[_author][0].'</td><td dir="'._DIR.'">'.$res[_date][0].'</td></tr>
                <tr><td style="font-size:11px;font-family:tahoma;vertical-align:top;" colspan="3"> &nbsp; &nbsp;<em>'.$res['descr'][0].'</em> </td></tr>
                <tr><td style="vertical-align:top;" colspan="3"> &nbsp; &nbsp;'.embed::embed_rep($res['body'][0]).' </td></tr>
                <tr><td style="vertical-align:top;" colspan="3">'.$viewer.'</td></tr>
                <tr><td style="font-size:11px;font-family:tahoma;vertical-align:top;" colspan="2">'.$keyword.'</td><td><a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res[_file][0].'" target="_blank">'.$dwnld_file.'</a></td></tr>
                '.$share.'
                </table><br /><hr />'.$related);
        //print($res['body'][0]);
        if($res['is_control'][0]==2 && !$this->params['main'])
        {
            echo controls::view($this->params['id']);
        }        
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='')
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class files extends content
{   
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $resu=mysql_db::get_records_by_key("select permission from content where id='".$this->params['id']."'");
        $no=mysql_db::get_rec_no(" content where parent='".$this->params['id']."' and enabled>1");
        $res=mysql_db::get_records_by_key("select id,title,language,descr,body,permission from content where parent='".$this->params['id']."' and enabled>1 order by id desc limit ".$this->params['rec'].",20");
        for($i=0;$i<count($res['id']);$i++)
        {            
            //print('<div id="news"><img src="upload/'.$res['icon'][$i].'" width="120" border="0" title="'.$res['title'][$i].'" align="center" />'.$res['title'][$i].'<span id="more"><a href="?l='.$res['language'][$i].'&page='.$this->params['page'].'&type='.$this->params['type'].'&id='.$res['id'][$i].'&brand='.$this->params['brand'].'&event=view">'._MORE.'...</a></span></div><br />');
            print('<table><tr><td style="font-size:11px;" dir="'._DIR.'"></td><td>&nbsp;</td><td><a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['body'][$i].'" target="_blank"><span style="margin:20px;color:#0072bc;font-size:14px;font-family:tahoma;font-weight: bold;">'.$res['title'][$i].'</span></a></td></tr></table>');
            print('<br />');
        }
        if(!$this->params['main'])
        {            
            for($j=0;$j<$no;$j+=20)
            {
                $pages[$j]=$j;
            }
            form::add_select('rec',$pages,$this->params['rec'],'',_PAGE,'onchange="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$this->params['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$this->params['event'].'&title='.$this->params['title'].'&rec=\' + this.value;"');
        }
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='')
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
    protected function view()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select body,permission,id,`type`,descr from content where id='".$this->params['id']."' and enabled>1");
        //block_::box_border($res['body'][0]);
        if($this->params['main']===true)
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "
                    addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                    addthis:title="'.$res['title'][0].'"
                    addthis:description="'.$res['descr'][0].'">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END --></td></tr>';
        }
        else
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <!-- AddThis Button END --></td></tr>';
        }
        keywords_related::data_menu($this->params['l'],$res['id'][0],$keyword);
        keywords_related::data_related($this->params['l'],$res['id'][0],$related);
        print($res['body'][0].'<br />'.$keyword.'<br />'.$share.'<br /><hr />'.$related);
        if($res['is_control'][0]==2)
        {
            echo controls::view($this->params['id']);
        }        
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='')
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class pro extends content
{   
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $resu=mysql_db::get_records_by_key("select permission from content where id='".$this->params['id']."'");
        $no=mysql_db::get_rec_no(" content where parent='".$this->params['id']."' and enabled>1");
        $res=mysql_db::get_records_by_key("select id,title,language,descr,body,icon,permission from content where parent='".$this->params['id']."' and enabled>1 order by id desc limit ".$this->params['rec'].",20");
        for($i=0;$i<count($res['id']);$i++)
        {            
            //print('<div id="news"><a href="page_'.$res['language'][$i].'_'.$res['id'][$i].'_pro_'.$this->params['page'].'_'.$this->params['brand'].'_view_'.clean::clean_url($res['title'][$i]).'"><img src="upload/'.$res['icon'][$i].'" border="0" title="'.$res['title'][$i].'" align="center" width="725" /></a></div>');
            print('<div id="news"><a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type=pro&page='.$this->params['page'].'&event=view&title='.clean::clean_url($res['title'][$i]).'"><img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][$i].'" border="0" title="'.$res['title'][$i].'" align="center" width="225" /></a></div>');
            //block_::box_border('<table><tr><td style="font-size:11px;" dir="'._DIR.'"></td><td>&nbsp;</td><td><span style="margin:20px;color:#0072bc;font-size:14px;font-family:tahoma;font-weight: bold;">'.$res['title'][$i].'</span><br />'.$res['body'][$i].'</td></tr></table>');
            print('<br />');
        }
        if(!$this->params['main'])
        {
            for($j=0;$j<$no;$j+=20)
            {
                $pages[$j]=$j;
            }
            form::add_select('rec',$pages,$this->params['rec'],'',_PAGE,'onchange="location.href=\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$this->params['l'].'&id='.$this->params['id'].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$this->params['event'].'&title='.$this->params['title'].'&rec=\' + this.value;"');
        }
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($resu['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($resu['permission'][0]==2 && $_SESSION['username']!='')
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
    protected function view()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        $res=mysql_db::get_records_by_key("select * from content where id='".$this->params['id']."' and enabled>1");
        if($this->params['main']===true)
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style "
                    addthis:url="http:'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(basename(__FILE__))).'/?l='.$this->params['l'].'&id='.$res['id'][0].'&type='.$res['type'][0].'&page='.$this->params['page'][0].'&event=0&title='.clean::clean_url($res[title][0]).'"
                    addthis:title="'.$res['title'][0].'"
                    addthis:description="'.$res['descr'][0].'">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div><!-- AddThis Button END --></td></tr>';
        }
        else
        {
            $share='<tr><td colspan="3"><!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                    </div>
                    <!-- AddThis Button END --></td></tr>';
        }
        
        //block_::box_border($res['body'][0]);
        keywords_related::data_menu($this->params['l'],$res['id'][0],$keyword);
        keywords_related::data_related($this->params['l'],$res['id'][0],$related);
        print($res['body'][0].'<br />'.$keyword.'<br />'.$share.'<br /><hr />'.$related);
        if($res['is_control'][0]==2 && !$this->params['main'])
        {
            echo controls::view($this->params['id']);
        }        
        $content = ob_get_contents();
        ob_end_clean();
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='')
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
        $this->hits($this->params['id']);
    }
}
class main extends body
{
    
    protected function browse()
    {
        if(!empty($this->params['brand'])){$sql=" and brand='".$this->params['brand']."'";}else{$sql="";}
        $res=mysql_db::get_records_by_key("select id,permission from content where `type`='body' and main>1 and enabled>1 and language='".$this->params['l']."' $sql limit 1");
        $this->params['id']=$res['id'][0];
        parent::browse();
    }    
}
class main_many extends content
{
    protected function navigator($html)
    {        
        ob_start();
        //$this->get_fathers($this->params['id'],$this->params['l']);
        $caption = ob_get_contents();
        //$caption='<img src="images/flower.png" align="'._ALIGN.'" /> &nbsp;'.$caption;
        ob_end_clean();
        return str_replace('<div id="content_title"><div class="art-blockheader"><div class="l"></div><div class="r"></div><h3 class="t"><title_ /></h3></div></div>',$caption,$html);        
    }
    protected function browse()
    {
        $this->set_meta_desc();
        $html=$this->template_include();
        $html=$this->navigator($html);
        ob_start();
        //print('<br />');
        //if(!empty($this->params['brand'])){$sql=" and brand='".$this->params['brand']."'";}else{$sql="";}
        $res=mysql_db::get_records_by_key("select id,title,icon,language,`type`,body,permission,descr,parent from content where main>1 and enabled>1 and language='".$this->params['l']."' order by ordered,id");
        for($i=0;$i<count($res['id']);$i++)
        {
            //if($res['type'][$i]=='body')
//            {
//                block_::box_border('<div style="font-size:11px;" dir="'._DIR.'">'.$res['body'][$i].'</div>');
//                print('<br />');
//            }
//            elseif($res['type'][$i]=='image')
//            {//public_html/?l=1&id=333&type=image&page=content&event=0&title=rose
                $arr[$i]['l']=$this->params['l'];
                $arr[$i]['id']=$res['id'][$i];
                $arr[$i]['page']=$this->params['page'];
                if($res['type'][$i]=='')
                {
                    $arr[$i]['event']='view';
                    $class=mysql_db::get_records_by_key("select `type` from content where id='".$res['parent'][$i]."'");
                    $res['type'][$i]=$class['type'][0];
                }
                $arr[$i]['title']=$res['title'][$i];
                $arr[$i]['main']=true;
                $arr[$i]['type']=$res['type'][$i];
                New $res['type'][$i]($arr[$i]);
                //$res['type'][$i]='';
            //}
//            else
//            {
//                //block_::box_border('<div class="news" style="font-size:11px;" dir="'._DIR.'"><img src="upload/'.$res['icon'][$i].'" width="120" border="0" title="'.$res['title'][$i].'" align="center" />'.$res['title'][$i].'<div class="more"><a href="page_'.$res['language'][$i].'_'.$res['id'][$i].'_body_'.$this->params['page'].'_'.$this->params['brand'].'_0_'._MORE.'" style="color:#11a8e7;font-size:11px;">'._MORE.'...</a></div></div>');
//                block_::box_border('<div class="news" style="font-size:11px;" dir="'._DIR.'"><img src="upload/'.$res['icon'][$i].'" width="120" border="0" title="'.$res['descr'][$i].'" align="'._ALIGN.'" /><font size="3">'.$res['title'][$i].'</font><br />'.$res['descr'][$i].'<div class="more"><a href="?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type=body&page='.$this->params['page'].'&event=0&title='._MORE.'" style="color:#11a8e7;font-size:11px;">'._MORE.'...</a></div></div>');
//                print('<br />');
//            }
            //print('<div id="news"><img src="upload/'.$res['icon'][$i].'" width="120" border="0" title="'.$res['title'][$i].'" align="center" />'.$res['title'][$i].'<span id="more"><a href="?l='.$res['language'][$i].'&page='.$this->params['page'].'&type='.$this->params['type'].'&id='.$res['id'][$i].'&brand='.$this->params['brand'].'&event=view">'._MORE.'...</a></span></div><br />');
            //print('<hr />');            
        }
        $content = ob_get_contents();
        ob_end_clean();
        $html=str_replace('<align_ />',_ALIGN_,$html);
        if($res['permission'][0]==1)
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        elseif($res['permission'][0]==2 && $_SESSION['username']!='')
        {
            echo str_replace('<content_tag />',$content,$html);
        }
        else
        {
            echo str_replace('<content_tag />','No permission',$html);
        }
        //echo str_replace('<content_tag />',$content,$html);
    }    
}?>