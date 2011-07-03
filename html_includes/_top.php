<?
if(!$_PAGE_VALID)
{
	exit();
}
?>	

<!-- ***** Form ************************************************************ -->
<?
$conds = "language_id = $lang AND html_id = 'pagebanner'";
$pageBanner = $opt->optionvalue("vot_html", "html_detail", $conds);
?>

<table width="861" border="0" cellspacing="0" cellpadding="0" align="center">	<tr>		<td height="13px"></td>	</tr>	<tr>	 <td valign="top" style="background-image:url(<?=$_IMG_DIR?>/menutop.jpg); background-repeat:no-repeat; height:27px">	 	<table cellpadding="0" cellspacing="0">			<tr>				<td class="topmenu" style="padding-left:20px"><a href="#"><?=$define["var_music"]?></a></td>				<td class="topmenu">|</a></td>				<td class="topmenu"><a href="#"><?=$define["var_congnghe3g"]?></a></td>				<td class="topmenu">|</a></td>				<td class="topmenu"><a href="#"><?=$define["var_hinhanhso"]?></a></td>				<td class="topmenu">|</a></td>				<td class="topmenu"><a href="#"><?=$define["var_tuyendung"]?></a></td>				<td class="topmenu">|</a></td>				<td class="topmenu"><a href="#"><?=$define["var_diendan"]?></a></td>			</tr>		   </table>		</td>	 </tr>	 <tr>	 	<td height="2"></td>	 </tr>	 <tr>	 	<td style="background-image:url(<?=$_IMG_DIR?>/bg_topmenu.jpg); background-repeat:no-repeat; height:394px" valign="top">	 		<table width="100%" cellpadding="0" cellspacing="0" border="0">				 <tr>					<td valign="top"><img src="<?=$_IMG_DIR?>/tongdaituvan.jpg" border="0" align="absmiddle"></td>				 </tr>					 <tr>					<td valign="top" align="center">						<table width="98%" cellpadding="0" cellspacing="0" border="0" style="background-image:url(<?=$_IMG_DIR?>/menu_bar_bg.jpg);background-repeat:repeat-x;height:33px">							<tr>								<td valign="top" width="4"><img src="<?=$_IMG_DIR?>/menu_bar_left.jpg" border="0"/></td>								<td valign="top" style="background-image:url(<?=$_IMG_DIR?>/menu_bar_bg.jpg); background-repeat:repeat-x;height:33px"><? include_once("$_HTML_DIR/menubar_$lang.htm")?></td>								<td valign="top" width="4"><img src="<?=$_IMG_DIR?>/menu_bar_right.jpg" border="0" /></td>							</tr>						</table>					</td>				</tr>				 <tr>					<td valign="top" align="center"><?=$pageBanner?></td>				</tr>				</table>			</td>		</tr>	</table>		