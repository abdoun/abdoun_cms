function ar_language(val)
{
	var inputText = val;
	inputText = inputText.toLowerCase();
	for(i = 0; i < inputText.length; i++)
	{
		if(inputText.charAt(i) != "a" && inputText.charAt(i) != "b" && inputText.charAt(i)!= "c" && inputText.charAt(i) != "d" && inputText.charAt(i) != "e" && inputText.charAt(i) != "f" && 						inputText.charAt(i) != "g" && inputText.charAt(i) != "h" && inputText.charAt(i) != "i" && inputText.charAt(i) != "j" && inputText.charAt(i) != "k" && inputText.charAt(i) != "l" && 						inputText.charAt(i) != "m" && inputText.charAt(i) != "n" && inputText.charAt(i) != "o" && 						inputText.charAt(i) != "p" && inputText.charAt(i) != "q" && inputText.charAt(i) != "r" && 						inputText.charAt(i) != "s" && inputText.charAt(i) != "t" && inputText.charAt(i) != "u" && 						inputText.charAt(i) != "v" && inputText.charAt(i) != "w" && inputText.charAt(i) != "x" && 						inputText.charAt(i) != "y" && inputText.charAt(i) != "z" && inputText.charAt(i) != " " && 						inputText.charAt(i) != "0" && inputText.charAt(i) != "1" && inputText.charAt(i) != "2" && 						inputText.charAt(i) != "3" && inputText.charAt(i) != "4" && inputText.charAt(i) != "5" && 						inputText.charAt(i) != "6" && inputText.charAt(i) != "7" && inputText.charAt(i) != "8" && 						inputText.charAt(i) != "9" && inputText.charAt(i) != "\r" && inputText.charAt(i) != "\n" && 						inputText.charAt(i) != "!" && inputText.charAt(i) != "\"" && inputText.charAt(i) != "#" && 						inputText.charAt(i) != "$" && inputText.charAt(i) != "%" && inputText.charAt(i) != "^" && 						inputText.charAt(i) != "&" && inputText.charAt(i) != "'" && inputText.charAt(i) != "(" && 						inputText.charAt(i) != ")" && inputText.charAt(i) != "*" && inputText.charAt(i) != "+" && 						inputText.charAt(i) != "," && inputText.charAt(i) != "-" && inputText.charAt(i) != "." && 						inputText.charAt(i) != "/" && inputText.charAt(i) != "@" && inputText.charAt(i) != "~" && 						inputText.charAt(i) != "_" && inputText.charAt(i) != "|" && inputText.charAt(i) != ":" && 						inputText.charAt(i) != ";" && inputText.charAt(i) != "<" && inputText.charAt(i) != "=" && 						inputText.charAt(i) != ">" && inputText.charAt(i) != "?" && inputText.charAt(i) != "[" && 						inputText.charAt(i) != "]" && inputText.charAt(i) != "{" && inputText.charAt(i) != "}") 						
		{
			return false;
			break;
		}
	}
}
function en_language(val)
{
	var inputText = val;
	inputText = inputText.toLowerCase();
	for(i = 0; i < inputText.length; i++)
	{
		if(inputText.charAt(i) == "a" || inputText.charAt(i) == "b" || inputText.charAt(i)== "c" || inputText.charAt(i) == "d" || inputText.charAt(i) == "e" || inputText.charAt(i) == "f" || 						inputText.charAt(i) == "g" || inputText.charAt(i) == "h" || inputText.charAt(i) == "i" || inputText.charAt(i) == "j" || inputText.charAt(i) == "k" || inputText.charAt(i) == "l" || 						inputText.charAt(i) == "m" || inputText.charAt(i) == "n" || inputText.charAt(i) == "o" || 						inputText.charAt(i) == "p" || inputText.charAt(i) == "q" || inputText.charAt(i) == "r" || 						inputText.charAt(i) == "s" || inputText.charAt(i) == "t" || inputText.charAt(i) == "u" || 						inputText.charAt(i) == "v" || inputText.charAt(i) == "w" || inputText.charAt(i) == "x" || 						inputText.charAt(i) == "y" || inputText.charAt(i) == "z" || inputText.charAt(i) == " " || 						inputText.charAt(i) == "0" || inputText.charAt(i) == "1" || inputText.charAt(i) == "2" || 						inputText.charAt(i) == "3" || inputText.charAt(i) == "4" || inputText.charAt(i) == "5" || 						inputText.charAt(i) == "6" || inputText.charAt(i) == "7" || inputText.charAt(i) == "8" || 						inputText.charAt(i) == "9" || inputText.charAt(i) == "\r" || inputText.charAt(i) == "\n" || 						inputText.charAt(i) == "!" || inputText.charAt(i) == "\"" || inputText.charAt(i) == "#" || 						inputText.charAt(i) == "$" || inputText.charAt(i) == "%" || inputText.charAt(i) == "^" || 						inputText.charAt(i) == "&" || inputText.charAt(i) == "'" || inputText.charAt(i) == "(" || 						inputText.charAt(i) == ")" || inputText.charAt(i) == "*" || inputText.charAt(i) == "+" || 						inputText.charAt(i) == "," || inputText.charAt(i) == "-" || inputText.charAt(i) == "." || 						inputText.charAt(i) == "/" || inputText.charAt(i) == "@" || inputText.charAt(i) == "~" || 						inputText.charAt(i) == "_" || inputText.charAt(i) == "|" || inputText.charAt(i) == ":" || 						inputText.charAt(i) == ";" || inputText.charAt(i) == "<" || inputText.charAt(i) == "=" || 						inputText.charAt(i) == ">" || inputText.charAt(i) == "?" || inputText.charAt(i) == "[" || 						inputText.charAt(i) == "]" || inputText.charAt(i) == "{" || inputText.charAt(i) == "}") 						
		{
			return false;
			break;
		}
	}
}
function trim(txt)
{
	while (txt.indexOf (' ') == 0) { txt = txt.substr(1); }
	while (txt.substr(txt.length-1)==' ') { txt = txt.substr(0,txt.length-1); }
	return txt ;
}
function trim_number(txt)
{
	while (txt.indexOf('0')==0 || txt.indexOf('1')==0 || txt.indexOf('2')==0 || txt.indexOf('3')==0 || txt.indexOf('4')==0 || txt.indexOf('5')==0 || txt.indexOf('6')==0 || txt.indexOf('7')==0 || txt.indexOf('8')==0 || txt.indexOf('9')==0) { txt = txt.substr(1); }
	while (txt.substr(txt.length-1)=='0' || txt.substr(txt.length-1)=='1' || txt.substr(txt.length-1)=='2' || txt.substr(txt.length-1)=='3' || txt.substr(txt.length-1)=='4' || txt.substr(txt.length-1)=='5' || txt.substr(txt.length-1)=='6' || txt.substr(txt.length-1)=='7' || txt.substr(txt.length-1)=='8' || txt.substr(txt.length-1)=='9') { txt = txt.substr(0,txt.length-1); }
	return txt ;
}