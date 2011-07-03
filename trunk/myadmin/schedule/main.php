<?
$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

$sql = new mysql();
$opt = new option();

$searchFormActionTo = "index.php?module=$module";

if($CURMOD != NULL)
{
	$conds = "modules_id='" . $CURMOD . "'";
	$pageTitle = $opt->optionvalue("vot_modules","modules_name",$conds);
	$and .= "&CURMOD=$CURMOD";
	$searchFormActionTo .= "&CURMOD=$CURMOD";
	$linktoOrderByName .= "&CURMOD=$CURMOD";
	$linktoOrderByOrder .= "&CURMOD=$CURMOD";
}
else
{
	redirect("?module=modules");
}
$url = "index.php?module=$module&curPg=$curPg&$and";

$linkPath = '<a href="index.php?module=home">'.def_trangchu.'</a>';
for($i = 0; $i < sizeof($ses_parent_url); $i++)
{		
	$linkPath .= " / <a href=\"" . $ses_parent_url[$i];
	$linkPath .= "&CURID=".$ses_parent_id[$i+1];
	$linkPath .= "\">$ses_parent_label[$i]</a>";
}
$linkPath .= " / $pageTitle";

include_once("js.html");

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_schedule","schedule_id",$chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "schedule_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_schedule",$values,"schedule_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "schedule_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_schedule",$values,"schedule_id='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				

		$new_excelfile = NULL;
		$upload_dir = "uploads/schedule_files";
		if($pdate == NULL)
		{
			$pdate = date("Y-m-d");
		}
		$fdate = inDateStr($fdate);
		$edate = inDateStr($edate);
		if($CURID!=NULL && $isSave==NULL)
		{			
			if($excelfile_name == NULL || $excelfile_name == 'none') 
			{
				$new_excelfile = $old_excelfile;
			}
			else
			{
				delFile("../$old_excelfile");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_excelfile = "$upload_dir/excel_".date("dmy").time().".".extFile($excelfile_name);
				upload($excelfile_tmp_name,$new_excelfile);
			}
			$values  = "schedule_name='".$nname."',schedule_pdate='".$pdate."',schedule_fdate='".$fdate."',schedule_edate='".$edate."',schedule_file='".$new_excelfile."',schedule_down='".$down."',schedule_order='".$order."',schedule_view='".$view."'";
			$sql->update("vot_schedule",$values,"schedule_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($excelfile_name != NULL || $excelfile_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_excelfile = "$upload_dir/excel_".date("dmy").time().".".extFile($excelfile_name);
				upload($excelfile_tmp_name,$new_excelfile);
			}
			$fields = "schedule_name,schedule_pdate,schedule_fdate,schedule_edate,schedule_file,schedule_down,schedule_order,schedule_view,modules_id,language_id";
			$values  = "'".$nname."','".$pdate."','".$fdate."','".$edate."','".$new_excelfile."','".$down."','".$order."','".$view."','".$CURMOD."','".$LANG."'";
			$sql->insert("vot_schedule",$fields,$values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		break;
				
	default:
	
		$isSave = NULL;
		_SESSION_REGISTER("isSave");

		include_once("includes/paging.php");
		
		$opt = new option();
		$cond = "language_id = '".$LANG."'";
		if($CURMOD != NULL)
		{
			$cond .= " AND modules_id = '".$CURMOD."'";
		}
		if($KWD != NULL) 
		{
			$cond .= " AND schedule_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$other = " ORDER BY schedule_$orderBy $vArrow";
		if($vArrow == 'DESC') 
		{
			$toArrow = NULL;
			if($orderBy == 'order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
			if($orderBy=='name')
			{
				$orderArrow = NULL;
				$senderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
		}
		else 
		{
			$toArrow = 'DESC';
			if($orderBy == 'order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_up.gif" border="0">';
			}
			if($orderBy == 'name')
			{
				$orderArrow = NULL;
				$senderArrow = '<img src="images/arrow_up.gif" border="0">';
			}
		}
		
		$sql->set_query("vot_schedule","*",$cond,$other);
		$tRows = $sql->nRows;
		
		if(!$curPg)
		{
			$curPg = 1;
		}
		else
		{
			$numPgs = ceil($tRows / $maxRows);
			if($curPg > $numPgs) $curPg = $numPgs;
		}
		$curRow = ($curPg - 1) * $maxRows + 1;
		
		$action = 'edit';

		$CL_SELECTED = "#F5F0F0";
		$MAXSTRLEN = 25;
		
		if($tRows > 0)
		{
			$low = $curRow; 
			$curRow = 1;
			$cur_p = array();
			while (($sql->set_farray()) && ($curRow<=$tRows) && ($curRow<=$curPg*$maxRows))
			{
				$curRow++;			                           
				if($curRow > $low)
				{
					$nid = $sql->farray["schedule_id"];
					$name = $itemTitle = $sql->farray["schedule_name"];
					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name,0,$MAXSTRLEN)."..";
					}
					$order = $sql->farray["schedule_order"];
					$view = $checked[$sql->farray["schedule_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["schedule_name"];
						$pdate = outDateStr($sql->farray["schedule_pdate"]);
						$fdate = outDateStr($sql->farray["schedule_fdate"]);
						$edate = outDateStr($sql->farray["schedule_edate"]);
						$excelfile = $sql->farray["schedule_file"];
						$down = $sql->farray["schedule_down"];
						$cur_order = $sql->farray["schedule_order"];
						$cur_view = $checked[$sql->farray["schedule_view"]];
		
						$BG_COLOR = $CL_SELECTED;
						$arrow = '<img src="images/arrowb.gif">';
						$style = 'style="border-right:1px solid #EEEEEE"';
						$name = "<font class=itemselected>$name</font>";
						$sS1 = ""; $sS2 = "";
					}
					else 
					{
						$BG_COLOR = "#F5F5F5";
						$arrow = "&nbsp;";
						$style = 'style="border-right:0px"';
						$check = NULL;
						$sS1 = 	' style="cursor: pointer" onMouseOver=active(this); onMouseOut="deactive(this);"';				
						$sS2 =  ' onClick=goPage("'.$url.'&CURID='.$nid.'"); ';
					}
					
					$pageContent .= '
					<tr valign="middle" bgcolor="'.$BG_COLOR.'" '.$sS1.' height="30">
						<td align="center" width="5" class="rowlist"><input type="checkbox" value="'.$nid.'" '.$check.' name="chkid"></td>
						<td width="250" '.$sS2.' class="rowlist" title="'.$itemTitle.'">'.$name.'</td>
						<td width="80" align="center" class="rowlist"><input name="itOrder_'.$nid.'" value="'.$order.'" class="listOrderTxtBox" onChange="getObjChange(\''.$nid.'\',this,\'listOrder\',\'listId_O\')"></td>
						<td width="40" align="center" class="rowlist"><input type="checkbox" name="itView_'.$nid.'" '.$view.' onClick="getObjChange(\''.$nid.'\',this,\'listView\',\'listId_V\')"></td>
						<td '.$sS2.' width="5" class="rowlist">'.$arrow.'</td>
					</tr>';
				}
			}
		}
		else
		{ 
			$pageContent .= NORESULT;
		}

		$rightContentFile = "scheduleinfos.php";		

		$linktoOrderByName = "?module=$module&orderBy=name&vArrow=$toArrow&KWD=$KWD";
		$linktoOrderByOrder = "?module=$module&orderBy=order&vArrow=$toArrow&KWD=$KWD";
		
		include_once("listschedule.php");
		break;			
}
?>