// JavaScript Document
var Tools = new Object();
Tools.checkForm = function(mess,fields){
  
   am=fields.split(",");

for(i = 0 ; i < am.length;i++){
	
if(document.getElementById(am[i]).value == '' || document.getElementById(am[i]).value == 0){
	alert(mess);
	return false;
	}
}


	}
	
	Tools.getSearchQuery = function(){
	return document.getElementById('q').value;
		
		}
	
	
	
	
	
Tools.confirmBoxOne = function(mess){
	
	if(confirm(mess)){
		
		return true;
		}else{
			return false;
			}
	
	}
	
	
	Tools.getSelectedList = function(listId,textId){
		ff = document.getElementById(listId);
	//	alert(ff.options.length);
	ss = "";
	//d = ff.options.length-10;
	
		for(i =0 ; i <ff.options.length;i++){
			
			//alert(i);
			
			if(ff.options[i].selected){
				

					ss += ff.options[i].value+",";
				
			}
			
			}
			ss = ss.substr(0,ss.lastIndexOf(","));
			document.getElementById(textId).value = ss;
		}
	
	Tools.fileTypes = function(fileName,tagId,errormessage,filter){
			//alert("called");
		//	alert("ss");
			var filetypes = filter.split(",");
			//alert(filetypes.length);
			is = false;
			
			for(i = 0; i < filetypes.length ; i++){
				s  = fileName.value.toLowerCase();
				if(s.indexOf(filetypes[i]) > -1){
				is = true;

				
				}
				}
				
			if(!is){
				alert(errormessage);
				Tools.clearFileInputField(tagId)
				}
			
			}
	
	Tools.clearFileInputField = function(tagId) {
		
    document.getElementById(tagId).innerHTML = document.getElementById(tagId).innerHTML;
}
	
	
Tools.fillSelectCats = function(value,bb,multi){
	//alert(multi);
	if(document.getElementById('cats').value == ""){
		document.getElementById('cats').value += value;
		document.getElementById('catsName').value += document.getElementById(bb).value;
		
	}else{
	document.getElementById('cats').value += ","+value;
	document.getElementById('catsName').value += ","+document.getElementById(bb).value;
	}


	if(multi == ""){
		Tools.diselectAll(value);
		document.getElementById('cats').value = value;
		document.getElementById('catsName').value = document.getElementById(bb).value;
		
	}

	}	
	
	Tools.diselectAll = function(val){
		num = 0 ;
		while(document.getElementById('radio'+num)){
			if(document.getElementById('radio'+num).value != val){
			document.getElementById('radio'+num).checked = false;
			}
			num++;
			}
		
		
		}
	
	Tools.disallowMultiple = function(value){
		/*
				ss  = document.getElementById('cats').value;
		ss = ss.split(",");
		
				if(ss.length == 1){
			
			document.getElementById('cats').value = "0";
			
			}else{
		document.getElementById('cats').value = value;
			}
			document.getElementById('cats').value = value;*/
		}
	
	
	
	
	
	
	
	Tools.removeSelectCat  = function(value,bb){
		ss  = document.getElementById('cats').value;
		ss = ss.split(",");
		
				jj  = document.getElementById('catsName').value;
		jj = jj.split(",");
		
		document.getElementById('cats').value = "";
		document.getElementById('catsName').value = "";
	//alert(ss.length);
		for(i = 0 ; i < ss.length;i++){
			if(ss[i] != value){
				document.getElementById('cats').value += ss[i]+",";
				document.getElementById('catsName').value += jj[i]+",";
				}
			}
			/*
				tt  = document.getElementById('cats').value;
				document.getElementById('cats').value = "";
		tt = tt.split(",");	
		
				for(c = 0 ; c < tt.length;c++){
			if(tt[c] != ""){
				document.getElementById('cats').value += tt[c]+",";
					
				}
			}
		
		var po = document.getElementById('cats').value;
		
		
		po = po.substr(0,po.lastIndexOf(","));
		if(po != ""){
			document.getElementById('cats').value = po;
		
			document.getElementById('catsName').value = document.getElementById(bb).value;
			}
			
*/

var po = document.getElementById('cats').value;
var so = document.getElementById('catsName').value;
		
		po = po.substr(0,po.lastIndexOf(","));
		so = so.substr(0,so.lastIndexOf(","));
		if(po != ""){
			document.getElementById('cats').value = po;
			document.getElementById('catsName').value = so;
		
			
			}
		
		}
	
	
Tools.confirmBoxTwo = function(mess,mess2){
	
	if(confirm(mess)){
		if(confirm(mess2)){
			return true;
		}else{
			
			return false;
			}
		
		}else{
			return false;
			}
	
	}	