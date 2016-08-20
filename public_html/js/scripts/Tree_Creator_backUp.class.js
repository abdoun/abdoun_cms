// JavaScript Document
var Tree_Creator = new Object();


Tree_Creator.startTree = function(){
	var wer = "<table >";
	
	return wer;
	}
	
	Tree_Creator.createItem = function(num,title,link1,sub_elements){
		//alert(sub_elements.length);
		class1 = "treeLinks";
		if(sub_elements.length > 0 ){
		var wer = "<tr><td><img id='img"+num+"' onclick='Tree_Creator.showHide(\"sub"+num+"\",\"img"+num+"\")' src='images/expand_f.gif'><img src='images/file_c.png'><a href='"+link1+"' class='"+class1+"'>"+title+"</a></td></tr>";
		}else{
			var wer = "<tr><td><img id='img"+num+"' onclick='Tree_Creator.showHide(\"sub"+num+"\",\"img"+num+"\")' src='images/expand.gif'><img src='images/file_c.png'><a href='"+link1+"' class='"+class1+"'>"+title+"</a></td></tr>";
			}
		if(sub_elements.length > 0 ){
			wer+= "<tr ><td style='padding-left:20px;'><table id='sub"+num+"' style='display:none;'>";
			for(t = 0 ; t < sub_elements.length; t++){
				
				xx = sub_elements[t].split(",");
				//alert(xx[1]);
				wer += "<tr><td ><img src='images/file_c.png'><a href='"+xx[1]+"' class='"+class1+"'>"+xx[0]+"</a></td></tr>";
				
				}
			wer+= "</table></td></tr>";
		
		}
		//alert(s);
		return wer;
		
		}
		

	Tree_Creator.showHide = function(divId,img){
		if(document.getElementById(divId).style.display == "none"){
			document.getElementById(divId).style.display = "";
			document.getElementById(img).src = "images/expand_uf.gif";
			
			}else{
				
				document.getElementById(divId).style.display = "none";
				document.getElementById(img).src = "images/expand_f.gif";
				}
		
		}
		
	
	
	
	
	Tree_Creator.endTree = function(){
		var wer = "</table>"
	
	return wer;
	
	
	}
	
	
	
	Tree_Creator.createTree = function(xmlDoc){
//vv = xmlDoc.getElementsByTagName("item").length;



	elementsNum = xmlDoc.getElementsByTagName("item");
//alert(elementsNum.length);
	var table = Tree_Creator.startTree();
	subs = 0;
	//alert(elementsNum.length);
	for(i = 0 ; i < elementsNum.length;i++){
		
	//alert();
	title = elementsNum[i].getAttribute("title");
	link1 = elementsNum[i].getAttribute("link");
	subNum =  elementsNum[i].getAttribute("sub");
	subNum = parseInt(subNum);
	//alert(title);
		//subElements = xmlDoc.getElementsByTagName("sub");
		//alert(subElements.length);
		var aa = new Array();
		
		
		//alert(parseInt(subNum));
		if(subNum > 0){
			s_1 =  subs+i+1;
			
			
			for(c = 0 ; c < subNum;c++){
			subTitle = elementsNum[s_1].getAttribute("title");
			subLink1 = elementsNum[s_1].getAttribute("link");
			aa.push(subTitle+","+subLink1);
			//alert(subTitle);
			//subs++;
			s_1++;
			i++;
			}
		/*
			//alert(elementsNum[i].childNodes[c].getAttribute("title"));
	subTitle = elementsNum[s].getAttribute("title");
	subLink1 = elementsNum[s].getAttribute("link");
			//alert(subTitle);
			aa.push(subTitle+","+subLink1);
			//s++;
			alert(c);
			}*/
			
		}
		//alert(i);
		
		table += Tree_Creator.createItem(i,title,link1,aa);
		//alert(aa.length);
		
		
		}
	table += Tree_Creator.endTree();
	//document.getElementById('con').innerHTML = table;
	return table;
	//alert(xmlDoc.childNodes[1].childNodes.length);
	}
	
	
	
	Tree_Creator.convertToXML = function(text1){
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
return xmlDoc;
  
  
		 }
	
	