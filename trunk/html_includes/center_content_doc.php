<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
function checkSearchForm()
{
	var myFrm = document.docSearchForm;
	//var cateId = myFrm.searchAlbum.value;
	//var keyWord = myFrm.searchKeyword.value;
	//keyWord = keyWord.replace(" ","_");
	//var actionFrm = '<?=$_URL_BASE?>/index.php/'+cateId+'/search';
	//if(keyWord != '') actionFrm += '/'+keyWord;
	//myFrm.action = actionFrm;
	//document.write(myFrm.action);
	myFrm.submit();
}
</script>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="top">
			<table width="92%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td style="background-image:url(<?=$_IMG_DIR?>/page_title.jpg);height:23px; color:#006404; font-family:tahoma; font-weight:bold; font-size:12px; background-repeat:no-repeat; font-family:tahoma; font-size:12px; padding-left:5px; padding-bottom:5px"><?=$define["var_dangduyet"]?>:<span style="font-weight:bold; padding-left:2px"><?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td align="center">
						<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0" style="border:1px solid #b2ebf6; background-color:#eafcff">
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
									<td align="right" valign="top" width="20%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_tungay"]?> : </td>
									<td align="left" width="30%" nowrap style="padding-left:5px; padding-bottom:5px">
										<input type="text" name="searchFromDate" value="<?=$searchFromDate?>" maxlength="200" style="width:167px; height:20px; border:1px solid #93b0ce"><br>
										<font style="color:#999999; font-size:11px">(dd/mm/yyyy)</font>
									</td>
									<td align="right" valign="top" width="10%" nowrap style="font-size:11px; padding-top:2px"><?=$define["var_denngay"]?> : </td>
									<td align="left" width="40%" nowrap style="padding-left:5px; padding-bottom:5px">
										<input type="text" name="searchToDate" value="<?=$searchToDate?>" maxlength="200" style="width:167px; height:20px; border:1px solid #93b0ce"><br>
										<font style="color:#999999; font-size:11px">(dd/mm/yyyy)</font>
									</td>
								</tr>
								<tr>
									<td height="5" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" width="20%" nowrap style="font-size:11px"><?=$define["var_linhvuc"]?> : </td>
									<td align="left" width="80%" nowrap style="padding-left:5px" colspan="3">
										<select name="searchDocArea" style="width:418; height:20px; border:1px solid #93b0ce"><?=$docAreaSels?></select>
									</td>
								</tr>
								<tr>
									<td height="5" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" width="20%" nowrap style="font-size:11px"><?=$define["var_loaivanban"]?> : </td>
									<td align="left" width="80%" nowrap style="padding-left:5px" colspan="3">
										<select name="searchDocType" style="width:418; height:20px; border:1px solid #93b0ce"><?=$docTypeSels?></select>
									</td>
								</tr>
								<tr>
									<td height="5" colspan="4"></td>
								</tr>
								<tr>
									<td align="right" width="20%" nowrap style="font-size:11px"><?=$define["var_noibanhanh"]?> : </td>
									<td align="left" width="80%" nowrap style="padding-left:5px" colspan="3">
										<select name="searchDocProm" style="width:418; height:20px; border:1px solid #93b0ce"><?=$docPromSels?></select>
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
