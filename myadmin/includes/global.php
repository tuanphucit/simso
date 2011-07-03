<?
@session_start();
if($REQUEST_METHOD=='POST'){
	@header('Expires: ' . gmdate("D, d M Y H:i:s", time()+1000) . ' GMT');
	@header('Cache-Control: public,must-revalidate');
	@header("Pragma: no-cache");
}
	
define("FULL","y_y_y_y");
define("YES","y");
define("NO","n");
define("HTML_PAGE","html_page");
define("EDIT_PAGE","edit_page");
define("DEFINE_PAGE","define_page");
define("FORM_SELF","form_selft");
define("FORM_BLANK","form_blank");

define('NORESULT','<tr><td class="noresult">Found not data!</td></tr>');
define("_NO_IMG","images/noimg.jpg");

include_once("language.php");
include_once("config.php");
include_once("mysql.php");
include_once("functions.php");

$_URL_BASE 	= $config["domain"];
$_ROOT_PATH = _SERVER('DOCUMENT_ROOT');

if(!$_ROOT_PATH && $config["root_path"])
{
	$_ROOT_PATH = $config["root_path"];
}

if($config["script_path"] != NULL)
{
	$_ROOT_PATH .= "/".$config["script_path"];
	$_URL_BASE 	.= "/".$config["script_path"];
}

$_JS_DIR 		= "$_URL_BASE/myadmin/js";
$_CSS_DIR 	= "$_URL_BASE/myadmin/css";
$_IMG_DIR 	= "$_URL_BASE/myadmin/images";
$_INCS_DIR 	= "$_ROOT_PATH/myadmin/includes";
$_HTML_DIR 	= "$_ROOT_PATH/myadmin/html_includes";
$_LANG_DIR 	= "$_ROOT_PATH/myadmin/languages";

//echo 'Session vars:<br>';
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
	$$sesNames[$i] = _SESSION($sesNames[$i]);
	//echo '$'.$sesNames[$i].' = "'.$$sesNames[$i].'";<br>';
}

//echo '<br>Post vars:<br>';
if($_POST)
{
	$postNames = array_keys($_POST);
}
elseif($HTTP_POST_VARS)
{
	$postNames = array_keys($HTTP_POST_VARS);
}
for($i = 0; $i < sizeof($postNames); $i++)
{
	$$postNames[$i] = _POST($postNames[$i]);
	//echo '$'.$postNames[$i].' = "'.$$postNames[$i].'";<br>';
}

//echo '<br>Get vars:<br>';
if($_GET)
{
	$postNames = array_keys($_GET);
}
elseif($HTTP_GET_VARS)
{
	$postNames = array_keys($HTTP_GET_VARS);
}
for($i = 0; $i < sizeof($postNames); $i++)
{
	$$postNames[$i] = _POST($postNames[$i]);
	//echo '$'.$postNames[$i].' = "'.$$postNames[$i].'";<br>';
}

//echo '<br>Files vars:<br>';
if($_FILES)
{
	$postNames = array_keys($_FILES);
	for($i = 0; $i < sizeof($postNames); $i++)
	{
		$fileNames = array_keys($_FILES[$postNames[$i]]);
		for($j = 0; $j < sizeof($fileNames); $j++)
		{
			$varName = $postNames[$i].'_'.$fileNames[$j];
			$$varName = $_FILES[$postNames[$i]][$fileNames[$j]];
			//echo '$'.$varName.' = "'.$$varName.'";<br>';
		}
	}
}
elseif($HTTP_FILES_VARS)
{
	$postNames = array_keys($HTTP_FILES_VARS);
	for($i = 0; $i < sizeof($postNames); $i++)
	{
		$fileNames = array_keys($HTTP_FILES_VARS[$postNames[$i]]);
		for($j = 0; $j < sizeof($fileNames); $j++)
		{
			$varName = $postNames[$i].'_'.$fileNames[$j];
			$$varName = $HTTP_FILES_VARS[$postNames[$i]][$fileNames[$j]];
			//echo '$'.$varName.' = "'.$$varName.'";<br>';
		}
	}
}

include_once("set_permision.php");

$maxPages = 3;
$maxRows = 10;
$and = NULL;
$module = _POST("module");

$checked = array(0 => NULL, 1 => "checked");

if($module == NULL || !is_dir("$module/")) $module = "home";
if(is_file("$module/main.php")) $file = "$module/main.php";
?>