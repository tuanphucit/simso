<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
function changeSubmitStatus()
{
	var myFrm = document.frmRegister;
	if(myFrm.agree.checked)
	{
		myFrm.sbmt.disabled = false;
	}
	else
	{
		myFrm.sbmt.disabled = true;
	}
}
function doRegisterSubmit()
{
	var myFrm = document.frmRegister;
	if(!isEmail(myFrm.email.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.email.focus();
		return false;
	}
	if(myFrm.password.value == '')
	{
		alert('<?=$define["var_vuilongnhappassword"]?>');
		myFrm.password.focus();
		return false;
	}
	if(myFrm.re_password.value == '')
	{
		alert('<?=$define["var_vuilongnhaplaipassword"]?>');
		myFrm.re_password.focus();
		return false;
	}
	if(myFrm.re_password.value != myFrm.password.value)
	{
		alert('<?=$define["var_passwordnhaplaichuakhop"]?>');
		myFrm.re_password.focus();
		return false;
	}
	if(myFrm.fullname.value == '')
	{
		alert('<?=$define["var_vuilongnhaphoten"]?>');
		myFrm.fullname.focus();
		return false;
	}

	var sLink = '<?=$_URL_BASE?>/modules/checkReg.php?email='+myFrm.email.value;
	AjaxRequest.get(
	{
		'url':sLink,
		'onSuccess': function(req)
		{
			result = req.responseText;
			if(result > 0)
			{
				getObjectById('messError').style.display = '';
				getObjectById('messError').innerHTML = '<?=$define["var_emaildatontai"]?>';
				return false;
			}
			else
			{
				getObjectById('messError').style.display = 'none';
				document.frmRegister.submit();
			}
		},
		'onError': function(req){}
	});
	return false;
}
</script>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center"  valign="top">
			<table width="92%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7"></td>
				</tr>
				<tr><td style="background-image:url(<?=$_IMG_DIR?>/page_title.jpg);height:23px; color:#006404; font-family:tahoma; font-weight:bold; font-size:12px; background-repeat:no-repeat; font-family:tahoma; font-size:12px; padding-left:5px; padding-bottom:5px"><?=$define["var_dangduyet"]?>:<span style="font-weight:bold; padding-left:2px"><?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td>
<?
if($doAction == 'send')
{
?>
						<table width="80%" height="250" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center"><?=$content?></td>
							</tr>
							<tr>
								<td align="center"><?=$contentDetail?></td>
							</tr>
						</table>
<?
}
else
{
?>
						<div style="text-align:center; font-size:11px"><?=$regNote?></div>
						<div style="color:#FF0000; font-size:11px; text-align:center" id="messError" style="display:none"></div>
						<div style="text-align:center">
							<form name="frmRegister" action="<?=$_URL_BASE?>/members.php/register" method="post" onSubmit="return doRegisterSubmit()">
								<table width="98%" align="center" cellpadding="3" cellspacing="0"  border="0">
									<tr>
										<td align="right" width="30%" nowrap style="font-size:11px"><?=$define["var_email"]?> : </td>
										<td><input name="email" maxlength="50" class="textbox" style="width:220px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap style="font-size:11px"><?=$define["var_matkhau"]?> : </td>
										<td><input type="password" name="password" maxlength="100" class="textbox" style="width:220px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap style="font-size:11px"><?=$define["var_golaimatkhau"]?> : </td>
										<td><input type="password" name="re_password" maxlength="100" class="textbox" style="width:220px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap style="font-size:11px"><?=$define["var_hoten"]?> : </td>
										<td><input name="fullname" maxlength="100" class="textbox" style="width:220px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap style="font-size:11px"><?=$define["var_coquan"]?> : </td>
										<td><input name="organization" maxlength="100" class="textbox" style="width:220px; height:18px"></td>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap style="font-size:11px"><?=$define["var_diachi"]?> : </td>
										<td><input name="address" maxlength="255" class="textbox" style="width:220px; height:18px"></td>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap style="font-size:11px"><?=$define["var_dienthoai"]?> : </td>
										<td><input name="tel" maxlength="20" class="textbox" style="width:220px; height:18px"></td>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap valign="top" style="font-size:11px"></td>
										<td>
											<div class="regPrivacy"><?=$regPrivacy?></div>
									</tr>
									<tr>
										<td align="right" width="30%" nowrap valign="top"></td>
										<td>
											<table width="100%" cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td width="15" valign="top"><input type="checkbox" name="agree" checked onClick="changeSubmitStatus()" style="margin-left:0px"></td>
													<td style="font-size:11px"><?=$define["var_dongyvoidieukhoan"]?></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="30%">&nbsp;</td>
										<td nowrap>
											<button type="submit" name="sbmt"><?=$define["var_dangky"]?></button> &nbsp;&nbsp;
											<button type="reset" name="rest"><?=$define["var_nhaplai"]?></button>
										</td>
									</tr>
								</table>
								<input type="hidden" name="doAction" value="send">
								<input type="hidden" name="checkRegMail" value="0">
							</form>
						</div>
<?
}
?>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>
