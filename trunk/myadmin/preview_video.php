<?
include_once("includes/functions.php");

$videoFile = _POST("videoFile");

if(is_file($videoFile))
{
?>
<table align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center">
			<object width="320" height="290" name="VIDEOPLAYER">
				<param name="seek" value="1">
				<embed src="<?=$videoFile?>" autostart="true" loop="false"></embed>
			</object>
		</td>
	</tr>
</table>
<?
}
?>