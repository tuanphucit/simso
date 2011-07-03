<?php
function print_error( $msg )
	{
		print <<<END
		<tr>
			<td colspan=5><font color=red><b>Error: </b></font>$msg</td>
			<td><font color=red><b>Rejected</b></font></td>
		</tr>

END;
	}

function getHeader( $exc, $data )
{
		// string
	
		$ind = $data['data'];
		if( $exc->sst[unicode][$ind] )
			return convertUnicodeString ($exc->sst['data'][$ind]);
		else
			return $exc->sst['data'][$ind];

}


function convertUnicodeString( $str )
{
	for( $i=0; $i<strlen($str)/2; $i++ )
	{
		$no = $i*2;
		$hi = ord( $str[$no+1] );
		$lo = $str[$no];
		
		if( $hi != 0 )
			continue;
		elseif( ! ctype_alnum( $lo ) )
			continue;
		else
			$result .= $lo;
	}
	
	return $result;
}

function uc2html($str) {
	$ret = '';
	for( $i=0; $i<strlen($str)/2; $i++ ) {
		$charcode = ord($str[$i*2])+256*ord($str[$i*2+1]);
		$ret .= '&#'.$charcode;
	}
	return $ret;
}



function get( $exc, $data )
{
	switch( $data['type'] )
	{
		// string
	case 0:
		$ind = $data['data'];
		if( $exc->sst[unicode][$ind] )
			return uc2html($exc->sst['data'][$ind]);
		else
			return $exc->sst['data'][$ind];

		// integer
	case 1:
		return (integer) $data['data'];

		// float
	case 2:
		return (float) $data['data'];
        case 3:
		return gmdate("m-d-Y",$exc->xls2tstamp($data[data]));

	default:
		return '';
	}
}



function fatal($msg = '') {
	echo '[Fatal error]';
	if( strlen($msg) > 0 )
		echo ": $msg";
	echo "<br>\nScript terminated<br>\n";
	if( $f_opened) @fclose($fh);
	exit();
}


