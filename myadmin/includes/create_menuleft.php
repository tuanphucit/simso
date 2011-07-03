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

$sql = new mysql;
$opt = new option;

$maxLevel = $opt->optionvalue("vot_modules", "MAX(modules_level)", "language_id='".$LANG."' AND modules_view=1");

$menuBar = NULL;

$conds = "language_id='".$LANG."' AND modules_parent=0 AND modules_view=1";
$others = "ORDER BY modules_order ASC";
$sql->set_query("vot_modules", "*", $conds, $others);
while($sql->set_farray())
{
	$mnItemId = $sql->farray["modules_id"];
	$mnItemName = $sql->farray["modules_name"];
	$mnItemLink = $sql->farray["modules_linkto"];
	$mnItemSub = $sql->farray["modules_sub"];
	$mnItemLink = "$_URL_BASE/index.php/$mnItemId/$mnItemLink";
	$menuBar .= "\n".'<div align="left" id="leftMenu_99" style="width:187">';
	$mnItemPos = split(",", $sql->farray["modules_pos"]);
if($mnItemPos[1])
	{
	/*if(!$mnItemSub)
	{
		$menuBar .= '<div id="leftMenuItem_'.$mnItemId.'" class="leftMenuItem"><a href="'.$mnItemLink.'"><span style="padding-left:20px">'.$mnItemName.'</span></a></div>';
	}
	else
	{*/
		 $menuBar .= '
		<div id="leftMenuItem_99" class="leftMenuItem" onClick="expandLeftMenu(99)"><div style="padding:6px 0px 5px 15px">'.$mnItemName.'</span></div></div>
		<div id="subLeftMenu_99" style="background-image:url('.$_IMG_DIR.'/menuleft_2.jpg);background-repeat:repreat-y; padding-top:10px" >';
		
		$curParent = NULL;
		$parentID = array($mnItemId);

		$mnItemLevel = $sql->farray["modules_level"] + 1;		

		for($i=$mnItemLevel; $i<=$maxLevel; $i++)
		{
			if(sizeof($parentID) > 1)
			{
				$strParentID = implode("','", $parentID);
			}
			else
			{
				$strParentID = $parentID[0];
			}
			if($i == $mnItemLevel)
			{
				$menuBar .= '
				<script language="javascript">
				with(milonic = new menuname("mainMenuLeft"))
				{
					alwaysvisible = 1;
					position = "relative";
					style = mainMenuLeftStyle;';
			}
			$count = 0;
			$parentID = array();
		
			echo $conds = "modules_parent IN ('".$strParentID."') AND modules_view=1 AND modules_level=$i";
			$others = "ORDER BY modules_parent, modules_order ASC";
			
			$ssql = new mysql;
			$ssql->set_query("vot_modules", "*", $conds, $others);
			while($ssql->set_farray())                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
			{
				$mnItemId = $ssql->farray["modules_id"];
				$mnItemParent = $ssql->farray["modules_parent"];
				$mnItemName = $ssql->farray["modules_name"];
				$mnItemLink = $ssql->farray["modules_linkto"];
				$mnItemSub = $ssql->farray["modules_sub"];
				
				$mnItemLink = "$_URL_BASE/index.php/$mnItemId/$mnItemLink";
				//$menuBar .= $mnItemcap;	
				if($i == $mnItemLevel)
				{	
					$mnItemImage = $ssql->farray["modules_image"];
					if(is_file("$_ROOT_PATH/$mnItemImage"))
					{
						$mnItemImage = "$_URL_BASE/$mnItemImage";
						$mnItemName = NULL;
					}
					else
					{
						$mnItemImage = NULL;
					}
			$mnItemcap = $ssql->farray["modules_cap"];
				if($mnItemcap == 0)
					{	
					if($mnItemSub)
						{
							$parentID[$count] = $mnItemId;
							$mnItemLink = NULL;
							$count ++;
						}
					}
					
					$mnSubName = "mainMenuLeft_$mnItemId";
					$menuBar .= "\n".drawMenuItem($mnItemName, $mnItemLink, $mnItemSub, $mnSubName);
				}
				else
				{
				
					
						if($mnItemSub)
						{
						$parentID[$count] = $mnItemId;
						$mnItemLink = NULL;
						$count ++;
						}
					
					if($curParent != $mnItemParent)
					{
						$curParent = $mnItemParent;
						$menuBar .= '
						}
						with(milonic = new menuname("mainMenuLeft_'.$curParent.'"))
						{
							style = subMainMenuLeftStyle;';
					}
				    $mnSubName = "mainMenuLeft_$mnItemId";
					$menuBar .= "\n".drawMenuItem($mnItemName,$mnItemLink, $mnItemSub, $mnSubName);
				}
			}
			if($i == $maxLevel)
			{
				$menuBar .= "\n".'}';
				$menuBar .= "\n".'drawMenus();'."\n".'</script>';
			}
		}
		$menuBar .= "\n".'</div>';
	//}
	$menuBar .= "\n".'<div><img src="'.$_IMG_DIR.'/menuleft_3.jpg" border="0"></div></div><div style="height:5"></div>';
 }	
}
$menuBar .= "\n".'<div style="display:none"><a href="http://www.milonic.com/">DHTML Menu By Milonic JavaScript</a></div>';

$fileDes = "$_ROOT_PATH/html_includes/menuleft_$LANG.htm";
saveFile($fileDes, $menuBar);
?>