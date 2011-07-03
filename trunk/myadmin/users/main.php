<?
$CURID = isset($CURID) ? $CURID : NULL;
$action = isset($action) ? $action : NULL;

$sql = new mysql();

switch($action)
{
	case 'delete':
		
		@$chon = ",$chon";
		$chon = str_replace (",$usrid,",",",$chon);
		$chon = substr($chon,1);
		$chon = str_replace (",","','",$chon);
		$sql->set_list_tables();
		$sql->delete("vot_user","user_id",$chon);
		redirect("index.php?module=users&curPg=$curPg");			
		break;			
		
	case 'update':
	
		if($isSave!=NULL)
		{
			redirect("index.php?module=users&curPg=$curPg");
		}
			
		$str = "[$#%?&!^']";
		if(ereg($str,$USER)||ereg($str,$PWD)) exit();
		if(strlen($USER)>20) $USER = substr($USER,0,20);
		if(strlen($PWD)>15) $PWD = substr($PWD,0,15);
		if(($CURID!="")&&($isSave==NULL))
		{
			$values  = "user_name='".$USER."',user_fullname='".$FNAME."',user_perm='".$PERM."'";
			if($PWD!=NULL) $values .= ",user_pwd='".md5($PWD)."'";
			$sql->update("vot_user",$values,"user_id=$CURID");					
			$isSave = "Y";
			_SESSION_REGISTER("isSave");
			if($CURID==$usrid) $back = "logout.php";
			else $back = "index.php?module=users&CURID=$CURID&curPg=$curPg";
			redirect($back);
		}
		elseif($isSave==NULL)
		{
			$sql->set_query("vot_user","user_id","user_name='".$USER."'");
			if($sql->nRows>0)
			{
				echo '<script>alert("username nay da co!\nBan vui long nhap username khac.")</script>';
				echo '<script>history.go(-1)</script>';
				exit();
			}
			$fields = "user_name,user_pwd,user_fullname,user_perm";
			$values  = "'".$USER."','".md5($PWD)."','".$FNAME."','".$PERM."'";
			$sql->insert("vot_user",$fields,$values);
			$isSave = "Y";	
			_SESSION_REGISTER("isSave");
			redirect("index.php?module=users&curPg=$curPg");			
		}
		break;
		
	default:
	
		$isSave = NULL;
		_SESSION_REGISTER("isSave");
		
		$opt = new option();
		$sql->set_query("vot_user");
		$tRows = $sql->nRows;
		
		$maxPages = 3; $maxRows = 10;

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
		include_once("includes/paging.php");
		include_once("listusers.php");
		include_once("js.html");

		break;			
}
?>