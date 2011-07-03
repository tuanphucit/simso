<?
if(!$_PAGE_VALID)
{
	exit();
}
$subPageTitle = $define["var_datmuasim"];
$contentDetail = NULL;
if($doAction == 'send' && !$isSent)
{
	$isSent = 1;
	_SESSION_REGISTER("isSent");
	
	
	
	$ndate = date("Y-m-d");
	$order = $opt->optionvalue("vot_listorder", "MAX(listorder_order)", "language_id='".$lang."'") + 1;
	$fields = "listorder_name,listorder_add,listorder_tel,listorder_teltable,listorder_fax,listorder_email,listorder_detail,listorder_date,listorder_order,listorder_view,product_id,language_id";
	$values  = "'".insertData($nname)."','".insertData($add)."','".$tel."','".$teltable."','".$fax."','".$email."','".insertData($detail)."','".$ndate."','".$order."','1','".$itemId."','".$lang."'";
	$sql->insert("vot_listorder", $fields, $values);
	$sql = new mysql;
	
		$product = $opt->optionvalue("product", "sosim", "id='".$itemId."'");
		$price = geld($opt->optionvalue("product", "giaxuat", "id='".$itemId."'"));
	/*_SESSION_REGISTER("nname");
	_SESSION_REGISTER("nname");
	_SESSION_REGISTER("add");
	_SESSION_REGISTER("tel");
	_SESSION_REGISTER("teltable");
	_SESSION_REGISTER("email");
	*/
$conds = "language_id = $lang AND html_id = 'thongbaothanhcong'";
$thongbaothanhcong = $opt->optionvalue("vot_html", "html_detail", $conds);

}
else
{
	$itemId = $url_array[1];

	
	$isSent = 0;
	_SESSION_REGISTER("isSent");
	$product = $opt->optionvalue("product", "sosim", "id='".$itemId."'");
	$product = str_replace("`","",$product);
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

$product_cach = str_replace("."," ",$product);
$product_cham = str_replace(" ",".",$product);
$pos = strrpos($product,".");
if ($pos === false) {
	$product_dau = $product_cham;
}
else{
	$product_dau = $product_cach;
}
$product_none = str_replace(" ","",$product_cach);
$contentTitle = "".$define["var_bangiagoc"]." ".$product." - ".$product_dau." - ".$product_none;

	require_once("$_HTML_DIR/center_order_page.php");
?>
