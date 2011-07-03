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
	$url = str_replace("/order.php", "", $url);
	$url_array = explode("/",$url);
	array_shift($url_array);
}

$my_url = $url_array;

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
/*
if(!$itemId || !validGetVar($itemId))
{
	exit();
}
*/
echo '<div id="doOrderProduct">';
if($doAction == "send" && !$isSent)
{
	$isSent = 1;
	_SESSION_REGISTER("isSent");
	
	$ndate = date("Y-m-d");
	$order = $opt->optionvalue("vot_listorder", "MAX(listorder_order)", "language_id='".$lang."'") + 1;
	$fields = "listorder_name,listorder_add,listorder_tel,listorder_fax,listorder_email,listorder_detail,listorder_date,listorder_order,listorder_view,product_id,language_id";
	$values  = "'".insertData($nname)."','".insertData($add)."','".$tel."','".$fax."','".$email."','".insertData($detail)."','".$ndate."','".$order."','1','".$itemId."','".$LANG."'";
	$sql->insert("vot_listorder", $fields, $values);
	$sql = new mysql;

?>
<table width="100%" height="150" align="center" cellpadding="3" cellspacing="0">
	<tr>
		<td align="center" style="color:#003399; font-size:11px">
			<div><?=$define["var_thongtindaduocgui"]?></div>
			<div><?=$define["var_camonbandachonmua"]?></div>
		</td>
	</tr>
	<tr>
		<td align="center" style="padding:10px">
			<a href="javascript:voice()" onClick="Modalbox.hide()" style="color:#FFFF00;"><?=$define["var_dong"]?></a>
		</td>
	</tr>
</table>
<?
}
else
{
	$isSent = NULL;
	_SESSION_REGISTER("isSent");
	$product = $opt->optionvalue("vot_product", "product_name", "product_id='".$itemId."'");
?>
	<form name="frmOrderProduct" action="<?=$_URL_BASE?>/order.php/<?=$itemId?>" method="post" onSubmit="return doOrderProductSubmit()">
	<table width="90%" align="center" cellpadding="3" cellspacing="0">
		<tr>
			<td width="20%" nowrap style="font-size:11px"><?=$define["var_hovaten"]?></td>
			<td width="80%" style="font-size:11px"><input type="text" name="nname" maxlength="100" style="width:250px" class="textBox">&nbsp;(<font color="#FF0000">*</font>)</td>
		</tr>
		<tr>
			<td width="20%" nowrap style="font-size:11px"><?=$define["var_diachi"]?></td>
			<td width="80%" style="font-size:11px"><input type="text" name="add" maxlength="200" style="width:250px" class="textBox"></td>
		</tr>
		<tr>
			<td width="20%" nowrap style="font-size:11px"><?=$define["var_dienthoai"]?></td>
			<td width="80%" style="font-size:11px"><input type="text" name="tel" maxlength="200" style="width:250px" class="textBox"></td>
		</tr>
		<tr>
			<td width="20%" nowrap style="font-size:11px"><?=$define["var_fax"]?></td>
			<td width="80%" style="font-size:11px"><input type="text" name="fax" maxlength="200" style="width:250px" class="textBox"></td>
		</tr>
		<tr>
			<td width="20%" nowrap style="font-size:11px"><?=$define["var_emailcuaban"]?></td>
			<td width="80%" style="font-size:11px"><input type="text" name="email" maxlength="200" style="width:250px" class="textBox">&nbsp;(<font color="#FF0000">*</font>)</td>
		</tr>
		<tr>
			<td width="20%" nowrap style="font-size:11px"><?=$define["var_sanphamchonmua"]?></td>
			<td width="80%" style="font-size:11px"><? if($product <> NULL) echo'<input type="text" name="product" maxlength="200" style="width:250px" value="'.$product.'" readonly="1" class="textBox">'; else echo'<input type="text" name="product" maxlength="200" style="width:250px"  class="textBox">';?></td>
		</tr>
		<tr>
			<td width="20%" nowrap style="font-size:11px"><?=$define["var_yeucaukemtheo"]?></td>
			<td width="80%" style="font-size:11px"><textarea name="detail" rows="5" style="width:250px"></textarea></td>
		</tr>
		<tr>
			<td width="20%" nowrap>&nbsp;</td>
			<td width="80%">
				<input type="hidden" name="doAction" value="send">
				<button type="submit" name="sendToSbm"><?=$define["var_gui"]?></button>&nbsp;&nbsp;
				<button type="reset" name="sendToReset"><?=$define["var_nhaplai"]?></button>
			</td>
		</tr>
		<tr>
			<td width="20%" style="font-size:11px">&nbsp;</td>
			<td nowrap style="font-size:11px">(<font color="#FF3300">*</font>) <?=$define["var_truongbatbuoc"]?></td>
		</tr>
	</table>
	</form>
<?
}
echo '</div>';
?>
