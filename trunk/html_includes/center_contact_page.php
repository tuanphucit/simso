<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
function doContactSubmit()
{
	var myFrm = document.frmContact;
	if(myFrm.fullname.value == '')
	{
		alert('<?=$define["var_vuilongnhaphoten"]?>');
		myFrm.fullname.focus();
		return false;
	}
	if(!isEmail(myFrm.email.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.email.focus();
		return false;
	}
	if(myFrm.securityCode.value == '')
	{
		alert('<?=$define["var_vuilongnhapmabaove"]?>');
		myFrm.securityCode.focus();
		return false;
	}
	return true;
}
</script>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="top">
			<table width="100%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="26px;" class="subPageTitle" ><?=$subPageTitle?></td>
				</tr>
				<tr>
					<td style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y" width="100%" valign="top">
<?
if($doAction == 'send' && $isSent == 1)
{
?>
						<table width="70%" height="100" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center"><?=$sentContent?></td>
							</tr>
						</table>
<?
}
?>
						<div class="itemName"><?=$contentDetail?></div>
<?
if($errorMess)
{
?>
						<div id="messError" style="font-size:11px; color:#FF0000" align="center"><?=$errorMess?></div>
<?
}
?>
						<div id="myContactForm" style="text-align:center">
							<form name="frmContact" action="<?=$_URL_BASE?>/index.php/contact" method="post" onSubmit="return doContactSubmit()">
								<table width="75%" align="center" cellpadding="3" cellspacing="0"  border="0">
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px" class="itemname"><?=$define["var_nguoilienhe"]?> : </td>
										<td><input name="fullname" maxlength="100" class="textbox" value="<?=$fullname?>" style="width:210px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px" class="itemname"><?=$define["var_diachi"]?> : </td>
										<td><input name="address" maxlength="255" class="textbox" value="<?=$address?>" style="width:210px; height:18px"></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px" class="itemname"><?=$define["var_dienthoai"]?> : </td>
										<td><input name="tel" maxlength="20" class="textbox" value="<?=$tel?>" style="width:210px; height:18px"></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px" class="itemname"><?=$define["var_email"]?> : </td>
										<td><input name="email" maxlength="50" class="textbox" value="<?=$email?>" style="width:210px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap sstyle="font-size:11px" class="itemname"><?=$define["var_fax"]?> : </td>
										<td><input name="fax" maxlength="20" class="textbox" value="<?=$fax?>" style="width:210px; height:18px"></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px" class="itemname"></td>
										<td><img src="<?=$_URL_BASE?>/captcha/CaptchaSecurityImages.php?width=120&height=40&characters=6" /></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px" class="itemname"><?=$define["var_mabaove"]?> : </td>
										<td><input name="securityCode" maxlength="6" class="textbox" style="width:50px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap valign="top" style="font-size:11px" class="itemname"><?=$define["var_noidungyeucau"]?> : </td>
										<td><textarea name="request" rows="7" class="textBox" style="width:210px"><?=$request?></textarea></td>
									</tr>
									<tr>
										<td width="20%">&nbsp;</td>
										<td nowrap>
											<button type="submit" name="sbmt"><?=$define["var_gui"]?></button> &nbsp;&nbsp;
											<button type="reset" name="rest"><?=$define["var_nhaplai"]?></button>
										</td>
									</tr>
									<tr>
										<td width="20%">&nbsp;</td>
										<td nowrap style="font-size:11px" class="itemname">(<font color="#FF3300">*</font>) <?=$define["var_truongbatbuoc"]?></td>
									</tr>
								</table>
								<input type="hidden" name="doAction" value="send">
							</form>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
		<tr>
		<td valign="top"><img src="<?=$_IMG_DIR?>/pagetitle_2.gif" border="0" /></td>
	</tr>

</table>
<?
if($errorMess)
{
?>
<script language="javascript">
window.scrollTo(messError.offsetLeft, messError.offsetTop);
document.frmContact.securityCode.focus();
</script>
<?
}
?>
