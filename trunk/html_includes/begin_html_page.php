<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<html>
<head>
	<title><?=$siteTitle?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>" />
	<meta name="keywords" content="<?=$config["site_keywords"]?>" />
	<meta name="description" content="<?=$config["site_description"]?>" />
	<meta name="robots" content="all" />
	<meta name="googlebot" content="all" />
	<meta name="verify-v1" content="6jXfqc0uvQlepRo0Z64q9RH+6hudHAGXxXsh6TNv+Qs=" />
	<link rel="shortcut icon" href="images/vot_icon.ico" type="image/x-icon" />
	<script type="text/javascript">	  var _gaq = _gaq || [];	  _gaq.push(['_setAccount', 'UA-21744966-1']);	  _gaq.push(['_trackPageview']);	  (function() {		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);	  })();	</script>
</head>
<style type="text/css">@import url("<?=$_CSS_DIR?>/style.css");</style>
<style type="text/css">@import url("<?=$_CSS_DIR?>/modalbox.css");</style>

<script language="javascript" src="<?=$_JS_DIR?>/AjaxRequest.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/functions.js"></script>


<script language="JavaScript" src="<?=$_JS_DIR?>/milonic/milonic_src.js" type="text/javascript"></script>
<script language="JavaScript" src="<?=$_JS_DIR?>/milonic/mmenudom.js" type="text/javascript"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/prototype.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/scriptaculous.js"></script>
<script language="javascript" src="<?=$_JS_DIR?>/modalbox/modalbox.js"></script>
<script language="javascript 1.2" src="<?=$_JS_DIR?>/scroller.js" type="text/javascript"></script>
<script language="javascript" src="<?=$_JS_DIR?>/vietuni.js"></script>

<!-- New include TNC -->


        <link rel="stylesheet" type="text/css" href="<?=$_CSS_DIR?>/font.css" />
        <link rel="stylesheet" type="text/css" href="<?=$_CSS_DIR?>/style-new.css" />

        <script type="text/javascript" language="javascript" src="<?=$_JS_DIR?>/jquery-1.6.1.min.js"></script>
        <script type="text/javascript" language="javascript" src="<?=$_JS_DIR?>/javascript.js"></script>

        <!--js bộ gõ-->
        <script type="text/javascript" language="javascript" src="<?=$_JS_DIR?>/mudim-0.8-r153.js"></script>

        <!--js các liên kết facebook-->
        <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
        <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e08b4ee6fe1df93"></script>
        
  <!-- End add new  -->      

<script language="javascript">
var _url_base = '<?=$_URL_BASE?>';
var _img_dir = '<?=$_IMG_DIR?>';
//var leftMenuLink = '<?=$_URL_BASE?>/html_includes/menuleft.php';
var totalVisitors = '<?=$totalVisitors?>';
var keywordDefult = '<?=$define["var_nhaptukhoa"]?>';
var curTxtBoxObjVal = '';
var lm_scroller_directions = {'U':'9002', 'D':'9001', 'R':'9003', 'L':'9004'};
function doSubmitsearchForm1()
{
	var myFrm = document.searchForm1;
	var keyWordVal = myFrm.searchKeyword.value;
	if(keyWordVal == '' || keyWordVal == keywordDefult)
	{
		alert('Ban vui long nhap tu khoa can tim!');
		myFrm.searchKeyword.focus();
		return false;
	}
 }
</script>


<body>