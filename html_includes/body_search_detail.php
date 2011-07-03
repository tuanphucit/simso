<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
function checkSugSubmit()
{
	var myFrm = document.suggestionFrm;
	if(myFrm.yourName.value == '')
	{
		alert('<?=$define["var_vuilongnhaphoten"]?>');
		myFrm.yourName.focus();
		return false;
	}
	if(!isEmail(myFrm.yourEmail.value))
	{
		alert('<?=$define["var_vuilongkiemtralaimail"]?>');
		myFrm.yourEmail.focus();
		return false;
	}
	return true;
}
function doSugFrmSubmit()
{
	if(checkSugSubmit())
	{
		AjaxRequest.Submit(
			suggestionFrm, {'onSuccess': function(req)
			{
				getObjectById('customerSuggestion').innerHTML = req.responseText;
			},'onError': function(req){}
		});
	}
	return false;
}
</script>
<script language="JavaScript" src="<?=$_JS_DIR?>/milonic/menu_style.js" type="text/javascript"></script>
<table width="990" align="center" cellpadding="0" cellspacing="0" border="0">
  <tr>
  		<td valign="top" colspan="3"><? if(is_file("$_HTML_DIR/top.php")) require_once("$_HTML_DIR/top.php")?></td>
  </tr>
  <tr>
		<td height="35" width="990" background="<?=$_IMG_DIR?>/Background_topmenu.jpg" style="background-repeat:repeat-x" valign="top" colspan="3">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" background="<?=$_IMG_DIR?>/Background_topmenu.jpg" >
				  <tr>
						<td valign="top" width="990" style="background-image:url(<?=$_IMG_DIR?>/Background_topmenu.jpg); background-repeat:repeat-x; height:35px" align="left">
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td valign="top"><? include_once("$_HTML_DIR/menubar_$lang.htm")?></td>
									<td valign="top" width="360" align="right">
										<table width="100%" cellpadding="0" cellspacing="0" align="right" border="0">
											<form name="searchForm" method="post" onSubmit="return doQuickSearch()" action="<?=$_URL_BASE?>/tim_kiem/">
											   <tr>
													<td style="color:#FFFFFF;padding-top:8px"><?=$define["var_timkiem"]?>:
													
														<input type="text" name="KWD" style="border:1px solid #7F9DB9; height:18px;color:#999999;width:150px;padding-left:4px; font-size:10px;font-family:tahoma" value="<?=$define["var_nhaptukhoa"]?>" onblur="if(this.value=='')this.value='<?=$define["var_nhaptukhoa"]?>';" onfocus="if(this.value=='<?=$define["var_nhaptukhoa"]?>')this.value='';">
														<? if($lang==1)
															{
														?>
														<input type="image" src="<?=$_IMG_DIR?>/go.jpg" title="<?=$define["var_tim"]?>" align="absmiddle">
														<?
														}else
														{
														?>
														<input type="image" src="<?=$_IMG_DIR?>/go_en.jpg" title="<?=$define["var_tim"]?>" align="absmiddle">
														<?
														}
														?>
													
													<span style="color:#FFFFFF;padding-top:8px; padding-left:2px;font-family:tahoma; font-size:11px; text-align:left"><a style="color:#FFFFFF; text-decoration:underline" href="#"><?=$define["var_timkiemnangcao"]?></a></span></td>
												</tr>	
											</form>
										</table>						
								   </td>
								</tr>
							</table>
						</td>			
					</tr>		
			</table>		
		</td>
  </tr>
  <tr>
  	<td colspan="3" height="8" valign="top"></td>
  </tr>
  <tr>
	  <td width="217" valign="top" ><? require_once("$_HTML_DIR/left_page.php")?></td>
	  <td width="578" valign="top" align="center">
			<table border="0" cellspacing="0" cellpadding="0" width="92%" valign="top">
				<tr>
					<td align="center"><? require_once("$_HTML_DIR/showbanner.php")?></td>
				</tr>
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td style="background-image:url(<?=$_IMG_DIR?>/page_title.jpg);height:23px; color:#006404; font-family:tahoma; font-weight:bold; font-size:12px; background-repeat:no-repeat; font-family:tahoma; font-size:12px; padding-left:5px; padding-bottom:5px"><?=$define["var_dangduyet"]?>:<span style="font-weight:bold; padding-left:2px"><?=$subPageTitle?></td>
					
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td style="color:#cd311a; font-size:14px; font-weight:bold"><?=$contentTitle?></td>
				</tr>
				<tr>
					<td id="centerContent" class="itemname" valign="top"><?=$contentDetail?></td>
				</tr>
				<tr>
					<td align="right" style="padding-right:0px;font-size:11px" nowrap><?=$define["var_luotdoc"]?>: <b><?=$visited?></b> - <?=$define["var_capnhat"]?>: <b><?=$contentDate?></b></td>
				</tr>
				<tr>
					<td align="right" height="30"><? require_once("$_HTML_DIR/buttons.php")?></td>
				</tr>
				<tr>
					<td style="">
						<div id="customerSuggestion">&nbsp;</div>
					</td>
				</tr>
				<tr>
					<td style="listOthers">
						<div id="otherItems">&nbsp;</div>
					</td>
				</tr>
			</table>
		</td>
</td>
	 <td width="195" valign="top" ><? require_once("$_HTML_DIR/right_page.php")?></td>
  </tr>
  <tr>
	<td colspan="3"  height="8"></td>
  </tr>
  <tr>
	<td align="center" colspan="3"><? require_once("$_HTML_DIR/footer_page.php")?></td>
  </tr>
</table>
<script language="javascript">
if(customerSuggestion)
{
	var cusSugLink = '<?=$_URL_BASE?>/includes/suggestion.php?itemId=<?=$itemId?>';
	showPageContent(cusSugLink, 'customerSuggestion');
}
</script>