<?
if(!$_PAGE_VALID)
{
	exit();
}

if(is_file("$_HTML_DIR/slideshow.htm"))
{
?>
<script language="javascript 1.2" src="<?=$_JS_DIR?>/scroller.js" type="text/javascript"></script>
<SCRIPT language=javascript>
<!--
	var iedom=document.all||document.getElementById;
	var sliderwidth="100%";

	var sliderheight="100";

	var slidespeed=2;

	slidebgcolor="";

	var leftrightslide=new Array()
	var finalslide='';
	var lefttorightcount=0;
//-->
</SCRIPT>
<? include_once("$_HTML_DIR/slideshow.htm")?>
<SCRIPT language=javascript><!--
	//Specify gap between each image (use HTML):
	var imagegap="";
	//Specify pixels gap between each slideshow rotation (use integer):
	var slideshowgap=0;
	////NO NEED TO EDIT BELOW THIS LINE/////
	var copyspeed2=slidespeed;
	if(leftrightslide.length > 0)
	{
		strLeftRightSlide = '';
		for(var i=0; i<leftrightslide.length; i++)
		{
			strLeftRightSlide += leftrightslide[i];
		}
		leftrightslide = '<nobr>'+strLeftRightSlide+'</nobr>';
	}
//										leftrightslide='<nobr>'+imgStr+'</nobr>';
	if (iedom){
		document.write('<span id="temp" style="visibility:hidden;position:absolute;top:0px;left:0px;width:' + sliderwidth + '>'+leftrightslide+'</span>');
	}
	var actualwidth='';
	var cross_slide, ns_slide;

	document.open();

	with (document){
		if (iedom){

			write('<div style="position:relative;left:2px;width:'+sliderwidth+';height:'+sliderheight+';overflow:hidden">');
			write('<div style="position:absolute;width:'+sliderwidth+';height:'+sliderheight+';background-color:'+slidebgcolor+'" onMouseover="copyspeed2=0" onMouseout="copyspeed2=slidespeed">');
			write('<div id="test2" style="position:absolute;left:0px;top:0px"></div>');
			write('<div id="test3" style="position:absolute;left:0px;top:0px"></div>');
			write('</div></div>');
		}
		else if (document.layers){
			write('<ilayer align=center left=2px width='+sliderwidth+' height='+sliderheight+' name="ns_slidemenu" bgColor='+slidebgcolor+'>');
			write('<layer name="ns_slidemenu2" left=0 top=0 onMouseover="copyspeed2=0" onMouseout="copyspeed2=slidespeed"></layer>');
			write('<layer name="ns_slidemenu3" left=0 top=0 onMouseover="copyspeed2=0" onMouseout="copyspeed2=slidespeed"></layer>');
			write('</ilayer>');
		}
	}
	document.close();
	window.onload=startSlide;

	function startSlide(){
		fillup();
	}
	//-->
</SCRIPT>
<?
}
?>
