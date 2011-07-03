
fixMozillaZIndex = true; //Fixes Z-Index problem  with Mozilla browsers but causes odd scrolling problem, toggle to see if it helps
_menuCloseDelay = 500;
_menuOpenDelay = 50;
_subOffsetTop = 2;
_subOffsetLeft = -2;

with(mainMenuStyle = new mm_style())
{
	fontfamily = "tahoma";
	fontsize="12";
	offcolor="#073e41";
	oncolor="#e5710e";
	outfilter="randomdissolve(duration=0.3)";
	//leftimage = _img_dir.concat("/subimagepadding.jpg");//images o giua 2 menu
	//rightimage = _img_dir.concat("/subimagepadding.jpg");//images o giua 2 menu
	//subimage = _img_dir.concat("/arrow_down.gif");
	itemheight = 33;
	//itemwidth = 110;
	align = "center";
	fontweight = "bold";
	bgimage = _img_dir.concat("/menu_bar_bg.jpg");
	//separatorsize = 2;
	//subimagepadding = "5px 5px 0px 0px";
	pagecolor="#e5710e";
	padding = "2px 20px 0px 20px";
}

with(subMainMenuStyle = new mm_style())
{
	fontfamily = "Tahoma";
	fontsize="12";
	offbgcolor="#26af9d";
	offcolor="#FFFFFF";
	onbgcolor="#09F634";
	oncolor="#fb5b05";
	outfilter="randomdissolve(duration=0.3)";
	overfilter="Fade(duration=0.2);Alpha(opacity=95)";
	padding = "3px 17px 3px 15px";
	pagebgcolor="#09F634";
	separatorcolor = "#FFFFFF";
	separatorsize = 1;
	subimage = _img_dir.concat("/mnleft_arrow.gif");
	subimagepadding = 2;
}

with(leftMenuStyle = new mm_style())
{
	fontfamily = "Tahoma, Arial, Verdana";
	fontsize="11";
	offcolor="#c62f0b";
	oncolor="#91054D";
	fontweight = "bold";
	outfilter="randomdissolve(duration=0.3)";
	subimage = _img_dir.concat("/left_arrow.gif");
	itemheight = 23;
	itemwidth = 173;
	align = "left";
	fontweight = "bold";
	image = _img_dir.concat("/mnleft_arrow.gif");
	separatorsize = 1;
	separatorcolor = "#74a2de";
	subimagepadding = 0;
	padding = "0px 0px 0px 10px";
	position = "relative";
}

with(subLeftMenuStyle = new mm_style())
{
	fontfamily = "Arial,Verdana, Tahoma";
	fontsize="12";
	//offbgcolor="#fec083";
	offcolor="#000000";
	fontweight = "bold";
	onbgcolor="#F6F4F5";
	oncolor="#fb5b05";
	outfilter="randomdissolve(duration=0.3)";
	overfilter="Fade(duration=0.2);Alpha(opacity=80)";
	padding = "3px 17px 3px 15px";
	pagebgcolor="#F2F2BE";
	separatorcolor = "#FFFFFF";
	separatorsize = 1;
	subimage = _img_dir.concat("/mnleft_arrow.gif");
	subimagepadding = 2;
}
with(mainMenuLeftStyle = new mm_style())
{
	fontfamily = "Tahoma, Arial,Verdana";
	fontsize="12";
	offcolor="#006667";
	oncolor="#ff6503";
	//offbgcolor="#2aad9f";
	//onbgcolor="#09F634";
	fontweight = "bold";
	padding = "1px 0px 1px 27px";
	//leftimage = _img_dir.concat("/right_arrow.png");
	bgimage = _img_dir.concat("/Subleftmenu_2.jpg");
	overbgimage = _img_dir.concat("/subleftmenu_hover.jpg")
	itemwidth = 180;
	itemheight = 26;
	//separatorsize = 1;
	separatorcolor = "#e2c18c";
	position = "relative";
	//subimage = _img_dir.concat("/mndown_arrow.gif");
	//subimagepadding = "3px 0px 3px 0px";
}

with(subMainMenuLeftStyle = new mm_style())
{
	fontfamily = "Tahoma, Arial,Verdana";
	fontsize="11";
	offbgcolor="#2aad9f";
	offcolor="#FFFFFF";
	onbgcolor="#09F634";
	oncolor="#333333";
	outfilter="randomdissolve(duration=0.3)";
	overfilter="Fade(duration=0.2);Alpha(opacity=85);Shadow(color=#777777', Direction=135, Strength=3)";
	padding = "1px 17px 1px 15px";
	separatorcolor = "#e2c18c";
	separatorsize = 1;
	itemheight = 20;
	subimage = _img_dir.concat("/mnleft_arrow.gif");
	subimagepadding = 1;
}