function getTableData ( $ws, $exc ) {
	
	
	global $excel_file, $db_table;
	global $db_host, $db_name, $db_user, $db_pass;
	
	$data = $ws['cell'];
	
echo <<<FORM

	<form action="" method="POST" name="db_export">
	<table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666">
	<tr bgcolor="#f1f1f1">

FORM;

// Form fieldnames
	
if ( !$_POST['useheaders'] ) {
/*
	for ( $j = 0; $j <= $ws['max_col']; $j++ ) {

		$field = "field" . $j;
*/					
		echo <<<HEADER

		<td>
			<input type="checkbox" name="fieldcheck[0]" value="0" checked title="Check to proceed this field">
			<input type="text" name="fieldname[0]" value="sosim" title="Field name">
		</td>
		<td>
			<input type="checkbox" name="fieldcheck[1]" value="1" checked title="Check to proceed this field">
			<input type="text" name="fieldname[1]" value="gianhap" title="Field name">
		</td>
		<td>
			<input type="checkbox" name="fieldcheck[2]" value="2" checked title="Check to proceed this field">
			<input type="text" name="fieldname[2]" value="giaxuat" title="Field name">
			<input type="hidden" name="fieldcheck[3]" value="3">
			<input type="hidden" name="fieldname[3]" value="thutu" title="Field name">
			<input type="hidden" name="fieldcheck[4]" value="4">
			<input type="hidden" name="fieldname[4]" value="kho" title="Field name">
			<input type="hidden" name="fieldcheck[5]" value="5">
			<input type="hidden" name="fieldname[5]" value="category" title="Field name">
			<input type="hidden" name="fieldcheck[6]" value="6">
			<input type="hidden" name="fieldname[6]" value="taikhoan" title="Field name">
			<input type="hidden" name="kho" value="{$_POST['kho']}">
			<input type="hidden" name="category" value="{$_GET['CURMOD']}">
		</td>
HEADER;
	//}

}
else {
/*
	for ( $j = 0; $j <= $ws['max_col']; $j++ ) {
		
		$field = getHeader ( $exc, $data[0][$j] );
			
		$field = ereg_replace ( "^[0-9]+", "", $field );
		
		if (empty ($field) )
			$field = "field" . $j;
		*/
		echo <<<HEADER

		
		<td>
			<input type="checkbox" name="fieldcheck[0]" value="0" checked title="Check to proceed this field">
			<input type="text" name="fieldname[0]" value="sosim" title="Field name">
		</td>
		<td>
			<input type="checkbox" name="fieldcheck[1]" value="1" checked title="Check to proceed this field">
			<input type="text" name="fieldname[1]" value="gianhap" title="Field name">
		</td>
		<td>
			<input type="checkbox" name="fieldcheck[2]" value="2" checked title="Check to proceed this field">
			<input type="text" name="fieldname[2]" value="giaxuat" title="Field name">
			<input type="hidden" name="fieldcheck[3]" value="3">
			<input type="hidden" name="fieldname[3]" value="thutu" title="Field name">
			<input type="hidden" name="fieldcheck[4]" value="4">
			<input type="hidden" name="fieldname[4]" value="kho" title="Field name">
			<input type="hidden" name="fieldcheck[5]" value="5">
			<input type="hidden" name="fieldname[5]" value="category" title="Field name">
			<input type="hidden" name="fieldcheck[6]" value="6">
			<input type="hidden" name="fieldname[6]" value="taikhoan" title="Field name">
			<input type="hidden" name="kho" value="{$_POST['kho']}">
			<input type="hidden" name="category" value="{$_GET['CURMOD']}">
		</td>
HEADER;
	//}
}

	
	echo "</tr>";
	
	foreach( $data as $i => $row ) { // Output data and prepare SQL instructions
		
				
		if ( $i == 0 && $_POST['useheaders'] )
		continue;
		
		echo "<tr bgcolor=\"#ffffff\">";
		
		for ( $j = 0; $j <= $ws['max_col']; $j++ ) {
		
			$cell = get ( $exc, $row[$j] );
			echo "<td>$cell</td>";
			
					
		}

		echo "</tr>";
		$i++;
	}
	
	if ( empty ( $db_table ) )
		$db_table = "Table1";
echo <<<FORM2
	
	</table><br>
	<table align="center" width="390">
	<tr><!--<td>Table name:</td>--><td>&nbsp;<input type="hidden" name="db_table" value="product"></td></tr>
	<!--<tr><td>Chèn lên bảng hiện có:</td><td><input type="checkbox" name="db_drop" checked></td></tr>-->
	<tr><td colspan="2">
	
	Lưu ý có những sự không tương thích giữa các truờng dữ liệu hiện tại và các trường trong data có thể phát sinh lỗi!</td></tr>
	<input type="hidden" size=30 name="db_host" value="$db_host">
	<input type="hidden" size=30 name="db_name" value="$db_name">
	<input type="hidden" size=30 name="db_user" value="$db_user">
	<input type="hidden" size=30 name="db_pass" value="$db_pass">
	<input type="hidden" name="excel_file" value="$excel_file">
	<input type="hidden" name="step" value="2">
	&nbsp;<input type="submit" name="submit" value="Thực hiện"></td></tr>
	</form>
	</table>
	<br>&nbsp;
<div align="right">
</div>
FORM2;

} 



function prepareTableData ( $exc, $ws, $fieldcheck, $fieldname,$kho,$category ) {
	
			
	$data = $ws['cell'];

	foreach( $data as $i => $row ) { // Output data and prepare SQL instructions
		
				
		if ( $i == 0 && $_POST['useheaders'] )
		continue;
		
		$SQL[$i] = "";
		
		for ( $j = 0; $j <= $ws['max_col']+5; $j++ ) {
			if ( isset($fieldcheck[$j]) ) {
				if($j==3){
				$SQL[$i] .= 'thutu';
				$SQL[$i] .= "=\"";
				$SQL[$i] .= '1';
				$SQL[$i] .= "\"";
				$SQL[$i] .= ",";
				}
				elseif($j==4){
				$SQL[$i] .= 'kho';
				$SQL[$i] .= "=\"";
				$SQL[$i] .= $kho;
				$SQL[$i] .= "\"";
				$SQL[$i] .= ",";
				}elseif($j==5){
				$SQL[$i] .= 'category';
				$SQL[$i] .= "=\"";
				$SQL[$i] .= $category;
				$SQL[$i] .= "\"";
				$SQL[$i] .= ",";
				}elseif($j==6){
				$SQL[$i] .= 'taikhoan';
				$SQL[$i] .= "=\"";
				$SQL[$i] .= '0';
				$SQL[$i] .= "\"";
				$SQL[$i] .= ",";
				}else{
				$SQL[$i] .= $fieldname[$j];
				$SQL[$i] .= "=\"";
				$SQL[$i] .= addslashes ( get ( $exc, $row[$j] ) );
				$SQL[$i] .= "\"";
				$SQL[$i] .= ",";
				}
			}
			
		}
		
		$SQL[$i] = rtrim($SQL[$i], ',');
		
		$i++;
	}
	return $SQL;	
			
} 

?>