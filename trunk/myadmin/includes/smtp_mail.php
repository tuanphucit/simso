<?
//$from_vols			= "mail@abc.com"; 	// account dang nhap gui thu trung voi $params["mail"] 
//$dmail = "nhan@abc.com" // hom thu nhan mail gui tu trang Web.
/* ung dung thuc te
	//get infor about customer		
		$title			= $_POST["title"];
		$fullname		= $_POST["fullname"];
		$email			= $_POST["email"];		
		$address		= $_POST["address"];
		$tel			= $_POST["tel"];
		$company		= $_POST["company"];
		$country		= $_POST["country"];
		$request		= $_POST["request"];
		//Input DB
		$tbl_contact =  "contact";
		create_object_sql();
		$time = time();
		$insert_query = "INSERT INTO $tbl_contact(contact_title, contact_fullname, contact_email, contact_address, contact_tel, contact_company, contact_country, contact_request, contact_date, lang) VALUES('$title', '$fullname', '$email', '$address', '$tel','$company','$country', '$request', $time, $lang)";
		$sql->execute($insert_query);	
		$sql->close();	
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8'. "\r\n";
		$headers .= 'From:'.$email. "\r\n";		
		$subject  = "Email contact of Customer...";
		$message = "
		<html>
		<head>
		<title>.:: Contact - Vinabt.com ::.</title>
		<style type='text/css'>
		<!--
		.style1 {
			color: #FFFFFF;
			font-weight: bold;
		}
		-->
		</style>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
		</head>
		<body>  
		  <table width='100%'>
			<tr>
			  <td width='17%'>Title: </td>
			  <td width='83%'>".$title."</td>
			</tr>
			<tr>
			  <td>Fullname: </td>
			  <td>".$fullname."</td>
			</tr>
			<tr>
			  <td>Email: </td>
			  <td>".$email."</td>
			</tr>
			<tr>
			  <td>Address: </td>
			  <td>".$address."</td>
			</tr>
			<tr>
			  <td>Tel: </td>
			  <td>".$tel."</td>
			</tr>
			<tr>
			  <td>Company: </td>
			  <td>".$company."</td>
			</tr>
			<tr>
			  <td>Country: </td>
			  <td>".$country."</td>
			</tr>
			<tr>
			  <td>Requests or Comments:</td>
			  <td>".$request."</td>
			</tr>			
		  </table>
		</body>
		</html>";
		if(@sock_mail(1,$dmail,$subject,$message,$headers,$from_vols,$params)){
			echo "<br><br><table width='100%'  cellspacing='0' cellpadding='0'>\n";
    		echo "<tr>\n";
      			echo "<td>\n";
				echo "<div align='center'><font style='font-farmily:arial; font-size:12px; color=red'>Thank you very much ! Your contact has been sent !</font></div></td>\n";
    		echo "</tr>\n";
    		echo "<tr>\n";
      		echo "<td>\n";
				echo "<div align='center' class='normal_font'><a href='index.php'>Continue...</a></div></td>\n";
    		echo "</tr>\n";
  			echo "</table>\n";
		}else{
			echo "Mail error. Please contact webmater about this error.";
		}	
}
?>

*/
//this is the sock mail function 

function sock_mail($auth,$to, $subj, $body, $head, $from)
{
	global $config;
	$lb="\r\n";                        //linebreak 
	$body_lb="\r\n";                //body linebreak 
	$loc_host = $config["smtp_host"];        //localhost 
	$smtp_acc = $config["smtp_mail"];        //account 
	$smtp_pass= $config["smtp_pwd"];        //password 
	$smtp_host= $config["smtp_smtp"];    //server SMTP 
	$hdr = explode($lb,$head);        //header 
	
	if($body) {$bdy = preg_replace("/^\./","..",explode($body_lb,$body));} 
	
	// build the array for the SMTP dialog. Line content is array(command, success code, additonal error message) 
	if($auth == 1)
	{// SMTP authentication methode AUTH LOGIN, use extended HELO "EHLO" 
		 $smtp = array( 
				 // call the server and tell the name of your local host 
				 array("EHLO ".$loc_host.$lb,"220,250","HELO error: "), 
				 // request to auth 
				 array("AUTH LOGIN".$lb,"334","AUTH error:"), 
				 // username 
				 array(base64_encode($smtp_acc).$lb,"334","AUTHENTIFICATION error : "), 
				 // password 
				 array(base64_encode($smtp_pass).$lb,"235","AUTHENTIFICATION error : ")); 
	} 
	else 
	{// no authentication, use standard HELO    
		 $smtp = array( 
				 // call the server and tell the name of your local host 
				 array("HELO ".$loc_host.$lb,"220,250","HELO error: ")); 
	} 
	
	
	// envelop 
	$smtp[] = array("MAIL FROM: <".$from.">".$lb,"250","MAIL FROM error: "); 
	$smtp[] = array("RCPT TO: <".$to.">".$lb,"250","RCPT TO error: "); 
	// begin data        
	$smtp[] = array("DATA".$lb,"354","DATA error: "); 
	// header 
	$smtp[] = array("Subject: ".$subj.$lb,"",""); 
	$smtp[] = array("To:".$to.$lb,"","");        
	foreach($hdr as $h) {$smtp[] = array($h.$lb,"","");} 
	// end header, begin the body 
	$smtp[] = array($lb,"",""); 
	if($bdy) {foreach($bdy as $b) {$smtp[] = array($b.$body_lb,"","");}} 
	// end of message 
	$smtp[] = array(".".$lb,"250","DATA(end)error: "); 
	$smtp[] = array("QUIT".$lb,"221","QUIT error: "); 
	
	// open socket 
	$fp = @fsockopen($smtp_host, 25); 
	//if (!$fp) echo "<b>Error:</b> Cannot conect to ".$smtp_host."<br>"; 
	
	$banner = @fgets($fp, 1024); 
	// perform the SMTP dialog with all lines of the list 
	foreach($smtp as $req)
	{ 
		 $r = $req[0]; 
		 // send request 
		 @fputs($fp, $req[0]); 
		 // get available server messages and stop on errors 
		 if($req[1])
		 { 
				 while($result = @fgets($fp, 1024)){if(substr($result,3,1) == " ") { break; }}; 
				 if (!strstr($req[1],substr($result,0,3)))  $err=1;//echo"$req[2].$result<br>"; 
		 } 
	} 
	$result = @fgets($fp, 1024); 
	// close socket 
	@fclose($fp); 	   
	return $err==1 ? 0 : 1; 
	} 
	?>