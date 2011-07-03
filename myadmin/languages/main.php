<?
$url = "index.php?module=$module&curPg=$curPg&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

include_once("js.html");

$sql = new mysql();

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
					
		// Remove languages' directory
		$sql->set_query("vot_language","language_dir","language_id IN ('".$chon."')");
		while($sql->set_farray())
		{
			$lang_dir = "../languages/".$sql->farray["language_dir"];
			if(is_dir($lang_dir)) removeDir($lang_dir);
		}
		// Delete infomations in database
		$sql->set_list_tables();
		$sql->delete("vot_language","language_id",$chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "language_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_language",$values,"language_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "language_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_language",$values,"language_id='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				

		$maxImgW = 24;
		$maxImgH = 15;
		$new_image = NULL;
		
		$view = isset($view) ? $view : 0;
		$upload_dir = "uploads/language_flags";
		$lang_dir = "../languages";
		$opt = new option();
		if($CURID!=NULL && $isSave==NULL)
		{			
			$an_exist_dir = $opt->optionvalue("vot_language","language_dir","language_id='".$CURID."'");
			if(is_dir("$lang_dir/$an_exist_dir") && $an_exist_dir!=$dir) 
			{
				@rename("$lang_dir/$an_exist_dir","$lang_dir/$dir");
			}
			if($image_name==NULL || $image_name=='none') 
			{
				$new_image = $old_image;
			}
			else
			{
				delFile("../$old_image");
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_image = "$upload_dir/".date("dmy").time().".".extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image", $maxImgW, $maxImgH);		
				}
			}
			$values  = "language_name='".$nname."',language_flag='".$new_image."',language_dir='".$dir."',language_order='".$order."',language_view='".$view."'";
			$sql->update("vot_language",$values,"language_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($dir!=NULL) dircpy("$lang_dir/default","$lang_dir/$dir");
			if($image_name==NULL || $image_name=='none') $new_image = $old_image;
			else
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_image = "$upload_dir/".date("dmy").time().".".extFile($image_name);
				upload($image_tmp_name,$new_image);
				if(is_file("../$new_image")) 
				{
					imageCopyResize("../$new_image", $maxImgW, $maxImgH);		
				}
			}
			$fields = "language_name,language_flag,language_dir,language_order,language_view";
			$values  = "'".$nname."','".$new_image."','".$dir."','".$order."','".$view."'";
			$sql->insert("vot_language",$fields,$values);
		}
		//include_once("languages_file.php");
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		break;
	
	case "define_update":
		$config_names = explode("~",substr($config_name,0,strlen($config_name)-1));
		$config_values = explode("~",substr($config_value,0,strlen($config_value)-1));

		$opt = new option();
		$lang_dir = $opt->optionvalue("vot_language","language_dir","language_id='".$CURID."'");

		$content_file = "<?\n";
		$content_file .= '$define = array();'."\n";
		for($i=0;$i<sizeof($config_names);$i++)
		{
			$config_values[$i] = formatStringDefineIn($config_values[$i]);
			$content_file .= '$define["'.$config_names[$i].'"] = "'.$config_values[$i].'";';
			$content_file .= "\n";
		}
		$content_file .= '?>';
		saveFile("../languages/$lang_dir/define.php",$content_file);

		if($CURID==1)
		{
			$content_file = "<?\n";
			$content_file .= '$lang_def = array();'."\n";
			for($i = 0; $i < sizeof($config_names); $i++)
			{
				$config_values[$i] = formatStringDefineIn($config_values[$i]);
				$content_file .= '$lang_def["'.$config_names[$i].'"] = "'.$config_values[$i].'";';
				$content_file .= "\n";
			}
			$content_file .= '?>';
			saveFile("../languages/default/define.php",$content_file);
		}
		redirect("$url&CURID=$CURID&action=defines");
		break;
	
	case "defines":
		$sql->set_query("vot_language","*","language_id='".$CURID."'");
		if($sql->set_farray())
		{
			$lang_name = $sql->farray["language_name"];
			$lang_dir = $sql->farray["language_dir"];
		}
		$url = "$url&CURID=$CURID";
		$and = "CURID=$CURID&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
		include_once("../languages/default/define.php");
		include_once("../languages/$lang_dir/define.php");
		include_once("language_define.php");
		break;
	
	default:
	
		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		include_once("includes/paging.php");
		
		$cond = NULL;		
		if($KWD != NULL) $cond = "language_name LIKE '%".$KWD."%'";
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$other = " ORDER BY language_$orderBy $vArrow";
		if($vArrow=='DESC') 
		{
			$toArrow = NULL;
			if($orderBy=='order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
			if($orderBy=='name')
			{
				$orderArrow = NULL;
				$senderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
		}
		else 
		{
			$toArrow = 'DESC';
			if($orderBy=='order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_up.gif" border="0">';
			}
			if($orderBy=='name')
			{
				$orderArrow = NULL;
				$senderArrow = '<img src="images/arrow_up.gif" border="0">';
			}
		}
		
		$sql->set_query("vot_language","*",$cond,$other);
		$tRows = $sql->nRows;
		
		if(!$curPg) $curPg = 1;
		else
		{
			$numPgs = ceil($tRows / $maxRows);
			if($curPg > $numPgs) $curPg = $numPgs;
		}
		$curRow = ($curPg - 1) * $maxRows+1;
		
		$action = 'edit';
		$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";
		$url = "index.php?module=$module&curPg=$curPg&$and";
		include_once("listlanguage.php");
		break;			
}
?>