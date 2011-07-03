<?
session_start();

include_once("myadmin/includes/config.php");
include_once("myadmin/includes/mysql.php");
include_once("includes/global.php");

if(!_SERVER('QUERY_STRING')) 
{
	$url = strip_tags(_SERVER('REQUEST_URI'));
	if($config["script_path"])
	{
		$url = str_replace("/".$config["script_path"],"",$url);
	}
	$url = str_replace("/show_docdes.php", "", $url);
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
if(!$itemId || !validGetVar($itemId))
{
	exit();
}
$conds = "document_id='".$itemId."'";
$sql->set_query("vot_document", "*", $conds);
if($sql->set_farray())
{
	$infoName = displayData_DB($sql->farray["document_name"]);
	$infoDate = outDateStr($sql->farray["document_date"]);
	//$infoDes = displayData_DB($sql->farray["document_shortdes"]);
	$infoDown = $sql->farray["document_down"];
	$docDownLink = "$_URL_BASE/downloaddoc.php/$itemId/doc";
	$pdfDownLink = "$_URL_BASE/downloaddoc.php/$itemId/pdf";

	$checkDownDoc = NULL;
	$checkDownPdf = NULL;
	/*
	if(!$isLogin)
	{
		$alertStr = str_replace("<br>", " ", $define["var_banchuadangnhap"]);
		$checkDownDoc = 'onClick="alert(\''.$alertStr.'\'); return false"';
		$checkDownPdf = 'onClick="alert(\''.$alertStr.'\'); return false"';
	}
	else
	{
	*/
	$alertStr = str_replace("<br>", " ", $define["var_xinloitailieuchuaduoccapnhat"]);
	$infoDoc = $sql->farray["document_msdoc"];
	$infoPdf = $sql->farray["document_adpdf"];
	if(!is_file("$_ROOT_PATH/$infoDoc"))
	{
		$checkDownDoc = 'onClick="alert(\''.$alertStr.'\'); return false"';
	}
	if(!is_file("$_ROOT_PATH/$infoPdf"))
	{
		$checkDownPdf = 'onClick="alert(\''.$alertStr.'\'); return false"';
	}
	//}
?>
<table width="98%" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left">
			<font style="font-size:13px; font-family:'Times New Roman', Times, serif; color:#017a8c; font-weight:bold"><?=$infoName?></font>
			<font color="#999999">(<?=$infoDate?>)</font>
		</td>
	</tr>
	<tr>
		<td align="left" style="padding-top:10px"><?=$infoDes?></td>
	</tr>
	<tr>
		<td style="padding-top:15px; font-size:11px">
			<img src="<?=$_IMG_DIR?>/down_icon.gif" width="24" height="30" border="0" align="left">
			<font style="color:#d01a02; font-weight:bold; text-decoration:none"><?=$define["var_taive"]?></font>&nbsp;&nbsp;
			<a href="<?=$docDownLink?>" <?=$checkDownDoc?>><img src="<?=$_IMG_DIR?>/doc_down.gif" width="16" height="16" border="0" align="absmiddle"></a>&nbsp;
			<a href="<?=$pdfDownLink?>" <?=$checkDownPdf?>><img src="<?=$_IMG_DIR?>/pdf_down.gif" width="16" height="16" border="0" align="absmiddle"></a><br>
			<font style="color:#646565">(<font style="color:#0278a9; font-weight:bold"><?=$infoDown?></font>&nbsp;<?=$define["var_luottaive"]?>)</font>
		</td>
	</tr>
</table>
<?
}
?>