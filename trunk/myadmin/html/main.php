<?
$item = isset($item) ? $item : NULL;
$action = isset($action) ? $action : NULL;
$sql = new mysql();
$conds = "language_id='".$LANG."' AND html_id='".$item."'";
switch($action)
{
	case "update":
		$values  = "html_name='".$pageName."',html_detail='".$pageContent."'";
		$sql->update("vot_html",$values,$conds);
		if($item == 'footer')
		{
			include_once("includes/create_bottom.php");				
		}				
		redirect("index.php?module=html&item=$item");
		exit();
		break;
	default:
		$sql->set_query("vot_html","*",$conds);
		if($sql->set_farray())
		{
			$pageName = $sql->farray["html_name"];
			$pageContent = $sql->farray["html_detail"];
		
			include $config["FCKeditor_path"]."fckeditor.php";
			
			$sBasePath  = $config["FCKeditor_path"];
			$oFCKeditor = new FCKeditor("pageContent");
			$oFCKeditor->BasePath	= $sBasePath;
			$oFCKeditor->Value		= $pageContent;
			$oFCKeditor->Width	= "100%";
			$oFCKeditor->Height	= 450;
			
			include_once("js.html");
			include_once("html_form.php");
		}
}
?>