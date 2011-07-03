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
<div id="middle-content">
<?=$contentDetail?>
		</div>		
<script language="javascript">
if(customerSuggestion)
{
	var cusSugLink = '<?=$_URL_BASE?>/includes/suggestion.php?itemId=<?=$itemId?>';
	showPageContent(cusSugLink, 'customerSuggestion');
}
if(otherItems)
{
	var otherItemLink = '<?=$_URL_BASE?>/includes/otheritems.php?module=<?=$module?>&curModId=<?=$curModId?>&cateId=<?=$cateId?>&listShowItemId=<?=$listShowItemId?>';
	showPageContent(otherItemLink, 'otherItems');
}
</script>