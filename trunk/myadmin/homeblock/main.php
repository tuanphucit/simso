<?
$sql = new mysql;
$opt = new option;

$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
$url = "index.php?module=$module&curPg=$curPg&$and";

include_once("js.html");

$linkPath = '<a href="index.php?module=home">'.def_trangchu.'</a> / '.def_cacblocktrentrangchu;

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_homeblock", "homeblock_id", $chon);
		include_once("includes/create_homeblock.php");				
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "homeblock_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_homeblock",$values,"homeblock_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "homeblock_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_homeblock",$values,"homeblock_id='".$listId_V[$i]."'");
		}
		include_once("includes/create_homeblock.php");				
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}
		if($CURID != NULL && $isSave == NULL)
		{	
			$values  = "homeblock_name='".$nname."',modules_id='".$mnlinkto."',homeblock_pos='".$homepos."',homeblock_order='".$order."',homeblock_view='".$view."'";
			$sql->update("vot_homeblock", $values, "homeblock_id=$CURID");					
		}
		elseif($isSave == NULL)
		{
			$fields = "homeblock_name,modules_id,homeblock_pos,homeblock_order,homeblock_view,language_id";
			$values  = "'".$nname."','".$mnlinkto."','".$homepos."','".$order."','".$view."','".$LANG."'";
			$sql->insert("vot_homeblock", $fields, $values);
		}		
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		
		break;
		
	default:
	
		$pageTitle = def_cacblocktrentrangchu;
		$pageContent = NULL;

		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");
		
		$cond = "language_id = '".$LANG."'";		
		if($KWD != NULL) 
		{
			$cond .= " AND homeblock_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$other = " ORDER BY homeblock_$orderBy $vArrow";
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
		
		$sql->set_query("vot_homeblock","*",$cond,$other);
		$tRows = $sql->nRows;
		
		if(!$curPg)
		{
			$curPg = 1;
		}
		else
		{
			$numPgs = ceil($tRows / $maxRows);
			if($curPg > $numPgs) $curPg = $numPgs;
		}
		$curRow = ($curPg - 1) * $maxRows + 1;
		
		$action = 'edit';
		$and = "PARENTID=$PARENTID&curPg=$curPg&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
		$url = "index.php?module=$module&$and";
		
		$CL_SELECTED = "#F5F0F0";
		$MAXSTRLEN = 25;
		
		if($tRows > 0)
		{
			$low = $curRow; 
			$curRow = 1;
			$cur_p = array();
			while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
			{
				$curRow++;			                           
				if($curRow > $low)
				{
					$nid = $sql->farray["homeblock_id"];
					$name = $itemTitle = $sql->farray["homeblock_name"];
					if(strlen($name) > $MAXSTRLEN)
					{
						$name = cutString($name, 0, $MAXSTRLEN) . "..";
					}
					$mntype = $sql->farray["homeblock_type"];
					$order = $sql->farray["homeblock_order"];
					$view = $checked[$sql->farray["homeblock_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) {$CURID = $nid;}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["homeblock_name"];
						$mnlinkto = $sql->farray["modules_id"];
						$cur_mntype = $sql->farray["homeblock_type"];
						$homepos = $sql->farray["homeblock_pos"];
						$cur_order = $order;
						$cur_view = $view;
	
						$BG_COLOR = $CL_SELECTED;
						$arrow = '<img src="images/arrowb.gif">';
						$style = 'style="border-right:1px solid #EEEEEE"';
						//$check = "checked";
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

					$linkto_2 = "?module=homeblock&PARENTID=$nid";
					
					$pageContent .= '
					<tr valign="middle" bgcolor="'.$BG_COLOR.'" '.$sS1.' height="30">
						<td align="center" width="5" class="rowlist"><input type="checkbox" value="'.$nid.'" '.$check.' name="chkid"></td>
						<td align="center" width="5" class="rowlist">';
					if($mntype == 2)
					{
						$pageContent .= "<a href=\"$linkto_2\" title=\"$subTitle_2\"><img src=\"images/closefold.gif\" border=\"0\"></a>";
					}
					$pageContent .= '</td>
						<td width="250" '.$sS2.' class="rowlist" title="'.$itemTitle.'">'.$name.'</td>
						<td width="80" align="center" class="rowlist"><input name="itOrder_'.$nid.'" value="'.$order.'" class="listOrderTxtBox" onChange="getObjChange(\''.$nid.'\',this,\'listOrder\',\'listId_O\')"></td>
						<td width="40" align="center" class="rowlist"><input type="checkbox" name="itView_'.$nid.'" '.$view.' onClick="getObjChange(\''.$nid.'\',this,\'listView\',\'listId_V\')"></td>
						<td '.$sS2.' width="5" class="rowlist">'.$arrow.'</td>
					</tr>';
				}
			}
		}
		else
		{ 
			$pageContent .= NORESULT;
		}		
		$rightContentFile = "homeblockinfos.php";	
		
		$conds = "language_id = '".$LANG."' AND modules_view = 1";
		$others = "ORDER BY modules_order ASC";
		$mnLinkToSels = $opt->optionselected($mnlinkto, def_chon, "vot_modules","modules_id","modules_name",$conds);

		$conds = "homeblocktype_view = 1";
		$others = "ORDER BY homeblocktype_order ASC";
		$homePosSels = $opt->optionselected($homepos, def_chon, "vot_homeblocktype","homeblocktype_id","homeblocktype_name",$conds);

		include_once("listhomeblock.php");
		break;			
}
?>