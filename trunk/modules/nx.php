<?
session_start();

if($doAction == "cmd")
{
	$ndate = date("d-m-Y");
	$ndate = inDateStr($ndate);
	$conds = "language_id = '".$lang."'";
	$order = $opt->optionvalue("vot_faqs", "MAX(faqs_order)",$conds) + 1;
	$modulesId = $opt->optionvalue("vot_modules","modules_id","modules_type = 'faqs' AND language_id = '".$lang."'");
	$fields = "faqs_name,faqs_fullname,faqs_email,faqs_date,faqs_shortdes,faqs_order,modules_id,language_id";
	$values  = "'".$yourTitle."','".$yourName."','".$yourEmail."','".$ndate."','".$yourMess."','".$order."','".$modulesId."','".$lang."'";
	$sql->insert("vot_faqs",$fields,$values);
	
	
	$isSent = 1;
	_SESSION_REGISTER("isSent");
	$center ='
	<table width="100%" align="center" cellpadding="3" cellspacing="0">
		<tr>
			<td align="center" style="color:#003399; font-size:12px;font-weight:bold">
				<div>'.$define["var_thongtindaduocgui"].'</div>
				<div>'.$define["var_camonbandadonggopykien"].'</div>
			</td>
		</tr>
	</table>';
		require_once("$_HTML_DIR/center_content_nx.php");			
}
else
{
	$isSent = NULL;
	_SESSION_REGISTER("isSent");
$contentDetail .= '
<form name="suggestionFrm" action="" method="post" onSubmit="return doSugFrmSubmit()">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				 <tr>
					<td width="55%" valign="middle" align="right" style="padding-left:20px;padding-top:0px">
						<table width="100%"  cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="20%" nowrap style="font-size:11px" align="right">'.$define["var_tieude"].' : </td>
								<td width="80%" style="padding:4px 0px 0px 2px"><input type="text" name="yourTitle" maxlength="200" style="width:220px" class="textBox"></td>
							</tr>
							<tr>
								<td width="20%" nowrap style="font-size:11px; padding:4px 0px 2px 0px" align="right">'.$define["var_hovaten"].' : </td>
								<td width="80%" style="padding:4px 0px 2px 2px"><input type="text" name="yourName" maxlength="100" style="width:220px; border:1px solid #A68C78;" class="textBox"></td>
							</tr>
							<tr>
								<td width="20%" nowrap style="font-size:11px;padding:0px 0px 2px 0px" align="right">'.$define["var_emailcuaban"].' : </td>
								<td width="80%" style="padding-left:2px; padding-bottom:2px"><input type="text" name="yourEmail" maxlength="200" style="width:220px;border:1px solid #A68C78;" class="textBox"></td>
							</tr>
						</table>
					 </td>
					</tr>
					<tr>
					<td width="55%" align="right" style="padding-left:20px;">
						<table width="100%"  cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="20%" nowrap style="font-size:11px;padding-left:5px" align="right" valign="top">'.$define["var_ykien"].' : </td>
								<td width="80%" style="padding-left:2px;padding-bottom:2px"><textarea name="yourMess" rows="7" style="width:220px;border:1px solid #A68C78"></textarea></td>
							</tr>
						</table>
					 </td>
					</tr>
					<tr>
					<td valign="bottom" width="55%" style="padding:4px 0px 2px 10px">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="20%"></td>
								<td width="80%" style="padding:5px 2px 3px 10px">
									<input type="hidden" name="doAction" value="cmd">
									<button type="submit" name="sendToSbm">'.$define["var_gui"].'</button>&nbsp;&nbsp;
									<button type="reset" name="sendToSbm">'.$define["var_nhaplai"].'</button>&nbsp;&nbsp;
								</td>
								</form>
							</tr>
						</table>
					 </td>
					</tr>
				</table>';
	require_once("$_HTML_DIR/center_content_nx.php");			
}
?>