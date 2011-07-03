<?
if(!$_PAGE_VALID)
{
	exit();
}

	$conds = "language_id='".$lang."' AND modules_parent = 0 AND modules_view=1";
	$others = "ORDER BY modules_parent, modules_order ASC";
	$sql->set_query("vot_modules", "*", $conds, $others);
	while($sql->set_farray())
	{
		$mnItemId = $sql->farray["modules_id"];
		$mnItemParent = $sql->farray["modules_parent"];
		$mnItemName = $sql->farray["modules_name"];
		$mnItemLink = $sql->farray["modules_linkto"];
		$mnItemType = $sql->farray["modules_type"];
		$mnItemSub = $sql->farray["modules_sub"];
		$mnItemPos = split(",", $sql->farray["modules_pos"]);
		if($mnItemPos[0])
			{
				$mnItemLink = "$_URL_BASE/index.php/$mnItemId/$mnItemLink";
				if($mnItemSub)
				{
					$parentID[$count] = $mnItemId;
					$mnItemLink = NULL;
					$count ++;
				}
			}
			if($mnItemPos[1])
			{
				$leftMenuID = $mnItemId;
				$leftMenuTitle = $mnItemName;
			}
}			
	?>
<div>	
	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
	  <tr>
		<td valign="top"><img src="<?=$_IMG_DIR?>/leftmenu_1.jpg" border="0" style="margin-bottom:0px;"></td>
	  </tr>
	  <tr></tr>
	  <tr>
	  	<td valign="top" style="background-image:url(<?=$_IMG_DIR?>/leftmenu_2.jpg)">
			<table width="100%" align="top" cellpadding="0" border="0">
<?
	$sqll = new mysql;
	$where = "language_id='".$lang."' AND modules_parent = '".$leftMenuID."' AND modules_view=1 AND modules_level=1";
	$otherss = "ORDER BY modules_parent, modules_order ASC";
	$sqll->set_query("vot_modules", "*", $where, $otherss);
	while($sqll->set_farray())
	{
		$mnItemId1 = $sqll->farray["modules_id"];
		//$mnItemParent = $sqll->farray["modules_parent"];
		$mnItemName1 = $sqll->farray["modules_name"];
		$mnItemLink1 = $sqll->farray["modules_linkto"];
		$mnItemType = $sqll->farray["modules_type"];
		$mnItemSub = $sqll->farray["modules_sub"];
		$mnItemLink = "$_URL_BASE/index.php/$mnItemId1/$mnItemLink1";
?>				
		<div onClick="expandcontent(<?=$mnItemId1?>)">
					<tr>
						<td width="18" align="right"><img src="<?=$_IMG_DIR?>/dau_leftmenu.gif" border="0" align="absmiddle" ></td>
						<td class="leftMenu"><?=$mnItemName1?></td>
					</tr>
					<tr>
						<td height="2" colspan="2" bgcolor="#FFFFFF"></td>
					</tr>
		</div>
		<DIV id=<?=$mnItemId1?> style="display:block" class="switchcontent">
					<!--<tr>
						<td colspan="2" align="center"><img src="<?=$_IMG_DIR?>/line_leftmenu.gif" border="0" align="absmiddle"/></td>
					</tr>
					<tr>
						<td  colspan="2">
						<?
						$sqlll = new mysql();
						$conds2 = "language_id='".$lang."' AND modules_parent = '".$mnItemId1."' AND modules_view=1 AND modules_level=2";
						$others = "ORDER BY modules_parent, modules_order ASC";
						$sqlll->set_query("vot_modules", "*", $conds2, $others);
						while($sqlll->set_farray())
						{
							$mnItemId2 = $sqlll->farray["modules_id"];
							$mnItemParent = $sqlll->farray["modules_parent"];
							$mnItemName2 = $sqlll->farray["modules_name"];
							$mnItemLink2 = $sqlll->farray["modules_linkto"];
							$mnItemType = $sql->farray["modules_type"];
							$mnItemSub = $sql->farray["modules_sub"];
							$mnItemPos = split(",", $sql->farray["modules_pos"]);
							$mnItemLink2 = "$_URL_BASE/index.php/$mnItemId2/$mnItemLink2";
						?>
						<div class="subLeftMenu" onmouseover="dropdownmenu(this, event, menu<?=$mnItemId2?>, '150px')" onmouseout=delayhidemenu()><a href="<?=$mnItemLink2?>" id="products_menu_<?=$cateId?>_<?=$childId?>"><?=$mnItemName2?></a></div>	
								<?
								$sssql = new mysql();
								$conds = "modules_level = 3 AND modules_parent = $mnItemId2 AND modules_view=1 AND language_id='" . $lang . "'";
								$others = "ORDER BY modules_order ASC";
								$sssql->set_query("vot_modules", "*", $conds, $others);
								if($sssql->nRows > 0)
								{
									echo "<SCRIPT language=javascript>\n
									var menu".$mnItemId2." = new Array();\n";
									while($sssql->set_farray())
									{
										$childchildId = $sssql->farray["modules_id"];
										$childchildcateName = $sssql->farray["modules_name"];
										$mnItemLink3 = $sssql->farray["modules_linkto"];								
										echo "menu".$mnItemId2."[".$childchildId."] = '<a href=\"".$_URL_BASE."/index.php/".$childchildId."/".$mnItemLink3."\">".$childchildcateName."</a>';\n";
									}
									echo "</SCRIPT>\n";
								}
							
							?>
						<?
							}
						?>	
						</td>
					</tr>-->
				</DIV>
					<?
					}
					?>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%"><img src="<?=$_IMG_DIR?>/leftmenu_3.jpg" align="top" style="margin-top:0px" border="0"></td>
		</tr>			
