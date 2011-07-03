<?
if(!$_PAGE_VALID)
{
	exit();
}

function outputJavascriptForRoot()
{
	global $lang, $define, $_URL_BASE;
	$sql = new mysql;
	$result  = '<script language="javascript">'."\n";
	$result .= "foldersTree = gFld('".$define["var_trangchu"]."', '".$_URL_BASE."/');"."\n";
	$conds = "language_id='".$lang."' AND modules_parent=0 AND modules_view=1";
	$others = "ORDER BY modules_order ASC";
	$sql->set_query("vot_modules", "*", $conds, $others);
	$count = 0;
	$listVarName = NULL;
	while($sql->set_farray())
	{
		$folderId = $sql->farray["modules_id"];
		$nodeName = strip_tags($sql->farray["modules_name"]);
		$nodeLink = NULL;
		if($sql->farray["modules_type"] != NULL)
		{
			$nodeLink = "$_URL_BASE/index.php/$folderId/".$sql->farray["modules_linkto"];
		}
		if($count > 0) $listVarName .= ", ";
		$listVarName .= "fSub$folderId";
		$result .= outputJavascriptForSubFolder($folderId, $nodeName, $nodeLink, "fSub$folderId");
		$count++;
	}
	$result .= "fSubContact = gFld('".$define["var_lienhe"]."', '".$_URL_BASE."/index.php/contact');"."\n";
	$result .= "fSubContact.xID = 'xIDContact';"."\n";
	$result .= "foldersTree.addChildren([$listVarName,fSubContact]);"."\n";
	$result .= 'foldersTree.treeID = "L1";'."\n";
	$result .= 'foldersTree.xID = "bigtree";'."\n";
	$result .= "</script>";
	return $result;
}


function outputJavascriptForSubFolder($folderId, $nodeName, $nodeLink, $fName)
{
	//dim rsHits, queryString, gFldStr, gLnkStr, fi, subFolders, di
	global $_URL_BASE;
	$result = NULL;
	$sql = new mysql;
	$conds = "modules_parent='".$folderId."' AND modules_sub=1 AND modules_view=1";
	$others = "ORDER BY modules_order ASC";
	$sql->set_query("vot_modules", "*", $conds, $others);
	$fi = 1;
	$strAddChildren = $fName . ".addChildren([";
	while($sql->set_farray())
	{
		$nodeId = $sql->farray["modules_id"];
		$sNodeName = strip_tags($sql->farray["modules_name"]);
		$sNodeLink = NULL;
		if($sql->farray["modules_type"] != NULL)
		{
			$sNodeLink = "$_URL_BASE/index.php/$nodeId/".$sql->farray["modules_linkto"];
		}
		$result .= outputJavascriptForSubFolder($nodeId, $sNodeName, $sNodeLink, $fName."Sub".$fi);
		if($fi > 1)
		{
			$strAddChildren .= ", ";
		}
		$strAddChildren .= $fName . "Sub" . $fi;
		$fi++;
	}
	$subFolders = $fi-1; //Count how many
	$result .= $fName . " = " . "gFld('" . $nodeName . "', '".$nodeLink."');" . "\n";
	$result .= $fName . ".xID = 'xID" . $folderId . "';\n";

	$result .= $strAddChildren;
	
	$conds = "modules_parent='".$folderId."' AND modules_sub=0 AND modules_view=1";
	$others = "ORDER BY modules_level, modules_order ASC";
	$sql->set_query("vot_modules", "*", $conds, $others);
	$di = 1;
	$listChildren = NULL;
	while($sql->set_farray())
	{
		$sNodeId = $sql->farray["modules_id"];
		$sNodeName = strip_tags($sql->farray["modules_name"]);
		$sNodeLink = $sql->farray["modules_linkto"];
		if($di > 1 || $subFolders > 0)
		{
			$result .= ", ";
		}
		$linkTo = "$_URL_BASE/index.php/$sNodeId/$sNodeLink";
		$result .= "['" . $sNodeName . "', '" . $linkTo . "']";
		$listChildren .= $fName . ".children[" . ($di-1) . "].xID = 'xID" . $sNodeId . "';\n";
		$di++;
	}

	$result .= "]);" . "\n"; //Close addChildren function
	$result .= $listChildren;

	return $result;
}

$modIcon = "images/icons/icon_sitemap.jpg";
$curPage = $subPageTitle = $define["var_sitemap"];

$contentDetail = outputJavascriptForRoot();
//echo htmlspecialchars($contentDetail);

require_once("$_HTML_DIR/center_sitemap_page.php");
?>
