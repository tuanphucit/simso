<div id="HEADPAGE">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<tr>
		<td colspan="2" class="modulehead"><img src="images/config_002.png" align="left"><?=def_cauhinh?></td>
	</tr>
	<tr>
		<td class="headlink" nowrap valign="bottom"><a href="index.php?module=home"><?=def_trangchu?></a> / <?=def_cauhinh?></td>
<?
if($usrperstr == FULL || $usrid==0)
{
?>
	  <td align="right"><?=global_btns(HTML_PAGE)?></td>		
<?
}
?>
	</tr>
</table>
</div>
<div id="MAIN" class="maindiv" style="width: 100%; height: 200px; position: relative">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
	<form action="index.php?module=configs&action=update" method="post" name="frmConfig" style="display:inline">
<?
	if($usrid==0)
	{
?>
  <tr>
    <td valign="top">
			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="adminform">
				<tr>
					<td width="100%" colspan="2" class="headform">Server Configurations</td>
				</tr>
				<tr>
					<td width="32%" class="rowform">Database host: </td>
					<td width="68%" class="rowform"><input name="db_host" type="text" size="35" maxlength="255" value="<?=$config["db_host"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Database user: </td>
					<td class="rowform"><input name="db_user" type="text" size="35" maxlength="100" value="<?=$config["db_user"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Database password:</td>
					<td class="rowform"><input name="db_pwd" type="password" size="35" maxlength="100" value="<?=$config["db_pwd"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Database name:</td>
					<td class="rowform"><input name="db_name" type="text"  size="35" maxlength="100" value="<?=$config["db_name"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Conection error:</td>
					<td class="rowform"><input name="db_error" type="text"  size="35" maxlength="100" value="<?=$config["db_error"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Domain name:</td>
					<td class="rowform"><input name="domain" type="text" size="35" maxlength="100" value="<?=$config["domain"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Root path:</td>
					<td class="rowform"><input name="root_path" type="text"  size="35" maxlength="100" value="<?=$config["root_path"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Script path:</td>
					<td class="rowform"><input name="script_path" type="text"  size="35" maxlength="100" value="<?=$config["script_path"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">FCKeditor path:</td>
					<td class="rowform"><input name="FCKeditor_path" type="text"  size="35" maxlength="100" value="<?=$config["FCKeditor_path"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">Special Admin:</td>
					<td class="rowform"><input name="special_admin" type="password"  size="35" maxlength="100"></td>
					<input type="hidden" name="old_special_admin" value="<?=$config["special_admin"]?>">
				</tr>
			</table>
		</td>
  </tr>
<?
	}
