<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns()?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
				<table width="100%" cellspacing="0" cellpadding="0">
					<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
					<tr>
						<td class="rowinfohead" nowrap width="30%"><b><?=def_tendanhmuc?>:</b></td>
						<td width="70%" class="rowinfo">
							<input type="text" name="nname" size="20" maxlength="255" value="<?=$cur_name?>" readonly="1" class="textbox">
							<font color="#FF3300">*</font>
						</td>
					</tr>
<?
if($curLevel < 1)
{
?>
					<tr>
						<td class="rowinfohead" nowrap width="30%">Cho hi&#7875;n th&#7883; t&#7841;i:</td>
						<td width="70%" class="rowinfo">
							<div><input type="checkbox" name="pos" <?=$checked[$pos0]?> value="1" disabled> Menu ngang ch&#237;nh</div>
							<div><input type="checkbox" name="pos" <?=$checked[$pos1]?> value="1" disabled> Menu d&#7885;c b&#234;n tr&#225;i</div>
							<div><input type="checkbox" name="pos" <?=$checked[$pos2]?> value="1" disabled> Th&#7889;ng k&#234;</div>
							<div><input type="checkbox" name="pos" <?=$checked[$pos3]?> value="1" disabled> Menu Bottom</div>
						</td>
					</tr>
					
<?
}
?>
					<tr>
						<td class="rowinfohead" nowrap width="30%">Cho hi&#7875;n th&#7883; :</td>
						<td width="70%" class="rowinfo">
							<div><input name="cap" type="checkbox" <?=$cur_cap?> value="1" disabled><!--<input type="text" name="cap" size="17" maxlength="255" value="<?=$cur_cap?>" readonly="1" class="textbox">-->không cho hiển thị Cấp Con</div>
						</td>
					</tr>
					<tr>
						<td class="rowinfohead" nowrap width="30%">Ch&#7913;a nh&#243;m con:</td>
						<td width="70%" class="rowinfo">
							<select name="modsub" disabled>
								<option value="1">Ch&#7913;a nh&#243;m con</option>
								<option value="0">Kh&#244;ng ch&#7913;a nh&#243;m con</option>
							</select>
							<script language="javascript">document.frmEdit.modsub.value = '<?=$cur_modsub?>';</script>
						</td>
					</tr>
					<tr>
						<td class="rowinfohead" nowrap width="30%"><?=def_thuocloaimodule?>:</td>
						<td width="70%" class="rowinfo">
							<select name="motype" disabled><?=$opt->optionselected($cur_motype,"--".def_chon."--","vot_moduletypes","moduletypes_source","moduletypes_name")?></select>
						</td>
					</tr>
<?
	if($parentModPer == 0)
	{
?>
					<tr>
						<td class="rowinfohead" nowrap width="30%">&#272;&#7889;i t&#432;&#7907;ng xem:</td>
						<td width="70%" class="rowinfo">
							<select name="modper" disabled>
								<option value="0">T&#7845;t c&#7843;</option>
								<option value="1">D&#224;nh cho c&#225;c th&#224;nh vi&#234;n</option>
							</select>
							<script language="javascript">document.frmEdit.modper.value = '<?=$cur_modper?>';</script>
						</td>
					</tr>
<?
	}
?>
					<tr>
						<td class="rowinfohead"><?=def_anhminhhoa?>: </td>
						<td class="rowinfo">
						<?
						 if($icon <> NULL)
						 {
						?>
							<div id="CURICON"><img src="<?=$_URL_BASE?>/<?=$icon?>" border="0"></div>
							<div id="cbRemoveImage"><input type="checkbox" name="cbRemoveImage" value="1"><label for="remove small image">&#272;ánh d&#7845;u ch&#7885;n &#273;&#7875; xóa hình &#7843;nh mô t&#7843;</label></div>
						<?
						}
						?>	
							<div><input type="file" name="icon" size="20" class="textbox" style="display:none; margin-top:10px"></div>
						</td>
					</tr>
					<!--<tr>
						<td class="rowinfohead" nowrap width="30%"><b><?=def_shortdes?>:</b></td>
						<td width="70%" class="rowinfo">
							<textarea cols="35" rows="10" name="short" readonly="1" class="textbox"><?=$cur_short?></textarea><br />
							<font color="#FF3300">(Ch&#7881; nh&#7853;p cho menu d&#7885;c b&#234;n ph&#7843;i)</font>
						</td>
					</tr>-->
	
					<tr>
						<td class="rowinfohead" nowrap width="30%"><b><?=def_duongdan?>:</b></td>
						<td width="70%" class="rowinfo">
							<input type="text" name="linkto" size="25" maxlength="255" value="<?=$linkto?>" readonly="1" class="textbox">
							<font color="#FF3300">*</font>
						</td>
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
					<input type="hidden" name="old_icon" value="<?=$icon?>">
					<input type="hidden" name="modpos" value="<?=$modpos?>">
					</form>
				</table>
			</div>
		</td>
	</tr>
</table>
<script language="javascript">//changeModType()</script>