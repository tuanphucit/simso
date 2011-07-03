<?
session_start();

include_once("../myadmin/includes/config.php");
include_once("../myadmin/includes/mysql.php");
include_once("../includes/global.php");

if(!$begin)
{
	$begin = 0;
}

$maxRows = 7;
$end = $begin + $maxRows + 1;

$conds = "modules_id = 10";
$sql->set_query("vot_modules","*",$conds);
if($sql->set_farray())
{
	$mnTitle = $sql->farray["modules_name"];
	$mnLinkto = $sql->farray["modules_linkto"];
}
$count = 0;
$conds = "language_id = '".$lang."' AND modules_id = 10 AND newstype_view = 1";
$others = "ORDER BY newstype_order ASC LIMIT $begin, $end";
$sql->set_query("vot_newstype", "*", $conds, $others);
if($sql->nRows > 0)
{
	if($sql->nRows > $maxRows)
	{
		$stopAt = $maxRows; 
	}
	else
	{
		$stopAt = $sql->nRows;
	}
	echo '
	<table width="218" height="202" cellpadding="0" cellspacing="0" border="0" align="center" background="'.$_IMG_DIR.'/leftmenu_bg.jpg">
		<tr>
			<td class="leftMenuTitle">'.$mnTitle.'</td>
		</tr>
		<tr>
			<td algin="center" valign="top">
				<table width="80%" align="center" cellpadding="0" cellspacing="0">';
	while($sql->set_farray() && $count < $stopAt)
	{
		$mnItemId = $sql->farray["newstype_id"];
		$mnItemName = $sql->farray["newstype_name"];
		$mnStyle = "leftMnItem";
		if($count == $stopAt - 1)
		{
			$mnStyle = "endLeftMnItem";
		}
		echo '<tr><td class="'.$mnStyle.'"><a href="'."$_URL_BASE/index.php/$mnLinkto/$mnItemId".'">'.$mnItemName.'</a></td></tr>';
		$count++;
	}
	if($begin == 0)
	{
		$preArrow = "dis";
		$preStyle = "styleDisabled";
		$preOnClick = NULL;
	}
	else
	{
		$preArrow = "en";
		$preStyle = "styleEnabled";
		$preBeg = $begin - $maxRows;
		$sLink = "$_URL_BASE/html_includes/menuleft.php?begin=$preBeg";
		$preOnClick = 'onClick="showPageContent(\''.$sLink.'\', \'leftMenu\')"';
	}
	if($sql->nRows > $maxRows)
	{
		$nextArrow = "en";
		$nextStyle = "styleEnabled";
		$nextBeg = $begin + $maxRows;
		$sLink = "$_URL_BASE/html_includes/menuleft.php?begin=$nextBeg";
		$nextOnClick = 'onClick="showPageContent(\''.$sLink.'\', \'leftMenu\')"';		
	}
	else
	{
		$nextArrow = "dis";
		$nextStyle = "styleDisabled";
		$nextOnClick = NULL;
	}	
	echo '
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" height="20">
				<img src="'.$_IMG_DIR.'/prearrow_'.$preArrow.'.jpg" border="0" '.$preOnClick.' class="'.$preStyle.'">
				<img src="'.$_IMG_DIR.'/nextarrow_'.$nextArrow.'.jpg" border="0" '.$nextOnClick.' class="'.$nextStyle.'">
			</td>
		</tr>
	</table>';
}
?>