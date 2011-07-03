function doSubmitPagingForm(page)
{
	var myFrm = document.pagingForm;
	myFrm.curPg.value = page;
	myFrm.submit();
}
function addToFavorite()
{
	var pageTitle = document.title;
	var pageUrl = location.href;
	window.external.addFavorite(pageUrl, pageTitle);
}
function doContactSubmit()
{
	var myFrm = document.frmContact;
	if(myFrm.fullname.value == '')
	{
		alert('Ban vui long cho biet ten cua ban!');
		myFrm.fullname.focus();
		return false;
	}
	if(!isEmail(myFrm.email.value))
	{
		alert('Ban vui long kiem tra lai dia chi email cua ban');
		myFrm.email.focus();
		return false;
	}
	return true;
}
function checkSugSubmit()
{
	var myFrm = document.suggestionFrm;
	if(myFrm.yourName.value == '')
	{
		alert('Ban vui long cho biet ten cua ban!');
		myFrm.yourName.focus();
		return false;
	}
	if(!isEmail(myFrm.yourEmail.value))
	{
		alert('Ban vui long kiem tra lai dia chi email cua ban');
		myFrm.yourEmail.focus();
		return false;
	}
	return true;
}
function checkOrderProductSubmit()
{
	var myFrm = document.frmOrderProduct;
	if(myFrm.nname.value == '')
	{
		alert(var_vuilongnhaphoten);
		myFrm.nname.focus();
		return false;
	}
	if(!isEmail(myFrm.email.value))
	{
		alert(var_vuilongkiemtralaimail);
		myFrm.email.focus();
		return false;
	}
	return true;
}
function doOrderProductSubmit()
{
	if(checkOrderProductSubmit())
	{
		AjaxRequest.Submit(frmOrderProduct, {
			'onSuccess': function(req)
			{
				getObjectById('doOrderProduct').innerHTML = req.responseText;
			},
			'onError': function(req){}
		});
	}
	return false;
}
function doSugFrmSubmit()
{
	if(checkSugSubmit())
	{
		AjaxRequest.Submit(
			suggestionFrm, {'onSuccess': function(req)
			{
				Modalbox.hide();
			},'onError': function(req){}
		});
	}
	return false;
}
function checkSendToSubmit()
{
	var myFrm = document.sendToFriend;
	if(!isEmail(myFrm.friendEmail.value))
	{
		alert('Ban vui long kiem tra lai dia chi email duoc gui den');
		myFrm.friendEmail.focus();
		return false;
	}
	return true;
}
function doSendToSubmit()
{
	if(checkSendToSubmit())
	{
		AjaxRequest.Submit(
			sendToFriend, {'onSuccess': function(req)
			{
				Modalbox.hide();
			},'onError': function(req){}
		});
	}
	return false;
}
function fileExtention(fileName)
{
	var splFNames = fileName.split('.');
	if(splFNames.length)
	{
		return splFNames[splFNames.length-1].toLowerCase();
	}
	return '';
}
function redirect(url)
{
	location.href = url;
}

function title(strTitle)
{
	document.title = strTitle;
}

function GetDate(lang)
{
	var dmy = new Date();
	var cur_dd = dmy.getDay();
	var cur_d = dmy.getDate();
	var cur_m = dmy.getMonth();
	var cur_y = dmy.getFullYear();

	if(lang == '1')
	{
		listDays = new Array('Ch&#7911; nh&#7853;t','Th&#7913; hai','Th&#7913; ba','Th&#7913; t&#432;','Th&#7913; n&#259;m','Th&#7913; s&#225;u','Th&#7913; b&#7843;y');
		if(cur_d < 10) cur_d = "0" + cur_d;
		if(cur_m < 10) cur_m = "0" + cur_m;
		strDate = listDays[cur_dd] + ", " + cur_d + "-" + cur_m + "-" + cur_y;
	}
	else
	{		
		var listDays = new Array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
		var listMonths = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	
		if(cur_d < 10) cur_d = "0" + cur_d;
		//if(cur_m < 10) cur_m = "0" + cur_m;
		strDate = listDays[cur_dd] + ", " + listMonths[cur_m] + " " + cur_d + ", " + cur_y;

		/*
		if(cur_d < 10) cur_d = "0" + cur_d;
		if(cur_m < 10) cur_m = "0" + cur_m;
		strDate = cur_d + "/" + cur_m + "/" + "/" + cur_y;
		*/
	}
	return strDate;
}

