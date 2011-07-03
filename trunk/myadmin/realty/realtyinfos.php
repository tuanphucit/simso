<script language="javascript">
function addRType()
{
	var sLink = 'realty/realtyType.php?CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');
}
function editRType()
{
	var myFrm = document.frmEdit;
	if(myFrm.rType.value == '')
	{
		alert('Ban phai chon mot loai bat dong san de chinh sua');
		myFrm.rType.focus();
		return false;
	}
	var rTypeVal = myFrm.rType.value;
	var sLink = 'realty/realtyType.php?id='+rTypeVal+'&CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');	
}
function delRType()
{
	var myFrm = document.frmEdit;
	if(myFrm.rType.value == '')
	{
		alert('Ban phai chon mot loai bat dong san de xoa');
		myFrm.rType.focus();
		return false;
	}
	var rTypeVal = myFrm.rType.value;
	var sLink = 'realty/realtyType.php?id='+rTypeVal+'&CURMOD=<?=$CURMOD?>&doAction=del';
	openBox(sLink, 400, 200, 'no');	
}

function addRAspect()
{
	var sLink = 'realty/realtyAspect.php?CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');
}
function editRAspect()
{
	var myFrm = document.frmEdit;
	if(myFrm.rAspect.value == '')
	{
		alert('Ban phai chon mot muc de chinh sua');
		myFrm.rAspect.focus();
		return false;
	}
	var rAspectVal = myFrm.rAspect.value;
	var sLink = 'realty/realtyAspect.php?id='+rAspectVal+'&CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');	
}
function delRAspect()
{
	var myFrm = document.frmEdit;
	if(myFrm.rAspect.value == '')
	{
		alert('Ban phai chon mot muc de xoa');
		myFrm.rAspect.focus();
		return false;
	}
	var rAspectVal = myFrm.rAspect.value;
	var sLink = 'realty/realtyAspect.php?id='+rAspectVal+'&CURMOD=<?=$CURMOD?>&doAction=del';
	openBox(sLink, 400, 200, 'no');	
}

function addRPlace()
{
	var sLink = 'realty/realtyPlace.php?CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');
}
function editRPlace()
{
	var myFrm = document.frmEdit;
	if(myFrm.rPlace.value == '')
	{
		alert('Ban phai chon mot muc de chinh sua');
		myFrm.rPlace.focus();
		return false;
	}
	var rPlaceVal = myFrm.rPlace.value;
	var sLink = 'realty/realtyPlace.php?id='+rPlaceVal+'&CURMOD=<?=$CURMOD?>&doAction=add';
	openBox(sLink, 400, 200, 'no');	
}
function delRPlace()
{
	var myFrm = document.frmEdit;
	if(myFrm.rPlace.value == '')
	{
		alert('Ban phai chon mot muc de xoa');
		myFrm.rPlace.focus();
		return false;
	}
	var rPlaceVal = myFrm.rPlace.value;
	var sLink = 'realty/realtyPlace.php?id='+rPlaceVal+'&CURMOD=<?=$CURMOD?>&doAction=del';
	openBox(sLink, 400, 200, 'no');	
}
</script>
<script language="javascript" src="../js/modalbox/prototype.js"></script>
<script language="javascript" src="../js/modalbox/scriptaculous.js"></script>
<script language="javascript" src="../js/modalbox/modalbox.js"></script>
<style type="text/css">@import url("../css/modalbox.css");</style>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30"><td><?=private_btns(FORM_BLANK)?></td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table width="100%" cellspacing="0" cellpadding="0">
				<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td class="rowinfohead" nowrap width="20%"><b><?=def_tendanhmuc?>:</b></td>
					<td width="80%" class="rowinfo"><?=$cur_name?></td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap width="20%"><?=def_gia?>:</td>
					<td width="80%" class="rowinfo"><?=$price?>&nbsp;(<?=def_trieudong?>/<?=def_metvuong?>)</td>
				</tr>
				<tr height="30">
					<td class="rowinfohead" nowrap width="20%"><?=def_dientich?>:</td>
					<td width="80%" class="rowinfo"><?=$area?>&nbsp;(<?=def_metvuong?>)</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_anh?> 1: </td>
					<td class="rowinfo">
						<a href="preview_image.php?src=../<?=$image1?>" title="<?=$cur_name?>" onClick="Modalbox.show(this.href, {title: this.title,overlayClose: false}); return false;">
							<img src="../<?=$thumb1?>" border="0" alt="<?=$cur_name?>">
						</a>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_anh?> 2: </td>
					<td class="rowinfo">
						<a href="preview_image.php?src=../<?=$image2?>" title="<?=$cur_name?>" onClick="Modalbox.show(this.href, {title: this.title,overlayClose: false}); return false;">
							<img src="../<?=$thumb2?>" border="0" alt="<?=$cur_name?>">
						</a>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_ngaydang?>: </td>
					<td class="rowinfo"><?=$ndate?></td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_loaibatdongsan?>: </td>
					<td class="rowinfo">
						<select name="rType"><?=$rTypeSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addRType(); return false"><?=btn_add?></a> | <a href="#" onClick="editRType(); return false"><?=btn_edit?></a> | <a href="#" onClick="delRType(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_huongnha?>: </td>
					<td class="rowinfo">
						<select name="rAspect"><?=$rAspectSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addRAspect(); return false"><?=btn_add?></a> | <a href="#" onClick="editRAspect(); return false"><?=btn_edit?></a> | <a href="#" onClick="delRAspect(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_khuvuc?>: </td>
					<td class="rowinfo">
						<select name="rPlace"><?=$rPlaceSels?></select> *
						<div style="padding-bottom:10px">
							<a href="#" onClick="addRPlace(); return false"><?=btn_add?></a> | <a href="#" onClick="editRPlace(); return false"><?=btn_edit?></a> | <a href="#" onClick="delRPlace(); return false"><?=btn_del?></a>
						</div>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_soluotxem?>: </td>
					<td class="rowinfo"><?=$show?></td>
				</tr>
				<tr>
					<td class="rowinfohead" nowrap><b><?=def_noidung?>:</b></td>
					<td class="rowinfo"><?=$shortdes?></td>
				</tr>
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
