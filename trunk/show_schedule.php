<?
session_start();

include_once("myadmin/includes/config.php");
include_once("myadmin/includes/mysql.php");
include_once("includes/global.php");

if(!_SERVER('QUERY_STRING')) 
{
	$url = strip_tags(_SERVER('REQUEST_URI'));
	if($config["script_path"])
	{
		$url = str_replace("/".$config["script_path"],"",$url);
	}
	$url = str_replace("/show_schedule.php", "", $url);
	$url_array = explode("/",$url);
	array_shift($url_array);
}

$my_url = $url_array;

if((int)($my_url[0]))
{
	$cateId = $url_array[0];
}
else
{
	$cateId = NULL;
	$itemId = NULL;
	$cateName = $url_array[0];
}
if($cateId)
{
	if((int)($my_url[1]))
	{
		$itemId = $url_array[1];
		$itemName = $url_array[2];
	}
	else
	{
		$itemId = NULL;
		$cateName = $url_array[1];
	}
}
if(!$itemId || !validGetVar($itemId))
{
	exit();
}
$conds = "schedule_id='".$itemId."'";
$sql->set_query("vot_schedule", "*", $conds);
if($sql->set_farray())
{
	$infoName = displayData_DB($sql->farray["schedule_name"]);
	$infoFile = $sql->farray["schedule_file"];
	$infoDown = $sql->farray["schedule_down"];
	$checkDownFile = NULL;
	if(!$isLogin)
	{
		$alertStr = str_replace("<br>", " ", $define["var_banchuadangnhap"]);
		$checkDownFile = 'onClick="alert(\''.$alertStr.'\'); return false"';
	}
	if(is_file("$_ROOT_PATH/$infoFile"))
	{
		$allow_url_override = 1; // Set to 0 to not allow changed VIA POST or GET
		if(!$allow_url_override || !isset($file_to_include))
		{
			$file_to_include = "$_ROOT_PATH/$infoFile";
		}
		if(!$allow_url_override || !isset($max_rows))
		{
			$max_rows = 0; //USE 0 for no max
		}
		if(!$allow_url_override || !isset($max_cols))
		{
			$max_cols = 7; //USE 0 for no max
		}
		if(!$allow_url_override || !isset($debug))
		{
			$debug = 0;  //1 for on 0 for off
		}
		if(!$allow_url_override || !isset($force_nobr))
		{
			$force_nobr = 1;  //Force the info in cells not to wrap unless stated explicitly (newline)
		}
		
		require_once "$_ROOT_PATH/includes/phpExcelReader/Excel/reader.php";
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('UTF-8');
		$data->read($file_to_include);
		error_reporting(E_ALL ^ E_NOTICE);

		function make_alpha_from_numbers($number)
		{
			$numeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			if($number<strlen($numeric))
			{
				return $numeric[$number];
			}
			else
			{
				$dev_by = floor($number/strlen($numeric));
				return "" . make_alpha_from_numbers($dev_by-1) . make_alpha_from_numbers($number-($dev_by*strlen($numeric)));
			}
		}
		$containDetail .= "<SCRIPT LANGUAGE='JAVASCRIPT'>
		var sheet_HTML = Array();\n";
		for($sheet=0;$sheet<count($data->sheets);$sheet++)
		{
			$table_output[$sheet] .= "<TABLE CLASS='table_body' cellpadding='10'>
			<TR>";
			/*
				<TD>&nbsp;</TD>";
				
			for($i=0;$i<$data->sheets[$sheet]['numCols']&&($i<=$max_cols||$max_cols==0);$i++)
			{
				$table_output[$sheet] .= "<TD CLASS='table_sub_heading' ALIGN=CENTER>" . make_alpha_from_numbers($i) . "</TD>";
			}
			*/
			for($row=2;$row<=$data->sheets[$sheet]['numRows']&&($row<=$max_rows||$max_rows==0);$row++)
			{
				$table_output[$sheet] .= "<TR>";
				for($col=2;$col<=$data->sheets[$sheet]['numCols']&&($col<=$max_cols||$max_cols==0);$col++)
				{
					if($data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'] >=1 && $data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'] >=1)
					{
						$this_cell_colspan = " COLSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];
						$this_cell_rowspan = " ROWSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];
						for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];$i++)
						{
							$data->sheets[$sheet]['cellsInfo'][$row][$col+$i]['dontprint']=1;
						}
						for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];$i++)
						{
							for($j=0;$j<$data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];$j++)
							{
								$data->sheets[$sheet]['cellsInfo'][$row+$i][$col+$j]['dontprint']=1;
							}
						}
					}
					else if($data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'] >=1)
					{
						$this_cell_colspan = " COLSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];
						$this_cell_rowspan = "";
						for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['colspan'];$i++)
						{
							$data->sheets[$sheet]['cellsInfo'][$row][$col+$i]['dontprint']=1;
						}
					}
					else if($data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'] >=1)
					{
						$this_cell_colspan = "";
						$this_cell_rowspan = " ROWSPAN=" . $data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];
						for($i=1;$i<$data->sheets[$sheet]['cellsInfo'][$row][$col]['rowspan'];$i++)
						{
							$data->sheets[$sheet]['cellsInfo'][$row+$i][$col]['dontprint']=1;
						}
					}
					else
					{
						$this_cell_colspan = "";
						$this_cell_rowspan = "";
					}
					if(!($data->sheets[$sheet]['cellsInfo'][$row][$col]['dontprint']))
					{
						$table_output[$sheet] .= "<TD CLASS='table_data' $this_cell_colspan $this_cell_rowspan style='";
						if($row == 2)
						{
							$table_output[$sheet] .= "font-weight:bold; font-size:14px; text-align:center; padding-top:15px; padding-bottom:15px;";
						}
						else
						{
							$table_output[$sheet] .= "border:1px solid #000000;";
						}
						if($row == 3 || $row == 4)
						{
							$table_output[$sheet] .= "font-weight:bold; font-size:12px; text-align:center; padding-top:5px; padding-bottom:5px;background-color:#bdf8ff;";
						}
						if($col == 2 || $col == 3)
						{
							$table_output[$sheet] .= "text-align:center;";
						}
						$table_output[$sheet] .= "'>";
						if($force_nobr)
						{
							$table_output[$sheet] .= "<NOBR>";
						}
						$table_output[$sheet] .= nl2br($data->sheets[$sheet]['cells'][$row][$col]);
						if(nl2br($data->sheets[$sheet]['cells'][$row][$col]) == '')
						{
							$table_output[$sheet] .= "&nbsp;";
						}
						if($force_nobr)
						{
							$table_output[$sheet] .= "</NOBR>";
						}
						$table_output[$sheet] .= "</TD>";
					}
				}
				$table_output[$sheet] .= "</TR>";
			}
			$table_output[$sheet] .= "</TABLE>";
			$table_output[$sheet] = str_replace("\n","",$table_output[$sheet]);
			$table_output[$sheet] = str_replace("\r","",$table_output[$sheet]);
			$table_output[$sheet] = str_replace("\t"," ",$table_output[$sheet]);
			if($debug)
			{
				$debug_output = print_r($data->sheets[$sheet],true);
				$debug_output = str_replace("\n","\\n",$debug_output);
				$debug_output = str_replace("\r","\\r",$debug_output);
				$table_output[$sheet] .= "<PRE>$debug_output</PRE>";
			}
			$containDetail .= "sheet_HTML[$sheet] = \"$table_output[$sheet]\";\n";
		}
		$containDetail .= "
		function change_tabs(sheet)
		{
			//alert('sheet_tab_' + sheet);
			for(i=0;i<" . count($data->sheets) . ";i++)
			{
				document.getElementById('sheet_tab_' + i).className = 'tab_base';
			}
			document.getElementById('table_loader_div').innerHTML=sheet_HTML[sheet];
			document.getElementById('sheet_tab_' + sheet).className = 'tab_loaded';
		}
		</SCRIPT>";
		$containDetail .= "
		<TABLE CLASS='table_body' NAME='tab_table'>
		<TR>";
		for($sheet=0;$sheet<count($data->sheets);$sheet++)
		{
			$containDetail .= "<TD CLASS='tab_base' ID='sheet_tab_$sheet' ALIGN=CENTER
				ONMOUSEDOWN=\"change_tabs($sheet);\">". $data->boundsheets[$sheet]['name'] . "</TD>";
		}
		
		$containDetail .= "<TR></TABLE><DIV ID=table_loader_div></DIV>
		<SCRIPT LANGUAGE='JavaScript'>
		change_tabs(0);
		</SCRIPT>";
