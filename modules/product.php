<?
if(!$cateId || !validGetVar($cateId))
{
	redirect("$_URL_BASE/");
}

$nCols = 4;
$count = 1;
$colWidth = round(100/$nCols);
$maxRows = 80;

$checked = array(0 => NULL, 1 => "checked");

$maxImgW = 127;
$maxImgH = 165;

$listCateId = $cateId;
$listParCate = $cateId;

if(!$itemId || !validGetVar($itemId))
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
			$curLevel = $sql->farray["modules_level"];
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
$contentTitle = "".$define["var_danhsachsodep"]." ".$subPageTitle."";
	$pageTitle = NULL;
	/*$conds = "modules_id='".$cateId."'";
	$sql->set_query("vot_modules", "*", $conds);
	if($sql->set_farray())
	{
		$pageTitle = $sql->farray["modules_name"];
		$proTypeImgTitle = $sql->farray["modules_icon"];
		if(is_file("$_ROOT_PATH/$proTypeImgTitle"))
		{
			$pageTitle = '<img src="'."$_URL_BASE/$proTypeImgTitle".'" border="0" align="absmiddle">';
		}
	}*/
	switch ($listCateId)
{
	case '28':
	$kieusim="Đầu Số Vinaphone 091";
	$conds="(left(right(sosim,10),3)='091')";
	break;
	case '29':
	$kieusim="Đầu Số Mobifone 090";
	$conds="(left(right(sosim,10),3)='090')";
	break;
	case '30':
	$kieusim="Đầu Số Viettel 098";
	$conds="(left(right(sosim,10),3)='098')";
	break;
	/*case 'dau-090':
	$kieusim="Đầu Số Mobifone 090";
	$conds="WHERE (left(sosim,3)='090')";
	break;
	case 'dau-0933':
	$kieusim="Đầu Số Mobifone 0933";
	$conds="WHERE (left(sosim,4)='0933')";
	break;
	case 'dau-097':
	$kieusim="Đầu Số Viettel 097";
	$conds="WHERE (left(sosim,3)='097')";
	break;
	case 'dau-098':
	$kieusim="Đầu Số Viettel 098";
	$conds="WHERE (left(sosim,3)='098')";
	break;*/
	
	//tim sim theo gia
	case '45':
	$kieusim="Sim dưới 500.000";
	$conds="(giaxuat <= 500000)";
	break;
	
	case '44':
	$kieusim="Từ 500k >> 1 Triệu";
	$conds="(giaxuat >= 500000) AND (giaxuat <= 1000000)";
	break;
	
	case '46':
	$kieusim="Từ 1 Triệu >> 2 Triệu";
	$conds="(giaxuat >= 1000000) AND (giaxuat <= 2000000)";
	break;
	
	case '47':
	$kieusim="Từ 2 Triệu >> 5 Triệu";
	$conds="(giaxuat >= 2000000) AND (giaxuat <= 5000000)";
	break;
	
	case '48':
	$kieusim="Từ 5 Triệu >> 10 Triệu";
	$conds="(giaxuat >= 5000000) AND (giaxuat <= 10000000)";
	break;
	
	case '49':
	$kieusim="Từ 10 Triệu >> 20 Triệu";
	$conds="(giaxuat >= 10000000) AND (giaxuat <= 20000000)";
	break;
	
	case '50':
	$kieusim="Từ 20 Triệu >> 50 Triệu";
	$conds="(giaxuat >= 20000000) AND (giaxuat <= 50000000)";
	break;
	
	case '51':
	$kieusim="Từ 50 Triệu trở lên";
	$conds="(giaxuat >= 50000000)";
	break;
	
	//danh muc sim
	case '40':
	$kieusim="Số Đẹp Giá Rẻ";
	$conds="(giaxuat <= 300000)";
	break;
	case '13':
	$conds="(right(sosim, 2)=left(right(sosim,4),2) AND left(right(sosim,2),1)=left(right(sosim,3),1))";
	$kieusim="Số Tứ Quý - Ngũ Quý";
	$order="ORDER by right(sosim,4) DESC, left(right(sosim,9),4) DESC";
	break;
	/*case '27':
	$conds="(right(sosim,1)=left(right(sosim,2),1) AND (right(sosim, 2)=left(right(sosim,4),2) || right(sosim, 2)=left(right(sosim,6),2))";
	$kieusim="Số Tứ Quý - Ngũ Quý";
	$order="ORDER by right(sosim,4) DESC, left(right(sosim,9),4) DESC";
	break;*/
	case '14':
	$conds="(right(sosim,1)=left(right(sosim,2),1) AND left(right(sosim,2),1)=left(right(sosim,3),1) AND left(right(sosim,3),1)!=left(right(sosim,4),1))";
	$kieusim="Số Tam Hoa - Tam Quý";
	$order="ORDER by right(sosim,3) DESC, left(right(sosim,9),4) ASC";
	break;
	case '15':
	$conds="(right(sosim,2) IN(68,86) || right(sosim,3) IN(688,866))";
	$order="ORDER by giaxuat DESC, left(right(sosim,9),4) ASC";
	$kieusim="Số Lộc Phát - Phát Lộc";
	break;
	case '19':
	$conds="((right(sosim,2)=left(right(sosim,4),2) AND left(right(sosim,4),2) =left(right(sosim,6),2) AND right(sosim,1)!=left(right(sosim,2),1)) OR (right(sosim,3)=left(right(sosim,6),3) AND right(sosim,1)!=left(right(sosim,2),1)))";
	$kieusim="Số Taxi";
	$order="ORDER by giaxuat DESC, left(right(sosim,9),4) ASC";
	break;
	case '20':
	$conds="(right(sosim,1)=(left(right(sosim,2),1)+1) AND left(right(sosim,3),1) = (left(right(sosim,2),1)-1))";
	$kieusim="Số Tiến";
	$order="ORDER by giaxuat DESC, left(right(sosim,9),4) ASC";
	break;
	case '26':
	$conds="( (right(sosim,1)=left(right(sosim,2),1) && left(right(sosim,3),1)=left(right(sosim,4),1)) && (right(sosim,2)!=left(right(sosim,3),2)))";
	$kieusim="Số Kép 2 - Kép 3";
	$order="ORDER by giaxuat DESC, left(right(sosim,9),4) ASC";
	break;
	case '16':
	$conds="(right(sosim,4) > '1959' AND right(sosim,4) < '2010')";
	$kieusim="Số Năm Sinh - Kỷ Niệm";
	$order="ORDER by right(sosim,4) DESC, left(right(sosim,9),4) ASC";
	break;
	case '21':
	$conds="(right(sosim,1) = left(right(sosim,4),1) AND left(right(sosim,3),1) = left(right(sosim,2),1)) AND right(sosim,1) != left(right(sosim,2),1)";
	$kieusim="Số Gánh - Số Đảo";
	$order="ORDER by giaxuat DESC, left(right(sosim,9),4) ASC";
	break;
	case '17':
	$conds="(right(sosim,4)='7997' || right(sosim,2) IN (39,79,38,78) || right(sosim,3) IN (799,399))";
	$kieusim="Số Thần Tài - Ông Địa";
	$order="ORDER by giaxuat DESC, right(sosim,2) DESC";
	break;
	/*case 'lap':
	$conds="WHERE (right(sosim,2)=left(right(sosim,4),2) AND right(sosim,1)!=left(right(sosim,2),1) AND right(sosim,2) !=left(right(sosim,6),2))";
	$kieusim="Số Lặp 2 - Lặp 3";
	$order="ORDER by giaxuat DESC, left(right(sosim,9),4) ASC";
	break;*/
	default:
		$conds = "category IN ('".$listCateId."') AND view=1";
		break;
}

	
	$others = "ORDER BY giaxuat DESC";
	$sql->set_query("product", "DISTINCT sosim", $conds, $others);
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
		$contentDetail = '<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td height="3" colspan=8></td>
							</tr>
							<tr height="26">
								<td width="25" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold; text-align:center;background-color:#eeeeee">STT</td>
								<td width="100" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold; text-align:center;background-color:#eeeeee">'.$define["var_sosim"].'</td>
								<td width="100" style="font-family:tahoma; font-size:11px;color:#fd720b; font-weight:bold;text-align:center;background-color:#eeeeee">'.$define["var_gia"].'</td>
								<td width="100" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold;text-align:center;background-color:#eeeeee">'.$define["var_taikhoan"].'</td>
								<td width="90" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold;text-align:center;background-color:#eeeeee">'.$define["var_datmua"].'</td>
							</tr>';
		
		$low = $curRow; 
		$curRow = 1;
		while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
		{
			$curRow++;			                           
			if($curRow > $low)
			{
				$productName = $sql->farray["sosim"];
				$productId = $opt->optionvalue("product", "id", "sosim='".$productName."'");
				$productName = str_replace("`","",$productName);
				$productName1 = str_replace(".","",$productName);
				$productName2 = str_replace(" ","",$productName1);
				$price = geld($opt->optionvalue("product", "giaxuat", "id='".$productId ."'"));
				//$taihkoan = geld($opt->optionvalue("product", "taikhoan", "id='".$productId ."'"));
			if(strlen($productName2) > 3) 
					{
					$logo = substr($productName2, 0, 3);
					}
					
				if($logo=='090' || $logo == '093')
					{
					$taihkoan = "<img src=\"".$_IMG_DIR."/mobi.gif\" border=0>";
					}
				else if($logo=='098' || $logo == '097')
					{
					$taihkoan = "<img src=\"".$_IMG_DIR."/viettel.gif\" border=0>";
					}	
				else if($logo=='091' || $logo == '094')
					{
					$taihkoan = "<img src=\"".$_IMG_DIR."/vina.gif\" border=0>";
					}	
				else if($logo=='095')
					{
					$taihkoan = "<img src=\"".$_IMG_DIR."/Sfone.gif\" border=0>";
					}	
				else if($logo=='092')
					{
					$taihkoan = "<img src=\"".$_IMG_DIR."/vn-mobile.gif\" border=0>";
					}
				else if($logo=='012' || $logo=='016')
					{
						if(strlen($productName2) > 4) 
						{
						$logo = substr($productName2, 0, 4);
						}
							if($logo=='0123' || $logo=='0124' || $logo=='0127' || $logo == '0125' || $logo == '0129' )
								{
								$taihkoan = "<img src=\"".$_IMG_DIR."/vina.gif\" border=0>";
								}
							else if($logo=='0163' || $logo=='0164' || $logo=='0165' || $logo=='0166' || $logo=='0167' || $logo == '0168' || $logo == '0169')
								{
								$taihkoan = "<img src=\"".$_IMG_DIR."/viettel.gif\" border=0>";
								}	
								else if($logo=='0119')
								{
								$taihkoan = "<img src=\"".$_IMG_DIR."/beeline.gif\" border=0>";
								}
							else 
								{
								$taihkoan = "<img src=\"".$_IMG_DIR."/mobi.gif\" border=0>";
								}	
					}		
				else
					{
					$taihkoan = "<img src=\"".$_IMG_DIR."/vnpt.gif\" border=0>";
					}			
				$Linkto = "$_URL_BASE/index.php/order/$productId/sim-so-dep-$productName.html";
					$contentDetail .= "
									<tr height=\"24\">
										<td width=\"25\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\">".$count."</td>
										<td width=\"100\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:13px;color:#000000; text-align:center;font-weight:bold\"><a href=\"".$Linkto."\" style=\"color:red \" >".$productName."</a></td>
										<td width=\"100\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:arial; font-size:11px;color:#000000; text-align:center;\">".$price." (vn&#273;)</td>
										<td width=\"100\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:11px;color:#000000;text-align:center;\">".$taihkoan."</td>
										<td width=\"90\" style=\"border-right:0px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\" class=\"datmua\"><a href=\"".$Linkto."\">".$define["var_datmua"]."</a></td>
									</tr>";		
					if($count % $nCols == 0)
					{
						$contentDetail .= '</tr><tr>';
					}
					$count ++;
				
			}
		}
		$contentDetail .= '</tr></table>';
	}
	else
	{
	$contentDetail .= noResultPage();
	}
	require_once("$_HTML_DIR/center_product_list.php");
}
?>
