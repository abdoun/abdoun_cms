<?php

if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}

/**

 * @author 

 * @copyright  2010

 * @class content

 **/

 ?><script type="text/javascript" language="javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/js/jquery.easing.min.1.3.js"></script>

<script type="text/javascript" language="javascript" src="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/js/jquery.jcontent.0.8.min.js"></script>

<link href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/css/demo.css" rel="stylesheet" type="text/css"/>  

<link href="http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>js/featured_contents/jcontent_examples/css/jcontent.css" rel="stylesheet" type="text/css"/> 

<script type="text/javascript" language="javascript">

    _("document").ready(function(){               

		_("div#videos-demo<?=$resu['id'][0];?>").jContent({orientation: 'horizontal', 

								 easing: "easeOutCirc", 

								 duration: 500,

								 circle: true,

								 width: 640,

								 height: 480,

								 videos: true});						 

	});

</script>

<style type="text/css">

	#videos-demo<?=$resu['id'][0];?>

	{

		background-color: #000000;

	}

	

	#videos-demo<?=$resu['id'][0];?> div.slides

	{

		width: 640px;

		height: 480px;

	}

	

	#videos-demo<?=$resu['id'][0];?> a.prev,

	#videos-demo<?=$resu['id'][0];?> a.next

	{

		margin-top: 170px;

	}

	

</style><?print('<span>'.$resu['descr'][0].'</span>');?>

<div id="videos-demo<?=$resu['id'][0];?>">

	<a title="" href="#" class="prev"></a>

	<div class="slides"><?

    for($i=0;$i<count($res['id']);$i++)

    {

        if($res['permission'][$i]==1 || ($res['permission'][$i]==2 && $_SESSION['username']!='' && membership::content_member($res['id'][$i])))

        {

            ?><div><?

            if(strpos($res['icon'][$i],'http')===false){$res['icon'][$i]='upload/'.$res['icon'][$i];}//else{$res['icon'][0]=$res['icon'][0];}

            if(!empty($res['body'][$i]))

            {

                $ext=substr($res['body'][$i],-3);//print($ext);

                if($ext=='avi' || $ext=='wmv')

                {

                    if(substr($res['body'][$i],0,4)!='http'){$res['body'][$i]='upload/'.$res['body'][$i];}?>

                    <object classid="clsid:6BF52A52-394A-11D3-B153-00C04F79FAA6" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" width="480" height="315">

                    	<param name="src" value="<?=$res['body'][$i];?>" />

                    	<param name="width" value="480" />

                    	<param name="height" value="315" />

                    	<spanbed type="application/x-mplayer2" src="<?=$res['body'][0];?>" width="480" height="315"></embed>

                    </object>    

                    <?

                }

                elseif($ext=='mp4')

                {

                    if(substr($res['body'][$i],0,4)!='http'){$res['body'][$i]='upload/'.$res['body'][$i];}?>

                    <object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0" width="480" height="315">

                    	<param name="autoplay" value="true" />

                    	<param name="src" value="<?=$res['body'][$i];?>" />

                    	<param name="width" value="480" />

                    	<param name="height" value="315" />

                    	<spanbed type="video/quicktime" autoplay="true" src="<?=$res['body'][$i];?>" width="400" height="315"></embed>

                    </object>

                    <?

                }

                elseif($ext=='flv')

                {

                    if(substr($res['body'][$i],0,4)!='http'){$res['body'][$i]='upload/'.$res['body'][$i];}?>

                <object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="480" height="315">

            		<param name="movie" value="player.swf" />

            		<param name="allowfullscreen" value="true" />

            		<param name="allowscriptaccess" value="always" />

            		<param name="flashvars" value="file=<?=$res['body'][$i];?>&image=<?=$res['icon'][$i];?>" />

            		<spanbed

            			type="application/x-shockwave-flash"

            			id="player2"

            			name="player2"

            			src="player.swf" 

            			width="480" 

            			height="315"

            			allowscriptaccess="always" 

            			allowfullscreen="true"

            			flashvars="file=<?=$res['body'][$i];?>&image=<?=$res['icon'][$i];?>"/>

                </object>

            <?  }

                elseif($ext=='ram' || substr($res['body'][$i],-2)=='rm' || $ext=='mp3')

                {

                    if(substr($res['body'][$i],0,4)!='http'){$res['body'][$i]='upload/'.$res['body'][$i];}?>

                    <object classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="480" height="300">

                	<param name="src" value="<?=$res['body'][$i];?>" />

                	<param name="width" value="480" />

                	<param name="height" value="300" />

                	<spanbed type="audio/x-pn-realaudio-plugin" src="<?=$res['body'][$i];?>" width="400" height="300"></embed>

                </object><?

                }

                else

                {

                    print($res['body'][$i]);

                }

           }?>

            </div><?

        }

    }

  ?><!--<div>

			<object width="480" height="390">

			<param name="movie" value="http://www.youtube.com/v/ST6qpR0iO_s?fs=1&amp;hl=en_US&amp;rel=0"></param>

			<param name="allowFullScreen" value="true"></param>

			<param name="bgcolor" value="#000000"></param>

			<param name="allowscriptaccess" value="always"></param>

			<spanbed src="http://www.youtube.com/v/ST6qpR0iO_s?fs=1&amp;hl=en_US&amp;rel=0" bgcolor="#000000" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="390"></embed>

			</object>

		</div>-->

	</div>

		<a title="" href="#" class="next"></a>

</div