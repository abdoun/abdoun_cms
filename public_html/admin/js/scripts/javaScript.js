var request;
//---------------------------------------------------------------//
function debug(text) {
	if (debug_mode) alert("RSD: " + text)
}
//---------------------------------------------------------------//
function HTTPObject() {
	var ajx;
	if(window.ActiveXObject) {
		if(_XML_ActiveX) {
			ajx = new ActiveXObject(_XML_ActiveX);
		} else {
			var versions = ["MSXML2.XMLHTTP", "Microsoft.XMLHTTP", "Msxml2.XMLHTTP.7.0", "Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.5.0", "Msxml2.XMLHTTP.4.0", "MSXML2.XMLHTTP.3.0"];
			for (var i = 0; i < versions.length; i++) {
				try {
					ajx = new ActiveXObject(versions[i]);
					if (ajx) {
						var _XML_ActiveX = versions[i];
						break;
					}
				}
				catch (e) {}
			}
		}
	}
	if(!ajx && typeof XMLHttpRequest != undefined) {
		try {
			ajx = new XMLHttpRequest();
		}
		catch (e) {
		        Alrt("This browser does not support AJAX!");
			ajx = false;
		}
	} return ajx;
}
//---------------------------------------------------------------//
function post(formid,tag) {
	request = HTTPObject();
	var action = document.getElementById(formid).action;
	var post_data = GetDataFrom(formid) ;
	tagid=tag;
	//tagid = 'form_result';
	request.onreadystatechange = WriteTag;
	request.open('POST', action, true);
	
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.setRequestHeader('charset','utf-8');
	request.setRequestHeader('Accept-Charset','utf-8');
	request.send(post_data);
}
//---------------------------------------------------------------//
function get(url, tag) {
	request = HTTPObject();
	if (tag) tagid = tag;
	else tagid ='';
	request.onreadystatechange = WriteTag;
	myRand = parseInt(Math.random()*9999999999);
	url=url + "rand=" + myRand;
	request.open('GET', url, true);
	request.send(null);
	
}
//---------------------------------------------------------------//
function WriteTag() {
	if (request.readyState == 4) {
		if (request.status == 200) {
			var textout = request.responseText;
		} else {
			var textout = 'There was a problem with the request.';
		}
		if (tagid=='') {
	    	document.write(textout);
		} else {
			document.getElementById(tagid).innerHTML = textout;
		}
	}
	else
	  {
	   document.getElementById(tagid).innerHTML="<br /><br /><center><img src='images/loading.gif' border='0'/></center><br /><br /><br />";
	  }
}
//---------------------------------------------------------------//
function GetDataFrom(formid) {
	if (document.getElementById(formid).length > 0) {
		var i, n, v, s;
		s  = 'rs=on&';
		for (i=0; i < document.getElementById(formid).length; i++) {
			n = document.getElementById(formid).elements[i].name;
			v = document.getElementById(formid).elements[i].value;
			s = s + n + '=' + v + '&';
		}
		return s;
	} else return false;
}
//---------------------------------------------------------------//