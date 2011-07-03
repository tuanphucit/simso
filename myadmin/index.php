<?
include_once("includes/global.php");
include_once("includes/chksession.php");

@$SEARCH = (_POST("SEARCH")) ? _POST("SEARCH") : _SESSION("SEARCH");

$sql = new mysql();
if($sql->mysql()) 
{
	$opt = new option();
	$myOpt = new option();
}

$LANG = (_POST("LANG")!=NULL) ? _POST("LANG") : _SESSION("LANG");
if($sql->mysql() && !$LANG) 
{
	$conds = "language_view = 1";
	$others = "ORDER BY language_order ASC LIMIT 1";
	$LANG = $myOpt->optionvalue("vot_language", "language_id", $conds, $others);
}
$conds = "language_id = '".$LANG."'";
$LANG_DIR = $myOpt->optionvalue("vot_language", "language_dir", $conds, $others);
_SESSION_REGISTER("LANG");
_SESSION_REGISTER("LANG_DIR");
?>
<html>
<head>
	<title>Administration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>">
	<meta http-equiv="expires" content="0">
	<meta name="resource" content="document">
	<meta name="distribution" content="global">
	<script language="JavaScript" src="<?=$_JS_DIR?>/common.js"></script>
	<script language="JavaScript" src="<?=$_JS_DIR?>/functions.js"></script>
	<script language="javascript" src="<?=$_JS_DIR?>/vietuni.js"></script>
	<script language="javascript" src="<?=$_JS_DIR?>/AjaxRequest.js"></script>
	<script language=JavaScript src='Editor/scripts/innovaeditor.js'></script>
	<style type="text/css">@import url("<?=$_CSS_DIR?>/style.css");</style>
</head>
<body id="MYPAGE" style="position:relative">
<table width="100%" height="100%" cellpadding=0 cellspacing=0 align="center" bgcolor="#FFFFFF">
	<tr><td colspan="2"><? include("html_includes/banner.php");?></td></tr>
	<tr>
		<td width="180" align="center" valign="top" height="100%"><? include("html_includes/menu.php");?></td>
		<td width="100%" align="right" valign="top" height="100%"><? include_once($file)?></td>
	</tr>
	<tr><td colspan="2" bgcolor="#FFFFFF"><? include("html_includes/footer.html");?></td></tr>
</table>
<script language="javascript">setSizeDiv()</script>
<!--
<?
if(!$item)
{
	$curMod = $module;
}
else 
{
	$curMod = $item;
}
if($CURMOD != NULL || $curModule != NULL)
{
	$curMod = 'modules';
}
?>
<script language="javascript">getCurrentModule('<?=$curMod?>')</script>
-->
</body>
</html>