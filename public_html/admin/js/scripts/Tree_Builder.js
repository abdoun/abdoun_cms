// JavaScript Document
var Tree_Builder  = new Object();
Tree_Builder.start_tree_menu = function(){




stBM(1,"basic1",[0,"","","images/blank.gif",0,"left","default","hand",0,0,-1,350,-1,"ridge",0,"#CCCCCC","","","repeat",1,"images/expand_f.gif","images/expand_uf.gif",9,9,1,"images/line_def0.gif","images/line_def1.gif","images/line_def2.gif","images/line_def3.gif",1,0,3,1,"center",0]);
stBS("p0",[0,0]);

}
	
	
	Tree_Builder.create_tree_item= function(title,link1){

stIT("p0i0",[title,link1,"_self","","","images/file_c.png","images/file_c.png",20,20,"bold 9pt 'Verdana','Arial'","#000000","none","transparent","","no-repeat","9pt 'Verdana','Arial'","#CC33CC","none","transparent","","no-repeat","bold 9pt 'Verdana'","#FF0099","none","transparent","","no-repeat","9pt 'Verdana'","#CC33CC","none","transparent","","no-repeat",1]);

}
	
	
	Tree_Builder.create_tree_subitem= function(subelements,mainlink,briefurl){



stBS("p1",[,1],"p0");
 for(i = 0 ; i < subelements.length;i++){
	// alert("sdf");
aa = subelements[i].split(",");


stIT("p1i0",[aa[0],briefurl+aa[1],,,,,,,,"9pt 'Verdana','Arial'",,,,,,,"#666666",,,,,"9pt 'Verdana'","#000000",,,,,,"#666666"],"p0i0");

 }
stES();


}

Tree_Builder.createTree = function(xmlDoc){
/*	title = xmlDoc.getElementsByTagName("item")[0].getAttribute("title");
	link1 = xmlDoc.getElementsByTagName("item")[0].getAttribute("link");*/
	elementsNum = xmlDoc.childNodes[1].childNodes;
	cres();
	//alert(elementsNum);
	//alert('sf');
	/*
	Tree_Builder.start_tree_menu();

Tree_Builder.create_tree_item("Hello","sdf");
Tree_Builder.create_tree_item("Hello1","sdf");

subelements = new Array("hi,45","hi1,49","hi2,47","hi3,46");
Tree_Builder.create_tree_subitem(subelements,"sdfds","sdf");
Tree_Builder.create_tree_item("Hello2","sdf");
Tree_Builder.end_tree_menu();*/
	
	
	for(i = 0 ; i < elementsNum.length;i++){
	//alert();
	title = elementsNum[i].getAttribute("title");
	link1 = elementsNum[i].getAttribute("link");
		subElements = elementsNum[i].childNodes;
		//alert(subElements.length);
		
		for(c = 0 ; c < subElements.length;c++){
			//alert(elementsNum[i].childNodes[c].getAttribute("title"));
	subTitle = elementsNum[i].childNodes[c].getAttribute("title");
	subLink1 = elementsNum[i].childNodes[c].getAttribute("link");
			//alert(subTitle);
			}
		
		}
	
	
	//alert(xmlDoc.childNodes[1].childNodes.length);
	}
	
	
	
	Tree_Builder.convertToXML = function(text1){
		 //alert(text1);
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
Tree_Builder.createTree(xmlDoc);
  
  
		 }
	
	
	Tree_Builder.end_tree_menu= function(){
stES();
stEM();

	}