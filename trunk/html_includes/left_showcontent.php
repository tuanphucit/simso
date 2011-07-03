<?
session_start();
session_cache_expire(480);

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

 $src = _POST("imgSrc");
 $newsImg = _POST("orgImg");
//$newsName = _POST("Name");
//$newsDes = _POST("shost");
$newsId =_POST("Id");

$conds = "language_id = $lang AND news_id = '".$newsId."'";
$newsDes = $opt->optionvalue("vot_news", "news_shortdes", $conds);

$condss = "language_id = $lang AND news_id = '".$newsId."'";
$newsName = $opt->optionvalue("vot_news", "news_name", $condss);

$infoCateId = $opt->optionvalue("vot_news", "modules_id", $condss);
$sLink = "$_URL_BASE/index.php/$infoCateId/$newsId/".str_replace(" ", "_", $newsName);
$imageMaxW = 270;
$imageMaxH = 184;
if(is_file("$_ROOT_PATH/$src"))
{
	$imgSize = imageSize("$_ROOT_PATH/$src", $imageMaxW, $imageMaxH);
	$newsImg = "<img src=\"$_URL_BASE/$src\" width=\"270\" border=\"0\" align=\"center\" style=\"margin:4px 0px 2px 0px; border:2px solid #BBBBBB\">";
}
else
{
	$newsImg = NULL;
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
		<div><a href="<?=$sLink?>"><?=$newsImg?></a></div>
	    <div style="color:#9A3604; font-weight:bold;text-align:justify;"><a style="color:#9A3604; font-weight:bold;text-align:justify" href="<?=$sLink?>"><?=$newsName?></a></div>
	    <div style="color:#000000; text-align:justify"><?=$newsDes?></div>
		</td>
	</tr>
</table>
</body>
</html>
