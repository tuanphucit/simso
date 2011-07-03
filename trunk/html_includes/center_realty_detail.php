<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
function checkSugSubmit()
{
	var myFrm = document.suggestionFrm;
	if(myFrm.yourName.value == '')
	{
		alert('<?=$define["var_vuilongnhaphoten"]?>');
		myFrm.yourName.focus();
		return false;
	}
	if(!isEmail(myFrm.yourEmail.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.yourEmail.focus();
		return false;
	}
	return true;
}
function doSugFrmSubmit()
{
	if(checkSugSubmit())
	{
		AjaxRequest.Submit(
			suggestionFrm, {'onSuccess': function(req)
			{
				getObjectById('customerSuggestion').innerHTML = req.responseText;
			},'onError': function(req){}
		});
	}
	return false;
}
</script>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="top" bgcolor="#FFFFFF" style="border:0px solid #EEEEEE">
			<table width="97%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td class="subPageTitle"><img src="<?="$_URL_BASE/$modIcon"?>" border="0" align="absmiddle"> &nbsp; <?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td style="color:#cd311a; font-size:14px; font-weight:bold"><?=$contentTitle?></td>
				</tr>
				<tr>
					<td style="font-size:11px"><?=$contentDate?></td>
				</tr>
				<tr>
					<td id="centerContent" class="centerContent" valign="top"><?=$contentDetail?></td>
				</tr>
				<tr>
					<td align="right" height="30"><? require_once("$_HTML_DIR/buttons.php")?></td>
				</tr>
				<tr>
					<td style="">
						<div id="customerSuggestion">&nbsp;</div>
					</td>
				</tr>
				<tr>
					<td style="">
						<div id="otherItems">&nbsp;</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>
<script language="javascript">
if(customerSuggestion)
{
	var cusSugLink = '<?=$_URL_BASE?>/includes/contactus.php?itemId=<?=$itemId?>';
	showPageContent(cusSugLink, 'customerSuggestion');
}
if(otherItems)
{
	var otherItemLink = '<?=$_URL_BASE?>/includes/otherrealty.php?module=<?=$module?>&curModId=<?=$curModId?>&cateId=<?=$cateId?>&listShowItemId=<?=$listShowItemId?>';
	showPageContent(otherItemLink, 'otherItems');
}
</script>