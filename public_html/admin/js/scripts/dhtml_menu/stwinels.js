/*=======Ver: 7.0.60906========*/
/*DHTMLMenu, (c) 2006, SourceTec Software Co.,LTD  -  www.sothink.com*/
function sthdWels(p){var m=st_ms[p.mid];for(var j=0;j<m.hdT.length;j++)stwtag(m.hdT[j],-1,p);return 1;}
function stshWels(p){var m=st_ms[p.mid];for(var j=0;j<m.hdT.length;j++)stwtag(m.hdT[j],1,p);return 1;}
function stwtag(tg,c,p){var d,m=st_ms[p.mid];if(p.frm)	 d=stgtfrm(m).document;else d=document;var es=st_nav.typ?d.getElementsByTagName(tg):d.all.tags(tg);for(var j=0;j<es.length;++j){var f=0,e=es.item(j),a;if((tg=="object"||tg=="embed")&&!(st_nav.nam=="opera"||st_nav.nam=="msie"&&st_nav.os=="mac"))if(a=e.getAttribute("wmode"))if(a.toLowerCase()=="transparent"||a.toLowerCase()=="opaque")continue;for(var t=e.offsetParent;t;t=t.offsetParent)if(t.id&&t.id.indexOf("stm")>=0)f=1;if(f)continue;else if(stwover(e,p)){if(st_nav.nam=="opera"&&tg=="applet"){var v;if(v=parseInt(e.getAttribute("visLevel"))){e.setAttribute("visLevel",v+c);v+=c;}else{e.setAttribute("visLevel",c);v=c;}if(v==-1){if(e.getAttribute("visSave"))e.setAttribute("visSave",e.style.visibility);e.style.visibility="hidden";if(typeof(p.mywehd)!='undefined'&&p.mywehd(e))return;}else if(!v){	var bv=e.getAttribute("visSave");e.style.visibility=bv?bv:"";if(typeof(p.mywesh)!='undefined'&&p.mywesh(e))return;}}	else {if(e.visLevel)e.visLevel+=c;else e.visLevel=c;if(e.visLevel==-1){if(typeof e.visSave=="undefined")e.visSave=e.style.visibility;e.style.visibility="hidden";if(typeof(p.mywehd)!='undefined'&&p.mywehd(e))return;}else if(!e.visLevel){			e.style.visibility=e.visSave;if(typeof(p.mywesh)!='undefined'&&p.mywesh(e))return;}}}}}
function stwover(e,p){var l=0,t=0,w=e.offsetWidth,h=e.offsetHeight;w?(e._wd=w):(w=e._wd);h?(e._ht=h):(h=e._ht);while(e)l+=e.offsetLeft,t+=e.offsetTop,e=e.offsetParent;return l<p._rc[2]+p._rc[0]&&l+w>p._rc[0]&&t<p._rc[3]+p._rc[1]&&t+h>p._rc[1];}
