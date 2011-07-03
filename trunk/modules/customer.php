<?
if(!$_PAGE_VALID)
{
	exit();
}

$subPageTitle = $define["var_datmuasim"];
$contentDetail = NULL;
if((int)($my_url[0]))
{
	$itemId = $url_array[0];
	if((int)($my_url[1]))
	{
		$curPg = $url_array[1];
		$itemName = $url_array[2];
	}
	else
	{
		$curPg = NULL;
		$cateName = $url_array[1];
	}
}
if($doAction == 'send' && !$isSent)
{
	$isSent = 1;
	_SESSION_REGISTER("isSent");
	$ndate = date("Y-m-d");
	$order = $opt->optionvalue("vot_customer", "MAX(customer_order)", "language_id='".$lang."'") + 1;
	$fields = "customer_name,customer_add,customer_tel,customer_fax,customer_email,customer_detail,customer_date,customer_order,customer_view,customer_sdt,language_id";
	$values  = "'".insertData($nname)."','".insertData($add)."','".$tel."','".$fax."','".$email."','".insertData($detail)."','".$ndate."','".$order."','1','".$itemId."','".$LANG."'";
	$sql->insert("vot_customer", $fields, $values);
	$sql = new mysql;
	
		$sentContent  = '<div style="color:#ffcc00;font-family:tahoma; text-transform:uppercase; font-size:12px ">'.$define["var_thongtindaduocgui"].'</div>';
		$sentContent .= '<div style="color:#ffcc00;font-family:tahoma; text-transform:uppercase; font-size:12px ">'.$define["var_camonbandachonmua"].'</div>';

}
else
{
	$isSent = 0;
	_SESSION_REGISTER("isSent");
	$product = $opt->optionvalue("product", "sosim", "id='".$itemId."'");
	$price = geld($opt->optionvalue("product", "giaxuat", "id='".$itemId."'"));

}

$conds = "language_id='".$lang."' AND html_id='order'";
$sql->set_query("vot_html", "*", $conds);
if($sql->set_farray())
{	
	$contentDetail = displayData_DB($sql->farray["html_detail"]);
}
$sqll = new mysql();
$condss = "language_id='".$lang."' AND html_id='footer_order'";
$sqll->set_query("vot_html", "*", $condss);
if($sqll->set_farray())
{	
	$contentOrder = displayData_DB($sqll->farray["html_detail"]);
}


	require_once("$_HTML_DIR/center_customer_page.php");
?>
/center_customer_page.php");
?>
