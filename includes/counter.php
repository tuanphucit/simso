<?php	
if(!_SESSION("totalVisitors"))
{
	$sql = new mysql();
	$insert = "uservisitors_number=uservisitors_number+1";
	$where = "1=1";
	$sql->update("vot_uservisitors", $insert, $where);
}
$sql->set_query("vot_uservisitors");
if($sql->set_farray())
{
	$totalVisitors = $sql->farray["uservisitors_number"];
}
$link = mysql_connect ($config["db_host"], $config["db_user"], $config["db_pwd"]) or die($config["db_error"]);
mysql_select_db($config["db_name"], $link) or die("Khong tim thay Database!");

$timeout = 1200; 
// differentiate between two surfers 
$ip = @$_SERVER["REMOTE_ADDR"]; 
// remove old connections 
$q = "DELETE FROM vot_usersonline WHERE usersonline_datetime < now()"; 
$s = mysql_query($q, $link);
$q = "SELECT count(*) as No FROM vot_usersonline WHERE usersonline_ip='$ip'"; 
$s = mysql_query($q, $link);
while ($r = @mysql_fetch_array($s))
{ 
	$cpt = $r["No"];
} 
if($cpt)
{ 
	$q = "UPDATE vot_usersonline SET usersonline_datetime=usersonline_datetime + $timeout WHERE usersonline_ip='$ip'";
} 
else 
{ 
	$q = "INSERT INTO vot_usersonline VALUES ('$ip',now()+$timeout)";
} 
$s = mysql_query($q, $link);
$q = "SELECT count(*) as No FROM vot_usersonline"; 
$s = mysql_query($q, $link);
while ($r = @mysql_fetch_array($s)) 
{ 
	$cpt = $r["No"];
} 	
_SESSION_REGISTER("cpt");
_SESSION_REGISTER("totalVisitors");
?>