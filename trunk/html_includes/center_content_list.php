<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td height="26px" class="subPageTitle" ><?=$subPageTitle?></td>
		</tr>
		<tr>
			<td style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y; padding-left:1px ">
				<table width="98%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="itemname" valign="top"><?=$contentDetail?></td>
					</tr>
					<tr height="37">
						<td width="100%" style="padding:0px 35px 10px 10px"><?=paging($tRows,$curPg,$maxRows,$curURL)?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top"><img src="<?=$_IMG_DIR?>/pagetitle_2.gif" border="0" /></td>
		</tr>
	</table>
