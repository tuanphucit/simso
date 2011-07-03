<?
session_start();
session_cache_expire(480);

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

$src = _POST("imgSrc");
$orgImg = _POST("orgImg");
//$product3Name = _POST("Name");
//$product3Des = _POST("shost");
$product3Id =_POST("Id");

$conds = "language_id = $lang AND product3_id = '".$product3Id."'";
$product3Des = $opt->optionvalue("vnws_product3", "product3_shortdes", $conds);

$condss = "language_id = $lang AND product3_id = '".$product3Id."'";
$product3Name = $opt->optionvalue("vnws_product3", "product3_name", $condss);

$imageMaxW = 270;
$imageMaxH = 184;
if(is_file("$_ROOT_PATH/$src"))
{
	$imgSize = imageSize("$_ROOT_PATH/$src", $imageMaxW, $imageMaxH);
	$product3Img = "<img src=\"$_URL_BASE/$src\" width=\"$imgSize[0]\" height=\"$imgSize[1]\" border=\"0\" align=\"center\" style=\"margin:4px 10px 3px 0px\">";
}
else
{
	$product3Img = NULL;
}
$url = "$_URL_BASE/$orgImg";
?>
<html>
<head>
	<title><?=$siteTitle?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>" />
	<meta name="keywords" content="<?=$config["site_keywords"]?>" />
	<meta name="description" content="<?=$config["site_description"]?>" />
	<meta name="robots" content="all" />
	<meta name="googlebot" content="all" />
	<meta name="verify-v1" content="6jXfqc0uvQlepRo0Z64q9RH+6hudHAGXxXsh6TNv+Qs=" />
	<link rel="shortcut icon" href="images/vot_icon.ico" type="image/x-icon" />
</head>
<style type="text/css">@import url("<?=$_CSS_DIR?>/style.css");</style>
<style type="text/css">@import url("<?=$_CSS_DIR?>/modalbox.css");</style>
<script language="javascript" src="<?=$_JS_DIR?>/AjaxRequest.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/functions.js"></script>
<script language="JavaScript" src="<?=$_JS_DIR?>/milonic/milonic_src.js" type="text/javascript"></script>
<script language="JavaScript" src="<?=$_JS_DIR?>/milonic/mmenudom.js" type="text/javascript"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/prototype.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/scriptaculous.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/modalbox.js"></script>
<script language="javascript 1.2" src="<?=$_JS_DIR?>/scroller.js" type="text/javascript"></script>
<table cellpadding="0" cellspacing="0" border="0" align="center" style="margin-top:3px; margin-right:2px">
	<tr><td style="background-image:url(<?=$_IMG_DIR?>/viewphoto9.jpg); background-repeat:no-repeat">
		<div align="center"><a  href="<?=$_URL_BASE?>/news_events/detail/?id=<?=$product3Id?>"><?=$product3Img?></a></div>
	    <div style="color:#9A3604; font-weight:bold;text-align:justify"><a style="color:#9A3604; font-weight:bold;text-align:justify" href="<?=$_URL_BASE?>/news_events/detail/?id=<?=$product3Id?>"><?=$product3Name?></a></div>
	    <div style="color:#000000; text-align:justify"><?=$product3Des?></div>
		</td>
	</tr>
</table>
</body>
</html>
