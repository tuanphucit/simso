<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");
if($doAction == "send" && !$isSent && $itemId)
{
	$sql = new mysql;
	$conds = "news_id='".$itemId."'";
	$sql->set_query("vot_news", "*", $conds);
	if($sql->set_farray())
	{
		$newsName = $sql->farray["news_name"];
		$modId = $sql->farray["modules_id"];
		$newsLinkto = $config["domain"]."$_URL_BASE/index.php/$modId/$itemId";
	}
	$title = "Y kien khach hang tu ".str_replace('http://','',$config["domain"]);
	$from = $email;
	
	$content = '
	<html>
	<head>
	<title>'.$title.'</title>
	</head>
	<!--
	<style>
		td{ font-family:Verdana,Arial; font-size: 11px;}
	</style>
	-->
	<body>
	<table width="600" cellpadding="5" cellspacing="1" align="center">
		<tr bgcolor="#ECF5FF">
			<td colspan="2" style="padding-bottom:10px;padding-left:15px">'.$define["var_ykienvebaiviet"].': <a href="'.$newsLinkto.'" target="_blank">'.$newsName.'</a></td>
		</tr>
		<tr bgcolor="#ECF5FF">
			<td width="20%" nowrap><b>'.$define["var_hovaten"].':</b></td>
			<td width="70%">'.$yourName.'</td>
		</tr>
		<tr bgcolor="#ECF5FF">
			<td nowrap><b>'.$define["var_email"].':</b></td>
			<td>'.$yourEmail.'</td>
		</tr>
		<tr bgcolor="#ECF5FF">
			<td nowrap><b>'.$define["var_tieude"].':</b></td>
			<td>'.$yourTitle.'</td>
		</tr>
		<tr bgcolor="#ECF5FF">
			<td nowrap><b>'.$define["var_noidung"].':</b></td>
			<td>'.$yourMess.'</td>
		</tr>
	</table>
	</body>
	</html>';

	require("$_INCS_DIR/class.phpmailer.php");
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SetLanguage("vn", "");
	$mail->Host     = $config["smtp_host"];
	$mail->SMTPAuth = true;
	
	////////////////////////////////////////////////
	// Ban hay sua cac thong tin sau cho phu hop
	
	$mail->Username = $config["smtp_mail"];				// SMTP username
	$mail->Password = $config["smtp_pwd"]; 				// SMTP password
	
	$mail->From     = $yourEmail;				// Email duoc gui tu???
	$mail->FromName = $yourName;					// Ten hom email duoc gui
	$mail->AddAddress($config["site_email"],"coalimex.vn");	 	// Dia chi email va ten nhan
	$mail->AddReplyTo($mail->From, $mail->FromName);		// Dia chi email va ten gui lai
	
	$mail->IsHTML(true);						// Gui theo dang HTML
	
	$mail->Subject  =  $title;				// Chu de email
	$mail->Body     =  $content;		// Noi dung html
	
	if(!$mail->Send())
	{
		 echo "Email ch&#432;a &#273;&#432;&#7907;c g&#7917;i &#273;i! <p>";
		 echo "L&#7895;i: " . $mail->ErrorInfo;
		 exit;
	}
	$isSent = 1;
	_SESSION_REGISTER("isSent");
	echo '
	<table width="100%" height="150" align="center" cellpadding="3" cellspacing="0">
		<tr height="25">
			<td style="font-size:14px; font-weight:bold; padding:15px 0px 10px 0px">'.$define["var_ykiencuaban"].'</td>
		</tr>
		<tr>
			<td align="center" style="color:#003399; font-size:11px">
				<div>'.$define["var_thongtindaduocgui"].'</div>
				<div>'.$define["var_camonbandadonggopykien"].'</div>
			</td>
		</tr>
	</table>';
}
else
{
	$isSent = NULL;
	_SESSION_REGISTER("isSent");
?>
<form name="suggestionFrm" action="<?=$_URL_BASE?>/includes/suggestion.php?itemId=<?=$itemId?>" method="post" onSubmit="return doSugFrmSubmit()">
<table width="100%" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td colspan="2" style="font-size:14px; font-weight:bold; padding:15px 0px 10px 0px"><?=$define["var_ykiencuaban"]?></td>
	</tr>
	<tr>
		<td width="20%" nowrap style="font-size:11px" align="right"><?=$define["var_hovaten"]?> : </td>
		<td width="80%"><input type="text" name="yourName" maxlength="100" style="width:250px" class="textBox">&nbsp;<font color="#FF3300">*</font></td>
	</tr>
	<tr>
		<td width="20%" nowrap style="font-size:11px" align="right"><?=$define["var_emailcuaban"]?> : </td>
		<td width="80%"><input type="text" name="yourEmail" maxlength="200" style="width:250px" class="textBox">&nbsp;<font color="#FF3300">*</font></td>
	</tr>
	<tr>
		<td width="20%" nowrap style="font-size:11px" align="right"><?=$define["var_tieude"]?> : </td>
		<td width="80%"><input type="text" name="yourTitle" maxlength="200" style="width:250px" class="textBox"></td>
	</tr>
	<tr>
		<td width="20%" nowrap style="font-size:11px; padding-top:5px" align="right" valign="top"><?=$define["var_noidung"]?> : </td>
		<td width="80%"><textarea name="yourMess" rows="5" style="width:250px"></textarea></td>
	</tr>
	<tr>
		<td width="20%" nowrap>&nbsp;</td>
		<td width="80%">
			<input type="hidden" name="doAction" value="send">
			<button type="submit" name="sendToSbm"><?=$define["var_gui"]?></button>&nbsp;&nbsp;
			<button type="reset" name="sendToReset"><?=$define["var_nhaplai"]?></button>
		</td>
	</tr>
</table>
</form>
<?
}
?>