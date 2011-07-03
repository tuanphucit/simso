window.scrollBar = 'no';

function isEmail(s)
{   
  if (s=="") return false;
  if(s.indexOf(" ")>0) return false;
  if(s.indexOf("@")==-1) return false;
  var i = 1;
  var sLength = s.length;
  if (s.indexOf(".")==-1) return false;
  if (s.indexOf("..")!=-1) return false;
  if (s.indexOf("@")!=s.lastIndexOf("@")) return false;
  if (s.lastIndexOf(".")==s.length-1) return false;
  var str="0123456789abcdefghikjlmnopqrstuvwxyz-@._"; 
  for(var j=0;j<s.length;j++)
	if(str.indexOf(s.charAt(j))==-1) return false;
  return true;
}

function isURL(s)
{
  if (s=="") return false;
  if(s.indexOf(" ")>0) return false;
  var i = 1;
  var sLength = s.length;
  if (s.indexOf(".")==-1) return false;
  if (s.indexOf("..")!=-1) return false;
  if (s.lastIndexOf(".")==s.length-1) return false;
  var str="0123456789abcdefghikjlmnopqrstuvwxyz-._:/"; 
  for(var j=0;j<s.length;j++)
	if(str.indexOf(s.charAt(j))==-1) return false;
  return true;	
}

function isEmpty(s)
{   
	return ((s == null) || (s.length == 0))
}

function isWhitespace (s)
{   
	var whitespace = " \t\n\r";
	var i;

  if (isEmpty(s)) return true;
  for (i = 0; i < s.length; i++)
  {   
    var c = s.charAt(i);
    if (whitespace.indexOf(c) == -1) return false;
  }
  return true;
}

function isNumber(num)
{
	if(num=="") return false;
	var str="0123456789";
	var len = num.length;
	for(var i=0;i<len;i++)
	{
		if(str.indexOf(num.charAt(i))==-1) return false;
	}
	return true;
}

function openBox(fileSrc,winW,winH,scBar,toBar,stBar,t,l)
{
	var sw = screen.width;
	var sh = screen.height;
	
	if(winW==null) winW = sw*0.9;
	if(winH==null) winH = sh*0.85;
	if(scBar==null) scBar = 'no';
	if(toBar==null) toBar = 'no';
	if(stBar==null) stBar = 'yes';
	if(t==null) t = (sh-winH)/4;
	if(l==null) l = (sw-winW)/2;
	
  var newPar = "width="+winW+",height="+winH;
	newPar += ",scrollbars="+scBar+",toolbar="+toBar;
	newPar += ",status="+stBar+",top="+t+",left="+l;
	
	window.open(fileSrc,"a",newPar);
}

function openImage(vLink)
{
	var sLink = (typeof(vLink.href) == 'undefined') ? vLink : vLink.href;

	if (sLink == '')
	{
		return false;
	}

	var img = new Image();
	img.src = sLink;
	if((img.height<=0)||(img.width<=0))
	{
		return false;
	}
	if((img.height>0)&&(img.width>0))
	{
		vHeight = img.height;
		vWidth  = img.width;
	}

	winDef = 'status=no,resizable=no,scrollbars=no,toolbar=no,location=no,fullscreen=no,titlebar=yes,height='.concat(vHeight).concat(',').concat('width=').concat(vWidth).concat(',');
	winDef = winDef.concat('top=').concat((screen.height - vHeight)/2).concat(',');
	winDef = winDef.concat('left=').concat((screen.width - vWidth)/2);
	newwin = open('', '_blank', winDef);

	newwin.document.writeln('<title>Asia Pacific Travel</title><body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">');
	newwin.document.writeln('<a href="" onClick="window.close(); return false;"><img src="', sLink, '" alt="', 'Close', '" border=0></a>');
	newwin.document.writeln('</body>');

	if (typeof(vLink.href) != 'undefined')
	{
		return false;
	}
	
	return true;
}

//Begin change color functions
var curbgColor;
var curfgColor;
function active(obj,bcolor,fcolor)
{
	if(bcolor==null) bcolor = "#EEEEFF";
	if(fcolor==null) fcolor = "#FF5500";
	
	curbgColor = obj.style.backgroundColor;
	curfgColor = obj.style.color;
	obj.style.backgroundColor = bcolor;
	obj.style.color = fcolor;
}

function deactive(obj)
{
	obj.style.backgroundColor = curbgColor;
	obj.style.color = curfgColor;
}
//end

function numOpt(begin,end,str)
{
  var dOpt = '<option value="" checked>--'+str+'--</option>';
  for(i=begin;i<=end;i++)
  {
    if(i<10) {dOpt += '<option value="'+i+'">0'+i+'</option>';}
		else {dOpt += '<option value="'+i+'">'+i+'</option>';}
  }
  return dOpt;
}

function monthOpt(stm)
{
	var sel = '';
	var dmy = new Date();
	var curM = dmy.getMonth()+1;
	if(stm==null) stm = "Month";
  var month = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

	var mOpt='<option value="" checked>--'+stm+'--</option>';
  for(var i=0;i<12;i++)
  {
		var j = i+1;
		if(j!=curM) sel = '';
		else sel = 'selected';
    mOpt += '<option value="'+j+'" '+sel+'>'+month[i]+'</option>';
  }
  return mOpt;
}

function rect(clr)
{
	var s = '<table width=30 height=15 bgcolor='+clr+'>';
	s += '<tr><td></td></tr></table>';
	document.write(s);
}

function scrollColor(obj,faceClr,shaClr,arrClr)
{
	obj = eval(obj);
	if(!faceClr) faceClr = "#EAF9FF";
	if(!shaClr) shaClr = "#EAF9FF";
	if(!arrClr) arrClr = "#A7B5C5";
	obj.style.scrollbarFaceColor = faceClr;
	obj.style.scrollbarShadowColor = shaClr;
	obj.style.scrollbarArrowColor = arrClr;
	obj.style.scrollbarFaceHeight = 0;
}