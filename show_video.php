<?
session_start();

include_once("myadmin/includes/config.php");
include_once("myadmin/includes/mysql.php");
include_once("includes/global.php");

if(!_SERVER('QUERY_STRING')) 
{
	$url = strip_tags(_SERVER('REQUEST_URI'));
	if($config["script_path"])
	{
		$url = str_replace("/".$config["script_path"],"",$url);
	}
	$url = str_replace("/show_video.php", "", $url);
	$url_array = explode("/",$url);
	array_shift($url_array);
}

$my_url = $url_array;

if((int)($my_url[0]))
{
	$cateId = $url_array[0];
}
else
{
	$cateId = NULL;
	$itemId = NULL;
	$cateName = $url_array[0];
}
if($cateId)
{
	if((int)($my_url[1]))
	{
		$itemId = $url_array[1];
		$itemName = $url_array[2];
	}
	else
	{
		$itemId = NULL;
		$cateName = $url_array[1];
	}
}

if(!$itemId || !validGetVar($itemId))
{
	exit();
}
$conds = "video_id='".$itemId."'";
$sql->set_query("vot_video", "*", $conds);
if($sql->set_farray())
{
	$videoFile = $sql->farray["video_file"];

	$insert = "video_show = video_show+1";
	$where = "video_id='".$itemId."'";
	$sql->update("vot_video", $insert, $where);
	$sql = new mysql;
?>
<table align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<object>
				<embed pluginspage="http://www.microsoft.com/Windows/Downloads/Contents/Products/MediaPlayer/" src="<?="$_URL_BASE/$videoFile"?>" type="application/x-mplayer2" ShowStatusBar="1" AutoStart="1" Loop="0" ShowControls="1" width="300" height="300"></embed>
			</object>
		</td>
	</tr>
</table>
<?
}
?>