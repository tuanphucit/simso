<?
session_start();

include_once("myadmin/includes/config.php");
include_once("myadmin/includes/mysql.php");
include_once("includes/global.php");

$curPage = NULL;
$subPageTitle = NULL;

$url_array = array();

if(!_SERVER('QUERY_STRING')) 
{
	$url = strip_tags(_SERVER('REQUEST_URI'));
	if($config["script_path"])
	{
		$url = str_replace("/".$config["script_path"],"",$url);
	}
	$url = str_replace("/members.php", "", $url);
	$url_array = explode("/",$url);
	array_shift($url_array);
}

$request = $url_array[0];
$value = $url_array[1];

if($isLogin)
{
	if($request != 'profile' && $request != 'logout')
	{
		$request = 'profile';
	}
	if($request == 'profile')
	{
		$curPage = $define["var_thongtintaikhoan"];
		$contentFile = "$_MOD_DIR/profile.php";
	}
	if($request == 'logout')
	{
		_SESSION_DESTROY('isLogin');
		_SESSION_DESTROY('ses_mem_email');
		_SESSION_DESTROY('ses_mem_name');
		_SESSION_DESTROY('ses_mem_org');
		_SESSION_DESTROY('ses_mem_add');
		_SESSION_DESTROY('ses_mem_tel');
		redirect("$_URL_BASE/");
	}
}
else
{
	if(!$request) $request = 'register';
	if($request == 'active')
	{
		$curPage = $define["var_dangkythanhvien"];
		$contentFile = "$_MOD_DIR/active.php";
	}
	if($request == 'register')
	{
		$curPage = $define["var_dangkythanhvien"];
		$contentFile = "$_MOD_DIR/register.php";
	}
}
$subPageTitle = $curPage;
$modIcon = "$_IMG_DIR/icons/icon_tuyendung.jpg";

$rightFile = "$_HTML_DIR/right_page.php";

require_once("$_HTML_DIR/begin_html_page.php");
require_once("$_HTML_DIR/body_page.php");
require_once("$_HTML_DIR/end_html_page.php");

?>