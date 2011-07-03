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

$fileContent = NULL;

$sels = "press_name, press_image, press_url";
$conds = "press_view = 1";
$others = "ORDER BY press_order";
$sql->set_query("vot_press", $sels, $conds, $others);
if($sql->nRows > 0)
{
	$fileContent .= '<script language="javascript">'."\n";
	while($sql->set_farray())
	{
		$advName = $sql->farray["press_name"];
		$advImg = $sql->farray["press_image"];
		$advUrl = $sql->farray["press_url"];
		if(is_file("$_ROOT_PATH/$advImg"))
		{
			$fileContent .= 'leftrightslide[lefttorightcount++]=\'<a href="'.$advUrl.'" target="_blank"><img src="'.$_URL_BASE.'/'.$advImg.'" width="109" height="55" alt="'.$advName.'" border="0" hspace="5" vspace="5"></a>\';'."\n";
		}
	}
	$fileContent .= '</script>';
}

saveFile("../html_includes/baochi.htm",$fileContent);
?>