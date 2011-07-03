<?
$sql = new mysql;
$opt = new option;

$and = "PARENTID=$PARENTID&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
$url = "index.php?module=$module&curPg=$curPg&$and";

$pageTitle = def_cacmucdulieuchinh;

if($PARENTID == NULL || $ses_parent_id == NULL) 
{
	$PARENTID = 0;

	$ses_parent_id = array();
	$ses_parent_url = array();
	$ses_parent_label = array();
}

$curLevel = getKeyInArray($PARENTID, $ses_parent_id);

$parentModPer = 0;
if($PARENTID)
{
	$parentModPer = $opt->optionvalue("vot_modules","modules_per","modules_id='".$PARENTID."'");
}

if($curLevel == -1)
{
	$curLevel = sizeof($ses_parent_id);
	$ses_parent_id[$curLevel] = $PARENTID;
	$ses_parent_url[$curLevel] = $url;
	if($curLevel < 1)
	{
		$ses_parent_label[$curLevel] = $pageTitle;
	}
	else
	{
		$conds = "modules_id='" . $ses_parent_id[$curLevel] . "'";
		$ses_parent_label[$curLevel] = strip_tags($opt->optionvalue("vot_modules","modules_name",$conds));
	}
}
else
{
	$new_parent_id = array();
	$new_parent_url = array();
	$new_parent_label = array();
	for($i = 0; $i <= $curLevel; $i++)
	{
		$new_parent_id[$i] = $ses_parent_id[$i];
		$new_parent_url[$i] = $ses_parent_url[$i];
		$new_parent_label[$i] = $ses_parent_label[$i];
	}
	$ses_parent_id = $new_parent_id;
	$ses_parent_url = $new_parent_url;
	$ses_parent_label = $new_parent_label;
}

_SESSION_REGISTER("ses_parent_id");
_SESSION_REGISTER("ses_parent_url");
_SESSION_REGISTER("ses_parent_label");

$linkPath = '<a href="index.php?module=home">'.def_trangchu.'</a>';
for($i = 0; $i <= $curLevel; $i++)
{
	if($i == $curLevel)
	{
		$linkPath .= " / ".$ses_parent_label[$i];
	}
	else
	{
		$linkPath .= " / <a href=\"" . $ses_parent_url[$i];
		if($i < sizeof($ses_parent_id) - 1)
		{
			$linkPath .= "&CURID=".$ses_parent_id[$i+1];
		}
		else
		{
			$linkPath .= "&CURID=$PARENTID";
		}
		$linkPath .= '">'.$ses_parent_label[$i].'</a>';
	}
}

include_once("js.html");

