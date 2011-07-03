<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
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
					<td height="7"></td>
				</tr>
				<tr>
					<td align="center">
						<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" style="border:0px solid #b2ebf6; background-color:#eafcff">
							<form name="docSearchForm" method="post">
								<tr>
									<td height="15" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" width="20%" nowrap style="font-size:11px"><?=$define["var_tukhoa"]?> : </td>
									<td align="left" width="80%" nowrap style="padding-left:5px" colspan="3">
										<input type="text" name="searchKeyword" value="<?=$searchKeyword?>" maxlength="200" style="width:337px; height:20px; border:1px solid #93b0ce">&nbsp;&nbsp;
										<button type="button" name="sbmtBtn" onClick="checkSearchForm()"><?=$define["var_tracuu"]?></button>
									</td>
								</tr>
								<tr>
									<td height="5" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" width="20%" nowrap style="padding-right:5px; font-size:11px"></td>
									<td align="left" width="80%" nowrap style="font-size:11px" colspan="3">
										<input type="checkbox" name="searchExact" <?=$searchExactChecked?> value="1"> <?=$define["var_chinhxactukhoa"]?>
									</td>
								</tr>
								<tr>
									<td height="7" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="20%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_dientichtu"]?> : </td>
									<td align="left" width="30%" nowrap style="padding-left:5px; padding-bottom:5px; font-size:11px">
										<input type="text" name="searchFromArea" value="<?=$searchFromArea?>" maxlength="200" style="width:153px; height:20px; border:1px solid #93b0ce">&nbsp;(m<sup>2</sup>)
									</td>
									<td align="right" valign="top" width="10%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_den"]?> : </td>
									<td align="left" width="40%" nowrap style="padding-left:5px; padding-bottom:5px; font-size:11px">
										<input type="text" name="searchToArea" value="<?=$searchToArea?>" maxlength="200" style="width:153px; height:20px; border:1px solid #93b0ce">&nbsp;(m<sup>2</sup>)
									</td>
								</tr>
								<tr>
									<td height="5" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="20%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_giathuetu"]?> : </td>
									<td align="left" width="30%" nowrap style="padding-left:5px; padding-bottom:5px; font-size:11px">
										<input type="text" name="searchFromPrice" value="<?=$searchFromPrice?>" maxlength="200" style="width:153px; height:20px; border:1px solid #93b0ce">&nbsp;(<?=$define["var_trieu"]?>/m<sup>2</sup>)
									</td>
									<td align="right" valign="top" width="10%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_den"]?> : </td>
									<td align="left" width="40%" nowrap style="padding-left:5px; padding-bottom:5px; font-size:11px">
										<input type="text" name="searchToPrice" value="<?=$searchToPrice?>" maxlength="200" style="width:153px; height:20px; border:1px solid #93b0ce">&nbsp;(<?=$define["var_trieu"]?>/m<sup>2</sup>)
									</td>
								</tr>
								<tr>
									<td height="5" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" valign="top" width="20%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_loaiBDS"]?> : </td>
									<td align="left" width="30%" nowrap style="padding-left:5px; padding-bottom:5px; font-size:11px">
										<select name="searchRType" style="width:153px; height:20px; border:1px solid #93b0ce"><?=$rTypeSels?></select>
									</td>
									<td align="right" valign="top" width="10%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_huongnha"]?> : </td>
									<td align="left" width="40%" nowrap style="padding-left:5px; padding-bottom:5px; font-size:11px">
										<select name="searchRAspect" style="width:153px; height:20px; border:1px solid #93b0ce"><?=$rAspectSels?></select>
									</td>
								</tr>
								<tr>
									<td height="5" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" width="20%" nowrap style="font-size:11px"><?=$define["var_khuvuc"]?> : </td>
									<td align="left" width="80%" nowrap style="padding-left:5px" colspan="3">
										<select name="searchRPlace" style="width:418; height:20px; border:1px solid #93b0ce"><?=$rPlaceSels?></select>
									</td>
								</tr>
								<tr>
									<td height="15" colspan="4"></td>
								</tr>
							</form>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="padding:5px 5px 5px 10px; color:#FF0000; font-size:11px"><?=$define["var_coketquaduoctimthay"]?> : <strong><?=$searchResult?></strong></td>
				</tr>
				<tr>
					<td class="centerContent" valign="top"><?=$contentDetail?></td>
				</tr>
<?
if($tRows > 0)
{
?>
				<tr height="37">
					<td width="100%"><?=paging($tRows,$curPg,$maxRows,$curURL)?></td>
				</tr>
<?
}
?>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>