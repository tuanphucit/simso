<?
if(!$_PAGE_VALID)
{
	exit();
}

if(!$SESSEARCHIN)
{
	$SESSEARCHIN = 'tours';
}
$curSrchIn[$SESSEARCHIN] = 'checked';
?>
<script language="javascript">
function doQuickSearch()
{
	myFrm = document.searchForm;
	if(myFrm.KWD.value == '')
	{
		alert('<?=$define["var_vuilongnhaptukhoa"]?>');
		myFrm.KWD.focus();
		return false;
	}
	
	urlTo  = '<?=$_URL_BASE?>/';
	searchInNum = myFrm.searchIn.length;
	for(i = 0; i < searchInNum; i++)
	{
		if(myFrm.searchIn[i].checked && myFrm.searchIn[i].value != '')
		{
			urlTo += myFrm.searchIn[i].value;
			urlTo += '/';
		}
	}
	myFrm.action = urlTo;
	
	return true;
}
</script>
<table cellpadding="0" cellspacing="0" border="0">
	<form name="searchForm" method="get" onSubmit="return doQuickSearch()">
		<tr>
			<td style="color:#666666; font-size:11px; padding-right:15px" nowrap>
				<input type="radio" name="setTyping" checked onChange="setTypingMode(1)"><?=$define["var_gotiengviet"]?>&nbsp;
				<input type="radio" name="setTyping" onChange="setTypingMode()"><?=$define["var_tat"]?>
			</td>
			<td align="center" nowrap>
				<input type="text" name="KWD" class="searchFormKwd" maxlength="100" value="<?=$SESKWD?>" onKeyUp="telexingVietUC(this)">
				<input type="image" src="<?=$_IMG_DIR?>/search_btn.gif" align="absmiddle">
			</td>
		</tr>
	</form>
</table>
