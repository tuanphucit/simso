<?
$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

$sql = new mysql();
$opt = new option();

$searchFormActionTo = "index.php?module=$module";
$linktoOrderByName = "?module=$module";
$linktoOrderByOrder = "?module=$module";

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
		$sql->delete("vot_news","news_id",$chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "news_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_news",$values,"news_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "news_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_news",$values,"news_id='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
if(!$view)  $view = 0;
if(!$ihome)  $ihome= 0;
if(!$ihight)  $ihight= 0;
if(!$istop)  $istop= 0;
if(!$visited)  $visited= 0;
		$maxImgW = 276;
		$maxImgH = 280;
		$new_image = NULL;
		$upload_dir = "uploads/news_images";
		if($ndate == NULL)
		{
			$ndate = date("d-m-Y");
		}
		$ndate = inDateStr($ndate);
		if($CURID!=NULL && $isSave==NULL)
		{			
			if($image_name == NULL || $image_name == 'none') 
			{
				$new_image = $old_image;
			}
			else
			{
				delFile("../$old_image");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_image = "$upload_dir/image_".date("dmy").time().".".extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image", $maxImgW, $maxImgH);		
				}
			}
			$values  = "news_name='".$nname."',news_date='".$ndate."',news_image='".$new_image."',news_imagenote='".$imgnote."',news_shortdes='".$shortdes."',news_detail='".$detail."',news_source='".$source."',news_istop='".$istop."',news_ihome='".$ihome."',news_visited='".$visited."',news_order='".$order."',news_view='".$view."'";
			$sql->update("vot_news",$values,"news_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($image_name != NULL || $image_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_image = "$upload_dir/image_".date("dmy").time().".".extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image", $maxImgW, $maxImgH);		
				}
			}
			$fields = "news_name,news_date,news_image,news_imagenote,news_shortdes,news_detail,news_source,news_istop,news_ihome,news_visited,news_order,news_view,modules_id,language_id";
			$values  = "'".$nname."','".$ndate."','".$new_image."','".$imgnote."','".$shortdes."','".$detail."','".$source."','".$istop."','".$ihome."','".$visited."','".$order."','".$view."','".$CURMOD."','".$LANG."'";
			$sql->insert("vot_news",$fields,$values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		break;
		
	case 'edit':
		$conds = "language_id='".$LANG."' AND modules_id='".$CURMOD."'";
		$order = $opt->optionvalue("vot_news", "MAX(news_order)",$conds) + 1; 
		$view = $checked[1];
		
		if($CURID!=NULL)
		{
			$sql->set_query("vot_news","*","news_id=$CURID");
			$sql->set_farray();
			$name = $sql->farray["news_name"];
			$ndate = outDateStr($sql->farray["news_date"]);
			$image = $sql->farray["news_image"];
			$imgnote = $sql->farray["news_imagenote"];
			$shortdes = $sql->farray["news_shortdes"];
			$detail = $sql->farray["news_detail"];
			$source = $sql->farray["news_source"];
			$visited = $sql->farray["news_visited"];
			$order = $sql->farray["news_order"];
			$istop = $checked[$sql->farray["news_istop"]];
			$ihome = $checked[$sql->farray["news_ihome"]];
			$view = $checked[$sql->farray["news_view"]];
			$pageTitle = alt_add;
			$curPage = "$name";
		}

		include $config["FCKeditor_path"]."fckeditor.php";
		$sBasePath  = $config["FCKeditor_path"];
		
		$oFCKeditor_1 = new FCKeditor("shortdes");
		$oFCKeditor_1->BasePath	= $sBasePath;
		$oFCKeditor_1->Value		= $shortdes;
		$oFCKeditor_1->Width	= "100%";
		$oFCKeditor_1->Height	= 300;
		
		$oFCKeditor_2 = new FCKeditor("detail");
		$oFCKeditor_2->BasePath	= $sBasePath;
		$oFCKeditor_2->Value		= $detail;
		$oFCKeditor_2->Width	= "100%";
		$oFCKeditor_2->Height	= 450;

		include_once("newsform.php");
		
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
			$cond .= " AND news_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		
		if(!$vArrow) $vArrow = 'DESC';
		
		$other = " ORDER BY news_$orderBy $vArrow";
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
		
		$sql->set_query("vot_news","*",$cond,$other);
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
					$nid = $sql->farray["news_id"];
					$name = $itemTitle = $sql->farray["news_name"];
					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name,0,$MAXSTRLEN)."..";
					}
					$order = $sql->farray["news_order"];
					$view = $checked[$sql->farray["news_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["news_name"];
						$ndate = outDateStr($sql->farray["news_date"]);
						$image = $sql->farray["news_image"];
						if(!is_file("../$image"))
						{
							$image = _NO_IMG;
						}
						$imgnote = $sql->farray["news_imagenote"];
						$shortdes = $sql->farray["news_shortdes"];
						$detail = $sql->farray["news_detail"];
						$source = $sql->farray["news_source"];
						$visited = $sql->farray["news_visited"];
						$istop = $checked[$sql->farray["news_istop"]];
						$ihome = $checked[$sql->farray["news_ihome"]];
						$cur_order = $sql->farray["news_order"];
						$cur_view = $checked[$sql->farray["news_view"]];
		
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
			$rightContentFile = "newsinfos.php";
		}
		else
		{ 
			$pageContent .= NORESULT;
			$rightContentFile = "html_includes/no_info.html";
		}		
		
		$linktoOrderByName .= "&orderBy=name&vArrow=$toArrow&KWD=$KWD";
		$linktoOrderByOrder .= "&orderBy=order&vArrow=$toArrow&KWD=$KWD";

		include_once("listnews.php");
		break;			
}
?>
