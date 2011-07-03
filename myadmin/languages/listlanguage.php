<table cellspacing="0" cellpadding="5" width="100%" height="100%">
	<tr>
		<td width="100%">
			<table cellspacing="0" cellpadding="0" width="100%" height="100%">
				<tr height="60">
					<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left"><?=def_qlngonngu?></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom: 5px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<form name="frmSearch" method="post" action="index.php?module=<?=$module?>">
								<td nowrap valign="bottom">							
									<div class="headlink"><a href="index.php?module=home"><?=def_trangchu?></a> / <?=def_ngonngu?></div>
									<div>
										<font style="font-weight:bold; color:#993300"><?=def_tukhoa?>: </font>
										<input name="KWD" class="textbox" size="30" maxlength="200" value="<?=$KWD?>" onKeyUp="telexingVietUC(this)" accesskey="k">
										<button type="submit" name="search" accesskey="s" style="margin:10px 3px 0px 10px"><?=def_tim?></button>
									</div>								
								</td>
								</form>
	  						<td class="headlink" align="right"><?=global_btns()?></td>		
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="headform">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td width="250" style="font-weight:bold">
									<input type="checkbox" align="left" onClick="checkAll(this)"> 
									<a href="?module=<?=$module?>&orderBy=name&vArrow=<?=$toArrow?>&KWD=<?=$KWD?>"><?=def_danhmuc?> <?=$senderArrow?></a>
								</td>
								<td width="80" align="center" style="font-weight:bold" nowrap><a href="?module=<?=$module?>&orderBy=order&vArrow=<?=$toArrow?>&KWD=<?=$KWD?>"><?=def_thutu?> <?=$orderArrow?></a></td>
								<td width="40" align="center" style="font-weight:bold" nowrap><?=def_hien?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="380" align="center" valign="top" height="100%" class="tbllist">
						<table width="100%" cellpadding="4" cellspacing="0">
							<form action="<?=$url?>&action=delete" method="post" name="frmList" onsubmit="return checkInput();">
<?
	$cur_id = NULL; $cur_name = NULL; $flag = "No flag"; 
	$dir = NULL; $cur_order = 20; $cur_view = NULL;
	$CL_SELECTED = "#F5F0F0";
	
	if($tRows>0)
	{
		$low = $curRow; 
		$curRow = 1;
		$cur_p = array();
		while (($sql->set_farray())&&($curRow<=$tRows)&&($curRow<=$curPg*$maxRows))
		{
			$curRow++;			                           
			if($curRow>$low)
			{
				$nid = $sql->farray["language_id"];
				$name = $sql->farray["language_name"];
				$order = $sql->farray["language_order"];
				if($sql->farray["language_view"]=='1') $view = "checked";
				else $view = NULL;
				$subTitle = "Strings were defined in $name";
								
				if(($CURID==NULL)&&($curRow==$low+1)) {$CURID = $nid;}
				if($nid==$CURID) 
				{
					$cur_id = $nid;
					$cur_name = $name;
					$cur_order = $order;
					$cur_view = $view;
					$flag = $sql->farray["language_flag"];
					$dir = $sql->farray["language_dir"];

					$BG_COLOR = $CL_SELECTED;
					$arrow = '<img src="images/arrowb.gif">';
					$style = 'style="border-right:1px solid #EEEEEE"';
					//$check = "checked";
					$name = "<font class=itemselected>$name</font>";
					$sS1 = ""; $sS2 = "";
				}
				else 
				{
					$BG_COLOR = "#F5F5F5";
					$arrow = "&nbsp;";
					$style = 'style="border-right:0px"';
					$check = NULL;
					$sS1 = 	' style="cursor: pointer" onMouseOver=active(this); onMouseOut="deactive(this);"';				
					$sS2 =  ' onClick=goPage("'.$url.'&CURID='.$nid.'"); ';
				}				
?>
							<tr valign="middle" bgcolor="<?=$BG_COLOR?>" <?=$sS1?> height="30">
								<td align="center" width="5" class="rowlist"><input type="checkbox" value="<?=$nid?>" <?=$check?> name="chkid"></td>
								<td align="center" width="5" class="rowlist"><a href="<?=$url?>&action=defines&CURID=<?=$nid?>" title="<?=$subTitle?>"><img src="images/closefold.gif" border="0"></a></td>
								<td width="250" <?=$sS2?> class="rowlist"><?=$name?></td>
								<td width="80" align="center" class="rowlist"><input name="itOrder_<?=$nid?>" value="<?=$order?>" class="textbox" size="2" onChange="getObjChange('<?=$nid?>',this,'listOrder','listId_O')"></td>
								<td width="40" align="center" class="rowlist"><input type="checkbox" name="itView_<?=$nid?>" <?=$view?> onClick="getObjChange('<?=$nid?>',this,'listView','listId_V')"></td>
								<td <?=$sS2?> width="5" class="rowlist"><?=$arrow?></td>
							</tr>
<? }}}else{ echo NORESULT;}?>
							<tr height="25">
								<td width="100%" colspan="4"><?=paging($tRows,$curPg,$maxRows)?></td>
							</tr>
							<input type=hidden name="chon" value="<?=$chkid?>">
							<input type=hidden name="listId_O">
							<input type=hidden name="listId_V">
							<input type=hidden name="listOrder">
							<input type=hidden name="listView">
							<input type="hidden" name="orderBy" value="<?=$orderBy?>">
							<input type="hidden" name="vArrow" value="<?=$vArrow?>">
							</form>
						</table>
					</td>
					<td align="center" height="100%" valign="top" bgcolor="<?=$CL_SELECTED?>" class="tblinfo"><? include_once("languageinfos.php");?></td>
				</tr>
				<form name="frmPaging" method="post">
					<input type="hidden" name="curPg">
					<input type="hidden" name="CURID" value="<?=NULL?>">
					<input type="hidden" name="orderBy" value="<?=$orderBy?>">
					<input type="hidden" name="vArrow" value="<?=$vArrow?>">
				</form>
			</table>
		</td>
	</tr>
</table>