<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns()?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 100%; height: 200px; position:relative; border:0px">
			<table width="100%" cellspacing="0" cellpadding="0">
				<form action="index.php?module=users&action=update" name="frmEdit" method="post">
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td class="rowinfohead" nowrap width="40%"><b>Username:</b></td>
					<td width="90%" class="rowinfo"><input type="text" name="USER" size="20" maxlength="20" value="<?=$cur_user?>" readonly="1" class="textbox"></td>
				</tr>
				<tr height="30" style="display:none" id="NPWD">
					<td class="rowinfohead" nowrap>Password<font color="#FF3300">*</font>:</td>
					<td class="rowinfo"><input type="password" name="PWD" size="15" class="textbox" maxlength="15"></td>
				</tr>
				<tr height="30" style="display:none" id="RPWD">
					<td class="rowinfohead" nowrap>Re-password<font color="#FF3300">*</font>:</td>
					<td class="rowinfo"><input type="password" name="REPWD" size="15" class="textbox" maxlength="15"></td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap>Full name<font color="#FF3300">*</font>:</td>
					<td width="90%" class="rowinfo"><input type="text" name="FNAME" size="<?=$sizeBox?>" value="<?=$fname?>" class="textbox" readonly="1" onKeyUp="telexingVietUC(this)"></td>
				</tr>
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td height="95" nowrap class="rowinfohead">Permission:</td>
					<td nowrap class="rowinfo">
						<table cellpadding="5" cellspacing="0" width="100%">
							<tr>
								<td align="center" valign="top" width="25%"><input type="checkbox" name="canDo" <?=$permChked["cEdit"]?> disabled onClick="checkClick()"><br><?=btn_edit?></td>
								<td align="center" valign="top" width="25%"><input type="checkbox" name="canDo" <?=$permChked["cAdd"]?> disabled onClick="checkClick()"><br><?=btn_add?></td>
								<td align="center" valign="top" width="25%"><input type="checkbox" name="canDo" <?=$permChked["cDel"]?> disabled onClick="checkClick()"><br><?=btn_del?></td>
								<td align="center" valign="top" width="25%"><input type="checkbox" name="canDo" <?=$permChked["cUser"]?> disabled><br><?=def_qluser?></td>
							</tr>
						</table>
					</td>
				</tr>
				<input type="hidden" name="PERM">
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				<input type="hidden" name="curPg" value="<?=$curPg?>">							
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
