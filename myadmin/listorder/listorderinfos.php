<script language="javascript" src="../js/modalbox/prototype.js"></script>
<script language="javascript" src="../js/modalbox/scriptaculous.js"></script>
<script language="javascript" src="../js/modalbox/modalbox.js"></script>
<style type="text/css">@import url("../css/modalbox.css");</style>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr height="30">
		<td align="right" style="border-bottom: 1px solid #CCCCCC; background-color:#6699CC">
<?
if($usrper["canDel"]==YES && $CURID!=NULL){
?>
			<input type="image" name="btnDelete" src="images/ed_delete.gif" title="<?=alt_del?>" onClick="delCurObj('<?=$CURID?>')" class="icon_l">
<? 
}
?>
		</td>
	</tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table width="100%" cellspacing="0" cellpadding="0">
				<form action="<?=$url?>&action=update" name="frmEdit" method="post" enctype="multipart/form-data">
				<tr height="30" bgcolor="<?=$CL_SELECTED?>">
					<td class="rowinfohead" nowrap width="20%"><b>Ng&#432;&#7901;i li&#234;n h&#7879;:</b></td>
					<td width="80%" class="rowinfo"><?=$cur_name?>&nbsp;</td>
				</tr>
				<tr>
					<td class="rowinfohead">Ng&#224;y g&#7917;i: </td>
					<td class="rowinfo"><?=$ndate?>&nbsp;</td>
				</tr>
				<tr>
					<td class="rowinfohead">&#272;&#7883;a ch&#7881;: </td>
					<td class="rowinfo"><?=$add?>&nbsp;</td>
				</tr>
				<tr>
					<td class="rowinfohead">&#272;i&#7879;n tho&#7841;i: </td>
					<td class="rowinfo"><?=$tel?>&nbsp;</td>
				</tr>
				<tr>
					<td class="rowinfohead">Fax: </td>
					<td class="rowinfo"><?=$fax?>&nbsp;</td>
				</tr>
				<tr>
					<td class="rowinfohead">Email: </td>
					<td class="rowinfo"><?=$email?>&nbsp;</td>
				</tr>
				<tr>
					<td class="rowinfohead">S&#7843;n ph&#7849;m &#273;&#7863;t mua: </td>
					<td class="rowinfo"><?=$sosim?></td>
				</tr>
				<tr>
					<td class="rowinfohead">Kho: </td>
					<td class="rowinfo">
					<?
						//$sqlnn=mysql_query("");
						$sql="select * from product where sosim='`$sosim'";
									//echo $sql ;
									$result_1=mysql_query($sql);
									$numrows=mysql_num_rows($result_1);
									if($numrows)
									{
										$rows=mysql_fetch_array($result_1);
										echo $kho=$rows["kho"];
											
									}
					?>
					</td>
				</tr>
				<tr>
					<td class="rowinfohead">Y&#234;u c&#7847;u k&#232;m theo: </td>
					<td class="rowinfo"><?=$detail?>&nbsp;</td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_thutu?>: </td>
					<td class="rowinfo"><input name="order" type="text" value="<?=$cur_order?>" class="textbox" size="5" maxlength="11" readonly="1"></td>
				</tr>
				<tr>
					<td class="rowinfohead"><?=def_hien?>: </td>
					<td class="rowinfo"><input name="view" type="checkbox" <?=$cur_view?> value="1" disabled></td>
				</tr>
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				<input type="hidden" name="old_thumb" value="<?=$thumb?>">
				<input type="hidden" name="old_image" value="<?=$image?>">
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
				</form>
			</table>
			</div>
		</td>
	</tr>
</table>
