<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

if(!$isLogin)
{
	redirect("$_URL_BASE/");
}

$oldpwd = md5(_POST('oldpwd'));

$conds = "member_email='".$ses_mem_email."' AND member_password='".$oldpwd."'";
$sql->set_query("vot_member", "member_email", $conds);
echo $sql->nRows ;
?>