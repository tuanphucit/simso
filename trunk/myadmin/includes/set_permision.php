<?
function global_btns($pur=NULL,$formType=NULL)
{
	global $usrper, $action, $url;
?>
<table border="0" cellpadding="0" cellspacing="0" align="right">
	<tr align="right" valign="middle">	
<?
	if($pur==NULL)
	{
		if($usrper["canAdd"]==YES){
			if($formType==NULL){
?>
		<td align="center" id="btnAdd">
			<a class="toolbar" href="javascript:activForm('insert')">
			<img src="images/new_f2.png" alt="<?=alt_add?>" align="middle" border="0"> <br><?=btn_add?></a> 
		</td>
		<td>&nbsp;</td>
<?
			}else{
?>
		<td align="center" id="btnAdd">
			<a class="toolbar" href="<?=$url?>&action=<?=$action?>">
			<img src="images/new_f2.png" alt="<?=alt_add?>" align="middle" border="0"> <br><?=btn_add?></a> 
		</td>
		<td>&nbsp;</td>
<? 
			}
			if($usrper["canDel"]==YES){
?>
		<td align="center" id="btnDeletes">
			<a class="toolbar" href="javascript:doDelete()"> 
			<img src="images/delete_f2.png" alt="<?=alt_del?>" align="middle" border="0"> <br><?=btn_del?></a> 
		</td>						
		<td>&nbsp;</td>
<? 
			}
			if($usrper["canEdit"]==YES){
?>
		<td align="center" id="btnUpdates" nowrap>
			<a class="toolbar" href="javascript:updates()"> 
			<img src="images/apply_f2.png" alt="<?=alt_upd?>" align="middle" border="0"><br><?=btn_upd?></a> 
		</td>						
		<td>&nbsp;</td>
<? 
			}
		}
	}
	if($pur==EDIT_PAGE)
	{
		if($usrper["canEdit"]==YES || $usrper["canAdd"]==YES){
?>
		<td style="padding-left:5px" align="center">
			<a class="toolbar" href="javascript:update()">
			<img src="images/save_f2.png" alt="<?=alt_save?>" name="btnSave" align="middle" border="0"> <br><?=btn_save?></a> 
		</td>
		<td>&nbsp;</td>
<? }?>
		<td align="center">
			<a class="toolbar" href="<?=$url?>">
			<img src="images/cancel_f2.png" alt="<?=alt_cancel?>" name="btnCancel" align="middle" border="0"><br><?=btn_cancel?></a> 
		</td>
		<td>&nbsp;</td>
<? 
	}
	if($pur==HTML_PAGE)
	{
		if($usrper["canEdit"]==YES){
?>
		<td style="padding-left:5px" align="center">
			<a class="toolbar" href="javascript:update()">
			<img src="images/save_f2.png" alt="<?=alt_save?>" name="btnSave" align="middle" border="0"> <br><?=btn_save?></a> 
		</td>
		<td>&nbsp;</td>
<? 
		}
	}
	if($pur==DEFINE_PAGE)
	{
		if($usrid==0){
?>
		<td style="padding-left:5px" align="center">
			<a class="toolbar" href="javascript:newObj()">
			<img src="images/new_f2.png" alt="<?=alt_add?>" name="btnSave" align="middle" border="0"> <br><?=btn_add?></a> 
		</td>
		<td>&nbsp;</td>
<?
		}
		if($usrper["canEdit"]==YES || $usrper["canAdd"]==YES){
?>
		<td style="padding-left:5px" align="center">
			<a class="toolbar" href="javascript:update()">
			<img src="images/save_f2.png" alt="<?=alt_save?>" name="btnSave" align="middle" border="0"> <br><?=btn_save?></a> 
		</td>
		<td>&nbsp;</td>
<? }?>
		<td align="center">
			<a class="toolbar" href="<?=$url?>">
			<img src="images/cancel_f2.png" alt="<?=alt_cancel?>" name="btnCancel" align="middle" border="0"><br><?=btn_cancel?></a> 
		</td>
		<td>&nbsp;</td>
<? 
	}
?>
<!--
		<td align="center">
			<a class="toolbar" href="#" onClick="openBox('help.html')">
			<img src="images/help_f2.png" alt="<?=alt_help?>" name="btnHelp" align="middle" border="0"><br><?=btn_help?></a> 
		</td>
-->
	</tr>
</table>
<?
}

function private_btns($formType=NULL)
{
	global $usrper, $CURID, $url, $action;
?>
<table border="0" cellpadding="0" cellspacing="0" align="right" width="100%" height="100%">
	<tr valign="middle">	
		<td align="right" style="border-bottom: 1px solid #CCCCCC; background-color:#6699CC">
<?
	if(($usrper["canEdit"]==YES || $usrper["canAdd"]==YES) && $formType==NULL){	
?>
			<img src="images/ed_save.gif" name="btnUpdate" class="icon_l" title="Save" onClick="doSubmit()" style="display:none">
<?
	}
	if($usrper["canEdit"]==YES && $CURID!=NULL){
		if($formType==NULL){
?>
			<img src="images/b_edit.png" name="btnEdit" class="icon_l" title="<?=alt_edit?>" onClick="activForm('edit')">
<?
		}else{
?>
			<img src="images/b_edit.png" name="btnEdit" class="icon_l" title="<?=alt_edit?>" onClick="goPage('<?=$url?>&CURID=<?=$CURID?>&action=<?=$action?>');">
<? 
		}
	}
	if($usrper["canDel"]==YES && $CURID!=NULL){
?>
			<input type="image" name="btnDelete" src="images/ed_delete.gif" title="<?=alt_del?>" onClick="delCurObj('<?=$CURID?>')" class="icon_l">
<? }?>
			<img src="images/close.gif" name="btnCancel" class="icon_l" title="<?=alt_cancel?>" onClick="notExe()" style="display:none">
		</td>
	</tr>
</table>
<?
}
?>