switch($action)
{
	case 'delete':
		$chon = split(',',$chon);
		for($i = 0; $i < sizeof($chon); $i++) 
		{
			delCate($chon[$i], 'modules');
		}
		include_once("includes/create_menus.php");
		include_once("includes/create_menuleft.php");
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "modules_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_modules",$values,"modules_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "modules_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_modules",$values,"modules_id='".$listId_V[$i]."'");
		}

		include_once("includes/create_menus.php");
		include_once("includes/create_menuleft.php");
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
		
		if(!$view) $view = 0;
                if(!$cap) $cap= 0;
		if($parentModPer != 0) $modper = $parentModPer;

		$maxImgW = 180;
		$maxImgH = 150;
		$new_image = NULL;
		$upload_dir = "uploads/icons";

		if($CURID != NULL && $isSave == NULL)
		{			
			if($icon_name == NULL  && $cbRemoveImage == 1) 
			{ 
			//echo  $cbRemoveImage;
			//echo "dong";die();
			delFile("../$old_icon");
				
				$new_icon = '';
			}
			//////////////////////////////////////////////////////////////////
			else if($icon_name == NULL || $icon_name == 'none') 
			{
			//echo "xoa anh1";die();
				$new_icon = $old_icon;
			}
			else
			{
				delFile("../$old_icon");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_icon = "$upload_dir/icon_".date("dmy").time().".".extFile($icon_name);
				upload($icon_tmp_name,$new_icon);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_icon", $maxImgW, $maxImgH);		
				}
			}
			$values  = "modules_name='".$nname."',modules_icon='".$new_icon."',modules_sub='".$modsub."',modules_shortdes='".$short."',modules_type='".$motype."',modules_linkto='".$linkto."',modules_pos='".$modpos."',modules_per='".$modper."',modules_level='".$curLevel."',modules_order='".$order."',modules_cap='".$cap."',modules_view='".$view."'";
			$sql->update("vot_modules",$values,"modules_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($icon_name != NULL || $icon_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_icon = "$upload_dir/icon_".date("dmy").time().".".extFile($icon_name);
				upload($icon_tmp_name,$new_icon);
				if(is_file("../$new_icon")) 
				{
					imageCopyResize("../$new_icon", $maxImgW, $maxImgH);		
				}
			}
			$fields = "modules_name,modules_icon,modules_sub,modules_shortdes,modules_type,modules_linkto,modules_pos,modules_per,modules_parent,modules_level,modules_order,modules_cap,modules_view,language_id";
			$values  = "'".$nname."','".$new_icon."','".$modsub."','".$short."','".$motype."','".$linkto."','".$modpos."','".$modper."','".$PARENTID."','".$curLevel."','".$order."','".$cap."','".$view."','".$LANG."'";
			$sql->insert("vot_modules", $fields, $values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");

		include_once("includes/create_menus.php");
		include_once("includes/create_menuleft.php");
		redirect("$url&CURID=$CURID");
		break;
		
	default:

		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");		
		
		$conds = "language_id = '".$LANG."'";		
		if($PARENTID != NULL) 
		{
			$conds .= " AND modules_parent='".$PARENTID."'";
		}
		else
		{
			$conds .= " AND modules_level=0";
		}
		if($KWD != NULL) 
		{
			$conds .= " AND modules_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$others = " ORDER BY modules_$orderBy $vArrow";
		if($vArrow == 'DESC') 
		{
			$toArrow = NULL;
			if($orderBy == 'order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
			if($orderBy == 'name')
			{
				$orderArrow = NULL;
				$senderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
		}
		else 
		{
			$toArrow = 'DESC';
			if($orderBy == 'order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_up.gif" border="0">';
			}
			if($orderBy == 'name')
			{
				$orderArrow = NULL;
				$senderArrow = '<img src="images/arrow_up.gif" border="0">';
			}
		}
		
		$sql->set_query("vot_modules", "*", $conds, $others);
		$tRows = $sql->nRows;
		
		if(!$curPg) $curPg = 1;
		else
		{
			$numPgs = ceil($tRows / $maxRows);
			if($curPg > $numPgs) $curPg = $numPgs;
		}
		$curRow = ($curPg - 1) * $maxRows + 1;
		
		$action = 'edit';

		$sSql = new mysql;
		
		$CL_SELECTED = "#F5F0F0";
		$MAXSTRLEN = 25;
	
		if($tRows > 0)
		{
			$low = $curRow; 
			$curRow = 1;
			$cur_p = array();
			while (($sql->set_farray())&&($curRow<=$tRows)&&($curRow<=$curPg*$maxRows))
			{
				$curRow++;			                           
				if($curRow>$low)
				{
					$nid = $sql->farray["modules_id"];
					$name = $itemTitle = strip_tags($sql->farray["modules_name"]);
					$modsub = $sql->farray["modules_sub"];
					$short = $sql->farray["modules_shortdes"];
					$motype = $sql->farray["modules_type"];

					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name, 0, $MAXSTRLEN)."..";
					}
					$order = $sql->farray["modules_order"];
					$cap = $sql->farray["modules_cap"];
					$view = $checked[$sql->farray["modules_view"]];

					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["modules_name"];
						$cur_cap = $checked[$sql->farray["modules_cap"]];
						
						$cur_motype = $sql->farray["modules_type"];
						$cur_modsub = $sql->farray["modules_sub"];
						$icon = $sql->farray["modules_icon"];
						$cur_short = $sql->farray["modules_shortdes"];
						$linkto = $sql->farray["modules_linkto"];
						$modpos = $sql->farray["modules_pos"];
						$cur_modper = $sql->farray["modules_per"];
						$cur_order = $sql->farray["modules_order"];
						$cur_view = $checked[$sql->farray["modules_view"]];
						list($pos0,$pos1,$pos2,$pos3) = split(",", $modpos);
	
						$BG_COLOR = $CL_SELECTED;
						$arrow = '<img src="images/arrowb.gif">';
						$style = 'style="border-right:1px solid #EEEEEE"';
						$name = "<font class=itemselected>$name</font>";
						$sS1 = ""; $sS2 = "";
					}
					else 
					{
						$BG_COLOR = "#F5F5F5";
						$arrow = "&nbsp;";
						$style = 'style="border-right:0px"';
						$check = NULL;
						$sS1 = 	' style="cursor: pointer" onMouseOver=active(this); onMouseOut="deactive(this);"';				
						$sS2 =  ' onClick=goPage("'.$url.'&CURID='.$nid.'"); ';
					}
					
					$pageContent .= "<tr valign=\"middle\" bgcolor=\"$BG_COLOR\" $sS1 height=\"30\">";
					$pageContent .= "<td align=\"center\" width=\"5\" class=\"rowlist\"><input type=\"checkbox\" value=\"$nid\" $check name=\"chkid\"></td>";
					
					if($modsub == 1)
					{
						$subTitle = "Nh&#243;m n&#7897;i dung thu&#7897;c '".strip_tags($itemTitle)."'";
						$linkToSub = "?module=$module&PARENTID=$nid";						
					}
					else
					{
						//$source = $opt->optionvalue("vot_moduletypes","moduletypes_source","moduletypes_id='".$motype."'");
						//$subTitle = "N&#7897;i dung chi ti&#7871;t thu&#7897;c '".strip_tags($itemTitle)."'";
						$linkToSub = "?module=$motype&CURMOD=$nid";						
					}
					$pageContent .= "<td align=\"center\" width=\"5\" colspan=\"2\" class=\"rowlist\"><a href=\"$linkToSub\" title=\"$subTitle\"><img src=\"images/closefold.gif\" border=\"0\"></a></td>";
					$pageContent .= "<td width=\"250\" $sS2 class=\"rowlist\" title=\"$itemTitle\">$name</td>";
					$pageContent .= "<td width=\"80\" align=\"center\" class=\"rowlist\"><input name=\"itOrder_$nid\" value=\"$order\" class=\"listOrderTxtBox\" onChange=\"getObjChange('".$nid."',this,'listOrder','listId_O')\"></td>";
					$pageContent .= "<td width=\"40\" align=\"center\" class=\"rowlist\"><input type=\"checkbox\" name=\"itView_$nid\" $view onClick=\"getObjChange('".$nid."',this,'listView','listId_V')\"></td>";
					$pageContent .= "<td $sS2 width=\"5\" class=\"rowlist\">$arrow</td></tr>";
				}
			}
		}
		else
		{ 
			$pageContent .= NORESULT;
		}
		$rightContentFile = "modulesinfos.php";
		
		include_once("listmodules.php");
		break;
}
?>
