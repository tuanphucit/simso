<?
include_once("includes/global.php");

if($_SESSION)
{
	$sesNames = array_keys($_SESSION);
}
elseif($HTTP_SESSION_VARS)
{
	$sesNames = array_keys($HTTP_SESSION_VARS);
}
for($i = 0; $i < sizeof($sesNames); $i++)
{
	_SESSION_DESTROY($sesNames[$i]);
}
redirect("login.php");		
?>