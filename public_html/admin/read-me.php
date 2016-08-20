<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? include("ajax_window_include_files.php"); 


?><script language="javascript" src="scripts/Httprequest.class.js" ></script>
<title>Untitled Document</title>
</head>

<body>
<div id="bTarTd"></div>
<?


?>
<a href="javascript:Ajax_Windows.openMainWindow('http://google.com','','Window');" style="color:#000;">Main Window</a><br />
<a href="javascript:hpReq.getData('home.php?d='+new Date().getTime(),'bTarTd');" style="color:#000;">Request</a>


<br />

</body>
</html>