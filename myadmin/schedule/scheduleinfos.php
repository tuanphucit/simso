<script language="javascript" src="../js/modalbox/prototype.js"></script>
<script language="javascript" src="../js/modalbox/scriptaculous.js"></script>
<script language="javascript" src="../js/modalbox/modalbox.js"></script>
<style type="text/css">@import url("../css/modalbox.css");</style>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns()?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table width="100%" cellspacing="0" cellpadding="0">
				<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td class="rowinfohead" nowrap width="20%"><b><?=def_tendanhmuc?>:</b></td>
					<td width="80%" class="rowinfo">
						<input type="text" name="nname" size="20" maxlength="255" value="<?=$cur_name?>" readonly="1" class="textbox"> *
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_fileexcel?>: </td>
					<td class="rowinfo">
						<div><input type="text" name="old_excelfile" value="<?=$excelfile?>" size="40" class="textbox" readonly="1"></div>
						<div><input type="file" name="excelfile" size="28" class="textbox" style="display:none"></div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_ngaybatdau?>: </td>
					<td class="rowinfo"><input name="fdate" type="text" value="<?=$fdate?>" class="textbox" size="10" maxlength="11" readonly="1"> *</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_ngayketthuc?>: </td>
					<td class="rowinfo"><input name="edate" type="text" value="<?=$edate?>" class="textbox" size="10" maxlength="11" readonly="1"> *</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_solantaive?>: </td>
					<td class="rowinfo"><input name="down" type="text" value="<?=$down?>" class="textbox" size="10" maxlength="11" readonly="1"></td>
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
