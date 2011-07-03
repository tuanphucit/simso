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
					<td class="subPageTitle"><img src="<?="$_URL_BASE/$modIcon"?>" border="0" align="absmiddle"> &nbsp; <?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td style="color:#cd311a; font-size:14px; font-weight:bold">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td height="300" align="center" style="font-size:11px; color:#000099"><?=$define["var_banvuilongdangnhapdexemthongtin"]?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="right" height="30"><? require_once("$_HTML_DIR/buttons.php")?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>