<?
$sql = new mysql;
$opt = new option;

$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
$url = "index.php?module=$module&curPg=$curPg&$and";

$newOrder = $opt->optionvalue("vot_member","MAX(member_order)") + 1;

include_once("js.html");

$linkPath = '<a href="index.php?module=home">'.def_trangchu.'</a> / '.def_danhsachthanhvien;

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_member", "member_id", $chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "member_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_member",$values,"member_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "member_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_member",$values,"member_id='".$listId_V[$i]."'");
		}
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}
		
		if(!$ndate)
		{
			$ndate = date("d-m-Y");
		}
		$ndate = inDateStr($ndate);
		
		if($CURID != NULL && $isSave == NULL)
		{	
			$values  = "member_name='".$nname."',member_email='".$email."',member_org='".$org."',member_add='".$add."',member_tel='".$tel."',member_date='".$ndate."',member_order='".$order."',member_view='".$view."'";
			$sql->update("vot_member", $values, "member_id=$CURID");					
		}
		elseif($isSave == NULL)
		{
			$fields = "member_name,member_email,member_pwd,member_org,member_add,member_tel,member_activecode,member_date,member_order,member_view";
			$values  = "'".$nname."','".$email."','".md5($pwd)."','".$org."','".$add."','".$tel."','".$actCode."','".$ndate."','".$order."','".$view."'";
			$sql->insert("vot_member", $fields, $values);
		}		
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		
		break;
		
	default:
	
		$pageTitle = def_danhsachthanhvien;
		$pageContent = NULL;

		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");
		
		$cond = "member_id != ''";		
		if($KWD != NULL) 
		{
			$cond .= " AND member_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$other = " ORDER BY member_$orderBy $vArrow";
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
		
		$sql->set_query("vot_member","*",$cond,$other);
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
					$nid = $sql->farray["member_id"];
					$name = $itemTitle = strip_tags($sql->farray["member_name"]);
					if(strlen($name) > $MAXSTRLEN)
					{
						$name = cutString($name, 0, $MAXSTRLEN) . "..";
					}
					$order = $sql->farray["member_order"];
					$view = $checked[$sql->farray["member_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) {$CURID = $nid;}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["member_name"];
						$email = $sql->farray["member_email"];
						$org = $sql->farray["member_org"];
						$add = $sql->farray["member_add"];
						$tel = $sql->farray["member_tel"];
						$ndate = outDateStr($sql->farray["member_date"]);
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

					//$linkto_2 = "?module=member&PARENTID=$nid";
					
					$pageContent .= '
					<tr valign="middle" bgcolor="'.$BG_COLOR.'" '.$sS1.' height="30">
						<td align="center" width="5" class="rowlist"><input type="checkbox" value="'.$nid.'" '.$check.' name="chkid"></td>
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
		$rightContentFile = "memberinfos.php";
				
		include_once("listmember.php");
		break;			
}
?>