<?
class mysql //SQL query class
{
  var $dbcon, $result, $nCols, $nRows, $dbname;
	var $farray = array();
	var $list_tables = array();
	var $relate_tables = array(array(),array());
	var $relate = array(array(),array());
	var $data = array(array(),array());
	var $list_fields = array();
        
  function mysql($DB_HOST = NULL, $DB_USER = NULL, $DB_PWD = NULL, $DB_NAME = NULL)
  {
		global $config;
		if($DB_HOST == NULL) $DB_HOST = $config["db_host"];
		if($DB_USER == NULL) $DB_USER = $config["db_user"];
		if($DB_PWD == NULL)  $DB_PWD = $config["db_pwd"];
		if($DB_NAME == NULL) $DB_NAME = $config["db_name"];
    @$this->dbcon = mysql_connect ($DB_HOST,$DB_USER,$DB_PWD);// or die($config["db_error"]);
		$this->dbname = $DB_NAME;
		if($this->dbcon) return mysql_select_db($this->dbname,$this->dbcon);
		else return false;
  }
  
	function dbcon_close()
	{
		mysql_close($this->dbcon);
	}
	
  function set_query($tblName, $fieldNames = "*", $where = NULL, $others = NULL)
  {
    $sql = "SELECT $fieldNames FROM $tblName";
    if($where!=NULL) $sql .= " WHERE $where";
    if($others!=NULL) $sql.= " $others";
  if ($fieldNames == "DISTINCT A.sosim"){
  		echo "
  			<script>
  				alert(\"'{$sql}'\");
  			</script>
  		";
  	}
  	if ($others == 2){
  		die($sql);
  	}
    $this->result = mysql_query($sql,$this->dbcon);	
		$this->nRows 	= mysql_num_rows($this->result);
		$this->nCols 	= mysql_num_fields($this->result);
  }

	function set_farray()
	{
		$this->farray = mysql_fetch_array($this->result);
		return $this->farray;
	}
	
	function getmaxid($tblname, $fid, $wh = NULL, $others = NULL)
	{
		$result = NULL;
		$fid = "MAX($fid)";
		$this->set_query($tblname, $fid, $wh, $others);
		if($this->nRows > 0 && $this->set_farray())
		{
			$result = $this->farray[$fid];
		}
		return $result;
	}

	function set_list_tables()
	{
		$sql = 'SHOW TABLES FROM '.$this->dbname;
		$result = mysql_query($sql);

		if (!$result) 
		{
   		echo "DB Error, could not list tables\n";
   		echo 'MySQL Error: '.mysql_error();
   		exit;
		}
		$i = 0;
		while ($row = mysql_fetch_row($result)) 
		{
   		$this->list_tables[$i] = $row[0];
			$i++;
		}
		mysql_free_result($result);	
	}

	function search_pri_key($tblname)
	{
		$key = 'primary_key';
		$name = '';
		$this->set_query($tblname);
		for($i=0;$i<$this->nCols;$i++)
		{
			$flags = mysql_field_flags($this->result, $i);
			if(strstr($flags,$key))
				$name  = mysql_field_name($this->result, $i);			
		}
		return $name;
	}
	
	function search_relate_tables($tblname)
	{		
		$t = array();
		$count = 0;
		$pri_key = $this->search_pri_key($tblname);
		for($i=0;$i<sizeof($this->list_tables);$i++)
			if($this->list_tables[$i]!=$tblname)
			{
				$p_key = $this->search_pri_key($this->list_tables[$i]);					
				for($j=0;$j<$this->nCols;$j++)
				{
					$fname = mysql_field_name($this->result, $j);
					if(($fname!=$p_key)&&($fname==$pri_key))
					{
						$t[$count] = $this->list_tables[$i];
						$count++;
					}
				}
			}
		return $t;
	}
	
	function all_relate_tables($listtbl,$n)
	{
		if($n<1) $n=1;
		$t = array();
		$t[$n] = array();
		if(!is_array($listtbl)) settype($listtbl,"array");		
		for($i=0;$i<sizeof($listtbl);$i++)
		{
			$tpl = $this->search_relate_tables($listtbl[$i]);
			if(!empty($tpl)) $t[$n] = array_merge($tpl,$t[$n]);
		}
		
		if(!empty($t[$n]))
		{
			$this->relate_tables[$n] = $t[$n];
			$this->all_relate_tables($t[$n],$n+1);
		}
		$this->relate_tables[0] = $listtbl;
	}
	
	function search_up($tblname)
	{
		$arr = array();
		$count = 0;
		$arr[$count] = $tblname;
		$size = sizeof($this->relate_tables);
		for($i=0;$i<$size;$i++)
		{
			for($j=0;$j<sizeof($this->relate_tables[$i]);$j++)
				if($tblname==$this->relate_tables[$i][$j]) $deg = $i;
		}
		for($i=$deg-1;$i>=0;$i--)
			for($j=0;$j<sizeof($this->relate_tables[$i]);$j++)
			{
				$pri_key = $this->search_pri_key($this->relate_tables[$i][$j]);
				$this->set_query($arr[$count]);
				for($k=0;$k<$this->nCols;$k++)
				{
					$fname = mysql_field_name($this->result,$k);
					if($fname==$pri_key)
					{
						$count++;
						$arr[$count] = $this->relate_tables[$i][$j];
					}
				}			
			}
		return $arr;
	}
	
	function delFile($file)
	{
		if(file_exists($file)) @$ok = unlink($file);
		return $ok;
	}
	
	function up_del($list_tbl,$field='',$values='')
	{
		$n = sizeof($list_tbl);
		$field_contain_file = array('img','image','file','thumb','download','flag','adpdf','msdoc');
		for($i=$n-1;$i>=0;$i--)
		{
			if($i==$n-1)
			{
				$v = $values;
				$se_key = $field;
			}
			else
			{
				$se_key = $this->search_pri_key($list_tbl[$i+1]);
			}
			$key = $this->search_pri_key($list_tbl[$i]);
			$wh = $list_tbl[$i].".".$se_key." IN ('".$v."')";
			$v = '';
			$count = 0;
			$fimg = array();
			$this->set_query($list_tbl[$i],'*',$wh);
			for($j=0;$j<$this->nCols;$j++)
			{
				$fname = mysql_field_name($this->result,$j);
				for($fcf=0;$fcf<sizeof($field_contain_file);$fcf++)
					if(strstr(strtolower($fname),$field_contain_file[$fcf]))
					{
						$fimg[$count] = $fname;
						$count++;
					}
			}
			while($this->set_farray())
			{
				$v .= $this->farray[$key].',';
				for($j=0;$j<sizeof($fimg);$j++)
				{
					$imgPath = "../".$this->farray[$fimg[$j]];
					if(file_exists($imgPath))
					{
						$thumb = dirname($imgPath)."/ecom".basename($imgPath);
						$this->delFile($imgPath);
					}
				}
			}
			$v = substr($v,0,strlen($v)-1);
			$v = str_replace(",","','",$v);
		}
		
    $sql = "DELETE FROM ".$list_tbl[0]." WHERE ".$wh;
		$regs = mysql_query($sql,$this->dbcon);
		return $sql;
	}
	
	/*luckymancvp
	 * 
	 */
	function deleteInOneTable($tblname,$field='',$values=''){
		$sql = "DELETE FROM $tblname WHERE $field = '$values'";
		mysql_query($sql,$this->dbcon);
	}
	
  function delete($tblname,$field='',$values='')
  {
		$str='';
		$count = 0;
		$this->set_query($tblname);
		for($i=0;$i<$this->nCols;$i++)
		{
			$fname = mysql_field_name($this->result,$i);
			if($fname==$field) $count++;
		}
		if($count==0) echo 'Check name of field again!';
		else
		{
			$this->all_relate_tables($tblname,0);
			$n = sizeof($this->relate_tables);
			for($i=$n-1;$i>=0;$i--)
				for($j=0;$j<sizeof($this->relate_tables[$i]);$j++)
				{
					$this->mysql();
					$list = $this->search_up($this->relate_tables[$i][$j]);
					$str .= $this->up_del($list,$field,$values).'<br><br>';
				}
		}
		return true;
  }
  
  function insert($tblName,$fieldNames,$values)
  {
    $sql = "INSERT INTO $tblName($fieldNames) VALUES($values)";
		$regs = mysql_query($sql,$this->dbcon);
    $this->dbcon_close();
  }

  function update($tblName,$insert,$where)
  {
    $sql = "UPDATE $tblName  SET $insert WHERE $where";
		$regs = mysql_query($sql,$this->dbcon);
    $this->dbcon_close();
  }
	
	function set_list_fields()
	{
		if($this->nCols<1) return false;
		for($i=0;$i<$this->nCols;$i++)
		{
			$this->list_fields[$i] = mysql_field_name($this->result,$i);
		}
		return true;
	}
	
	function set_dataPop()
	{
		$nRs = $this->nRows;
		$nCs = $this->nCols;
		$r=0;
		if(($nRs>0)&&($nCs>0))
		{
			while(($row=mysql_fetch_row($this->result))&&($r<$nRs))
			{
				for($c=0;$c<$nCs;$c++) $this->data[$r][$c] = $row[$c];					
				$r++;
			}
			return true;
		}
		else return false;
	}
}

//Options Class
class option extends mysql
{
	function option($DB_HOST=NULL,$DB_USER=NULL,$DB_PWD=NULL,$DB_NAME=NULL)
	{
		$this->mysql($DB_HOST,$DB_USER,$DB_PWD,$DB_NAME);
	}
	
