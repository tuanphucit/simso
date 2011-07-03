<?
$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

$sql = new mysql();
$opt = new option();

if($CURMOD != NULL)
{
	$conds = "modules_id='" . $CURMOD . "'";
	$pageTitle = $opt->optionvalue("vot_modules","modules_name",$conds);
	$and .= "&CURMOD=$CURMOD";
	$searchFormActionTo .= "&CURMOD=$CURMOD";
	$linktoOrderByName .= "&CURMOD=$CURMOD";
	$linktoOrderByOrder .= "&CURMOD=$CURMOD";
	$newOrder = $opt->optionvalue("vot_document", "MAX(document_order)", $conds) + 1;
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
		$sql->delete("vot_document","document_id",$chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "document_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_document",$values,"document_id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "document_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_document",$values,"document_id='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				

		$new_msdoc = NULL;
		$new_adpdf = NULL;
		$upload_dir = "uploads/document_files";
		if($ndate == NULL)
		{
			$ndate = date("d-m-Y");
		}
		$ndate = inDateStr($ndate);
		if($CURID!=NULL && $isSave==NULL)
		{			
			if($msdoc_name == NULL || $msdoc_name == 'none') 
			{
				$new_msdoc = $old_msdoc;
			}
			else
			{
				delFile("../$old_msdoc");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_msdoc = "$upload_dir/msdoc_".date("dmy").time().".".extFile($msdoc_name);
				upload($msdoc_tmp_name,$new_msdoc);
			}
			if($adpdf_name == NULL || $adpdf_name == 'none') 
			{
				$new_adpdf = $old_adpdf;
			}
			else
			{
				delFile("../$old_adpdf");				
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_adpdf = "$upload_dir/adpdf_".date("dmy").time().".".extFile($adpdf_name);
				upload($adpdf_tmp_name,$new_adpdf);
			}
			$values  = "document_name='".$nname."',document_date='".$ndate."',document_msdoc='".$new_msdoc."',document_adpdf='".$new_adpdf."',document_down='".$down."',document_shortdes='".$shortdes."',document_order='".$order."',document_view='".$view."',documentarea_id='".$docArea."',documentprom_id='".$docProm."',documenttype_id='".$docType."'";
			$sql->update("vot_document",$values,"document_id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			if($msdoc_name != NULL && $msdoc_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_msdoc = "$upload_dir/msdoc_".date("dmy").time().".".extFile($msdoc_name);
				upload($msdoc_tmp_name,$new_msdoc);
			}
			if($adpdf_name != NULL && $adpdf_name != 'none')
			{
				$oldumask = umask(0);
				if(@!is_dir("../$upload_dir")) @mkdir("../$upload_dir",0777);
				$new_adpdf = "$upload_dir/adpdf_".date("dmy").time().".".extFile($adpdf_name);
				upload($adpdf_tmp_name,$new_adpdf);
			}
			$fields = "document_name,document_date,document_msdoc,document_adpdf,document_down,document_shortdes,document_order,document_view,documentarea_id,documentprom_id,documenttype_id,modules_id,language_id";
			$values  = "'".$nname."','".$ndate."','".$new_msdoc."','".$new_adpdf."','".$down."','".$shortdes."','".$order."','".$view."','".$docArea."','".$docProm."','".$docType."','".$CURMOD."','".$LANG."'";
			$sql->insert("vot_document",$fields,$values);
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
			$cond .= " AND document_name LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		if(!$vArrow) $vArrow = 'DESC';
		
		$other = " ORDER BY document_$orderBy $vArrow";
		if($vArrow == 'DESC') 
		{
			$toArrow = 'ASC';
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
		
		$sql->set_query("vot_document","*",$cond,$other);
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
					$nid = $sql->farray["document_id"];
					$name = $itemTitle = $sql->farray["document_name"];
					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name,0,$MAXSTRLEN)."..";
					}
					$order = $sql->farray["document_order"];
					$view = $checked[$sql->farray["document_view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["document_name"];
						$ndate = outDateStr($sql->farray["document_date"]);
						$msdoc = $sql->farray["document_msdoc"];
						$adpdf = $sql->farray["document_adpdf"];
						$down = $sql->farray["document_down"];
						$shortdes = $sql->farray["document_shortdes"];
						$cur_order = $sql->farray["document_order"];
						$cur_view = $checked[$sql->farray["document_view"]];
						$docType = $sql->farray["documenttype_id"];
						$docArea = $sql->farray["documentarea_id"];
						$docProm = $sql->farray["documentprom_id"];
		
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

		$conds = "language_id = '".$LANG."' AND modules_id='".$CURMOD."'";
		$others = "ORDER BY documenttype_order ASC";
		$docTypeSels = $opt->optionselected($docType, def_chon, "vot_documenttype", "documenttype_id", "documenttype_name", $conds, $others);
		$others = "ORDER BY documentarea_order ASC";
		$docAreaSels = $opt->optionselected($docArea, def_chon, "vot_documentarea", "documentarea_id", "documentarea_name", $conds, $others);
		$others = "ORDER BY documentprom_order ASC";
		$docPromSels = $opt->optionselected($docProm, def_chon, "vot_documentprom", "documentprom_id", "documentprom_name", $conds, $others);

		$rightContentFile = "documentinfos.php";		

		$searchFormActionTo = "index.php?module=$module";
		$linktoOrderByName = "?module=$module&orderBy=name&vArrow=$toArrow&KWD=$KWD";
		$linktoOrderByOrder = "?module=$module&orderBy=order&vArrow=$toArrow&KWD=$KWD";
		
		include_once("listdocument.php");
		break;			
}
?>