<?
$_URL_BASE 	= NULL;
$_ROOT_PATH = $DOCUMENT_ROOT;

if($config["root_path"])
{
	$_ROOT_PATH 	= $config["root_path"];
}

if($config["script_path"] != NULL)
{
	$_ROOT_PATH 	.= "/".$config["script_path"];
	$_URL_BASE 	.= "/".$config["script_path"];
}

$tempString = NULL;
$contentFile = '
<script language="javascript">
var slideListImg = new Array();
var curKeySlidePhoto = 0;'."\n";
$count = 0;
$conds = "slideshow_view = 1";
$others = "ORDER BY slideshow_order ASC";
$sql->set_query("vot_slideshow", "slideshow_image", $conds, $others);
while($sql->set_farray())
{
	$slideImg = $sql->farray["slideshow_image"];
	if(is_file("$_ROOT_PATH/$slideImg"))
	{
		$slideImg = "$_URL_BASE/$slideImg";
		
		$contentFile .= "
		slideListImg[$count] = new Image();
		slideListImg[$count].src = '".$slideImg."';\n";
		$count++;
	}
}
if($count > 0)
{
	$contentFile .= "
	document.write('<div><img src=\"'+slideListImg[0]+'\" width=\"".$config["site_widthslide"]."\" height=\"".$config["site_heightslide"]."\" name=\"ssPic\"></div>');
	slideShow();";
}
$contentFile .= "\n</script>";

saveFile("../html_includes/slideshow.htm",$contentFile);
?>