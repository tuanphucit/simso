<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

$email = _POST('email');

$conds = "member_email='".strtolower($email)."'";
$sql->set_query("vot_member", "member_email", $conds);
echo $sql->nRows ;
?>