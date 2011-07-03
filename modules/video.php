<?
if(!$cateId || !validGetVar($cateId))
{
	redirect("$_URL_BASE/");
}

$catePermission = $opt->optionvalue("vot_modules", "modules_per", "modules_id='".$cateId."'");

if($catePermission && !$isLogin)
{
	require_once("$_HTML_DIR/page_limited.php");
}
else
{
	$nCols = 2;
	$count = 1;
	$colWidth = round(100/$nCols);
	$maxRows = 15;
	
	$checked = array(0 => NULL, 1 => "checked");
	
	$imageMaxW = 137;
	$imageMaxH = 91;
	
	if(checkSubCate($cateId) < 1)
	{
		$conds = "modules_id='".$cateId."' AND video_view=1";
		if($searchKeyword != NULL)
		{
			if($searchExact)
			{
				$conds .= " AND video_name LIKE '%".$searchKeyword."%'";
			}
			else
			{
				$conds .= " AND video_name LIKE '%".$searchKeyword."%'";
			}
			$searchExactChecked = $checked[$searchExact];
		}
		$others = "ORDER BY video_date DESC, video_order DESC";
		$sql->set_query("vot_video", "*", $conds, $others);
		$searchResult = $tRows = $sql->nRows;	
		if(!$curPg) 
		{
			$curPg = 1;
		}
		else
		{
			$numPgs = ceil($tRows/$maxRows);
			if($curPg > $numPgs) $curPg = $numPgs;
		}
		$curRow = ($curPg - 1) * $maxRows + 1;
		if($tRows > 0)
		{
			$contentDetail = '<table width="98%" align="center" cellpadding="0" cellspacing="0" border="0"><tr>';
			
			$low = $curRow; 
			$curRow = 1;
			while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
			{
				$curRow++;			                           
				if($curRow > $low)
				{
					$infoId = $sql->farray["video_id"];
					$infoName = displayData_DB($sql->farray["video_name"]);
					$infoPoster = displayData_DB($sql->farray["video_poster"]);
					$infoDate = outDateStr($sql->farray["video_date"]);
					$infoShow = $sql->farray["video_show"];
					$image = $sql->farray["video_image"];
					$video = $sql->farray["video_file"];
					if(is_file("$_ROOT_PATH/$image"))
					{
						$imageSize = imageSize("$_ROOT_PATH/$image", $imageMaxW, $imageMaxH);
						$sLink = "$_URL_BASE/show_video.php/$cateId/$infoId";
						$downLink = "$_URL_BASE/$video";
						$infoImg  = "<a href=\"$sLink\" title=\"$infoName\" onClick=\"Modalbox.show(this.href, {title: this.title,overlayClose: false}); return false;\">";
						$infoImg .= "<img src=\"$_URL_BASE/$image\" width=\"$imageSize[0]\" height=\"$imageSize[1]\" border=\"0\"></a>";
						$contentDetail .= '
						<td width="'.$colWidth.'%" height="100%" align="center" valign="top" style="padding:10px 5px 10px 5px">
							<table cellpadding="0" cellspacing="0" border="0" width="'.($thumbMaxW+8).'" height="'.($thumbMaxH+8).'">
								<tr>
									<td align="center">
										<div class="itemContentImgBox">'.$infoImg.'</div>
									</td>
									<td valign="top" nowrap style="padding-left:5px">
										<div style="color:#3950fc">'.$infoName.'</div>
										<div align="left">'.$define["var_nguoidang"].' : <font color="#3950fc">'.$infoPoster.'</font></div>
										<div align="left">'.$define["var_ngaygui"].' : '.$infoDate.'</div>
										<div align="left">'.$define["var_luotxem"].' : '.$infoShow.'</div>
										<div align="left" class="downloadVideoLink">
											<a href="'.$downLink.'" onClick="alertWhenClick(); return false;">'.$define["var_taive"].'</a> | 
											<a href="'.$sLink.'" title="'.$infoName.'" onClick="Modalbox.show(this.href, {title: this.title,overlayClose: false}); return false;">'.$define["var_xemngay"].'</a>
										</div>
									</td>
								</tr>
							</table>
						</td>';
						if($count % $nCols == 0)
						{
							$contentDetail .= '</tr><tr>';
						}
						$count ++;
					}
				}
			}
			$contentDetail .= '</tr></table>';
		}
		$conds = "modules_id = '".$cateId."'";
		$parCateId = $opt->optionvalue("vot_modules","modules_parent",$conds);
		$conds = "modules_parent = '".$parCateId."' AND modules_view=1";
		$others = "ORDER BY modules_order ASC";
		$videoLibOpt = $opt->optionselected($cateId, NULL, "vot_modules", "modules_id", "modules_name", $conds, $others);
	}
	else
	{
		$curLevel = 0;
		$maxLevel = $opt->optionvalue("vot_modules", "MAX(modules_level)", "language_id='".$lang."' AND modules_view=1");
		$listCateId = NULL;
		$listParCate = $cateId;
		$conds = "modules_id='".$cateId."'";
		$sql->set_query("vot_modules", "*", $conds);
		if($sql->set_farray())
		{
			$curLevel = $sql->farray["moudles_level"];
		}
		$contentDetail = '<table width="98%" align="center" cellpadding="0" cellspacing="0" border="0"><tr>';
		for($i = $curLevel+1; $i <= $maxLevel; $i++)
		{
			$conds = "modules_parent IN ('".$listParCate."') AND modules_level='".$i."' AND modules_view=1";
			$others = "ORDER BY modules_order ASC";
			$sql->set_query("vot_modules", "*", $conds, $others);
			//$listParCate = NULL;
			while($sql->set_farray())
			{
				$subCateId = $sql->farray["modules_id"];
				$subCateName = $sql->farray["modules_name"];
				$subCateLink = $sql->farray["modules_linkto"];
				if(checkSubCate($subCateId))
				{
					if($listParCate != NULL) $listParCate .= "','".$subCateId;
					else $listParCate .= $subCateId;
				}
				else
				{
					$ssql = new mysql;
					$isvideo = 0;
					$sconds = "modules_id='".$subCateId."' AND video_view=1";
					$sothers = "ORDER BY video_order ASC";
					$ssql->set_query("vot_video", "video_image", $sconds, $sothers);
					while($ssql->set_farray() && !$isvideo)
					{
						$videoThumb = $ssql->farray["video_image"];
						if(is_file("$_ROOT_PATH/$videoThumb"))
						{
							$isvideo = 1;
						}
					}
					if(!$isvideo)
					{
						$videoThumb = 'images/noimg.jpg';
					}
					$thumbSize = imageSize("$_ROOT_PATH/$videoThumb", $imageMaxW, $imageMaxH);
					$sLink = "$_URL_BASE/index.php/$subCateId/$subCateLink";
					$infoImg  = "<a href=\"$sLink\"><img src=\"$_URL_BASE/$videoThumb\" width=\"$thumbSize[0]\" height=\"$thumbSize[1]\" border=\"0\"></a>";
					$contentDetail .= '
					<td width="'.$colWidth.'%" height="100%" align="center" valign="top" style="padding:10px 5px 10px 5px">
						<table cellpadding="0" cellspacing="0" border="0" width="147" height="124" background="'."$_IMG_DIR/video_album_bg.jpg".'">
							<tr>
								<td align="center">'.$infoImg.'</td>
							</tr>
						</table>
						<div class="itemImageNote">'.$subCateName.'</div>
					</td>';
					if($count % $nCols == 0)
					{
						$contentDetail .= '</tr><tr>';
					}
					$count ++;
				}
			}
		}
		$contentDetail .= '</tr></table>';
		$searchResult = $count - 1;
		$conds = "modules_parent = '".$cateId."' AND modules_view=1";
		$others = "ORDER BY modules_order ASC";
		$videoLibOpt = $opt->optionselected($cateId, NULL, "vot_modules", "modules_id", "modules_name", $conds, $others);
	}
	
	require_once("$_HTML_DIR/center_video_gallery.php");
}
?>