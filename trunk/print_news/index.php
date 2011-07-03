<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

$contentFile = "includes/center_content.php";

if(!validGetVar($id))
{
	$conds = "language_id = '".$lang."' AND product3_view = 1";
	$others = "ORDER BY product3_order ASC LIMIT 1";
}
else
{
	$conds = "product3_id = '".$id."'";
	$others = NULL;
}
$sql->set_query("vnws_product3", "*", $conds, $others);
if($sql->set_farray())
{
	$itemName = $sql->farray["product3_name"];
	$itemShortDes = $sql->farray["product3_shortdes"];
	$itemImage = $sql->farray["product3_image"];
	$itemDetail = $sql->farray["product3_detail"];

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