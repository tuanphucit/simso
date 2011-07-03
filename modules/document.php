<?
if(!$_PAGE_VALID)
{
	exit();
}
/*
if(!$cateId || !validGetVar($cateId))
{
	redirect("$_URL_BASE/");
}
*/
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
	
	$conds = "modules_id IN ('".$listCateId."') AND document_view=1";
	if($searchKeyword != NULL)
	{
		if($searchExact)
		{
			$conds .= " AND (document_name LIKE '%".$searchKeyword."%' OR document_shortdes LIKE '%".$searchKeyword."%')";
		}
		else
		{
			$conds .= " AND (document_name LIKE '".$searchKeyword."' OR document_shortdes LIKE '".$searchKeyword."')";
		}
		$searchExactChecked = $checked[$searchExact];
	}
	if($searchFromDate != NULL)
	{
		$fromDate = inDateStr($searchFromDate);
		$conds .= " AND document_date >= '".$fromDate."'";
	}
	if($searchToDate != NULL)
	{
		$toDate = inDateStr($searchToDate);
		$conds .= " AND document_date <= '".$toDate."'";
	}
	if($searchDocType != NULL)
	{
		$conds .= " AND documenttype_id='".$searchDocType."'";
	}
	if($searchDocArea != NULL)
	{
		$conds .= " AND documentarea_id='".$searchDocArea."'";
	}
	if($searchDocProm != NULL)
	{
		$conds .= " AND documentprom_id='".$searchDocProm."'";
	}
	$others = "ORDER BY document_date DESC, document_order DESC";
	$sql->set_query("vot_document", "*", $conds, $others);
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
				<td width="5%" style="text-align:center; font-weight:bold; font-size:11px">'.$define["var_sothutu"].'</td>
				<td width="53%" style="text-align:center; font-weight:bold; font-size:11px">'.$define["var_vanban"].'</td>
				<td width="12%" style="text-align:center; font-weight:bold; font-size:11px">'.$define["var_taive"].'</td>
				<td width="17%" style="text-align:center; font-weight:bold; font-size:11px">'.$define["var_capnhat"].'</td>
				<td width="13%" style="text-align:center; font-weight:bold; font-size:11px">'.$define["var_soluottaive"].'</td>
			</tr>';
		
		$low = $curRow; 
		$curRow = 1;
		while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
		{
			$curRow++;			                           
			if($curRow > $low)
			{
				$infoId = $sql->farray["document_id"];
				$infoName = displayData_DB($sql->farray["document_name"]);
				$infoDate = outDateStr($sql->farray["document_date"]);
				$infoDown = $sql->farray["document_down"];
				$itemName = str_replace(" ", "_", $infoName);
				$sLink = "$_URL_BASE/show_docdes.php/$cateId/$infoId";
				$checkDownDoc = NULL;
				$checkDownPdf = NULL;
				/*
				if(!$isLogin)
				{
					$alertStr = str_replace("<br>", " ", $define["var_banchuadangnhap"]);
					$checkDownDoc = 'onClick="alert(\''.$alertStr.'\'); return false"';
					$checkDownPdf = 'onClick="alert(\''.$alertStr.'\'); return false"';
				}
				else
				{
				*/
				$alertStr = str_replace("<br>", " ", $define["var_xinloitailieuchuaduoccapnhat"]);
				$infoDoc = $sql->farray["document_msdoc"];
				$infoPdf = $sql->farray["document_adpdf"];
				if(!is_file("$_ROOT_PATH/$infoDoc"))
				{
					$checkDownDoc = 'onClick="alert(\''.$alertStr.'\'); return false"';
				}
				if(!is_file("$_ROOT_PATH/$infoPdf"))
				{
					$checkDownPdf = 'onClick="alert(\''.$alertStr.'\'); return false"';
				}
				//}
				if($count % 2 != 0) $rowBg = '#effbfc';
				else $rowBg = '#FFFFFF';
				
				$contentDetail .= '
				<tr bgcolor="'.$rowBg.'">
					<td width="7%" style="text-align:center; font-size:11px">'.$count.'</td>
					<td width="51%" style="text-align:left; font-size:11px"><a href="'.$sLink.'" title="'.$subPageTitle.'" onClick="Modalbox.show(this.href, {title: this.title, width:500, height:500,overlayClose: false}); return false;">'.$infoName.'</a></td>
					<td width="13%" style="text-align:center; font-size:11px">';
					if($infoDoc <> NULL)
						{
$contentDetail .= '		<a href="'."$_URL_BASE/downloaddoc.php/$infoId/doc".'" '.$checkDownDoc.'><img src="'.$_IMG_DIR.'/doc_down.gif" width="16" height="16" border="0"></a>&nbsp;&nbsp;';
						}
					if($infoPdf <> NULL)
						{	
$contentDetail .= '	<a href="'."$_URL_BASE/downloaddoc.php/$infoId/pdf".'" '.$checkDownPdf.'><img src="'.$_IMG_DIR.'/pdf_down.gif" width="16" height="16" border="0"></a>';
						}
$contentDetail .= '	</td>
					<td width="15%" style="text-align:center; font-size:11px">'.$infoDate.'</td>
					<td width="13%" style="text-align:center; font-size:11px">'.$infoDown.'</td>
				</tr>';
				$count ++;
			}
		}
		$contentDetail .= '</table>';
	}
	$conds = "language_id='".$lang."' AND modules_id  IN ('".$listCateId."') AND documenttype_view=1";
	$others = "ORDER BY modules_id,documenttype_order ASC";
	$docTypeSels = $opt->optionselected($searchDocType, "-- ".$define["var_tatca"]." --", "vot_documenttype", "documenttype_id", "documenttype_name", $conds, $others);
	
	$conds = "language_id='".$lang."' AND modules_id  IN ('".$listCateId."') AND documentarea_view=1";
	$others = "ORDER BY modules_id,documentarea_order ASC";
	$docAreaSels = $opt->optionselected($searchDocArea, "-- ".$define["var_tatca"]." --", "vot_documentarea", "documentarea_id", "documentarea_name", $conds, $others);
	
	$conds = "language_id='".$lang."' AND modules_id  IN ('".$listCateId."') AND documentprom_view=1";
	$others = "ORDER BY modules_id,documentprom_order ASC";
	$docPromSels = $opt->optionselected($searchDocProm, "-- ".$define["var_tatca"]." --", "vot_documentprom", "documentprom_id", "documentprom_name", $conds, $others);
	
	require_once("$_HTML_DIR/center_content_doc.php");
}
?>