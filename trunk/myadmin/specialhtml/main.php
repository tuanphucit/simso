<?
if($usrid != 0)
{
	redirect("?module=home");
}

$url = "index.php?module=$module&curPg=$curPg&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD&CATE=$CATE";

include_once("js.html");

$sql = new mysql;
$opt = new option;

$parentPage = def_qlcactrangtinh;
//$opt->optionvalue("vot_htmltype","htmltype_name","htmltype_id=$PARENTID");

switch($action)
{
	case 'delete':			
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_html","html_pid",$chon);
		redirect($url);			
		break;			
	
	case 'updates':
		$listId_O = split(",",$listId_O);
		$listId_V = split(",",$listId_V);
		$listOrder = split(",",$listOrder);
		$listView = split(",",$listView);
		for($i=0;$i<sizeof($listId_O)-1;$i++)
		{
			$values = "html_order='".$listOrder[$i]."'";
			$sql = new mysql();
			$sql->update("vot_html",$values,"html_pid='".$listId_O[$i]."'");
		}

		for($i=0;$i<sizeof($listId_V)-1;$i++)
		{
			$values = "html_view='".$listView[$i]."'";
			$sql = new mysql();
			$sql->update("vot_html",$values,"html_pid='".$listId_V[$i]."'");
		}
		
		redirect($url);
		break;
	
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect($url);
		}				
		
		if(!$view) $view = 0;

		if($CURID!=NULL && $isSave==NULL)
		{			
			$values  = "html_id='".$htmlid."',html_name='".$nname."',html_detail='".$detail."',html_order='".$order."',html_view='".$view."',html_cate='".$cate."'";
			$sql->update("vot_html",$values,"html_pid=$CURID");					
		}
		elseif($isSave == NULL)
		{
			$fields = "html_id,html_name,html_detail,html_order,html_view,html_cate,language_id";
			$values  = "'".$htmlid."','".$nname."','".$detail."','".$order."','".$view."','".$cate."','".$LANG."'";
			$sql->insert("vot_html",$fields,$values);
		}
		$isSave = "Y";
		_SESSION_REGISTER("isSave");
		redirect("$url&CURID=$CURID");
		break;
		
	case 'edit':
		$htmlId = NULL; $name = NULL; $img = NULL;
		$detail = NULL; $order = 20; $view = NULL;
		$headpage = "Add new item";
		if($CURID!=NULL)
		{
			$sql->set_query("vot_html","*","html_pid=$CURID");
			$sql->set_farray();
			$htmlid = $sql->farray["html_id"];
			$name = $sql->farray["html_name"];
			$detail = $sql->farray["html_detail"];
			$cate = $sql->farray["html_cate"];
			$order = $sql->farray["html_order"];
			$view = $checked[$sql->farray["html_view"]];
			$headpage = "Edit \"$name\"";
		}
		include $config["FCKeditor_path"]."fckeditor.php";
		$sBasePath  = $config["FCKeditor_path"];
		$oFCKeditor = new FCKeditor("detail");
		$oFCKeditor->BasePath	= $sBasePath;
		$oFCKeditor->Value		= $detail;
		$oFCKeditor->Width	= "100%";
		$oFCKeditor->Height	= 450;
		
		$and = "CURID=$CURID&orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD&CATE=$CATE";
		include_once("htmlform.php");
		
		break;
		
	default:
	
		$isSave = NULL;
		_SESSION_REGISTER("isSave");

		include_once("includes/paging.php");
		
		$opt = new option();
		$cond = "language_id = $LANG";		
		if($KWD != NULL) 
		{
			$cond .= " AND html_name LIKE '%".$KWD."%'";
		}
		if($CATE != NULL)
		{
			$cond .= " AND html_cate = '".$CATE."'";
		}
		if(($orderBy == NULL) || ($orderBy != 'name' && $orderBy != 'order')) 
		{
			$orderBy = "order";
		}
		$other = " ORDER BY html_$orderBy $vArrow";
		if($vArrow == 'DESC') 
		{
			$toArrow = NULL;
			if($orderBy=='order')
			{
				$senderArrow = NULL;
				$orderArrow = '<img src="images/arrow_down.gif" border="0">';
			}
			if($orderBy == 'name')
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
			if($orderBy=='name')
			{
				$orderArrow = NULL;
				$senderArrow = '<img src="images/arrow_up.gif" border="0">';
			}
		}
		
		$sql->set_query("vot_html","*",$cond,$other);
		$tRows = $sql->nRows;
		
		if(!$curPg) $curPg = 1;
		else
		{
			$numPgs = ceil($tRows / $maxRows);
			if($curPg > $numPgs) $curPg = $numPgs;
		}
		$curRow = ($curPg-1)*$maxRows+1;
		
		$action = 'edit';
		$and = "orderBy=$orderBy&vArrow=$vArrow&KWD=$KWD&CATE=$CATE";
		$url = "index.php?module=$module&curPg=$curPg&$and";

		$cur_id = NULL; $cur_name = NULL; $img = NULL;
		$detail = NULL; $order = 20; $view = NULL;
		$CL_SELECTED = "#F5F0F0";
		$MAXSTRLEN = 25;
		
		if($tRows>0)
		{
			$low = $curRow; 
			$curRow = 1;
			while (($sql->set_farray())&&($curRow<=$tRows)&&($curRow<=$curPg*$maxRows))
			{
				$curRow++;			                           
				if($curRow > $low)
				{
					$nid = $sql->farray["html_pid"];
					$name = $sql->farray["html_name"];
					if(strlen($name) > $MAXSTRLEN)
					{
						$name = cutString($name, 0, $MAXSTRLEN) . "..";
					}
					$order = $sql->farray["html_order"];
					$view = $checked[$sql->farray["html_view"]];
									
					if(($CURID==NULL)&&($curRow==$low+1)) {$CURID = $nid;}
					if($nid==$CURID) 
					{
						$cur_id = $nid;
						$htmlId = $sql->farray["html_id"];
						$cur_name = $sql->farray["html_name"];
						$detail = $sql->farray["html_detail"];
						$cate = $sql->farray["html_cate"];
	
						$BG_COLOR = $CL_SELECTED;
						$arrow = '<img src="images/arrowb.gif">';
						$style = 'style="border-right:1px solid #EEEEEE"';
						//$check = "checked";
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
						<td width="250" '.$sS2.' class="rowlist">'.$name.'</td>
						<td width="80" align="center" class="rowlist"><input name="itOrder_'.$nid.'" value="'.$order.'" class="listOrderTxtBox" onChange="getObjChange(\''.$nid.'\',this,\'listOrder\',\'listId_O\')"></td>
						<td width="40" align="center" class="rowlist"><input type="checkbox" name="itView_'.$nid.'" '.$view.' onClick="getObjChange(\''.$nid.'\',this,\'listView\',\'listId_V\')"></td>
						<td '.$sS2.' width="5" class="rowlist">'.$arrow.'</td>
					</tr>';
				}
			}
			$rightContentFile = "htmlinfos.php";
		}
		else
		{
			$pageContent = NORESULT;
			$rightContentFile = "html_includes/no_info.html";
		}

		include_once("listhtml.php");
		break;			
}
?>