<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

$listId = str_replace(",", "','",$listShowItemId);

$conds  = "realty_id NOT IN ('".$listId."') AND realty_view=1";
if($cateId)
{
	$froms = "vot_realty";
	$conds .= " AND modules_id='".$cateId."'";
}

$others = "ORDER BY realty_date DESC, realty_order DESC";
$sql->set_query($froms, "*", $conds);
$tRows = $sql->nRows;
$maxRows = 10;
if(!$curPg) 
{
	$curPg = 1;
}
else
{
	$numPgs = ceil($tRows / $maxRows);
	if($curPg > $numPgs) $curPg = $numPgs;
}
$curRow = ($curPg - 1) * $maxRows + 1;
if($tRows > 0)
{	
	$otherItems = '
	<div style="font-size:14px; font-weight:bold; padding:10px 0px 5px 0px">'.$define["var_cacthongtinlienquan"].'</div>
	<div id="itemRelations"><ul>';
	$low = $curRow; 
	$curRow = 1;
	$imgMaxW = 166;
	while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
	{
		$curRow++;			                           
		if($curRow > $low)
		{
			$oItemId = $sql->farray["realty_id"];
			$oItemName = $sql->farray["realty_name"];
			$oItemDate = outDateStr($sql->farray["realty_date"]);
			if(!$cateId)
			{
				$oItemCate = $sql->farray["a.realtytype_id"];
			}
			else
			{
				$oItemCate = $cateId;
			}
			if(!$oItemCate)
			{
				$oItemCate = 0;
			}
			$linkto = "$_URL_BASE/index.php/$oItemCate/$oItemId/".str_replace(" ", "_", $oItemName);		
			$otherItems .= '<li><a href="'.$linkto.'">'.$oItemName.'</a> <font color="#999999">('.$oItemDate.')</font></li>';
		}
	}
	$otherItems .= '</ul></div>
	<div align="right">'.realtyPaging($tRows, $curPg, $maxRows).'</div>';
}
echo $otherItems;
?>