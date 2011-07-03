<script language=JavaScript src='Editor/scripts/innovaeditor.js'></script>
	<form name="frmEdit" action="<?=$url?>&action=update" method="post" enctype="multipart/form-data">
<table class="menubar" border="0" cellpadding="5" cellspacing="2" width="100%">
  <tr>
    <td valign="top">
			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="adminform">
				<tr>
					<td width="100%" colspan="2" class="headform"><?=def_thongtin?></td>
				</tr>
				<tr>
					<td width="10%" class="rowform"><?=def_tendanhmuc?>: </td>
					<td width="90%" class="rowform">
						<input name="nname" type="text" size="50" maxlength="255" value="<?=$name?>" class="textbox"> 
						<font color="#FF3300">*</font>
					</td>
				</tr>
				<tr>
					<td class="rowform"><?=def_ngaydang?>: </td>
					<td class="rowform">
						<input name="ndate" type="text" size="15" maxlength="20" value="<?=$ndate?>" class="textbox"> 
					</td>
				</tr>
				<tr>
					<td class="rowform" valign="top"><?=def_anhminhhoa?>: </td>
					<td class="rowform"><input type="file" name="image" class="textbox" size="45"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_thutu?>: </td>
					<td class="rowform"><input name="order" type="text" value="<?=$order?>" class="textbox" size="5" maxlength="11"></td>
				</tr>
				<tr>
					<td class="rowform"><?=def_hien?>: </td>
					<td class="rowform"><input name="view" type="checkbox" <?=$view?> value="1"></td>
				</tr>
				<tr>
					<td class="rowform" valign="top" style="padding-top: 50px"><?=def_gioithieuqua?>: </td>
					<td class="rowform">
						<textarea id="shortdes" name="shortdes" rows="9"><?=$shortdes?></textarea>
<script> 
		var oEdit1 = new InnovaEditor("oEdit1");
		oEdit1.width="100%";
    oEdit1.height=300;
		oEdit1.features=["FullScreen","Preview","Print",
    "Search","SpellCheck",
    "Superscript","Subscript","LTR","RTL",
    "Table","Guidelines",
    "Flash","Media",
    "Characters","ClearAll","XHTMLSource","BRK",
    "Cut","Copy","Paste","PasteWord","PasteText",
    "Undo","Redo","Hyperlink","Image",
    "JustifyLeft","JustifyCenter","JustifyRight","JustifyFull",
    "Numbering","Bullets",
    "Line","RemoveFormat","BRK",
    "StyleAndFormatting","TextFormatting","ListFormatting",
    "BoxFormatting","ParagraphFormatting","CssText",
    "Paragraph","FontName","FontSize",
    "Bold","Italic","Underline","Strikethrough",
    "ForeColor","BackColor",
    ];// => Custom Button Placement
    
   // oEdit1.css="style/test.css";//Specify external css file here

    oEdit1.cmdAssetManager = "modalDialogShow('../assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
    
		oEdit1.REPLACE("shortdes");
		
		
	</script>
					</td>
				</tr>
				<tr>
					<td class="rowform" valign="top" style="padding-top: 50px"><?=def_noidungchitiet?>: </td>
					<td class="rowform"><? //=$oFCKeditor_2->Create()?></td>
				</tr>
				<input type="hidden" name="CURID" value="<?=$CURID?>">
				<input type="hidden" name="KWD" value="<?=$KWD?>">
				<input type="hidden" name="old_image" value="<?=$image?>">
			</table>
		</td>
  </tr>
</table>
	<input type="submit" name="sbmtBtn" value="Submit">
</form>
<?
echo $HTTP_POST_VARS['shortdes'];
?>