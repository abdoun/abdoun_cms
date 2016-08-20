<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class content
 **/
 print('<span>'.$resu['descr'][0].'</span>');?>
<style type="text/css">
<!--
	/*
	Featured Content Slider
	by: Chris Coyier
*/
/**
 * *											{ margin: 0; padding: 0; }
 * body 										{ font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
 */
					  				  
/*
	UTILITY STYLES
*/				  				  
					  				  
.floatLeft 									{ float: left; margin-right: 10px;}
.floatRight									{ float: right; }
.clear 										{ clear: both; }
/*
	PAGE STRUCTURE
*/
#page-wrap<?=$resu['id'][0];?>				{ width: 500px; margin: 25px auto; position: relative; min-height: 500px;
											  background: url(http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featuredcontentslider/featuredcontentslider/images_/bg.png) top center; }
/*
	TYPOGRAPHY
*/
/**
 * ul											{ list-style: square inside; }
 * a, a:visited								{ color: #729dff; text-decoration: none; }
 * a:hover, a:active							{ color: white; }
 * blockquote									{ padding: 0 20px; margin-left: 20px; border-left: 20px solid #ccc; font-size: 14px; 
 * 									  		  font-family: Georgia, serif; font-style: italic; margin-top: 10px;}
 */
/*
	SLIDER
*/
.slider-wrap								{ width: 460px; position: absolute; top: 80px; left: 33px; }			
.stripViewer .panelContainer 
.panel ul									{ text-align: left; margin: 0 15px 0 30px; }
.stripViewer								{ position: relative; overflow: hidden; width: 460px; height: 285px; }
.stripViewer .panelContainer				{ position: relative; left: 0; top: 0; }
.stripViewer .panelContainer .panel			{ float: left; height: 100%; position: relative; width: 460px; }
.stripNavL, .stripNavR, .stripNav			{ display: none; }
.nav-thumb 									{ border: 1px solid black; margin-right: 5px; }
#movers-row<?=$resu['id'][0];?>				{ margin: -55px 40px 0 62px; }
#movers-row<?=$resu['id'][0];?> div			{ width: 20%; float: left; }
#movers-row<?=$resu['id'][0];?> div a.cross-link 				{ float: right; }
.photo-meta-data							{ background: url(http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featuredcontentslider/featuredcontentslider/images_/transpBlack.png); padding: 10px; height: 30px; 
											  width:400px;margin-left:7px; margin-top: -55px; position: relative; z-index: 9999; color: white; }
.photo-meta-data span 						{ font-size: 13px; }
.cross-link									{ display: block; width: 62px; margin-top: -14px; 
											  position: relative; padding-top: 15px; z-index: 9999; }
.active-thumb 								{ background: transparent url(http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featuredcontentslider/featuredcontentslider/images_/icon-uparrowsmallwhite.png) top center no-repeat; }
-->
</style>

	<!--<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>-->
	<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featuredcontentslider/featuredcontentslider/js/jquery-easing-1.3.pack.js"></script>
	<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featuredcontentslider/featuredcontentslider/js/jquery-easing-compatibility.1.2.pack.js"></script>
	<script type="text/javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/featuredcontentslider/featuredcontentslider/js/coda-slider.1.1.1.pack.js"></script>	
	<script type="text/javascript">
	
		var theInt = null;
		var _crosslink, _navthumb;
		var curclicked = 0;
		
		theInterval = function(cur){
			clearInterval(theInt);
			
			if( typeof cur != 'undefined' )
				curclicked = cur;
			
			_crosslink.removeClass("active-thumb");
			_navthumb.eq(curclicked).parent().addClass("active-thumb");
				_(".stripNav ul li a").eq(curclicked).trigger('click');
			
			theInt = setInterval(function(){
				_crosslink.removeClass("active-thumb");
				_navthumb.eq(curclicked).parent().addClass("active-thumb");
				_(".stripNav ul li a").eq(curclicked).trigger('click');
				curclicked++;
				if( 6 == curclicked )
					curclicked = 0;
				
			}, 3000);
		};
		
		_(function(){
			
			_("#main-photo-slider<?=$resu['id'][0];?>").codaSlider();
			
			_navthumb = _(".nav-thumb");
			_crosslink = _(".cross-link");
			
			_navthumb
			.click(function() {
				var _this = _(this);
				theInterval(_this.parent().attr('href').slice(1) - 1);
				return false;
			});
			
			theInterval();
		});
	</script>
    <div dir="ltr" style="text-align: left;direction: ltr;margin: 0; padding: 0;">
	<div id="page-wrap<?=$resu['id'][0];?>">
											
	<div class="slider-wrap">
		<div id="main-photo-slider<?=$resu['id'][0];?>" class="csw">
			<div class="panelContainer">
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
                                $event='view';
                            }
                        }?>
        				<div class="panel" title="Panel 1">
        					<div class="wrapper">
        						<img src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>upload/<?=$res[icon][$i];?>" alt="temp" width="420" height="285" />
        						<div class="photo-meta-data">
        							<?=$res[title][$i];?> <a href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>?l=<?=$res['language'][$i];?>&id=<?=$res['id'][$i];?>&type=<?=$this->params['type'];?>&page=<?=$this->params['page'];?>&event=<?=$event;?>&title=<?=clean::clean_url($res['title'][$i]);?>" style="color:#11a8e7;font-size:11px;"><?=_MORE;?></a><br />
        							<span><?=$res['descr'][$i];?></span>
        						</div>
        					</div>
        				</div>
                    <?}
                }?>
			</div>
		</div>

		<a href="#1" class="cross-link active-thumb"><img src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>upload/<?=$res['icon'][0];?>" width="60" height="40" class="nav-thumb" alt="temp-thumb" /></a>
		<div id="movers-row<?=$resu['id'][0];?>">
        <?for($i=1;$i<6;$i++)
                {
                    if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))
                    {
                        ?><div><a href="#2" class="cross-link"><img src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>upload/<?=$res['icon'][$i];?>" width="60" height="40" class="nav-thumb" alt="temp-thumb" /></a></div><?
                    }
                }?>
		</div>
	</div>
	
	</div></div>