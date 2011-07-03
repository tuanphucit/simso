<?
include_once("js.html");

if($PARENTID == NULL) 
{
	$PARENTID = 0;
}

if($ses_parent_id == NULL)
{
	$ses_parent_id = array();
}

$curLevel = getKeyInArray($PARENTID, $ses_parent_id);
if($curLevel == -1)
{
	$curLevel = sizeof($ses_parent_id);
	$ses_parent_id[$curLevel] = $PARENTID;
}
else
{
	$new_parent_id = array();
	for($i = 0; $i <= $curLevel; $i++)
	{
		$new_parent_id[$i] = $ses_parent_id[$i];
	}
	$ses_parent_id = $new_parent_id;
}

_SESSION_REGISTER("ses_parent_id");

$url = "index.php?module=$module&PARENTID=$PARENTID&curPg=$curPg&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

$sql = new mysql;
$opt = new option;

switch($action)
{
	case 'delete':
		$chon = split(',',$chon);
		for($i = 0; $i < sizeof($chon); $i++) 
		{
			//delCate($chon[$i],'category3');
			delcategory($chon[$i],'category3');
		}
		//include_once("includes/create_menu.php");
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		$listIstop = split(",",$listIstop);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "category3_order='".$listOrder[$i]."',category3_istop='".$listIstop[$i]."'";
			$sql = new mysql();
			$sql->update("vnws_category3",$values,"category3_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "category3_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vnws_category3",$values,"category3_id='".$listId_V[$i]."'");
		}

		//include_once("includes/create_menu.php");		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
		
		if($CURID != NULL && $isSave == NULL)
		{			
			$values  = "category3_name='".$nname."',category3_istop='".$istop."',category3_shortdes='".$short."',category3_order='".$order."',category3_level='".$curLevel."',category3_view='".$view."'";
			$sql->update("vnws_category3",$values,"category3_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			$fields = "category3_name,category3_istop,category3_shortdes,category3_parent,category3_order,category3_level,category3_view,language_id";
			$values  = "'".$nname."','".$istop."','".$short."','".$PARENTID."','".$order."','".$curLevel."','".$view."','".$LANG."'";
			$sql->insert("vnws_category3", $fields, $values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");

		//include_once("includes/create_menu.php");
		redirect("$url&CURID=$CURID");
		break;
		
	default:
	
		if($curLevel == 0)
		{
			$pageTitle = def_program;
		}
		else
		{		
			$pageTitle = $opt->optionvalue("vnws_category3","category3_name","category3_id=$PARENTID");
		}
		$pageContent = NULL;

		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");		
		
		$conds = "language_id = $LANG AND category3_parent = $PARENTID";		
		if($KWD != NULL) 
		{
			$conds .= " AND category3_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$others = " ORDER BY category3_$orderBy $vArrow";
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
		
		$sql->set_query("vnws_category3", "*", $conds, $others);
		$tRows = $sql->nRows;
		
		if(!$curPg) $curPg = 1;
		else
		{
			$numPgs = ceil($tRows / $maxRows);
			if($curPg > $numPgs) $curPg = $numPgs;
		}
		$curRow = ($curPg - 1) * $maxRows + 1;
		
		$action = 'edit';
		
		$and = "PARENTID=$PARENTID&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
		$url = "index.php?module=$module&curPg=$curPg&$and";

		if($curLevel >= sizeof($ses_parent_url) - 1)
		{
			$ses_parent_url[$curLevel] = $url;
		}
		else
		{
			$new_parent_url = array();
			for($i = 0; $i <= $curLevel; $i++)
			{
				$new_parent_url[$i] = $ses_parent_url[$i];
			}
			$ses_parent_url = $new_parent_url;
		}
		_SESSION_REGISTER("ses_parent_url");

		$linkPath = '<a href="index.php?module=home">'.def_trangchu.'</a>';
		for($i = 0; $i <= $curLevel; $i++)
		{		
			if($i == 0) 
			{
				$linkLabel = def_program;
			}
			else
			{
				$conds = "category3_id='" . $ses_parent_id[$i] . "'";
				$linkLabel = $opt->optionvalue("vnws_category3","category3_name",$conds);
			}
			
			if($i == $curLevel) $linkPath .= " / $linkLabel";
			else $linkPath .= " / <a href=\"" . $ses_parent_url[$i] . "\">$linkLabel</a>";
		}

		$sSql = new mysql;
		
		$CL_SELECTED = "#F5F0F0";
		$MAXSTRLEN = 45;
	
		$subTitle_1 = def_program;
		$subTitle_2 = "C&#225;c b&#7843;n tin";
		
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
					$nid = $sql->farray["category3_id"];
					$name = $sql->farray["category3_name"];
					$short = $sql->farray["category3_shortdes"];
					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name, 0, $MAXSTRLEN)."..";
					}
					$order = $sql->farray["category3_order"];
					$view = $checked[$sql->farray["category3_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["category3_name"];
						$cur_short = $sql->farray["category3_shortdes"];
						$cur_istop = $sql->farray["category3_istop"];
						$cur_order = $sql->farray["category3_order"];
						$cur_view = $checked[$sql->farray["category3_view"]];
	
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
					
					$linkto_1 = "?module=category3&PARENTID=$nid";
					$linkto_2 = "?module=product3&PARENTID=$nid";
	
					$pageContent .= "<tr valign=\"middle\" bgcolor=\"$BG_COLOR\" $sS1 height=\"30\">";
					$pageContent .= "<td align=\"center\" width=\"5\" class=\"rowlist\"><input type=\"checkbox\" value=\"$nid\" $check name=\"chkid\"></td>";
					//$pageContent .= "<td align=\"center\" width=\"5\" class=\"rowlist\"><a href=\"$linkto_2\" title=\"$subTitle_2\"><img src=\"images/closefold.gif\" border=\"0\"></a></td>";
	
					
					$nCates = 0;
					$nProds = 1;
					/*
					if($curLevel < 1)
					{
						$conds = "category3_parent = $nid";
						$sSql->set_query("vnws_category3", "category3_id", $conds);
						$nCates = $sSql->nRows;
						
						$conds = "category3_id = $nid";
						$sSql->set_query("vnws_product3", "product3_id", $conds);
						$nProds = $sSql->nRows;
					}
					*/
					$pageContent .= "<td align=\"center\" width=\"5\" class=\"rowlist\">";
	
					if($nProds == 0)
					{
						$pageContent .= "<a href=\"$linkto_1\" title=\"$subTitle_1\">";
						$pageContent .= "<img src=\"images/closefold.gif\" border=\"0\"></a>";
					}
					else 
					{
						$pageContent .= "&nbsp;";
					}
					$pageContent .= "</td>";
					$pageContent .= "<td align=\"center\" width=\"5\" class=\"rowlist\">";
					if($nCates == 0)
					{
						$pageContent .= "<a href=\"$linkto_2\" title=\"$subTitle_2\">";
						$pageContent .= "<img src=\"images/closefold.gif\" border=\"0\"></a>";
					}
					else
					{
						$pageContent .= "&nbsp;";
					}
					$pageContent .= "</td>";
					
					
					$pageContent .= "<td width=\"250\" $sS2 class=\"rowlist\">$name</td>";
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
		$rightContentFile = "category3infos.php";
		
		include_once("listcategory3.php");
		break;
}
?>