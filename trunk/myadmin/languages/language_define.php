<div id="HEADPAGE">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<tr>
		<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left">Define strings in <?=$lang_name?></td>
	</tr>
	<tr>
		<td class="headlink" nowrap valign="bottom">
			<a href="index.php?module=home"><?=def_trangchu?></a> / 
			<a href="<?=$url?>"><?=def_ngonngu?></a> / <?=def_cumtuduocdinhnghia?>
		</td>
	  <td align="right"><?=global_btns(DEFINE_PAGE)?></td>		
	</tr>
</table>
</div>
<div id="MAIN" class="maindiv" style="width: 100%; height: 200px; position: relative">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<form action="<?=$url?>&action=define_update" method="post" name="frmDefine" style="display:inline">
  <tr>
    <td valign="top">
			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="adminform">
				<tr>
					<? if($usrid==0){?><td width="20%" class="headform"><?=def_tenbien?></td><? }?>
					<td width="40%" class="headform"><?=def_cumtumacdinh?></td>
					<td width="40%" class="headform"><?=def_dichsang?> <?=$lang_name?></td>
				</tr>
<?
while(key($lang_def))
{
	$str_def = current($lang_def);
	$varName = key($lang_def);
?>
				<tr>
					<? if($usrid==0){?><td class="rowform"><?=$varName?></td><? }?>
					<td class="rowform"><?=formatStringDefineOut($str_def)?></td>
					<td class="rowform"><input name="<?=$varName?>" size="45" maxlength="350" value="<?=$define[$varName]?>"></td>
				</tr>
<?
	next($lang_def);
}
?>
			</table>
		</td>
  </tr>
	<input type="hidden" name="config_name">
	<input type="hidden" name="config_value">
	</form>
</table>
</div>