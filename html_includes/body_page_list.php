<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="JavaScript" src="<?=$_JS_DIR?>/milonic/menu_style.js" type="text/javascript"></script>
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top" align="center">
			<table width="861" align="center" cellpadding="0" cellspacing="0" border="0">
			  <tr>
					<td valign="top"><? if(is_file("$_HTML_DIR/top.php")) require_once("$_HTML_DIR/top.php")?></td>
			  </tr>
			   <tr>
					<td valign="top" align="center" bgcolor="#FFFFFF">
						<table width="98%" border="0" cellspacing="0" cellpadding="0" >
							  <tr>
									<td valign="top" width="11px"><img src="<?=$_IMG_DIR?>/head_left.jpg" border="0" /></td>
									<td style="background-image:url(<?=$_IMG_DIR?>/head_bg.jpg); background-repeat:repeat-x; height:49px">
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td style="text-align:center;padding:10px;" colspan="2" align="center"><? require_once("$_HTML_DIR/lienketweb.php")?></td>
												<td style="font-size:12px; text-transform:uppercase; font-weight:bold; font-family:tahoma"><?=$define["var_thugopy"]?><img src="<?=$_IMG_DIR?>/email.jpg" align="absmiddle" border="0" style="margin:0px 5px 0px 10px"/></td>
												<td style="text-align:center;padding:17px 10px 0px 0px;"><form name="searchForm1" method="post" onSubmit="return doSubmitsearchForm1()" action="<?=$_URL_BASE?>/tim_kiem"><span style="font-size:12px; text-transform:uppercase; font-weight:bold; font-family:tahoma; padding-right:10px"><?=$define["var_timkiem"]?></span><input type="text" name="searchKeyword" style="border:1px solid #809dbb;padding-top:3px;height:20px;color:#000000;width:130px;padding-left:4px; font-size:11px;font-family:tahoma" value="<?=$define["var_nhaptukhoa"]?>" onblur="if(this.value=='')this.value='<?=$define["var_nhaptukhoa"]?>';" onfocus="if(this.value=='<?=$define["var_nhaptukhoa"]?>')this.value='';">&nbsp;<input type="image" src="<?=$_IMG_DIR?>/timkiem.jpg" title="<?=$define["var_tim"]?>" align="absmiddle"></form></td>
											</tr>
										</table>
									 </td>
									<td valign="top" width="10px"><img src="<?=$_IMG_DIR?>/head_right.jpg" border="0" /></td>			
								</tr>
						</table>		
					</td>
			  </tr>
			  <tr>
				 <td valign="top" style="padding:5px 0px 5px 0px" align="center" bgcolor="#FFFFFF">
					<table width="855px" cellpadding="0" cellspacing="0" border="0" align="center">
					  <tr>
						  <td width="187" valign="top" bgcolor="#FFFFFF"><? require_once("$_HTML_DIR/left_page.php")?></td>
						  <td width="481" valign="top" align="right" bgcolor="#FFFFFF">
								<table border="0" cellspacing="0" cellpadding="0" width="98%" valign="top">
									<tr>
										<td valign="top"><? require_once("$_HTML_DIR/timkiem.php");?></td>
									</tr>
									<tr>
										<td valign="top" style="padding:6px 0px 6px 0px"><? require_once("$_HTML_DIR/timnhanh.php");?></td>
									</tr>
									<tr>
										<td valign="top">
												<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td height="26px;" class="subPageTitle" ><?=$subPageTitle?></td>
													</tr>
													<tr>
														<td style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y; padding-left:1px ">
															<table width="98%" cellpadding="0" cellspacing="0">
																<tr>
																	<td valign="top"><?=$contentDetail?></td>
																</tr>
																<tr height="37">
																	<td width="100%" style="padding:0px 35px 10px 10px"><?=paging($tRows,$curPg,$maxRows,$curURL)?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td valign="top"><img src="<?=$_IMG_DIR?>/pagetitle_2.gif" border="0" /></td>
													</tr>
												</table>
											</td>
									</tr>	
							   </table>
						 </td>
						 <td width="187" valign="top" bgcolor="#FFFFFF"><? require_once("$_HTML_DIR/right_page.php")?></td>
					  </tr>
					 </table>
					</td>  
			  <tr>
				<td height="4" bgcolor="#FFFFFF"></td>
			  </tr>
		</table> 
	</td>
  </tr>
  <tr>
  		<td valign="top" style="background-image:url(<?=$_IMG_DIR?>/bg_footer.gif); background-repeat:repeat-x" align="center">
			<table width="861" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td align="center" bgcolor="#FFFFFF"><?=$opt->optionvalue("vot_html", "html_detail", "language_id = $lang AND html_id = 'online'")?></td>
				  </tr>
				  <tr>
				  	<td valign="top" align="center" style="background-image:url(<?=$_IMG_DIR?>/footer.gif); height:135px; background-repeat:no-repeat; padding-top:16px"><? if(is_file("$_HTML_DIR/menufooter_$lang.htm")) include_once("$_HTML_DIR/menufooter_$lang.htm")?></td>
				  </tr>
				  <tr>
					<td align="center" style="background-image:url(<?=$_IMG_DIR?>/page_footer.gif); height:64px; background-repeat:no-repeat;"><? require_once("$_HTML_DIR/footer_page.php")?></td>
				  </tr>
			</table>
		</td>
   </tr>				   
</table>
