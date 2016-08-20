// JavaScript Document

var Tree_Builder_PHP = new Object();

Tree_Builder_PHP.showHide = function(num){
	//alert(num);
	if(document.getElementById('tbNum'+num).style.display == ""){
	document.getElementById('tbNum'+num).style.display = "none";
	document.getElementById('imgNum'+num).src = "images/expand_f.gif";
	}else{
		document.getElementById('tbNum'+num).style.display = "";
		document.getElementById('imgNum'+num).src = "images/expand_uf.gif";
		}
	
	}