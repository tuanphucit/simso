<?
if(!$_PAGE_VALID)
{
	exit();
}
$sql = new mysql;
$froms = "product";
$conds = "view=1";
$others = "ORDER BY id DESC LIMIT 30";
$sql->set_query($froms, "DISTINCT sosim", $conds, $others);
$titemRowsss = $sql->nRows;
$counttt =0;
while($sql->set_farray())
{
			$nnfoName = $sql->farray["sosim"];
			$productId = $opt->optionvalue("product", "id", "sosim='".$nnfoName."'");
			$nnfoName = str_replace("`","",$nnfoName);

				  if($counttt == 0)
				    {
						$listVarName .= "ctl001_C1_rr_frame".$counttt;
					}
					else
					{
						$listVarName .= "','ctl001_C1_rr_frame".$counttt;
					}
		$Linkto = "$_URL_BASE/index.php/order/$productId/sim-so-dep-$productName.html";
		$contentlist .= '<DIV id=ctl001_C1_rr_frame'.$counttt.' style="OVERFLOW: hidden;vertical-align:top; padding-bottom:3px; padding-top:10px">
							<div class="newnews" style="color:#ffcc00"><a href="'.$Linkto.'">'.$nnfoName.'</a></div>
						</div>';
				$counttt++;
				}
?>
	<script language="javascript" src="<?=$_JS_DIR?>/myScroll.js"></script>	
				<table width="100%" cellpadding="0" cellspacing="0" align="center" >
				<tr>
					<td class="rightmenu"><?=$Title?></td>
				</tr>
				<tr>
					<td valign="top" class="rightmenu1" align="center">
						<div id=ctl001_C1_rr_wrapper>
							<div id=ctl001_C1_rr_Div style="WIDTH: 180px;OVERFLOW: hidden; POSITION: relative; HEIGHT:240px">
								<div id=ctl001_C1_rr_FrameContainer style="WIDTH: 100%px;POSITION: relative"><?=$contentlist?></div>
							</div>
						</div>
				   </td>
				</tr>
				<tr>
				 	<td valign="top"><img src="<?=$_IMG_DIR?>/menuleft_3.jpg" border="0" /></td>
				 </tr>
				</table>
<SCRIPT type=text/javascript>
	window["ctl001_C1_rr"] = new RadRotator('ctl001_C1_rr',10);
	window["ctl001_C1_rr"].AutoAdvance = 5;
	window["ctl001_C1_rr"].FrameTimeout = 1000;
	window["ctl001_C1_rr"].RotatorMode = 'Scroll';
	window["ctl001_C1_rr"].NumberOfFrames = '<?=$titemRowsss?>';
	window["ctl001_C1_rr"].PauseOnMouseOver = 5;
	window["ctl001_C1_rr"].HasTickers = 0;
	window["ctl001_C1_rr"].FrameIdArray = new Array('<?=$listVarName?>');
	window["ctl001_C1_rr"].ScrollSpeed = 10;
	window["ctl001_C1_rr"].ScrollDirection = 'Up';
	window["ctl001_C1_rr"].UseSmoothScroll = 5;
	window["ctl001_C1_rr"].SmoothScrollDelay = 10;
	window["ctl001_C1_rr"].Start();
</SCRIPT>