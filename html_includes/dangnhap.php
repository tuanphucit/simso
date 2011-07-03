<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
		<td class="rightmenu"><?=$Title?></td>
	</tr>
<?
if(!$isLogin)
{
?>
<script language="javascript">
function doLoginSubmit()
{
	var myFrm = document.loginForm;
	if(!isEmail(myFrm.regEmail.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.regEmail.focus();
		return false;
	}
	if(myFrm.regPwd.value == '')
	{
		alert('<?=$define["var_vuilongnhappassword"]?>');
		myFrm.regPwd.focus();
		return false;
	}

	AjaxRequest.Submit(
		loginForm, {'onSuccess': function(req)
		{
			rerult = req.responseText;
			if(rerult == 'NO')
			{
				getObjectById('loginNote').style.display = 'none';
				getObjectById('loginError').style.display = '';
				return false;
			}
			else
			{
				getObjectById('loginError').style.display = 'none';
				getObjectById('loginNote').style.display = '';
				window.location.reload();
			}
		},'onError': function(req){}
	});
	return false;
}

function forgotPwd()
{
	getObjectById('loginFormArea').style.display = 'none';
	getObjectById('forgotPwdArea').style.display = '';
}
function doForgotPwdSubmit()
{
	var myFrm = myFrm = document.forgotPwdForm;
	if(!isEmail(myFrm.regEmail.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.regEmail.focus();
		return false;
	}
	
}
</script>
	<tr id="loginFormArea" style="padding:8px 0px 5px 0px">
		<td align="center" class="rightmenu1">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<form name="loginForm" action="<?=$_URL_BASE?>/modules/login.php" method="post" onSubmit="return doLoginSubmit()">
				<tr id="loginNote">
					<td align="center" style="font-size:10px; color:#9e9e9e; padding:5px" colspan="2"><?//=$define["var_dienthongtinvaoform"]?></td>
				</tr>
				<tr height="25" id="loginError" style="display:none">
					<td align="center" colspan="2" style="color:#FF0000; font-size:11px; padding:5px 10px 5px 10px"><?=$define["var_loidangnhap"]?></td>
				</tr>
				<tr height="25">
					<td align="right" nowrap style="font-size:10px; padding-left:3px"><?=$define["var_email"]?>: </td>
					<td style="padding-left:3px;"><input type="text" maxlength="255" name="regEmail" class="regFormText"></td>
				</tr>
				<tr height="25">
					<td align="right" nowrap style="font-size:10px;padding-left:3px"><?=$define["var_matkhau"]?>: </td>
					<td style="padding-left:3px"><input type="password" maxlength="255" name="regPwd" class="regFormText"></td>
				</tr>
				<tr>
					<td align="center" style="padding-top:3px" colspan="2">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr height="25">
								<td width="55%" style="font-size:10px" nowrap>
									<img src="<?=$_IMG_DIR?>/right_arrow_yellow.jpg" width="4" height="11" style="margin:0px 7px 0px 9px"><a href="" onClick="forgotPwd(); return false"><?=$define["var_quenmatkhau"]?></a><br>
									<img src="<?=$_IMG_DIR?>/right_arrow_yellow.jpg" width="4" height="11" style="margin:0px 7px 0px 9px"><a href="<?=$_URL_BASE?>/members.php/register"><?=$define["var_dangkytaikhoan"]?></a>
								</td>
								<td width="45%" valign="bottom" style="padding-bottom:4px; padding-left:6px"><button type="submit" name="doLogin" ><?=$define["var_dangnhap"]?></button></td>
							</tr>
							<tr>
								<td height="5"></td>
							</tr>
						</table>
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
	<tr id="forgotPwdArea" style="display:none">
		<td align="center" class="rightmenu1">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<form name="forgotPwdForm" action="<?=$_URL_BASE?>/members.php/forgot" method="post" onSubmit="return doForgotPwdSubmit()">
				<tr height="25">
					<td align="right" nowrap style="font-size:11px"><?=$define["var_email"]?>: </td>
					<td style="padding-left:5px"><input type="text" maxlength="255" name="regEmail" class="regFormText"></td>
				</tr>
				<tr>
					<td align="center" style="padding-top:3px" colspan="2">
						<button type="submit" name="doLogin" class=""><?=$define["var_gui"]?></button>
					</td>
				</tr>
				</form>
			</table>
		</td>
	</tr>
<?
}
else
{
?>
	<tr>
		<td align="center" height="80" class="rightmenu1">
			<div align="center" style="font-size:11px"><?=$define["var_chaomung"]?></div>
			<div align="center" style="font-weight:bold"><a href="<?=$_URL_BASE?>/members.php/profile" style="color:#000099"><?=$ses_mem_name?></a></div>
			<div align="center" style="font-weight:bold; font-size:11px"><a href="<?=$_URL_BASE?>/members.php/logout"><?=$define["var_thoat"]?></a></div>
		</td>
	</tr>
<?
}
?>
</table>
