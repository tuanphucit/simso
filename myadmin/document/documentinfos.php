<script language="javascript" src="../js/modalbox/prototype.js"></script>
<script language="javascript" src="../js/modalbox/scriptaculous.js"></script>
<script language="javascript" src="../js/modalbox/modalbox.js"></script>
<style type="text/css">@import url("../css/modalbox.css");</style>
<script language="javascript">
function addDocType()
{
	var sLink = 'document/docType.php?CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');
}
function editDocType()
{
	var myFrm = document.frmEdit;
	if(myFrm.docType.value == '')
	{
		alert('Ban phai chon mot loai van ban de chinh sua');
		myFrm.docType.focus();
		return false;
	}
	var docTypeVal = myFrm.docType.value;
	var sLink = 'document/docType.php?id='+docTypeVal+'&CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');	
}
function delDocType()
{
	var myFrm = document.frmEdit;
	if(myFrm.docType.value == '')
	{
		alert('Ban phai chon mot loai van ban de xoa');
		myFrm.docType.focus();
		return false;
	}
	var docTypeVal = myFrm.docType.value;
	var sLink = 'document/docType.php?id='+docTypeVal+'&CURMOD=<?=$CURMOD?>&doAction=del';
	openBox(sLink, 400, 200, 'no');	
}

function addDocArea()
{
	var sLink = 'document/docArea.php?CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');
}
function editDocArea()
{
	var myFrm = document.frmEdit;
	if(myFrm.docArea.value == '')
	{
		alert('Ban phai chon mot linh vuc van ban de chinh sua');
		myFrm.docArea.focus();
		return false;
	}
	var docAreaVal = myFrm.docArea.value;
	var sLink = 'document/docArea.php?id='+docAreaVal+'&CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');	
}
function delDocArea()
{
	var myFrm = document.frmEdit;
	if(myFrm.docArea.value == '')
	{
		alert('Ban phai chon mot linh vuc van ban de xoa');
		myFrm.docArea.focus();
		return false;
	}
	var docAreaVal = myFrm.docArea.value;
	var sLink = 'document/docArea.php?id='+docAreaVal+'&CURMOD=<?=$CURMOD?>&doAction=del';
	openBox(sLink, 400, 200, 'no');	
}

function addDocProm()
{
	var sLink = 'document/docProm.php?CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');
}
function editDocProm()
{
	var myFrm = document.frmEdit;
	if(myFrm.docProm.value == '')
	{
		alert('Ban phai chon mot noi ban hanh de chinh sua');
		myFrm.docProm.focus();
		return false;
	}
	var docPromVal = myFrm.docProm.value;
	var sLink = 'document/docProm.php?id='+docPromVal+'&CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');	
}
function delDocProm()
{
	var myFrm = document.frmEdit;
	if(myFrm.docProm.value == '')
	{
		alert('Ban phai chon mot noi ban hanh de xoa');
		myFrm.docProm.focus();
		return false;
	}
	var docPromVal = myFrm.docProm.value;
	var sLink = 'document/docProm.php?id='+docPromVal+'&CURMOD=<?=$CURMOD?>&doAction=del';
	openBox(sLink, 400, 200, 'no');	
}
</script>
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
					<td class="rowinfohead"><?=def_filedoc?>: </td>
					<td class="rowinfo">
						<div><input type="text" name="old_msdoc" value="<?=$msdoc?>" size="40" class="textbox" readonly="1"></div>
						<div><input type="file" name="msdoc" size="28" class="textbox" style="display:none"></div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_filepdf?>: </td>
					<td class="rowinfo">
						<div><input type="text" name="old_adpdf" value="<?=$adpdf?>" size="40" class="textbox" readonly="1"></div>
						<div><input type="file" name="adpdf" size="28" class="textbox" style="display:none"></div>
					</td>
				</tr>
				<!--<tr>
					<td class="rowinfohead"><?=def_loaivanban?>: </td>
					<td class="rowinfo" nowrap>
						<select name="docType" disabled><?=$docTypeSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addDocType(); return false"><?=btn_add?></a> | <a href="#" onClick="editDocType(); return false"><?=btn_edit?></a> | <a href="#" onClick="delDocType(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_thuoclinhvuc?>: </td>
					<td class="rowinfo">
						<select name="docArea" disabled><?=$docAreaSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addDocArea(); return false"><?=btn_add?></a> | <a href="#" onClick="editDocArea(); return false"><?=btn_edit?></a> | <a href="#" onClick="delDocArea(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_noibanhanh?>: </td>
					<td class="rowinfo">
						<select name="docProm" disabled><?=$docPromSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addDocProm(); return false"><?=btn_add?></a> | <a href="#" onClick="editDocProm(); return false"><?=btn_edit?></a> | <a href="#" onClick="delDocProm(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_ngaybanhanh?>: </td>
					<td class="rowinfo"><input name="ndate" type="text" value="<?=$ndate?>" class="textbox" size="10" maxlength="11" readonly="1"></td>
				</tr>-->
				<tr>
					<td class="rowinfohead"><?=def_solantaive?>: </td>
					<td class="rowinfo"><input name="down" type="text" value="<?=$down?>" class="textbox" size="10" maxlength="11" readonly="1"></td>
				</tr>
				<!--<tr>
						<td class="rowinfohead" nowrap><b><?=def_gioithieuqua?>:</b></td>
						<td class="rowinfo">
							<textarea name="shortdes" cols="60" rows="7" readonly><?=$shortdes?></textarea>
						</td>
					</tr>-->
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
