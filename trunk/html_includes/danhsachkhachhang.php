<?
if(!$_PAGE_VALID)
{
	exit();
}
$sql = new mysql;
$froms = "vot_listorder";
$conds = "language_id='".$lang."' AND listorder_view = 1";
$others = "ORDER BY listorder_date DESC LIMIT 7";
$sql->set_query($froms, "*", $conds, $others);
$count =0;
while($sql->set_farray())
{
	$count ++;
	$infoId = $sql->farray["listorder_id"];
	$proId = $sql->farray["product_id"];
	$infoName = $sql->farray["listorder_name"];
	$infoDate = outDateStr($sql->farray["listorder_date"]);
	$infoadd = $sql->farray["listorder_add"];
	
	$sim = $opt->optionvalue("product", "sosim", "id='".$proId."'");
	$sim = str_replace("`","",$sim);
	//$linkto = "$_URL_BASE/index.php/$modId/$infoId/".str_replace(" ", "_", $sql->farray["listorder_name"]);
	
	$listorder .= "<div class=\"newnews\" style=\"color:#fe0002; font-weight:bold\">$sim</div>";
	$listorder .= "<div class=\"newnews\">$infoDate </div>";
	$listorder .= "<div class=\"newnews\">$infoName </div>";
	$listorder .= "<div class=\"newnews\">$infoadd </div>";
	if($count < 4)
	{
	$listorder .= "	<div><img src=\"$_IMG_DIR/line_newnews.jpg\" border=\"0\" style=\"margin:3px 0px 7px 0px\"></div>";
	}
}
?>
 
                    <a class="first">Các đơn hàng mới</a>
                    <marquee direction="up" onmouseout="this.start()" onmouseover="this.stop()" scrollamount="2" behavior="scroll">
						<?=$listorder?>
					 </marquee>
         