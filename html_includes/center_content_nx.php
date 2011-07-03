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
		<td align="center"  valign="top">
			<table width="92%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td style="background-image:url(<?=$_IMG_DIR?>/page_title.jpg);height:23px; color:#006404; font-family:tahoma; font-weight:bold; font-size:12px; background-repeat:no-repeat; font-family:tahoma; font-size:12px; padding-left:5px; padding-bottom:5px"><?=$define["var_dangduyet"]?>:<span style="font-weight:bold; padding-left:2px"><?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="10" style="padding-top:20px; color:#00FF00; font-size:14px"><?=$center?></td>
				</tr>
				<tr>
					<td id="centerContent" class="itemname" valign="top"><?=$contentDetail?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>
