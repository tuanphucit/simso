<div id="HEADPAGE">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<tr>
		<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left"><?=$pageTitle?></td>
	</tr>
	<tr>
		<td class="headlink" nowrap valign="bottom"><?=$linkPath?></td>
		<td align="right"><?=global_btns(EDIT_PAGE)?></td>		
	</tr>
</table>
</div>
<div id="MAIN" class="maindiv" style="width: 100%; height: 200px; position:relative">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<form name="frmEdit" action="<?=$url?>&action=update" method="post" enctype="multipart/form-data">
  <tr>
    <td valign="top">
			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="adminform">
				<tr>
					<td width="100%" colspan="2" class="headform"><?=def_thongtin?></td>
				</tr>
				<tr>
					<td width="10%" class="rowform"><?=def_tendanhmuc?>: </td>
					<td width="90%" class="rowform">
						<input name="nname" type="text" size="50" maxlength="255" value="<?=$name?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td class="rowform"><?=def_ngaydang?>: </td>
					<td class="rowform">
						<input name="ndate" type="text" size="15" maxlength="20" value="<?=$ndate?>" class="textbox"> 
					</td>
				</tr>
				<tr>
					<td class="rowform" valign="top"><?=def_anhminhhoa?>: </td>
					<td class="rowform"><input type="file" name="image" class="textbox" size="45"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_chuthichanh?>: </td>
					<td class="rowform"><input type="text" name="imgnote" size="60" value="<?=$imgnote?>" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowform" nowrap><?=def_hientrentrangchu?>: </td>
					<td class="rowform"><input name="istop" type="checkbox" <?=$istop?> value="1" onClick="checkLimited(this)"></td>
				</tr>
				<tr>
					<td class="rowform" nowrap>Mẫu vật mới: </td>
					<td class="rowform"><input name="ihome" type="checkbox" <?=$ihome?> value="1" onClick="checkLimited(this)"></td>
				</tr>
				<tr>
					<td class="rowform" valign="top" style="padding-top: 50px"><?=def_gioithieuqua?>: </td>
					<td class="rowform"><?=$oFCKeditor_1->Create()?></td>
				</tr>
				<tr>
					<td class="rowform" valign="top" style="padding-top: 50px"><?=def_noidungchitiet?>: </td>
					<td class="rowform"><?=$oFCKeditor_2->Create()?></td>
				</tr>
				<tr>
					<td class="rowform">Ngu&#7891;n: </td>
					<td class="rowform"><input type="text" name="source" size="50" value="<?=$source?>" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_luottruycap?>: </td>
					<td class="rowform"><input name="visited" type="text" value="<?=$visited?>" class="textbox" size="5" maxlength="15"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_thutu?>: </td>
					<td class="rowform"><input name="order" type="text" value="<?=$order?>" class="textbox" size="5" maxlength="11"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_hien?>: </td>
					<td class="rowform"><input name="view" type="checkbox" <?=$view?> value="1"></td>
				</tr>
				<input type="hidden" name="myshortdes">
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				<input type="hidden" name="KWD" value="<?=$KWD?>">
				<input type="hidden" name="old_image" value="<?=$image?>">
			</table>
		</td>
  </tr>
	</form>
</table>
</div>