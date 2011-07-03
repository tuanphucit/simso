<?
include_once("../includes/global.php");
include_once("../includes/chksession.php");

if($usrperstr != FULL && $usrid != 0)
{
	exit();
}

$sql = new mysql();
$opt = new option();
?>
<html>
<head>
	<title>Administration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>">
	<meta http-equiv="expires" content="0">
	<meta name="resource" content="document">
	<meta name="distribution" content="global">
	<style type="text/css">@import url("<?=$_CSS_DIR?>/style.css");</style>
</head>
<body>
<table width="100%" height="100%" cellpadding=0 cellspacing=0 align="center" bgcolor="#EEEEEE">
<?
$conds = "language_id='".$LANG."' AND mailreg_view=1";
$other = "ORDER BY mailreg_order ASC";
$sql->set_query("vot_mailreg", "mailreg_name", $conds, $others);
if($sql->nRows < 1)
{
?>
	<tr>
		<td style="font-weight:bold; text-align:center">Danh s&#225;ch nh&#7853;n r&#7895;ng! <br>Vui l&#242;ng ki&#7875;m tra l&#7841;i.</td>
	</tr>
<?
}
else
{
	$fromName = str_replace('http://','',$config["domain"]);
	$title = "Tin moi tu $fromName";
	$content = '
	<html>
	<head>
	<title>'.$title.'</title>
	</head>
	<!--
	<style>
		body { margin: 0px 0px 0px 0px; font-family:Arial; font-size: 11px; }
		td { font-family:Arial; font-size: 11px; }
	</style>
	-->
	<body>
	<table width="700" cellpadding="5" cellspacing="1">
		<tr>
			<td>'.$opt->optionvalue("vot_html", "html_detail", "language_id='".$LANG."' AND html_id='mailwritting'").'</td>
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
	
	$mail->From     = $config["site_email"];			// Email duoc gui tu???
	$mail->FromName = $fromName;									// Ten hom email duoc gui
	while($sql->set_farray())
	{
		$mailTo = $sql->farray["mailreg_name"];
		$mail->AddAddress($mailTo);	 								// Dia chi email va ten nhan
	}
	$mail->AddReplyTo($mail->From, $mail->FromName);		// Dia chi email va ten gui lai
	
	$mail->IsHTML(true);						// Gui theo dang HTML
	
	$mail->Subject  =  $title;			// Chu de email
	$mail->Body     =  $content;		// Noi dung html
	
	if(!$mail->Send())
	{
		 echo "Email ch&#432;a &#273;&#432;&#7907;c g&#7917;i &#273;i! <p>";
		 echo "L&#7895;i: " . $mail->ErrorInfo;
		 exit;
	}
?>
	<tr>
		<td style="font-weight:bold; text-align:center" height="40">Danh s&#225;ch c&#225;c mail &#273;&#432;&#7907;c g&#7917;i</td>
	</tr>
	<tr>
		<td align="center">
			<div style="width:300px; height:200px; overflow:auto">
				<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#EEEEEE" bgcolor="#FFFFFF" style="border-collapse:collapse">
<?
	$reVal = array(0 => '<img src="../images/publish_x.png" alt="G&#7917;i h&#7887;ng">', 1 => '<img src="../images/tick.png" alt="G&#7917;i th&#224;nh c&#244;ng">');
	for($i=0; $i<count($mail->myResult); $i++)
	{
?>
					<tr>
						<td width="80%" nowrap><?=$mail->myResult[$i]['name']?></td>
						<td width="20%" align="center" nowrap><?=$reVal[$mail->myResult[$i]['value']]?></td>
					</tr>
<?
	}
?>
				</table>
			</div>
		</td>
	</tr>
<?
}
?>
	<tr>
		<td height="40" style="font-weight:bold; text-align:center">
			<a href="javascript:window.close()">&#272;&#243;ng</a>
		</td>
	</tr>
</table>
</body>
</html>