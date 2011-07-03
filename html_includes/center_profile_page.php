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
function doChangeInfoSubmit()
{
	var myFrm = document.frmChangeInfo;
	if(myFrm.fullname.value == '')
	{
		alert('<?=$define["var_vuilongnhaphoten"]?>');
		myFrm.fullname.focus();
		return false;
	}
}
function doChangePwdSubmit()
{
	var myFrm = document.frmChangePwd;
	if(myFrm.oldpwd.value == '')
	{
		alert('<?=$define["var_vuilongnhappasswordcu"]?>');
		myFrm.oldpwd.focus();
		return false;
	}
	if(myFrm.newpwd.value == '')
	{
		alert('<?=$define["var_vuilongnhappasswordmoi"]?>');
		myFrm.newpwd.focus();
		return false;
	}
	if(myFrm.re_newpwd.value == '')
	{
		alert('<?=$define["var_vuilongnhaplaipasswordmoi"]?>');
		myFrm.re_newpwd.focus();
		return false;
	}
	if(myFrm.re_newpwd.value != myFrm.newpwd.value)
	{
		alert('<?=$define["var_passwordnhaplaichuakhop"]?>');
		myFrm.re_newpwd.focus();
		return false;
	}
	var sLink = '<?=$_URL_BASE?>/modules/checkPwd.php?oldpwd='+myFrm.oldpwd.value;
	AjaxRequest.get(
	{
		'url':sLink,
		'onSuccess': function(req)
		{
			result = req.responseText;
			if(result > 0)
			{
				getObjectById('messChangePwdError').innerHTML = '<?=$define["var_bannhapmatkhaucukhongchinhxac"]?>';
				return false;
			}
			else
			{
				getObjectById('messChangePwdError').innerHTML = '';
				document.frmChangePwd.submit();
			}
		},
		'onError': function(req){}
	});
	return false;
}
</script>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="top" bgcolor="#FFFFFF" style="border:0px solid #EEEEEE">
			<table width="97%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td class="subPageTitle"><img src="<?=$modIcon?>" border="0" align="absmiddle">&nbsp;<?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td>
						<div style="text-align:center">
							<form name="frmChangeInfo" action="<?=$_URL_BASE?>/members.php/profile" method="post" onSubmit="return doChangeInfoSubmit()">
								<table width="98%" align="center" cellpadding="0" cellspacing="0"  border="0">
<?
if($doAction == 'changeInfo')
{
?>
									<tr>
										<td>&nbsp;</td>
										<td align="center" style="font-size:11px; color:#0033CC; padding-top:10px"><?=$changeInfoMess?></td>
									</tr>
<?
}
?>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td align="right" width="36%" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_email"]?> : </td>
										<td width="64%"><input name="email" maxlength="50" class="textbox" style="width:220px; height:18px; background-color:#CCCCCC" readonly="1" value="<?=$ses_mem_email?>">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td align="right" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_hoten"]?> : </td>
										<td><input name="fullname" maxlength="100" class="textbox" style="width:220px; height:18px" value="<?=$ses_mem_name?>">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td align="right" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_coquan"]?> : </td>
										<td><input name="organization" maxlength="100" class="textbox" style="width:220px; height:18px" value="<?=$ses_mem_org?>"></td>
									</tr>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td align="right" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_diachi"]?> : </td>
										<td><input name="address" maxlength="255" class="textbox" style="width:220px; height:18px" value="<?=$ses_mem_add?>"></td>
									</tr>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td align="right" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_dienthoai"]?> : </td>
										<td><input name="tel" maxlength="20" class="textbox" style="width:220px; height:18px" value="<?=$ses_mem_tel?>"></td>
									</tr>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td nowrap>
											<button type="submit" name="sbmt"><?=$define["var_luulai"]?></button> &nbsp;&nbsp;
											<button type="reset" name="rest"><?=$define["var_nhaplai"]?></button>
										</td>
									</tr>
								</table>
								<input type="hidden" name="doAction" value="changeInfo">
							</form>
						</div>
						<div id="changePwd">
							<form name="frmChangePwd" action="<?=$_URL_BASE?>/members.php/profile" method="post" onSubmit="return doChangePwdSubmit()">
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td align="right" style="font-size:11px; color:#0033FF; font-weight:bold"><?=$define["var_thaydoimatkhau"]?></td>
										<td>&nbsp;</td>
									</tr>
<?
if($doAction == 'changePwd')
{
?>
									<tr>
										<td>&nbsp;</td>
										<td style="font-size:11px; color:#0033CC"><?=$changePwdMess?></td>
									</tr>
<?
}
?>
									<tr>
										<td align="right" width="36%" nowrap style="font-size:11px; padding-right:5px"></td>
										<td width="64%"><div id="messChangePwdError" style="font-size:11px; color:#FF0000">&nbsp;</div></td>
									</tr>
									<tr>
										<td align="right" width="36%" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_matkhaucu"]?> : </td>
										<td width="64%"><input type="password" name="oldpwd" maxlength="100" class="textbox" style="width:220px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td align="right" width="36%" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_matkhaumoi"]?> : </td>
										<td width="64%"><input type="password" name="newpwd" maxlength="100" class="textbox" style="width:220px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td align="right" width="36%" nowrap style="font-size:11px; padding-right:5px"><?=$define["var_golaimatkhaumoi"]?> : </td>
										<td width="64%"><input type="password" name="re_newpwd" maxlength="100" class="textbox" style="width:220px; height:18px">&nbsp;(<font color="#FF3300">*</font>)</td>
									</tr>									
									<tr>
										<td height="5" colspan="2"></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td nowrap>
											<button type="submit" name="sbmt"><?=$define["var_luulai"]?></button> &nbsp;&nbsp;
											<button type="reset" name="rest"><?=$define["var_nhaplai"]?></button>
										</td>
									</tr>
								</table>
								<input type="hidden" name="doAction" value="changePwd">
							</form>
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
