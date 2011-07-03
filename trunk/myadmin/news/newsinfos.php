<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns(FORM_BLANK)?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table cellspacing="0" cellpadding="0" width="650">
				<tr height="30">
					<td nowrap width="20%" class="rowinfohead"><?=def_tendanhmuc?>:</td>
					<td width="80%" class="rowinfo" style="font-weight:bold"><?=$cur_name?></td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" valign="top" nowrap><?=def_ngaydang?>:</td>
					<td class="rowinfo"><?=$ndate?>&nbsp;</td>
				</tr>				
				<tr height="30">
					<td class="rowinfohead" valign="top" nowrap><?=def_anhminhhoa?>:</td>
					<td class="rowinfo"><img src="../<?=$image?>" border="0">&nbsp;</td>
				</tr>				
				<tr height="30">
					<td class="rowinfohead"><?=def_chuthichanh?>: </td>
					<td class="rowinfo"><?=$imgnote?>&nbsp;</td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap><?=def_hientrentrangchu?>: </td>
					<td class="rowinfo"><input name="istop" type="checkbox" <?=$istop?> value="1" disabled></td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap>Mẫu vật mới: </td>
					<td class="rowinfo"><input name="ihome" type="checkbox" <?=$ihome?> value="1" disabled></td>
				</tr>
				<tr height="30">
					<td class="rowinfohead"><?=def_luottruycap?>: </td>
					<td class="rowinfo"><?=$visited?>&nbsp;</td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap valign="top" style="padding-top:20px"><b><?=def_gioithieuqua?>:</b></td>
					<td class="rowinfo"><div><?=$shortdes?>&nbsp;</div></td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap valign="top" style="padding-top:20px"><b><?=def_noidungchitiet?>:</b></td>
					<td class="rowinfo"><div><?=$detail?>&nbsp;</div></td>
				</tr>
				<tr height="30">
					<td class="rowinfohead">Ngu&#7891;n: </td>
					<td class="rowinfo"><?=$source?>&nbsp;</td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
</table>