function doSubmitsearchForm()
{
	var myFrm = document.searchForm;
	var keyWordVal = myFrm.searchKeyword.value;
	if(keyWordVal == '' || keyWordVal == keywordDefult)
	{
		alert('Ban vui long nhap tu khoa can tim!');
		myFrm.searchKeyword.focus();
		return false;
	}
	var myAct = _url_base+'/index.php/'+myFrm.searchInCate.value;
	//document.write(myAct);
	myFrm.action = myAct;
	//myFrm.submit();
	return true;
}
function clearKeyword(txtBoxObj)
{
	curTxtBoxObjVal = txtBoxObj.value;
	txtBoxObj.value = '';
}
function restoreKeyword(txtBoxObj)
{
	if(txtBoxObj.value == '')
	{
		txtBoxObj.value = curTxtBoxObjVal;
	}
}

function GotoPage(iPage) 
{
	document.frmPaging.curPg.value=iPage;
	document.frmPaging.submit();
}

function goPage(url,target)
{
	if(!target) target = '_self';
	window.open(url,target);
}

function doQuickLink(selObj)
{
	var myUrl = selObj.value;
	if(myUrl != '')
	{
		goPage(myUrl, '_blank');
	}
	return;
}

function changeLang(lang)
{
	var myFrm = document.frmLang;
	myFrm.lang.value = lang;
	myFrm.submit();
}

function validUserName(username)
{
  if(username == "") return false;
  if(username.indexOf(" ") > 0) return false;
  var str = "0123456789abcdefghikjlmnopqrstuvwxyz_"; 
  for(var j = 0; j < username.length; j++)
	{
		if(str.indexOf(username.charAt(j))==-1) return false;
	}	
  return true;
}

function isEmail(s)
{   
  if (s=="") return false;
  if(s.indexOf(" ") > 0) return false;
  if(s.indexOf("@") == -1) return false;
  var i = 1;
  var sLength = s.length;
  if (s.indexOf(".")==-1) return false;
  if (s.indexOf("..")!=-1) return false;
  if (s.indexOf("@") != s.lastIndexOf("@")) return false;
  if (s.lastIndexOf(".") == s.length - 1) return false;
  var str = "0123456789abcdefghikjlmnopqrstuvwxyz-@._"; 
  for(var j=0;j<s.length;j++)
	{
		if(str.indexOf(s.charAt(j))==-1) return false;
	}	
  return true;
}

function isURL(s)
{
  if (s=="") return false;
	s= toLowerCase(s);
  if(s.indexOf(" ")>0) return false;
  var i = 1;
  var sLength = s.length;
  if (s.indexOf(".")==-1) return false;
  if (s.indexOf("..")!=-1) return false;
  if (s.lastIndexOf(".")==s.length-1) return false;
  var str = "0123456789abcdefghikjlmnopqrstuvwxyz-._:/"; 
  for(var j=0; j<s.length; j++)
	if(str.indexOf(s.charAt(j))==-1) return false;
  return true;
}

