<?
include_once("includes/global.php");

$msg = NULL;
if(_SESSION_IS_REGISTERED("alert"))
{
	$alert = _SESSION("alert");
	switch($alert)
	{
		case -2:
			$msg = "User not existing.";
			break;
		case -1:
			$msg = "Wrong password.";
			break;
	}
}
?>
<html>
<head>
	<title>Administration - Login user</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>">
	<script language="JavaScript" src="js/common.js"></script>
	<script language="JavaScript" src="js/functions.js"></script>
	<script language="javascript" src="js/vietuni.js"></script>
	<style type="text/css">@import url("css/style.css");</style>
</head>
<body>
<script language=JavaScript>
var never = new Date()
never.setTime(never.getTime() + 2000*24*60*60*1000);

function checkIn()
{
	var doc = "document.frmLogin";
	doc = eval(doc);
	if (doc.txtUser.value=="")
	{
		alert("Please enter your username");
		doc.txtUser.focus();
		return false;
	}

	if (doc.txtPWD.value=="")
	{
		alert("Please enter your own Password");
		doc.txtPWD.focus();
		return false;
	}
	var len = doc.elements.length;
	for(i=0;i<len;i++)
	{
		objName = doc.elements[i].name;
		if(doc.REM.checked) saveValue(objName,"frmLogin");
		else clearValue(objName,"frmLogin");
	}
	return true;
}
</script>
<table cellspacing="0" cellpadding="2" align="center" width="100%" bgcolor="#FFFFFF" height="100%" class="mainborder">
	<tr>
	  <td width="100%" align="center">
			<table cellspacing="0" cellpadding="1" align="center" class="loginform">
				<tr><td align="center"><img src="images/security.jpg"></td></tr>
				<tr>
					<td align="center">
						<table align="center" cellpadding="5" cellspacing="0">
							<? if($msg!=NULL){?><tr><td align="center" style="color:#FF6600; font-weight:bold"><?=$msg?></td></tr><? }?>
							<form name="frmLogin" method="post" action="login_authentication.php" onsubmit="return checkIn();">
							<tr><td style="padding-left: 10px; color:#333333"><u>U</u>ser Name:</td></tr>
							<tr><td style="padding-left: 10px"><input type="text" name="txtUser" size="20" class="textbox" maxlength="20" accesskey="u"></td></tr>
							<tr><td style="padding-left: 10px; color:#333333"><u>P</u>assword:</td></tr>
							<tr><td style="padding-left: 10px"><input type="password" name="txtPWD" size="15" maxlength="15" class="textbox" accesskey="p"></td></tr>
							<tr>
								<td style="padding-left: 10px">
									<button type="submit" name="submit" class="text_grey" accesskey="s"><u>S</u>ign in</button> &nbsp;&nbsp;
									<button type="reset" name="reset" class="text_grey" accesskey="r"><u>R</u>eset</button>
								</td>
							</tr>
							<tr><td style="padding-left: 5px; color:#333333"><input type="checkbox" name="REM" value="yes" accesskey="m">Re<u>m</u>ember my password</td></tr>
							</form>
							<script>storedValues()</script>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>