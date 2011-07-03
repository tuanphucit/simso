<?
function geld($nm) 
{
    for ($done=strlen($nm); $done > 3;$done = $done - 3) 
	{ 
        $returnNum = ",".substr($nm,$done-3,3).$returnNum;
    }
 return substr($nm,0,$done).$returnNum;
}

function searchSelModules($curCateId, $cateId = 0)
{
	global $lang;
	$result = NULL;
	$sql = new mysql;
	$conds = "modules_parent='".$cateId."'";
	if($cateId == 0)
	{
		$conds .= " AND language_id='".$lang."' AND modules_view=1";
	}
	$others = "ORDER BY modules_order ASC";
	$sql->set_query("vot_modules", "*", $conds, $others);
	while($sql->set_farray())
	{
		$modId = $sql->farray["modules_id"];
		$modName = $sql->farray["modules_name"];
		$modLink = $sql->farray["modules_linkto"];
		$modType = $sql->farray["modules_type"];
		if($modType != NULL)
		{
			$result .= '<option value="'."$modId/$modLink".'" ';
			if($curCateId == $modId) $result .= 'selected';
			$result .= '>'.$modName.'</option>';
		}
		else
		{
			$result .= '<optgroup label="'.$modName.'">';
			$result .= searchSelModules($curCateId, $modId);
			$result .= '</optgroup>';
		}
	}
	//return $result;
}
function searchadvanced($curCateId, $cateId = 0)
{
	global $lang;
	$result = NULL;
	$sql = new mysql;
	$opt = new option();
$maxLevelColect = $opt->optionvalue("vot_modules", "MAX(modules_level)", "language_id='".$lang."' AND modules_view=1");
		$ColectCateId = NULL;
		$conds = "modules_id='".$cateId."'";
		$sql->set_query("vot_modules", "*", $conds);
		if($sql->set_farray())
		{
			$curLevel = $sql->farray["moudles_level"];
		}
		$ssql = new mysql();
		for($n = 0 ; $n <= $maxLevelColect; $n++)
		{
			if($ColectParCate == 0)
			{
			$conds = "modules_parent IN ('".$ColectParCate."') AND modules_level='".$n."' AND modules_view=1 AND modules_pos = '0,1,1,0' || modules_pos = '0,1,1,1' AND language_id = '".$lang."'";
			}else
			{
			$conds = "modules_parent IN ('".$ColectParCate."') AND modules_level='".$n."' AND modules_view=1 AND language_id = '".$lang."'";
			}
			$others = "ORDER BY modules_order ASC";
			$ssql->set_query("vot_modules", "*", $conds, $others);
			//$ColectParCate = NULL;
			while($ssql->set_farray())
			{
				$subCateId = $ssql->farray["modules_id"];
				$subCateName = $ssql->farray["modules_name"];
				$subCateLink = $ssql->farray["modules_linkto"];
				$mnItemPos = split(",", $ssql->farray["modules_pos"]);
				if(checkSubCate($subCateId))
				{
					if($ColectParCate != NULL) $ColectParCate .= "','".$subCateId;
					else $ColectParCate .= $subCateId;
				}
				else 
				{
					if($ColectCateId != NULL) $ColectCateId .= "','".$subCateId;
					else $ColectCateId .= $subCateId;
				}
			}
		}
		$sssql = new mysql();
		$conds = "modules_id IN ('".$ColectCateId."') AND modules_view=1 AND language_id = '".$lang."'";
		$others = "ORDER BY modules_order ASC";
		$sssql->set_query("vot_modules", "*", $conds, $others);
		//$ColectParCate = NULL;
		$counttt = 0;
		$titemRowsss = $sssql->nRows;
		if($titemRowsss >0 )
		{
		//$result .='<option value=" ">'.$define["var_chonmangdt"].'</option>';
		while($sssql->set_farray())
		{
			 		$nnfoId = $sssql->farray["modules_id"];
					$subCateName = $sssql->farray["modules_icon"];
					$nnfoName = displayData_DB($sssql->farray["modules_name"]);
					$nCon = $sssql->farray["modules_icon"];
					$mnItemshortdes = $sssql->farray["modules_shortdes"];
				$result .='<option value="'.$nnfoId.'">'.$nnfoName.'</option>';	
			}
			//$result .='</select>';
		}	
return $result;
}
function checkSubCate($cateId)
{
	global $lang;

	$sql = new mysql;
	$conds = "language_id='".$lang."' AND modules_parent='".$cateId."' AND modules_view=1";
	$sql->set_query("vot_modules", "modules_id", $conds);
	
	return $sql->nRows;	
}
function getRootCate($cateId)
{
	global $_IMG_DIR;
	$result = NULL;
	$sql = new mysql;

	$cateParent = $cateId;
	
	while($cateParent)
	{
		$conds = "modules_id='".$cateParent."'";
		$sql->set_query("vot_modules", "*", $conds);
		if($sql->set_farray())
		{
			$cateName = strip_tags($sql->farray["modules_name"]);
			$cateParent = $sql->farray["modules_parent"];
			$result = $cateName.$result;
			if($cateParent)
			{
				$result = "&nbsp;&nbsp;<img src=\"$_IMG_DIR/right_arrow_yellow.jpg\">&nbsp;&nbsp;".$result;
			}
		}
	}
	return $result;
}
//////////////////////

