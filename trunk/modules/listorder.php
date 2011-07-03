<?
if(!$_PAGE_VALID)
{
	exit();
}

$nCols = 4;
$count = 1;
$colWidth = round(100/$nCols);
$maxRows = 16;
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
	/*
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
	*/
	if(!$itemId || !validGetVar($itemId))
	{
		$maxNumRows = 16;
		$listShowItemId = NULL;
		
		$froms = "vot_listorder";
		$conds  = "listorder_view = 1 AND language_id='".$lang."'";
		/*if($searchKeyword != NULL)
		{
			$conds .= " AND (listorder_name LIKE '%".$searchKeyword."%' OR listorder_shortdes LIKE '%".$searchKeyword."%' OR listorder_detail LIKE '%".$searchKeyword."%')";
		}
		if($ntime != NULL)
		{
			$ntime = inDateStr($ntime);
			$conds .= " AND listorder_date >= '".$ntime."'";
		}
		if($etime != NULL)
		{
			$etime = inDateStr($etime);
			$conds .= " AND listorder_date <= '".$etime."'";
		}*/
		$others = "ORDER BY listorder_order DESC, listorder_date DESC LIMIT $maxNumRows";
		$sql->set_query($froms, "*", $conds, $others);
		$tRows = $sql->nRows;
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
		if($tRows > 0 && $tRows!=1)
		{	
			$contentDetail .= '<table width="100%" cellpadding="0" cellspacing="0" border="0">';
			
			$imgMaxW = 136;
			$imgMaxH = 180;
			$low = $curRow; 
		$curRow = 1;
		while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
		{
			$curRow++;			                           
			if($curRow > $low)
			{
				$infoId = $sql->farray["listorder_id"];
				$infoName = strip_tags(displayData_DB($sql->farray["listorder_name"]));
				$infoDate = outDateStr($sql->farray["listorder_date"]);
				$infoAdd = strip_tags(displayData_DB($sql->farray["listorder_add"]));
				$infoTel = strip_tags(displayData_DB($sql->farray["listorder_tel"]));
				$infoEmail = strip_tags(displayData_DB($sql->farray["listorder_email"]));
				$productId = $sql->farray["product_id"];
				$ssql = new mysql;
				$ssql->set_query("vot_product", "product_name","product_id='".$productId."'");
					if($ssql->set_farray())
					{
						$productName = $ssql->farray["product_name"];
						$productType = $ssql->farray["modules_id"];
					}
			  $infoDes = str_replace("$searchKeyword", "<span style=\"color:#FF0000;background-color:#CCCCCC\">".$searchKeyword."</span>", $infoDes);
			  $infoName = str_replace("$searchKeyword", "<span style=\"color:#FF0000;background-color:#CCCCCC\">".$searchKeyword."</span>", $infoName);
			$contentDetail .= '
					<tr>
						<td valign="top" style="padding:5px 0px 5px 0px; border-bottom:1px dotted #929292">
							<div class="itemname">'.$define["var_anhchi"].': '.$infoName.'</div>
							<div class="itemname">'.$define["var_dienthoai"].': '.$infoTel.'</div>
							<div class="itemname">'.$define["var_diachi"].': '.$infoAdd.'</div>
							<div class="itemname">'.$define["var_email"].': '.$infoEmail.'</div>
							<div class="itemname">'.$define["var_sdt"].': <span style="color:#ffc000">'.$productName.'</span></div>
						</td>
					</tr>';
					if($count % $nCols == 0)
					{
						$contentDetail .= '</tr><tr>';
					}
					$count ++;
				}
			  }
				
				$contentDetail .= '</table>';
				require_once("$_HTML_DIR/center_content_list.php");
			}elseif($tRows > 0 && $tRows==1)
			{
				if($sql->set_farray())
				{
					$contentTitle = $sql->farray["listorder"."_name"];
					$itemId= $sql->farray["listorder"."_id"];
					$contentDate = outDateStr($sql->farray["listorder"."_date"]);
					$contentImage = $sql->farray["listorder"."_image"];
					if(is_file("$_ROOT_PATH/$contentImage"))
					{
						$contentDetail .= '<img src="'."$_URL_BASE/$contentImage".'" align="left" style="margin:4px 7px 0px 0px;border:2px solid #fec083">';
					}
					$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["listorder"."_shortdes"].'</p>';
					$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["listorder"."_detail"].'</p>';
					$visited = $sql->farray["listorder"."_visited"];
					$insert = "listorder_visited = listorder_visited+1";
					$where = "listorder_id='".$itemId."'";
					$sql->update("vot_listorder", $insert, $where);
					require_once("$_HTML_DIR/center_content_detail.php");
				}
			}else
			{
				$contentDetail .= noResultPage();
				require_once("$_HTML_DIR/center_content_detail.php");
			}	
	}
	else
	{
		$contentTitle = NULL;
		$contentDetail = NULL;
		
		$listShowItemId = $itemId;
		
		$froms = "vot_listorder";
		$conds = "listorder_id='".$itemId."'";
		$sql->set_query($froms, "*", $conds);
		if($sql->set_farray())
		{
			$contentTitle = $sql->farray["listorder"."_name"];
			$contentDate = outDateStr($sql->farray["listorder"."_date"]);
			$contentImage = $sql->farray["listorder"."_image"];
			if(is_file("$_ROOT_PATH/$contentImage"))
			{
				$contentDetail .= '<img src="'."$_URL_BASE/$contentImage".'" align="left" style="margin:4px 7px 0px 0px;border:2px solid #fec083">';
			}
			$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["listorder"."_shortdes"].'</p>';
			$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["listorder"."_detail"].'</p>';
			$visited = $sql->farray["listorder"."_visited"];
			$insert = "listorder_visited = listorder_visited + 1";
			$where = "listorder_id='".$itemId."'";
			$sql->update("vot_listorder", $insert, $where);
		}
		else
		{
			redirect("$_URL_BASE/");
		}
		require_once("$_HTML_DIR/center_content_detail.php");
	}
}
?>
