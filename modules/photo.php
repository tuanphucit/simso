<?
if(!$_PAGE_VALID)
{
	exit();
}

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
	$nCols = 3;
	$count = 1;
	$colWidth = round(100/$nCols);
	$maxRows = 15;
	
	$checked = array(0 => NULL, 1 => "checked");
	
	$thumbMaxW = 117;
	$thumbMaxH = 160;
	
	if(checkSubCate($cateId) < 1)
	{
		$conds = "modules_id='".$cateId."' AND photo_view=1";
		if($searchKeyword != NULL)
		{
			if($searchExact)
			{
				$conds .= " AND photo_name LIKE '%".$searchKeyword."%'";
			}
			else
			{
				$conds .= " AND photo_name LIKE '".$searchKeyword."'";
			}
			$searchExactChecked = $checked[$searchExact];
		}
		$others = "ORDER BY photo_order DESC";
		$sql->set_query("vot_photo", "*", $conds, $others);
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
					$infoId = $sql->farray["photo_id"];
					$infoName = displayData_DB($sql->farray["photo_name"]);
					//$infoNote = displayData_DB($sql->farray["photo_note"]);
					$thumb = $sql->farray["photo_thumb"];
					$image = $sql->farray["photo_image"];
					if(is_file("$_ROOT_PATH/$thumb"))
					{
						$thumbSize = imageSize("$_ROOT_PATH/$thumb", $thumbMaxW, $thumbMaxH);
						$sLink = "$_URL_BASE/show_image.php/$cateId/$infoId";
						$infoImg  = "<a href=\"$sLink\" title=\"$infoName\" onClick=\"Modalbox.show(this.href, {title: this.title,overlayClose: false}); return false;\">";
						$infoImg .= "<img src=\"$_URL_BASE/$thumb\" width=\"$thumbSize[0]\" height=\"$thumbSize[1]\" border=\"0\"></a>";
						$contentDetail .= '
						<td width="'.$colWidth.'%" height="100%" align="center" valign="top" style="padding:10px 5px 10px 5px">
							<table cellpadding="0" cellspacing="0" border="0" width="'.($thumbMaxW+8).'" height="'.($thumbMaxH+8).'">
								<tr>
									<td align="center" class="itemContentImgBox">'.$infoImg.'</td>
								</tr>
							</table>
							<div class="itemImageNote">'.$infoName.'</div>
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
		$photoLibOpt = $opt->optionselected($cateId, NULL, "vot_modules", "modules_id", "modules_name", $conds, $others);
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
					if($listParCate != NULL) $listParCate .= "','"+$subCateId;
					else $listParCate .= $subCateId;
				}
				else
				{
					$ssql = new mysql;
					$isPhoto = 0;
					$sconds = "modules_id='".$subCateId."' AND photo_view=1";
					$sothers = "ORDER BY photo_order ASC";
					$ssql->set_query("vot_photo", "photo_thumb", $sconds, $sothers);
					while($ssql->set_farray() && !$isPhoto)
					{
						$photoThumb = $ssql->farray["photo_thumb"];
						if(is_file("$_ROOT_PATH/$photoThumb"))
						{
							$isPhoto = 1;
						}
					}
					if(!$isPhoto)
					{
						$photoThumb = 'images/noimg.jpg';
					}
					$thumbSize = imageSize("$_ROOT_PATH/$photoThumb", $thumbMaxW, $thumbMaxH);
					$sLink = "$_URL_BASE/index.php/$subCateId/$subCateLink";
					$infoImg  = "<a href=\"$sLink\"><img src=\"$_URL_BASE/$photoThumb\" width=\"$thumbSize[0]\" height=\"$thumbSize[1]\" border=\"0\"></a>";
					$contentDetail .= '
					<td width="'.$colWidth.'%" height="100%" align="center" valign="top" style="padding:10px 5px 10px 5px">
						<table cellpadding="0" cellspacing="0" border="0" width="144" height="170" background="'."$_IMG_DIR/album_bg.jpg".'">
							<tr>
								<td width="15">&nbsp;</td>
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
		$photoLibOpt = $opt->optionselected($cateId, NULL, "vot_modules", "modules_id", "modules_name", $conds, $others);
	}
	
	require_once("$_HTML_DIR/center_photo_gallery.php");
}
?>