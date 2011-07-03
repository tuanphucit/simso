<?
if(!$_PAGE_VALID)
{
	exit();
}
$sql = new mysql;
$froms = "product";
$conds = "ihight=1";
$others = "ORDER BY id DESC LIMIT 30";
$sql->set_query($froms, "DISTINCT sosim", $conds, $others);
$titemR = $sql->nRows;
$counttt =0;
while($sql->set_farray())
{
			
			$nnfoName = $sql->farray["sosim"];
			$producttId= $opt->optionvalue("product", "id", "sosim='".$nnfoName."'");
			$nnfoName = str_replace("`","",$nnfoName);

				  if($counttt == 0)
				    {
						$listVarNames .= "ctl00_C1_rr_frame".$counttt;
					}
					else
					{
						$listVarNames .= "','ctl00_C1_rr_frame".$counttt;
					}
				$Linksim = "$_URL_BASE/index.php/order/$productId/sim-so-dep-$nnfoName.html";
			 
				$listsimvip .= '<DIV id=ctl00_C1_rr_frame'.$counttt.' style="OVERFLOW: hidden;vertical-align:top; padding:3px 0px 3px 0px">
									<div class="newnews" style="color:#fe0000"><a href="'.$Linksim.'">'.$nnfoName.'</a></div>
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
						<div id=ctl00_C1_rr_wrapper>
							<div id=ctl00_C1_rr_Div style="WIDTH: 100%px;OVERFLOW: hidden; POSITION: relative; HEIGHT:240px">
								<div id=ctl00_C1_rr_FrameContainer style="WIDTH: 100%px;POSITION: relative"><?=$listsimvip?></div>
							</div>
						</div>
				   </td>
				</tr>
				 <tr>
					<td valign="top"><img src="<?=$_IMG_DIR?>/menuleft_3.jpg" border="0" /></td>
				 </tr>
			</table>
<SCRIPT type=text/javascript>
	window["ctl00_C1_rr"] = new RadRotator('ctl00_C1_rr',10);
	window["ctl00_C1_rr"].AutoAdvance = 1;
	window["ctl00_C1_rr"].FrameTimeout = 1000;
	window["ctl00_C1_rr"].RotatorMode = 'Scroll';
	window["ctl00_C1_rr"].NumberOfFrames = '<?=$titemR?>';
	window["ctl00_C1_rr"].PauseOnMouseOver = 1;
	window["ctl00_C1_rr"].HasTickers = 0;
	window["ctl00_C1_rr"].FrameIdArray = new Array('<?=$listVarNames?>');
	window["ctl00_C1_rr"].ScrollSpeed = 10;
	window["ctl00_C1_rr"].ScrollDirection = 'Up';
	window["ctl00_C1_rr"].UseSmoothScroll = 1;
	window["ctl00_C1_rr"].SmoothScrollDelay = 10;
	window["ctl00_C1_rr"].Start();
</SCRIPT>