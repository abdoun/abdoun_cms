<?php

if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}

/**

 * @author 

 * @copyright  2010

 * @class controls

 */

class controls 

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

            $this->browse($get['id']);

        }

    }

    function template_include()

    {

        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');

    }

    function get_url()

    {

        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).'template/');

        $arr=explode('classes',$path);

        return 'classes/'.$arr[1];

    }

    function view($id)

    {

        ?><script type="text/javascript">

        	function validate_(frm)

            {

            	if(frm.name.value=="")

            	{

                    document.getElementById('controls_result').innerHTML='<span><?=addslashes(_NO_NAME);?></span>';

            		frm.name.focus();

            		return false;

            	}

            	else if(frm.title.value=="")

            	{

                    document.getElementById('controls_result').innerHTML='<span><?=addslashes(_ERROR.' '._ADDRESS);?></span>';

            		frm.title.focus();

            		return false;

            	}

                else if(frm.notes.value=="")

            	{

                    document.getElementById('controls_result').innerHTML='<span><?=addslashes(_ERROR.' '._COMMENT);?></span>';

            		frm.notes.focus();

            		return false;

            	}

            	else if(frm.code.value=="")

            	{

            	    document.getElementById('controls_result').innerHTML='<span><?=_ERROR;?> <?=_CODE;?></span>';

            		frm.code.focus();

            		return false;

            	}

                else

                {

                    //alert('ok');

                    _("#controls_result").html("<center><img src='http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>images/loading.gif' border='0'/></center>");

                    _.post("<?='http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/controls/ajax.php?l=<?=$_GET['l'];?>&page=controls&type=controls&event=act&",

                     _("#controls_form").serialize(),

                    function(data){

                        _('#controls_result').html(data);

                    }, "html");

                    

                    //post('controls_form','controls_result');

                    //frm.name.value='';

                    //frm.title.value='';

                    //frm.notes.value='';

                    //frm.code.value='';

                    //document.getElementById('form_controls').innerHTML='';

                    return false;

                }

                return false;

            }

        </script><?php

       $html=self::template_include();

       $html=str_replace('<base_url_tag />',self::get_url(),$html);

       $html=str_replace('<dir_tag />',_DIR,$html);

       $html=str_replace('<directory_tag />','http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)),$html);

       $html=str_replace('<align_ />',_ALIGN_,$html);

       $html=str_replace('<_align_ />',_ALIGN,$html);

       $html=str_replace('<title_ />','&nbsp;',$html);

       $html=str_replace('<lang_tag />',$_GET['l'],$html);

       $html=str_replace('<rand_tag />',rand(5421,987654321),$html);

       $html=str_replace('<id_tag />',$id,$html);

       //$html=str_replace('<brand_tag />',$_GET['brand'],$html);

       $res=mysql_db::get_records_by_key("select hits,rating_no,rating_score from content where id=$id");

       //$content='<div id="counter">'._HITS.': '.$res['hits'][0].'</div>';

       $html=str_replace('<score_tag />',round($res['rating_score'][0]/$res['rating_no'][0]),$html);

       $content.='<div id="rating"><div id="example-2"></div><span id="example-rating-2"></span></div>';

       $content.='<div class="spacing"></div>';

       $content.='<div class="form_control">'.self::form($id).'</div>';

       $content.='<div id="comments">';

       $resu=mysql_db::get_records_by_key("select name,title,notes,admin_note from comments where enabled=2 and id_content=".$id." order by ddate desc");

        if(count($resu['name'])>0)

        {

            $content.='<div class="spacing"></div>';

            if(count($resu['name'])<4)

            {

                $no=count($resu['name']);

            }

            else

            {

                $no=3;

            }

            for($i=0;$i<$no;$i++)

            {

                $content.='<div class="title">'.$resu['title'][$i].'</div>';

                $content.='<div class="name">'.$resu['name'][$i].'</div>';

                $content.='<div class="notes">'.$resu['notes'][$i].'</div>';

                $content.='<div class="admin_note">'.$resu['admin_note'][$i].'</div>';

                $content.='<div class="spacing"></div>';

            }

            if(count($resu['name'])>3)

            {

                $content.='<div><a href="javascript:get(\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/controls/ajax.php?l='.$_GET['l'].'&page=controls&type=controls&event=browse&id='.$id.'&\',\'comments\');"><b>'._VIEW.' '._COMMENTS.'</b></a></div>';

            }

        }       

       $content.='</div>';

       $html=str_replace('<tag />',$content,$html);

       return $html;

    }

    function form($id)

    {

       $content='<div id="controls_result"></div>';

       //$content.='<div id="form_controls"><form action="classes/block/controls/ajax.php?l='.$_GET['l'].'&page=controls&type=controls&event=act&" method="post" name="controls_form" id="controls_form" onsubmit="return validate_(this);">';

       $content.='<div id="form_controls"><form name="controls_form" id="controls_form" onsubmit="return validate_(this);">';

       $content.='<table>';

       $content.='<tr><td>'._NAME.':<font color="#ff0000" face="tahoma">*</font></td><td><input type="text" name="name" title="'._NAME.'"  onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td></tr>';

       $content.='<tr><td>'._ADDRESS.':<font color="#ff0000" face="tahoma">*</font></td><td><input type="text" name="title" title="'._ADDRESS.'" onblur="this.value=trim(this.value);" onkeypress="this.value=trim_number(this.value);" onkeyup="this.value=trim_number(this.value);" /></td></tr>';

       $content.='<tr><td>'._COMMENT.':<font color="#ff0000" face="tahoma">*</font></td><td><textarea cols="40" rows="5" name="notes" title="'._COMMENT.'"></textarea></td></tr>';

       $content.='<tr>';

       $content.='<td>'._CODE.':<font color="#ff0000" face="tahoma">*</font></td>';

		$content.='<td><input align="middle" name="code" maxlength="8" size="20" type="text" onkeyup="this.value=this.value.toUpperCase();this.value=trim(this.value);" /></td>';

        $content.='</tr>';

        $content.='<tr>';

        $content.='<td width="100"><font face="Verdana" size="2" color="#000"><a href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'image.php" target="ifr">'._CHANGE.' '._CODE.'</a></font></td>';

		$content.='<td><iframe name="ifr" id="ifr" src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'image.php" width="90" height="65" scrolling="no" frameborder="0" marginwidth="0"></iframe></td>';

   		$content.='</tr>';

        $content.='<tr>';

        $content.='<td colspan="2" align="center">';

        //$content.='<input type="hidden" value="'.$_GET['brand'].'" name="brand" />';

        $content.='<input type="hidden" value="'.$id.'" name="id_content" />';

        $content.='<input type="hidden" value="'.$_SERVER["REQUEST_TIME"].'" name="ddate" />';

        $content.='<input type="hidden" value="'.$_SERVER["REMOTE_ADDR"].'" name="ip" />';

        $content.='<input type="submit" name="submitt" title="'._ADD.'" value="'._ADD.'" /></td></tr>';

       $content.='</table>';

       $content.='</form></div>';

       return $content;

    }

    protected function rate()

    {

        //print_r($this->get);

        $res=mysql_db::get_records_by_key("select rating_no,rating_score from content where id=".$this->get[id]);

        $score=$res['rating_score'][0]+$this->get['score'];

        $score_no=$res['rating_no'][0]+1;

        if(mysql_db::add_edit_rec('content',array('rating_no'=>$score_no,'rating_score'=>$score),$this->get[id]))

        {

            print(_THANK_YOU);

        }

        else

        {

            print(_ERROR);

        }

    }

    protected function act()

    {

        //print_r($this->post);

        //print('<div id="controls_result">');

        $this->case=true;

        if(empty($this->post['code']) || md5($this->post['code'])!=md5($_SESSION['new_string']))

		{

			print("<span>"._ERROR." "._CODE."</span><br />");

            $this->case=false;

		}

        if(empty($this->post['name']))

		{

			print("<span>"._NO_NAME."</span><br />");

            $this->case=false;

		}

        if(empty($this->post['title']))

		{

			print("<span>"._ERROR." "._ADDRESS."</span><br />");

            $this->case=false;

		}

        if(empty($this->post['notes']))

		{

			print("<span>"._ERROR." "._COMMENT."</span><br />");

            $this->case=false;

		}

        $this->post=mysql_db::remove_from_array($this->post,'submitt');

        $this->post=mysql_db::remove_from_array($this->post,'rs');

        $this->post=mysql_db::remove_from_array($this->post,'code');

        if($this->case==true)

        {

            if(!mysql_db::add_edit_rec('comments',$this->post))

            {

                //print(mysql_error());

            }

            else

            {

                print('<div style="border-color: #00ff00;border-style: solid;border-width: 1px;color:#00ff00;background-color: #E5FEDA;width:80%;">'._THANK_YOU.'</div>');

                $_SESSION['new_string']='';

                print('<script type="text/javascript">

                    	document.getElementById("form_controls").innerHTML="";

                    </script>');

            }

        }

        else

        {

            //print('ok');

        }

        //print('</div>');

    }

    protected function browse()

    {

        if($this->post['rec']>0)

        {

            if($this->post['pages']=='')

            {

                $this->post['pages']=0;

            }

            //$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";

            $limit.=" limit ".$this->post['pages'].",".$this->post['rec']."";

        }

        else

        {

            $limit=' limit 0,10';

        }

        $num=mysql_db::get_records_by_key("select id from comments where enabled=2 and id_content=".$this->get['id']."");

        $res=mysql_db::get_records_by_key("select * from comments where enabled=2 and id_content=".$this->get['id']." order by ddate desc $limit");

        print('<div class="spacing"></div>');

        for($i=0;$i<count($res['id']);$i++)

        {

            print('<div id="title">'.$res['title'][$i].'</div>');

            print('<div id="name">'.$res['name'][$i].'</div>');

            print('<div id="notes">'.$res['notes'][$i].'</div>');

            print('<div id="admin_note">'.$res['admin_note'][$i].'</div>');

            print('<div class="spacing"></div>');            

        }

        $j=1;

        for($i=0;$i<count($num['id']);$i+=10)

        {

            $page[$i]=$j++;

        }

        print('<table>');

        print('<tr><td valign="top">'._ALL.': '.count($num['id']).'</td><td> &nbsp; </td><td>');

        form::open_form('paging_form','http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/controls/ajax.php?l='.$_GET['l'].'&page=controls&type=controls&event=browse&id='.$this->get['id'].'&page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="paging_form" onsubmit="return false;"');

        //form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.count($num['id']).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');

        form::add_select('rec',$page,$this->post['rec'],'',_PAGE,' onchange="post(\'paging_form\',\'comments\');return false;"');

        form::add_input('pages','hidden','',10);

        //print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');

        //form::add_input('submitt','submit','',_VIEW,' onclick="post(\'paging_form\',\'comments\');return false;"');

        form::close_form();

        print('</td></tr>');

        print('<table>');

        //print('<table>');

//        print('<tr><td valign="top">'.count($num['id']).'</td><td>');

//        form::open_form('paging_form','classes/block/controls/ajax.php?l='.$_GET['l'].'&page=controls&type=controls&event=browse&id='.$this->get['id'].'&page='.$this->get['page'].'&class='.$this->get['class'].'&','post',' id="paging_form" onsubmit="return false;"');

//        form::add_input('rec','text','',$this->post['rec'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';if(this.value>0){results.innerHTML=\'\' + Math.round('.count($num['id']).'/this.value);}" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');

//        form::add_input('pages','text','',$this->post['pages'],' size="2" onkeypress="this.value=trim_zero(this.value);this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';" onblur="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';post(\'paging_form\',\'comments\');return false;" onkeyup="this.value=trim(this.value.toLowerCase());this.value=parseInt(this.value);if(this.value==\'NaN\' || isNaN(parseInt(this.value)))this.value=\'\';"');

//        print(' &nbsp; عدد الصفحات: <span id="results"></span> &nbsp; ');

//        form::add_input('submitt','submit','',_VIEW,' onclick="post(\'paging_form\',\'comments\');return false;"');

//        form::close_form();

//        print('</td></tr>');

//        print('<table>');

    }

}?>