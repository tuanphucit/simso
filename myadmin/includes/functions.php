<?

function geld($nm) 

{

    for ($done=strlen($nm); $done > 3;$done = $done - 3) 

	{ 

        $returnNum = ",".substr($nm,$done-3,3).$returnNum;

    }

 return substr($nm,0,$done).$returnNum;

}

function createManualMenuBar($mnParent)

{

	global $LANG, $_ROOT_PATH, $_URL_BASE;

	

	$result  = "\n".'with(milonic = new menuname("'.$mnParent.'"))'."\n".'{'."\n";

	$result .= 'alwaysvisible = 1;'."\n";

	$result .= 'style = subMenuStyle;'."\n";



	$sql = new mysql;

	$conds = "language_id = '".$LANG."' AND mainmenubar_parent='".$mnParent."' AND mainmenubar_view = 1";

	$others = "ORDER BY mainmenubar_order ASC";

	$sql->set_query("vot_$table", "*", $conds, $others);

	while($sql->nRows > 0 && $sql->set_farray())

	{

		$subMnId = $sql->farray["mainmenubar_id"];

		$subMnName = $sql->farray["mainmenubar_name"];

		$subMnType = $sql->farray["mainmenubar_type"];

		$subMnLink = $sql->farray["mainmenubar_linkto"];

		$subMnCode = $subMnId;

		if($subMnType == 1)

		{

			$subMnLink = NULL;

			$subMnCode = NULL;

			$subResult = createAutoMenuBar($subMnLink, $subMnCode);

		}

		elseif($subMnType == 2)

		{

			$subMnLink = NULL;

			$subMnCode = NULL;

			$subResult = createManualMenuBar($subMnId);

		}

		$result .= drawMenuItem($subMnName, $subMnLink, $subMnType, $subMnCode);

	}

	$result .= '}'."\n";

	$result .= $subResult;

}

function createAutoMenuBar($subMnLink, $mnParent, $level=0)

{

	global $LANG, $_ROOT_PATH, $_URL_BASE;

	

	$result  = "\n".'with(milonic = new menuname("'.$mnParent.'"))'."\n".'{'."\n";

	$result .= 'alwaysvisible = 1;'."\n";

	$result .= 'style = subMenuStyle;'."\n";



	$sql = new mysql;

	$froms = "vot_modules AS a, vot_moduletypes AS b";

	$conds = "modules_linkto='".$subMnLink."' AND modules_type=moduletypes_id AND modules_view = 1";

	$others = "ORDER BY modules_order ASC";

	$sql->set_query($froms, "*", $conds, $others);

	if($sql->nRows > 0 && $sql->set_farray())

	{

		$modId = $sql->farray["modules_id"];

		$source = $sql->farray["moduletypes_source"];

		list($source_1, $source_2) = split(',',str_replace(' ', '', $source));



		$conds = "modules_id='".$modId."' AND $source_1"."_view=1";

		$others = "ORDER BY $source_1"."_order ASC";

		$sql->set_query("vot_$source_1", "*", $conds, $others);

		while($sql->set_farray())

		{

			$subMnId = $sql->farray["$source_1"."_id"];

			$subMnName = $sql->farray["$source_1"."_name"];

			$ssql = new mysql;

			$conds = "$source_1"."_parent='".$subMnId."' AND $source_1"."_view=1";

			$others = "ORDER BY $source_1"."_order ASC";

			if($ssql->nRows > 0)

			{

				$sMnLink = NULL;

				$mnPar = $subMnId;

			}

		}

	}

	$result .= '}'."\n";

}

function creatMenu($id, $table, $mnCode, $module=NULL, $level = 0)

