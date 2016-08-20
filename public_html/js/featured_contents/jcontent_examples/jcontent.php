<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class content
 **/
 //print_r($resu);?><script type="text/javascript" language="javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/js/jquery.easing.min.1.3.js"></script>
		<script type="text/javascript" language="javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/js/jquery.jcontent.0.8.min.js"></script>
		  <link href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/css/demos.css" rel="stylesheet" type="text/css"/>
        <link href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/css/jcontent.css" rel="stylesheet" type="text/css"/> 
        <script type="text/javascript" language="javascript">
            _("document").ready(function(){
                <?if($_GET['dir']!='button')
                {
                    ?>_("div#demo<?=$resu['id'][0];?>").jContent({orientation: '<?=$_GET['v'];?>', 
                                         easing: "easeOutCirc", 
                                         duration: 5000,
                                         auto: true,
										 pause_on_hover: true,
                                         direction: '<?=$_GET['dir'];?>',
                                         pause: 7000});
                                     });<?
                }
                else
                {
                    ?>_("div#demo<?=$resu['id'][0];?>").jContent({orientation: '<?=$_GET['v'];?>', 
                                         easing: "easeOutCirc", 
                                         duration: 5000,
                                         circle: true});
                                     });<?
                }
                ?>                
        </script><?
//print('<a href="rss.php?l='.$this->params[l].'&id='.$resu[id][0].'"><img src="images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a> <span>'.$resu['descr'][0].'</span>');
 if($_GET['dir']=='button')
 {
    ?><div id="demo<?=$resu['id'][0];?>" class="demo1">
    <a title="" href="#" class="prev"></a><?    
 }
 else
 {?>
    <div id="demo<?=$resu['id'][0];?>" class="demo3">
 <?}?><div class="slides">
            <?for($i=0;$i<count($res['id']);$i++)
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
                            $kind=mysql_db::get_records_by_key("select b.`type` from content b left outer join content a on a.parent=b.id where a.id=".$res['id'][$i]);
                            $this->params['type']=$kind['type'][0];
                            $res['type'][$i]=$kind['type'][0];
                            $event='view';
                        }
                    }
                    if(!empty($res['_file'][$i])){if(strpos($res['_file'][$i],'.')===false){$_file=' <span style="background-color:#ccc">'.$res[_file][$i].'</span> ';}else{$_file='';}}else{$_file='';}
                    ?><div><?
                    if(!empty($res['icon'][$i])){$img='<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][$i].'" width="100" align="'._ALIGN.'" />';}
                    print('<table width="100%" border="0">
                    <tr style="font-size:14px;font-family:tahoma;"><td dir="'._DIR.'"><b>'.$res[title][$i].'</b></td><td dir="'._DIR.'"><span style="background-color:#ccc">'.$res[_author][$i].'</span>'.$_file.'</td><td dir="'._DIR.'"><span style="background-color:#ccc">'.$res[_date][$i].'</span></td></tr>
                    <tr><td style="font-size:11px;font-family:tahoma;vertical-align:top;" colspan="3">'.$img.'<br /><span>'.$res['descr'][$i].'</span> <div class="more"><a href="?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'" style="color:#11a8e7;font-size:11px;">'._MORE.'...</a></td></tr>
                    </table>'.$this->share($res,$i));
                    ?></div><?
                }
            }?>  
            </div>
<?if($_GET['dir']=='button')
 {
    ?><a title="" href="#" class="next"></a><?
 }?></div><div class="cleared"></div>