<?
$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

$sql = new mysql();
$opt = new option();

if($CURMOD != NULL)
{
	$conds = "modules_id='" . $CURMOD . "'";
	$pageTitle = $opt->optionvalue("vot_modules","modules_name",$conds);
	$and .= "&CURMOD=$CURMOD";
	$searchFormActionTo .= "&CURMOD=$CURMOD";
	$linktoOrderByName .= "&CURMOD=$CURMOD";
	$linktoOrderByOrder .= "&CURMOD=$CURMOD";
	$newOrder = $opt->optionvalue("vot_photo", "MAX(photo_order)", $conds) + 1;
}
else
{
	redirect("?module=modules");
}
$url = "index.php?module=$module&curPg=$curPg&$and";

$linkPath = '<a href="index.php?module=home">'.def_trangchu.'</a>';
for($i = 0; $i < sizeof($ses_parent_url); $i++)
{		
	$linkPath .= " / <a href=\"" . $ses_parent_url[$i];
	$linkPath .= "&CURID=".$ses_parent_id[$i+1];
	$linkPath .= "\">$ses_parent_label[$i]</a>";
}
$linkPath .= " / $pageTitle";

include_once("js.html");

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_photo", "photo_id", $chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "photo_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_photo",$values,"photo_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "photo_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_photo",$values,"photo_id='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
		
		$new_thumb = NULL;
		$new_image = NULL;
		$upload_dir = "uploads/photo_images";
		
		$maxThumbW = 119;
		$maxThumbH = 162;
		
		$maxImgW = 600;
		$maxImgH = 550;

		if($CURID != NULL && $isSave == NULL)
		{	
			if($image_name == NULL || $image_name == 'none') 
			{
				$new_thumb = $old_thumb;
				$new_image = $old_image;
			}
			else
			{
				delFile("../$old_thumb");
				delFile("../$old_image");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_thumb = "$upload_dir/thumb_".date("dmy").time().".".extFile($image_name);
				$new_image = "$upload_dir/image_".date("dmy").time().".".extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image",$maxThumbW,$maxThumbH,"NO","../$new_thumb");		
					imageCopyResize("../$new_image", $maxImgW, $maxImgH);		
				}
			}
			$values  = "photo_name='".$nname."',photo_thumb='".$new_thumb."',photo_image='".$new_image."',photo_istop='".$istop."',photo_order='".$order."',photo_view='".$view."'";
			$sql->update("vot_photo", $values, "photo_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($image_name != NULL || $image_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_thumb = "$upload_dir/thumb_".date("dmy").time().".".extFile($image_name);
				$new_image = "$upload_dir/image_".date("dmy").time().".".extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image",$maxThumbW,$maxThumbH,"NO","../$new_thumb");							
					imageCopyResize("../$new_image", $maxImgW, $maxImgH);
				}
			}
			$fields = "modules_id,photo_name,photo_thumb,photo_image,photo_istop,photo_order,photo_view,language_id";
			$values  = "'".$CURMOD."','".$nname."','".$new_thumb."','".$new_image."','".$istop."','".$order."','".$view."','".$LANG."'";
			$sql->insert("vot_photo", $fields, $values);
		}
		
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		
		break;
		
	default:
	
		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");
		
		$cond = "language_id = '".$LANG."'";		
		if($CURMOD != NULL)
		{
			$cond .= " AND modules_id = '".$CURMOD."'";
		}
		if($KWD != NULL) 
		{
			$cond .= " AND photo_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		if(!$vArrow) $vArrow = 'DESC';
		
		$other = " ORDER BY photo_$orderBy $vArrow";
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
		
		$sql->set_query("vot_photo","*",$cond,$other);
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
					$nid = $sql->farray["photo_id"];
					$name = $itemTitle = $sql->farray["photo_name"];
					if(strlen($name) > $MAXSTRLEN)
					{
						$name = cutString($name, 0, $MAXSTRLEN) . "..";
					}
					$order = $sql->farray["photo_order"];
					$view = $checked[$sql->farray["photo_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) {$CURID = $nid;}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["photo_name"];
						if(is_file("../".$sql->farray["photo_thumb"])) 
						{
							$thumb = $sql->farray["photo_thumb"];
							$image = $sql->farray["photo_image"];
						}
						$note = $sql->farray["photo_note"];
						$istop = $checked[$sql->farray["photo_istop"]];
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
		$rightContentFile = "photoinfos.php";		

		$searchFormActionTo = "index.php?module=$module";
		$linktoOrderByName = "?module=$module&orderBy=name&vArrow=$toArrow&KWD=$KWD";
		$linktoOrderByOrder = "?module=$module&orderBy=order&vArrow=$toArrow&KWD=$KWD";
		
		include_once("listphoto.php");
		break;			
}
?>