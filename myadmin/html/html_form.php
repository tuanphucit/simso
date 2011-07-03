<div id="HEADPAGE">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<tr>
		<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left"><?=$pageName?></td>
	</tr>
	<tr>
		<td class="headlink" nowrap valign="bottom"><a href="index.php?module=home"><?=def_trangchu?></a> / <?=$pageName?></td>
	  <td align="right"><?=global_btns(HTML_PAGE)?></td>		
	</tr>
</table>
</div>
<div id="MAIN" class="maindiv" style="width: 100%; height: 200px; position:relative">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<form name="frmEdit" action="index.php?module=html&action=update" method="post">
  <tr>
    <td valign="top">
			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="adminform">
				<input type="hidden" name="item" value="<?=$item?>">
				<tr>
					<td width="100%" colspan="2" class="headform"><?=def_thongtin?></td>
				</tr>
				<tr>
					<td width="10%" class="rowform"><?=def_tieude?>: </td>
					<td width="90%" class="rowform"><input name="pageName" type="text" size="50" maxlength="255" value="<?=$pageName?>" class="textbox" onKeyUp="telexingVietUC(this)"></td>
				</tr>
				<tr>
					<td class="rowform" valign="top" style="padding-top: 50px"><?=def_noidung?>: </td>
					<td class="rowform"><?=$oFCKeditor->Create()?></td>
				</tr>
			</table>
		</td>
  </tr>
	</form>
</table>
</div>