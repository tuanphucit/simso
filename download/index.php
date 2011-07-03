<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");
$contentFile = "includes/center_content.php";


	$sqql = new mysql();
	$cond = "view = 1 AND category IN ('".$id."')";
	$others = "ORDER BY thutu DESC LIMIT 300";
	$sqql->set_query("product", "DISTINCT sosim", $cond, $others);
	$tRows =$sqql->nRows;
	$content.= '<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#0a35d4" align="center">
							<tr height="26">
								<td width="50" style="font-family:tahoma; font-size:11px;color:#0a14e8;font-weight:bold; text-align:center;background-color:#eeeeee">STT</td>
								<td width="150" style="font-family:tahoma; font-size:11px;color:#0a14e8;font-weight:bold; text-align:center;background-color:#eeeeee">'.$define["var_sosim"].'</td>
								<td width="150" style="font-family:tahoma; font-size:11px;color:#0a14e8; font-weight:bold;text-align:center;background-color:#eeeeee">'.$define["var_gia"].'</td>
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
					<td width=\"50\" style=\"font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\">".$count."</td>
					<td width=\"150\" style=\"font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\">".$productName."</td>
					<td width=\"150\" style=\"font-family:arial; font-size:11px;color:#000000; text-align:center;\">".$price." (vn&#273;)</td>
				</tr>";		
	 }
	$content.='</table>'; 
	
header("Content-Type: application/vnd.ms-excel; name='excel'; charset=UTF-8");
header("Content-Disposition: attachment; filename=Bang-so-dep-".date("d-m-y").".xls;");
header("Pragma: no-cache");
header("Expires: 0");
 
echo $content;
?>