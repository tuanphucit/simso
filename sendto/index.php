<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");
if($doAction == "send" && !$isSent)
{
	require("$_INCS_DIR/class.phpmailer.php");
	
	$title = $define["var_thongtinboichtu"];
	$messege = "M&#7897;t ng&#432;&#7901;i b&#7841;n ";
	if($yourName != NULL)
	{
		$messege .= "c&#243; t&#234;n $yourName, ";
	}
	if($yourEmail != NULL)
	{
		$messege .= "c&#243; &#273;&#7883;a ch&#7881; email $yourEmail ";
	}
	$messege .= "g&#7917;i cho b&#7841;n m&#7897;t th&#244;ng tin b&#7893; &#237;ch t&#7841;i &#273;&#7883;a ch&#7881; website: <a href=\"$infoUrl\">$infoUrl</a> ";
	if($yourMess != NULL)
	{
		$messege .= "c&#249;ng v&#7899;i l&#7901;i nh&#7855;n:<div>$yourMess</div>";
	}
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SetLanguage("vn", "");
	$mail->Host     = $config["smtp_host"];
	$mail->SMTPAuth = true;
	
	////////////////////////////////////////////////
	// Ban hay sua cac thong tin sau cho phu hop
	
	$mail->Username = $config["smtp_mail"];				// SMTP username
	$mail->Password = $config["smtp_pwd"]; 				// SMTP password
	
	$mail->From     = $email;				// Email duoc gui tu???
	$mail->FromName = $fullname;					// Ten hom email duoc gui
	$mail->AddAddress($friendEmail,"Good friend");	 	// Dia chi email va ten nhan
	$mail->AddReplyTo($mail->From, $mail->FromName);		// Dia chi email va ten gui lai
	
	$mail->IsHTML(true);						// Gui theo dang HTML
	
	$mail->Subject  =  $title;				// Chu de email
	$mail->Body     =  $messege;		// Noi dung html
	
	if(!$mail->Send())
	{
		 echo "Email ch&#432;a &#273;&#432;&#7907;c g&#7917;i &#273;i! <p>";
		 echo "L&#7895;i: " . $mail->ErrorInfo;
		 exit;
	}
	$isSent = 1;
	_SESSION_REGISTER("isSent");
}
else
{
	$isSent = NULL;
	_SESSION_REGISTER("isSent");
?>
<form name="sendToFriend" action="<?=$_URL_BASE?>/sendto/" method="post" onSubmit="return doSendToSubmit()">
<table width="90%" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td width="20%" nowrap><?=$define["var_hovaten"]?></td>
		<td width="80%"><input type="text" name="yourName" maxlength="100" style="width:250px" class="textBox"></td>
	</tr>
	<tr>
		<td width="20%" nowrap><?=$define["var_emailcuaban"]?></td>
		<td width="80%"><input type="text" name="yourEmail" maxlength="200" style="width:250px" class="textBox"></td>
	</tr>
	<tr>
		<td width="20%" nowrap><?=$define["var_emailnguoinhan"]?></td>
		<td width="80%"><input type="text" name="friendEmail" maxlength="200" style="width:250px" class="textBox">&nbsp;<font color="#FF3300">*</font></td>
	</tr>
	<tr>
		<td width="20%" nowrap><?=$define["var_loinhan"]?></td>
		<td width="80%"><textarea name="yourMess" rows="5" style="width:250px"></textarea></td>
	</tr>
	<tr>
		<td width="20%" nowrap><?=$define["var_trangtinduocgui"]?></td>
		<td width="80%"><input type="text" name="infoUrl" maxlength="300" style="width:250px" readonly="1" value="<?=$infoUrl?>" class="textBox"></td>
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