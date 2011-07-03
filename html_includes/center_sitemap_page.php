<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
 <!-- Infrastructure code for the TreeView. DO NOT REMOVE.   -->
<script src="<?=$_JS_DIR?>/TreeView/ua.js"></script>
 <!-- Scripts that define the tree. DO NOT REMOVE.           -->
<script src="<?=$_JS_DIR?>/TreeView/ftiens4.js"></script>
<script language="javascript">
	USETEXTLINKS = 1;  
	STARTALLOPEN = 1;
	HIGHLIGHT = 1;
	PRESERVESTATE = 1;
	GLOBALTARGET="R";
</script>
<?
echo $contentDetail;
//require_once("$_HTML_DIR/sitemap_1.htm");
?>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" valign="top">
			<table width="92%" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7"></td>
				</tr>
				<tr>
					<td style="background-image:url(<?=$_IMG_DIR?>/page_title.jpg);height:23px; color:#006404; font-family:tahoma; font-weight:bold; font-size:12px; background-repeat:no-repeat; font-family:tahoma; font-size:12px; padding-left:5px; padding-bottom:5px"><?=$define["var_dangduyet"]?>:<span style="font-weight:bold; padding-left:2px"><?=$subPageTitle?></td>
				</tr>
				<tr>
					<td height="3"></td>
				</tr>
				<tr>
					<td class="centerContent" valign="top" style="padding-left:40px">
						<div style="display:none">
							<table border="0">
								<tr>
									<td><font size="-2"><a style="font-size:7pt;text-decoration:none;color:silver;" href="http://www.treemenu.net/" target="_blank">JavaScript Tree Menu</a></font></td>
								</tr>
							</table>
						</div>
						<div style="padding:15px 10px 10px 20px">
							<script language="javascript">initializeDocument()</script>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
</table>
