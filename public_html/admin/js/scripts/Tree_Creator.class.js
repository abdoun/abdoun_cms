// JavaScript Document
var Tree_Creator = new Object();
Tree_Creator.content = "";
Tree_Creator.gI = 0;
Tree_Creator.gM = 0;
Tree_Creator.gL = 5;
Tree_Creator.toExpand = "";
Tree_Creator.treeLinks = "treeLinks";
Tree_Creator.startTree = function(){
	var wer = "<table >";
	
	return wer;
	}
	
	Tree_Creator.createItem = function(num,title,link1,padding){
		//alert(sub_elements.length);
		//alert(num);
		padding = padding * 20;
class1 = "treeLinks";
var wer = "<tr><td style='padding-left:"+padding+"px'><img id='img"+num+"' onclick='Tree_Creator.showHide(\"sub"+num+"\",\"img"+num+"\")' src='images/expand.gif'><img src='images/file_c.png'><a href='"+link1+"' class='"+class1+"'>"+title+"</a></td></tr>";

return wer;
		
		}
		

	Tree_Creator.showHide = function(divId,img){
	//	alert('ss');

	
	divId1 = divId;
	if(document.getElementById(divId1)){
		if(document.getElementById(divId1).style.display == "none"){
			document.getElementById(divId1).style.display = "";
			document.getElementById(img).src = "images/expand_uf.gif";
			
			}else{
				
				document.getElementById(divId1).style.display = "none";
				document.getElementById(img).src = "images/expand_f.gif";
				}
	}
	
		}
		
	
	
	
	
	Tree_Creator.endTree = function(){
		var wer = "</table>"
	
	return wer;
	
	
	}
	
	
	
	Tree_Creator.createTree = function(xmlDoc){

Tree_Creator.content = "";


	elementsNum = xmlDoc.getElementsByTagName("item");

	//alert(elementsNum.length);
	for(i = 0 ; i < elementsNum.length;i++){
		
	 
	}
	//Tree_Creator.content += Tree_Creator.startTree();
	
Tree_Creator.getElements0(elementsNum,0);
//	Tree_Creator.content += Tree_Creator.endTree();
	
	//alert(Tree_Creator.toExpand);
	return Tree_Creator.content;

	}
	
Tree_Creator.convertToXML = function(text1){
		
		 
		 if (window.DOMParser)
  {
  parser=new DOMParser();
  xmlDoc=parser.parseFromString(text1,"text/xml");
  }
else // Internet Explorer
  {
  xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
  xmlDoc.async="false";
  xmlDoc.loadXML(text1);
  }
  //return xmlDoc;
return xmlDoc;
  
  
		 }
	
	
	
	
	
	///////////////////
	
	
	
	
	
	
	
	
	Tree_Creator.getElements0 = function(elementsNum,parents){
	//alert(elementsNum.length);
	
for(o0 =0 ; o0 < elementsNum.length;o0++){

id = elementsNum[o0].getAttribute("id");
parents1 = elementsNum[o0].getAttribute("parent");
title = elementsNum[o0].getAttribute("title");
link1 = elementsNum[o0].getAttribute("link");
isSub = elementsNum[o0].getAttribute("sub");
if(parents1 == parents){

sv = 0 * 20;

Tree_Creator.content += "<div id='t00"+o0+"' style='padding-left:"+sv+"px;'>";
if(isSub == 1){
Tree_Creator.content += "<img id='img00"+o0+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img00"+o0+"\")' src='images/expand_f.gif'> <img src='images/file_c.png' align='absmiddle'> <a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{
Tree_Creator.content += "<img id='img00"+o0+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img00"+o0+"\")' src='images/expand.gif'> <img src='images/file_c.png' align='absmiddle'> <a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
	}
Tree_Creator.getElements1(elementsNum,id);
Tree_Creator.content += "</div>";
}

}

}
/*

Tree_Creator.getElements1 = function(elementsNum,parents){
	sv = 1 * 20;
	Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o1 =0 ; o1 < elementsNum.length;o1++){

id = elementsNum[o1].getAttribute("id");
parents1 = elementsNum[o1].getAttribute("parent");
title = elementsNum[o1].getAttribute("title");
link1 = elementsNum[o1].getAttribute("link");
isSub = elementsNum[o1].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
	
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
	}else{
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}
//Tree_Creator.getElements2(elementsNum,id);

}

}
Tree_Creator.content += "</div>";
}
*/