	function options($label=NULL,$tblname,$fval,$ftxt,$wh=NULL,$others=NULL)
	{
		$field = "$fval AS No, $ftxt AS Name";
		$this->set_query($tblname,$field,$wh,$others);
		
		$strOpt = NULL;
		if($label!=NULL)
		{
			$strOpt .= "<option value=\"\"  checked>";
			$strOpt .= "--$label--</option>";
		}
		
		while ($this->set_farray())
		{
			$name = $this->farray["Name"];
			if($name!="")
			{
				$strOpt .="<option value=\"" ;
				$strOpt .= $this->farray["No"]."\">";
				$strOpt .= $name."</option>";
			}
		}
		
		return $strOpt;
	}
	
	function optionselected($item=NULL,$label=NULL,$tblname,$fval,$ftxt,$wh=NULL,$others=NULL)
	{
		$field = "$fval AS No, $ftxt AS Name";
		$this->set_query($tblname,$field,$wh,$others);

		$strOpt = NULL;
		if($label!=NULL)
		{
			$strOpt .= "<option value=\"\"  checked>";
			$strOpt .= " $label </option>";
		}
		
		while ($this->set_farray())
		{
			$name = $this->farray["Name"];
			if($name!="")
			{
				$strOpt .= "<option value=\"" ;
				$strOpt .= $this->farray["No"]."\"";
				if($this->farray["No"]==$item)	$strOpt .=" selected  ";
				$strOpt .= ">".$name."</option>";
			}
		}
		
		return $strOpt;
	}
	
	function optionvalue($tblname,$ftxt,$wh=NULL,$others=NULL)
	{
		$field = "$ftxt AS Name";
		$this->set_query($tblname,$field,$wh,$others);
		$strOpt = "";		
		
		if($this->nRows>0)
		{
			$this->set_farray();
			$strOpt = $this->farray["Name"];
		}
		return $strOpt;
	}

}
?>