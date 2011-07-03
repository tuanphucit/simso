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

function changePage(objSel)
{
	document.frmPaging.curPg.value = objSel.value;
	document.frmPaging.submit();
}

function statusBar()
{
  window.status = "vo-media.com";
}

function title(strTitle)
{
	document.title = strTitle;
}

function goPage(fileName)
{
	location.href = fileName;
}

function docheck(status)
{
	var alen = document.frmList.elements.length;
	alen = (alen>2)?document.frmList.chkid.length:0;
	if (alen>0)
	{
		for(var i=0;i<alen;i++) 
			document.frmList.chkid[i].checked = status;
	}
	else
	{
		document.frmList.chkid.checked = status;
	}
}

function checkAll(sender)
{
	docheck(sender.checked);
}

function calculatechon()
{
	var strchon="";
	alen = document.frmList.chkid.length;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			if(document.frmList.chkid[i].checked==true)	strchon+=document.frmList.chkid[i].value+",";
	}
	else
	{
		if(document.frmList.chkid.checked==true)
		strchon=document.frmList.chkid.value;
	}
	document.frmList.chon.value=strchon;
}

function delCurObj(val)
{
	var frm = eval('document.frmList');
	alen = frm.chkid.length;
	if(alen>0)
	{
		for(i=0;i<alen;i++)
		{
			if(frm.chkid[i].value==val) frm.chkid[i].checked = true;
			else frm.chkid[i].checked = false;
		}
	}
	else
	{
		frm.chkid.checked = true;
	}
	if(checkInput()) frm.submit();
}

function doDelete()
{
	if(checkInput()) document.frmList.submit();
}

function checkInput()
{
	mes = 'Are you sure want to delete them';
	var isChecked=false;
	alen = document.frmList.chkid.length;
	if (alen>0)
	{
		for(var i=0;i<alen;i++)
			if(document.frmList.chkid[i].checked==true)	isChecked=true;
	}
	else
	{
		if(document.frmList.chkid.checked==true)	isChecked=true;
	}

	if (!isChecked)	alert("Please select at least one of them");
	else
	{
		if(!confirm(mes))	isChecked=false;
		else	calculatechon();
	}
	return isChecked;
}

function setSizeDiv()
{
	if(screen.width < 1024)
	{
		pageW = 1000;
		window.scrollBar = 'yes';
	}
	else
	{
		pageW = MYPAGE.offsetWidth;
	}
	pageH = MYPAGE.offsetHeight;
	menuW = 0;
	mainH = pageH - (BANNER.offsetHeight + FOOTER.offsetHeight + 10);
	
	if(document.all["MENU"]) 
	{
		MENU.style.height = mainH;
		menuW = MENU.offsetWidth;
	}
	if(document.all && document.all["tblList"])
	{
		document.all["tblList"].style.width = 400;
	}
	if(document.all["MAIN"])
	{
		//if(document.all["HEADPAGE"]) mainH -= HEADPAGE.offsetHeight;
		MAIN.style.height = pageH - (MAIN.offsetTop + FOOTER.offsetHeight + 10);
		if(document.all)
		{
			var extW = MAIN.offsetLeft + 10;
			if(document.all["tblList"])
			{
				extW = menuW + 420;
			}
			MAIN.style.width = pageW - extW;
		}
		else
		{
			MAIN.style.width = pageW - MAIN.offsetLeft - 5;
		}
	}
	
	if(document.all["headLink"]) 
	{
		headLink.scrollLeft = headLink.offsetWidth;
	}
}

function changeScrollStatus(step)
{
	if(!step) step = -50;
	var newPos = headLink.scrollLeft + step;
	headLink.scrollLeft = newPos;
}

function getCurrentModule(module)
{
	var moduleText = eval('text_' + module);
	var module = eval(module);
	if(module)
	{
		MENU.scrollTop = module.offsetTop;
	}
	if(moduleText)
	{
		moduleText.style.color = '#FF6600';
		moduleText.style.fontWeight = 'bold';
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