function getRootParent($cateId)
{
	global $_IMG_DIR;
	$result = NULL;
	$sql = new mysql;

	$cateParent = $cateId;
	
	while($cateParent)
	{
		$conds = "modules_id='".$cateParent."'";
		$sql->set_query("vot_modules", "*", $conds);
		if($sql->set_farray())
		{
			$cateName = strip_tags($sql->farray["modules_id"]);
			$cateParent = $sql->farray["modules_parent"];
			$result = $cateName.$result;
			if($cateParent)
			{
				$result = "&nbsp;&nbsp;<img src=\"$_IMG_DIR/right_arrow_yellow.jpg\">&nbsp;&nbsp;".$result;
			}
		}
	}
	return $result;
}

//////////////////////
function realtyPaging($tRows,$curPg,$re,$label=NULL)
{
	global $_URL_BASE, $define, $cateId, $listShowItemId, $oItemId, $module, $curModId;
	$label = strtolower($label);
	$maxShow = 10;
	$paging  = NULL;
	$mxR = $re;
	if($tRows % $mxR == 0) $tPages = (int)($tRows / $mxR);
	else $tPages = (int)($tRows / $mxR) + 1;
	if($tPages > 1)
	{
		$paging .= '<table border="0" cellspacing="0" cellpadding="0" align="right">';
		$paging .= '<tr><td align="right" style="color:#666666; padding-right:5px; font-size:11px">'.$define["var_trang"].'&nbsp;:</td>';
		$curRow = ($curPg - 1) * $mxR + 1;

		$start = $curPg - floor($maxShow/2);
		if($start < 1) $start = 1;
		$end = $start + $maxShow;
		if($end > $tPages)
		{
			$end = $tPages + 1;
			$start = $end - $maxShow;
			if($start < 1) $start = 1;
		}
		for($i = $start; $i < $end; $i++)
		{
			$style = 'normalPaging';
			$onClick = 'onClick="showPageContent(\''."$_URL_BASE/includes/otherrealty.php?module=$module&curModId=$curModId&cateId=$cateId&listShowItemId=$listShowItemId&curPg=$i".'\',\'otherItems\')"';
			if($i == $curPg)
			{
				$style = 'curPaging';
				$onClick = NULL;
			}
			$paging .= '<td width="5">&nbsp;</td><td class="'.$style.'" '.$onClick.'>'.$i.'</td>';
		}

		$paging .= '</tr></table>';
	}
	return $paging;
}

