<table width="90%" cellpadding="0" cellspacing="0" align="center">
	<tr height="50"><td class="modulehead">Ch&#224;o m&#7915;ng qu&#7843;n tr&#7883; vi&#234;n <strong><?=$usrname?></strong>!</td></tr>
	<tr>
		<td width="100%">					
			<div id="MAIN" class="maindiv" style="width: 200px; height: 200px; position:relative; border:0px">
			<table cellspacing="0" cellpadding="0" width="100%">
				<tr height="30">
					<td class="rowinfo">
						<div>
							C&#7843;m &#417;n b&#7841;n &#273;&#227; tham gia c&#244;ng vi&#7879;c qu&#7843;n tr&#7883; site!
							V&#7899;i acount n&#224;y b&#7841;n c&#243; c&#225;c quy&#7873;n sau:
						</div>
						<ul>
							<li>Xem t&#7845;t c&#7843; c&#225;c th&#244;ng tin.</li>
							<? if($usrper["canAdd"]==YES){?><li>Th&#234;m c&#225;c th&#244;ng tin cho site.</li><? }?>
							<? if($usrper["canEdit"]==YES){?><li>Ch&#7881;nh s&#7917;a l&#7841;i c&#225;c th&#244;ng tin &#273;&#227; &#273;&#432;a.</li><? }?>
							<? if($usrper["canDel"]==YES){?><li>Xo&#225; c&#225;c th&#244;ng tin &#273;&#227; &#273;&#432;a.</li><? }?>
							<? if($usrper["canUser"]==YES){?><li>Qu&#7843;n l&#253; th&#244;ng tin c&#7911;a c&#225;c th&#224;nh vi&#234;n kh&#225;c trong ban qu&#7843;n tr&#7883;.</li><? }?>
						</ul>
					</td>
				</tr>
				<tr>
					<td>
						<table cellpadding="5" cellspacing="1" width="100%" bgcolor="#FFFFFF">
							<tr><td style="background-color:#D8D8EB; font-weight:bold" colspan="2">M&#7897;t s&#7889; th&#244;ng tin quan tr&#7885;ng</td></tr>
							<tr bgcolor="#E6E6F2" nowrap>
								<td>&#272;ang l&#224;m vi&#7879;c v&#7899;i ng&#244;n ng&#7919;:</td>
								<td width="60%"><? if($sql->dbcon) echo $myOpt->optionvalue("vot_language","language_name","language_id='".$LANG."'")?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</div>
		</td>
	</tr>
</table>
