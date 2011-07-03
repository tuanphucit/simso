<?
if(!$_PAGE_VALID)
{
	exit();
}

$leftMenuItemNum = sizeof($leftMenuItem);
if($leftMenuItemNum > 0)
{
?>
<table width="99%" cellpadding="0" cellspacing="0" border="0" align="left">
	<tr>
		<td align="center">
			<table width="100%" cellpadding="0" cellspacing="0" title="<?=$leftMenuTitle?>">
<?
	for($i = 0; $i < $leftMenuItemNum; $i++)
	{
		echo '<tr><td class="leftMenu">';
		
		if($curItem != $leftMenuItem[$i]['linkto'])
		{
			echo '<a href="'.$leftMenuItem[$i]['linkto'].'" ';
			echo 'title="'.$leftMenuItem[$i]['name'].'">'.$leftMenuItem[$i]['name'].'</a>';
		}
		else
		{
			echo $leftMenuItem[$i]['name'];
		}
		echo '</td></tr>';
	}
?>
			</table>
		</td>
	</tr>
</table>
<?
}
?>