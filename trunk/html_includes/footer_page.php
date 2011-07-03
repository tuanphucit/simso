<?
if(!$_PAGE_VALID)
{
	exit();
}
$conds = "language_id = $lang AND html_id = 'footer'";
$pageBottom = $opt->optionvalue("vot_html", "html_detail", $conds);
?>
<table width="100%" cellpadding="0" border="0" cellspacing="0" align="center">
	<tr>
	    <td width="100%" align="center">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
					<tr>
						<td style="text-align:center"><? include_once("$_HTML_DIR/menubottom_$lang.htm")?></td>
					</tr>
					<tr>
						 <td class="pageBottom" align="center"><?=$pageBottom?></td>
					</tr>
				</table> 
		 </td>	
   </tr>
</table>