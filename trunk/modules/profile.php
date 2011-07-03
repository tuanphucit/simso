<?
if(!$_PAGE_VALID)
{
	exit();
}

if(!$isLogin)
{
	redirect("$_URL_BASE/");
}

$contentDetail = NULL;

if($doAction == 'changeInfo')
{	
	if(!$isSent)
	{
		$insert = "member_name='".insertData($fullname)."',member_org='".insertData($organization)."',member_add='".insertData($address)."',member_tel='".$tel."'";
		$where = "member_email='".$ses_mem_email."'";
		$sql->update("vot_member", $insert, $where);
		
		$sql = new mysql;
		
		$isSent = 1;
		_SESSION_REGISTER("isSent");
	}
	$changeInfoMess = $define["var_thongtindaduocthaydoi"];
}
elseif($doAction == 'changePwd')
{
	if(!$isSent)
	{
		$insert = "member_pwd='".md5($newpwd)."'";
		$where = "member_email='".$ses_mem_email."'";
		$sql->update("vot_member", $insert, $where);
		
		$sql = new mysql;
		
		$isSent = 1;
		_SESSION_REGISTER("isSent");
	}
	$changePwdMess = $define["var_matkhaudaduocthaydoi"];
}
else
{
	$isSent = 0;
	_SESSION_REGISTER("isSent");
}

require_once("$_HTML_DIR/center_profile_page.php");
?>