{

	global $LANG, $_ROOT_PATH, $_URL_BASE;

	

	$result = "\n".'with(milonic = new menuname("'.$mnCode.'"))'."\n".'{';

	if(!$level)

	{

		$result .= '

		alwaysvisible = 1;

		orientation = "horizontal";

		style = mainMenuStyle;'."\n";

	}

	else

	{

		$result .= "\n".'style = subMenuStyle;'."\n";

	}

	

	$count = 0;

	$subMenuBar = array(array(),array());

	

	$sql = new mysql;

	$conds = "language_id = '".$LANG."'";

	if($level > 0)

	{

		$conds .= " AND ".$table."_parent = '".$id."'";

	}

	$conds .= " AND ".$table."_view = 1";

	$others = "ORDER BY ".$table."_order ASC";

	$sql->set_query("vot_$table", "*", $conds, $others);

	while($sql->nRows > 0 && $sql->set_farray())

	{

		$mnItemId = $sql->farray[$table."_id"];

		$mnItemName = $sql->farray[$table."_name"];

		if($level > 0)

		{

			$ssql = new mysql;

			$ssql->set_query("vot_$table", $table."_id", $table."_parent='".$mnItemId."'");

			$mnSubNum = $ssql->nRows;

			if(!$mnSubNum)

			{

				$mnItemType = 0;

				$mnItemLinkTo = "$_URL_BASE/$module/?id=$mnItemId";

			}

			else

			{

				$mnItemType = 1;

				$mnItemLinkTo = NULL;

				$mnItemCode = $mnCode."_".$mnItemId;

				$subMenuBar[$count]["id"] = $mnItemId;

				$subMenuBar[$count]["dbTable"] = $table;

				$subMenuBar[$count]["module"] = $module;

				$subMenuBar[$count]["code"] = $mnItemCode;

				$count++;

			}

		}

		else

		{

			$mnItemType = $sql->farray[$table."_type"];

			$mnItemCode = $sql->farray[$table."_code"];

			$mnItemModule = $sql->farray[$table."_linkto"];

			if($mnItemType)

			{

				$mnItemLinkTo = NULL;

				$subMenuBar[$count]["dbTable"] = $mnItemCode;

				$subMenuBar[$count]["module"] = $mnItemModule;

				$subMenuBar[$count]["id"] = 0;

				$subMenuBar[$count]["code"] = $mnItemCode;

				$count++;

			}

			else

			{

				$mnItemLinkTo = "$_URL_BASE/";

				if($mnItemModule != NULL) $mnItemLinkTo .= "$mnItemModule/";

			}

		}

		$result .= drawMenuItem($mnItemName, $mnItemLinkTo, $mnItemType, $mnItemCode);

	}

	$result .= '}'."\n";

	if($count > 0)

	{

		for($i=0; $i<$count; $i++)

		{

			$result .= creatMenu($subMenuBar[$i]["id"], $subMenuBar[$i]["dbTable"], $subMenuBar[$i]["code"], $subMenuBar[$i]["module"], $level+1);

		}

	}

	return $result;

}



function drawMenuItem($mnText, $mnLink=NULL, $mnSub=0, $subMnName=NULL)

{

	$result  = 'aI("text='.$mnText.';';

	if($mnLink != NULL)

	{

		$result .= 'url='.$mnLink.';';

	}

	if($mnSub)

	{

		$result .= 'showmenu='.$subMnName.';';

	}

	$result .= '");'."\n";

	return $result;

}



function isDupKey($inputKey, $curId, $tableName, $fieldName, $fieldId)

{

	global $LANG;

	$result = 0;

	$sql = new mysql;

	$conds = "$fieldName = '".$inputKey."' AND $fieldId != '".$curId."' AND language_id = '".$LANG."'";

	$sql->set_query($tableName, $fieldName, $conds);

	if($sql->nRows > 0)

	{

		$result = 1;

	}

	return $result;

}



function delCate($id, $table = NULL)

