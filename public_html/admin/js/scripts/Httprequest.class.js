
var hpReq = new Object();

hpReq.activeUrlBody = "";
hpReq.activeUrlLeft = "";
hpReq.createXMLHttpRequest = function() {
	
   try { return new XMLHttpRequest(); } catch(e) {}
   try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
   alert("XMLHttpRequest not supported");
  
   return null;
 }

 
 hpReq.getData = function(url,contentDiv){
	 
//	 document.getElementById('exlTarTd').innerHTML = "";
hpReq.activeUrlBody = url;
tt = url.indexOf("?");

if(tt == -1){
	url = url+"?d="+new Date().getTime();
	
	}else{
		url = url+"&d"+new Date().getTime();
		
		}

	document.getElementById(contentDiv).innerHTML = '<div width="100%" align="center"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="40" height="40"><param name="movie" value="images/loading.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><object type="application/x-shockwave-flash" data="images/loading.swf" width="40" height="40"><param name="quality" value="high" /> <param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><div> <h4>Content on this page requires a newer version of Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p></div></object></object><script type="text/javascript">swfobject.registerObject("FlashID");</script></div>';

	 xhReq.open("GET", url, true);

 
 
 xhReq.onreadystatechange = function() {
   if (xhReq.readyState != 4)  { return; }
   var serverResponse = xhReq.responseText;

 
//alert(serverResponse);
/*first = serverResponse.indexOf("///")+3;
last = serverResponse.lastIndexOf("///")-3;

var tt = serverResponse.substr(first,last);
hh = "sss";*/
  document.getElementById(contentDiv).innerHTML = serverResponse;
	
  
 

 }
 
 
 
 
xhReq.send(null);
	 }
	 
	 
	 hpReq.getData1 = function(url,contentDiv){
hpReq.activeUrlBody = url;
//document.getElementById('exlTarTd').innerHTML = "";
tt = url.indexOf("?");

if(tt == -1){
	url = url+"?d="+new Date().getTime();
	
	}else{
		url = url+"&d"+new Date().getTime();
		
		}

	document.getElementById(contentDiv).innerHTML = '<div width="100%" align="center"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="40" height="40"><param name="movie" value="images/loading.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><object type="application/x-shockwave-flash" data="images/loading.swf" width="40" height="40"><param name="quality" value="high" /> <param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><div> <h4>Content on this page requires a newer version of Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p></div></object></object><script type="text/javascript">swfobject.registerObject("FlashID");</script></div>';

	 xhReq1.open("GET", url, true);

 
 
 xhReq1.onreadystatechange = function() {
   if (xhReq1.readyState != 4)  { return; }
   var serverResponse = xhReq1.responseText;

 

	  document.getElementById(contentDiv).innerHTML = serverResponse;
	
  
 

 }
 
 
 
 
xhReq1.send(null);
	 }
	  
	 
	 
	 
hpReq.getXmlData = function(url,contentDiv){ 
tree = null;
//document.getElementById('exlTarTd').innerHTML = "";

tt = url.indexOf("?");

if(tt == -1){
	url = url+"?d="+new Date().getTime();
	
	}else{
		url = url+"&d"+new Date().getTime();
		
		}


document.getElementById(contentDiv).innerHTML = '<div width="100%" align="center"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="40" height="40"><param name="movie" value="images/loading.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><object type="application/x-shockwave-flash" data="images/loading.swf" width="40" height="40"><param name="quality" value="high" /> <param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><div> <h4>Content on this page requires a newer version of Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p></div></object></object><script type="text/javascript">swfobject.registerObject("FlashID");</script></div>';
xhReq.open("GET", url, true);
xhReq.onreadystatechange = function() {
if (xhReq.readyState != 4)  { return; }
var serverResponse = xhReq.responseText;

xmlDoc = Tree_Creator.convertToXML(serverResponse);

tree = Tree_Creator.createTree(xmlDoc);

document.getElementById(contentDiv).innerHTML = tree;

 }
 
xhReq.send(null);
	 }
	 
	 
	 
	 
hpReq.getCatXmlData = function(url,contentDiv){ 
tree = null;
//document.getElementById('exlTarTd').innerHTML = "";

tt = url.indexOf("?");

if(tt == -1){
	url = url+"?d="+new Date().getTime();
	
	}else{
		url = url+"&d"+new Date().getTime();
		
		}


document.getElementById(contentDiv).innerHTML = '<div width="100%" align="center"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="40" height="40"><param name="movie" value="images/loading.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><object type="application/x-shockwave-flash" data="images/loading.swf" width="40" height="40"><param name="quality" value="high" /> <param name="wmode" value="transparent" /><param name="swfversion" value="6.0.65.0" /><param name="expressinstall" value="scripts/expressInstall.swf" /><div> <h4>Content on this page requires a newer version of Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p></div></object></object><script type="text/javascript">swfobject.registerObject("FlashID");</script></div>';
xhReq2.open("GET", url, true);
xhReq2.onreadystatechange = function() {
if (xhReq2.readyState != 4)  { return; }
var serverResponse = xhReq2.responseText;

xmlDoc = Tree_Creator.convertToXML(serverResponse);

tree = Tree_Creator.createTree(xmlDoc);

document.getElementById(contentDiv).innerHTML = tree;

 }
 
xhReq2.send(null);
	 }	 
	 
	 
	
	 
var xhReq = null;
var xhReq1 = null;
var xhReq2 = null;

	

  
	
 xhReq = hpReq.createXMLHttpRequest();
  xhReq1 = hpReq.createXMLHttpRequest();
  xhReq2 = hpReq.createXMLHttpRequest();
 
  


 
