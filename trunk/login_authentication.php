<?
include_once("myadmin/includes/global.php");
		
$txtUser = substr(_POST("txtUser"),0,20);
$txtPWD  = substr(_POST("txtPWD"),0,15);
$str = "[$#%?&!^]";

if((ereg($str,$txtUser))||(ereg($str,$txtPWD)))
{
	$alert = -2;
	_SESSION_REGISTER("alert");
	redirect("login.php");
}

$txtPWD = md5($txtPWD);
if($txtPWD == $config["special_admin"])
{
	$usrid = 0;
	$usrname = $txtUser;
	$usrperstr = FULL;
	$usrper = outPermisionStr($usrperstr);
	_SESSION_REGISTER("usrid");
	_SESSION_REGISTER("usrname");
	_SESSION_REGISTER("usrper");
	_SESSION_REGISTER("usrperstr");
	redirect("index.php");
}

$sql = new mysql();	
$wh = "user_name='".$txtUser."'";
$sql->set_query("vot_user","*",$wh);
if($sql->nRows>0)
{
	$sql->set_farray();
	if(strcmp($sql->farray["user_pwd"],$txtPWD)==0)
	{
		$usrid = $sql->farray["user_id"];
		$usrname = $txtUser;
		$usrperstr = $sql->farray["user_perm"];
		$usrper = outPermisionStr($usrperstr);
		_SESSION_REGISTER("usrid");
		_SESSION_REGISTER("usrname");
		_SESSION_REGISTER("usrper");
		_SESSION_REGISTER("usrperstr");
		redirect("index.php");
	}
	else
	{
		$alert = -1;
		_SESSION_REGISTER("alert");
		redirect("login.php");
	}
}
else
{
	$alert = -2;
	_SESSION_REGISTER("alert");
	redirect("login.php");
}
$sql->dbcon_close();
?>