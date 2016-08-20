<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class content
 **/
 //print_r($resu);?><!-- Scripts -->
      <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>-->
	  <script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/easy_accordion/scripts/jquery.easyAccordion.js"></script>
      <script type="text/javascript">
      _(document).ready(function () {
          _('#accordion-<?=$resu['id'][0];?>').easyAccordion({ 
    			autoStart: true, 
    			slideInterval: 3000
    	});
    });
      </script>
      
      <style type="text/css">
		  
		  		  
		 
		/* UNLESS YOU KNOW WHAT YOU'RE DOING, DO NOT CHANGE THE FOLLOWING RULES */
		
		.easy-accordion{display:block;position:relative;overflow:hidden;padding:0;margin:0}
		.easy-accordion dt,.easy-accordion dd{margin:0;padding:0}
		.easy-accordion dt,.easy-accordion dd{position:absolute}
		.easy-accordion dt{margin-bottom:0;margin-left:0;z-index:5;/* Safari */ -webkit-transform: rotate(-90deg); /* Firefox */ -moz-transform: rotate(-90deg);-moz-transform-origin: 20px 0px;  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);cursor:pointer;}
		.easy-accordion dd{z-index:1;opacity:0;overflow:hidden}
		.easy-accordion dd.active{opacity:1;}
		.easy-accordion dd.no-more-active{z-index:2;opacity:1}
		.easy-accordion dd.active{z-index:3}
		.easy-accordion dd.plus{z-index:4}
		.easy-accordion .slide-number{position:absolute;bottom:0;left:10px;font-weight:normal;font-size:1.1em;/* Safari */ -webkit-transform: rotate(90deg); /* Firefox */ -moz-transform: rotate(90deg);  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);}
		 
		 
		/* FEEL FREE TO CUSTOMIZE THE FOLLOWING RULES */
		
		dd p{line-height:120%}
		
		#accordion-<?=$resu['id'][0];?>{width:700px;height:245px;padding:30px;background:#fff;border:1px solid #b5c9e8}
		#accordion-<?=$resu['id'][0];?> dl{width:700px;height:245px}	
		#accordion-<?=$resu['id'][0];?> dt{height:46px;line-height:44px;text-align:right;padding:0 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:0px;background:#fff url(js/featured_contents/easy_accordion/images_/slide-title-inactive-1.jpg) 0 0 no-repeat;color:#26526c}
		#accordion-<?=$resu['id'][0];?> dt.active{cursor:pointer;color:#fff;background:#fff url(js/featured_contents/easy_accordion/images_/slide-title-active-1.jpg) 0 0 no-repeat}
		#accordion-<?=$resu['id'][0];?> dt.hover{color:#68889b;}
		#accordion-<?=$resu['id'][0];?> dt.active.hover{color:#fff}
		#accordion-<?=$resu['id'][0];?> dd{padding:25px;background:url(js/featured_contents/easy_accordion/images_/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}
		#accordion-<?=$resu['id'][0];?> .slide-number{color:#68889b;left:10px;font-weight:bold}
		#accordion-<?=$resu['id'][0];?> .active .slide-number{color:#fff;}
		#accordion-<?=$resu['id'][0];?> a{color:#68889b}
		#accordion-<?=$resu['id'][0];?> dd img{float:right;margin:0 0 0 30px;}
		#accordion-<?=$resu['id'][0];?> h2{font-size:2.5em;margin-top:10px}
		#accordion-<?=$resu['id'][0];?> .more{padding-top:10px;display:block}
			
		#accordion-2{width:700px;height:195px;padding:30px;background:#fff;border:1px solid #b5c9e8}
		#accordion-2 h2{font-size:2.5em;margin-top:10px}
		#accordion-2 dl{width:700px;height:195px}	
		#accordion-2 dt{height:56px;line-height:44px;text-align:right;padding:10px 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:1px;background:#fff url(images/slide-title-inactive-2.jpg) 0 0 no-repeat;color:#26526c}
		#accordion-2 dt.active{cursor:pointer;color:#fff;background:#fff url(images/slide-title-active-2.jpg) 0 0 no-repeat}
		#accordion-2 dt.hover{color:#68889b;}
		#accordion-2 dt.active.hover{color:#fff}
		#accordion-2 dd{padding:25px;background:url(images/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}
		#accordion-2 .slide-number{color:#68889b;left:10px;font-weight:bold}
		#accordion-2 .active .slide-number{color:#fff}
		#accordion-2 a{color:#68889b}
		#accordion-2 dd img{float:right;margin:0 0 0 30px;position:relative;top:-20px}

		#accordion-3{width:700px;height:195px;padding:30px;background:#fff;border:1px solid #b5c9e8}
		#accordion-3 h2{font-size:2.5em;margin-top:10px}
		#accordion-3 dl{width:700px;height:195px}	
		#accordion-3 dt{height:56px;line-height:44px;text-align:right;padding:10px 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:1px;background:#fff url(images/slide-title-inactive-2.jpg) 0 0 no-repeat;color:#26526c}
		#accordion-3 dt.active{cursor:pointer;color:#fff;background:#fff url(images/slide-title-active-2.jpg) 0 0 no-repeat}
		#accordion-3 dt.hover{color:#68889b;}
		#accordion-3 dt.active.hover{color:#fff}
		#accordion-3 dd{padding:25px;background:url(images/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}
		#accordion-3 .slide-number{color:#68889b;left:13px;font-weight:bold}
		#accordion-3 .active .slide-number{color:#fff}
		#accordion-3 a{color:#68889b}
		#accordion-3 dd img{float:right;margin:0 0 0 30px;position:relative;top:-20px}

      </style><div id="accordion-<?=$resu['id'][0];?>" dir="ltr">
            <dl>
                <?for($i=0;$i<6;$i++)
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
                        print('<dt>'.$res[title][$i].'</dt>');
                        ?><dd><?
                        if(!empty($res['icon'][$i])){$img='<img src="http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE)).'upload/'.$res['icon'][$i].'" width="100" align="'._ALIGN.'" />';}
                        print('<table width="100%" border="0" dir="'._DIR.'">
                        <tr style="font-size:14px;font-family:tahoma;"><td dir="'._DIR.'"><b>'.$res[title][$i].'</b></td><td dir="'._DIR.'"><span style="background-color:#ccc">'.$res[_author][$i].'</span>'.$_file.'</td><td dir="'._DIR.'"><span style="background-color:#ccc">'.$res[_date][$i].'</span></td></tr>
                        <tr><td style="font-size:11px;font-family:tahoma;vertical-align:top;" colspan="3">'.$img.'<br /><em>'.$res['descr'][$i].'</em> <div class="more"><a href="?l='.$res['language'][$i].'&id='.$res['id'][$i].'&type='.$this->params['type'].'&page='.$this->params['page'].'&event='.$event.'&title='.clean::clean_url($res['title'][$i]).'" style="color:#11a8e7;font-size:11px;">'._MORE.'...</a></td></tr>
                        </table>'.$this->share($res,$i));
                        ?></dd><?
                    }
                }?>
            </dl>
        </div>