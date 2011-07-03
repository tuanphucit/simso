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
					<td width="10%" class="rowform">S&#7889; Sim: </td>
					<td width="90%" class="rowform">
						<input name="nname" type="text" size="50" maxlength="255" value="<?=$name?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td width="10%" class="rowform">Gi&#225; nh&#7853;p: </td>
					<td width="90%" class="rowform">
						<input name="gianhap" type="text" size="50" maxlength="255" value="<?=$gianhap?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td width="10%" class="rowform">Gi&#225; xu&#7845;t: </td>
					<td width="90%" class="rowform">
						<input name="giaxuat" type="text" size="50" maxlength="255" value="<?=$giaxuat?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td width="10%" class="rowform">T&#224;i kho&#7843;n: </td>
					<td width="90%" class="rowform">
						<input name="taikhoan" type="text" size="50" maxlength="255" value="<?=$taikhoan?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td width="10%" class="rowform">Kho: </td>
					<td width="90%" class="rowform">
					<input name="kho" type="text" size="50" maxlength="255" value="<?=$kho?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				<tr>
					<td class="rowform" nowrap><?=def_hientrentrangchu?>: </td>
					<td class="rowform"><input name="ihome" type="checkbox" <?=$ihome?> value="1" onClick="checkLimited(this)"></td>
				</tr>
				<tr>
					<td class="rowform" nowrap>Sim Vip: </td>
					<td class="rowform"><input name="ihight" type="checkbox" <?=$ihight?> value="1" onClick="checkLimited(this)"></td>
				</tr>
				<tr>
					<td class="rowform">Th&#432; t&#7921;: </td>
					<td class="rowform"><input name="thutu" type="type"  value="<?=$thutu?>"></td>
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