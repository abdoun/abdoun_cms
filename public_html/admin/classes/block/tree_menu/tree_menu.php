<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @name tree_menu
 */
class tree_menu
{
	function menu($iid='',$nbsp=0,$id_show="")
    {
    	//$sql="select id,title,`type`,`parent`,`language` from content where `type`<>'' and `type`<>'body' and `type`<>'ext' and `type`<>'image' and `parent`='$iid' order by ordered";
        $sql="select id,title,`type`,`parent`,`language` from content where `parent`='$iid' and `type`<>'' and (`type`='sec' || `type`='news' || `type`='books' || `type`='vedio' || `type`='pro' || `type`='sound') order by language desc,ordered";
        $resu1=mysql_query($sql)or print(mysql_error()." 95 ");
        $nbsp++;
        while($resu01=mysql_fetch_array($resu1))
        	{
        	   if($resu01['type']==''){$type=mysql_db::get_records("select `type` from content where id='".$resu01['parent']."'");$type=$type[0][0];}else{$type=$resu01['type'];}
               $no=mysql_fetch_row(mysql_query("select count(*) from content where `parent`='".$resu01['id']."'"));
        		if($iid=='')
            		{?>
            		<div id="div_<?=$resu01[id];?>" style="text-align:right;background-color:#f0f0f0;border-width: 1px;border-color: #969696;border-style: solid;" dir="rtl"><span dir="rtl" style="text-align:right;" id="span_<?=$resu01[id];?>"><a style="text-align:right;font-size:11px;font-family:tahoma;text-decoration:none;" href="<?if($resu01['type']=="ext" || $resu01['type']=="body" || $resu01['type']==""){print(box::popup("page=content&class=".$type."&event=form&id=$resu01[id]&parent=$resu01[parent]"));}else{print(box::href("page=content&class=".$resu01['type']."&div=body&id=".$resu01['id']."",'body'));}?>"><b><?=$resu01[title]?></b></a>(<?php  echo $no[0];?>)</span><?php //menu($resu01[id],$nbsp,$id_show);?></div><div style="height: 2px;font-size: 1px;"> </div>
            		<script type="text/javascript">
            		<?php  //self::get_ids($resu01[id]);?>
            		</script><?php self::menu($resu01[id],$nbsp,$id_show);
        		}
        		else
        		{        		  
            		?><div id="div_<?=$resu01[id];?>" onmouseover="this.style.border='solid #969696 1px';" onmouseout="this.style.border='';" dir="<?php echo $get_lang[direction];?>" style="padding-right:<?php if($nbsp>0){echo($nbsp*3);}?>px;"> <span id="span_<?=$resu01[id];?>"><a style="font-family:tahoma;font-size:;text-decoration:none;" href="<?if($resu01['type']=="ext" || $resu01['type']=="body" || $resu01['type']=="" || $resu01['type']=="image" || $resu01['type']=='link'){print(box::popup("page=content&class=".$type."&event=form&id=$resu01[id]&parent=$resu01[parent]"));}else{print(box::href("page=content&class=".$resu01['type']."&div=body&id=".$resu01['id']."",'body'));}?>"><?php print($resu01[title]);?></a>(<?php echo $no[0];?>)</span><?php self::menu($resu01[id],$nbsp,$id_show);?></div><div style="height: 2px;font-size: 1px;"> </div><?php	
            		?><script type="text/javascript">
            		//$("#div_<?=$resu01[id];?>").hide();
            		<?php //self::get_ids($resu01[id]);?>
            		</script><?php
        		}
        		
        		//self::menu($resu01[id],$nbsp,$id_show);
        	}
        	?><script type="text/javascript">
        	<?php //self::get_ids($resul1[id]);?>
        	</script><?php			 
    }
    function get_ids($id)
    {
      $re=mysql_query("select id from content where `parent`='$id' and `type`<>''")or print(mysql_error()." 167 ");
      while($res=mysql_fetch_row($re))
      {
        ?>//$("#span_<?=$id;?>").click(function(){$("#div_<?=$res[0];?>").slideToggle('slow');});<?php
        //self::get_ids($res[0]);
      }
    }
}?>