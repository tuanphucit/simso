function SnowResize()
{
	var Noel;
	Noel = '<OBJECT id="christmas" ';
	Noel += 'codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" ';
	Noel += 'height="600" width="994" align="left" ';
	Noel += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">';
	Noel += '<PARAM NAME="allowScriptAccess" VALUE="sameDomain">';
	Noel += '<PARAM NAME="movie" VALUE="snow.swf">';
	Noel += '<PARAM NAME="menu" VALUE="false">';
	Noel += '<PARAM NAME="quality" VALUE="high">';
	Noel += '<PARAM NAME="wmode" VALUE="transparent">';
	Noel += '<embed src="snow.swf" menu="false" quality="high" wmode="transparent" bgcolor="#ffffff" width="300" height="66" name="snow" align="middle" allowscriptaccess="sameDomain" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent" />';
	Noel += '</OBJECT>';
	document.getElementById("divSnow").innerHTML=Noel;
	
	obj = document.getElementById("divSnow");
	if (obj) obj.style.left = (document.body.clientWidth - 994)/2;
	if (navigator.userAgent && navigator.userAgent.indexOf("MSIE")>=0 && navigator.userAgent.indexOf("Windows")>=0) 
		if (obj) obj.style.display='';
	else
		if (obj) obj.style.display='none';
}