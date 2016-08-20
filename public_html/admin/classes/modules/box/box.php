<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class box 
{
    function goto_($page,$alert="")
    {
     ?>
    	<script type="text/javascript">
    	<?php
    	 if($alert!="")
    	 {
    	  print("alert('".$alert."');");
    	 }
    	 ?>
    	location.href="<?php print($page);?>";	
    	</script>
     <?php
    }
    function alert($msg)
    {
    	if($msg!="")
    	 {
    	 	?>
    		<script type="text/javascript">
    		<?php
    		print("alert('".$msg."');");
    		?></script><?php
    	 }
    }
    function href($uri='',$div='bTarTd')
    {
        //$return=str_replace('?','?page='.$this->params[page].'&'.$this->uri.'&',$link_self);
        $return="javascript:hpReq.getData('main.php?d='+new Date().getTime()+'&".$uri."','$div');";
        //$return="_.get('main.php?d='+new Date().getTime()+'&".$uri."',function(data){_('#".$div."').html(data);});";
        return $return;
    }
    function href_req($uri='',$div='bTarTd')
    {
        //$return=str_replace('?','?page='.$this->params[page].'&'.$this->uri.'&',$link_self);
        //$return="javascript:hpReq.getData('main.php?d='+new Date().getTime()+'&".$uri."','$div');";
        $return.="_('#".$div."').html('<div style=\'background:#ffffff;width:30%;margin-right:auto;margin-left:auto;text-align:center\'><img src=\'images/loading.gif\' border=\'0\'/></div>');";
        $return.="_.get('main.php?d='+new Date().getTime()+'&".$uri."',function(data){_('#".$div."').html(data);});";
        return $return;
    }
    function post($form='',$div='bTarTd')
    {
        $return="javascript:post('$form','$div');";
        return $return;
    }
    function popup($uri='')
    {
        $return="javascript:Ajax_Windows.openMainWindow('main.php?d='+new Date().getTime()+'&".$uri."','','Window');";
        return $return;
    }
    function showSuccesMessage($url,$pars,$mess = "تمت العملية بنجاح",$img='good_or_tick.png',$div='bTarTd')
    {
		?>		
		<center><img src="images/<?=$img;?>" /><? echo($mess);?></center>
        <script language="javascript">
        setTimeout("window.top.hpReq.getData('<? echo($url);?>?d='+new Date().getTime()+'<? echo($pars);?>','<?=$div;?>')",500);
        setTimeout('window.parent.Ajax_Windows.closeMainWindow()',700);
        </script>
		<?		
    }	
}?>