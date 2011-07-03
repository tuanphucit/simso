<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<table width="650" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="top" bgcolor="#FFFFFF" style="border:1px solid #EEEEEE">
			<table width="97%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td class="subPageTitle"><img src="<?=$modIcon?>" border="0" align="absmiddle">&nbsp;<?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td>
<?
if($isActive)
{
?>
						<table width="80%" height="300" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center"><?=$contentDetail?></td>
							</tr>
						</table>
<?
}
?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>
