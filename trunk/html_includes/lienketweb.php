<?
if(!$_PAGE_VALID)
{
	exit();
}
$opt = new option;
$conds = "language_id='".$lang."' AND linkexchange_view=1";
$others = "ORDER BY linkexchange_order ASC";
$listLinks = $opt->optionselected(NULL,$define["var_coalimexweblinks"],"vot_linkexchange","linkexchange_linkto","linkexchange_name",$conds, $others);
?>
<table  width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td style="font-size:12px; text-transform:uppercase; font-weight:bold; font-family:tahoma"><?=$define["var_lienketweb"]?></td>
		<td >
 				<select name="linkExchange" style="width: 160px;height:18" onChange="window.open(this.value,'_blank')"><?=$listLinks?></select>
		 </td>
	</tr>
</table>	

