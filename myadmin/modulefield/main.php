<?
$sql = new mysql;
$opt = new option;

$and = "PARENTID=$PARENTID&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
$url = "index.php?module=$module&curPg=$curPg&$and";

include_once("js.html");

$linkPath = '<a href="index.php?module=home">'.def_trangchu.'</a>&nbsp;/ '.def_cacloaiblock;

switch($action)
{
	case 'delete':
		$chon = split(',',$chon);
		for($i = 0; $i < sizeof($chon); $i++) 
		{
			delCate($chon[$i], 'homeblocktype');
		}
		//include_once("includes/create_menu.php");
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "homeblocktype_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_homeblocktype",$values,"homeblocktype_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "homeblocktype_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_homeblocktype",$values,"homeblocktype_id='".$listId_V[$i]."'");
		}

		//include_once("includes/create_menu.php");		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
		
		if(!$view) $view = 0;

		if($CURID != NULL && $isSave == NULL)
		{			
			$values  = "homeblocktype_name='".$nname."',homeblocktype_order='".$order."',homeblocktype_view='".$view."'";
			$sql->update("vot_homeblocktype",$values,"homeblocktype_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			$fields = "homeblocktype_name,homeblocktype_order,homeblocktype_view";
			$values  = "'".$nname."','".$order."','".$view."'";
			$sql->insert("vot_homeblocktype", $fields, $values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");

		//include_once("includes/create_menu.php");
		redirect("$url&CURID=$CURID");
		break;
		
	default:
	
		if($curLevel == 0)
		{
			$pageTitle = def_cacloailinhvuc;
		}
		else
		{		
			$pageTitle = $opt->optionvalue("vot_homeblocktype","homeblocktype_name","homeblocktype_id=$PARENTID");
		}
		$pageContent = NULL;

		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");		
		
		$conds = "homeblocktype_id != ''";		
		if($KWD != NULL) 
		{
			$conds .= " AND homeblocktype_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$others = " ORDER BY homeblocktype_$orderBy $vArrow";
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
		
		$sql->set_query("vot_homeblocktype", "*", $conds, $others);
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
					$nid = $sql->farray["homeblocktype_id"];
					$name = $itemTitle = $sql->farray["homeblocktype_name"];

					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name, 0, $MAXSTRLEN)."..";
					}
					$order = $sql->farray["homeblocktype_order"];
					$view = $checked[$sql->farray["homeblocktype_view"]];

					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["homeblocktype_name"];
						$cur_order = $sql->farray["homeblocktype_order"];
						$cur_view = $checked[$sql->farray["homeblocktype_view"]];
	
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
		$rightContentFile = "modulefieldinfos.php";
		
		include_once("listmodulefield.php");
		break;
}
?>