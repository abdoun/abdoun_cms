// JavaScript Document
var Ajax_Windows = new Object();


Ajax_Windows.win1 = null;







// alert(screen.width);


Ajax_Windows.openMainWindow = function(url,div,title1) {
	   // var win = null;
	//   alert(url);
  var index = 1;
	  width = screen.width * 80 / 100;
	  width1 = width / 2;
	  height = screen.height * 80 / 100 - 150;
	  
	  
	  left = screen.width / 2 - width1;
	  
	  
	 // debug($('modal_window_content'))
	
	 if(url){
		 
		Ajax_Windows.mainWindow = new Window('mainWindow', {className: "dialog", title: title1,top:50, left:left,  width:width, height:height, zIndex:150, opacity:1, resizable: false, draggable: false,url:""+url+"", minimizable: false })
	 }
	 
		//win.getContent().innerHTML = "Hi"
		if(div){
			// alert(div);
		Ajax_Windows.mainWindow.setContent(div);
		}
		Ajax_Windows.mainWindow.setDestroyOnClose();
		//win.setCloseCallback(Ajax_Windows.als)
		Ajax_Windows.mainWindow.show(true);	
	}




  Ajax_Windows.openModalDialog1 = function(url,div,title1) {
	   // var win = null;
  var index = 1;
	  width = screen.width * 80 / 100;
	  width1 = width / 2;
	  height = screen.height * 80 / 100 - 150;
	  
	  
	  left = screen.width / 2 - width1;
	  
	  
	 // debug($('modal_window_content'))
	
	 if(url){
		 
		Ajax_Windows.win1 = new Window('modal_window1', {className: "dialog", title: title1,top:50, left:left,  width:width, height:height, zIndex:150, opacity:1, resizable: false, draggable: false,url:""+url+"", minimizable: false })
	 }else{
		 
		Ajax_Windows.win1 = new Window('modal_window1', {className: "dialog", title: title1,top:50, left:left,  width:width, height:height, zIndex:150, opacity:1, resizable: false, draggable: false,minimizable: false}) 
		 }
		//win.getContent().innerHTML = "Hi"
		if(div){
			// alert(div);
		Ajax_Windows.win1.setContent(div);
		}
		Ajax_Windows.win1.setDestroyOnClose();
		//win.setCloseCallback(Ajax_Windows.als)
		Ajax_Windows.win1.show(true);	
	}
  
  Ajax_Windows.openModalDialog2 = function(url,div,title1) {
	   // var win = null;
  var index = 1;
	  width = screen.width * 80 / 100;
	  width1 = width / 2;
	  height = screen.height * 80 / 100 - 150;
	  
	  
	  left = screen.width / 2 - width1;
	  
	  
	 // debug($('modal_window_content'))
	
	 if(url){
		 
		Ajax_Windows.win2 = new Window('modal_window2', {className: "dialog", title: title1,top:50, left:left,  width:width, height:height, zIndex:150, opacity:1, resizable: false, draggable: false,url:""+url+"",minimizable: false })
	 }else{
		 
		Ajax_Windows.win2 = new Window('modal_window2', {className: "dialog", title: title1,top:50, left:left,  width:width, height:height, zIndex:150, opacity:1, resizable: false, draggable: false, minimizable: false}) 
		 }
		//win.getContent().innerHTML = "Hi"
		if(div){
			// alert(div);
		Ajax_Windows.win2.setContent(div);
		}
		Ajax_Windows.win2.setDestroyOnClose();
		//win.setCloseCallback(Ajax_Windows.als)
		Ajax_Windows.win2.show(true);	
	}
  
  
  Ajax_Windows.closeWin1 = function(){
	 // alert("ss");
Ajax_Windows.win1.setDestroyOnClose();
	  Ajax_Windows.win1.close()
	  }
	  
	    Ajax_Windows.closeWin2 = function(){

Ajax_Windows.win2.setDestroyOnClose();
	  Ajax_Windows.win2.close()
	  }
	  
	 Ajax_Windows.closeMainWindow = function(){

Ajax_Windows.mainWindow.setDestroyOnClose();
	  Ajax_Windows.mainWindow.close()
	  } 
	  
	  
	  
	 Ajax_Windows.openCube = function(url,div,title1){
		 
		fwidth = window.top.document.getElementById('mainWindow').style.width;
		//height = window.top.frames['modal_window1'].style.height;
		//alert(width);
		width = 500;
	  width1 = width / 2;
	  //height = screen.height * 80 / 100 - 150;
	  
	  
	  left = parseInt(fwidth) / 2 - width1;
	 // alert(left);
		
		//alert(width);
		if(url){
		 
		Ajax_Windows.winCube = new Window('winCube', {className: "alphacube", title: title1,top:50, left:left,  width:width, height:250, zIndex:150,  resizable: false, draggable: false,url:""+url+"",minimizable: false })
	 }else{
		 
		Ajax_Windows.winCube = new Window('winCube', {className: "dialog", title: title1,top:50, left:left,  width:250, height:250, zIndex:150, resizable: false, draggable: false, minimizable: false}) 
		 }
		//win.getContent().innerHTML = "Hi"
		if(div){
			// alert(div);
		Ajax_Windows.winCube.setContent(div);
		}
		Ajax_Windows.winCube.setDestroyOnClose();
		//win.setCloseCallback(Ajax_Windows.als)
		Ajax_Windows.winCube.show(true);
		
		 
		 } 
  
  Ajax_Windows.openDialog = function (id) {
	   // var win = null;
 // var index = 1;
	  Dialog.alert($(id).innerHTML, {className: "alphacube",  width:250})
	  
  }
  
  
  Ajax_Windows.openCubeMain = function(url,div,title1){
		 
		fwidth = screen.width;
		//height = window.top.frames['modal_window1'].style.height;
		//alert(width);
		width = 500;
	  width1 = width / 2;
	  //height = screen.height * 80 / 100 - 150;
	  
	  
	  left = parseInt(fwidth) / 2 - width1;
	 // alert(left);
		
		//alert(width);
		if(url){
		 
		Ajax_Windows.winCube = new Window('winCube', {className: "alphacube", title: title1,top:50, left:left,  width:width, height:250, zIndex:150,  resizable: false, draggable: false,url:""+url+"",minimizable: false })
	 }else{
		 
		Ajax_Windows.winCube = new Window('winCube', {className: "dialog", title: title1,top:50, left:left,  width:250, height:250, zIndex:150, resizable: false, draggable: false, minimizable: false}) 
		 }
		//win.getContent().innerHTML = "Hi"
		if(div){
			// alert(div);
		Ajax_Windows.winCube.setContent(div);
		}
		Ajax_Windows.winCube.setDestroyOnClose();
		//win.setCloseCallback(Ajax_Windows.als)
		Ajax_Windows.winCube.show(true);
		
		 
		 } 
  
  Ajax_Windows.openDialog = function (id) {
	   // var win = null;
 // var index = 1;
	  Dialog.alert($(id).innerHTML, {className: "alphacube",  width:250})
	  
  }
  
  
  
Ajax_Windows.closeCube = function(){
	Ajax_Windows.winCube.setDestroyOnClose();
	  Ajax_Windows.winCube.close()
	}
