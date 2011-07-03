<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

$regEmail = _POST('regEmail');
$regPwd = _POST('regPwd');

$conds = "member_email='".$regEmail."' AND member_pwd='".md5($regPwd)."' AND member_view=1";
$sql->set_query("vot_member", "*", $conds);
if($sql->set_farray())
{
	$isLogin = 1;
	
	$ses_mem_email = $sql->farray["member_email"];
	$ses_mem_name = $sql->farray["member_name"];
	$ses_mem_org = $sql->farray["member_org"];
	$ses_mem_add = $sql->farray["member_add"];
	$ses_mem_tel = $sql->farray["member_tel"];
				
	_SESSION_REGISTER('isLogin');
	_SESSION_REGISTER('ses_mem_email');
	_SESSION_REGISTER('ses_mem_name');
	_SESSION_REGISTER('ses_mem_org');
	_SESSION_REGISTER('ses_mem_add');
	_SESSION_REGISTER('ses_mem_tel');
}
else
{
	echo 'NO';
}
?>