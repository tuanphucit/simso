<?
session_start();
include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");
if(!_SERVER('QUERY_STRING')) 
{
	$url = strip_tags(_SERVER('REQUEST_URI'));
	if($config["script_path"])
	{
		$url = str_replace("/".$config["script_path"],"",$url);
	}
	$url = str_replace("/html_includes/topcontent.php", "", $url);
	$url_array = explode("/",$url);
	array_shift($url_array);
}

$my_url = $url_array;

if((int)($my_url[0]))
{
	$cateId = $url_array[0];
	$cateName = $url_array[1];
}

$sql = new mysql;
$conds = "language_id='".$lang."' AND homeblock_view = 1 ";
$others = "ORDER BY homeblock_order ASC Limit 4";
$sql->set_query("vot_homeblock", "*", $conds, $others);
if($sql->nRows > 0)
{
	$listTabs = '
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>';
	while($sql->set_farray())
	{
		$tabId = $sql->farray["modules_id"];
		$tabName = $sql->farray["homeblock_name"];
		$tabLink = $sql->farray["homeblock_linkto"];
		$typePos = $sql->farray["homeblock_istop"];
		//echo $typePos = split("", $typePos);
		/*if($typePos == 1)
		{	echo $cateId;
			*/
			if(!$cateId && $count < 1)
			{
				$cateId = $tabId;
				
			}
			
			$sLink = "$_URL_BASE/html_includes/topcontent.php/$tabId/$tabLink";
			if($tabId != $cateId)
			{
				$listTabs .= '<td style="background-image: url('.$_IMG_DIR.'/proTabInactive.jpg);text-align:center;border-left: 1px solid #2b2b2b;"><a href="'.$sLink.'" onClick="showTopInformation(this.href); return false">'.$tabName.'</a></td>';
			}
			else
			{
			$listTabs .= '<td class="tabActive">'.$tabName.'</td>';
			}
			//$listTabs .= '<td width="2%" class="tabEmpty">&nbsp;</td>';
			$count++;
		//}
	}
	$listTabs .= '</tr></table>';
	
	$maxImgW = 270;
	$maxImgH = 184;
	$maxRows = 6;
	
	$Producthome = NULL;
	$otherTopproduct = '
	<div align="right" style="padding-top:5px;padding-bottom:5px; color:#5d5d5d; font-family:\'tahoma\'; font-weight:bold; font-size:14px">'.$define["var_cacthongtinlienquan"].'</div>
	<ul class="otherTopproductList">';
$maxLevel = $opt->optionvalue("vot_modules", "MAX(modules_level)", "language_id='".$lang."' AND modules_view=1");
$curLevel = 0;
$conds = "modules_id='".$cateId."'";
$sql->set_query("vot_modules", "*", $conds);
if($sql->set_farray())
{
	$curLevel = $sql->farray["modules_level"];
	$source = $sql->farray["modules_type"];
}
for($i = $curLvel+1; $i <= $maxLevel; $i++)
{
	$conds = "modules_parent IN ('".$cateId."') AND modules_view=1";
	$sql->set_query("vot_modules", "*", $conds);
	while($sql->set_farray())
	{
	$cateId .= "','".$sql->farray["modules_id"];
	}
}

	$cond = "ihome = 1 AND view = 1 AND category IN ('".$cateId."')";
	$others = "ORDER BY thutu DESC LIMIT ".$config["site_Productmaxnum"]."";
	$sql->set_query("product", "DISTINCT sosim", $cond, $others);
	$tRows =$sql->nRows;
	$Producthome = '<table width="99%" align="center" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td height="3" colspan=8></td>
							</tr>
							<tr height="26">
								<td width="150" style="font-family:tahoma; font-size:11px;color:#ffc000;font-weight:bold; text-align:center; border-right:2px solid #000000;background-color:#2b2b2b">'.$define["var_sosim"].'</td>
								<td width="150" style="font-family:tahoma; font-size:11px;color:#ffc000; font-weight:bold;text-align:center;border-right:2px solid #000000;background-color:#2b2b2b">'.$define["var_gia"].'</td>
								<td width="150" style="font-family:tahoma; font-size:11px;color:#ffc000;font-weight:bold;text-align:center;border-right:2px solid #000000;background-color:#2b2b2b">'.$define["var_taikhoan"].'</td>
								<td width="150" style="font-family:tahoma; font-size:11px;color:#ffc000;font-weight:bold;text-align:center;border-right:2px solid #000000;background-color:#2b2b2b">'.$define["var_datmua"].'</td>
							</tr>';
	while($sql->set_farray())
	{
				$productName = $sql->farray["sosim"];
				$productId = $opt->optionvalue("product", "id", "sosim='".$productName."'");
				$productName = str_replace("`","",$productName);
				$price = geld($opt->optionvalue("product", "giaxuat", "id='".$productId ."'"));
				$taihkoan = geld($opt->optionvalue("product", "taikhoan", "id='".$productId ."'"));
		$Linkto = "$_URL_BASE/index.php/order/$productId";

$sLink = "$_URL_BASE/html_includes/left_showcontent.php?imgSrc=$Img&Name=$productName&Id=$productId";
if ($count % 2 == 0) $backgroud = 'background-image:url('.$_IMG_DIR.'/Background_product.jpg); background-repeat:repeat-x;height:28px'; 
		else $backgroud = 'backgroud-color:#FF0000; height:24px';
if ($count % 2 == 0) $src="$_IMG_DIR/add_cart.jpg";
else $src="$_IMG_DIR/add_cart.gif";
$Producthome .= "
				<tr height=\"24\">
					<td width=\"150\" style=\"".$backgroud.";font-family:tahoma; font-size:11px;color:#BCBEC0; text-align:center;font-weight:bold\">".$productName."</td>
					<td width=\"150\" style=\"".$backgroud.";font-family:arial; font-size:11px;color:#BCBEC0; text-align:center;\">".$price." (vn&#273;)</td>
					<td width=\"150\" style=\"".$backgroud.";font-family:tahoma; font-size:11px;color:#BCBEC0;text-align:center;\">".$taihkoan." (vn&#273;)</td>
					<td width=\"150\" style=\"".$backgroud.";font-family:tahoma; font-size:11px;color:#BCBEC0; text-align:center;font-weight:bold\" class=\"datmua\"><a href=\"".$Linkto."\">".$define["var_datmua"]." <img src=\"".$_IMG_DIR."/giohang.gif\" align=\"absmiddle\" border=\"0\"></a></td>
				</tr>
				";		
				
		$count++;
	 }
	$Producthome .='</table>'; 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" height="26px;" style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y"><?=$listTabs?></td>
		</tr>
		<tr>
			<td width="100%" valign="top" style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y;"><?=$Producthome?></td>
		 </tr>
 </table>
<?
}
?>
