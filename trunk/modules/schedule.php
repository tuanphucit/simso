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
	
	$conds = "modules_id IN ('".$listCateId."') AND schedule_view=1";
	if($searchKeyword != NULL)
	{
		if($searchExact)
		{
			$conds .= " AND schedule_name LIKE '%".$searchKeyword."%'";
		}
		else
		{
			$conds .= " AND schedule_name LIKE '".$searchKeyword."'";
		}
		$searchExactChecked = $checked[$searchExact];
	}
	if($searchFromDate != NULL)
	{
		$fromDate = inDateStr($searchFromDate);
		$conds .= " AND schedule_date >= '".$fromDate."'";
	}
	if($searchToDate != NULL)
	{
		$toDate = inDateStr($searchToDate);
		$conds .= " AND schedule_date <= '".$toDate."'";
	}
	if($searchDocType != NULL)
	{
		$conds .= " AND scheduletype_id='".$searchDocType."'";
	}
	if($searchDocArea != NULL)
	{
		$conds .= " AND schedulearea_id='".$searchDocArea."'";
	}
	if($searchDocProm != NULL)
	{
		$conds .= " AND scheduleprom_id='".$searchDocProm."'";
	}
	$others = "ORDER BY schedule_pdate DESC, schedule_order DESC";
	$sql->set_query("vot_schedule", "*", $conds, $others);
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
		$contentDetail .= '<table align="center" width="90%" cellpadding="5" cellspacing="0" border="0"><tr>';
		
		$low = $curRow; 
		$curRow = 1;
		while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
		{
			$curRow++;			                           
			if($curRow > $low)
			{
				$infoId = $sql->farray["schedule_id"];
				$infoName = displayData_DB($sql->farray["schedule_name"]);
				$infoFDate = outDateStr($sql->farray["schedule_fdate"]);
				$infoEDate = outDateStr($sql->farray["schedule_edate"]);
				$infoFile = $sql->farray["schedule_file"];
				$infoDown = $sql->farray["schedule_down"];
				$itemName = str_replace(" ", "_", $infoName);
				$sLink = "$_URL_BASE/show_schedule.php/$cateId/$infoId";
				$downLink = "$_URL_BASE/downloadschedule.php/$infoId";

				$checkDownFile = NULL;
				if(!$isLogin)
				{
					$alertStr = str_replace("<br>", " ", $define["var_banchuadangnhap"]);
					$checkDownFile = 'onClick="alert(\''.$alertStr.'\'); return false"';
				}
				elseif(!is_file("$_ROOT_PATH/$infoFile"))
				{
					$alertStr = str_replace("<br>", " ", $define["var_xinloitailieuchuaduoccapnhat"]);
					$checkDownFile = 'onClick="alert(\''.$alertStr.'\'); return false"';
				}

				$contentDetail .= '
				<tr bgcolor="'.$rowBg.'">
					<td width="10%" align="center"><img src="'.$_IMG_DIR.'/lich_lam_viec.jpg" width="68" height="66" border="0"></td>
					<td width="51%" style="text-align:left; font-size:11px">
						<div>'.$infoName.' '.$define["var_tungay"].'
							<font color="#FF0000">'.$infoFDate.'</font> '.$define["var_denngay"].' <font color="#FF0000">'.$infoEDate.'</font>
						</div>
						<div class="downloadVideoLink">
							<a href="'.$sLink.'" title="'.$infoName.'" onClick="openBox(this.href, 750,550,\'yes\'); return false;">'.$define["var_chitiet"].'</a> | 
							<a href="'.$downLink.'" '.$checkDownFile.'>'.$define["var_taive"].'</a>
						</div>
					</td>
					</td>
				</tr>';
				$count ++;
			}
		}
		$contentDetail .= '</table>';
	}
	
	require_once("$_HTML_DIR/center_content_schedule.php");
}
?>