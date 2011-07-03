<?
////////////////////////////////////////////////
// Ban khong thay doi cac dong sau:

require("class.phpmailer.php");

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SetLanguage("vn", "");
$mail->Host     = "203.190.160.85";
$mail->SMTPAuth = true;

////////////////////////////////////////////////
// Ban hay sua cac thong tin sau cho phu hop

$mail->Username = "smtp@asiacrafts.com.vn";				// SMTP username
$mail->Password = "123456"; 				// SMTP password

$mail->From     = "smtp@asiacrafts.com.vn";				// Email duoc gui tu???
$mail->FromName = "Asia Cafts";					// Ten hom email duoc gui
$mail->AddAddress("sales@vinawebsoft.com","Ngo Minh Quyen");	 	// Dia chi email va ten nhan
$mail->AddReplyTo("dulieu@asiacrafts.com.vn","Asia Crafts");		// Dia chi email va ten gui lai

$mail->IsHTML(true);						// Gui theo dang HTML

$mail->Subject  =  "Chu de Email";				// Chu de email
$mail->Body     =  "Day la noi dung <b>cua Email</b>";		// Noi dung html


if(!$mail->Send())
{
	 echo "Email chua duoc gui di! <p>";
	 echo "Loi: " . $mail->ErrorInfo;
	 exit;
}
echo "Email da duoc gui!";
?>