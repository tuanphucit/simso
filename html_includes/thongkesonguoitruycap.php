<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<table width="100%"	cellpadding=0 cellspacing="0" border="0">
		<tr>
			<td class="rightmenu"><?=$Title?><img src="<?=$_IMG_DIR?>/member.jpg" border="0" style="margin:3px 0px 0px 3px" /></td>
		</tr>
		<tr>
			<td valign="top" class="rightmenu1">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td colspan="2" height="10"></td>
					</tr>
					<tr>
						<td style="color:#000000; font-family:arial; font-size:12px;padding:0px 0px 5px 5px"><?=$define["var_online"]?> :</td><td align="left" style="color:#000000; font-size:12px; font-family:arial; padding-left:2px; font-weight:bold"><?=$cpt?></td>
					</tr>
					<tr>
						<td style="color:#000000; font-family:arial; font-size:12px; padding:0px 0px 5px 5px"><?=$define["var_visitors"]?> :</td><td align="left" style="color:#000000; font-size:12px; font-family:arial; padding-left:2px; font-weight:bold" id="visitedCounter">{8668}</td>
					</tr>
					<tr>
						<td colspan="2" height="10"></td>
					</tr>
				  </table>
			</td>
		</tr>
</table>				  	
