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

$_JS_DIR 		= "$_URL_BASE/js";
$_CSS_DIR 	= "$_URL_BASE/css";
$_IMG_DIR 	= "$_URL_BASE/images";
$_INCS_DIR 	= "$_ROOT_PATH/includes";
$_HTML_DIR 	= "$_ROOT_PATH/html_includes";
$_LANG_DIR 	= "$_ROOT_PATH/languages";

$bannerAdv = NULL;
$leftAdv = NULL;

$sels = "advertising_name, advertising_image, advertising_url";
$conds = "language_id = '".$LANG."' AND advertising_view = 1 AND advertising_pos = 1";
$others = "ORDER BY advertising_order ASC";
$sql->set_query("vot_advertising", $sels, $conds, $others);
if($sql->nRows > 0)
{
	$leftAdv .= '
	<table width="92%" cellpadding="0" cellspacing="0" align="center" border="0">
		<tr>
			<td height="6"></td>
		</tr>
		<tr>
			<td class="rightBlockTitle" background="<?=$_IMG_DIR?>/icons/quangcao.jpg"><?=$define["var_quangcao"]?></td>
		</tr>
		<tr>
			<td height="2"></td>
		</tr>';
	while($sql->set_farray())
	{
		$advName = $sql->farray["advertising_name"];
		$advImg = $sql->farray["advertising_image"];
		$advUrl = $sql->farray["advertising_url"];
		if(is_file("$_ROOT_PATH/$advImg"))
		{
			$leftAdv .= '
			<tr>
				<td align="center" style="padding-top:3px">
					<a href="'.$advUrl.'" target="_blank"><img src="'.$_URL_BASE.'/'.$advImg.'" width="190" alt="'.$advName.'" border="0"></a></td>
			</tr>';
		}
	}
	$leftAdv .= '<tr><td height="10"></td></tr></table>';
}
saveFile("../html_includes/right_advertising_$LANG.htm",$leftAdv);

$tempString = NULL;
$contentFile = '
<script language="javascript">
var slideListImg = new Array();
var slideListLink = new Array();
var curKeySlidePhoto = 0;'."\n";
$count = 0;
$conds = "language_id = '".$LANG."' AND advertising_view = 1 AND advertising_pos = 0";
$others = "ORDER BY advertising_order ASC";
$sql->set_query("vot_advertising", "*", $conds, $others);
while($sql->set_farray())
{
	$advUrl = $sql->farray["advertising_url"];
	$advImg = $sql->farray["advertising_image"];
	if(is_file("$_ROOT_PATH/$advImg"))
	{
		$advImg = "$_URL_BASE/$advImg";
		
		$contentFile .= "
		slideListLink[$count] = '".$advUrl."';
		slideListImg[$count] = new Image();
		slideListImg[$count].src = '".$advImg."';\n";
		$count++;
	}
}
if($count > 0)
{
	$contentFile .= "
	document.write('<a href=\"'+slideListLink[0]+'\" id=\"ssPicLink\"><img src=\"'+slideListImg[0]+'\" width=\"390\" height=\"70\" name=\"ssPic\" border=\"0\"></a>');
	slideShow();";
}
$contentFile .= "\n</script>";
saveFile("../html_includes/banner_advertising_$LANG.htm",$contentFile);
?>