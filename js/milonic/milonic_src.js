/*

Milonic DHTML Menu - JavaScript Website Navigation System.
Version 5.801 - Built: Thursday August 21 2008 - 10:06
Copyright 2008 (c) Milonic Solutions Limited. All Rights Reserved.
This is a commercial software product, please visit http://www.milonic.com/ for more information.
See http://www.milonic.com/license.php for Commercial License Agreement
All Copyright statements must always remain in place in all files at all times

*******  PLEASE NOTE: THIS IS NOT FREE SOFTWARE, IT MUST BE LICENSED FOR ALL USE  ******* 

License Number: 1000 for Unlicensed

*/

lNum = 1000;
lURL = "Unlicensed";
lVer = "5.801";
_mD = 2;
_d = document;
_dB = _d.body;
_n = navigator;
_L = location;
_nv = $tU(_n.appVersion);
_nu = $tU(_n.userAgent);
_ps = parseInt(_n.productSub);
_cls = _toL = X_ = Y_ = _n = null;
_W = window;
_wp = _W.createPopup;
ie = (_d.all)?1:0;
ie4 = (!_d.getElementById&&ie)?1:0;
ie5 = (!ie4&&ie&&!_wp)?1:0;
ie55 = (!ie4&&ie&&_wp)?1:0;
ie7 = (_nu.indexOf("MSIE 7")!=-1)?1:0;
ns6 = (_nu.indexOf("GECKO")!=-1)?1:0;
konq = (_nu.indexOf("KONQUEROR")!=-1)?1:0;
sfri = (_nu.indexOf("SAFARI")!=-1)?1:0;
if(konq||sfri)
{
	_ps = 0;
	ns6 = 0;
}
ns4 = (_d.layers)?1:0;
ns61 = (_ps>=20010726)?1:0;
ns7 = (_ps>=20020823)?1:0;
ns72 = (_ps>=20040804)?1:0;
ff15 = (_ps>=20060000)?1:0;
op = (_W.opera)?1:0;
mac = (_nv.indexOf("MAC")!=-1)?1:0;
if(ns6||ns4||op||sfri) mac = 0;
ns60 = 0;
if(ns6&&!ns61) ns60 = 1;
IEDtD = 0;
if(!op&&((_d.all||ns7)&&_d.compatMode=="CSS1Compat")||(mac&&_d.doctype&&_d.doctype.name.indexOf(".dtd")!=-1))IEDtD = 1;
_jv = "javascript:;";
inEditMode = _rstC = inDragMode = _d.dne = lcl = $R1 = $mD = _mcnt = _sL = _sT = _ofMT = _oldbW = _bW = _oldbH = _bl = _el = _st = _en = _cKA = $BW = 0;
_mtX = "";
_startM = _c = 1;
_trueItemRef = focusedMenu = t_ = _itemRef = _mn = -1;
_zi = _aN = _bH = 999;
if(op) ie55 = 0;
B$ = "absolute";
$O = "menu"; 
$5 = "hidden";
$_O = "scroll";

function $c(v)
{
	if(_d.getElementById) return _d.getElementById(v);
	if(_d.all)return _d.all[v]
}

function _StO(f,m)
{
	return setTimeout(f,m)
}

_m = [];
_mi = [];
_sm = [];
_tsm = [];
_cip = [];
$S3 = "2E636F6D2F";
$S4 = "646D2E706870";
$S5 = 4048;
_MT = _StO("",0);
_oMT = _StO("",0);
_cMT = _StO("",0);
_mst = _StO("",0);
_Mtip = _StO("",0);
$u = "undefined ";
_Lhr = _L.href;
$6 = "visible";

function M_hideLayer(){}
function _oTree(){}
function mmMouseMove(){}
function _TtM(){}
function _IdM(){}
function _ocURL(){}
function mmClick(){}
function autoOT(){}
function _iF0C(){}
function showtip(){}
function isEditMode(){}
function hidetip(){}
function mmVisFunction(){}
function doMenuResize(){}
function _tMR(){}
function _maxm(){}
function _p8(a,d)
{
	var t = [];
	for(_a=0;_a<a.length;_a++)
	{
		if(a[_a]!=d)
		{
			t[t.length]=a[_a];
		}
	}
	return t;
}
function copyOf(w)
{
	for(_cO in w)
	{
		this[_cO] = w[_cO];
	}
}
function $tL(v)
{
	if(v) return v.toLowerCase();
}
function $tU(v)
{
	if(v) return v.toUpperCase();
}
function $pU(v)
{
	if(v) return parseInt(v);
}

