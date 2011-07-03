<?
session_start();

include_once("myadmin/includes/config.php");
include_once("myadmin/includes/mysql.php");
include_once("includes/global.php");

if(!$isLogin)
{
	//redirect("$_URL_BASE/");
	echo '
	<table width="100%" height="100%" align="center">
		<tr>
			<td align="center">'.$define["var_banchuadangnhap"].'</td>
		</tr>
	</table>';
}
else
{
	if(!_SERVER('QUERY_STRING')) 
	{
		$url = strip_tags(_SERVER('REQUEST_URI'));
		if($config["script_path"])
		{
			$url = str_replace("/".$config["script_path"],"",$url);
		}
		$url = str_replace("/downloadschedule.php", "", $url);
		$url_array = explode("/",$url);
		array_shift($url_array);
	}
	$itemId = $url_array[0];
	if($itemId && validGetVar($itemId))
	{
		$conds = "schedule_id='".$itemId."'";
		$sql->set_query("vot_schedule", "*", $conds);
		if($sql->set_farray())
		{
			$fileName = utf8_decode($sql->farray["schedule_name"]);
			$fileDown = $sql->farray["schedule_file"];

			if(is_file("$_ROOT_PATH/$fileDown"))
			{
				DownloadFile("$_ROOT_PATH/$fileDown", $fileName);
				//header('Location: '."$_URL_BASE/$fileDown");

				$insert = "schedule_down = schedule_down+1";
				$where = "schedule_id='".$itemId."'";
				$sql->update("vot_schedule", $insert, $where);
				
				echo '<script language="javascript">';
				echo 'window.opener.location.reload();';
				echo 'window.close();';
				echo '</script>';
			}
			else
			{
				closeWindow();
				exit();
			}
		}
	}
	else
	{
		closeWindow();
		exit();
	}
}
?>