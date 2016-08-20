function check_all(fform,trr)
{
  if(fform.aall.checked)
  {
    for(j=0;j<trr;j++)
	{	 
	  eval("tr"+j+".style.cssText='background-color:#cccccc'");
	}	

    for(i=0;i<fform.elements.length;i++)
	{
	  fform.elements[i].checked="checked";
	  // alert(form.elements[i].name);
	}
}
else
{
  for(j=0;j<trr;j++)
	{	 
	  eval("tr"+j+".style.cssText='background-color:#99ccff'");
	}
  for(i=0;i<fform.elements.length;i++)
	{
	  fform.elements[i].checked="";
	 // alert(form.elements[i].name);
	}	
}
}
function trim(txt)
	{
		while (txt.indexOf (' ') == 0) { txt = txt.substr(1); }
		while (txt.substr(txt.length-1)==' ') { txt = txt.substr(0,txt.length-1); }
		return txt ;
	}