_lDd = 0;

function _gLd()
{
	if(_d.readyState&&_d.readyState!="complete")
	{
		setTimeout("_gLd()",50);
		return
	}
	_lDd = 1;
	_oldbH = 0;
}

if(!_d.readyState&&!ns4)
{
	_d.addEventListener('DOMContentLoaded',_gLd,false);
}
else 
{
	setTimeout("_gLd()",50);
}

function drawMenus()
{
	_startM = 1;
	_oldbH = 0;
	_oldbW = 0;
	_baL = 0;
	if(_W.buildAfterLoad) _baL = 1;
	for(_y=_mcnt;_y<_m.length;_y++)
	{
		o$(_y,1,_baL);
	}
	if(_W._pageIsXML)
	{
		var G = $c(_menuContainer);
		if(!G)
		{
			G = _d.createElement("div");
			G.id = _menuContainer;
			_dB.appendChild(G);
		}
		G.innerHTML = _mtX;
	}
}
_$S = {
	menu : 0,
	text : 1,
	url : 2,
	showmenu : 3,
	status : 4,
	onbgcolor : 5,
	oncolor : 6,
	offbgcolor : 7,
	offcolor : 8,
	offborder : 9,
	separatorcolor : 10,
	padding : 11,
	fontsize : 12,
	fontstyle : 13,
	fontweight : 14,
	fontfamily : 15,
	high3dcolor : 16,
	low3dcolor : 17,
	pagecolor : 18,
	pagebgcolor : 19,
	headercolor : 20,
	headerbgcolor : 21,
	subimagepadding : 22,
	subimageposition : 23,
	subimage : 24,
	onborder : 25,
	ondecoration : 26,
	separatorsize : 27,
	itemheight : 28,
	image : 29,
	imageposition : 30,
	imagealign : 31,
	overimage : 32,
	decoration : 33,
	type : 34,
	target : 35,
	align : 36,
	imageheight : 37,
	imagewidth : 38,
	openonclick : 39,
	closeonclick : 40,
	keepalive : 41,
	onfunction : 42,
	offfunction : 43,
	onbold : 44,
	onitalic : 45,
	bgimage : 46,
	overbgimage : 47,
	onsubimage : 48,
	separatorheight : 49,
	separatorwidth : 50,
	separatorpadding : 51,
	separatoralign : 52,
	onclass : 53,
	offclass : 54,
	itemwidth : 55,
	pageimage : 56,
	targetfeatures : 57,
	visitedcolor : 58,
	pointer : 59,
	imagepadding : 60,
	valign : 61,
	clickfunction : 62,
	bordercolor : 63,
	borderstyle : 64,
	borderwidth : 65,
	overfilter : 66,
	outfilter : 67,
	margin : 68,
	pagebgimage : 69,
	swap3d : 70,
	separatorimage : 71,
	pageclass : 72,
	menubgimage : 73,
	headerborder : 74,
	pageborder : 75,
	title : 76,
	pagematch : 77,
	rawcss : 78,
	fileimage : 79,
	clickcolor : 80,
	clickbgcolor : 81,
	clickimage : 82,
	clicksubimage : 83,
	imageurl : 84,
	pagesubimage : 85,
	dragable : 86,
	clickclass : 87,
	clickbgimage : 88,
	imageborderwidth : 89,
	overseparatorimage : 90,
	clickseparatorimage : 91,
	pageseparatorimage:92,
	menubgcolor:93,
	opendelay:94,
	tooltip:95,
	disabled:96,
	dividespan:97,
	tipdelay:98,
	tipfollow:99,
	tipmenu:100,
	menustyle:101,
	pageoncolor:102,
	id:103,
	overpageimage:104,
	nowrap:105,
	overflow:106,
	hotkey:107,
	leftimage:108,
	rightimage:109,
	overleftimage:110,
	overrightimage:111,
	pageleftimage:112,
	pagerightimage:113,
	nobreadcrumb:114,
	custom:115,
	subimagecss:116,
	onsubimagecss:117,
	regexmatch:118,
	lineheight:119
};
function mm_style()
{
	for($i in _$S)
	{
		this[$i] = _n;
	}
	this.built = 0;
}
_$M = {
	items:0,
	name:1,
	top:2,
	left:3,
	itemwidth:4,
	screenposition:5,
	style:6,
	alwaysvisible:7,
	align:8,
	orientation:9,
	keepalive:10,
	openstyle:11,
	margin:12,
	overflow:13,
	position:14,
	overfilter:15,
	outfilter:16,
	menuwidth:17,
	itemheight:18,
	followscroll:19,
	menualign:20,
	mm_callItem:21,
	mm_obj_ref:22,
	mm_built:23,
	menuheight:24,
	ignorecollision:25,
	divides:26,
	zindex:27,
	opendelay:28,
	resizable:29,
	minwidth:30,
	maxwidth:31,
	mm_fixheight:32,
	C:33,
	rawcss:34,
	minleft:35
};
function menuname(name)
{
	for($i in _$M) this[$i]=_n;
	this.name = $tL(name);
	_c = 1;
	_mn++;
}
function f_(i)
{
	_mi[_bl] = [];
	_mi[_bl][0] = _mn;
	i = i.split(";");
	_sc = "";
	for(var a=0; a<i.length; a++)
	{
		var p = i[a].indexOf("`");
		if(p!=-1)
		{
			_sc = ";";
			_tI = i[a];
			if(p==i[a].lastIndexOf("`"))
			{
				for(var b=a;b<i.length;b++)
				{
					if(i[b+1])
					{
						_tI += ";" + i[b+1];
						a++;
						if(i[b+1].indexOf("`")!=-1) b = i.length;
					}
				}
			}
			i[a] = _tI.replace(/`/g,"");
		}
		p = i[a].indexOf("=");
		if(p==-1)
		{
			if(i[a])_si = _si + ";" + i[a] + _sc;
		}
		else
		{
			_si = i[a].slice(p+1);
			_w = i[a].slice(0,p);
			if(_w=="showmenu") _si = $tL(_si);
		}
		if(i[a]&&_$S[_w]) _mi[_bl][_$S[_w]] = _si;
	}
	var S = _x[6];
	if(_mi[_bl][101]) S = eval(_mi[_bl][101]);
	for($i in S)
	{
		if(S[$i])
		{
			var v = _mi[_bl][_$S[$i]];
			if(!v&&v!="") _mi[_bl][_$S[$i]] = S[$i];
		}
	}
	_m[_mn][0][_c-2] = _bl;
	_c++;
	_bl++;
}

_c = 0;

function ami(t)
{
	_t = this;
	if(_c==1)
	{
		_c++;
		_m[_mn] = [];
		_x = _m[_mn];
		for($i in _t) _x[_$M[$i]] = _t[$i];
		_x[21] = -1;
		_x[0] = [];
		if(!_x[12]) _x[12] = 0;
		var s = _m[_mn][6];
		var m = _m[_mn];
		if(m[15]==_n) m[15] = s.overfilter;
		if(m[16]==_n) m[16] = s.outfilter;
		if(m[13]==_n) m[13] = s.overflow;
		s[65] = (s.borderwidth)?$pU(s.borderwidth):0;
		s[64] = s.borderstyle;
		s[63] = s.bordercolor;
		if(_W.ignoreCollisions) m[25] = 1;
		if(!s.built)
		{
			_WzI = _zi;
			if(_W.menuZIndex)
			{
				_WzI = _W.menuZIndex;
				_zi = _WzI
			}
			lcl++;
			var v = s.visitedcolor;
			if(v&&!_W._pageIsXML)
			{
				_oC = s.offcolor;
				if(!_oC) _oC = "#000000";
				if(!v) v = "#ff0000";
				_d.write("<style>.g_"+lcl+":link{color:"+_oC+"}.g_"+lcl+":visited{color:"+v+"}</style>");
				s.g_ = "g_" + lcl;
			}
			s.built = 1
		}
	}
	f_(t);
}
menuname.prototype.aI = ami;