{

	$sql = new mysql;

	

	if(!$id) $id = -1;

	

	$sql->set_query("vot_$table", $table."_id", $table."_parent='".$id."'");

	while($sql->nRows > 0 && $sql->set_farray())

	{

		$cateId = $sql->farray[$table."_id"];

		$ssql = new mysql;

		$ssql->set_list_tables();

		$ssql->delete("vot_$table", $table."_id", $cateId);



		$ssql = new mysql;

		$ssql->set_query("vot_$table", $table."_id", $table."_parent=$cateId");

		if($ssql->nRows > 0) delCate($cateId, $table);

	}	

	/*luckymancvp

	 * Xoa trong bang product nua

	 */

	$sql = new mysql;

	$sql->set_query("vot_$table", $table."_name", $table."_id='".$id."'");

	if ($sql->nRows = 0)

		return;

	$sql->set_farray();

	$modulefield_name = $sql->farray[$table."_name"];

	

	$sql = new mysql;

	$sql->deleteInOneTable("product","kho",$modulefield_name);

	

	////

	$sql = new mysql;

	$sql->set_list_tables();

	$sql->delete("vot_$table",$table."_id",$id);

	

}

/////dongkisot 29-10

function delCategory($id, $table = "homeblocktype_lr")

{

	$sql = new mysql;

	if(!$id) $id = -1;

	

	$sql->set_query("vnws_$table","homeblocktype_id","homeblocktype_parent='".$id."'");

	while($sql->nRows > 0 && $sql->set_farray())

	{

		$cateId = $sql->farray["homeblocktype_id"];

		$ssql = new mysql;

		$ssql->set_list_tables();

		$ssql->delete("vnws_$table","homeblocktype_id",$cateId);



		$ssql = new mysql;

		$ssql->set_query("vnws_$table","homeblocktype_id","homeblocktype_parent=$cateId");

		if($ssql->nRows > 0) delCategory($cateId);

	}	

	$sql = new mysql;

	$sql->set_list_tables();

	$sql->delete("vnws_$table","homeblocktype_id",$id);

}





function getKeyInArray($value, $array)

{

	$outKey = -1;



	for($i = 0; $i < sizeof($array); $i++)

	{

		if($value == $array[$i])

		{

			$outKey = $i;

			break;

		}

	}

	

	return $outKey;

}



function getThemeOptions($curTheme, $status = 'disabled')

{

	$result = NULL;

	

	$listTheme = array();

	$listTheme[0] = array("value" => "default", "label" => "Default");

	$listTheme[1] = array("value" => "hosting", "label" => "Hosting view");

	

	$result .= "<select name=\"theme\" $status >";

	for($i = 0; $i < sizeof($listTheme); $i++)

	{

		$result .= '<option value="'.$listTheme[$i]['value'].'"';

		if($listTheme[$i]['value'] == $curTheme)

		{

			$result .= ' selected';

		}

		$result .= '>'.$listTheme[$i]['label'].'</option>';

	}

	$result .= "</select>";

	

	return $result;

}



function cutString($str,$sPos,$ePos)

{

	$result = NULL;

	while($str[$ePos]!=" " && $str[$ePos]!=NULL) $ePos--;

	$result = substr($str,$sPos,$ePos);

	return $result;

}



function formatStringDefineIn($str)

{

	$str = str_replace('"','``',$str);

	return $str;

}



function formatStringDefineOut($str)

{

	$str = str_replace('``','"',$str);

	return $str;

}

 

function removeHtmlTag($str,$tag)

