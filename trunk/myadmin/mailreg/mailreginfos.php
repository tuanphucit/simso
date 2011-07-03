<table width="100%" cellpadding="0" cellspacing="0">
<?
if($usrperstr == FULL || $usrid==0)
{
?>
	<tr height="30"><td><?=private_btns()?></td></tr>
<?
}
?>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
				<table width="100%" cellspacing="0" cellpadding="0">
					<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
					<tr>
						<td class="rowinfohead" nowrap width="30%"><b>&#272;&#7883;a ch&#7881; mail:</b></td>
						<td width="70%" class="rowinfo">
							<input type="text" name="nname" size="35" maxlength="255" value="<?=$cur_name?>" readonly="1" class="textbox">
							<font color="#FF3300">*</font>
						</td>
					</tr>
					<tr>
						<td class="rowinfohead"><?=def_thutu?>: </td>
						<td class="rowinfo"><input name="order" type="text" value="<?=$cur_order?>" class="textbox" size="5" maxlength="11" readonly="1"></td>
					</tr>
					<tr>
						<td class="rowinfohead">&#272;&#432;&#7907;c nh&#7853;n mail: </td>
						<td class="rowinfo"><input name="view" type="checkbox" <?=$cur_view?> value="1" disabled></td>
					</tr>
					<input type="hidden" name="CURID" value="<?=$CURID?>">
					</form>
				</table>
			</div>
		</td>
	</tr>
</table>
