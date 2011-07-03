<?
$sql = new mysql();
$opt = new option();

$url = "index.php?module=$module&curPg=$curPg&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD&POS=$POS";

$newOrder = $opt->optionvalue("vot_press", "MAX(press_order)") + 1;

include_once("js.html");

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_press", "press_id", $chon);

		include_once("includes/create_press.php");						

		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "press_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_press",$values,"press_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "press_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_press",$values,"press_id='".$listId_V[$i]."'");
		}
		
		include_once("includes/create_press.php");						
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
		
		if(!$view) $view = 0;
		
		$new_image = NULL;
		$upload_dir = "uploads/press_images";
		$MAXIMGW = 109;
		$MAXIMGH = 55;
		$advurl = str_replace("http://","",$advurl);
		$advurl = "http://$advurl";

		if($CURID != NULL && $isSave == NULL)
		{	
			if($image_name==NULL || $image_name=='none')
			{
				$new_image = $old_image;
			}
			else
			{
				delFile("../$old_image");
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_image = "$upload_dir/" . date("dmy") . time() . "." . extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image", $MAXIMGW, $MAXIMGH);		
				}	
			}
			$values  = "press_name='".$nname."',press_url='".$advurl."',press_image='".$new_image."',press_order='".$order."',press_view='".$view."'";
			$sql->update("vot_press", $values, "press_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($image_name != NULL && $image_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_image = "$upload_dir/" . date("dmy") . time() . "." . extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image", $MAXIMGW, $MAXIMGH);		
				}	
			}
			$fields = "press_name,press_url,press_image,press_order,press_view";
			$values  = "'".$nname."','".$advurl."','".$new_image."','".$order."','".$view."'";
			$sql->insert("vot_press", $fields, $values);
		}
		
		include_once("includes/create_press.php");						

		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		
		break;
		
	default:
	
		$pageTitle = def_baochitructuyen;
		$pageContent = NULL;
		$linkPath  = '<a href="index.php?module=home">'.def_trangchu.'</a> ';
		$linkPath .= '/ '. def_baochitructuyen;

		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");
		
		$cond = "press_id != ''";
		if($KWD != NULL) 
		{
			$cond .= " AND press_name LIKE '%".$KWD."%'";
		}
		if($POS != NULL)
		{
			$cond .= " AND press_pos = '".$POS."'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		if(!$vArrow) $vArrow = 'DESC';
		
		$other = " ORDER BY press_$orderBy $vArrow";
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

		$sql->set_query("vot_press","*",$cond,$other);
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
					$nid = $sql->farray["press_id"];
					$name = $itemTitle = $sql->farray["press_name"];
					if(strlen($name) > $MAXSTRLEN)
					{
						$name = cutString($name, 0, $MAXSTRLEN) . "..";
					}
					$order = $sql->farray["press_order"];
					$view = $checked[$sql->farray["press_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) {$CURID = $nid;}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["press_name"];
						$advurl = $sql->farray["press_url"];
						if(is_file("../".$sql->farray["press_image"])) 
						{
							$image = $sql->farray["press_image"];
						}
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
		$rightContentFile = "pressinfos.php";		
		
		include_once("listpress.php");
		break;			
}
?>