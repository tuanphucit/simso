<?
$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD";

$sql = new mysql();
$opt = new option();

$searchFormActionTo = "index.php?module=$module";
$linktoOrderByName = "?module=$module";
$linktoOrderByOrder = "?module=$module";

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
		$sql->delete("product","id",$chon);
		redirect($url);			
		break;			
	case 'deleteall':			
		$sql->set_list_tables();
		$sql->delete("product","category",$category);
		redirect($url);			
		break;			

	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "thutu='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("product",$values,"id='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("product",$values,"id='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
if(!$view)  $view = 0;
if(!$ihome)  $ihome= 0;
if(!$ihight)  $ihight= 0;
		if($ndate == NULL)
		{
			$ndate = date("d-m-Y");
		}
		$ndate = inDateStr($ndate);
		if($CURID!=NULL && $isSave==NULL)
		{			
			
			$values  = "thutu='".$thutu."',sosim='".$nname."',gianhap='".$gianhap."',giaxuat='".$giaxuat."',taikhoan='".$taikhoan."',kho='".$kho."',ihome='".$ihome."',ihight='".$ihight."',view='".$view."'";
			$sql->update("product",$values,"id=$CURID");					
		}
		elseif($isSave==NULL)
		{
			$fields = "thutu,sosim,gianhap,giaxuat,taikhoan,kho,category,ihome,ihight,view";
			$values  = "'".$thutu."','".$nname."','".$gianhap."','".$giaxuat."','".$kho."','".$CURMOD."','".$ihome."','".$ihight."','".$view."'";
			$sql->insert("product",$fields,$values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		break;
		
	case 'edit':
		$conds = "category='".$CURMOD."'";
		$thutu = $opt->optionvalue("product", "MAX(thutu)",$conds) + 1; 
		$view = $checked[1];
		
		if($CURID!=NULL)
		{
			$sql->set_query("product","*","id=$CURID");
			$sql->set_farray();
			$name = $sql->farray["sosim"];
			$gianhap = $sql->farray["gianhap"];
			$giaxuat = $sql->farray["giaxuat"];
			$taikhoan = $sql->farray["taikhoan"];
			$kho = $sql->farray["kho"];
			
			$thutu = $sql->farray["thutu"];
			$ihome = $checked[$sql->farray["ihome"]];
			$ihight = $checked[$sql->farray["ihight"]];
			$view = $checked[$sql->farray["view"]];
			$pageTitle = alt_add;
			$curPage = "$name";
		}

		include $config["FCKeditor_path"]."fckeditor.php";
		$sBasePath  = $config["FCKeditor_path"];
		
		$oFCKeditor_1 = new FCKeditor("shortdes");
		$oFCKeditor_1->BasePath	= $sBasePath;
		$oFCKeditor_1->Value		= $shortdes;
		$oFCKeditor_1->Width	= "100%";
		$oFCKeditor_1->Height	= 300;
		
		$oFCKeditor_2 = new FCKeditor("detail");
		$oFCKeditor_2->BasePath	= $sBasePath;
		$oFCKeditor_2->Value		= $detail;
		$oFCKeditor_2->Width	= "100%";
		$oFCKeditor_2->Height	= 450;
		_SESSION_REGISTER("CURMOD");
		include_once("productform.php");
		
		break;
		
	default:
	
		$isSave = NULL;
		_SESSION_REGISTER("isSave");

		include_once("includes/paging.php");
		
		$opt = new option();
		//$cond = "language_id = '".$LANG."'";
		if($CURMOD != NULL)
		{
			$cond .= "category = '".$CURMOD."'";
		}
		if($KWD != NULL) 
		{
			$cond .= " AND sosim LIKE '%".$KWD."%'";
		}
		if(($orderBy == NULL) || ($orderBy != 'sosim' && $orderBy != 'thutu')) 
		{
			$orderBy = "thutu";
		}
		
		if(!$vArrow) $vArrow = 'DESC';
		
		$other = " ORDER BY $orderBy $vArrow";
		if($vArrow == 'DESC') 
		{
			$toArrow = 'ASC';
			if($orderBy == 'thutu')
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
			if($orderBy == 'thutu')
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
		
		$sql->set_query("product","*",$cond,$other);
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
					$nid = $sql->farray["id"];
					$name = $itemTitle = $sql->farray["sosim"];
					if(strlen($name) > $MAXSTRLEN) 
					{
						$name = cutString($name,0,$MAXSTRLEN)."..";
					}
					$thutu = $sql->farray["thutu"];
					$view = $checked[$sql->farray["view"]];
									
					if(($CURID == NULL) && ($curRow == $low + 1)) 
					{
						$CURID = $nid;
					}
					if($nid == $CURID) 
					{
						$cur_id = $nid;
						$cur_name = $sql->farray["sosim"];
						$gianhap = geld($sql->farray["gianhap"]);
						$giaxuat = geld($sql->farray["giaxuat"]);
						$taikhoan = geld($sql->farray["taikhoan"]);
						$kho = $sql->farray["kho"];
						//$istop = $checked[$sql->farray["product_istop"]];
						$ihome = $checked[$sql->farray["ihome"]];
						$ihight = $checked[$sql->farray["ihight"]];
						$thutu = $sql->farray["thutu"];
						$view = $checked[$sql->farray["view"]];
		
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
						<td width="80" align="center" class="rowlist"><input name="itOrder_'.$nid.'" value="'.$thutu.'" class="listOrderTxtBox" onChange="getObjChange(\''.$nid.'\',this,\'listOrder\',\'listId_O\')"></td>
						<td width="40" align="center" class="rowlist"><input type="checkbox" name="itView_'.$nid.'" '.$view.' onClick="getObjChange(\''.$nid.'\',this,\'listView\',\'listId_V\')"></td>
						<td '.$sS2.' width="5" class="rowlist">'.$arrow.'</td>
					</tr>';
				}
			}
			$rightContentFile = "productinfos.php";
		}
		else
		{ 
			$pageContent .= NORESULT;
			$rightContentFile = "html_includes/no_info.html";
		}		
		$conds = "modulefield_view = 1";
		$others = "ORDER BY modulefield_order ASC";
		$dskho = $opt->optionselected($kho,def_chon,"vot_modulefield","modulefield_id","modulefield_name");

		$linktoOrderByName .= "&orderBy=name&vArrow=$toArrow&KWD=$KWD";
		$linktoOrderByOrder .= "&orderBy=order&vArrow=$toArrow&KWD=$KWD";

		include_once("listproduct.php");
		break;			
}
?>
