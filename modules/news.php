<?
if(!$_PAGE_VALID)
{
	exit();
}

$nCols = 3;
$count = 1;
$colWidth = round(100/$nCols);
$maxRows = $config["site_NewsmaxnumList"];
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
		$contentTitle = NULL;
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
				$contentTitle = $sql->farray["modules_name"];
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
		$maxNumRows = $config["site_NewsmaxnumList"];
		$listShowItemId = NULL;
		
		$froms = "vot_news";
		$conds  = "modules_id IN ('".$listCateId."') AND news_view = 1";
		if($searchKeyword != NULL)
		{
			$conds .= " AND (news_name LIKE '%".$searchKeyword."%' OR news_shortdes LIKE '%".$searchKeyword."%' OR news_detail LIKE '%".$searchKeyword."%')";
		}
		if($ntime != NULL)
		{
			$ntime = inDateStr($ntime);
			$conds .= " AND news_date >= '".$ntime."'";
		}
		if($etime != NULL)
		{
			$etime = inDateStr($etime);
			$conds .= " AND news_date <= '".$etime."'";
		}
		$others = "ORDER BY news_order DESC, news_date DESC LIMIT $maxNumRows";
		$sql->set_query($froms, "*", $conds, $others);
		$tRows = $sql->nRows;
		if($tRows > 0 && $tRows!=1)
		{	
			$contentDetail .= '<table width="100%" cellpadding="0" cellspacing="0" border="1" background="white">';
			
			$imgMaxW = 136;
			$imgMaxH = 180;
			while ($sql->set_farray())
			{
				$infoId = $sql->farray["news_id"];
				$infoName = strip_tags(displayData_DB($sql->farray["news_name"]));
				$infoDate = outDateStr($sql->farray["news_date"]);
				$infoDes = strip_tags(displayData_DB($sql->farray["news_shortdes"]));
				$infoImgNote = displayData_DB($sql->farray["news_imagenote"]);
				$infoImg = NULL;
				$image = $sql->farray["news_image"];
				$itemName = str_replace(" ", "_", $infoName);
				$linkto = "$_URL_BASE/index.php/$cateId/$infoId/$itemName";		
				if(is_file("$_ROOT_PATH/$image"))
				 {
					$imgSize = imageSize("$_ROOT_PATH/$image", ($imgMaxW-6), $imgMaxH);
					$infoImg  = "<table cellpadding=\"0\" cellspacing=\"0\" align=\"left\" style=\"margin:4px 5px 2px 0px\" width=\"$imgMaxW\"><tr>";
					$infoImg .= "<td class=\"itemContentImgBox\" align=\"center\"><a href=\"$linkto\"><img src=\"$_URL_BASE/$image\" width=\"$imgSize[0]\" height=\"$imgSize[1]\" border=\"0\" style=\"\"></a></td></tr>";
					$infoImg .= "<tr><td class=\"itemImageNote\">$infoImgNote</td></tr></table>";
				  }
			  $infoDes = str_replace("$searchKeyword", "<span style=\"color:#FF0000;background-color:#CCCCCC\">".$searchKeyword."</span>", $infoDes);
			  $infoName = str_replace("$searchKeyword", "<span style=\"color:#FF0000;background-color:#CCCCCC\">".$searchKeyword."</span>", $infoName);
			$contentDetail .= '
					<tr>
						<td valign="top" style="padding:5px 0px 5px 0px">
							<div class="itemContentTitle"><a href="'.$linkto.'">'.$infoName.'</a></div>
							<div style="font-size:11px; color:#555555">'.$infoDate.'</div>
							<div class="itemContentDes" style="text-align:justify;color:#FFFFFF">'.$infoImg.$infoDes.'</div>
							<!--<div class="linkDetail" align="right"><img src="'.$_IMG_DIR.'/nut.gif" width="7" height="7" border="0">&nbsp;<a href="'.$linkto.'">'.$define["var_chitiet"].'</a></div>-->
						</td>
					</tr>';
			$listShowItemId .= "$infoId,";
				}
				$contentDetail .= '</table>';
				require_once("$_HTML_DIR/center_content_list.php");
			}elseif($tRows > 0 && $tRows==1)
			{
				if($sql->set_farray())
				{
					$contentTitle = $sql->farray["news"."_name"];
					$itemId= $sql->farray["news"."_id"];
					$contentDate = outDateStr($sql->farray["news"."_date"]);
					$contentImage = $sql->farray["news"."_image"];
					if(is_file("$_ROOT_PATH/$contentImage"))
					{
						$contentDetail .= '<img src="'."$_URL_BASE/$contentImage".'" align="left" style="margin:4px 7px 0px 0px;border:2px solid #fec083">';
					}
					$contentDetail .= '<div id="itemContentDes" style="text-align:justify">'.$sql->farray["news"."_shortdes"].'</div>';
					$contentDetail .= '<div id="itemContentDes" style="text-align:justify">'.$sql->farray["news"."_detail"].'</div>';
					$visited = $sql->farray["news"."_visited"];
					$insert = "news_visited = news_visited+1";
					$where = "news_id='".$itemId."'";
					$sql->update("vot_news", $insert, $where);
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
		
		$froms = "vot_news";
		$conds = "news_id='".$itemId."'";
		$sql->set_query($froms, "*", $conds);
		if($sql->set_farray())
		{
			$contentTitle = $sql->farray["news"."_name"];
			$contentDate = outDateStr($sql->farray["news"."_date"]);
			$contentImage = $sql->farray["news"."_image"];
			if(is_file("$_ROOT_PATH/$contentImage"))
			{
				$contentDetail .= '<img src="'."$_URL_BASE/$contentImage".'" align="left" style="margin:4px 7px 0px 0px;border:2px solid #fec083">';
			}
			$contentDetail .= '<div id="itemContentDes" style="text-align:justify">'.$sql->farray["news"."_shortdes"].'</div>';
			$contentDetail .= '<div id="itemContentDes" style="text-align:justify">'.$sql->farray["news"."_detail"].'</div>';
			$visited = $sql->farray["news"."_visited"];
			$insert = "news_visited = news_visited + 1";
			$where = "news_id='".$itemId."'";
			$sql->update("vot_news", $insert, $where);
		}
		else
		{
			redirect("$_URL_BASE/");
		}
		require_once("$_HTML_DIR/center_content_detail.php");
	}
}
?>
