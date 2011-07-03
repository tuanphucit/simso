<script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/tooltip-generic.css"/>
<script> 
// execute your scripts when the DOM is ready. this is a good habit
$(function() {
 
// select all desired input fields and attach tooltips to them
	$("#searchKeyword").tooltip({
	 
		// place tooltip on the right edge
		position: "center right",
	 
		// a little tweaking of the position
		offset: [-2, 10],
	 
		// use the built-in fadeIn/fadeOut effect
		effect: "fade",
	 
		// custom opacity setting
		opacity: 0.7
	 
	});
});
</script>

<?if(!$_PAGE_VALID){	exit();}?><table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">	<form name="searchForm" method="post" onSubmit="return doSubmitsearchForm()" action="<?=$_URL_BASE?>/index.php/timkiem">	   <tr>	   	<td class="subPageTitle" colspan="3"><?=$define["var_timnhanh"]?></td>	   </tr>	   <tr>	   	<td valign="top" style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y">			<table width="100%" cellspacing="0" cellpadding="0" border="0">			  <tr>			  	<td height="10px"></td>			  </tr>			   <tr>					<td width="100" style="color:#fe0002;padding:5px;font-family:tahoma; text-align:center;font-size:11px; font-weight:bold"><?=$define["var_timkiem"]?> :</td>					<td><span style="background-image:url(<?=$_IMG_DIR?>/input_center.jpg); background-repeat:repeat-x"><img src="<?=$_IMG_DIR?>/input_left.jpg" align="absmiddle" /></span><span style="background-image:url(<?=$_IMG_DIR?>/input_center.jpg); background-repeat:repeat-x">
<input type="text" id="searchKeyword" name="searchKeyword" title=" Muốn tìm <b>đuôi 686</b>, bạn gõ <b>*686</b>. <br/> 
            Muốn tìm đầu <b>098</b> đuôi <b>686</b>, bạn gõ <b>098*686</b>." style="border:1px solid #ffffff; border-top:1px solid #e0e0e0;background-image:url(<?=$_IMG_DIR?>/input_center.jpg); background-repeat:repeat-x;padding-top:3px;height:19px;color:#000000;width:215px;padding-left:4px; font-size:11px;font-family:tahoma" value="<?=$define["var_nhaptukhoa"]?>" onblur="if(this.value=='')this.value='<?=$define["var_nhaptukhoa"]?>';" onfocus="if(this.value=='<?=$define["var_nhaptukhoa"]?>')this.value='';"><img src="<?=$_IMG_DIR?>/input_right.jpg" align="absmiddle" /></td>					<td style="padding-right:35px"><input type="image" src="<?=$_IMG_DIR?>/go.jpg" title="<?=$define["var_tim"]?>" align="absmiddle"></td>				</tr>				<tr>					<td></td>					<td colspan="2"><img src="<?=$_IMG_DIR?>/bong_input.gif" border="0" /></td>				</tr>						<!--				luckymancvp				<tr>					<td colspan="3" align="center">						<select name="chonmang" style="padding-top:3px;height:22px;color:#000000;width:130px;padding-left:4px; font-size:11px;font-family:tahoma"><option value=""><?=$define["var_chonmangdt"]?></option><?=searchadvanced($cateId)?></select>&nbsp;						&nbsp;						<input type="text" name="price" style="width:100" />&nbsp;&nbsp;						<select name="chuoi" style="padding-top:3px;height:22px;color:#000000;width:130px;padding-left:4px; font-size:11px;font-family:tahoma">							<option value="chuoibatky"><?=$define["var_chuoibatky"]?></option>							<option value="chuoidau"><?=$define["var_chuoidau"]?></option>							<option value="chuoicuoi"><?=$define["var_chuoicuoi"]?></option>						</select>					</td>					</tr>			--></table>		  </td>			</tr>  		<tr>			<td valign="top"><img src="<?=$_IMG_DIR?>/pagetitle_2.gif" border="0" /></td>		</tr>	</form></table>


