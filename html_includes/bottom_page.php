<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<table align="center" width="957" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td height="5"></td>
	</tr>
  <tr>
    <td align="center"><? if(is_file("$_HTML_DIR/menubottom_$lang.htm")) include_once("$_HTML_DIR/menubottom_$lang.htm")?></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="center">
			<? if(is_file("$_HTML_DIR/footer_page_$lang.htm")) include_once("$_HTML_DIR/footer_page_$lang.htm")?>
		</td>
	</tr>
</table>