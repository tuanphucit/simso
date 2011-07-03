<?
session_cache_expire(480);
session_start();
?>
<script language="javascript">
/*function showCurGallery(sLink)
{
	AjaxRequest.get(
	{
		'url':sLink,
		'onSuccess': function(req)
		{
			getObjectById('curGallery').innerHTML = req.responseText;
		},
		'onError': function(req){}
	});
}
function showCurPhoto(sLink)
{
	AjaxRequest.get(
	{
		'url':sLink,
		'onSuccess': function(req)
		{
			getObjectById('curPhoto').innerHTML = req.responseText;
		},
		'onError': function(req){}
	});
}*/
function showTopInformation(sLink)
{
	AjaxRequest.get(
	{
		'url':sLink,
		'onSuccess': function(req)
		{
			getObjectById('topInformation').innerHTML = req.responseText;
		},
		'onError': function(req){}
	});
}
function showCurProductInfo(sLink)
{
	AjaxRequest.get(
	{
		'url':sLink,
		'onSuccess': function(req)
		{
			getObjectById('curProductInfo').innerHTML = req.responseText;
			changeTabStatus('proInfoTab', 'tabContentInfo');
		},
		'onError': function(req){}
	});
}

var oldTabId = null;
var oldTabConId = null;
function changeTabStatus(tabId, tabConId)
{
	if(typeof(tabId) != 'object')
	{
		curTabId = getObjectById(tabId);
	}
	else
	{
		curTabId = tabId;
	}
	if(curTabId != oldTabId)
	{
		if(oldTabId != null)
		{
			oldTabId.className = 'proTabInactive';
			getObjectById(oldTabConId).style.display = 'none';
		}
		curTabId.className = 'proTabActive';
		getObjectById(tabConId).style.display = '';
	}
	oldTabId = curTabId;
	oldTabConId = tabConId;
}
</script>
<style>
.viewAll
{
	color: #464949;
	font-size: 11px;
}
.viewAll a
{
	color: #464949;
	text-decoration: none;
}
.tabEmpty
{
	border-bottom: 1px solid #014B08;
}
.proTabActive
{
	color: #fe0240;
	font-size: 11px;
	border-left: 1px solid #014B08;
	border-right: 1px solid #014B08;
	white-space: nowrap;
	/*padding-left: 10px;
	padding-right: 10px;*/
	cursor: default;
	text-align: center;
	background-color: #e4e4e4;
}
.proTabInactive
{
	color: #646464;
	font-family:tahoma;
	font-size: 11px;
	border-left: 1px solid #014B08;
	border-right: 1px solid #014B08;
	white-space: nowrap;
	/*padding-left: 10px;
	padding-right: 10px;
	/*padding-top: 4px;*/
	cursor: pointer;
	text-align: center;
	background-image:url(../images/proTabInactive.jpg);
	background-repeat:repeat-x;
}
.tabActive
{
	color: #FFFFFF;
	font-family:tahoma;
	font-size:11px;
	font-weight:bold;
	height:25px;
	white-space: nowrap;
	/*padding-left: 10px;
	padding-right: 10px;*/
	text-align: center;
	/*background-color: #e4e4e4;*/
}
.tabInactive
{
	color: #FFFFFF;
	font-weight:bold;
	height:25px;
	white-space: nowrap;
	/*padding-left: 10px;
	padding-right: 10px;*/
	/*padding-top: 4px;*/
	text-align: center;
	background-image:url(../images/proTabInactive.jpg);
	background-repeat:repeat-x;
}
.tabInactive a
{
	color: #FFFFFF;
	text-decoration: none;
}
.homeBlockTitle
{
	text-align:center;
	font-size: 12px;
	color: #ff7e00;
	padding-top: 1px;
	padding-bottom: 2px;
}
</style>
<head>
	<title>dfdf</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="keywords" content="<?=$config["site_keywords"]?>" />
	<meta name="description" content="<?=$config["site_description"]?>" />
</head>
		<div id="topInformation"></div>
<script language="javascript">
/*var curGal = '<?//=$curGallery?>';
showCurGallery(curGal);
var curPro = '<?//=$curProduct?>';
showCurProductInfo(curPro);*/
sLink = '<?=$_URL_BASE?>/html_includes/topcontent.php';
showTopInformation(sLink);
</script>
