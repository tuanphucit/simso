<?
include_once("../includes/global.php");
include_once("../includes/chksession.php");

if($usrid!=0)
{
	echo '<script language="javascript">window.close()</script>';
	exit();
}

if($myAction == "save")
{
	$varValue = formatStringDefineIn($varValue);
	$content = openFile("../../languages/default/define.php");
	$content  = str_replace("?>","",$content);
	$content .= '$lang_def["'.$varName.'"] = "'.$varValue.'";';
	$content .= "\n?>";
	
	saveFile("../../languages/default/define.php",$content);
	
	$myAction = NULL;
	_SESSION_REGISTER("myAction");
	
	echo '<script language="javascript">';
	echo 'window.opener.location.reload();';
	echo 'window.close();';
	echo '</script>';

	exit();
}
else 
{
	include_once("form_add_define.html");
}
?>