Tree_Creator.getElements1 = function(elementsNum,parents){
sv = 1 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o1 =0 ; o1 < elementsNum.length;o1++){
id = elementsNum[o1].getAttribute("id");
parents1 = elementsNum[o1].getAttribute("parent");
title = elementsNum[o1].getAttribute("title");
link1 = elementsNum[o1].getAttribute("link");
isSub = elementsNum[o1].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'> <img src='images/file_c.png' align='absmiddle'> <a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'> <img src='images/file_c.png' align='absmiddle'> <a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements2(elementsNum,id);
} } Tree_Creator.content += "<br style='line-height:3px;'></div>";
}


Tree_Creator.getElements2 = function(elementsNum,parents){
sv = 2 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o2 =0 ; o2 < elementsNum.length;o2++){
id = elementsNum[o2].getAttribute("id");
parents1 = elementsNum[o2].getAttribute("parent");
title = elementsNum[o2].getAttribute("title");
link1 = elementsNum[o2].getAttribute("link");
isSub = elementsNum[o2].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements3(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements3 = function(elementsNum,parents){
sv = 3 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o3 =0 ; o3 < elementsNum.length;o3++){
id = elementsNum[o3].getAttribute("id");
parents1 = elementsNum[o3].getAttribute("parent");
title = elementsNum[o3].getAttribute("title");
link1 = elementsNum[o3].getAttribute("link");
isSub = elementsNum[o3].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements4(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements4 = function(elementsNum,parents){
sv = 4 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o4 =0 ; o4 < elementsNum.length;o4++){
id = elementsNum[o4].getAttribute("id");
parents1 = elementsNum[o4].getAttribute("parent");
title = elementsNum[o4].getAttribute("title");
link1 = elementsNum[o4].getAttribute("link");
isSub = elementsNum[o4].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements5(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements5 = function(elementsNum,parents){
sv = 5 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o5 =0 ; o5 < elementsNum.length;o5++){
id = elementsNum[o5].getAttribute("id");
parents1 = elementsNum[o5].getAttribute("parent");
title = elementsNum[o5].getAttribute("title");
link1 = elementsNum[o5].getAttribute("link");
isSub = elementsNum[o5].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements6(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements6 = function(elementsNum,parents){
sv = 6 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o6 =0 ; o6 < elementsNum.length;o6++){
id = elementsNum[o6].getAttribute("id");
parents1 = elementsNum[o6].getAttribute("parent");
title = elementsNum[o6].getAttribute("title");
link1 = elementsNum[o6].getAttribute("link");
isSub = elementsNum[o6].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements7(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements7 = function(elementsNum,parents){
sv = 7 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o7 =0 ; o7 < elementsNum.length;o7++){
id = elementsNum[o7].getAttribute("id");
parents1 = elementsNum[o7].getAttribute("parent");
title = elementsNum[o7].getAttribute("title");
link1 = elementsNum[o7].getAttribute("link");
isSub = elementsNum[o7].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements8(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements8 = function(elementsNum,parents){
sv = 8 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o8 =0 ; o8 < elementsNum.length;o8++){
id = elementsNum[o8].getAttribute("id");
parents1 = elementsNum[o8].getAttribute("parent");
title = elementsNum[o8].getAttribute("title");
link1 = elementsNum[o8].getAttribute("link");
isSub = elementsNum[o8].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements9(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements9 = function(elementsNum,parents){
sv = 9 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o9 =0 ; o9 < elementsNum.length;o9++){
id = elementsNum[o9].getAttribute("id");
parents1 = elementsNum[o9].getAttribute("parent");
title = elementsNum[o9].getAttribute("title");
link1 = elementsNum[o9].getAttribute("link");
isSub = elementsNum[o9].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements10(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements10 = function(elementsNum,parents){
sv = 10 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o10 =0 ; o10 < elementsNum.length;o10++){
id = elementsNum[o10].getAttribute("id");
parents1 = elementsNum[o10].getAttribute("parent");
title = elementsNum[o10].getAttribute("title");
link1 = elementsNum[o10].getAttribute("link");
isSub = elementsNum[o10].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements11(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements11 = function(elementsNum,parents){
sv = 11 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o11 =0 ; o11 < elementsNum.length;o11++){
id = elementsNum[o11].getAttribute("id");
parents1 = elementsNum[o11].getAttribute("parent");
title = elementsNum[o11].getAttribute("title");
link1 = elementsNum[o11].getAttribute("link");
isSub = elementsNum[o11].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements12(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements12 = function(elementsNum,parents){
sv = 12 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o12 =0 ; o12 < elementsNum.length;o12++){
id = elementsNum[o12].getAttribute("id");
parents1 = elementsNum[o12].getAttribute("parent");
title = elementsNum[o12].getAttribute("title");
link1 = elementsNum[o12].getAttribute("link");
isSub = elementsNum[o12].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements13(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements13 = function(elementsNum,parents){
sv = 13 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o13 =0 ; o13 < elementsNum.length;o13++){
id = elementsNum[o13].getAttribute("id");
parents1 = elementsNum[o13].getAttribute("parent");
title = elementsNum[o13].getAttribute("title");
link1 = elementsNum[o13].getAttribute("link");
isSub = elementsNum[o13].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements14(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements14 = function(elementsNum,parents){
sv = 14 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o14 =0 ; o14 < elementsNum.length;o14++){
id = elementsNum[o14].getAttribute("id");
parents1 = elementsNum[o14].getAttribute("parent");
title = elementsNum[o14].getAttribute("title");
link1 = elementsNum[o14].getAttribute("link");
isSub = elementsNum[o14].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements15(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements15 = function(elementsNum,parents){
sv = 15 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o15 =0 ; o15 < elementsNum.length;o15++){
id = elementsNum[o15].getAttribute("id");
parents1 = elementsNum[o15].getAttribute("parent");
title = elementsNum[o15].getAttribute("title");
link1 = elementsNum[o15].getAttribute("link");
isSub = elementsNum[o15].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements16(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements16 = function(elementsNum,parents){
sv = 16 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o16 =0 ; o16 < elementsNum.length;o16++){
id = elementsNum[o16].getAttribute("id");
parents1 = elementsNum[o16].getAttribute("parent");
title = elementsNum[o16].getAttribute("title");
link1 = elementsNum[o16].getAttribute("link");
isSub = elementsNum[o16].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements17(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements17 = function(elementsNum,parents){
sv = 17 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o17 =0 ; o17 < elementsNum.length;o17++){
id = elementsNum[o17].getAttribute("id");
parents1 = elementsNum[o17].getAttribute("parent");
title = elementsNum[o17].getAttribute("title");
link1 = elementsNum[o17].getAttribute("link");
isSub = elementsNum[o17].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements18(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements18 = function(elementsNum,parents){
sv = 18 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o18 =0 ; o18 < elementsNum.length;o18++){
id = elementsNum[o18].getAttribute("id");
parents1 = elementsNum[o18].getAttribute("parent");
title = elementsNum[o18].getAttribute("title");
link1 = elementsNum[o18].getAttribute("link");
isSub = elementsNum[o18].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements19(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements19 = function(elementsNum,parents){
sv = 19 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o19 =0 ; o19 < elementsNum.length;o19++){
id = elementsNum[o19].getAttribute("id");
parents1 = elementsNum[o19].getAttribute("parent");
title = elementsNum[o19].getAttribute("title");
link1 = elementsNum[o19].getAttribute("link");
isSub = elementsNum[o19].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements20(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements20 = function(elementsNum,parents){
sv = 20 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o20 =0 ; o20 < elementsNum.length;o20++){
id = elementsNum[o20].getAttribute("id");
parents1 = elementsNum[o20].getAttribute("parent");
title = elementsNum[o20].getAttribute("title");
link1 = elementsNum[o20].getAttribute("link");
isSub = elementsNum[o20].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements21(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements21 = function(elementsNum,parents){
sv = 21 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o21 =0 ; o21 < elementsNum.length;o21++){
id = elementsNum[o21].getAttribute("id");
parents1 = elementsNum[o21].getAttribute("parent");
title = elementsNum[o21].getAttribute("title");
link1 = elementsNum[o21].getAttribute("link");
isSub = elementsNum[o21].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements22(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements22 = function(elementsNum,parents){
sv = 22 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o22 =0 ; o22 < elementsNum.length;o22++){
id = elementsNum[o22].getAttribute("id");
parents1 = elementsNum[o22].getAttribute("parent");
title = elementsNum[o22].getAttribute("title");
link1 = elementsNum[o22].getAttribute("link");
isSub = elementsNum[o22].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements23(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements23 = function(elementsNum,parents){
sv = 23 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o23 =0 ; o23 < elementsNum.length;o23++){
id = elementsNum[o23].getAttribute("id");
parents1 = elementsNum[o23].getAttribute("parent");
title = elementsNum[o23].getAttribute("title");
link1 = elementsNum[o23].getAttribute("link");
isSub = elementsNum[o23].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements24(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements24 = function(elementsNum,parents){
sv = 24 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o24 =0 ; o24 < elementsNum.length;o24++){
id = elementsNum[o24].getAttribute("id");
parents1 = elementsNum[o24].getAttribute("parent");
title = elementsNum[o24].getAttribute("title");
link1 = elementsNum[o24].getAttribute("link");
isSub = elementsNum[o24].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements25(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements25 = function(elementsNum,parents){
sv = 25 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o25 =0 ; o25 < elementsNum.length;o25++){
id = elementsNum[o25].getAttribute("id");
parents1 = elementsNum[o25].getAttribute("parent");
title = elementsNum[o25].getAttribute("title");
link1 = elementsNum[o25].getAttribute("link");
isSub = elementsNum[o25].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements26(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements26 = function(elementsNum,parents){
sv = 26 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o26 =0 ; o26 < elementsNum.length;o26++){
id = elementsNum[o26].getAttribute("id");
parents1 = elementsNum[o26].getAttribute("parent");
title = elementsNum[o26].getAttribute("title");
link1 = elementsNum[o26].getAttribute("link");
isSub = elementsNum[o26].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements27(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements27 = function(elementsNum,parents){
sv = 27 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o27 =0 ; o27 < elementsNum.length;o27++){
id = elementsNum[o27].getAttribute("id");
parents1 = elementsNum[o27].getAttribute("parent");
title = elementsNum[o27].getAttribute("title");
link1 = elementsNum[o27].getAttribute("link");
isSub = elementsNum[o27].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements28(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements28 = function(elementsNum,parents){
sv = 28 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o28 =0 ; o28 < elementsNum.length;o28++){
id = elementsNum[o28].getAttribute("id");
parents1 = elementsNum[o28].getAttribute("parent");
title = elementsNum[o28].getAttribute("title");
link1 = elementsNum[o28].getAttribute("link");
isSub = elementsNum[o28].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements29(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements29 = function(elementsNum,parents){
sv = 29 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o29 =0 ; o29 < elementsNum.length;o29++){
id = elementsNum[o29].getAttribute("id");
parents1 = elementsNum[o29].getAttribute("parent");
title = elementsNum[o29].getAttribute("title");
link1 = elementsNum[o29].getAttribute("link");
isSub = elementsNum[o29].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements30(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements30 = function(elementsNum,parents){
sv = 30 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o30 =0 ; o30 < elementsNum.length;o30++){
id = elementsNum[o30].getAttribute("id");
parents1 = elementsNum[o30].getAttribute("parent");
title = elementsNum[o30].getAttribute("title");
link1 = elementsNum[o30].getAttribute("link");
isSub = elementsNum[o30].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements31(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements31 = function(elementsNum,parents){
sv = 31 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o31 =0 ; o31 < elementsNum.length;o31++){
id = elementsNum[o31].getAttribute("id");
parents1 = elementsNum[o31].getAttribute("parent");
title = elementsNum[o31].getAttribute("title");
link1 = elementsNum[o31].getAttribute("link");
isSub = elementsNum[o31].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements32(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements32 = function(elementsNum,parents){
sv = 32 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o32 =0 ; o32 < elementsNum.length;o32++){
id = elementsNum[o32].getAttribute("id");
parents1 = elementsNum[o32].getAttribute("parent");
title = elementsNum[o32].getAttribute("title");
link1 = elementsNum[o32].getAttribute("link");
isSub = elementsNum[o32].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements33(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements33 = function(elementsNum,parents){
sv = 33 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o33 =0 ; o33 < elementsNum.length;o33++){
id = elementsNum[o33].getAttribute("id");
parents1 = elementsNum[o33].getAttribute("parent");
title = elementsNum[o33].getAttribute("title");
link1 = elementsNum[o33].getAttribute("link");
isSub = elementsNum[o33].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements34(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements34 = function(elementsNum,parents){
sv = 34 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o34 =0 ; o34 < elementsNum.length;o34++){
id = elementsNum[o34].getAttribute("id");
parents1 = elementsNum[o34].getAttribute("parent");
title = elementsNum[o34].getAttribute("title");
link1 = elementsNum[o34].getAttribute("link");
isSub = elementsNum[o34].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements35(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements35 = function(elementsNum,parents){
sv = 35 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o35 =0 ; o35 < elementsNum.length;o35++){
id = elementsNum[o35].getAttribute("id");
parents1 = elementsNum[o35].getAttribute("parent");
title = elementsNum[o35].getAttribute("title");
link1 = elementsNum[o35].getAttribute("link");
isSub = elementsNum[o35].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements36(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements36 = function(elementsNum,parents){
sv = 36 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o36 =0 ; o36 < elementsNum.length;o36++){
id = elementsNum[o36].getAttribute("id");
parents1 = elementsNum[o36].getAttribute("parent");
title = elementsNum[o36].getAttribute("title");
link1 = elementsNum[o36].getAttribute("link");
isSub = elementsNum[o36].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements37(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements37 = function(elementsNum,parents){
sv = 37 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o37 =0 ; o37 < elementsNum.length;o37++){
id = elementsNum[o37].getAttribute("id");
parents1 = elementsNum[o37].getAttribute("parent");
title = elementsNum[o37].getAttribute("title");
link1 = elementsNum[o37].getAttribute("link");
isSub = elementsNum[o37].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements38(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements38 = function(elementsNum,parents){
sv = 38 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o38 =0 ; o38 < elementsNum.length;o38++){
id = elementsNum[o38].getAttribute("id");
parents1 = elementsNum[o38].getAttribute("parent");
title = elementsNum[o38].getAttribute("title");
link1 = elementsNum[o38].getAttribute("link");
isSub = elementsNum[o38].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements39(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements39 = function(elementsNum,parents){
sv = 39 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o39 =0 ; o39 < elementsNum.length;o39++){
id = elementsNum[o39].getAttribute("id");
parents1 = elementsNum[o39].getAttribute("parent");
title = elementsNum[o39].getAttribute("title");
link1 = elementsNum[o39].getAttribute("link");
isSub = elementsNum[o39].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements40(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements40 = function(elementsNum,parents){
sv = 40 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o40 =0 ; o40 < elementsNum.length;o40++){
id = elementsNum[o40].getAttribute("id");
parents1 = elementsNum[o40].getAttribute("parent");
title = elementsNum[o40].getAttribute("title");
link1 = elementsNum[o40].getAttribute("link");
isSub = elementsNum[o40].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements41(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements41 = function(elementsNum,parents){
sv = 41 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o41 =0 ; o41 < elementsNum.length;o41++){
id = elementsNum[o41].getAttribute("id");
parents1 = elementsNum[o41].getAttribute("parent");
title = elementsNum[o41].getAttribute("title");
link1 = elementsNum[o41].getAttribute("link");
isSub = elementsNum[o41].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements42(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements42 = function(elementsNum,parents){
sv = 42 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o42 =0 ; o42 < elementsNum.length;o42++){
id = elementsNum[o42].getAttribute("id");
parents1 = elementsNum[o42].getAttribute("parent");
title = elementsNum[o42].getAttribute("title");
link1 = elementsNum[o42].getAttribute("link");
isSub = elementsNum[o42].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements43(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements43 = function(elementsNum,parents){
sv = 43 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o43 =0 ; o43 < elementsNum.length;o43++){
id = elementsNum[o43].getAttribute("id");
parents1 = elementsNum[o43].getAttribute("parent");
title = elementsNum[o43].getAttribute("title");
link1 = elementsNum[o43].getAttribute("link");
isSub = elementsNum[o43].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements44(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements44 = function(elementsNum,parents){
sv = 44 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o44 =0 ; o44 < elementsNum.length;o44++){
id = elementsNum[o44].getAttribute("id");
parents1 = elementsNum[o44].getAttribute("parent");
title = elementsNum[o44].getAttribute("title");
link1 = elementsNum[o44].getAttribute("link");
isSub = elementsNum[o44].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements45(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements45 = function(elementsNum,parents){
sv = 45 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o45 =0 ; o45 < elementsNum.length;o45++){
id = elementsNum[o45].getAttribute("id");
parents1 = elementsNum[o45].getAttribute("parent");
title = elementsNum[o45].getAttribute("title");
link1 = elementsNum[o45].getAttribute("link");
isSub = elementsNum[o45].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements46(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements46 = function(elementsNum,parents){
sv = 46 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o46 =0 ; o46 < elementsNum.length;o46++){
id = elementsNum[o46].getAttribute("id");
parents1 = elementsNum[o46].getAttribute("parent");
title = elementsNum[o46].getAttribute("title");
link1 = elementsNum[o46].getAttribute("link");
isSub = elementsNum[o46].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements47(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements47 = function(elementsNum,parents){
sv = 47 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o47 =0 ; o47 < elementsNum.length;o47++){
id = elementsNum[o47].getAttribute("id");
parents1 = elementsNum[o47].getAttribute("parent");
title = elementsNum[o47].getAttribute("title");
link1 = elementsNum[o47].getAttribute("link");
isSub = elementsNum[o47].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements48(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements48 = function(elementsNum,parents){
sv = 48 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o48 =0 ; o48 < elementsNum.length;o48++){
id = elementsNum[o48].getAttribute("id");
parents1 = elementsNum[o48].getAttribute("parent");
title = elementsNum[o48].getAttribute("title");
link1 = elementsNum[o48].getAttribute("link");
isSub = elementsNum[o48].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements49(elementsNum,id);
} } Tree_Creator.content += "</div>";
}


Tree_Creator.getElements49 = function(elementsNum,parents){
sv = 49 * 20;
Tree_Creator.content += "<div id='t"+parents+"' style='padding-left:"+sv+"px; display:none;'>";
for(o49 =0 ; o49 < elementsNum.length;o49++){
id = elementsNum[o49].getAttribute("id");
parents1 = elementsNum[o49].getAttribute("parent");
title = elementsNum[o49].getAttribute("title");
link1 = elementsNum[o49].getAttribute("link");
isSub = elementsNum[o49].getAttribute("sub");
if(parents1 == parents){
Tree_Creator.toExpand += "img00"+parents1+",";
//document.getElementById("img000").src = "images/expand_f.gif";
if(isSub == 1){
Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand_f.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
}else{ Tree_Creator.content += "<img id='img"+id+"' onclick='Tree_Creator.showHide(\"t"+id+"\",\"img"+id+"\")' src='images/expand.gif'><a href='"+link1+"' class='"+Tree_Creator.treeLinks+"'>"+title+"</a><br>";
} Tree_Creator.getElements50(elementsNum,id);
} } Tree_Creator.content += "</div>";
}




