<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns(FORM_BLANK)?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table cellspacing="0" cellpadding="0" width="650">
				<tr height="30">
					<td nowrap width="130" class="rowinfohead">Item ID:</td>
					<td class="rowinfo" style="font-weight:bold"><?=$htmlId?>&nbsp;</td>
				</tr>
				<tr height="30">
					<td nowrap width="130" class="rowinfohead">Item name:</td>
					<td class="rowinfo" style="font-weight:bold"><?=$cur_name?>&nbsp;</td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap><b>Item type:</b></td>
					<td class="rowinfo">
						<select name="cate" disabled>
							<option value="0" selected>Content of page</option>
							<option value="1">A part of page</option>
						</select>
						<script language="javascript">document.all["cate"].value = '<?=$cate?>'</script>
					</td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap valign="top" style="padding-top:15px; padding-bottom:15px"><b><?=def_noidung?>:</b></td>
					<td class="rowinfo"><div><?=$detail?>&nbsp;</div></td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
</table>
