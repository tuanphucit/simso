<?
if(!$_PAGE_VALID)
{
	exit();
}

$nCols = 3;
$count = 1;
$colWidth = round(100/$nCols);
$maxRows = 15;
$checked = array(0 => NULL, 1 => "checked");

$listCateId = $cateId;
$listParCate = $cateId;

$catePermission = $opt->optionvalue("vot_modules", "modules_per", "modules_id='".$cateId."'");

if($catePermission && !$isLogin)
{
	require_once("$_HTML_DIR/page_limited.php");
}
else
{
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
	
	if(!$itemId || !validGetVar($itemId))
	{
		$maxNumRows = 10;
		$listShowItemId = NULL;
		
		$froms = "vot_faqs";
		$conds  = "modules_id IN ('".$listCateId."') AND faqs_view = 1";
		if($searchKeyword != NULL)
		{
			$conds .= " AND (faqs_name LIKE '%".$searchKeyword."%' OR faqs_shortdes LIKE '%".$searchKeyword."%' OR faqs_detail LIKE '%".$searchKeyword."%')";
		}
	
		$others = "ORDER BY faqs_order DESC, faqs_date DESC LIMIT $maxNumRows";
		$sql->set_query($froms, "*", $conds, $others);
		 $dem = $sql->nRows;
		if($dem > 0)
		{	
			$contentDetail .= '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
			
			$imgMaxW = 136;
			$imgMaxH = 180;
			while ($sql->set_farray())
			{	
				
				$infoId = $sql->farray["faqs_id"];
				$infoName = displayData_DB($sql->farray["faqs_name"]);
				$infoDate = outDateStr($sql->farray["faqs_date"]);
				$infoDes = displayData_DB($sql->farray["faqs_shortdes"]);
				$faqsDes = displayData_DB($sql->farray["faqs_detail"]);
				$infoImgNote = displayData_DB($sql->farray["faqs_imagenote"]);
				$visited = displayData_DB($sql->farray["faqs_visited"]);
				$infoImg = NULL;
				$image = $sql->farray["faqs_image"];
				$itemName = str_replace(" ", "_", $infoName);
				$linkto = "$_URL_BASE/index.php/$cateId/$infoId/$itemName";		
				if(is_file("$_ROOT_PATH/$image"))
				{
					$imgSize = imageSize("$_ROOT_PATH/$image", ($imgMaxW-6), $imgMaxH);
					$infoImg  = "<table cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"margin:4px 5px 2px 0px\" width=\"$imgMaxW\"><tr>";
					$infoImg .= "<td class=\"itemContentImgBox\" align=\"center\"><a href=\"$linkto\"><img src=\"$_URL_BASE/$image\" width=\"$imgSize[0]\" height=\"$imgSize[1]\" border=\"0\" style=\"\"></a></td></tr>";
					$infoImg .= "<tr><td class=\"itemImageNote\">$infoImgNote</td></tr></table>";
				}
				$contentDetail .= '
				<tr>
					<td valign="top" style="padding:5px 0px 5px 0px">
						<div style="padding:5px 0px 5px 0px"><a style="color:#CD311A; font-family:tahoma; font-size:12px; font-weight:bold"href="'.$linkto.'">'.$define["var_cauhoi"].''.$dem.'<a><span class="visited">('.$define["var_luotxem"].' '.$visited.')</span></div>
						<div style="CURSOR: pointer; color:#022b8a; font-family:tahoma" onClick="expandcontent('.$infoId.')">'.$infoName.'</div>
						<div class="itemContentDes" style="text-align:justify">'.$infoImg.$infoDes.'</div>
						<div></div>
	<DIV class=switchcontent id='.$infoId.'>
			<div style="color:#CD311A; font-family:tahoma; font-size:12px; font-weight:bold">'.$define["var_traloi"].':</div>
			<div style="text-align:justify;font-family:Arial; font-size:12px; color:#505050; padding:5px 0px 2px 0px; text-align:juistify">'.$faqsDes.'</div>
			<div style="padding-top:10px"></div>
	</DIV>

						<!--<div class="linkDetail" align="right"><img src="'.$_IMG_DIR.'/nut.gif" width="7" height="7" border="0">&nbsp;<a href="'.$linkto.'">'.$define["var_chitiet"].'</a></div>-->
					</td>
				</tr>';
				$dem --;
				
				$listShowItemId .= "$infoId,";
			}
			$contentDetail .= '</table>';
		}
		require_once("$_HTML_DIR/center_content_list.php");
	}
	else
	{
		$contentTitle = NULL;
		$contentDetail = NULL;
		
		$listShowItemId = $itemId;
		
		$froms = "vot_faqs";
		$conds = "faqs_id='".$itemId."'";
		$sql->set_query($froms, "*", $conds);
		if($sql->set_farray())
		{
			$contentTitle = $sql->farray["faqs"."_name"];
			$contentDate = outDateStr($sql->farray["faqs"."_date"]);
			$contentImage = $sql->farray["faqs"."_image"];
			
			if(is_file("$_ROOT_PATH/$contentImage"))
			{
				$contentDetail .= '<img src="'."$_URL_BASE/$contentImage".'" align="left" style="margin:4px 7px 0px 0px">';
			}
			$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["faqs"."_shortdes"].'</p>';
			$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["faqs"."_detail"].'</p>';
			$visited = $sql->farray["faqs"."_visited"];
			$insert = "faqs_visited = faqs_visited+1";
			$where = "faqs_id='".$itemId."'";
			$sql->update("vot_faqs", $insert, $where);
		}
		else
		{
			redirect("$_URL_BASE/");
		}
		require_once("$_HTML_DIR/center_content_detail.php");
	}
}
?>