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

$contentPage = '
<table width="894" cellpadding="0" cellspacing="0" border="0" align="center">
	<tr><td id="footerPage">';
	
$conds = "language_id = '".$LANG."' AND html_id = 'footer'";
$sql->set_query("vot_html", "*", $conds);
if($sql->set_farray())
{	
	$contentPage .= $sql->farray["html_detail"];
}
$contentPage .= '</td></tr></table>';

saveFile("../html_includes/footer_page_$LANG.htm",$contentPage);
?>