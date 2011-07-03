<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/prototype.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/scriptaculous.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/modalbox.js"></script>
<style type="text/css">@import url("<?=$_CSS_DIR?>/modalbox.css");</style>
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
	<tr>
		<td align="right" height="40" style="padding-right:0px" nowrap style="font-size:11px">
			<a href="javascript:history.back(1)">
				<img src="<?=$_IMG_DIR?>/back.gif" width="14" height="12" border="0" alt="<?=$define['var_vetrangtruoc']?>"> <?=$define['var_vetrangtruoc']?>
			</a>&nbsp;&nbsp;
			<a href="javascript:addToFavorite()">
				<img src="<?=$_IMG_DIR?>/icon_favorites.png" width="14" height="12" border="0" alt="<?=$define['var_themvaofavorites']?>"> <?=$define['var_themvaofavorites']?>
			</a>&nbsp;&nbsp;
			<a href="<?=$_URL_BASE?>/print/?id=<?=$itemId?>" title="<?=$define['var_inbantin']?>" onClick="openBox(this.href, 750, 530, 'yes'); return false;">
				<img src="<?=$_IMG_DIR?>/icon_printer.png" width="14" height="12" border="0" alt="<?=$define['var_inbantin']?>"> <?=$define['var_inbantin']?>
			</a>&nbsp;&nbsp;
			<a id="sendTo" href="<?=$_URL_BASE?>/sendto/" title="<?=$define['var_guichobanbe']?>" onClick="Modalbox.show(this.href, {title: this.title, width: 500, height: 300,overlayClose: false}); return false;">
				<img src="<?=$_IMG_DIR?>/icon_sendto.png" width="14" height="12" border="0" alt="<?=$define['var_guichobanbe']?>" align="absbottom"> <?=$define['var_guichobanbe']?>
			</a>&nbsp;&nbsp;
			<a id="sendTo" href="#" title="<?=$define['var_vedautrang']?>">
				<img src="<?=$_IMG_DIR?>/to_top.gif" width="14" height="12" border="0" alt="<?=$define['var_vedautrang']?>"> <?=$define['var_vedautrang']?>
			</a>
		</td>
	</tr>
</table>
<script language="javascript">
getObjectById("sendTo").href += "?infoUrl="+location.href;
</script>