function newsPaging($tRows,$curPg,$re,$label=NULL)
{
	global $_URL_BASE, $define, $cateId, $listShowItemId, $oItemId, $module, $curModId;
	$label = strtolower($label);
	$maxShow = 10;
	$paging  = NULL;
	$mxR = $re;
	if($tRows % $mxR == 0) $tPages = (int)($tRows / $mxR);
	else $tPages = (int)($tRows / $mxR) + 1;
	if($tPages > 1)
	{
		$paging .= '<table border="0" cellspacing="0" cellpadding="0" align="right">';
		$paging .= '<tr><td align="right" style="color:#666666; padding-right:5px; font-size:11px">'.$define["var_trang"].'&nbsp;:</td>';
		$curRow = ($curPg - 1) * $mxR + 1;

		$start = $curPg - floor($maxShow/2);
		if($start < 1) $start = 1;
		$end = $start + $maxShow;
		if($end > $tPages)
		{
			$end = $tPages + 1;
			$start = $end - $maxShow;
			if($start < 1) $start = 1;
		}
		for($i = $start; $i < $end; $i++)
		{
			$style = 'normalPaging';
			$onClick = 'onClick="showPageContent(\''."$_URL_BASE/includes/otheritems.php?module=$module&curModId=$curModId&cateId=$cateId&listShowItemId=$listShowItemId&curPg=$i".'\',\'otherItems\')"';
			if($i == $curPg)
			{
				$style = 'curPaging';
				$onClick = NULL;
			}
			$paging .= '<td width="5">&nbsp;</td><td class="'.$style.'" '.$onClick.'>'.$i.'</td>';
		}

		$paging .= '</tr></table>';
	}
	return $paging;
}
function paging($tRows,$curPg,$re,$label=NULL)
{
	global $_URL_BASE, $define, $searchAlbum, $searchKeyword, $searchExact, $cateId, $cateName;
	$label = strtolower($label);
	$maxShow = 10;
	$paging  = NULL;
	$mxR = $re;
	if($tRows % $mxR == 0) $tPages = (int)($tRows / $mxR);
	else $tPages = (int)($tRows / $mxR) + 1;
	if($tPages > 1)
	{
		$paging .= '<table border="0" cellspacing="0" cellpadding="0" align="right">';
		$paging .= '<tr><td align="right" style="color:#666666; padding-right:5px; font-size:11px">'.$define["var_trang"].'&nbsp;:</td>';
		$curRow = ($curPg - 1) * $mxR + 1;

		$start = $curPg - floor($maxShow/2);
		if($start < 1) $start = 1;
		$end = $start + $maxShow;
		if($end > $tPages)
		{
			$end = $tPages + 1;
			$start = $end - $maxShow;
			if($start < 1) $start = 1;
		}
		for($i = $start; $i < $end; $i++)
		{
			$style = 'normalPaging';
			$onClick = 'onClick="doSubmitPagingForm(\''.$i.'\')"';
			if($i == $curPg)
			{
				$style = 'curPaging';
				$onClick = NULL;
			}
			$paging .= '<td width="5">&nbsp;</td><td class="'.$style.'" '.$onClick.'>'.$i.'</td>';
			
		
		}

	if($tPages > 10)
			{
			$paging .= '<td width="5">&nbsp;</td><td  class="'.$style.'" '.$onClick.'> >> </td>';
			}

		$paging .= '
				<form name="pagingForm" action="'.$curURL.'" method="post">
					<input type="hidden" name="curPg" value="">
					<input type="hidden" name="searchKeyword" value="'.$searchKeyword.'">
					<input type="hidden" name="searchAlbum" value="'.$searchAlbum.'">
					<input type="hidden" name="searchExact" value="'.$searchExact.'">
				</form>
			</tr>
		</table>';
	}
	return $paging;
}

function expandLeftMenu($cateId)
{
		$curCate = getRootParent($cateId);//$curPage = getRootCate($cateId)
	echo '<script language="javascript">expandLeftMenu('.$curCate.');</script>';
}
function redirect($url)
{
	echo "<script language=\"javascript\">";
	echo "window.location.href=\"$url\"";
	echo "</script>";
}
function reload()
{
	echo "<script language=\"javascript\">";
	echo "window.location.reload()";
	echo "</script>";
}
function closeWindow()
{
	echo "<script language=\"javascript\">";
	echo "window.close()";
	echo "</script>";
}

function validGetVar($getVal)
{
	if($getVal == NULL) return false;
	$damStr = "{/,',?,&,\"}";
	if(ereg($damStr,$getVal)) return false;
	return true;
}

function strtolower_utf8($inputString) 
{
	$outputString    = utf8_decode($inputString);
	$outputString    = strtolower($outputString);
	$outputString    = utf8_encode($outputString);
	return $outputString;
}
function strtolower2($s){ 
    $ln = strlen($s); 
    $ln1 = $ln -1; 
    for($i=0; $i < $ln; $i++){ 
        $k = ord(substr($s, $i, 1)); 
        if($k>=65 && $k <= 90){ 
            if($i > 0){ 
                $l1 = substr($s, 0, $i); 
            }else{ 
                $l1 =''; 
            } 
            $l1 = $l1 . chr($k+32); 
            if($i < $ln1){ 
                $l1 = $l1 . substr($s, $i  + 1); 
            } 
            $s = $l1; 

        } 
    } 
    return $s; 
} 

