<div id="HEADPAGE">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<tr>
		<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left"><?=$headpage?></td>
	</tr>
	<tr>
		<td class="headlink" nowrap valign="bottom">
			<a href="index.php?module=home"><?=def_trangchu?></a> / <?=$parentPage?>
		</td>
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
					<td width="10%" class="rowform">Item ID: </td>
					<td width="90%" class="rowform">
						<input name="htmlid" type="text" size="30" maxlength="100" value="<?=$htmlid?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td class="rowform">Item name: </td>
					<td class="rowform">
						<input name="nname" type="text" size="50" maxlength="255" value="<?=$name?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td class="rowform">Item type: </td>
					<td class="rowform">
						<select name="cate">
							<option value="0" selected>Content of page</option>
							<option value="1">A part of content</option>
						</select>
						<script language="javascript">document.frmEdit.cate.value = '<?=$cate?>'</script>
					</td>
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
					<td class="rowform" valign="top" style="padding-top: 50px"><?=def_noidung?>: </td>
					<td class="rowform"><?=$oFCKeditor->Create()?></td>
				</tr>
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				<input type="hidden" name="KWD" value="<?=$KWD?>">
			</table>
		</td>
  </tr>
	</form>
</table>
</div>