{

	$strCopy = strtolower($str);

	$tag = strtolower($tag);	

	$len = strlen($strCopy);

	$sPos = strpos($strCopy,"<$tag");

	$ePos = $sPos+1;

	while(($ePos<$len)&&($strCopy[$ePos]!=">"))

	{

		$ePos++;

	}

	$str = substr($str,0,$sPos).substr($str,$ePos+1);

	return $str;

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

  

function outDateStr($strDate)

{

	$result  = NULL;

	

	$strDate = trim($strDate);

	list($year, $month, $day) = split('[/.-]', $strDate);

	

	if($day != NULL && $day != '0' && $day != '00')

	{

		$result .= "$day";

	}

	if($month != NULL && $month != '0' && $month != '00')

	{

		$result .= "/$month";

	}

	if($year != NULL && $year != '00' && $year != '0000')

	{

		$result .= "/$year";

	}



	return $result;

}



function getStars($class=1)

{

	$star = NULL;

	for($i=0;$i<$class;$i++)

	{

		$star .= '<img src="images/star.gif">';

	}

	return $star;

}



function starOpt($item=NULL,$low=1,$high=5)

{

	$strOpt  = "<option value=\"\"  checked>";

	$strOpt .= "-- Stars --</option>";	

	for($i=$low;$i<=$high;$i++)

	{

		$strOpt .= "<option value=$i " ;

		if($i==$item)	$strOpt .=" selected  ";

		$strOpt .= ">".$i." Stars</option>";

	}

	return $strOpt;

}



function outPermisionStr($strPer)

{

	$strPer = trim($strPer);

	$usrper = array();

	list($usrper["canEdit"],$usrper["canAdd"],$usrper["canDel"],$usrper["canUser"]) = split('_',$strPer);

	return $usrper;

}



function setPermisionChecked($perm)

{

	$permChked = array();

	if($perm["canEdit"]==YES) $permChked["cEdit"] = "checked";

	if($perm["canAdd"]==YES) $permChked["cAdd"] = "checked";

	if($perm["canDel"]==YES) $permChked["cDel"] = "checked";

	if($perm["canUser"]==YES) $permChked["cUser"] = "checked";

	return $permChked;

}



function showListFood($listFood)

{

	$sql = new mysql;

	$food = str_replace("~","','",$listFood);

	$cond = "monan_id IN ('".$food."')";

	$other = "ORDER BY loaimonan_id,monan_order ASC";

	echo '<ol style="color:#993300">';

	$sql->set_query("vot_monan","monan_id,monan_name",$cond,$other);

	while($sql->set_farray())

	{

		$id = $sql->farray["monan_id"];

		$name = $sql->farray["monan_name"];

		echo "<li> $name </li>";

	}

	echo '</ol>';

}



function listFoodSelected($listFood)

{

	global $LANG;

	$sql = new mysql;

	$food = split("~",$listFood);

	$cond = "language_id=$LANG";

	$other = "ORDER BY loaimonan_id,monan_order ASC";

	echo '<select name="listFood" multiple size="10">';

	$sql->set_query("vot_monan","monan_id,monan_name",$cond,$other);

	while($sql->set_farray())

	{

		$id = $sql->farray["monan_id"];

		$name = $sql->farray["monan_name"];

		echo "<option value=\"$id\"";

		for($i=0;$i<sizeof($food);$i++)

		{

			if(in_array($id,$food)) echo " selected";

		}

		echo ">$name</option>";

	}

	echo '</select>';

}



// Parse the data used in the html tags to ensure the tags will not break

function parse_input_field_data($data, $parse) 

{

	return strtr(trim($data), $parse);

}



function output_string($string, $translate = false, $protected = false) 

{

	if ($protected == true) 

	{

		return htmlspecialchars($string);

	} 

	else 

	{

		if ($translate == false) 

		{

			return parse_input_field_data($string, array('"' => '&quot;'));

		} 

		else 

		{

			return parse_input_field_data($string, $translate);

		}

	}

}



//File

function delFile($file)

{

	if(file_exists($file)) @$ok = unlink($file);

}

  

function upLoad($userFile,$fileName)

{

	$upFile = "../$fileName";

	move_uploaded_file($userFile,$upFile);  

} 



//Redirect to "$url" address

function redirect($url) 

{

	if(!headers_sent())

	{

		header("Location: $url");

	}

	else

	{

		echo "<script language=javascript>location.href='".$url."'</script>";

	}

	exit();

}



//Check a varriable

function not_null($value) 

{

	if (is_array($value)) 

	{

		if (sizeof($value) > 0) 

		{

			return true;

		} 

		else 

		{

			return false;

		}

	} 

	else 

	{

		if ((is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) 

		{

			return true;

		} 

		else 

		{

			return false;

		}

	}

}



// loc1 is the path on the computer to the base directory that may be moved

define('loc1', '', true);

// copy a directory and all subdirectories and files (recursive)

// void dircpy( str 'source directory', str 'destination directory' [, bool 'overwrite existing files'] )

function dircpy($source, $dest, $overwrite = false)

{

	if($handle = opendir(loc1.$source))

	{       

		// if the folder exploration is sucsessful, continue

		$dest_path = loc1.$dest;

		if(@!is_dir($dest_path)) mkdir($dest_path,0777);

		while(false!==($file = readdir($handle)))

		{ 

			// as long as storing the next file to $file is successful, continue

			if($file != '.' && $file != '..')

			{

				$path = "$source/$file";

				if(is_file(loc1.$path))

				{

					if(!is_file(loc1."$dest/$file") || $overwrite)

						if(!@copy(loc1.$path, loc1."$dest/$file"))

						{

							echo '<font color="red">File ('.$path.') could not be copied, likely a permissions problem.</font>';

						}

				}

				elseif(is_dir(loc1.$path))

				{

					if(!is_dir("$dest_path/$file"))

						mkdir("$dest_path/$file",0777); // make subdirectory before subdirectory is copied

					dircpy($path, "$dest/$file", $overwrite); //recurse!

				}

			}

		}

		closedir($handle);

	}

} 

// end of dircpy()



//This function used to remove directory

function removeDir($source) 

{

	global $messageStack, $tep_remove_error;



	if (isset($tep_remove_error)) $tep_remove_error = false;



	if (is_dir($source)) 

	{

		$dir = dir($source);

		while ($file = $dir->read()) 

		{

			if(($file != '.')&&($file != '..')) 

			{

				if(is_writeable("$source/$file")) 

				{

					removeDir("$source/$file");

				} 

				else 

				{

					$messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, "$source/$file"), 'error');

					$tep_remove_error = true;

				}

			}

		}

		$dir->close();



		if (is_writeable($source)) 

		{

			rmdir($source);

		} 

		else 

		{

			$messageStack->add(sprintf(ERROR_DIRECTORY_NOT_REMOVEABLE, $source), 'error');

			$tep_remove_error = true;

		}

	} 

	else 

	{

		if (is_writeable($source)) 

		{

			unlink($source);

		} 

		else 

		{

			$messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source), 'error');

			$tep_remove_error = true;

		}

	}

}

