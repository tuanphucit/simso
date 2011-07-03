<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

$listId = str_replace(",", "','",$listShowItemId);

$conds  = "news_id NOT IN ('".$listId."') AND news_view=1";
if($cateId)
{
	$froms = "vot_news";
	$conds .= " AND modules_id='".$cateId."'";
}

$others = "ORDER BY news_date DESC, news_order DESC";
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
	<div class="listOthersTitle">'.$define["var_cacthongtinlienquan"].'</div>
	<div id="itemRelations">';
	$low = $curRow; 
	$curRow = 1;
	$imgMaxW = 166;
	while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
	{
		$curRow++;			                           
		if($curRow > $low)
		{
			$oItemId = $sql->farray["news_id"];
			$oItemName = $sql->farray["news_name"];
			$oItemDate = outDateStr($sql->farray["news_date"]);
			if(!$cateId)
			{
				$oItemCate = $sql->farray["a.newstype_id"];
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
			$otherItems .= '<div class="listOthers"><img src="'.$_IMG_DIR.'/dau.gif">&nbsp;<a href="'.$linkto.'">'.$oItemName.'</a>&nbsp;<span class="visited">('.$oItemDate.')</span></div>';
		}
	}
	$otherItems .= '</div>
	<div align="right">'.newsPaging($tRows, $curPg, $maxRows).'</div>';
}
echo $otherItems;
?>