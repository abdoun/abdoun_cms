// JavaScript Document
var Flash_Upload = new Object();

Flash_Upload.uplompleteFunction = function(name,ff){
	document.getElementById(name).value = ff;
	document.getElementById('d'+name).innerHTML = ff;
	}
	
	
	
	Flash_Upload.enableForm = function(name,ff){
		//alert(ff);
		document.getElementById('submit').disabled = ff;
		}