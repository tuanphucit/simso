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

$menuBar = NULL;

$conds = "language_id = '".$LANG."' AND menubar_view = 1";
$others = "ORDER BY menubar_order";
$sql->set_query("vot_menubar", "*", $conds, $others);
if($sql->nRows > 0)
{
	$menuBar .= '
	<div id="module-menu">
		<ul id="menu" >'."\n";
		
	while($sql->set_farray())
	{
		$mnName = $sql->farray["menubar_name"];
		$mnCode = $sql->farray["menubar_code"];
		$mnLinkto = $sql->farray["menubar_linkto"];
		$mnType = $sql->farray["menubar_type"];
		
		$mnLinkto = "$_URL_BASE/$mnLinkto";
		
		if($mnType == 0)
		{
			$menuBar .= '<li class="node"><a href="'.$mnLinkto.'">'.$mnName.'</a></li>'."\n";
		}
		else
		{
			$menuBar .= '<li class="node"><a>'.$mnName.'</a>'."\n";
			$menuBar .= creatMenu(0, $mnCode, $mnLinkto)."\n".'</li>';
		}
	}
	$menuBar .= "\n".'</ul>'."\n".'</div>';
}

saveFile("../html_includes/menubar.htm",$menuBar);
?>