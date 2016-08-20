<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class content
 **/
 print('<span>'.$resu['descr'][0].'</span>');?><!--<link rel="stylesheet" type="text/css" href="js/featured_contents/featured_content_slider/style.css" />-->
 <style type="text/css">
<!--
	#featured<?=$resu['id'][0];?>{ 
    	width:400px; 
    	padding-right:250px; 
    	position:relative; 
    	border:5px solid #ccc; 
    	height:250px; 
    	background:#fff;
    }
    #featured<?=$resu['id'][0];?> ul.ui-tabs-nav{ 
    	position:absolute; 
    	top:0; left:400px; 
    	list-style:none; 
    	padding:0; margin:0; 
    	width:250px; 
    }
    #featured<?=$resu['id'][0];?> ul.ui-tabs-nav li{ 
    	padding:1px 0; padding-left:13px;  
    	font-size:12px; 
    	color:#666; 
    }
    #featured<?=$resu['id'][0];?> ul.ui-tabs-nav li img{ 
    	float:left; margin:2px 5px; 
    	background:#fff; 
    	padding:2px; 
    	border:1px solid #eee;
    }
    #featured<?=$resu['id'][0];?> ul.ui-tabs-nav li span{ 
    	font-size:11px; font-family:Verdana; 
    	line-height:18px; 
    }
    #featured<?=$resu['id'][0];?> li.ui-tabs-nav-item a{ 
    	display:block; 
    	height:60px; 
    	color:#333;  background:#fff; 
    	line-height:20px;
    }
    #featured<?=$resu['id'][0];?> li.ui-tabs-nav-item a:hover{ 
    	background:#f2f2f2; 
    }
    #featured<?=$resu['id'][0];?> li.ui-tabs-selected{ 
    	background:url('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featured_content_slider/images_/selected-item.gif') top left no-repeat;  
    }
    #featured<?=$resu['id'][0];?> ul.ui-tabs-nav li.ui-tabs-selected a{ 
    	background:#ccc; 
    }
    #featured<?=$resu['id'][0];?> .ui-tabs-panel{ 
    	width:400px; height:250px; 
    	background:#999; position:relative;
    }
    #featured<?=$resu['id'][0];?> .ui-tabs-panel .info{ 
    	position:absolute; 
    	top:180px; left:0; 
    	height:70px; width:400px;
    	background: url('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featured_content_slider/images_/transparent-bg.png'); 
    }
    #featured<?=$resu['id'][0];?> .info h2{ 
    	font-size:18px; font-family:Georgia, serif; 
    	color:#fff; padding:5px; margin:0;
    	overflow:hidden; 
    }
    #featured<?=$resu['id'][0];?> .info p{ 
    	margin:0 5px; 
    	font-family:Verdana; font-size:11px; 
    	line-height:15px; color:#f0f0f0;
    }
    #featured<?=$resu['id'][0];?> .info a{ 
    	text-decoration:none; 
    	color:#fff; 
    }
    #featured<?=$resu['id'][0];?> .info a:hover{ 
    	text-decoration:underline; 
    }
    #featured<?=$resu['id'][0];?> .ui-tabs-hide{ 
    	display:none; 
    }
-->
</style>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" ></script>-->
<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featured_content_slider/jquery-ui.min.js" ></script>
<script type="text/javascript">
	_(document).ready(function(){
		_("#featured<?=$resu['id'][0];?> > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	});
</script><div style="margin: auto;width: 90%;">
		<div id="featured<?=$resu['id'][0];?>" >
		  <ul class="ui-tabs-nav">
          <?for($i=0;$i<4;$i++)
            {
                if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
                {?><li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-<?=$res['id'][$i];?>_<?=$resu['id'][0];?>"><a href="#fragment-<?=$res['id'][$i];?>_<?=$resu['id'][0];?>"><img src="upload/<?=$res['icon'][$i];?>" alt="<?=$res['title'][$i];?>" width="80" height="50" /><span><?=$res['title'][$i];?></span></a></li>
                <?}
            }?>
	      </ul>
        <?for($i=0;$i<4;$i++)
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
                        $event='view';
                    }
                }?>
        	    <div id="fragment-<?=$res['id'][$i];?>_<?=$resu['id'][0];?>" class="ui-tabs-panel" style="">
        			<img src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>upload/<?=$res['icon'][$i];?>" width="385" height="237" alt="<?=$res['title'][$i];?>" />
        			 <div class="info" >
        				<h2><a href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>?l=<?=$res['language'][$i];?>&id=<?=$res['id'][$i];?>&type=<?=$this->params['type'];?>&page=<?=$this->params['page'];?>&event=view&title=<?=clean::clean_url($res['title'][$i]);?>" ><?=$res['title'][$i];?></a></h2>
        				<p><?=$res['descr'][$i];?> <a href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>?l=<?=$res['language'][$i];?>&id=<?=$res['id'][$i];?>&type=<?=$this->params['type'];?>&page=<?=$this->params['page'];?>&event=<?=$event;?>&title=<?=clean::clean_url($res['title'][$i]);?>" ><?=_MORE;?>...</a></p>
        			 </div>
        	    </div>
            <?}
            }?>
		</div></div>