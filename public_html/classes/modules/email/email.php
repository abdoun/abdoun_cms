<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class email 
{
    function send($subject,$from,$name,$to,$body,$file='')
    {
        $headers = "From:  $from  \n";
        if($file!='')
        {
            //echo $file['name'];
			$filename=$file['name'];
			$filetemp=$file['tmp_name'];
			$Content = fread(fopen($filetemp,"r"),$file['size']);
			$Content = chunk_split(base64_encode($Content));
			$Part = strtoupper(md5(uniqid(time())));
	
			// Get Attacment File Name
			$AttachmentName=$filename;
	
			$Type = $file['type'];
			if (stristr($AttachmentName,".gif")) {$Type="image/gif";}
			if (stristr($AttachmentName,".jpg")) {$Type="image/pjpeg";}
			if (stristr($AttachmentName,".bmp")) {$Type="image/bmp";}
			//echo $Type;
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-Type: multipart/mixed; boundary=$Part\n";
			$headers .= "--$Part\n";
			$headers .= "Content-Type: text/html; charset=utf-8\n";
			$headers .= "Content-Transfer-Encoding: quoted-printable\n\n";
			$headers .= "$body\n";
			$headers .= "--$Part\n";
			$headers .= "Content-Type: $Type;\n name=\"$AttachmentName\"\n";
			$headers .= "Content-Transfer-Encoding: base64\n";
			$headers .= "Content-Disposition: attachment;\n filename=\"$AttachmentName\"\n\n";
			$headers .= "$Content\n";
			$headers .= "--$Part--";
//						echo "<div dir='ltr' style='text-align:left;float:left;'>to:".$to."<br />";
//                        echo "subject:".$subject."<br />";
//                        echo "from:".$from."<br />";
//                        echo "name:".$name."<br />";
//                        echo "header:".nl2br($headers)."</div>";
				if(!@mail ($to,$subject,"",$headers))
                {
                    return false;
                }
                else
                {
                    return true;
                }
			}
            else
            {
				$headers .= "Content-Type: text/html; charset=utf-8\n";
				if(!@mail ($to, $subject,$body,$headers))
                {
                    return false;
                }
                else
                {
                    return true;
                }
			}
    }
}?>