?>
<html>
<head>
	<title><?=$siteTitle?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?=$config["site_charset"]?>" />
	<meta name="keywords" content="<?=$config["site_keywords"]?>" />
	<meta name="description" content="<?=$config["site_description"]?>" />
<STYLE>
.table_data
{
	border-style:ridge;
	border-width:0px;
}
.tab_base
{
	background:#C5D0DD;
	font-weight:bold;
	border-style:ridge;
	border-width:1;
	cursor:pointer;
}
.table_sub_heading
{
	background:#CCCCCC;
	font-weight:bold;
	border-style:ridge;
	border-width:0px;
}
.table_body
{
	font-wieght:normal;
	font-size:12;
	font-family:sans-serif;
	border-style:ridge;
	border-width:0px;
	border-spacing: 0px;
	border-collapse: collapse;
}
.tab_loaded
{
	background:#222222;
	color:white;
	font-weight:bold;
	border-style:groove;
	border-width:1;
	cursor:pointer;
}
</STYLE>
</head>
<body>
<table width="98%" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" style="padding-top:10px"><?=$containDetail?></td>
	</tr>
	<tr>
		<td style="padding-top:15px; font-size:11px">
			<a href="<?=$_URL_BASE?>/downloadschedule.php/<?=$itemId?>" <?=$checkDownFile?>><img src="<?=$_IMG_DIR?>/down_icon.gif" width="24" height="30" border="0" align="left"></a>
			<a href="<?=$_URL_BASE?>/downloadschedule.php/<?=$itemId?>" <?=$checkDownFile?>><font style="color:#d01a02; font-weight:bold; text-decoration:none"><?=$define["var_taive"]?></font></a><br>
			<font style="color:#646565">(<font style="color:#0278a9; font-weight:bold"><?=$infoDown?></font>&nbsp;<?=$define["var_luottaive"]?>)</font>
		</td>
	</tr>
</table>
</body>
</html>
<?
	}
}
?>