function FileName(strFile)
{
	if(strFile=="") return "";
	var pos = strFile.lastIndexOf("/") + 1;
	var filename = strFile.substr(pos);
	return filename;
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

function checkDate(s_d,s_m,s_y,e_d,e_m,e_y)
{
	if(parseInt(e_y) < parseInt(s_y)) 
	{
		return false;
	}
	if(parseInt(e_y) == parseInt(s_y))
	{
		if(parseInt(e_m) < parseInt(s_m))
		{
			return false;
		}
		if(parseInt(e_m) ==parseInt(s_m))
		{
			if(parseInt(e_d) <= parseInt(s_d)) return false;
		}
	}
	return true;
}

function numberOption(begin,end,str)
{
	var dayOpt = "";
	if(str!=null) dayOpt += "<option value=''>--"+str+"--</option>";
  for(var i=begin;i<=end;i++)
  {
    if(i<10)
      dayOpt += "<option value="+i+">0"+i+"</option>";
		else
      dayOpt += "<option value="+i+">"+i+"</option>";
  }
  return dayOpt;
}

function monthOption()
{
  var month_names = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

	var monthOpt = "";
  for(var i=0;i<12;i++)
  {
		var j = i+1;
    monthOpt += "<option value='"+j+"'>"+month_names[i]+"</option>";
  }
  return monthOpt;
}

//** COOKIE FUNCTIONS**//

//var never = new Date();
//never.setTime(never.getTime() + 2000*24*60*60*1000);

function SetCookie(name,value) 
{
   var expString = "; expires=" + never.toGMTString();
   document.cookie = name + "=" + escape(value) + expString;
}

function GetCookie(name) 
{
   var result = null;
   var myCookie = " " + document.cookie;
   var searchName = " " + name + "=";
   var startOfCookie = myCookie.indexOf(searchName);
   var endOfCookie;
   if (startOfCookie != -1)
   {
      startOfCookie += searchName.length;
      endOfCookie = myCookie.indexOf(";", startOfCookie);
      result = unescape(myCookie.substring(startOfCookie,endOfCookie));
   }
   return result;
}

function saveValue(eleName,frmName) 
{
	var strObj = "document."+frmName+"."+eleName;
	var obj = eval(strObj);
	if ((obj.type == "text")||(obj.type == "password")||(obj.type == "textarea")||(obj.type == "radio")) 
	{
		val = obj.value;
	} 
	else if (obj.type.indexOf("select") != -1) 
	{
		val = "";
		for(k=0;k<obj.length;k++)
			if (obj.options[k].selected)
				val += k+" ";
	} 
	else if (obj.type == "checkbox") 
	{
		val = obj.checked;
	}
	SetCookie("memory_"+frmName+"_"+eleName,val);
}

function clearValue(eleName,frmName) 
{
	var strObj = "document."+frmName+"."+eleName;
	var obj = eval(strObj);
	val = "";
	if (obj.type.indexOf("select") != -1) 
	{
		obj.options[k].selected = 0
	} 
	SetCookie("memory_"+frmName+"_"+eleName,val);
}

function storedValues() 
{
	for (i=0;i<document.forms.length;i++) 
	{
		for (j=0;j<document.forms[i].elements.length; j++) 
		{
			cookie_name  = "memory_"+document.forms[i].name+"_";
			cookie_name += document.forms[i].elements[j].name;
			val = GetCookie(cookie_name);
			if (val) 
			{
				if ((document.forms[i].elements[j].type == "text")||(document.forms[i].elements[j].type == "password")||(document.forms[i].elements[j].type == "textarea")) 
				{
					document.forms[i].elements[j].value = val;
				} 
				else if (document.forms[i].elements[j].type.indexOf("select") != -1) 
				{
					document.forms[i].elements[j].selectedIndex = -1;
					while (((pos = val.indexOf(" ")) != -1) && (val.length > 1)) 
					{
						sel = parseInt(val.substring(0,pos));
						val = val.substring(pos+1,val.length);
						if (sel < document.forms[i].elements[j].length) document.forms[i].elements[j].options[sel].selected = true;
					}
				}
				else if (document.forms[i].elements[j].type == "checkbox") 
				{
					document.forms[i].elements[j].checked = val;
				}
				else if (document.forms[i].elements[j].type == "radio") 
				{
					if (document.forms[i].elements[j].value == val) document.forms[i].elements[j].checked = true;
				}
			}
		}
	}
}

function getObjectById( id ) 
{
	var obj = null;
	if( document.getElementById )
		obj = document.getElementById( id );
	else if( document.all )
		obj = document.all[id];
	else
		obj = document.layer[id];
	return obj;
}

//** END COOKIE **//


function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function flashWrite(url,w,h,vars,id,bg)
{
	var flashStr=
	"<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+w+"' height='"+h+"' id='"+id+"' align='middle'>"+
	"<param name='allowScriptAccess' value='always' />"+
	"<param name='movie' value='"+url+"' />"+
	"<param name='FlashVars' value='"+vars+"' />"+
	"<param name='wmode' value='transparent' />"+
	"<param name='menu' value='false' />"+
	"<param name='quality' value='high' />"+
	"<embed src='"+url+"' FlashVars='"+vars+"' wmode='transparent' menu='false' quality='high' width='"+w+"' height='"+h+"' allowScriptAccess='always' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />"+
	"</object>";
	document.write(flashStr);
}

function DisplayFloatBanner(side)
{
	if( side == 0 ) // ko in gi ca
	{
		return;
	}		
	if( FloatBanner.length == 0 )
	{
		return;
	}
		
	document.write('<table cellspacing=0 cellpadding=0 border=0>');
	
	if (side==1) // ben trai
	{
		for (i=0; i<FloatBanner.length; i++)
		{
			if(FloatBanner[i][4]=='0')
			{
				if(FloatBanner[i][0].indexOf(".swf")>0)
				{ 
					document.write('<tr><td>');
					flashWrite(PageHost.concat(FloatBanner[i][0]),FloatBanner[i][5],FloatBanner[i][6],FloatBanner[i][1]);
					document.write('</td></tr>');
	   		}
				else if(FloatBanner[i][1]=='')
				{
					document.write('<tr><td><a href="#"><img src="', PageHost.concat(FloatBanner[i][0]), '" width="',FloatBanner[i][5],'" border=0></a></td></tr>');
				}
				else 
				{
					document.write('<tr><td><a href="',FloatBanner[i][1],'"><img src="', PageHost.concat(FloatBanner[i][0]), '" width="',FloatBanner[i][5],'" border=0></a></td></tr>');
				}
			}
		}
	}
		
	if (side==2) // ben phai
	{
		for (i=0; i<FloatBanner.length; i++)
		{
			if(FloatBanner[i][4]=='1')
			{
				if(FloatBanner[i][0].indexOf(".swf")>0) 
				{
					document.write('<tr><td>');
					flashWrite(PageHost.concat(FloatBanner[i][0]),FloatBanner[i][5],FloatBanner[i][6],FloatBanner[i][1]);
					document.write('</td></tr>');
				}	
				else if(FloatBanner[i][1]=='')
				{
					document.write('<tr><td><a href="#"><img src="', PageHost.concat(FloatBanner[i][0]), '" width="',FloatBanner[i][5],'" border=0></a></td></tr>');
				}
				else 
				{
					document.write('<tr><td><a href="',FloatBanner[i][1],'"><img src="', PageHost.concat(FloatBanner[i][0]), '" width="',FloatBanner[i][5],'" border=0></a></td></tr>');
				}
			}
		}
	}
		
	document.write('</table>');
}

function FloatTopDiv()
{
	var ns = (navigator.appName.indexOf("Netscape") != -1);
	if(!ns)
	{
		startLX = ((document.body.clientWidth - 1230)/2) + 80 , startLY = 105;
		//startRX = ((document.body.clientWidth -770)/2) + 770 +2 , startRY = 62;
		startRX = ((document.body.clientWidth)/2) + 428 , startRY = 105;
	}
	else
	{
		startLX = ((document.body.clientWidth - 1230)/2) + 80 , startLY = 105;
		startRX = ((document.body.clientWidth - 780)/2) + 816 , startRY = 105;
	}
	var d = document;
	function ml(id)
	{
		var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		el.sP=function(x,y){this.style.left=x;this.style.top=y;};
		el.x = startRX;
		el.y = startRY;
		return el;
	}
	function m2(id)
	{
		var e2=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
		e2.sP=function(x,y){this.style.left=x;this.style.top=y;};
		e2.x = startLX;
		e2.y = startLY;
		return e2;
	}
	window.stayTopLeft=function()
	{
		if (document.documentElement && document.documentElement.scrollTop)
			var pY =  document.documentElement.scrollTop;
		else if (document.body)
			var pY =  document.body.scrollTop;
		if (document.body.scrollTop > 30){startLY = 3;startRY = 3;} else {startLY = 105;startRY = 105;};
		ftlObj.y += (pY+startRY-ftlObj.y)/16;
		ftlObj.sP(ftlObj.x, ftlObj.y);
		ftlObj2.y += (pY+startLY-ftlObj2.y)/16;
		ftlObj2.sP(ftlObj2.x, ftlObj2.y);
		setTimeout("stayTopLeft()", 1);
	}
	ftlObj = ml("divAdRight");
	//stayTopLeft();
	ftlObj2 = m2("divAdLeft");
	stayTopLeft();
}

function ShowAdDiv()
{
	var objAdDivRight = getObjectById("divAdRight");
	var objAdDivLeft = getObjectById("divAdLeft");		
	
	if (document.body.clientWidth < 1064)
	{
		objAdDivRight.style.display = "none";
		objAdDivLeft.style.display = "none";
	}
	else
	{
		objAdDivRight.style.display = "block";
		objAdDivLeft.style.display = "block";
		FloatTopDiv();
	}
}

//
var lastModule, lastModuleColor, lastModuleFont = null;

function getCurrentModule(module)
{
	if(getObjectById(lastModule))
	{
		getObjectById(lastModule).style.color = lastModuleColor;
		getObjectById(lastModule).style.fontWeight = lastModuleFont;		
	}
	lastModule = module;

	if(getObjectById(module))
	{
		lastModuleColor = getObjectById(module).style.color;
		lastModuleFont = getObjectById(module).style.fontWeight;
		getObjectById(module).style.color = '#FF6600';
		getObjectById(module).style.fontWeight = 'bold';
	}
}

function showPageContent(sLink, containerId)
{
	//var pageReq = new AjaxRequest;
	AjaxRequest.get(
	{
		'url':sLink,
		'onSuccess': function(req)
		{
			if(getObjectById(containerId))
			{
				getObjectById(containerId).innerHTML = req.responseText;
			}
		},
		'onError': function(req){}
	});
}

function showItemDetail(sLink, containerId, winW, winH, winX, winY)
{
	if(getObjectById(containerId))
	{
		showPageContent(sLink, containerId);
		if(!winW)
		{
			winW = 600;
		}
		if(!winH)
		{
			winH = screen.height - 200;
		}
		if(!winX)
		{
			winX = (screen.width - winW)/2;
		}
		if(!winY)
		{
			winY = 10;
		}
		getObjectById(containerId).style.left = winX;
		getObjectById(containerId).style.top = winY;
		getObjectById(containerId).style.width = winW;
		getObjectById(containerId).style.height = winH;
		getObjectById(containerId).style.display = '';
		window.scrollBar = 'no';
	}
	return;
}

function changeGallery(Obj, sLink, containerId)
{
	var selVal = Obj.value;
	if(sLink.indexOf('?'))
	{
		sLink = sLink.concat('&galTypeId='+selVal);
	}
	else
	{
		sLink = sLink.concat('?galTypeId='+selVal);
	}
	showPageContent(sLink, containerId);
}

// Clock
function stopclock()
{
	if(timerRunning)
	{
		clearTimeout(timerID);
	}
	timerRunning = false;
}
function showtime() 
{
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds()
	var timeValue = "" + hours;
	timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
	timeValue += ((seconds < 10) ? ":0" : ":") + seconds
	if(getObjectById('myClock'))
	{
		getObjectById('myClock').innerHTML = timeValue;
	}
	timerID = setTimeout("showtime()",1000);
	timerRunning = true;
}
function startclock() 
{
	stopclock();
	showtime();
}
//-->
<!--
function slideShow()
{
	if(!slideListImg.length)
	{
		return false;
	}
	if(curKeySlidePhoto < slideListImg.length - 1)
	{
		curKeySlidePhoto ++ ;
	}
	else
	{
		curKeySlidePhoto = 0;
	}
	if (document.all)
	{
		document.images.ssPic.style.filter="revealTrans(duration=0)";
		document.images.ssPic.style.filter="revealTrans(transition=12)";
		document.images.ssPic.filters.revealTrans.apply();
		document.images.ssPic.filters.revealTrans.Play();
	}
	document.images.ssPic.src = slideListImg[curKeySlidePhoto].src;
	if(ssPicLink)
	{
		ssPicLink.href = slideListLink[curKeySlidePhoto];
	}

	//Test.innerHTML = curKeySlidePhoto;
	setTimeout("slideShow()", 10000);
}
//-->
function ShowStock(i)
{
	if(i==0)
	{
		getObjectById('VnIndex-Left').className = 'activetab-left fl';
		getObjectById('VnIndex-Center').className = 'activetab-center fl';
		getObjectById('VnIndex-Right').className = 'activetab-right fl';
		getObjectById('HaIndex-Left').className = 'deactivetab-left2 fl';
		getObjectById('HaIndex-Center').className = 'deactivetab-center fl';
		getObjectById('HaIndex-Right').className = 'deactivetab-right2 fl';
		getObjectById('HOSE').style.display = '';		
		getObjectById('HASTC').style.display = 'none';						
	}
	else
	{
		getObjectById('VnIndex-Left').className = 'deactivetab-left1 fl';
		getObjectById('VnIndex-Center').className = 'deactivetab-center fl';
		getObjectById('VnIndex-Right').className = 'deactivetab-right1 fl';
		getObjectById('HaIndex-Left').className = 'activetab-left fl';
		getObjectById('HaIndex-Center').className = 'activetab-center fl';
		getObjectById('HaIndex-Right').className = 'activetab-right fl';
		getObjectById('HOSE').style.display = 'none';		
		getObjectById('HASTC').style.display = '';						
	}
}

function ShowWeatherBox(vId){
	var sLink = '';
	sLink = 'http://vnexpress.net/ListFile/Weather/';
	switch (parseInt(vId)){	    	
		case 1: sLink = sLink.concat('Sonla.xml');break;
		case 2: sLink = sLink.concat('Viettri.xml');break;
		case 3: sLink = sLink.concat('Haiphong.xml');break;
		case 4: sLink = sLink.concat('Hanoi.xml');break;
		case 5: sLink = sLink.concat('Vinh.xml');break;
		case 6: sLink = sLink.concat('Danang.xml');break;
		case 7: sLink = sLink.concat('Nhatrang.xml');break;
		case 8: sLink = sLink.concat('Pleicu.xml');break;		
		case 9: sLink = sLink.concat('HCM.xml');break;	
		default: sLink = sLink.concat('Hanoi.xml');break;
	}
	AjaxRequest.get(
		{
			'url':sLink
			,'onSuccess':function(req){
				var vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather;
				vAdImg = req.responseXML.getElementsByTagName('AdImg').item(0).firstChild.nodeValue;
				vAdImg1 = req.responseXML.getElementsByTagName('AdImg1').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg2').item(0).firstChild != null)
					vAdImg2 = req.responseXML.getElementsByTagName('AdImg2').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg3').item(0).firstChild != null)
					vAdImg3 = req.responseXML.getElementsByTagName('AdImg3').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg4').item(0).firstChild != null)
					vAdImg4 = req.responseXML.getElementsByTagName('AdImg4').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg5').item(0).firstChild != null)
					vAdImg5 = req.responseXML.getElementsByTagName('AdImg5').item(0).firstChild.nodeValue;
				vWeather = req.responseXML.getElementsByTagName('Weather').item(0).firstChild.nodeValue;
				GetWeatherBox(vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather);				
				}
			,'onError':function(req){}
		}
	)
}

function GetWeatherBox(vImg, vImg1, vImg2, vImg3, vImg4, vImg5, vWeather){
	var sHTML = '';
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg).concat('" class="img-weather" alt="" />&nbsp;');
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg1).concat('" class="img-weather" alt="" />');
	if(vImg2!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg2).concat('" class="img-weather" alt="" />');
	if(vImg3!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg3).concat('" class="img-weather" alt="" />');
	if(vImg4!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg4).concat('" class="img-weather" alt="" />');
	if(vImg5!=null) sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/').concat(vImg5).concat('" class="img-weather" alt="" />');
	sHTML = sHTML.concat('<img src="http://vnexpress.net/Images/Weather/c.gif" class="img-weather" alt="" />');
	
	gmobj('img-Do').innerHTML = sHTML;
	gmobj('txt-Weather').innerHTML = vWeather;
}

