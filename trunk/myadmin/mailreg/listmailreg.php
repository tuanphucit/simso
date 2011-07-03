<table cellspacing="0" cellpadding="5" width="100%" height="100%">
	<tr>
		<td width="100%">
			<table cellspacing="0" cellpadding="0" width="100%" height="100%">
				<tr height="60">
					<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left"><?=$pageTitle?></td>
				</tr>
				<tr>
					<td colspan="2" style="padding-bottom:5px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<form name="frmSearch" method="post" action="index.php?module=<?=$module?>&PARENTID=<?=$PARENTID?>">
								<td nowrap valign="bottom">							
									<div class="headlink" id="headLink"><?=$linkPath?></div>
									<div>
										<font style="font-weight:bold; color:#993300"><?=def_tukhoa?>: </font>
										<input name="KWD" class="textbox" size="30" maxlength="200" accesskey="k" value="<?=$KWD?>" onKeyUp="telexingVietUC(this)">
										<button type="submit" name="search" accesskey="t" style="margin:10px 3px 0px 10px">&nbsp; <?=def_tim?> &nbsp;</button>
									</div>								
								</td>
								</form>
<?
if($usrperstr == FULL || $usrid==0)
{
?>
								<td align="right">
									<table border="0" cellpadding="0" cellspacing="0" align="right">
										<tr>	
											<td align="center" id="btnAdd">
												<a class="toolbar" href="<?=$module?>/send.php" onClick="openBox(this.href, 400, 300); return false">
												<img src="images/send_f2.png" alt="<?=alt_add?>" align="middle" border="0"> <br><?=btn_send?></a> 
											</td>
										</tr>
									</table>								
								</td>
	  						<td align="right" width="5%"><?=global_btns()?></td>
<?
}
?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="headform">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td width="275" style="font-weight:bold">
									<input type="checkbox" align="left" onClick="checkAll(this)"> 
									<a href="?module=<?=$module?>&PARENTID=<?=$PARENTID?>&orderBy=name&vArrow=<?=$toArrow?>&KWD=<?=$KWD?>"><?=def_danhmuc?> <?=$senderArrow?></a>
								</td>
								<td width="60" align="center" style="font-weight:bold" nowrap><a href="?module=<?=$module?>&PARENTID=<?=$PARENTID?>&orderBy=order&vArrow=<?=$toArrow?>&KWD=<?=$KWD?>"><?=def_thutu?> <?=$orderArrow?></a></td>
								<td width="60" align="center" style="font-weight:bold" nowrap>Nh&#7853;n</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="380" align="center" valign="top" height="100%" class="tbllist" id="tblList">
						<table width="100%" cellpadding="4" cellspacing="0">
							<form action="<?=$url?>&action=delete" method="post" name="frmList" onsubmit="return checkInput();">
							<?=$pageContent?>
							<tr height="25">
								<td width="100%" colspan="5"><?=paging($tRows,$curPg,$maxRows)?></td>
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
					<td align="center" height="100%" valign="top" bgcolor="<?=$CL_SELECTED?>" class="tblinfo">
						<? include_once($rightContentFile)?>
					</td>
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