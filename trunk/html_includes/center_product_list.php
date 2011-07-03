<?
if(!$_PAGE_VALID)
{
	exit();
}
?>
<script language="javascript">
var oldObjId = null;
function expandLeftMenu(objId)
{
	if(oldObjId!=null && objId != oldObjId)
	{
		getObjectById('leftMenuItem_'+oldObjId).className = 'leftMenuItem';
		getObjectById('subLeftMenu_'+oldObjId).style.display = 'none';
	}
	if(getObjectById('subLeftMenu_'+objId).style.display == 'none')
	{
		getObjectById('leftMenuItem_'+objId).className = 'leftMenuItemExpand';
		getObjectById('subLeftMenu_'+objId).style.display = '';
	}
	else
	{
		getObjectById('leftMenuItem_'+objId).className = 'leftMenuItem';
		getObjectById('subLeftMenu_'+objId).style.display = 'none';
	}
	oldObjId = objId;
}
</script>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td height="26px;" class="subPageTitle" ><?=$subPageTitle?></td>
		</tr>
		<tr>
			<td style="background-image:url(<?=$_IMG_DIR?>/pagetitle_1.gif); background-repeat:repeat-y; padding-left:1px ">
				<table width="98%" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top"><?=$contentDetail?></td>
					</tr>
					<tr height="37">
						<td width="100%" style="padding:0px 35px 10px 10px"><?=paging($tRows,$curPg,$maxRows,$curURL)?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top"><img src="<?=$_IMG_DIR?>/pagetitle_2.gif" border="0" /></td>
		</tr>
	</table>
<?
if(!$curLeftMenu)
{
	$conds = "language_id='".$lang."' AND modules_parent=0 AND modules_view=1 AND modules_pos = '0,1,0'";
	$others = "ORDER BY modules_order ASC LIMIT 1";
	$curLeftMenu = $opt->optionvalue("vot_modules", "modules_id", $conds, $others);	
}
if($curLeftMenu)
{	
	expandLeftMenu($curLeftMenu);
}
?>	
