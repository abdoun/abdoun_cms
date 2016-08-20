<?php

if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}

/**

 * @author 

 * @copyright  2010

 * @class vote

 */

class vote 

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

    protected function browse($l='')

    {

       $res=mysql_db::get_records_by_key("select * from vote where siteId='".$l."' and enabled=2 limit 1");

       if(count($res['id'])>0)

       {

           echo '<form action="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/side_menu/ajax.php?l='.$l.'&page=vote&type=vote&event=act&" method="post" name="vote_form" id="vote_form" onsubmit="post(\'vote_form\',\'vote_result\');return false;">';

           echo '<input type="hidden" name="voters" value="'.$res['voters'][0].'" /><input type="hidden" name="answerr" value="vo2" /><input type="hidden" name="id" value="'.$res['id'][0].'" />'.$res['question'][0].'<br />';

           echo '<input class="radio" type="radio" name="answer" value="vo1" onclick="vote_form.answerr.value=this.value" /> '.$res['an1'][0].'<br />';

           echo '<input class="radio" type="radio" name="answer" value="vo2" onclick="vote_form.answerr.value=this.value" checked="checked" /> '.$res['an2'][0].'<br />';       

           if(!empty($res['an3'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo3" onclick="vote_form.answerr.value=this.value" /> '.$res['an3'][0].'<br />';

           }

           if(!empty($res['an4'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo4" onclick="vote_form.answerr.value=this.value" /> '.$res['an4'][0].'<br />';

           }

           if(!empty($res['an5'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo5" onclick="vote_form.answerr.value=this.value" /> '.$res['an5'][0].'<br />';

           }

           if(!empty($res['an6'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo6" onclick="vote_form.answerr.value=this.value" /> '.$res['an6'][0].'<br />';

           }

           if(!empty($res['an7'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo7" onclick="vote_form.answerr.value=this.value" /> '.$res['an7'][0].'<br />';

           }

           if(!empty($res['an8'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo8" onclick="vote_form.answerr.value=this.value" /> '.$res['an8'][0].'<br />';

           }

           if(!empty($res['an9'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo9" onclick="vote_form.answerr.value=this.value" /> '.$res['an9'][0].'<br />';

           }

           if(!empty($res['an10'][0]))

           {

            echo '<input class="radio" type="radio" name="answer" value="vo10" onclick="vote_form.answerr.value=this.value" /> '.$res['an10'][0].'<br />';

           }

           echo '<br /><span id="res_button"><div class="button" id="result" title="'._RESULTS.'" onclick="javascript:get(\'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'classes/block/side_menu/ajax.php?l='.$l.'&page=vote&type=vote&event=result&id='.$res['id'][0].'&\',\'vote_result\');">'._RESULTS.'</div></span>';

           echo '<span id="submitt"><div class="button" id="submitt" title="'._VOTE.'" onclick="post(\'vote_form\',\'vote_result\');return false;">'._VOTE.'</div></span>';

           echo '</form>';           

       }

       else

       {

           echo '';

       }

    }

    function view($l='')

    {

       $res=mysql_db::get_records_by_key("select * from vote where siteId='".$l."' and enabled=2 limit 1");

       if(count($res['id'])>0)

       {

           $html=self::template_include();

           $html=str_replace('<dir_tag />',_DIR,$html);

           $html=str_replace('<title_ />',_VOTE,$html);

           //$content='<script type="text/javascript" src="js/scripts/javaScript.js"></script><script type="text/javascript" src="js/scripts/jscript.js"></script>';

           $content.='<div id="vote_result">';

           ob_start();

           self::browse($l);

           $form = ob_get_contents();

           ob_end_clean();

           $content.=$form;

           $content.='</div><div id="down_vote">&nbsp;</div>';

           $html=str_replace('<align_ />',_ALIGN_,$html);

           $html=str_replace('<_align_ />',_ALIGN,$html);
           $html=str_replace('<dir />',_DEFAULT_TEMPLATE,$html);

           $html=str_replace('<tag />',$content,$html);

       }

       else

       {

           $html='';

       }       

       return $html;

    }

    protected function act()

    {

        if($this->post['id']!='')

		{

			if(empty($this->post['answerr']) || ereg("^ +",trim($this->post['answerr'])))

			{

				print(_SORRY_YOU_HAVENT_SELECTED_ANY_OPTION);

                $tag=false;

                print('<br /><span id="res_button"><div class="button" class="button" id="result" title="'._RESULTS.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$this->get['l'].'&page=vote&type=vote&event=result&id='.$this->get['id'][0].'&\',\'vote_result\');">'._RESULTS.'</div></span>');

                print('<span id="submitt"><div class="button" class="button" id="to_vote" title="'._VOTE.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$this->get['l'].'&page=vote&type=vote&\',\'vote_result\');">'._VOTE.'</div></span>');

                print('<div id="down_vote">&nbsp;</div>');

			}

			elseif($_COOKIE['cookie']==$this->post['id'])

			{

				print(_SORRY_YOU_CANNOT_VOTE_MORE_THAN_ONCE);

                $tag=false;

                print('<br /><span id="res_button"><div class="button" class="button" id="result" title="'._RESULTS.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$this->get['l'].'&page=vote&type=vote&event=result&id='.$this->get['id'][0].'&\',\'vote_result\');">'._RESULTS.'</div></span>');

                print('<span id="submitt"><div class="button" class="button" id="to_vote" title="'._VOTE.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$this->get['l'].'&page=vote&type=vote&\',\'vote_result\');">'._VOTE.'</div></span>');

                print('<div id="down_vote">&nbsp;</div>');

			}

			elseif(!mysql_query("update vote set ".$this->post['answerr']."=".$this->post['answerr']."+1,voters=".$this->post['voters']."+1 where id='".$this->post['id']."'"))

			{

			    //print("update vote set ".$this->post['answerr']."=".$this->post['answerr']."+1,voters=".$this->post['voters']."+1 where id='".$this->post['id']."'<br />");

				print(mysql_error());

				print(_SORRY_THE_VOTE_IS_NOT_COMPLETED_SUCCESSFULLY);

                $tag=false;

                print('<br /><span id="res_button"><div class="button" class="button" id="result" title="'._RESULTS.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$this->get['l'].'&page=vote&type=vote&event=result&id='.$this->get['id'][0].'&\',\'vote_result\');">'._RESULTS.'</div></span>');

                print('<span id="submitt"><div class="button" class="button" id="to_vote" title="'._VOTE.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$this->get['l'].'&page=vote&type=vote&\',\'vote_result\');">'._VOTE.'</div></span>');

                print('<div id="down_vote">&nbsp;</div>');

			}

			else

			{

				$tag=true;

				print(_THANK_YOU.' ');

                $this->result();

			}

		}

    }

    protected function result()

    {

       $res=mysql_db::get_records_by_key("select * from vote where siteId='".$this->get['l']."' and enabled=2 limit 1");

       if(count($res['id'])>0)

       {

           print(_RESULTS.' : '.$res['voters'][0].'<br /> ');

           echo $res['question'][0].'<table>';

           echo '<tr><td>'.$res['an1'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo1'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo1'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           echo '<tr><td>'.$res['an2'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo2'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo2'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           if(!empty($res['an3'][0]))

           {

            echo '<tr><td>'.$res['an3'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo3'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo3'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           if(!empty($res['an4'][0]))

           {

            echo '<tr><td>'.$res['an4'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo4'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo4'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           if(!empty($res['an5'][0]))

           {

            echo '<tr><td>'.$res['an5'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo5'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo5'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           if(!empty($res['an6'][0]))

           {

            echo '<tr><td>'.$res['an6'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo6'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo6'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           if(!empty($res['an7'][0]))

           {

            echo '<tr><td>'.$res['an7'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo7'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo7'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           if(!empty($res['an8'][0]))

           {

            echo '<tr><td>'.$res['an8'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo8'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo8'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           if(!empty($res['an9'][0]))

           {

            echo '<tr><td>'.$res['an9'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo9'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo9'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           if(!empty($res['an10'][0]))

           {

            echo '<tr><td>'.$res['an10'][0].'</td><td><table><tr><td bgcolor="#CAE2FD" width="'.round($res['vo10'][0]*100/$res['voters'][0],2).'"></td><td>'.round($res['vo10'][0]*100/$res['voters'][0],2).'</td></tr></table></td></tr>';

           }

           print('</table>');

           print('<span id="submitt"><div class="button" class="button" id="to_vote" title="'._VOTE.'" onclick="javascript:get(\'classes/block/side_menu/ajax.php?l='.$this->get['l'].'&page=vote&type=vote&\',\'vote_result\');">'._VOTE.'</div></span>');

           print('<div id="down_vote">&nbsp;</div>');

        }

    }

}?>