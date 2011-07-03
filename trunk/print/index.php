<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

$contentFile = "includes/center_content.php";

if(!validGetVar($id))
{
	$conds = "language_id = '".$lang."' AND news_view = 1";
	$others = "ORDER BY news_order ASC LIMIT 1";
}
else
{
	$conds = "news_id = '".$id."'";
	$others = NULL;
}
$sql->set_query("vot_news", "*", $conds, $others);
if($sql->set_farray())
{
	$itemName = $sql->farray["news_name"];
	$itemShortDes = $sql->farray["news_shortdes"];
	$itemImage = $sql->farray["news_image"];
	$itemDetail = $sql->farray["news_detail"];

	$contentTitle = $itemName;
	if(is_file("$_ROOT_PATH/$itemImage"))
	{
		$imgSrc = "$_URL_BASE/$itemImage";
		$contentDetail .= "<img src=\"$imgSrc\" align=\"left\" style=\"margin:5px 7px 3px 0px\">";
	}
	$contentDetail .= '<p id="mainContentShordes">'.$itemShortDes.'</p>';
	$contentDetail .= '<p id="mainContentDetail" style="padding-top:5px">'.$itemDetail.'</p>';
}

require_once("$contentFile");
?>