//End romoveDir function



function formatFileName($fname)

{

	$abc='abcdefghijklmnopqrstvuxywz._0123456789';

	settype($fname,'string');

	$fname = strtolower($fname);

	$fname = str_replace(" ","",$fname);

	$len=strlen($fname);

	for($i=0;$i<$len;$i++)

	{

		if(!strstr($abc,$fname[$i]))

			$fname=str_replace($fname[$i],'_',$fname);

	}

	return $fname;

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



function icon_img($fimg='')

{

	if(!is_file("../$fimg")||($fimg==""))

	{

		$icon_img = $icon_error;

	}

	else

	{

		$icon_img = "images/".extFile($fimg)."gif";

	}

	return $icon_img;

}

	

function imageSize($img,$maxW=100,$maxH=100)

{

	if(!validImage($img)) return false;

	if($maxW<=0||$maxH<=0) return false;

	

	$sizeOut = array();

	$imgSize = getimagesize($img);

	$sizeOut = $imgSize;

	

	$x_ratio = $maxW/$imgSize[0];

	$y_ratio = $maxH/$imgSize[1];

	$ratio = min($x_ratio,$y_ratio);

	

	if(($imgSize[0]>$maxW)||($imgSize[1]>$maxH))

	{

		$sizeOut[0] = $imgSize[0]*$ratio;

		$sizeOut[1] = $imgSize[1]*$ratio;

	}

	return $sizeOut;

}



function imageSrc($img,$file_type)

{

	$imgSrc = false;

	if($file_type=="jpeg") $file_type = 'jpg';

	switch($file_type)

	{

		case 'jpg':

			if(function_exists("imagecreatefromjpeg"))

			{

				$imgSrc = imagecreatefromjpeg("$img");

			}

			break;

		case 'gif':

			if(function_exists("imagecreatefromgif"))

			{

				$imgSrc = imagecreatefromgif("$img");

			}

			break;

		case 'png':

			if(function_exists("imagecreatefrompng"))

			{

				$imgSrc = imagecreatefrompng("$img");

			}

			break;

		case 'bmp':

			if(function_exists("imagecreatefromwbmp"))

			{

				$imgSrc = imagecreatefromwbmp("$img");

			}

			break;

	}

	return $imgSrc;

}



function imageOut($file_type,$thumb,$pathOut=NULL,$quality = 100)

{

	$imgOut = NULL;

	$func = NULL;	

	if($file_type=="jpg"||$file_type=="jpeg")

	{

		if(function_exists("imagejpeg")) $image = imagejpeg($thumb,$pathOut,$quality);

	}

	if($file_type=="gif"||$file_type=="bmp") $func = "imagegif";

	if($file_type=="png") $func = "imagepng";



	if(function_exists("$func")) $imgOut = $func($thumb,$pathOut);

	return $imgOut;

}



function imageCopyResize($image, $xSize, $ySize, $chgScale = "NO", $new_image_path = NULL, $quality = 100)

{

	if(!file_exists($image)) return "File not exist";

	if($xSize==0||$ySize==0) return "At the leat one pair of size is 0";

	

	$width = 0; 

	$height = 0;

	

	$size = getimagesize($image);

	$ratio = min($xSize/$size[0],$ySize/$size[1]);

	if($chgScale != "NO")

	{

		$width = $xSize;

		$height = $ySize;		

	}

	elseif($ratio < 1)

	{

		$width = ceil($size[0]*$ratio);

		$height = ceil($size[1]*$ratio);

	}	

	if(($width>0)&&($width!=$size[0])&&($height>0)&&($height!=$size[1]))

	{

		$file_type = strtolower(extFile($image));

		$imgSrc = imageSrc($image,$file_type);

		if($imgSrc=="Unknown") return "Unknown image format: $file_type"; 

		

		$pathOut = ($new_image_path==NULL) ? $image : $new_image_path;

		$thumb = imagecreatetruecolor($width, $height);

		imagecopyresampled($thumb,$imgSrc,0,0,0,0,$width,$height,$size[0],$size[1]);

		$imgOut = imageOut($file_type,$thumb, $pathOut, $quality);

		

		imagedestroy($imgSrc);

		imagedestroy($thumb);

	}

	else if($new_image_path!=NULL)

	{

		copy($image,$new_image_path);

	}

	return $imgOut;

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

	global $messageStack;

	

	$new_file = fopen($file,'x');

	

	if(!is_writeable($file))

	{

		$messageStack->reset();

		$messageStack->add(sprintf(ERROR_FILE_NOT_WRITEABLE,$file),'error');

		echo $messageStack->output();

		return false;

	}

	$new_file = fopen($file,'w');

	$content = stripslashes($content);

	fwrite($new_file,$content,strlen($content));

	fclose($new_file);

	return true;

}



function _POST($value)

{

	global $_GET, $_POST, $HTTP_POST_VARS,$HTTP_GET_VARS;

	if (isset($_POST["$value"])) return $_POST["$value"];

	elseif (isset($HTTP_POST_VARS["$value"])) return $HTTP_POST_VARS["$value"];

	elseif (isset($_GET["$value"])) return $_GET["$value"];

	elseif (isset($HTTP_GET_VARS["$value"])) return $HTTP_GET_VARS["$value"];

	else return ;

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

	else return ;

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