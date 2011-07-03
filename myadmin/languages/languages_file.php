<?
$lang_file_content = "<table cellpadding=\"0\" cellspacing=\"0\" height=\"25\">\n\t<tr>";

$sql = new mysql();
$sql->set_query("vot_language","*","language_view=1","ORDER BY language_order");
while($sql->set_farray())
{
	$lang_id = $sql->farray["language_id"];
	$lang_name = $sql->farray["language_name"];
	$lang_flag = NULL;
	if(is_file("../".$sql->farray["language_flag"])) $lang_flag = '<img src="'.$sql->farray["language_flag"].'" border="0" width="30">';
	$lang_file_content .= "\n\t\t<td id=\"lang_$lang_id\" align=\"center\" style=\"padding-right:10px\">";
	$lang_file_content .= "<a href=\"?lang=$lang_id\"><div>$lang_flag</div><div>$lang_name</div></a></td>";
}
$lang_file_content .= "\n\t</tr>\n</table>\n<script language=\"javascript\">\n";
$lang_file_content .= "var curLang = eval('lang_<?=$"."lang"."?>');\n";
$lang_file_content .= "curLang.style.display = 'none';\n";
$lang_file_content .= "</script>";

saveFile("../html_includes/languages.html",$lang_file_content);
?>