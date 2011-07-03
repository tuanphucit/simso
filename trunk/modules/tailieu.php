<?
if(!$_PAGE_VALID)
{
	exit();
}
$fromss = "vot_document";
$cond = "language_id='".$lang."' AND document_view = 1";
$otherss = "ORDER BY document_order ASC";
$sql->set_query($fromss, "*", $cond, $otherss);
$sql->nRows;
if($sql->nRows>0)
{
$blockContent .= '<table width="100%" cellpadding=0 cellpacing=0 border=0>
					<tr>
						<td height="26px" class="subPageTitle">'.$define["var_taibangso"].'</td>
					</tr>
					<tr>
						<td style="background-image:url('.$_IMG_DIR.'/pagetitle_1.gif); background-repeat:repeat-y; padding-left:1px ">
							<table width="98%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td height="3" colspan=8></td>
								</tr>
								<tr height="26">
									<td width="25" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold; text-align:center;background-color:#eeeeee">STT</td>
									<td width="100" style="font-family:tahoma; font-size:11px;color:#fd720b;font-weight:bold; text-align:center;background-color:#eeeeee">'.$define["var_danhsachmang"].'</td>
									<td width="100" style="font-family:tahoma; font-size:11px;color:#fd720b; font-weight:bold;text-align:center;background-color:#eeeeee">'.$define["var_taive"].'</td>
								</tr>';
				$count = 0;					
			while($sql->set_farray())
			{
			$count ++;
				$infoId = $sql->farray["document_id"];
				$MoDId = $sql->farray["modules_id"];
				$tentaileu = $sql->farray["document_name"];
				$infoDown = $sql->farray["document_down"];
				$linktohg = "$_URL_BASE/show_docdes.php/$MoDId/$infoId";
	$blockContent .= "
				<tr height=\"24\">
					<td width=\"25\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\">".$count."</td>
					<td width=\"100\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:tahoma; font-size:11px;color:#000000; text-align:center;font-weight:bold\"><a href=\"".$linktohg."\" onClick=\"Modalbox.show(this.href, {title: this.title, width:500, height:500,overlayClose: false}); return false;\">".$tentaileu."</a></td>
					<td width=\"100\" style=\"border-right:1px solid #c4c4c4;border-bottom:1px solid #c4c4c4;font-family:arial; font-size:11px;color:#000000; text-align:center;\"><a href=\"".$linktohg."\" onClick=\"Modalbox.show(this.href, {title: this.title, width:500, height:500,overlayClose: false}); return false;\">".$define["var_taive"]."</a></td>
				</tr>";			
}
	$blockContent.='</table></td></tr><tr><td height=30 style="background-image:url('.$_IMG_DIR.'/pagetitle_1.gif); background-repeat:repeat-y; padding-left:1px "></td></tr><tr><td valign="top" style="padding-bottom:10px"><img src="'.$_IMG_DIR.'/pagetitle_2.gif" border="0"></td><tr></table>'; 
}	
$contentTitle = "".$define["var_taibangso"]."";

require_once("$_HTML_DIR/center_content_home.php");
?>