</table>
</div>
<SCRIPT type=text/javascript>
var enablepersist="on" //Enable saving state of content structure using session cookies? (on/off)
var collapseprevious="yes" //Collapse previously open content when opening present? (yes/no)

if (document.getElementById){
document.write('<style type="text/css">')
document.write('.switchcontent{display:none;}')
document.write('</style>')
}

function getElementbyClass(classname){
ccollect=new Array()
var inc=0
var alltags=document.all? document.all : document.getElementsByTagName("*")
for (i=0; i<alltags.length; i++){
if (alltags[i].className==classname)
ccollect[inc++]=alltags[i]
}
}

//var fisrtItem = '';

function contractcontent(omit){
var inc=0
while (ccollect[inc]){
if (ccollect[inc].id!=omit)
ccollect[inc].style.display="none"
inc++
}
}

function expandcontent(cid){
if (typeof ccollect!="undefined"){
if (collapseprevious=="yes")
contractcontent(cid)
document.getElementById(cid).style.display=(document.getElementById(cid).style.display!="block")? "block" : "none"
}
}

function expandcontent1(cid){
if (typeof ccollect!="undefined"){
if (collapseprevious=="yes")
contractcontent(cid)
document.getElementById(cid).style.display=(document.getElementById(cid).style.display!="block")? "block" : "none"
}
}


function revivecontent(){
contractcontent("omitnothing")
selectedItem=getselectedItem()
selectedComponents=selectedItem.split("|")
for (i=0; i<selectedComponents.length-1; i++)
document.getElementById(selectedComponents[i]).style.display="block"
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function getselectedItem(){
if (get_cookie(window.location.pathname) != ""){
selectedItem=get_cookie(window.location.pathname)
return selectedItem
}
else
return ""
}

function saveswitchstate(){
var inc=0, selectedItem=""
while (ccollect[inc]){
if (ccollect[inc].style.display=="block")
selectedItem+=ccollect[inc].id+"|"
inc++
}

document.cookie=window.location.pathname+"="+selectedItem
}

function do_onload(){
getElementbyClass("switchcontent")
if (enablepersist=="on" && typeof ccollect!="undefined")
revivecontent()
}


if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload

if (enablepersist=="on" && document.getElementById)
window.onunload=saveswitchstate

</SCRIPT>
<!--<script language="javascript">
	fisrtItem = '<?=$firstItem_left?>';
	expandcontent(fisrtItem);
</script>-->
