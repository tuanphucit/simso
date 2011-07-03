<?
$url = "index.php?module=$module&curPg=$curPg&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD&POS=$POS";

$sql = new mysql();
$opt = new option();

$newOrder = $opt->optionvalue("vot_customer", "MAX(customer_order)", "language_id='".$LANG."'") + 1;

include_once("js.html");

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_customer", "customer_id", $chon);
		redirect($url);			
		break;			
		
	/*	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$customer = split(",",$customer);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "customer_order='".$customer[$i]."'";
			$sql = new mysql();
			$sql->update("vot_customer",$values,"customer_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "customer_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_customer",$values,"customer_id='".$listId_V[$i]."'");
		}		
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
			$values  = "customer_name='".insertData($nname)."',customer_add='".insertData($add)."',customer_tel='".$tel."',customer_fax='".$fax."',customer_email='".$email."',customer_detail='".insertData($detail)."',customer_order='".$order."',customer_view='".$view."'";
			$sql->update("vot_customer", $values, "customer_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			$fields = "customer_name,customer_add,customer_tel,customer_fax,customer_email,customer_detail,customer_order,customer_view,product_id,language_id";
			$values  = "'".insertData($nname)."','".insertData($add)."','".$tel."','".$fac."','".$email."','".insertData($detail)."','".$order."','".$view."','".$producId."','".$LANG."'";
			$sql->insert("vot_customer", $fields, $values);
		}
		
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		
		break;
	*/
	default:
	
		$pageTitle = "Danh s&#225;ch &#273;&#7863;t h&#224;ng";
		$pageContent = NULL;
		$linkPath  = '<a href="index.php?module=home">'.def_trangchu.'</a> ';
		$linkPath .= '/ Danh s&#225;ch &#273;&#7863;t h&#224;ng';

		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");
		
		$cond = "language_id = '".$LANG."'";
		if($KWD != NULL) 
		{
			$cond .= " AND customer_name LIKE '%".$KWD."%'";
		}
		if($customerTYPE != NULL)
		{
			$cond .= " AND customer_type = '".$customerTYPE."'";
		}
		
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		
		if(!$vArrow) $vArrow = 'DESC';
		
		$other = " ORDER BY customer_$orderBy $vArrow";
		if($vArrow == 'DESC') 
		{
			$toArrow = 'ASC';
			if($orderBy == 'order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
			if($orderBy=='name')
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
		
		$sql->set_query("vot_customer","*",$cond,$other);
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
		$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD&POS=$POS";
		$url = "index.php?module=$module&curPg=$curPg&$and";
		
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
					$nid = $sql->farray["customer_id"];
					$name = $itemTitle = displayData_DB($sql->farray["customer_name"]);
					if(strlen($name) > $MAXSTRLEN)
					{
						$name = cutString($name, 0, $MAXSTRLEN) . "..";
					}
					$order = $sql->farray["customer_order"];
					$view = $checked[$sql->farray["customer_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) {$CURID = $nid;}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = displayData_DB($sql->farray["customer_name"]);
						$ndate = outDateStr($sql->farray["customer_date"]);
						$add = displayData_DB($sql->farray["customer_add"]);
						$tel = $sql->farray["customer_tel"];
						$teltable = $sql->farray["customer_teltable"];
						$fax = $sql->farray["customer_fax"];
						$email = $sql->farray["customer_email"];
						$productName = $sql->farray["customer_sdt"];
						$productId = $sql->farray["product_id"];
						/*$ssql = new mysql;
						$ssql->set_query("vot_product", "product_name","product_id='".$productId."'");
						
						if($ssql->set_farray())
						{
							$productName = $ssql->farray["product_name"];
							$productType = $ssql->farray["producttype_id"];
						}*/
						$linkToItem = "../home.php/san_pham/$productType/$productId";
						$detail = displayData_DB($sql->farray["customer_detail"]);
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
					
					$pageContent .= '
					<tr valign="middle" bgcolor="'.$BG_COLOR.'" '.$sS1.' height="30">
						<td align="center" width="5" class="rowlist"><input type="checkbox" value="'.$nid.'" '.$check.' name="chkid"></td>
						<td width="250" '.$sS2.' class="rowlist" title="'.$itemTitle.'">'.$name.'</td>
						<td width="80" align="center" class="rowlist"><input name="itOrder_'.$nid.'" value="'.$order.'" class="listorderTxtBox" onChange="getObjChange(\''.$nid.'\',this,\'customer\',\'listId_O\')"></td>
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
		$rightContentFile = "customerinfos.php";		
		
		include_once("listcustomer.php");
		break;			
}
?>