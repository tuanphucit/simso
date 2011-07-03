<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns()?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 100%; height: 200px; position:relative; border:0px">
			<table width="100%" cellspacing="0" cellpadding="0">
				<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td class="rowinfohead" nowrap width="40%">Language name:</td>
					<td width="90%" class="rowinfo"><input name="nname" size="20" maxlength="255" value="<?=$cur_name?>" readonly="1" class="textbox"></td>
				</tr>
				<tr>
					<td width="20%" class="rowinfohead">Flag: </td>
					<td width="80%" class="rowinfo"><img src="../<?=$flag?>" align="absmiddle" hspace="3" id="FLAG"><input type="file" name="image" value="<?=$cur_order?>" class="textbox" size="15" maxlength="200" style="display:none"></td>
				</tr>
				<tr>
					<td width="20%" class="rowinfohead">Directory name: </td>
					<td width="80%" class="rowinfo"><input name="dir" value="<?=$dir?>" class="textbox" size="20" maxlength="11" readonly="1"></td>
				</tr>
				<tr>
					<td width="20%" class="rowinfohead">Order: </td>
					<td width="80%" class="rowinfo"><input name="order" value="<?=$cur_order?>" class="textbox" size="5" maxlength="11" readonly="1"></td>
				</tr>
				<tr>
					<td width="20%" class="rowinfohead">View on the site: </td>
					<td width="80%" class="rowinfo"><input name="view" type="checkbox" <?=$cur_view?> value="1" disabled></td>
				</tr>
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				<input type="hidden" name="old_image" value="<?=$flag?>">
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