function unconvertHTML($strInput)//Convert html special code to standart form
{
	//$strInput = html_entity_decode($strInput);
	$strInput = str_replace('&quot;', '"', $strInput);
	$strInput = str_replace("&#039;", "'", $strInput);
	return $strInput;
}

function insertData($strInput)//Use In inserting or updating data into database
{//Written By Vu Thanh Toan
	$strInput = addslashes(unconvertHTML($strInput));
	return $strInput;
}

function displayData_DB($strInput)
{//Written By Vu Thanh Toan
	$strInput = stripslashes($strInput);
	//$strInput = str_replace(chr(10), '<br>', $strInput);
	return $strInput;
}

function inDateStr($strDate)
{
	$strDate = trim($strDate);
	list($day, $month, $year) = split('[/.-]', $strDate);
	$strDate = "$year-$month-$day";
	return $strDate;
}

function outDateStr($strDate,$sep="/")
{	
	$strDate = trim($strDate);
	list($year, $month, $day) = split('[/.-]', $strDate);
	$strDate = "$day-$month-$year";
	return $strDate;
}
/*
function cutString($str,$sPos,$ePos)
{
	$result = NULL;
	while($str[$sPos]!=" " && $str[$sPos]!=NULL) $sPos++;
	while($str[$ePos]!=" " && $str[$ePos]!=NULL) $ePos--;
	//$strLen = $ePos - $sPos;
	$result = substr($str, $sPos, $ePos-$sPos);
	return $result;
}
*/
function cutString($str,$sPos,$ePos)
{
	$result = NULL;
	while($str[$ePos]!=" " && $str[$ePos]!=NULL) $ePos--;
	$result = substr($str,$sPos,$ePos);
	return $result;
}

function extFile($strFile)
{
	$ext = NULL;
	$strFile = trim($strFile);
	$splitStr = split("~",str_replace(".","~",$strFile));
	sizeof($splitStr);
	if(sizeof($splitStr)>1) $ext = $splitStr[sizeof($splitStr)-1];
	return $ext;
}

// Define
define('FILE_NOT_EXIST','L&#7895;i! File kh&#244;ng t&#7891;n t&#7841;i');
define('ERROR_FILE_NOT_WRITEABLE','L&#7895;i! Kh&#244;ng th&#7875; ghi file');
// End define

function openFile($file)
{
	if(!is_file($file))
	{
		echo FILE_NOT_EXIST;
		return NULL;
	}
	$file_array = file($file);
	$content = implode('',$file_array);
	return $content;
}

function saveFile($file,$content)
{
	if(!is_file($file))
	{
		$new_file = fopen($file,'x');
	}
	else
	{
		$new_file = fopen($file,'w');
	}

	global $messageStack;

	if(!is_writeable($file))
	{
		$messageStack->reset();
		$messageStack->add(sprintf(ERROR_FILE_NOT_WRITEABLE,$file),'error');
		echo $messageStack->output();
		return false;
	}
	$content = stripslashes($content);
	fwrite($new_file,$content,strlen($content));
	fclose($new_file);
	return true;
}

function DownloadFile($file, $fileName=NULL)
{ // $file = include path 
	if(file_exists($file))
	{
		if(!$fileName)
		{
			$fileName = basename($file);
		}
		else
		{
			$fileName .= ".".extFile(basename($file));
		}
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$fileName);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
	}
	else
	{
		exit();
	}
}

function validImage($src,$name=NULL)
{
	if($name==NULL) $name = $src;
	$ext = strtolower(extFile($name));
	$listExt = array('jpg','gif','png','bmp');
	if(!in_array($ext,$listExt)) return false;
	$fsize = @filesize($src)/1024/1024;
	if(($fsize<=0)||($fsize>1.95)) return false;
	return true;
}

