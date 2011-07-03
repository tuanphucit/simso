<?
$action = isset($action) ? $action : NULL;
switch($action)
{	
	case "update":
		$config_names = explode("~",substr($config_name,0,strlen($config_name)-1));
		$config_values = explode("~",substr($config_value,0,strlen($config_value)-1));
		$content_file = "<?\n";
		$content_file .= '$config = array();'."\n";
		if($usrid!=0)
		{
			$content_file .= '$config["db_host"] = "'.$config["db_host"].'";'."\n";
			$content_file .= '$config["db_user"] = "'.$config["db_user"].'";'."\n";
			$content_file .= '$config["db_pwd"] = "'.$config["db_pwd"].'";'."\n";
			$content_file .= '$config["db_name"] = "'.$config["db_name"].'";'."\n";
			$content_file .= '$config["db_error"] = "'.$config["db_error"].'";'."\n";
			$content_file .= '$config["domain"] = "'.$config["domain"].'";'."\n";
			$content_file .= '$config["root_path"] = "'.$config["root_path"].'";'."\n";
			$content_file .= '$config["script_path"] = "'.$config["script_path"].'";'."\n";
			$content_file .= '$config["FCKeditor_path"] = "'.$config["FCKeditor_path"].'";'."\n";			
			$content_file .= '$config["FCKeditor_upload_path"] = "'.$config["FCKeditor_upload_path"].'";'."\n";			
			$content_file .= '$config["special_admin"] = "'.$config["special_admin"].'";'."\n";
		}
		for($i=0;$i<sizeof($config_names);$i++)
		{
			if($config_names[$i]=="special_admin")
			{				
				if($config_values[$i]!=NULL) 
				{
					$special_admin = md5($config_values[$i]);
				}
				else
				{
					for($j=0;$j<sizeof($config_names);$j++)
					{
						if($config_names[$j]=="old_special_admin") $special_admin = $config_values[$j];
					}
				}
				$config_values[$i] = $special_admin;
			}
			if($config_names[$i]!="old_special_admin")
			{
				$content_file .= '$config["'.$config_names[$i].'"] = "'.$config_values[$i].'";';
			}
			$content_file .= "\n";
		}
		$content_file .= '?>';
		saveFile("includes/config.php",$content_file);
		
		redirect("index.php?module=configs");
		exit();
		break;
	default:
		include_once("js.html");
		include_once("config_form.php");
}
?>