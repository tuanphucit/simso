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
					<td class="rowform"><?=def_gia?>: </td>
					<td class="rowform">
						<input name="price" type="text" size="15" maxlength="20" value="<?=$price?>" class="textbox"> (<?=def_trieudong?>)
					</td>
				</tr>
				<tr>
					<td class="rowform"><?=def_dientich?>: </td>
					<td class="rowform">
						<input name="area" type="text" size="15" maxlength="20" value="<?=$area?>" class="textbox">  (<?=def_metvuong?>)
					</td>
				</tr>
				<tr>
					<td class="rowform" valign="top"><?=def_anhminhhoa?> 1: </td>
					<td class="rowform"><input type="file" name="image1" class="textbox" size="45"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_chuthichanh?> 1: </td>
					<td class="rowform"><input type="text" name="imgnote1" size="45" value="<?=$imgnote1?>" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowform" valign="top"><?=def_anhminhhoa?> 2: </td>
					<td class="rowform"><input type="file" name="image2" class="textbox" size="45"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_chuthichanh?> 2: </td>
					<td class="rowform"><input type="text" name="imgnote2" size="45" value="<?=$imgnote2?>" class="textbox"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_loaibatdongsan?>: </td>
					<td class="rowform">
						<select name="rType"><?=$rTypeSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addRType(); return false"><?=btn_add?></a> | <a href="#" onClick="editRType(); return false"><?=btn_edit?></a> | <a href="#" onClick="delRType(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowform"><?=def_huongnha?>: </td>
					<td class="rowform">
						<select name="rAspect"><?=$rAspectSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addRAspect(); return false"><?=btn_add?></a> | <a href="#" onClick="editRAspect(); return false"><?=btn_edit?></a> | <a href="#" onClick="delRAspect(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowform"><?=def_khuvuc?>: </td>
					<td class="rowform">
						<select name="rPlace"><?=$rPlaceSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addRPlace(); return false"><?=btn_add?></a> | <a href="#" onClick="editRPlace(); return false"><?=btn_edit?></a> | <a href="#" onClick="delRPlace(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowform"><?=def_luottruycap?>: </td>
					<td class="rowform"><input name="show" type="text" value="<?=$show?>" class="textbox" size="5" maxlength="15"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_thutu?>: </td>
					<td class="rowform"><input name="order" type="text" value="<?=$order?>" class="textbox" size="5" maxlength="11"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_hien?>: </td>
					<td class="rowform"><input name="view" type="checkbox" <?=$view?> value="1"></td>
				</tr>
				<tr>
					<td class="rowform" valign="top" style="padding-top: 50px"><?=def_gioithieuqua?>: </td>
					<td class="rowform"><?=$oFCKeditor->Create()?></td>
				</tr>
				<input type="hidden" name="myshortdes">
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				<input type="hidden" name="KWD" value="<?=$KWD?>">
				<input type="hidden" name="old_thumb1" value="<?=$thumb1?>">
				<input type="hidden" name="old_image1" value="<?=$image1?>">
				<input type="hidden" name="old_thumb2" value="<?=$thumb2?>">
				<input type="hidden" name="old_image2" value="<?=$image2?>">
			</table>
		</td>
  </tr>
	</form>
</table>
</div>