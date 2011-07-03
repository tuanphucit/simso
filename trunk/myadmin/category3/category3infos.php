<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns()?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table width="100%" cellspacing="0" cellpadding="0">
				<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td class="rowinfohead" nowrap width="30%"><b>Category name:</b></td>
					<td width="70%" class="rowinfo"><input type="text" name="nname" size="37" maxlength="255" value="<?=$cur_name?>" readonly="1" class="textbox"></td>
				</tr>
				
				<!--<tr height="30">
					<td class="rowinfohead" valign="top" nowrap>Category shortdes:</td>
					<td class="rowinfo"><textarea cols="35" rows="10" name="short" readonly="1" class="textbox"><?=$cur_short?></textarea></td>
				</tr>-->
				<tr height="30">
					<td class="rowinfohead" nowrap><b>V&#7883; tr&#237;:</b></td>
					<td class="rowinfo">
						<select name="istop" disabled>
							<option value="0" selected>trang tin</option>
							<option value="1">Tin n&#7893;i b&#7853;t</option>
							<option value="2">Tin m&#7899;i nh&#7845;t</option>
						</select>
						<script language="javascript">document.frmEdit.istop.value ='<?=$cur_istop?>'</script>
					</td>
				</tr>
		
				<!--<tr>
					<td class="rowinfohead">Hi&#7879;n trang ch&#7911;: </td>
					<td class="rowinfo"><input name="istop" type="checkbox" <?//=$istop?> value="1" disabled></td>
				</tr>-->
				
				<tr>
					<td class="rowinfohead"><?=def_thutu?>: </td>
					<td class="rowinfo"><input name="order" type="text" value="<?=$cur_order?>" class="textbox" size="5" maxlength="11" readonly="1"></td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_hien?>: </td>
					<td class="rowinfo"><input name="view" type="checkbox" <?=$cur_view?> value="1" disabled></td>
				</tr>
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
