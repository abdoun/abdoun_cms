// JavaScript Document
var Photo_Lib = new Object();


Photo_Lib.open_photo_library = function(f,s,a,w,oo){
//c = f;
//clear()


document.getElementById('transparency').style.display = 'block';
document.getElementById(f).style.display = 'none';
window.tab.location.href = "photo_library.php?field="+s+"&file="+a+"&table="+f+"&filter="+w+"&folder="+oo;
//alert("photo_library.php?field="+s+"&file="+a+"&table="+f+"&filter="+w+"&folder"+oo);
//document.getElementById('tab').style.display = 'block';
//document.getElementById('ifr').style.display = 'none';document.getElementById('ss'+f).style.display = '';
}
Photo_Lib.ChooseFile = function(fileInput,newValueTag,value){
	//alert("sdf");
Photo_Lib.clearFileInputField(fileInput);
window.top.mainWindow_content.document.getElementById(fileInput).style.display = 'none';

window.top.mainWindow_content.document.getElementById(newValueTag).style.display = '';
window.top.mainWindow_content.document.getElementById(newValueTag).value = value;





}


Photo_Lib.filetypes = function(f,tagId,errormessage,filter){
			//alert("called");
			var filetypes = filter.split(",");
			//alert(filetypes.length);
			is = false;
			for(i = 0; i < filetypes.length ; i++){
				s  = f.value.toLowerCase();
				if(s.indexOf(filetypes[i]) > -1){
				is = true;

				
				}
				}
			if(!is){
				alert(errormessage);
				Photo_Lib.clearFileInputField(tagId)
				}
			
			}


	Photo_Lib.clearFileInputField = function(tagId) {
		
    window.top.mainWindow_content.document.getElementById(tagId).innerHTML = 
                  window.top.mainWindow_content.document.getElementById(tagId).innerHTML;
}

Photo_Lib.resetPhoto = function(tagId,tValue) {
		document.getElementById(tagId).style.display = '';
		document.getElementById(tValue).style.display = 'none';
		document.getElementById(tValue).value = '';
    document.getElementById(tagId).innerHTML = 
                    document.getElementById(tagId).innerHTML;
	
					
}