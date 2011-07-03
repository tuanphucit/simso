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

require_once("$_LANG_DIR/$LANG_DIR/define.php");


$opt = new option;
$maxLevel = $opt->optionvalue("vot_modules", "MAX(modules_level)", "language_id='".$LANG."' AND modules_view=1");


$menuBar = NULL;
$menuLeft = NULL;
$menuBottom = NULL;
$curParent = NULL;
$parentID = array(0);
//chi cho so ra 2 cap


for($i=0; $i<=$maxLevel; $i++) //ban goc
{	
	if(sizeof($parentID) > 1)
	{
		$strParentID = implode("','", $parentID);
	}
	else
	{
		$strParentID = $parentID[sizeof($parentID)-1];
	}
	if($i == 0)
	{
		$menuBar .= '
		<script language="javascript">
		with(milonic = new menuname("mainMenu"))
		{
			alwaysvisible = 1;
			orientation = "horizontal";
			style=mainMenuStyle;
			';
			$menuBar .= "\n".'aI("text='.$define["var_trangchu"].';url='.$_URL_BASE.'/;showmenu=mainMenu_home;");';
	}
	$count = 0;
	$parentID = array();

	$conds = "language_id='".$LANG."' AND modules_parent IN ('".$strParentID."') AND modules_view=1 AND modules_level=$i";
	$others = "ORDER BY modules_parent, modules_order ASC";
	$sql->set_query("vot_modules", "*", $conds, $others);
	$tRows = $sql->nRows;
	while($sql->set_farray())
	{
		$mnItemId = $sql->farray["modules_id"];
		$mnItemParent = $sql->farray["modules_parent"];
		$mnItemName = $sql->farray["modules_name"];
		$mnItemLink = $sql->farray["modules_linkto"];
		$mnItemType = $sql->farray["modules_type"];
		$mnItemSub = $sql->farray["modules_sub"];
		$mnItemPos = split(",", $sql->farray["modules_pos"]);
		$mncap = $sql->farray["modules_cap"];
		
		if($i == 0)
		{
			if($mnItemPos[0])
			{
				$mnItemLink = "$_URL_BASE/index.php/$mnItemId/$mnItemLink";
				if($mnItemSub)
				{
					$parentID[$count] = $mnItemId;
					$mnItemLink = NULL;
					$count ++;
					$a = $count;
				}
				$mnSubName = "mainMenu_$mnItemId";
				$menuBar .= "\n".drawMenuItem($mnItemName, $mnItemLink, $mnItemSub, $mnSubName);

				//$menuBar .= $count;
			}
			if($mnItemPos[1])
			{
				$leftMenuID = $mnItemId;
				$leftMenuTitle = $mnItemName;
			}

		}
		else 
		{
			
			$mnItemLink = "$_URL_BASE/index.php/$mnItemId/$mnItemLink";
		
		if($mncap == 0)
		{
			if($mnItemSub)
			{
				$parentID[$count] = $mnItemId;
				if(!$mnItemType) $mnItemLink = NULL;
				$count ++;
			}
		 }
			if($curParent != $mnItemParent)
			{
				$curParent = $mnItemParent;
				/*
				if($i == 0 && !$isEndMain)
				{
					$menuBar .= "\n".'aI("text='.$define["var_lienhe"].';url='.$_URL_BASE.'/index.php/contact ;showmenu=mainMenu_contact;");';
					$isEndMain = 1;
				}
				*/
				$menuBar .= '
			}
				with(milonic = new menuname("mainMenu_'.$curParent.'"))
				{
					style = subMainMenuStyle;';
				}
			if($mncap == 0) $mnSubName = "mainMenu_$mnItemId";
			else $mnSubName = NULL;
			
			$menuBar .= "\n".drawMenuItem($mnItemName, $mnItemLink, $mnItemSub, $mnSubName);
		 }
		 
		 
	}
	//if($i == 2)//
	if($i == $maxLevel) //ban goc
	{	
		//$menuBar .= $i;
		$menuBar .= "\n".'}';
		$menuBar .= "\n".'drawMenus();'."\n".'</script>';
		$menuBar .= "\n".'<div style="visibility:hidden"><a href="http://www.milonic.com/">DHTML Menu By Milonic JavaScript</a></div>';
	}
}//end for
$menuBottom = '
<table align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="menuBottom"><a href="'.$_URL_BASE.'/">'.$define["var_trangchu"].'</a></td>';
		
$conds = "language_id='".$LANG."' AND modules_parent=0 AND modules_view=1";
$others = "ORDER BY modules_order ASC";
$sql->set_query("vot_modules", "*", $conds, $others);
while($sql->set_farray())
{
	$mnItemId = $sql->farray["modules_id"];
	$mnItemName = strip_tags($sql->farray["modules_name"]);
	$mnItemLink = $sql->farray["modules_linkto"];
	$mnItemType = $sql->farray["modules_type"];
	$mnItemSub = $sql->farray["modules_sub"];
	$mnItemPos = split(",", $sql->farray["modules_pos"]);

	if($mnItemPos[0])
	{
		$mnItemLink = "$_URL_BASE/index.php/$mnItemId/$mnItemLink";
		$menuBottom .= '
		<td class="menuBottom" width=2>|</td>
		<td class="menuBottom"><a href="'.$mnItemLink.'">'.$mnItemName.'</a></td>
		
		';
	}
}
//$menuBottom .= '<td class="menuBottom" width=2>|</td>
//				<td class="menuBottom"><a href="'.$_URL_BASE.'/index.php/contact">'.$define["var_lienhe"].'</a></td>
$menuBottom .= '</tr>
</table>';
$menufooter = '
<table align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>';
		
$conds = "language_id='".$LANG."' AND modules_parent=0 AND modules_view=1";
$others = "ORDER BY modules_order ASC";
$sql->set_query("vot_modules", "*", $conds, $others);
while($sql->set_farray())
{
	$mnItemId = $sql->farray["modules_id"];
	$mnItemName = strip_tags($sql->farray["modules_name"]);
	$mnItemLink = $sql->farray["modules_linkto"];
	$mnItemType = $sql->farray["modules_type"];
	$mnItemSub = $sql->farray["modules_sub"];
	$mnItemPos = split(",", $sql->farray["modules_pos"]);
	$image = $sql->farray["modules_icon"];

	if($mnItemPos[3])
	{
		$mnItemLink = "$_URL_BASE/index.php/$mnItemId/$mnItemLink";
		
		if(is_file("$_ROOT_PATH/$image"))
				 {
					$imgSize = imageSize("$_ROOT_PATH/$image", 100, 115);
					$infoImg = "<img src=\"$_URL_BASE/$image\" width=\"$imgSize[0]\" height=\"$imgSize[1]\" border=\"0\" style=\"\">";
				  }
		$menufooter .= '
		<td style="padding:0px 50px 0px 50px"><a href="'.$mnItemLink.'">'.$infoImg.'</a></td>
		';
	}
}
//$menuBottom .= '<td class="menuBottom" width=2>|</td>
//				<td class="menuBottom"><a href="'.$_URL_BASE.'/index.php/contact">'.$define["var_lienhe"].'</a></td>
$menufooter .= '</tr>
</table>';
$fileDes = "$_ROOT_PATH/html_includes/menubar_$LANG.htm";
saveFile($fileDes, $menuBar);
$fileDes = "$_ROOT_PATH/html_includes/leftmenu_$LANG.htm";
saveFile($fileDes, $leftMenu);
$fileDes = "$_ROOT_PATH/html_includes/menubottom_$LANG.htm";
saveFile($fileDes, $menuBottom);
$fileDes = "$_ROOT_PATH/html_includes/menufooter_$LANG.htm";
saveFile($fileDes, $menufooter);

?>