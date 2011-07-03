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
	$url = str_replace("/show_image.php", "", $url);
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

$conds = "language_id = '".$lang."' AND modules_id='".$cateId."' AND photo_view=1";
$others = "ORDER BY photo_order DESC";

$count = 1;
$curItem = 1;
$listItems = array(array(),array());

$sql->set_query("vot_photo", "*", $conds, $others);
while($sql->set_farray())
{
	$listItems[$count]["id"] = $sql->farray["photo_id"];
	$listItems[$count]["name"] = displayData_DB($sql->farray["photo_name"]);
	$listItems[$count]["image"] = $sql->farray["photo_image"];
	if($listItems[$count]["id"] == $itemId)
	{
		$curItem = $count;
	}
	$count++;
}
if($count > 1)
{
	if(is_file("$_ROOT_PATH/".$listItems[$curItem]["image"])) 
	{
		$contentDetail =  '<img src="'."$_URL_BASE/".$listItems[$curItem]["image"].'">';
	}
	$preItem = $curItem - 1;
	$nextItem = $curItem + 1;
	if($preItem > 0)
	{
		$preLink  = '<a href="'.$_URL_BASE.'/show_image.php/'.$cateId.'/'.$listItems[$preItem]["id"].'" title="'.$listItems[$preItem]["name"].'"';
		$preLink .= ' onclick="Modalbox.show(this.href, {title: this.title,overlayClose: false}); return false;">';
		$preLink .= '<img src="'.$_IMG_DIR.'/pre_game.jpg" width="28" height="30" border="0"></a>';
	}
	else
	{
		$preLink  = '<img src="'.$_IMG_DIR.'/pre_game_dis.jpg" width="28" height="30" border="0">';
	}
	if($nextItem < $count)
	{
		$nextLink  = '<a href="'.$_URL_BASE.'/show_image.php/'.$cateId.'/'.$listItems[$nextItem]["id"].'" title="'.$listItems[$nextItem]["name"].'"';
		$nextLink .= ' onclick="Modalbox.show(this.href, {title: this.title,overlayClose: false}); return false;">';
		$nextLink .= '<img src="'.$_IMG_DIR.'/next_game.jpg" width="28" height="30" border="0"></a>';
	}
	else
	{
		$nextLink  = '<img src="'.$_IMG_DIR.'/next_game_dis.jpg" width="28" height="30" border="0">';
	}
?>
<html>
<head>
<title><?=$siteTitle?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>" />
<style type="text/css">@import url("<?=$_CSS_DIR?>/style.css");</style>
<style>
body
{
	background-color: #FFFFFF;
}
</style>
</head>
<body>
<table width="90%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="centerContent" colspan="2" align="center"><?=$contentDetail?></td>
	</tr>
	<tr>
		<td height="40" align="left" style="font-size:11px">
			<div style="color:#666666"><?=$define["var_anh"]?>: <?=$listItems[$curItem]["name"]?></div>
			<div style="color:#666666"><?=$curItem?> / <?=($count-1)?></div>
		</td>
		<td align="right"><?=$preLink?>&nbsp;&nbsp;<?=$nextLink?></td>
	</tr>
</table>
</body>
</html>
<?
}
?>