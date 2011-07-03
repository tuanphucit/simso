<div id="BANNER">
<table width="100%" border="0" cellspacing="0" cellpadding="2" background="images/header_bg.png">
	<form name="frmLang" method="post" action="index.php">
	<tr>
		<td width="60%"><h2><strong><font color="#CCCCCC">&nbsp; Website administration</font></strong></h2></td>
		<td align="right" width="30%">
			<strong><font color="#CCCCCC">Current language</font></strong>
			<select name="LANG" onChange="document.frmLang.submit()">
				<? if($sql->mysql()) echo $myOpt->optionselected($LANG," any languages ","vot_language","language_id","language_name");?>
			</select>
		</td>
		<td align="right" width="10%" class="logoutText"><a href="logout.php"><?=def_thoat?></a> [<font color="#FF6600"><?=$usrname?></font>]</td>
	</tr>
	</form>
</table>
</div>