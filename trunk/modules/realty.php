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
	$count = 1;
	$maxRows = 25;
	
	$checked = array(0 => NULL, 1 => "checked");
	
	$thumbMaxW = 117;
	$thumbMaxH = 160;
	
	$listCateId = $cateId;
	$listParCate = $cateId;
	
	if(checkSubCate($cateId) > 0)
	{
		$curLevel = 0;
		$maxLevel = $opt->optionvalue("vot_modules", "MAX(modules_level)", "language_id='".$lang."' AND modules_view=1");
		$listCateId = NULL;
		$conds = "modules_id='".$cateId."'";
		$sql->set_query("vot_modules", "*", $conds);
		if($sql->set_farray())
		{
			$curLevel = $sql->farray["moudles_level"];
		}
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
					if($listCateId != NULL) $listCateId .= "','".$subCateId;
					else $listCateId .= $subCateId;
				}
			}
		}
	}
	
	$conds = "language_id='".$lang."' AND modules_id  IN ('".$listCateId."') AND realtytype_view=1";
	$others = "ORDER BY modules_id,realtytype_order ASC";
	$rTypeSels = $opt->optionselected($searchRType, "-- ".$define["var_tatca"]." --", "vot_realtytype", "realtytype_id", "realtytype_name", $conds, $others);
	
	$conds = "language_id='".$lang."' AND modules_id  IN ('".$listCateId."') AND realtyaspect_view=1";
	$others = "ORDER BY modules_id,realtyaspect_order ASC";
	$rAspectSels = $opt->optionselected($searchRAspect, "-- ".$define["var_tatca"]." --", "vot_realtyaspect", "realtyaspect_id", "realtyaspect_name", $conds, $others);
	
	$conds = "language_id='".$lang."' AND modules_id  IN ('".$listCateId."') AND realtyplace_view=1";
	$others = "ORDER BY modules_id,realtyplace_order ASC";
	$rPlaceSels = $opt->optionselected($searchRPlace, "-- ".$define["var_tatca"]." --", "vot_realtyplace", "realtyplace_id", "realtyplace_name", $conds, $others);
	if(!$itemId || !validGetVar($itemId))
	{
		$conds = "modules_id IN ('".$listCateId."') AND realty_view=1";
		if($searchKeyword != NULL)
		{
			if($searchExact)
			{
				$conds .= " AND realty_name LIKE '%".$searchKeyword."%'";
			}
			else
			{
				$conds .= " AND realty_name LIKE '".$searchKeyword."'";
			}
			$searchExactChecked = $checked[$searchExact];
		}
		if($searchFromArea != NULL)
		{
			$conds .= " AND realty_area >= '".$searchFromArea."'";
		}
		if($searchToArea != NULL)
		{
			$conds .= " AND realty_area <= '".$searchToArea."'";
		}
		if($searchFromPrice != NULL)
		{
			$conds .= " AND realty_price >= '".$searchFromPrice."'";
		}
		if($searchToPrice != NULL)
		{
			$conds .= " AND realty_price <= '".$searchToPrice."'";
		}
		if($searchRType != NULL)
		{
			$conds .= " AND realtytype_id='".$searchRType."'";
		}
		if($searchRAspect != NULL)
		{
			$conds .= " AND realtyaspect_id='".$searchRAspect."'";
		}
		if($searchRPlace != NULL)
		{
			$conds .= " AND realtyplace_id='".$searchRPlace."'";
		}
		$others = "ORDER BY realty_date DESC, realty_order DESC";
		$sql->set_query("vot_realty", "*", $conds, $others);
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
			$contentDetail .= '
			<table align="center" width="100%" cellpadding="5" cellspacing="0" border="1" bordercolor="#b2ebf6" style="border-colapse:colapse">
				<tr>
					<td width="5%" style="text-align:center; font-size:11px"><strong>'.$define["var_sothutu"].'</strong></td>
					<td width="37%" style="text-align:center; font-size:11px"><strong>'.$define["var_tinthue"].'</strong></td>
					<td width="10%" style="text-align:center; font-size:11px"><strong>'.$define["var_giathue"].'</strong><br>('.$define["var_trieu"].'/m<sup>2</sup>)</td>
					<td width="15%" style="text-align:center; font-size:11px"><strong>'.$define["var_khuvuc"].'</strong></td>
					<td width="10%" style="text-align:center; font-size:11px"><strong>'.$define["var_dientich"].'</strong><br>(m<sup>2</sup>)</td>
					<td width="12%" style="text-align:center; font-size:11px"><strong>'.$define["var_huongnha"].'</strong></td>
					<td width="11%" style="text-align:center; font-size:11px"><strong>'.$define["var_luotxem"].'</strong></td>
				</tr>';
			
			$low = $curRow; 
			$curRow = 1;
			while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
			{
				$curRow++;			                           
				if($curRow > $low)
				{
					$infoId = $sql->farray["realty_id"];
					$infoName = displayData_DB($sql->farray["realty_name"]);
					$infoPrice = $sql->farray["realty_price"];
					$infoPlace = $sql->farray["realtyplace_id"];
					$infoPlace = $opt->optionvalue("vot_realtyplace","realtyplace_name","realtyplace_id='".$infoPlace."'");
					$infoArea = $sql->farray["realty_area"];
					$infoAspect = $sql->farray["realtyaspect_id"];
					$infoAspect = $opt->optionvalue("vot_realtyaspect","realtyaspect_name","realtyaspect_id='".$infoAspect."'");
					$infoShow = $sql->farray["realty_show"];
					$itemName = str_replace(" ", "_", $infoName);
					$sLink = "$_URL_BASE/index.php/$cateId/$infoId/$itemName";
					
					if($count % 2 != 0) $rowBg = '#effbfc';
					else $rowBg = '#FFFFFF';
					
					$contentDetail .= '
					<tr bgcolor="'.$rowBg.'">
						<td style="text-align:center; font-size:11px">'.$count.'</td>
						<td style="text-align:left; font-size:11px"><a href="'.$sLink.'">'.$infoName.'</a></td>
						<td style="text-align:center; font-size:11px">'.$infoPrice.'</td>
						<td style="text-align:center; font-size:11px">'.$infoPlace.'</td>
						<td style="text-align:center; font-size:11px">'.$infoArea.'</td>
						<td style="text-align:center; font-size:11px">'.$infoAspect.'</td>
						<td style="text-align:center; font-size:11px">'.$infoShow.'</td>
					</tr>';
					$count ++;
				}
			}
			$contentDetail .= '</table>';
		}
		require_once("$_HTML_DIR/center_realty_list.php");
	}
	else
	{
		$contentTitle = NULL;
		$contentDetail = NULL;
		
		$listShowItemId = $itemId;
		
		$froms = "vot_realty";
		$conds = "realty_id='".$itemId."'";
		$sql->set_query($froms, "*", $conds);
		if($sql->set_farray())
		{
			$contentTitle = $sql->farray["realty_name"];
			$contentDate = outDateStr($sql->farray["realty_date"]);
			$contentThumb1 = $sql->farray["realty_thumb1"];
			$contentThumb2 = $sql->farray["realty_thumb2"];
			$contentImage2 = $sql->farray["realty_image2"];
			$infoImgNote2 = $sql->farray["realty_noteimg2"];
			$contentDetail .= '<table width="100%" cellpadding="0" cellspacing="0"><tr>';
			if(is_file("$_ROOT_PATH/$contentThumb1"))
			{
				$contentImage = $sql->farray["realty_image1"];
				$infoImgNote= $sql->farray["realty_noteimg1"];
				$imgLink = "$_URL_BASE/html_includes/show_photo.php?imgSrc=$contentImage";
				$contentDetail .= '
				<td align="center" valign="top" width="50%">
					<table width="50" cellpadding="3" cellspacing="0">
						<tr>
							<td align="center"><a href="'.$imgLink.'" title="'.$infoImgNote.'" onClick="Modalbox.show(this.href, {title: this.title, overlayClose: false}); return false;"><img src="'."$_URL_BASE/$contentImage".'" border="0"></a></td>
						</tr>
						<tr>
							<td class="itemImageNote">'.$infoImgNote.'</td>
						</tr>
					</table>
				</td>';
			}
			if(is_file("$_ROOT_PATH/$contentThumb2"))
			{
				$contentImage = $sql->farray["realty_image2"];
				$infoImgNote= $sql->farray["realty_noteimg2"];
				$imgLink = "$_URL_BASE/html_includes/show_photo.php?imgSrc=$contentImage";
				$contentDetail .= '
				<td align="center" valign="top" width="50%">
					<table width="50" cellpadding="3" cellspacing="0">
						<tr>
							<td align="center"><a href="'.$imgLink.'" title="'.$infoImgNote.'" onClick="Modalbox.show(this.href, {title: this.title, overlayClose: false}); return false;"><img src="'."$_URL_BASE/$contentImage".'" border="0"></a></td>
						</tr>
						<tr>
							<td class="itemImageNote">'.$infoImgNote.'</td>
						</tr>
					</table>
				</td>';
			}
			$contentDetail .= '</tr></table><p id="mainContentDetail">'.$sql->farray["realty_shortdes"].'</p>';
	
			$insert = "realty_show = realty_show+1";
			$where = "realty_id='".$itemId."'";
			$sql->update("vot_realty", $insert, $where);
		}
		else
		{
			redirect("$_URL_BASE/");
		}
		require_once("$_HTML_DIR/center_realty_detail.php");
	}
}
?>