<?
if(!$_PAGE_VALID)
{
	exit();
}

if($isLogin)
{
	redirect("$_URL_BASE/");
}

$contentDetail = NULL;

if($doAction == 'send')
{	
	$conds = "member_email='".strtolower($email)."'";
	$sql->set_query("vot_member", "member_email", $conds);

	if(!$isSent && $sql->nRows < 1)
	{
		$myOrder = $opt->optionvalue("vot_member","MAX(member_order)") + 1;
		$ndate = date("Y-m-d");
		$actCode = $myOrder.'_tk102';
		$fields = "member_name,member_email,member_pwd,member_org,member_add,member_tel,member_activecode,member_date,member_order";
		$values  = "'".insertData($fullname)."','".strtolower($email)."','".md5($password)."','".insertData($organization)."','".insertData($address)."','".$tel."','".md5($actCode)."','".$ndate."','".$myOrder."'";
		$sql->insert("vot_member", $fields, $values);
		
		$sql = new mysql;

		$title = $define["var_thongbaotu"]." ".str_replace('http://','',$config["domain"]);
		
		$actLink = $config["domain"];
		if($config["script_path"]) $actLink .= '/'.$config["script_path"];
		$actLink .= '/members.php/active/'.md5($actCode);
		
		echo $content = '
		<div>C&#7843;m &#417;n b&#7841;n &#273;&#227; tham gia l&#224;m  th&#224;nh vi&#234;n c&#7911;a ch&#250;ng t&#244;i.</div>
		<div>&#272;&#7875; s&#7917; d&#7909;ng &#273;&#432;&#7907;c t&#224;i kh&#7843;i b&#7841;n vui l&#242;ng click <a href="'.$actLink.'">'.$actLink.'</a> &#273;&#7875; k&#237;ch ho&#7841;t</div>';
/*
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
		
		$mail->From     = $config["site_email"];				// Email duoc gui tu???
		$mail->FromName = 'coalimex.vn';					// Ten hom email duoc gui
		$mail->AddAddress($email,$fullname);	 	// Dia chi email va ten nhan
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
*/
		$isSent = 1;
		_SESSION_REGISTER("isSent");
	}
	$conds = "language_id='".$lang."' AND html_id='regsuccess'";
	$sql->set_query("vot_html", "*", $conds);
	if($sql->set_farray())
	{	
		$contentDetail = displayData_DB($sql->farray["html_detail"]);
	}
}
else
{
	$isSent = 0;
	_SESSION_REGISTER("isSent");
	
	$regNote = NULL;
	$regPrivacy = NULL;
	
	$conds = "language_id='".$lang."' AND html_id='regnote'";
	$sql->set_query("vot_html", "*", $conds);
	if($sql->set_farray())
	{	
		$regNote = displayData_DB($sql->farray["html_detail"]);
	}
	$conds = "language_id='".$lang."' AND html_id='privacy'";
	$sql->set_query("vot_html", "*", $conds);
	if($sql->set_farray())
	{	
		$regPrivacy = displayData_DB($sql->farray["html_detail"]);
	}
}

require_once("$_HTML_DIR/center_register_page.php");
?>