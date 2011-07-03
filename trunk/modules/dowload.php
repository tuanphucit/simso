<?
if(!$_PAGE_VALID)
{
	exit();
}
$moId = $url_array[1];
	$sqql = new mysql();
	$cond = "ihome = 1 AND view = 1 AND category IN ('".$moId."')";
	$others = "ORDER BY thutu DESC LIMIT ".$config["site_Productmaxnum"]."";
	$sqql->set_query("product", "DISTINCT sosim", $cond, $others);
	$tRows =$sqql->nRows;
	$content.= '<table width="98%" cellpadding="0" cellspacing="0" border="0">
							<tr height="26">
								<td width="25" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold; text-align:center;background-color:#eeeeee">STT</td>
								<td width="100" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold; text-align:center;background-color:#eeeeee">'.$define["var_sosim"].'</td>
								<td width="100" style="font-family:tahoma; font-size:11px;color:#fd720b; font-weight:bold;text-align:center;background-color:#eeeeee">'.$define["var_gia"].'</td>
							</tr>';
	$count = 0;						
	while($sqql->set_farray())
	{
				$count ++;
				$productName = $sqql->farray["sosim"];
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
$content.= "
				<tr height=\"24\">
					<td width=\"25\" style=\"border-left:1px solid #c4c4c4;border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\">".$count."</td>
					<td width=\"100\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\">".$productName."</td>
					<td width=\"100\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:arial; font-size:11px;color:#000000; text-align:center;\">".$price." (vn&#273;)</td>
				</tr>";		
		$count++;
	 }
	$content.='</table>'; 
	
header("Content-Type: application/vnd.ms-word; name='word'; charset=UTF-8");
header("Content-Disposition: attachment; filename=".date("dmy").".doc;");
header("Pragma: no-cache");
header("Expires: 0");
 
echo $content;
?>