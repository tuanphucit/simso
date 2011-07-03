<?
session_cache_expire(480);
session_start();
include_once("myadmin/includes/config.php");
include_once("myadmin/includes/mysql.php");
include_once("includes/global.php");
$curPage = NULL;
$subPageTitle = NULL;
if(!$cateId)
{
	$curPage = $define["var_trangchu"];
	$contentFile = "$_MOD_DIR/home.php";
	if($cateName == 'contact')
	{
		$curPage = $define["var_lienhe"];
		$contentFile = "$_MOD_DIR/contact.php";
	}
	elseif($cateName == 'order')
	{
		$curPage = $define["var_datmuasim"];
		$contentFile = "$_MOD_DIR/order.php";
	}
	elseif($cateName == 'customer')
	{
		$curPage = $define["var_datmuasim"];
		$contentFile = "$_MOD_DIR/customer.php";
	}
	elseif($cateName == 'sitemap')
	{
		$curPage = $define["var_sitemap"];
		$contentFile = "$_MOD_DIR/sitemap.php";
	}
	elseif($cateName == 'register')
	{
		$curPage = $define["var_dangky"];
		$contentFile = "$_MOD_DIR/register.php";
	}
		elseif($cateName == 'dowload')
	{
		$curPage = $define["var_dangky"];
		$contentFile = "$_MOD_DIR/dowload.php";
	}
	elseif($cateName == 'tailieu')
	{
		$curPage = $define["var_timkiemnangcao"];
		$subPageTitle = $curPage;
		$contentFile = "$_MOD_DIR/tailieu.php";
	}elseif($cateName == 'timkiem')
	{
	$curPage = $define["var_timkiemnangcao"];
	$subPageTitle = $curPage;
	$contentFile = "$_MOD_DIR/timkiem.php";
	}
	elseif($cateName == 'timnhanh')
	{
	$curPage = $define["var_timntheodauso"];
	$subPageTitle = $curPage;
	$contentFile = "$_MOD_DIR/timnhanh.php";
	}
}
else
{
	$froms = "vot_modules";
	$conds = "modules_id='".$cateId."'";
	$sql->set_query($froms, "*", $conds);
	if($sql->set_farray())
	{
		$modId = $sql->farray["modules_id"];
		$curModId = $modId;
		$modName = strip_tags($sql->farray["modules_name"]);
		$modIcon = $sql->farray["modules_icon"];
		$subPageTitle = $modName;
		$modSource = $sql->farray["modules_type"];
		$contentFile = "$_MOD_DIR/$modSource.php";
		$curLeftMenu = $sql->farray["modules_parent"];
	}
	$curPage = getRootCate($cateId);
	
}

$rightFile = "$_HTML_DIR/right_page.php";

require_once("$_HTML_DIR/begin_html_page.php");
require_once("$_HTML_DIR/body_page.php");
//require_once("$_HTML_DIR/end_html_page.php");
include_once 'call.php';
?>

