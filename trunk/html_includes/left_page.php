<?
if(!$_PAGE_VALID)
{
	exit();
}
?><!--
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
</script>-->
<?
$sqlll = new mysql;
$conds = "language_id='".$lang."' AND homeblock_lr=0 AND homeblock_view=1";
$others = "ORDER BY homeblock_order ASC";
$sqlll->set_query("vot_homeblock_lr", "*", $conds, $others);
if($sqlll->nRows > 0)
{
?>
			<table width="100%"	cellpadding=0 cellspacing="0" border="0">
			<?
			  if($config["site_verticalmenu"]==1)
				{
			?>

				<tr>
					<td align="right" valign="top">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td valign="top">
									<? if(is_file("$_HTML_DIR/menuleft_$lang.htm")) include_once("$_HTML_DIR/menuleft_$lang.htm")?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="6"></td>
				</tr>
				<?
				}
				else
				{
				}
				?>
	
	<?
	while($sqlll->set_farray())
	{
		$Title = $sqlll->farray["homeblock_name"];
		$modLeftId = $sqlll->farray["homeblock_pos"];
		$modulesLeft = $opt->optionvalue("vot_homeblocktype_lr", "homeblocktype_name", "homeblocktype_id ='".$modLeftId."'");
	
	?>
				<tr>
					<td valign="top"><?  require("$modulesLeft") ?>
					</td>
				</tr>
				<tr>
					<td height="6"></td>
				</tr>
		<?	
		}
		?>
			</table>
<?
}
?>
<? /*
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
*/
?>
		 	