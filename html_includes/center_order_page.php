<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
function doContactSubmit()
{
	var myFrm = document.frmContact;
	if(myFrm.nname.value == '')
	{
		alert('<?=$define["var_vuilongnhaphoten"]?>');
		myFrm.nname.focus();
		return false;
	}
	/*
	if(!isEmail(myFrm.email.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.email.focus();
		return false;
	}*/
	return true;
}
</script>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="top">
			<table width="100%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="26px;" class="subPageTitle" ><?=$subPageTitle?></td>
				</tr>
				<tr>
					<td style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y; padding-bottom:8" width="100%" valign="top">
<?
if($doAction == 'send' && $isSent == 1)
{
?>
						<table width="98%" height="100" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td valign="top" style="padding:6 ">
								<table width="98%" align="center" cellpadding="3" cellspacing="0" border="0">
									<tr>
										<td width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_sanphamchonmua"]?>:</td>
										<td style="border:1px solid #c4c4c4;color:#FE0002"><?=$product?></td>
									</tr>
									<tr>
										<td width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_gia"]?>:</td>
										<td style="border:1px solid #c4c4c4;color:#FE0002"><?=$price?></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px; border:1px solid #c4c4c4;" class="itemname"><?=$define["var_hoten"]?> : </td>
										<td style="border:1px solid #c4c4c4;color:#FE0002 "><?=$nname?></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_diachi"]?> :</td>
										<td style="border:1px solid #c4c4c4;color:#FE0002"><?=$add?></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_dienthoai"]?>: </td>
										<td style="border:1px solid #c4c4c4;color:#FE0002"><?=$tel?></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_dienthoaiban"]?>: </td>
										<td style="border:1px solid #c4c4c4;color:#FE0002 "><?=$teltable?></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_email"]?>: </td>
										<td style="border:1px solid #c4c4c4;color:#FE0002 "><?=$email?></td>
									</tr>
									<tr>
										<td align="right" width="20%" style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_noidungyeucau"]?> : </td>
										<td style="border:1px solid #c4c4c4;color:#FE0002 "><?=$detail?></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" class="itemname"><?=$thongbaothanhcong?></td>
							</tr>
						</table>
<?
}else
{
?>						<div class="itemName" style="padding:5px 4px 5px 4px;"><?=$contentDetail?></div>
						<div id="myContactForm" style="text-align:center">
							<form name="frmContact" action="<?=$_URL_BASE?>/index.php/order" method="post" onSubmit="return doContactSubmit()">
								<input type="hidden" name="itemId" value="<?=$itemId?>" />
								<table width="90%" align="center" cellpadding="3" cellspacing="0" border="0">
									<tr>
										<td width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_sanphamchonmua"]?>:</td>
										<td style="border:1px solid #c4c4c4; font-weight:bold" class="itemname"><?=$product?></td>
									</tr>
									<tr>
										<td width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_gia"]?>:</td>
										<td style="border:1px solid #c4c4c4; font-weight:bold" class="itemname"><?=$price?>VN&#272;</td>
									</tr>
									<tr>
										<td width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname" colspan="2" ><?=$define["var_bogotiengviet"]?>:
												<span style="padding-left:25px">B&#7853;t<input type="radio" name="typeMode"  onClick="setTypingMode(1)">
												&nbsp;&nbsp;T&#7855;t<input type="radio" name="typeMode"  onClick="setTypingMode()" checked>
												</span>
										</td>
									</tr>			
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px; border:1px solid #c4c4c4;" class="itemname"><?=$define["var_hoten"]?> :* </td>
										<td style="border:1px solid #c4c4c4; "><input name="nname" maxlength="100" class="textbox" value="<?=$nname?>" style="width:220px; height:18px" onKeyUp="telexingVietUC(this)"></td>
									</tr>
									
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_diachi"]?> :*</td>
										<td style="border:1px solid #c4c4c4;"><input name="add" maxlength="255" class="textbox" value="<?=$add?>" style="width:220px; height:18px" onKeyUp="telexingVietUC(this)"></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_tinhthanh"]?> : </td>
										<td style="border:1px solid #c4c4c4;">
											<select name="fax" style="overflow:auto; width:220;" class="textbox" size="1">
																			<option value="An Giang" value="<?=$imgnote?>" selected="selected">An Giang</option>
																			<option value="B&#7855;c Giang" >B&#7855;c Giang</option>
																			<option value="B&#7855;c K&#7841;n">B&#7855;c K&#7841;n</option>
																			<option value="B&#7841;c Li&#234;u">B&#7841;c Li&#234;u</option>
																			<option value="B&#7855;c Ninh">B&#7855;c Ninh</option>
																			<option value="B&#224; R&#7883;a-V&#361;ng t&#224;u">B&#224; R&#7883;a-V&#361;ng t&#224;u</option>
																			<option value="B&#7871;n Tre">B&#7871;n Tre</option>
																			<option value="B&#236;nh &#272;&#7883;nh">B&#236;nh &#272;&#7883;nh</option>
																			<option value="B&#236;nh D&#432;&#417;ng">B&#236;nh D&#432;&#417;ng</option>
																			<option value="B&#236;nh Ph&#432;&#7899;c">B&#236;nh Ph&#432;&#7899;c</option>
																			<option value="B&#236;nh Thu&#7853;n">B&#236;nh Thu&#7853;n</option>
																			<option value="C&#224; Mau">C&#224; Mau</option>
																			<option value="C&#7847;n Th&#417;">C&#7847;n Th&#417;</option>
																			<option value="Cao B&#7857;ng">Cao B&#7857;ng</option>
																			<option value="&#272;k L&#259;k">&#272;&#259;k L&#259;k</option>
																			<option value="&#272;&#259;k N&#244;ng">&#272;&#259;k N&#244;ng</option>
																			<option value="&#272;&#224; N&#7861;ng">&#272;&#224; N&#7861;ng</option>
																			<option value="&#272;i&#7879;n Bi&#234;n">&#272;i&#7879;n Bi&#234;n</option>
																			<option value="&#272;&#7891;n Nai">&#272;&#7891;n Nai</option>
																			<option value="&#272;&#7891;ng Th&#225;p">&#272;&#7891;ng Th&#225;p</option>
																			<option value="Gia lai">Gia lai</option>
																			<option value="H&#224; Giang">H&#224; Giang</option>
																			<option value="H&#7843;i D&#432;&#417;ng">H&#7843;i D&#432;&#417;ng</option>
																			<option value="H&#7843;i Ph&#242;ng">H&#7843;i Ph&#242;ng</option>
																			<option value="H&#224; Nam">H&#224; Nam</option>
																			<option value="H&#224; N&#7897;i">H&#224; N&#7897;i</option>
																			<option value="H&#224; T&#297;nh">H&#224; T&#297;nh</option>
																			<option value="Ho&#224; B&#236;nh">Ho&#224; B&#236;nh</option>
																			<option value="TP.HCM">TP.HCM</option>
																			<option value="H&#7853;u Giang">H&#7853;u Giang</option>
																			<option value="H&#432;ng Y&#234;n">H&#432;ng Y&#234;n</option>
																			<option value="kh&#225;nh Ho&#224;">kh&#225;nh Ho&#224;</option>
																			<option value="Ki&#234;n Giang">Ki&#234;n Giang</option>
																			<option value="Kon Tum">Kon Tum</option>
																			<option value="Lai Châu">Lai CH&#226;u</option>
																			<option value="L&#226;m &#272;&#7891;ng">L&#226;m &#272;&#7891;ng</option>
																			<option value="L&#7841;ng S&#417;n">L&#7841;ng S&#417;n</option>
																			<option value="L&#224;o Cai">L&#224;o Cai</option>
																			<option value="Long An">Long An</option>
																			<option value="Nam &#272;&#7883;nh">Nam &#272;&#7883;nh</option>
																			<option value="Ngh&#7879; An">Ngh&#7879; An</option>
																			<option value="Binh B&#236;nh">Binh B&#236;nh</option>
																			<option value="Ninh Thu&#7853;n">Ninh Thu&#7853;n</option>
																			<option value="Ph&#250; Th&#7885;">Ph&#250; Th&#7885;</option>
																			<option value="Ph&#250; Y&#234;n">Ph&#250; Y&#234;n</option>
																			<option value="Qu&#7843;ng B&#236;nh">Qu&#7843;ng B&#236;nh</option>
																			<option value="Qu&#7843;ng Nam">Qu&#7843;ng Nam</option>
																			<option value="Qu&#7843;ng Ng&#227;i">Qu&#7843;ng Ng&#227;i</option>
																			<option value="Qu&#7843;ng Ninh">Qu&#7843;ng Ninh</option>
																			<option value="Qu&#7843;ng Tr&#7883;">Qu&#7843;ng Tr&#7883;</option>
																			<option value="S&#243;c Tr&#259;ng">S&#243;c Tr&#259;ng</option>
																			<option value="S&#417;n La">S&#417;n La</option>
																			<option value="T&#226;y Ninh">T&#226;y Ninh</option>
																			<option value="Th&#225;i B&#236;nh">Th&#225;i B&#236;nh</option>
																			<option value="Th&#225;i Nguy&#234;n">Th&#225;i Nguy&#234;n</option>
																			<option value="Thanh Ho&#225;">Thanh Ho&#225;</option>
																			<option value="Th&#7915;a Thi&#234;n-Hu&#7871;">Th&#7915;a Thi&#234;n-Hu&#7871; </option>
																			<option value="Ti&#7873;n Giang">Ti&#7873;n Giang</option>
																			<option value="Tr&#224; Vinh">Tr&#224; Vinh</option>
																			<option value="Tuy&#234;n Quang">Tuy&#234;n Quang</option>
																			<option value="V&#297;nh Long">V&#297;nh Long</option>
																			<option value="V&#297;nh ph&#250;c">V&#297;nh ph&#250;c</option>
																			<option value="Y&#234;n B&#225;i">Y&#234;n B&#225;i</option>
																		</select>
																</td>		
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_dienthoai"]?> :* </td>
										<td style="border:1px solid #c4c4c4; "><input name="tel" maxlength="20" class="textbox" value="<?=$tel?>" style="width:220px; height:18px" onKeyUp="telexingVietUC(this)"></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_dienthoaiban"]?>: </td>
										<td style="border:1px solid #c4c4c4; "><input name="teltable" maxlength="20" class="textbox" value="<?=$teltable?>" style="width:220px; height:18px" onKeyUp="telexingVietUC(this)"></td>
									</tr>
									<tr>
										<td align="right" width="20%" nowrap style="font-size:11px;border:1px solid #c4c4c4;" class="itemname"><?=$define["var_email"]?>: </td>
										<td style="border:1px solid #c4c4c4; "><input name="email" maxlength="50" class="textbox" value="<?=$email?>" style="width:220px; height:18px" onKeyUp="telexingVietUC(this)"></td>
									</tr>
									
									
									<tr>
										<td colspan="2" style="border:1px solid #c4c4c4;">
											<table width="100%" cellpadding="0" cellspacing="0" border="0">
												<tr>
													<td align="right" width="28%" nowrap valign="top" style="font-size:11px; padding:5px 0px 15px 0px" class="itemname"><?=$define["var_noidungyeucau"]?> : </td>
													<td ><textarea name="detail" rows="7" class="textBox" style="width:220px" onKeyUp="telexingVietUC(this)"><?=$detail?></textarea></td>
												</tr>

												<tr>
													<td width="20%">&nbsp;</td>
													<td nowrap style="padding-top:10px">
														<button type="submit" name="sbmt"><?=$define["var_datmua"]?></button> &nbsp;&nbsp;
														<button type="reset" name="rest"><?=$define["var_nhaplai"]?></button>
													</td>
												</tr>
												<tr>
													<td height="14"></td>
												</tr>
											</table>
										</td>
									 </tr>		
								</table>
								<input type="hidden" name="doAction" value="send">
							</form>
						</div>
						<div class="itemName" style="padding:5px 15px 5px 10px;"><?=$contentOrder?></div>
					<?
					}
					?>	
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
			<td valign="top"><img src="<?=$_IMG_DIR?>/pagetitle_2.gif" border="0" /></td>
		</tr>
</table>
