<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns(FORM_BLANK)?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table cellspacing="0" cellpadding="0" width="650">
				<tr height="30">
					<td nowrap width="20%" class="rowinfohead">S&#7889; Sim:</td>
					<td width="80%" class="rowinfo" style="font-weight:bold"><?=$cur_name?></td>
				</tr>
				<tr height="30">
					<td nowrap width="20%" class="rowinfohead">Gi&#225; nh&#7853;p:</td>
					<td width="80%" class="rowinfo" style="font-weight:bold"><?=$gianhap?>VN&#272;</td>
				</tr>
				<tr height="30">
					<td nowrap width="20%" class="rowinfohead">Gi&#225; xu&#7845;t:</td>
					<td width="80%" class="rowinfo" style="font-weight:bold"><?=$giaxuat?>VN&#272;</td>
				</tr>
				<tr height="30">
					<td nowrap width="20%" class="rowinfohead">T&#224;i kho&#7843;n:</td>
					<td width="80%" class="rowinfo" style="font-weight:bold"><?=$taikhoan?>VN&#272;</td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" valign="top" nowrap>Kho:</td>
					<td class="rowinfo"><?=$kho?>&nbsp;</td>
				</tr>				
				<tr height="30">
					<td class="rowform" nowrap><?=def_hientrentrangchu?>: </td>
					<td class="rowform"><input name="ihome" type="checkbox" <?=$ihome?> value="1" disabled></td>
				</tr>
				<tr height="30">
					<td class="rowform" nowrap>Sim Vip: </td>
					<td class="rowform"><input name="ihight" type="checkbox" <?=$ihight?> value="1" disabled></td>
				</tr>
				<tr height="30">
					<td class="rowform" nowrap><?=def_hien?>: </td>
					<td class="rowform"><input name="view" type="checkbox" <?=$view?> value="1" disabled></td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
</table>
