<?
$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

$sql = new mysql();
$opt = new option();

if($CURMOD != NULL)
{
	$conds = "modules_id='" . $CURMOD . "'";
	$pageTitle = strip_tags($opt->optionvalue("vot_modules","modules_name",$conds));
	$and .= "&CURMOD=$CURMOD";
	$searchFormActionTo .= "&CURMOD=$CURMOD";
	$linktoOrderByName .= "&CURMOD=$CURMOD";
	$linktoOrderByOrder .= "&CURMOD=$CURMOD";
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
	$linkPath .= "\">".strip_tags($ses_parent_label[$i])."</a>";
}
$linkPath .= " / $pageTitle";

include_once("js.html");

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_realty","realty_id",$chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "realty_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_realty",$values,"realty_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "realty_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_realty",$values,"realty_id='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				

		$new_thumb1 = NULL;
		$new_image1 = NULL;
		$new_thumb2 = NULL;
		$new_image2 = NULL;
		$upload_dir = "uploads/realty_image";

		$maxThumbW = 150;
		$maxThumbH = 150;
		
		$maxImgW = 600;
		$maxImgH = 550;

		if($ndate == NULL)
		{
			$ndate = date("d-m-Y");
		}
		$ndate = inDateStr($ndate);
		if(!$rType)
		{
			$rType = $TYPEID;
		}
		if(!$rPlace)
		{
			$rPlace = $PLACEID;
		}
		if(!$rAspect)
		{
			$rAspect = $ASPECTID;
		}
		if($CURID!=NULL && $isSave==NULL)
		{			
			if($image1_name == NULL || $image1_name == 'none') 
			{
				$new_thumb1 = $old_thumb1;
				$new_image1 = $old_image1;
			}
			else
			{
				delFile("../$old_thumb1");
				delFile("../$old_image1");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_thumb1 = "$upload_dir/thumb1_".date("dmy").time().".".extFile($image1_name);
				$new_image1 = "$upload_dir/image1_".date("dmy").time().".".extFile($image1_name);
				upload($image1_tmp_name,$new_image1);
				if(is_file("../$new_image1")) 
				{
					imageCopyResize("../$new_image1",$maxThumbW,$maxThumbH,"NO","../$new_thumb1");		
					imageCopyResize("../$new_image1", $maxImgW, $maxImgH);		
				}
			}
			if($image2_name == NULL || $image2_name == 'none') 
			{
				$new_thumb2 = $old_thumb2;
				$new_image2 = $old_image2;
			}
			else
			{
				delFile("../$old_thumb2");
				delFile("../$old_image2");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_thumb2 = "$upload_dir/thumb2_".date("dmy").time().".".extFile($image2_name);
				$new_image2 = "$upload_dir/image2_".date("dmy").time().".".extFile($image2_name);
				upload($image2_tmp_name,$new_image2);
				if(is_file("../$new_image2")) 
				{
					imageCopyResize("../$new_image2",$maxThumbW,$maxThumbH,"NO","../$new_thumb2");		
					imageCopyResize("../$new_image2", $maxImgW, $maxImgH);		
				}
			}
			$values  = "realty_name='".$nname."',realty_date='".$ndate."',realty_price='".$price."',realty_area='".$area."',realty_thumb1='".$new_thumb1."',realty_image1='".$new_image1."',realty_thumb2='".$new_thumb2."',realty_image2='".$new_image2."',realty_noteimg1='".$noteimg1."',realty_noteimg2='".$noteimg2."',realty_show='".$show."',realty_shortdes='".$shortdes."',realty_order='".$order."',realty_view='".$view."',realtyaspect_id='".$rAspect."',realtyplace_id='".$rPlace."',realtytype_id='".$rType."'";
			$sql->update("vot_realty",$values,"realty_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($image1_name != NULL || $image1_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_thumb1 = "$upload_dir/thumb1_".date("dmy").time().".".extFile($image1_name);
				$new_image1 = "$upload_dir/image1_".date("dmy").time().".".extFile($image1_name);
				upload($image1_tmp_name,$new_image1);
				if(is_file("../$new_image1")) 
				{
					imageCopyResize("../$new_image1",$maxThumbW,$maxThumbH,"NO","../$new_thumb1");							
					imageCopyResize("../$new_image1", $maxImgW, $maxImgH);
				}
			}
			if($image2_name != NULL || $image2_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_thumb2 = "$upload_dir/thumb2_".date("dmy").time().".".extFile($image2_name);
				$new_image2 = "$upload_dir/image2_".date("dmy").time().".".extFile($image2_name);
				upload($image2_tmp_name,$new_image2);
				if(is_file("../$new_image2")) 
				{
					imageCopyResize("../$new_image2",$maxThumbW,$maxThumbH,"NO","../$new_thumb2");							
					imageCopyResize("../$new_image2", $maxImgW, $maxImgH);
				}
			}
			$fields = "realty_name,realty_date,realty_price,realty_area,realty_thumb1,realty_image1,realty_thumb2,realty_image2,realty_noteimg1,realty_noteimg2,realty_show,realty_shortdes,realty_order,realty_view,realtyaspect_id,realtyplace_id,realtytype_id,modules_id,language_id";
			$values  = "'".$nname."','".$ndate."','".$price."','".$area."','".$new_thumb1."','".$new_image1."','".$new_thumb2."','".$new_image2."','".$noteimg1."','".$noteimg2."','".$show."','".$shortdes."','".$order."','".$view."','".$rAspect."','".$rPlace."','".$rType."','".$CURMOD."','".$LANG."'";
			$sql->insert("vot_realty",$fields,$values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		break;

	case 'edit':
		$conds = "language_id='".$LANG."' AND modules_id='".$CURMOD."'";
		$order = $opt->optionvalue("vot_realty", "MAX(realty_order)",$conds) + 1; 

		if($CURID!=NULL)
		{
			$sql->set_query("vot_realty","*","realty_id=$CURID");
			$sql->set_farray();
			$name = $sql->farray["realty_name"];
			$ndate = outDateStr($sql->farray["realty_date"]);
			$price = $sql->farray["realty_price"];
			$area = $sql->farray["realty_area"];
			$thumb1 = $sql->farray["realty_thumb1"];
			$image1 = $sql->farray["realty_image1"];
			$thumb2 = $sql->farray["realty_thumb2"];
			$image2 = $sql->farray["realty_image2"];
			$noteimg1 = $sql->farray["realty_noteimg1"];
			$noteimg2 = $sql->farray["realty_noteimg2"];
			$show = $sql->farray["realty_show"];
			$shortdes = $sql->farray["realty_shortdes"];
			$order = $sql->farray["realty_order"];
			$view = $checked[$sql->farray["realty_view"]];
			$rAspect = $sql->farray["realtyaspect_id"];
			$rPlace = $sql->farray["realtyplace_id"];
			$rType = $sql->farray["realtytype_id"];
		}

		$conds = "language_id='".$LANG."'";	
		if($CURMOD != NULL)
		{
			$conds .= " AND modules_id = '".$CURMOD."'";
		}
		$others = "ORDER BY realtytype_order ASC";
		$rTypeSels = $opt->optionselected($rType, "--".def_chon."--", "vot_realtytype", "realtytype_id", "realtytype_name", $conds, $others);
		$others = "ORDER BY realtyaspect_order ASC";
		$rAspectSels = $opt->optionselected($rAspect, "--".def_chon."--", "vot_realtyaspect", "realtyaspect_id", "realtyaspect_name", $conds, $others);
		$others = "ORDER BY realtyplace_order ASC";
		$rPlaceSels = $opt->optionselected($rPlace, "--".def_chon."--", "vot_realtyplace", "realtyplace_id", "realtyplace_name", $conds, $others);

		include $config["FCKeditor_path"]."fckeditor.php";
		$sBasePath  = $config["FCKeditor_path"];
		
		$oFCKeditor = new FCKeditor("shortdes");
		$oFCKeditor->BasePath	= $sBasePath;
		$oFCKeditor->Value		= $shortdes;
		$oFCKeditor->Width	= "100%";
		$oFCKeditor->Height	= 400;
		
		include_once("realtyform.php");
		break;

	default:
	
		$isSave = NULL;
		_SESSION_REGISTER("isSave");

		include_once("includes/paging.php");
		
		$opt = new option();
		$cond = "language_id = '".$LANG."'";
		if($CURMOD != NULL)
		{
			$cond .= " AND modules_id = '".$CURMOD."'";
		}
		if($KWD != NULL) 
		{
			$cond .= " AND realty_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		if(!$vArrow) $vArrow = 'DESC';
		
		$other = " ORDER BY realty_$orderBy $vArrow";
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
		
		$sql->set_query("vot_realty","*",$cond,$other);
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
					$nid = $sql->farray["realty_id"];
					$name = $itemTitle = $sql->farray["realty_name"];
					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name,0,$MAXSTRLEN)."..";
					}
					$order = $sql->farray["realty_order"];
					$view = $checked[$sql->farray["realty_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["realty_name"];
						$ndate = outDateStr($sql->farray["realty_date"]);
						$price = $sql->farray["realty_price"];
						$area = $sql->farray["realty_area"];
						$thumb1 = $sql->farray["realty_thumb1"];
						$image1 = $sql->farray["realty_image1"];
						$thumb2 = $sql->farray["realty_thumb2"];
						$image2 = $sql->farray["realty_image2"];
						$show = $sql->farray["realty_show"];
						$shortdes = $sql->farray["realty_shortdes"];
						$cur_order = $sql->farray["realty_order"];
						$cur_view = $checked[$sql->farray["realty_view"]];
						$rAspect = $sql->farray["realtyaspect_id"];
						$rPlace = $sql->farray["realtyplace_id"];
						$rType = $sql->farray["realtytype_id"];

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
		$conds = "language_id='".$LANG."'";	
		if($CURMOD != NULL)
		{
			$conds .= " AND modules_id = '".$CURMOD."'";
		}
		$others = "ORDER BY realtytype_order ASC";
		$rTypeSels = $opt->optionselected($rType, "--".def_chon."--", "vot_realtytype", "realtytype_id", "realtytype_name", $conds, $others);
		$others = "ORDER BY realtyaspect_order ASC";
		$rAspectSels = $opt->optionselected($rAspect, "--".def_chon."--", "vot_realtyaspect", "realtyaspect_id", "realtyaspect_name", $conds, $others);
		$others = "ORDER BY realtyplace_order ASC";
		$rPlaceSels = $opt->optionselected($rPlace, "--".def_chon."--", "vot_realtyplace", "realtyplace_id", "realtyplace_name", $conds, $others);

		$rightContentFile = "realtyinfos.php";		
		
		include_once("listrealty.php");
		break;			
}
?>