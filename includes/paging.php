<?php
function paging($tRows,$curPg,$re,$label=NULL)
{
	global $define;
	$label = strtolower($label);
	$paging  = NULL;
	$paging .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	$paging .= '<tr><td width="40%" style="color:#FFF3CB; padding-left:5px; font-size:11px" nowrap>'.$define["var_total"].'&nbsp;'.$label.': ';
	$paging .= '<font color="#FF9900">'.$tRows.'</font></td><td align="right" style="color:#FFF3CB; padding-right:5px; font-size:11px">';
	$mxR = $re;
	if($tRows % $mxR == 0) $tPages = (int)($tRows / $mxR);
	else $tPages = (int)($tRows / $mxR + 1);

	$curRow = ($curPg - 1) * $mxR + 1;
	$paging .= '&nbsp;&nbsp; '.$define["var_page"].': ';
	$paging .= '<select onChange="changePage(this)" style="font-size:10px">';
	for($i=1;$i<=$tPages;$i++)
	{
		$paging .= '<option value="'.$i.'"';
		if($i==$curPg) $paging .= ' selected ';
		$paging .= '>'.$i.'</option>';
	}
	$paging .= '</select>';
	$paging .= '</td></tr></table>';
	return $paging;
}
?>