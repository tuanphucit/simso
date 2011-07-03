<?
$_PAGE_VALID = 1;

include_once("common_functions.php");

$_URL_BASE 	= NULL;
$_ROOT_PATH = _SERVER('DOCUMENT_ROOT');

if($config["root_path"])
{
	$_ROOT_PATH = $config["root_path"];
}

if($config["script_path"] != NULL)
{
	$_ROOT_PATH .= "/".$config["script_path"];
	$_URL_BASE 	.= "/".$config["script_path"];
}

$_JS_DIR 		= "$_URL_BASE/js";
$_CSS_DIR 	= "$_URL_BASE/css";
$_IMG_DIR 	= "$_URL_BASE/images";
$_INCS_DIR 	= "$_ROOT_PATH/includes";
$_HTML_DIR 	= "$_ROOT_PATH/html_includes";
$_LANG_DIR 	= "$_ROOT_PATH/languages";
$_MOD_DIR 	= "$_ROOT_PATH/modules";

$url_array = array();

if(!_SERVER('QUERY_STRING')) 
{
	$url = strip_tags(_SERVER('REQUEST_URI'));
	if($config["script_path"])
	{
		$url = str_replace("/".$config["script_path"],"",$url);
	}
	$url = str_replace("/index.php", "", $url);
	$url_array = explode("/",$url);
	array_shift($url_array);
}

$my_url = $url_array;

if((int)($my_url[0]))
{
	$cateId = $url_array[0];
}
else
{
	$cateId = NULL;
	$itemId = NULL;
	$cateName = $url_array[0];
}
if($cateId)
{
	if((int)($my_url[1]))
	{
		$itemId = $url_array[1];
		$itemName = $url_array[2];
	}
	else
	{
		$itemId = NULL;
		$cateName = $url_array[1];
	}
}

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

$sql = new mysql();
$opt = new option();

$lang = (_POST("lang") != NULL) ? _POST("lang") : _SESSION("lang");
if($lang != NULL)
{
	$lang_cond = "language_id=$lang";
	$lang_other = NULL;
}
else
{
	$lang_cond = NULL;
	$lang_other = "ORDER BY language_order ASC LIMIT 1";
}

$sql->set_query("vot_language","*",$lang_cond,$lang_other);
if($sql->set_farray())
{
	$lang = $sql->farray["language_id"];
}

$path_def = $sql->farray["language_dir"];
_SESSION_REGISTER("lang");


include_once("counter.php");
include_once("$_LANG_DIR/$path_def/define.php");
$siteTitle = $define["var_title"];
?>