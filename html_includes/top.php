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
	<table width="861" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td height="13px"></td>
		</tr>
		<tr>
		<td height="2">
		</td>
		</tr>
		<tr>
		<td style="background-image:url(<?=$_IMG_DIR?>/bg_topmenu.jpg); background-repeat:no-repeat; height:200px" valign="top">
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
		<td valign="top">
		<img src="<?=$_IMG_DIR?>/tongdaituvan.jpg" border="0" align="absmiddle">
<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim so dep</a></strong>

<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim so dep gia re</a></strong>

<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim vip</a></strong>

<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim gia re</a></strong>

<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim sinh vien</a></strong>
<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim viettel</a></strong>
<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim mobifone</a></strong>
<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim dep viettel</a></strong>
<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim phong thuy</a></strong>
<strong style="display: none;"><a title="sim so dep, sim số đẹp, sim vip, sim tu quy, sim taxi, sim nam sinh, sim than tai, sim loc phat" href="http://www.simdepdongnai.com/">sim nam sinh</a></strong>
		</td>
		</tr>
		<tr>
		<td valign="top" align="center">
		<table width="98%" cellpadding="0" cellspacing="0" border="0" style="background-image:url(<?=$_IMG_DIR?>/menu_bar_bg.jpg);background-repeat:repeat-x;height:33px">							<tr>								<td valign="top" width="4"><img src="<?=$_IMG_DIR?>/menu_bar_left.jpg" border="0"/></td>								<td valign="top" style="background-image:url(<?=$_IMG_DIR?>/menu_bar_bg.jpg); background-repeat:repeat-x;height:33px"><? include_once("$_HTML_DIR/menubar_$lang.htm")?></td>								<td valign="top" width="4"><img src="<?=$_IMG_DIR?>/menu_bar_right.jpg" border="0" />
			</td>
		</tr>
	</table>
</td>
</tr>

	<tr>
		<td valign="top" align="center" height="150px">
		<?=$pageBanner; ?>
		</td>
	</tr>
</table>
</td>
</tr>
</table>		