function imageSize($img,$maxW=100,$maxH=100,$stretch=-1)
{
	if(!validImage($img)) return false;
	if($maxW <= 0 || $maxH <= 0) return false;
	
	$sizeOut = array();
	$imgSize = getimagesize($img);
	$sizeOut = $imgSize;
	
	$x_ratio = $maxW / $imgSize[0];
	$y_ratio = $maxH / $imgSize[1];
	if($stretch == -1)
	{
		$ratio = min($x_ratio,$y_ratio);
		
		if(($imgSize[0]>$maxW)||($imgSize[1]>$maxH))
		{
			$sizeOut[0] = $imgSize[0] * $ratio;
			$sizeOut[1] = $imgSize[1] * $ratio;
		}
	}
	if($stretch == 0)
	{
		$sizeOut[0] = $maxW;
		$sizeOut[1] = $x_ratio * $imgSize[1];
	}
	if($stretch == 1)
	{
		$sizeOut[0] = $y_ratio * $imgSize[0];
		$sizeOut[1] = $maxH;
	}
	return $sizeOut;
}

function viewImage($img, $maxW = 100, $maxH = 100, $align = 'left')
{
	if(!is_file($img)) return NULL;
	
	$imgSize = imageSize($img, $maxW, $maxH);

	$strOut  = '<img src="'.$img.'" align="'.$align.'" ';
	$strOut .= 'width="'.$imgSize[0].'" height="'.$imgSize[1].'" ';
	$strOut .= 'style="border:1px solid #CCCCCC; margin:3px 5px 3px 0px">';
		
	return $strOut;
}

function noResultPage()
{
	global $define;
	$result = NULL;
	
	$result .= '
	<table width="100%" height="300" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td align="center" style="color:#FF6600; font-size:16px; font-weight:bold">'.$define["var_khongtimthaydulieu"].'</td>
		</tr>
	</table>';
	
	return $result;
}

function _POST($value)
{
	global $_GET, $_POST, $HTTP_POST_VARS,$HTTP_GET_VARS;
	if (isset($_POST["$value"])) return $_POST["$value"];
	elseif (isset($HTTP_POST_VARS["$value"])) return $HTTP_POST_VARS["$value"];
	elseif (isset($_GET["$value"])) return $_GET["$value"];
	elseif (isset($HTTP_GET_VARS["$value"])) return $HTTP_GET_VARS["$value"];
	else return NULL;
}
function _SERVER($deprecated)
{
	global $_SERVER, $HTTP_SERVER_VARS;
	if(isset($_SERVER["$deprecated"])) 
	{
		return $_SERVER["$deprecated"];
	}
	elseif(isset($HTTP_SERVER_VARS["$deprecated"]))
	{
		return $HTTP_SERVER_VARS["$deprecated"];
	}
	else return NULL;
}
function _SESSION($session_name)
{
	global $_SESSION,$HTTP_SESSION_VARS;
	if (isset($_SESSION["$session_name"])) return $_SESSION["$session_name"];
	elseif (isset($HTTP_SESSION_VARS["$session_name"])) return $HTTP_SESSION_VARS["$session_name"];
	else return NULL;
}

function _SESSION_REGISTER($session_name)
{
	global $_SESSION, $HTTP_SESSION_VARS, $$session_name;
	if(!ini_get("register_globals"))
	{
		if(isset($_SESSION))
		{
			$_SESSION["$session_name"] = $$session_name;
		}
		elseif(isset($HTTP_SESSION_VARS))
		{
			$HTTP_SESSION_VARS["$session_name"] = $$session_name;
		}
	}
	else
	{
		session_register("$session_name");
	}
}

function _SESSION_IS_REGISTERED($session_name)
{
	$result = 0;
	global $_SESSION, $HTTP_SESSION_VARS;
	if(!ini_get("register_globals"))
	{
		if($_SESSION)
		{
			if(isset($_SESSION["$session_name"]))
			{
				$result = 1;
			}
		}
		elseif($HTTP_SESSION_VARS)
		{
			if(isset($HTTP_SESSION_VARS["$session_name"]))
			{
				$result = 1;
			}
		}
	}
	else
	{
		if(session_is_registered("$session_name"))
		{
			$result = 1;
		}
	}
	return $result;
}

function _SESSION_DESTROY($session_name)
{
	global $_SESSION, $HTTP_SESSION_VARS;
	if(!ini_get("register_globals"))
	{
		if($_SESSION)
		{
			unset($_SESSION["$session_name"]);
		}
		elseif($HTTP_SESSION_VARS)
		{
			unset($HTTP_SESSION_VARS["$session_name"]);
		}
	}
	else
	{
		session_unregister("$session_name");
	}
}
?>