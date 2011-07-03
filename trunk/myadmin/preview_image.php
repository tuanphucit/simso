<?
include_once("includes/functions.php");

$src = _POST("src");

if(is_file($src))
{
	$imgSize = getimagesize($src);
}
if(!$imgSize)
{
	$imgSize = array(200,200);
}
?>
<table align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<img border="0" src="<?=$src?>" width="<?=$imgSize[0]?>" height="<?=$imgSize[1]?>">
		</td>
	</tr>
</table>