?>
	
  <tr>
    <td valign="top">
			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="adminform">
				<tr>
					<td width="100%" colspan="2" class="headform">C&#7845;u h&igrave;nh Site</th>
				</tr>
				<tr>
					<td width="32%" class="rowform">Title: </td>
					<td width="68%" class="rowform"><textarea name="site_title" cols="50" rows="5"><?=$config["site_title"]?></textarea></td>
				</tr>
				<tr>
					<td class="rowform">Keywords: </td>
					<td class="rowform"><textarea name="site_keywords" cols="50" rows="5"><?=$config["site_keywords"]?></textarea></td>
				</tr>
				<tr>
					<td class="rowform">Description: </td>
					<td class="rowform"><textarea name="site_description" cols="50" rows="5"><?=$config["site_description"]?></textarea></td>
				</tr>
				<tr>
					<td class="rowform">CharSet:</td>
					<td class="rowform"><input name="site_charset" type="text" maxlength="50" value="<?=$config["site_charset"]?>"></td>
				</tr>
				<tr>
				  <td class="rowform">Hi&#7879;n menu d&#7885;c:</td>
				  <td class="rowform"><input name="site_verticalmenu" type="text" value="<?=$config["site_verticalmenu"]?>" size="10" maxlength="2">&nbsp;<font color="#FF0000" style="font-size:9px">(hi&#7879;n nh&#7853;p 1 ng&#432;&#7907;c l&#7841;i 0)</font></td>
				</tr>
				<tr>
				  <td class="rowform">Hi&#7879;n slide &#7843;nh &#7903; trung t&#226;m:</td>
				  <td class="rowform"><input name="site_slide" type="text" value="<?=$config["site_slide"]?>" size="10" maxlength="2">&nbsp;<font color="#FF0000" style="font-size:9px">(hi&#7879;n nh&#7853;p 1 ng&#432;&#7907;c l&#7841;i 0)</font></td>
				</tr>
				<tr>
				  <td class="rowform">Chi&#7873;u r&#7897;ng &#7843;nh Silde:</td>
				  <td class="rowform"><input name="site_widthslide" type="text" value="<?=$config["site_widthslide"]?>" size="10" maxlength="3">&nbsp;<font color="#FF0000" style="font-size:9px">(hi&#7879;n nh&#7853;p 1 ng&#432;&#7907;c l&#7841;i 0)</font></td>
				</tr>
				<tr>
				  <td class="rowform">Chi&#7873;u r&#7897;ng &#7843;nh Silde:</td>
				  <td class="rowform"><input name="site_heightslide" type="text" value="<?=$config["site_heightslide"]?>" size="10" maxlength="3">&nbsp;<font color="#FF0000" style="font-size:9px">(hi&#7879;n nh&#7853;p 1 ng&#432;&#7907;c l&#7841;i 0)</font></td>
				</tr>				
				<tr>
				  <td class="rowform">S&#7889; l&#432;&#7907;ng s&#7843;n ph&#7849;m hi&#7879;n t&#7889;i &#273;a tr&#234;n 1 h&#224;ng:</td>
				  <td class="rowform"><input name="site_Productnum" type="text" value="<?=$config["site_Productnum"]?>" size="10" maxlength="2"></td>
				</tr>

				<tr>
				  <td class="rowform">S&#7889; l&#432;&#7907;ng s&#7843;n ph&#7849;m hi&#7879;n t&#7889;i &#273;a tr&#234;n trang ch&#7911;:</td>
				  <td class="rowform"><input name="site_Productmaxnum" type="text" value="<?=$config["site_Productmaxnum"]?>" size="10" maxlength="2"></td>
				</tr>
				<tr>
				  <td class="rowform">S&#7889; l&#432;&#7907;ng s&#7843;n ph&#7849;m hi&#7879;n t&#7889;i &#273;a  trang trong:</td>
				  <td class="rowform"><input name="site_ProductmaxnumList" type="text" value="<?=$config["site_ProductmaxnumList"]?>" size="10" maxlength="2"></td>
				</tr>
				
				<tr>
				  <td class="rowform">S&#7889; l&#432;&#7907;ng news hi&#7879;n t&#7889;i &#273;a tr&#234;n trang ch&#7911;:</td>
				  <td class="rowform"><input name="site_Newsmaxnum" type="text" value="<?=$config["site_Newsmaxnum"]?>" size="10" maxlength="2"></td>
				</tr>
				<tr>
				  <td class="rowform">S&#7889; l&#432;&#7907;ng news hi&#7879;n t&#7889;i &#273;a tr&#234;n trang trong:</td>
				  <td class="rowform"><input name="site_NewsmaxnumList" type="text" value="<?=$config["site_NewsmaxnumList"]?>" size="10" maxlength="2"></td>
				</tr>
				
				<tr>
				  <td class="rowform">S&#7889; l&#432;&#7907;ng logo QC hi&#7879;n t&#7889;i &#273;a tr&#234;n website</td>
				  <td class="rowform">
						<div style="padding-bottom:5px">B&#234;n tr&#225;i: &nbsp; <input name="site_logonumleft" type="text" size="10" maxlength="2" value="<?=$config["site_logonumleft"]?>"></div>
						<div>B&#234;n ph&#7843;i: <input name="site_logonumright" type="text" size="10" maxlength="2" value="<?=$config["site_logonumright"]?>"></div>
					</td>
				</tr>
				<tr>
				  <td class="rowform">T&#7927; gi&#225; ngo&#7841;i t&#7879; gi&#7919;a USD v&#224; VND:</td>
				  <td class="rowform"><input name="site_currency" type="text" value="<?=$config["site_currency"]?>" size="10" maxlength="5"></td>
				</tr>
				<!-- luckymancvp -->	
				<tr>
				  <td class="rowform">Hiển thị sản phẩm trên trang chủ:</td>
				  <td class="rowform">
				  	<input name="site_showproduct" type="text" value="<?=$config["site_showproduct"]?>" size="3" maxlength="5">
				  	<font color="#FF0000" style="font-size:9px">(Nhập 1: hiển thị sản phẩm vip; Nhập 3: hiển thị sản phầm ngẫu nhiên; Nhập 6: Hiển thị sản phẩm có giá giảm dần; Nhập 8: Hiển thị sản phẩm có giá tăng dần)</font>
				  </td>
				</tr>
	  <tr>

			</table>
		</td>
	</tr>
    <td valign="top">
			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="adminform">
				<tr>
					<td width="100%" colspan="2" class="headform">
						<strong>C&#7845;u h&#236;nh SMTP-MAIL</strong> 
					</td>
				</tr>
				<tr>
					<td class="rowform" width="32%">Email (Admin): </td>
					<td class="rowform" width="68%"><input name="site_email" type="text" size="35" maxlength="100" value="<?=$config["site_email"]?>"></td>
				</tr>
				<tr>
					<td width="32%" class="rowform">SMTP HOST: </td>
					<td width="68%" class="rowform"><input name="smtp_host" type="text" size="35" maxlength="255" value="<?=$config["smtp_host"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">SMTP MAIL: </td>
					<td class="rowform"><input name="smtp_mail" type="text" size="35" maxlength="100" value="<?=$config["smtp_mail"]?>"></td>
				</tr>
				<tr>
					<td class="rowform">SMTP PASSWORD:</td>
					<td class="rowform"><input name="smtp_pwd" type="password" size="35" maxlength="100" value="<?=$config["smtp_pwd"]?>"></td>
				</tr>
			</table>
		</td>
  </tr>
	<input type="hidden" name="config_name">
	<input type="hidden" name="config_value">
	</form>
</table>
</div>