<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<table align="center" width="450" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="blockTitle">
			<img src="<?=$_IMG_DIR?>/title/tim_kiem_<?=$curLang?>.jpg" border="0" alt="">
		</td>
	</tr>
<?
if($contentTitle)
{
?>
	<tr>
		<td class="centerTitle"><?=$contentTitle?></td>
	</tr>
<?
	$centerHeight = 354;
}
else
{
	$centerHeight = 380;
}
?>
	<tr>
		<td class="centerContent">
			<div id="centerContent" style="height:<?=$centerHeight?>px"><?=$contentDetail?></div>
		</td>
	</tr>
<?
if($tRows > 0)
{
?>
	<tr height="30">
		<td width="100%" style="padding-top:5px"><?=paging($tRows,$curPg,$maxRows,"tim_kiem/?frmKeyword=".utf8_encode($frmKeyword))?></td>
	</tr>
<?
}
?>
</table>