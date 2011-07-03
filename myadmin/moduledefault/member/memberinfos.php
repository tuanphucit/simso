<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns()?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table width="100%" cellspacing="0" cellpadding="0">
				<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td class="rowinfohead" nowrap width="25%">H&#7885; & T&#234;n:</td>
					<td width="75%" class="rowinfo">
						<input type="text" name="nname" size="25" maxlength="255" value="<?=$cur_name?>" readonly="1" class="textbox">
					</td>
				</tr>
				<tr>
					<td class="rowinfohead">Email: </td>
					<td class="rowinfo"><input type="text" name="email" size="35" maxlength="255" value="<?=$email?>" readonly="1" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowinfohead">Password: </td>
					<td class="rowinfo"><input type="password" name="pwd" size="15" maxlength="255" value="<?=$pwd?>" readonly="1" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowinfohead">C&#417; quan: </td>
					<td class="rowinfo"><input type="text" name="org" size="35" maxlength="255" value="<?=$org?>" readonly="1" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowinfohead">&#272;&#7883;a ch&#7881;: </td>
					<td class="rowinfo"><input type="text" name="add" size="35" maxlength="255" value="<?=$add?>" readonly="1" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowinfohead">&#272;i&#7879;n tho&#7841;i: </td>
					<td class="rowinfo"><input type="text" name="tel" size="15" maxlength="255" value="<?=$tel?>" readonly="1" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowinfohead">Ng&#224;y &#273;&#259;ng k&#253;: </td>
					<td class="rowinfo"><input type="text" name="ndate" size="15" maxlength="255" value="<?=$ndate?>" readonly="1" class="textbox"></td>
				</tr>
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
