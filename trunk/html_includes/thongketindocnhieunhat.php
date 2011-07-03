<?
if(!$_PAGE_VALID)
{
	exit();
}
$maxLevelColect = $opt->optionvalue("vot_modules", "MAX(modules_level)", "language_id='".$lang."' AND modules_view=1");
		$ColectCateId = NULL;
		$conds = "modules_id='".$cateId."'";
		$sql->set_query("vot_modules", "*", $conds);
		if($sql->set_farray())
		{
			$curLevel = $sql->farray["moudles_level"];
		}
		$ssql = new mysql();
		for($n = 0 ; $n <= $maxLevelColect; $n++)
		{
			if($ColectParCate == 0)
			{
			$conds = "modules_parent IN ('".$ColectParCate."') AND modules_level='".$n."' AND modules_view=1 AND modules_pos = '0,0,1,1' || modules_pos = '0,1,1,0' AND language_id = '".$lang."'";
			}else
			{
			$conds = "modules_parent IN ('".$ColectParCate."') AND modules_level='".$n."' AND modules_view=1 AND language_id = '".$lang."'";
			}
			$others = "ORDER BY modules_order ASC";
			$ssql->set_query("vot_modules", "*", $conds, $others);
			//$ColectParCate = NULL;
			while($ssql->set_farray())
			{
				$subCateId = $ssql->farray["modules_id"];
				$subCateName = $ssql->farray["modules_name"];
				$subCateLink = $ssql->farray["modules_linkto"];
				$mnItemPos = split(",", $ssql->farray["modules_pos"]);
				if(checkSubCate($subCateId))
				{
					if($ColectParCate != NULL) $ColectParCate .= "','".$subCateId;
					else $ColectParCate .= $subCateId;
				}
				else 
				{
					if($ColectCateId != NULL) $ColectCateId .= "','".$subCateId;
					else $ColectCateId .= $subCateId;
				}
			}
		}
		$sssql = new mysql();
		$conds = "modules_id IN ('".$ColectCateId."') AND modules_view=1 AND language_id = '".$lang."'";
		$others = "ORDER BY modules_order ASC";
		$sssql->set_query("vot_modules", "*", $conds, $others);
		//$ColectParCate = NULL;
		$counttt = 0;
		$titemRowsss = $sssql->nRows;
		if($titemRowsss >0 )
		{
		$listTopRead='<table width="100%" border=0 cellpacing=0 cellpadding=0>';
		$a = 0;
		$total_value = 0;
		while($sssql->set_farray())
		{
		 $a++;
			if($a==1)
			{
			$mnnfoId = $sssql->farray["modules_id"];
			}
			else
			{
			$mnnfoId .= "','".$sssql->farray["modules_id"];
			}
			
			 		$nnfoId = $sssql->farray["modules_id"];
					$subCateName = $sssql->farray["modules_icon"];
					$nnfoName = displayData_DB($sssql->farray["modules_name"]);
					$nCon = $sssql->farray["modules_icon"];
					$mnItemshortdes = $sssql->farray["modules_shortdes"];
					//phan lay tong cac sim dien thoai
					$sssqll = new mysql();
					$conds = "category ='".$nnfoId."' AND view=1";
					$others = "ORDER BY id ASC";
					$sssqll->set_query("product", "sosim", $conds, $others);
					//$ColectParCate = NULL;
					$counttt = 0;
					$tongsim = $sssqll->nRows;
					$total_value = $tongsim;
					if(!$HTTP_SESSION_VARS["total_value"]) _SESSION_REGISTER("total_value");
					$HTTP_SESSION_VARS["total_value"] = $tongsim;
		$listTopRead .='<tr >
								<td class="bottom_top" width="55%" style="border-right:1px solid #9bb9c1;border-bottom:1px solid #9bb9c1">'.$nnfoName.' </td>
								<td class="bottom_top" style="border-bottom:1px solid #9bb9c1;"><span style="color:#fd720d">'.number_format($tongsim).'</span> Sim</td>
						</tr>
						';
			}
			
		$conds = "category IN ('".$mnnfoId."') AND view=1";
		$others = "ORDER BY id ASC";
		$sssql->set_query("product", "*", $conds, $others);
		//$ColectParCate = NULL;
		$counttt = 0;
		$sum = $sssql->nRows;
		
		$listTopRead .='
		<tr>
				<td colspan=3 valign=top>
					<table width="100%" cellpacing=0 cellpadding=0 border="0">
						<tr>	
							<td style="text-align:right" width="45%" class="bottom_top">'.$define["var_tongso"].' : </td>
							<td style="color:#006663" colspan="2"><span style="color:#fe0002"> <b>'.number_format($sum).'</b></span> Sim</b></td>
						</tr>
					</table>
				</td>		
		</tr>
		</table>';
	}		
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td class="rightmenu"><?=$Title?></td>
</tr>
<tr>
  <td valign="top"  class="rightmenu1">
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td ><div><?=$listTopRead?></div></td>
		</tr>
		<tr>
			<td height="3"></td>
		</tr>
		<!--<tr>
				<td width="189" align="center" valign="middle" style="padding-top: 10px;padding-bottom: 10px;">
									    <!-- Histats.com  START  -->
<!--										
<a href=" http://www.histats.com" target="_blank" title="counter statistics" ><script  type="text/javascript" language="javascript">
var s_sid = 791850;var st_dominio = 4;
var cimg = 430;var cwi =112;var che =75;
</script></a>
<script  type="text/javascript" language="javascript" src=" http://s10.histats.com/js9.js"></script>
<noscript><a href=" http://www.histats.com" target="_blank">
<img  src=" http://s4.histats.com/stats/0.gif?791850&1" alt="counter statistics" border="0"></a>
</noscript>
<!-- Histats.com  END  -->
<!--
						 </td>
		 </tr>-->
	 </table>
    </td>
 </tr>
 <tr>
 	<td valign="top"><img src="<?=$_IMG_DIR?>/menuleft_3.jpg" border="0" /></td>
 </tr>
</table>