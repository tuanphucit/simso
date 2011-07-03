<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<html>
<head>
	<title><?=$siteTitle?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>" />
	<meta name="keywords" content="<?=$config["site_keywords"]?>" />
	<meta name="description" content="<?=$config["site_description"]?>" />
	<style type="text/css">@import url("<?=$_CSS_DIR?>/style.css");</style>
</head>
<body>
<table align="center" width="90%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="centerTitle"><?=$contentTitle1?></td>
	</tr>
	<tr>
		<td class="centerContent"><?=$contentDetail?></td>
	</tr>
	<tr>
		<td height="25" align="right">
			<a href="javascript:window.print()">
				<img src="<?=$_IMG_DIR?>/icon_printer.png" width="14" height="12" border="0" alt="<?=$define["var_inbantin"]?>" id="printIcon" style="position:relative">
			</a>
		</td>
	</tr>
</table>
<script language="javascript">
	window.scrollTo(0,printIcon.offsetTop);
</script>
</body>
</html>