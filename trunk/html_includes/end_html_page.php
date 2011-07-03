<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
var contentTitle = '<?=insertData($contentTitle)?>';
if(contentTitle != '')
{
	var siteTitle = contentTitle;
	documentTitle(siteTitle);
}

function changePage()
{
	var pForm = document.frmPaging;
	var page = pForm.listPageSels.value;
	var linkto = location.href;
	if(linkto.indexOf('?') > 0)
	{
		linkto  = linkto.substr(0, linkto.indexOf('?'));
	}
	linkto += '?curPg=' + page;
	pForm.action = linkto;
	pForm.submit();
}
if (/MSIE [56].*Windows/.test(navigator.userAgent)) (function() {
	// fucked-up browser (Internet Explorer for Windows)
	var blank = new Image;
	blank.src = _img_dir.concat('/blank.gif');
	var imgs = document.getElementsByTagName("img");
	for (var i = imgs.length; --i >= 0;) {
		var img = imgs[i];
		var src = img.src;
		if (!/\.png$/.test(src))
			continue;
		var s = img.runtimeStyle;
		s.width = img.offsetWidth + "px";
		s.height = img.offsetHeight + "px";
		s.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "',sizingMethod='scale')";
		img.src = blank.src;
	}
})();

</script>
</body>
</html>