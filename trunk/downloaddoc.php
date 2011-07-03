<?
session_start();

include_once("myadmin/includes/config.php");
include_once("myadmin/includes/mysql.php");
include_once("includes/global.php");

/*
if(!$isLogin)
{
	//redirect("$_URL_BASE/");
	echo '
	<table width="100%" height="100%" align="center">
		<tr>
			<td align="center">'.$define["var_banchuadangnhap"].'</td>
		</tr>
	</table>
 ';
}
else
{
*/
if(!_SERVER('QUERY_STRING')) 
{
	$url = strip_tags(_SERVER('REQUEST_URI'));
	if($config["script_path"])
	{
		$url = str_replace("/".$config["script_path"],"",$url);
	}
	$url = str_replace("/downloaddoc.php", "", $url);
	$url_array = explode("/",$url);
	array_shift($url_array);
}
$itemId = $url_array[0];
$fileType = $url_array[1];
if($itemId && validGetVar($itemId))
{
	$conds = "document_id='".$itemId."'";
	$sql->set_query("vot_document", "*", $conds);
	if($sql->set_farray())
	{
		$fileName = utf8_decode($sql->farray["document_name"]);
		if($fileType == 'doc')
		{
			$fileDown = $sql->farray["document_msdoc"];
		}
		elseif($fileType == 'pdf')
		{
			$fileDown = utf8_decode($sql->farray["document_adpdf"]);
		}
		if(is_file("$_ROOT_PATH/$fileDown"))
		{
			//header('Location: '."$_URL_BASE/$fileDown");
			DownloadFile("$_ROOT_PATH/$fileDown", $fileName);
			
			$insert = "document_down = document_down+1";
			$where = "document_id='".$itemId."'";
			$sql->update("vot_document", $insert, $where);
		}
		else
		{
			exit();
		}			
		echo '<script language="javascript">';
		echo 'window.opener.location.reload();';
		echo 'window.close();';
		echo '</script>';
	}
}
else
{
	closeWindow();
	exit();
}
//}
?>