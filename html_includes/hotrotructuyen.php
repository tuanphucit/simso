<?
if(!$_PAGE_VALID)
{
	exit();
}
$conds = "language_id = $lang AND html_id = 'livesupport'";
$thongtinhotro = $opt->optionvalue("vot_html", "html_detail", $conds);
?>
<table width="100%" cellpadding="0" cellspacing="0" >
<tr>
	<td class="rightmenu"><?=$Title?></td>
</tr>
<tr>	
	<td class="rightmenu1" align="center">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?
			$conds = "language_id='".$lang."' AND onlinesupport_view=1";
			$others = "ORDER BY onlinesupport_order ASC";
			$sql->set_query("vot_onlinesupport", "*", $conds, $others);
			while($sql->set_farray())
			{
				$onlineName = $sql->farray["onlinesupport_name"];
				$yahoo = $sql->farray["onlinesupport_linkto"];
			?>
			<tr>
				<td style=" text-align:center;padding-left:0px;padding-top:5px;color:#006766;font-family:tahoma; font-size:11px; font-weight:bold" colspan="2">&nbsp;&nbsp;&nbsp;<?=$onlineName?></td>
			</tr>
			<tr>
				<td align="center" style="padding-left:5px; padding-top:7px;padding-bottom:7px;" colspan="2"><a href="ymsgr:sendim?<?=$yahoo?>"><img src="http://opi.yahoo.com/online?u=<?=$yahoo?>&m=g&t=2" border="0"></a></td>
			</tr>
			<?
			}
			?>
			<tr>
				<td style="color:#006766; font-size:11px;padding-left:10px; font-family:tahoma; padding-top:15"><?=$thongtinhotro?></td>
			</tr>
		</table>
	</td>
</tr>
  <tr>
 	<td valign="top"><img src="<?=$_IMG_DIR?>/menuleft_3.jpg" border="0" /></td>
 </tr>
</table>
