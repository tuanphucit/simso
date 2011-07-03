<?
if(!$_PAGE_VALID)
{
	exit();
}
$isSent = NULL;
_SESSION_REGISTER("isSent");


?>
<script language="javascript">
function checkRegMail()
{
	var myFrm = document.regMailRecForm;
	if(!isEmail(myFrm.regMailRec.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.regMailRec.focus();
		return false;
	}
	AjaxRequest.Submit(
		regMailRecForm, {'onSuccess': function(req)
		{
			getObjectById('regMailRecFormArea').style.display = 'none';
			getObjectById('regMailRecNote').style.display = '';
		},'onError': function(req){}
	});
	return false;
}
</script>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td class="rightmenu"><?=$Title?></td>
  </tr>
  <tr>
  	<td valign="top" class="rightmenu1">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			 <tr>
			 <td class="newnews" style="padding-left:7; padding-right:7 "><?=$define["var_nhapdiachiEmail"]?></td>
			 
			 </tr>
			  <tr id="regMailRecFormArea">
					<td style="text-align:center" valign="top">
						<form name="regMailRecForm" action="<?=$_URL_BASE?>/registermail.php" onSubmit="return checkRegMail()" style="margin:0px 0px 0px 0px;">
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td height="10"></td>
								</tr>
								<tr>
									<td align="center">
										<input name="regMailRec" maxlength="200" value="<?=$define["var_nhapdiachimail"]?>" style="width:155px; color:#000000;" onFocus="clearKeyword(this)" onBlur="restoreKeyword(this)">
									</td>
								</tr>
								<tr>
									<td style="text-align:center; padding-top:5px; padding-bottom:2px;font-family:tahoma; font-weight:bold; font-size:11px">
										<button name="regMailSubmit" style="background-image:url(<?=$_IMG_DIR?>/submit_nhantin.jpg); background-repeat:no-repeat; width:94px;height:23px; color:#fe0002; text-align:center " type="submit"><span style="font-family:tahoma; font-weight:bold "><?=$define["var_dangky"]?></span></button>
									</td>
								</tr>
								<tr>
									<td height="10"></td>
								</tr>
							</table>
						</form>
					</td>
				</tr>
			  <tr id="regMailRecNote" class="rightmenu1" style="display:none">
				   <td align="center" style="font-size:11px; color:#0033CC"><?=$define["var_dangkythanhcong"]?></td>
			  </tr>
			</table>
	</td>
  </tr>		
<tr>
 	<td valign="top"><img src="<?=$_IMG_DIR?>/menuleft_3.jpg" border="0" /></td>
 </tr>	
</table>  
