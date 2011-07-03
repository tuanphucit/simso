<table cellspacing="0" cellpadding="5" width="100%" height="100%">
	<tr>
		<td width="100%">
			<table cellspacing="0" cellpadding="0" width="100%" height="100%">
				<tr height="60">
					<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left"><?=def_qluser?></td>
				</tr>
				<tr>
					<td class="headlink" nowrap valign="bottom" style="padding-bottom: 5px"><a href="index.php?module=home"><?=def_trangchu?></a> / <?=def_qluser?></td>
	  			<td class="headlink" align="right" style="padding-bottom: 5px"><?=global_btns()?></td>		
				</tr>
				<tr><td colspan="2" class="headform" style="padding-left:5px"><input type="checkbox" align="left" onClick="checkAll(this)"><?=def_danhmuc?></td></tr>
				<tr>
					<td width="40%" align="center" valign="top" height="100%" class="tbllist">
						<table width="100%" cellpadding="4" cellspacing="0">
							<form action="index.php?module=users&action=delete" method="post" name="frmList" onsubmit="return checkInput();">
			<?
				$cur_fname = NULL; $org = NULL; 
				$act = NULL; $cur_id = NULL;
				$perm = setPermisionChecked(outPermisionStr(FULL));
				$sizeBox = 20;				
				$EDIT = 'style="display:none"';
				$DEL = 'style="display:none"';
				$CL_SELECTED = "#F5F0F0";
				
				if($tRows>0)
				{
					$low=$curRow; 
					$curRow = 1;
					$cur_p = array();
					while (($sql->set_farray())&&($curRow<=$tRows)&&($curRow<=$curPg*$maxRows))
					{
						$curRow++;			                           
						if($curRow>$low)
						{
							$uid = $sql->farray["user_id"];
							$user = $sql->farray["user_name"];
							if($uid!=$usrid) $curuser = NULL;
							else $curuser = '<font style="color:#FF6600; font-weight:normal">[ User hi&#7879;n th&#7901;i ]</font>';
							
							$url = "?module=users&CURID=$uid&curPg=$curPg";
							
							if(($CURID==NULL)&&($curRow==$low+1)) {$CURID = $uid;}
							if($uid==$CURID) 
							{
								$cur_id = $uid;
								$cur_user = $user;
								$fname = $sql->farray["user_fullname"];
								$perm = outPermisionStr($sql->farray["user_perm"]);
								$permChked = setPermisionChecked($perm);
								if($usrper["canEdit"]==YES) $EDIT = NULL;
								if($cur_id!=$usrid && $usrper["canDel"]==YES) $DEL = NULL;

								$BG_COLOR = $CL_SELECTED;
								$arrow = '<img src="images/arrowb.gif">';
								$style = 'style="border-right:1px solid #EEEEEE"';
								$check = "checked";
								$user = "<font class=itemselected>$user</font>";
								$sS1 = ""; $sS2 = "";
							}
							else 
							{
								$BG_COLOR = "#F5F5F5";
								$arrow = "&nbsp;";
								$style = 'style="border-right:0px"';
								$check = NULL;
								$sS1 = 	' style="cursor: pointer" onMouseOver=active(this); onMouseOut="deactive(this);"';				
								$sS2 =  ' onClick=goPage("'.$url.'"); ';
							}
			?>
							<tr valign="middle" bgcolor="<?=$BG_COLOR?>" <?=$sS1?> height="30">
								<td align="center" width="5" class="rowlist"><input type="checkbox" value="<?=$uid?>" <?=$check?> name="chkid"></td>
								<td width="95%" <?=$sS2?> class="rowlist"><?=$user?>&nbsp;<?=$curuser?></td>
								<td <?=$sS2?> width="2%" class="rowlist"><?=$arrow?></td>
							</tr>
			<? }}}else{ echo NORESULT; }?>
							<tr height="25">
								<td width="100%" colspan="2"><?=paging($tRows,$curPg,$maxRows)?></td>
							</tr>
			<? ?>
							<input type=hidden name="chon" value="<?=$chkid?>">
							</form>
						</table>
					</td>
					<td width="40%" align="center" height="100%" valign="top" bgcolor="<?=$CL_SELECTED?>" class="tblinfo"><? include("userinfos.php")?></td>
				</tr>
				<form name="frmPaging" method="post">
					<input type="hidden" name="curPg">
					<input type="hidden" name="CURID" value="<?=NULL?>">
				</form>
			</table>
		</td>
	</tr>
</table>