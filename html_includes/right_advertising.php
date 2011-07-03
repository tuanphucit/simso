<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<table width="100%" cellpadding="0" cellspacing="0" align="center" >
<tr>
	<td class="rightmenu"><?=$Title?></td>
</tr>
<tr>
	<td valign="top" align="center" class="rightmenu1">

<?
if($config["site_logonumright"])
{
	$logoNum = $config["site_logonumright"];
}

$sels = "adv_id, adv_name, adv_image,adv_url";
$conds = "adv_pos = 1 AND adv_view = 1";
$others = "ORDER BY adv_order LIMIT $logoNum";
$sql->set_query("vot_adv", $sels, $conds, $others);
while($sql->set_farray())
{
	$advId = $sql->farray["adv_id"];
	$advName = $sql->farray["adv_name"];
	$advImg = $sql->farray["adv_image"];
	$ext = extFile($advImg);
	if(($ext == "swf")||($ext == "SWF"))
	{
		$advright = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"185\">
						<param name=\"movie\" value=\"$_URL_BASE/$advImg\">
						<param name=\"quality\" value=\"high\">
						<embed src=\"$_URL_BASE/$advImg\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"185\"></embed>
					</object>";
	}else 
	{
		$imgSrc = "$_ROOT_PATH/$advImg";
		$imgSize = imageSize($imgSrc,185,367);
		$advright  = '<img src="'.$_URL_BASE.'/'.$advImg.'" border="0"';
		$advright .= ' align="center" width="'.$imgSize[0].'">';
	}
	$advUrl = $sql->farray["adv_url"];
	if(($advUrl!=NULL)&&($advUrl!='http://')) $_StrAdv = '<a href="'.$advUrl.'" target="_blank">'.$advright.'</a>'; else $_StrAdv = $advright;
	if(is_file("$_ROOT_PATH/$advImg"))
	{
?>
	 <table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td align="center" style="padding-bottom:5px; padding-top:5px"><?=$_StrAdv?></td>
			</tr>
		</table>
		
<?
	}
}
?>
   </td>
</tr>
 <tr>
	<td valign="top"><img src="<?=$_IMG_DIR?>/menuleft_3.jpg" border="0" /></td>
 </tr>

</table>