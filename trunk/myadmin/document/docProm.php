<?
include_once("../includes/global.php");
include_once("../includes/chksession.php");

$sql = new mysql();

switch($doAction)
{
	case 'del':
		$sql->set_list_tables();
		$sql->delete("vot_documentprom","documentprom_id",$id);
		echo '<script language="javascript">';
		echo 'window.opener.location.reload();';
		echo 'window.close();';
		echo '</script>';
		break;
	case 'update':
		if($isSave!=NULL)
		{
			redirect($url);
		}				
		
		if(!$view) $view = 1;

		if($id != NULL && $isSave == NULL)
		{			
			$values  = "documentprom_name='".$nname."',documentprom_order='".$order."',documentprom_view='".$view."',modules_id='".$CURMOD."'";
			$sql->update("vot_documentprom",$values,"documentprom_id=$id");					
		}
		elseif($isSave==NULL)
		{
			$fields = "documentprom_name,documentprom_order,documentprom_view,language_id,modules_id";
			$values  = "'".$nname."','".$order."','".$view."','".$LANG."','".$CURMOD."'";
			$sql->insert("vot_documentprom", $fields, $values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");

		echo '<script language="javascript">';
		echo 'window.opener.location.reload();';
		echo 'window.close();';
		echo '</script>';
		break;
	default:
		$isSave = NULL;
		_SESSION_REGISTER("isSave");

		$pageTitle = "N&#417;i ban h&#224;nh";

		$conds = "documentprom_id='".$id."'";
		$sql->set_query("vot_documentprom", "*", $conds);
		if($sql->set_farray())
		{
			$itemName = $sql->farray["documentprom_name"];
			$itemOrder = $sql->farray["documentprom_order"];
		}
?>
<html>
<head>
<title>Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body class="rowform">
<div align="center" class="modulehead"><?=$pageTitle?></div>
<form name="editForm" method="post">
<div style="padding-top:5px; padding-bottom:10px">
	<span style="width:120px">Ti&#234;u &#273;&#7873;:</span>
	<span style="width:200px"><input name="nname" size="35" maxlength="100" value="<?=$itemName?>" class="textbox"></span>
</div>
<div style="padding-top:5px; padding-bottom:10px">
	<span style="width:120px">Th&#7913; t&#7921; hi&#7875;n th&#7883;:</span>
	<span style="width:200px"><input name="order" size="15" maxlength="100" value="<?=$itemOrder?>" class="textbox"></span>
</div>
<div style="padding-top:15px; padding-bottom:5px">
	<span style="width:120px; vertical-align:top">&nbsp;</span>
	<span style="width:250px">
		<button type="submit" accesskey="l">&nbsp;&nbsp;<u>L</u>&#432;u&nbsp;&nbsp;</button>&nbsp;&nbsp;
		<button type="button" onClick="window.opener.focus(); window.close();" accesskey="l">&nbsp;&nbsp;<u>&#272;</u>&#243;ng&nbsp;&nbsp;</button>
	</span>
</div>
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="doAction" value="update">
</form>
</body>
</html>
<?
	break;
}
?>
