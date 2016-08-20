<?php 
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class content
 **/
 //print_r($res);
?><style type="text/css">
<!-- 
.idiv{
padding:7px;
padding-bottom:5px;
text-align:<?=_ALIGN;?>;
font-size:14px;
}

/* This is the container which set text to solid color.
position: relative used for IE */ 
.transboxdiv {

color: #000;
text-align:<?=_ALIGN_;?>;

opacity: 1;
-moz-opacity:1;
position: relative;
}
--></style><?//print('<a href="rss.php?l='.$this->params[l].'&id='.$resu[id][0].'"><img src="images/rssicon.png" align="'._ALIGN_.'" height="20" title="rss" alt="RSS" border="0" /></a>');
print('<span>'.$resu['descr'][0].'</span>');?><div class="transbox" style="width:670px;"><div class="transboxdiv" style="width:92%;height:300px;">
		<div class="idiv">
		<script type="text/javascript">
        var arr<?=$resu['id'][0];?>=new Array;var link<?=$resu['id'][0];?>=new Array;var title<?=$resu['id'][0];?>=new Array;var descr<?=$resu['id'][0];?>=new Array;var _date<?=$resu['id'][0];?>=new Array;var _author<?=$resu['id'][0];?>=new Array;
        </script><?php 
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
                                $kind=mysql_db::get_records_by_key("select b.`type` from content b left outer join content a on a.parent=b.id where a.id=".$res['id'][$i]);
                                $this->params['type']=$kind['type'][0];
                                $res['type'][$i]=$kind['type'][0];
                                $event='view';
                            }
                        }
                    if(!empty($res['_file'][$i])){if(strpos($res['_file'][$i],'.')===false){$_file=' <span style="background-color:#ccc">'.$res['_file'][$i].'</span> ';}else{$_file='';}}else{$_file='';}
                    $arr[$i]['link']=' <a  href="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'" style=color:#000>'.$res['title'][$i].'</a> ';
                    $arr[$i]['title']=$res['title'][$i];
                	?><script type="text/javascript">
                    arr<?=$resu['id'][0];?>[<?=$i;?>]='<a  href="<?print('?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]));?>"><img style="margin: 0px;" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>upload/<?=$res[icon][$i];?>" width="200" align="<?=_ALIGN;?>" height="200" border="0" /></a>';
                    link<?=$resu['id'][0];?>[<?=$i;?>]='<?php print('?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]));?>';
                    title<?=$resu['id'][0];?>[<?=$i;?>]='<b><?php print(clean::burn($res['title'][$i]));?></b>';
                    descr<?=$resu['id'][0];?>[<?=$i;?>]='<span><?php print($res['descr'][$i]);?></span> ';
                    _author<?=$resu['id'][0];?>[<?=$i;?>]='<?php print($res['_author'][$i].' | '.$_file);?>';
                    _date<?=$resu['id'][0];?>[<?=$i;?>]='<?php print($res['_date'][$i]);?>';
                    </script><?php  
                }
        }?><div style="height: 7px;font-size: 7px;"> </div><?php
        foreach($arr as $key=>$value)
        {
            ?><span title="<?=$arr[$key][title];?>" style="cursor: pointer;"><img class="icon<?=$resu['id'][0];?>" id="icon<?=$resu['id'][0];?><?=$key;?>" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>template/beanpod/ar/images/sheet_s.png" width="20" height="20" border="0" /></span><?
        }
        ?>
        <div id="canadaprovinces<?=$resu['id'][0];?>" class="glidecontentwrapper">
        <div id="imgg<?=$resu['id'][0];?>" style="position: relative; display: none;">
         	<div style="border: 1px solid rgb(204, 204, 204); overflow: hidden; height: 200px; width: 740px; position: relative;">
         		<div><span id="lblscriptimage<?=$resu['id'][0];?>"></span>
                 <span style="padding: 5px;" id="lblTitle<?=$resu['id'][0];?>"></span><br />
                 <span style="padding: 5px;" id="lblAuthor<?=$resu['id'][0];?>" style="background-color: #ccc;"></span> &nbsp; &nbsp; &nbsp; &nbsp; 
                 <span id="lblDate<?=$resu['id'][0];?>" style="background-color: #ccc;"></span><br />
                 <span style="padding: 5px;" id="lblDescr<?=$resu['id'][0];?>"></span> &nbsp; 
                 <a  href="" id="lblMore<?=$resu['id'][0];?>" style="color:#3F84AB;font-size: 12px;"><?=_SHOW;?></a>
                 <?=$this->share($res,$i);?>
                 </div>
    		</div>
        </div><script type="text/javascript">
        _("document").ready(function(){
        	function animater<?=$resu['id'][0];?>(i)
            {
            	if (i >= <?=count($res['id']);?>)
            	{
            		i = 0;
            	}
                //alert(arr<?=$resu['id'][0];?>[i]);
                _("#lblscriptimage<?=$resu['id'][0];?>").html(arr<?=$resu['id'][0];?>[i]);
                _("#lblTitle<?=$resu['id'][0];?>").html(title<?=$resu['id'][0];?>[i]);
                _("#lblDescr<?=$resu['id'][0];?>").html(descr<?=$resu['id'][0];?>[i]);
                _("#lblMore<?=$resu['id'][0];?>").attr('href',link<?=$resu['id'][0];?>[i]);
                _("#lblAuthor<?=$resu['id'][0];?>").html(_author<?=$resu['id'][0];?>[i]);
                _("#lblDate<?=$resu['id'][0];?>").html(_date<?=$resu['id'][0];?>[i]);
            	_("#imgg<?=$resu['id'][0];?>").fadeIn('slow');
                _("#icon<?=$resu['id'][0];?>" + i + "").attr('src','http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>template/beanpod/ar/images/footer_t.png');
             	timeout=setTimeout(function(){
                    _("#icon<?=$resu['id'][0];?>" + i + "").attr('src','http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>template/beanpod/ar/images/sheet_s.png');
                    i++;
                    animater<?=$resu['id'][0];?>(i);
            	}, 5000);
            }
            animater<?=$resu['id'][0];?>(0);
            <?for($j=0;$j<count($res['id']);$j++)
            {
                ?>_("#icon<?=$resu['id'][0];?><?=$j;?>").click(function(){_(".icon<?=$resu['id'][0];?>").attr('src','http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>template/beanpod/ar/images/sheet_s.png');clearTimeout(timeout);animater<?=$resu['id'][0];?>(<?=$j;?>);});<?
            }?>
            });
        </script></div></div></div></div>