function ShowGoldPrice(){
	var sHTML = '';
	sHTML = sHTML.concat('<table border="0" cellpadding="1" cellspacing="1" class="tbl-goldprice">');
	sHTML = sHTML.concat('	<tr>');
	sHTML = sHTML.concat('		<td class="td-weather-title">Mua</td>');
	sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldBuy).concat('</td>');
	sHTML = sHTML.concat('	</tr>');
	sHTML = sHTML.concat('	<tr>');
	sHTML = sHTML.concat('		<td class="td-weather-title">B&#225;n</td>');
	sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSell).concat('</td>');
	sHTML = sHTML.concat('	</tr>');
	sHTML = sHTML.concat('</table>');
	gmobj('eGold').innerHTML = sHTML;
}

function ShowForexRate(){
	var sHTML = '';
	sHTML = sHTML.concat('<table border="0" cellpadding="1" cellspacing="1" class="tbl-weather">');
	for(var i=0;i<vForexs.length;i++){
		sHTML = sHTML.concat('	<tr>');
		sHTML = sHTML.concat('		<td class="td-weather-title">').concat(vForexs[i]).concat('</td>');
		sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vCosts[i]).concat('</td>');
		sHTML = sHTML.concat('	</tr>');
	}
	sHTML = sHTML.concat('</table>');
	gmobj('eForex').innerHTML = sHTML;
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
