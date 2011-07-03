<?
if(!$_PAGE_VALID)
{
	exit();
}

if($isLogin)
{
	redirect("$_URL_BASE/");
}
if(validGetVar($value))
{
	$conds = "member_activecode='".$value."'";
	$sql->set_query("vot_member", "member_email", $conds);
	if($sql->set_farray())
	{
		$insert = "member_view = 1";
		$where  = "member_activecode='".$value."'";
		$sql->update("vot_member", $insert, $where);
		
		$isActive = 1;
		
		$sql = new mysql;
		$conds = "member_activecode='".$value."' AND member_view=1";
		$sql->set_query("vot_member", "*", $conds);
		if($sql->set_farray())
		{
			$isLogin = 1;
			
			$ses_mem_email = $sql->farray["member_email"];
			$ses_mem_name = $sql->farray["member_name"];
			$ses_mem_org = $sql->farray["member_org"];
			$ses_mem_add = $sql->farray["member_add"];
			$ses_mem_tel = $sql->farray["member_tel"];
						
			_SESSION_REGISTER('isLogin');
			_SESSION_REGISTER('ses_mem_email');
			_SESSION_REGISTER('ses_mem_name');
			_SESSION_REGISTER('ses_mem_org');
			_SESSION_REGISTER('ses_mem_add');
			_SESSION_REGISTER('ses_mem_tel');
			
			$contentDetail = $define["var_taikhoandaduockichhoat"];
		}
	}
}
require_once("$_HTML_DIR/center_active_page.php");
?>