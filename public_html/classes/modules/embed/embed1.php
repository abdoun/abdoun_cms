<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class embed
{    function process_urls($string) 
    {
        $string = str_replace("\" target=\"_blank","" , $string);
        preg_match_all("/<a href=.*?<\/a>/", $string, $matches);    
            foreach ($matches[0] as $mtch) {
            $mtch_bits = explode('"', $mtch);
            $string = str_replace($mtch, " {$mtch_bits[1]}", $string);
            }
        return $string;
    }
    function get_text_hyper($string,$pattern='/<a.*>(.*)<\/a>/sU') 
    {
        //preg_match_all ('/<a\s+href[^>]+>([^<]+)<\/a>/', $string, $Matches);    
        preg_match_all ($pattern, $string, $Matches);
        for ($i=0;$i<count($Matches[1]);$i++) 
        {
            $string = str_replace($Matches[0][$i], $Matches[1][$i], $string);
        }
        return $string;
    }
    function formatUrlsInText($text)
    {
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        preg_match_all($reg_exUrl, $text, $matches);
        $usedPatterns = array();
        foreach($matches[0] as $pattern){
            if(!array_key_exists($pattern, $usedPatterns)){
                $usedPatterns[$pattern]=true;
                $text = str_replace  ($pattern, "<a href=\"$pattern\" rel=nofollow>$pattern</a> ", $text);   
            }
        }
        return $text;            
    }
    function youtube($string,$autoplay=0,$width=640,$height=480)
    {
    //preg_match('#(v\/|watch\?v=)([\w\-]+)#', $string, $match);
      return preg_replace(
        '#((https://)?(http://)?(www.)?youtube\.com/watch\?[=a-z0-9&_;-]+)#i',
        "<div align=\"center\"><iframe title=\"YouTube video player\" width=\"$width\" height=\"$height\" src=\"https://www.youtube.com/embed/$match[2]?autoplay=$autoplay\" frameborder=\"0\" allowfullscreen></iframe></div>",
        $string);
    }
    function youtube_($string,$autoplay=0,$width=640,$height=480)
    {
        preg_match('#(?:https://)?(?:http://)?(?:www\.)?(?:youtube\.com/(?:v/|watch\?v=)|youtu\.be/)([\w-]+)(?:\S+)?#', $string, $match);
        $embed = '<div align="center"><iframe title="YouTube video player" width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.$match[1].'?autoplay=$autoplay" frameborder="0" allowfullscreen></iframe></div>';
        return str_replace($match[0], $embed, $string);
    }
    function _youtube_($string,$autoplay=0,$width=640,$height=480)
    {
        $string=str_replace('<br />',' <br />',$string);
        $string=str_replace('</p>',' </p>',$string);
        $string=str_replace('<span>',' </span>',$string);
        $string=str_replace('</div>',' </div>',$string);
        $string=str_replace('<br>',' <br>',$string);
        preg_match_all('#(?:https://)?(?:http://)?(?:www\.)?(?:youtube\.com/(?:v/|watch\?v=)|youtu\.be/)([\w-]+)(?:\S+)?#', $string, $match,PREG_PATTERN_ORDER);
        foreach($match[0] as $key=>$value)
        {
            $embed = '<div align="center"><iframe title="YouTube video player" width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.$match[1][$key].'?autoplay=$autoplay" frameborder="0" allowfullscreen></iframe></div>';
            $string=str_replace($match[0][$key],$embed,$string);
        }
        return $string;
    }
    function album($string)//[flagallery gid=74 name=Gallery]
    {
        preg_match_all('/\[flagallery gid=(.*) name=Gallery\]/sU', $string, $match,PREG_PATTERN_ORDER);
        foreach($match[0] as $key=>$value)
        {
            $res=mysql_db::get_records_by_key("select path,title from wp_flag_gallery where gid='".$match[1][$key]."'");
            $pics=mysql_db::get_records_by_key("select pid,filename from wp_flag_pictures where galleryid='".$match[1][$key]."'");
             if(count($pics['filename'])>0)
             {
                $embed='<table width="680" border="0" bgcolor="#000000" align="center"><tr><th colspan="3" style="color:#fff;">'.$res['title'][0].'</th></tr><tr>';
                $k=1;
                foreach($pics['filename'] as $j=>$image)
                {
                    $embed.='<td align="center"><a href="http://www.rlcdamascus.com/'.$res['path'][0].'/'.$image.'" target="_blank"><img src="http://www.rlcdamascus.com/'.$res['path'][0].'/thumbs/thumbs_'.$image.'" width="200" /></a></td>';
                    
                    if($k%3==0){$embed.="</tr><tr>";}
                    $k++;
                }
                $embed.="</table>";
                $string=str_replace($match[0][$key],$embed,$string);
            }
        }
        return $string;
    }
    function album_old($string)//[flagallery gid=74 name=Gallery]
    {
        preg_match_all('/\[flagallery gid=(.*) name=Gallery\]/sU', $string, $match,PREG_PATTERN_ORDER);
        if(count($match[0])>0)
        {
            ?><!--<script type='text/javascript' src='http://www.rlcdamascus.com/wp-includes/js/jquery/jquery.js?ver=1.7.2'></script>-->
            <script type='text/javascript' src='http://www.rlcdamascus.com/wp-content/plugins/nextgen-scrollgallery/scrollGallery/js/mootools-core-1.3.2-full-compat.js?ver=1.3.2'></script>
            <script type='text/javascript' src='http://www.rlcdamascus.com/wp-content/plugins/nextgen-scrollgallery/scrollGallery/js/scrollGallery.js?ver=1.12'></script>
            <script type='text/javascript' src='http://www.rlcdamascus.com/wp-content/plugins/nextgen-scrollgallery/scrollGallery/js/powertools-mobile-1.1.1.js?ver=1.1.1'></script>
            <script type='text/javascript' src='http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/admin/js/swfobject.js?ver=2.2'></script>
            <style type='text/css'>
                @import url('http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/admin/css/flagallery_nocrawler.css');
                @import url('http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/admin/css/flagallery_noflash.css');
                #fancybox-title-over .title { color: #ff9900; }
                #fancybox-title-over .descr { color: #cfcfcf; }
                .flag_alternate .flagcatlinks { background-color: #292929; }
                .flag_alternate .flagcatlinks a.flagcat { border-color: #ffffff; color: #ffffff; background-color: #292929; }
                .flag_alternate .flagcatlinks a.flagcat:hover { border-color: #ffffff; }
                .flag_alternate .flagcatlinks a.active, .flag_alternate .flagcatlinks a.flagcat:hover { color: #ffffff; background-color: #737373; }
                	.flag_alternate .flagcategory a.flag_pic_alt { background-color: #ffffff; border: 2px solid #ffffff; color: #ffffff; }
                .flag_alternate .flagcategory a.flag_pic_alt:hover { background-color: #ffffff; border: 2px solid #4a4a4a; color: #4a4a4a; }
                .flag_alternate .flagcategory a.flag_pic_alt.current, .flag_alternate .flagcategory a.flag_pic_alt.last { border-color: #4a4a4a; }
            </style>
        	<style type='text/css'>@import url('http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/admin/js/photoswipe/photoswipe.css');</style>
        	<script type='text/javascript' src='http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/admin/js/photoswipe/klass.min.js'></script>
        	<script type='text/javascript' src='http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/admin/js/photoswipe/code.photoswipe.jquery-3.0.5.min.js'></script>
        	<script type='text/javascript'>var ExtendVar='photoswipe', hitajax = 'http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/lib/hitcounter.php';</script><?
        }
        foreach($match[0] as $key=>$value)
        {
            $res=mysql_db::get_records_by_key("select path,title from wp_flag_gallery where gid='".$match[1][$key]."'");
            $pics=mysql_db::get_records_by_key("select pid,filename from wp_flag_pictures where galleryid='".$match[1][$key]."'");
            foreach($pics['filename'] as $j=>$image)
            {
                $pic.='<a class="i'.$j.' flag_pic_alt" href="http://www.rlcdamascus.com/'.$res['path'][0].'/'.$image.'" id="flag_pic_'.$pics[pid][$j].'" rel="gid_'.$match[1][$key].'_sid_'.$match[1][$key].'" title="">[img src=http://www.rlcdamascus.com/'.$res['path'][0].'/thumbs/thumbs_'.$image.']<span class="flag_pic_desc" id="flag_desc_'.$pics[pid][$j].'"><strong></strong><br /><span></span></span></a>';//<a class="i0 flag_pic_alt" href="http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/1.jpg" id="flag_pic_676" rel="gid_74_sid_288768072" title="">[img src=http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/thumbs/thumbs_1.jpg]<span class="flag_pic_desc" id="flag_desc_676"><strong></strong><br /><span></span></span></a><a class="i1 flag_pic_alt" href="http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/4.jpg" id="flag_pic_677" rel="gid_74_sid_288768072" title="">[img src=http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/thumbs/thumbs_4.jpg]<span class="flag_pic_desc" id="flag_desc_677"><strong></strong><br /><span></span></span></a><a class="i2 flag_pic_alt" href="http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/3.jpg" id="flag_pic_678" rel="gid_74_sid_288768072" title="">[img src=http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/thumbs/thumbs_3.jpg]<span class="flag_pic_desc" id="flag_desc_678"><strong></strong><br /><span></span></span></a><a class="i3 flag_pic_alt" href="http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/2.jpg" id="flag_pic_679" rel="gid_74_sid_288768072" title="">[img src=http://www.rlcdamascus.com/wp-content/flagallery/d8a3d8b2d985d8a9-d8a7d984d8bad8a7d8b2-d981d98a-d986d987d8b1-d8b9d98ad8b4d8a9/thumbs/thumbs_2.jpg]<span class="flag_pic_desc" id="flag_desc_679"><strong></strong><br /><span></span></span></a>
            }
            $embed = '<p style="text-align: right;"><div class="flashalbum" style="width:100%;height:500px;">
                        <div class="flagallery_swfobject" id="sid_'.$match[1][$key].'_div">
                        <div id="sid_'.$match[1][$key].'_jq" class="flag_alternate">
                    		<div class="flagcatlinks"></div>
                    			<div class="flagCatMeta">
                    			<h4>'.$res['title'][0].'</h4>
                    			<p></p>
                    		</div>
                    		<div class="flagcategory" id="gid_'.$match[1][$key].'_sid_'.$match[1][$key].'">'.$pic.'
                    					</div>
                    	</div></div></div><script type="text/javascript" defer="defer">
                            flag_alt[\'sid_'.$match[1][$key].'\'] = jQuery("div#sid_'.$match[1][$key].'_jq").clone().wrap(document.createElement(\'div\')).parent().html();
                            var sid_'.$match[1][$key].'_div = {
                            	params : {
                            		wmode : "opaque",
                            		allowfullscreen : "true",
                            		allowScriptAccess : "always",
                            		saling : "lt",
                            		scale : "noScale",
                            		menu : "false",
                            		bgcolor : "#262626"},
                            	flashvars : {
                            		path : "http://www.rlcdamascus.com/wp-content/plugins/flagallery-skins/default/",
                            		gID : "'.$match[1][$key].'",
                            		galName : "Gallery",
                            		skinID : "sid_'.$match[1][$key].'",
                            		postID : "9618",
                            		postTitle : "'.$res['title'][0].'"},
                            	attr : {
                            		styleclass : "flashalbum",
                            		id : "sid_'.$match[1][$key].'"},
                            	start : function() {
                            		if(jQuery.isFunction(swfobject.switchOffAutoHideShow)){ swfobject.switchOffAutoHideShow(); }
                            swfobject.embedSWF("http://www.rlcdamascus.com/wp-content/plugins/flagallery-skins/default/gallery.swf", "sid_'.$match[1][$key].'_div", "100%", "100%", "10.1.52", "http://www.rlcdamascus.com/wp-content/plugins/flash-album-gallery/skins/expressInstall.swf", this.flashvars, this.params , this.attr );
                            swfobject.createCSS("#sid_'.$match[1][$key].'","outline:none");
                            	}
                            }
                            sid_'.$match[1][$key].'_div.start();
                            </script></p>';
            $string=str_replace($match[0][$key],$embed,$string);
        }
        return $string;
    }
    function view_album($string)
    {
        preg_match_all('/\[album\](.*)\[\/album\]/sU', $string, $match,PREG_PATTERN_ORDER);
        foreach($match[0] as $key=>$value)
        {
            if(is_dir($match[1][$key]))
            {
                $folder=dir($match[1][$key]);
                while($files=$folder->read())
                {
                    $ext=substr($files,-4);
            		if(($ext==".jpg" || $ext==".png" || $ext==".gif") && !is_dir($match[1][$key].'/'.$files))
                    {
                      $pics[]=$files;//print($files.'<br />');
                    }
                 }
                 if(count($pics)>0)
                 {
                    $embed='<table width="680" border="0" bgcolor="#000000" align="center"><tr>';
                    $k=1;
                    foreach($pics as $j=>$image)
                    {
                        $thumb=str_replace('upload/images','upload/_thumbs/Images',$match[1][$key]);
                        $embed.='<td align="center"><a href="'.$match[1][$key].'/'.$image.'" target="_blank"><img src="'.$thumb.'/'.$image.'" width="100" /></a></td>';
                        
                        if($k%6==0){$embed.="</tr><tr>";}
                        $k++;
                    }
                    $embed.="</table>";
                    $string=str_replace($match[0][$key],$embed,$string);
                }
            }            
        }
        return $string;
    }
    function clean_scratch($string)
    {
        $string=str_replace('<wbr>','',$string);
        $string=str_replace('</wbr>','',$string);
        return $string;
    }
    function embed_($text='')
    {
        if(empty($text))
        {
            return $text;
        }
        else
        {
            $text =self::clean_scratch($text);
            $text=self::process_urls($text);
            $text=self::view_album($text);
            $text=self::_youtube_($text);
            return $text;
        }
    }
    function embed_news($text='')
    {
        if(empty($text))
        {
            return $text;
        }
        else
        {
            //$text=self::process_urls($text);
            $text =self::clean_scratch($text);
            $text =self::get_text_hyper($text,'/<a.*href="http.*youtu.*>(.*)<\/a>/sU');
            $text =self::get_text_hyper($text,'/<a.*href="http.*rlcdamascus.com\/wp.*>(.*)<\/a>/sU');
            $text =self::get_text_hyper($text,'/<a.*href>*rlcdamascus.com\/\?.*>(.*)<\/a>/sU');
            $text =self::get_text_hyper($text,'/<a href="http.*docs.google.com\/.*>(.*)<\/a>/sU');
            $text=self::view_album($text);
            $text=self::_youtube_($text);
            //$text=self::youtube_($text);
            return $text;
        }
    }
    function embed_rep($text='')
    {
        if(empty($text))
        {
            return $text;
        }
        else
        {
            $text=str_replace('[embed]',' ',$text);
            $text=str_replace('[/embed]',' ',$text);
            //$text=self::process_urls($text);            
            $text =self::clean_scratch($text);
            $text =self::get_text_hyper($text,'/<a.*href="http.*youtu.*>(.*)<\/a>/sU');
            $text =self::get_text_hyper($text,'/<a.*href="http.*rlcdamascus.com\/wp.*>(.*)<\/a>/sU');
            $text =self::get_text_hyper($text,'/<a.*href>*rlcdamascus.com\/\?.*>(.*)<\/a>/sU');
            $text =self::get_text_hyper($text,'/<a href="http.*docs.google.com\/.*>(.*)<\/a>/sU');
            //$text=self::formatUrlsInText($text);
            //$text=self::youtube($text);
            $text=self::album($text);
            $text=self::view_album($text);
            $text=self::_youtube_($text);
            //$text=self::formatUrlsInText($text);
            return $text;
        }
    }
}?>