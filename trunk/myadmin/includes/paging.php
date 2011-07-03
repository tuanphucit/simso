<?php
function paging($tRows,$curPg,$re)
{
	$paging  = "";
	$paging .= '<table width="100%" border="0" cellspacing="0" cellpadding="5" height="20">';
	$paging .= '<tr><td width="35%" class="text_grey" nowrap>'.def_tongso.': <font color="red">';
	$paging .= $tRows.'</font></td><td width="65%" align="right" class="text_grey">';
	$mxR = $re;
	if($tRows%$mxR==0) $tPages = (int)($tRows/$mxR);
	else $tPages = (int)($tRows/$mxR+1);

	$curRow = ($curPg-1)*$mxR+1;
	if($tRows>$mxR)
	{
		$paging .= '&nbsp;&nbsp; '.def_trang.': ';
		$paging .= '<select onChange="changePage(this)">';
		for($i=1;$i<=$tPages;$i++)
		{
			$paging .= '<option value="'.$i.'"';
			if($i==$curPg) $paging .= ' selected';
			$paging .= '>'.$i.'</option>';
		}
		$paging .= '</select>';
	}
	$paging .= '</td></tr></table>';
	return $paging;
}
?>