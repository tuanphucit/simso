<?
if(!$_PAGE_VALID)
{
	exit();
}

$subPageTitle = $define["var_lienhe"];
$contentDetail = NULL;

if($doAction == 'send')
{
	if(!$isSent)
	{
		if($securityCode != _SESSION('security_code'))
		{
			$errorMess = $define["var_mabaovechuadung"];
		}
		else
		{
			$title = "Lien he tu ".str_replace('http://','',$config["domain"]);
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
				<tr bgcolor="#ECF5FF"><td width="20%" nowrap><b>'.$define["var_nguoilienhe"].':</b></td><td width="70%">'.$fullname.'</td></tr>
				<tr bgcolor="#ECF5FF"><td nowrap><b>'.$define["var_diachi"].':</b></td><td>'.$address.'</td></tr>
				<tr bgcolor="#ECF5FF"><td nowrap><b>'.$define["var_dienthoai"].':</b></td><td>'.$tel.'</td></tr>
				<tr bgcolor="#ECF5FF"><td nowrap><b>'.$define["var_email"].':</b></td><td>'.$email.'</td></tr>
				<tr bgcolor="#ECF5FF"><td nowrap><b>'.$define["var_noidungyeucau"].':</b></td><td>'.$request.'</td></tr>
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
			
			$mail->From     = $email;				// Email duoc gui tu???
			$mail->FromName = $fullname;					// Ten hom email duoc gui
			$mail->AddAddress($config["site_email"],$config["site_email"]);	 	// Dia chi email va ten nhan
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
		}
		$sentContent  = '<div style="font-size:11px; color:#003399">'.$define["var_thongtindaduocgui"].'</div>';
		$sentContent .= '<div style="font-size:11px; color:#003399">'.$define["var_camonbandadonggopykien"].'</div>';
	}
}
else
{
	$isSent = 0;
	_SESSION_REGISTER("isSent");

	$isSent = 0;
	_SESSION_REGISTER("isSent");
}

$conds = "language_id='".$lang."' AND html_id='contact'";
$sql->set_query("vot_html", "*", $conds);
if($sql->set_farray())
{	
	$contentDetail = displayData_DB($sql->farray["html_detail"]);
}

	require_once("$_HTML_DIR/center_contact_page.php");
?>
