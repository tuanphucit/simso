<?	
session_cache_expire(480);
session_start();

include_once("../../myadmin/includes/config.php");
include_once("../../myadmin/includes/mysql.php");
include_once("../../includes/global.php");
$subPageTitle = $define["var_timkiem"];
		$contentTitle = NULL;
		$contentDetail = NULL;
		$listShowItemId = $itemId;
		$froms = "vot_news";
		$conds = "news_id='".$itemId."'";
		$sql->set_query($froms, "*", $conds);
		if($sql->set_farray())
		{
			$contentTitle = $sql->farray["news"."_name"];
			$contentDate = outDateStr($sql->farray["news"."_date"]);
			$contentImage = $sql->farray["news"."_image"];
			if(is_file("$_ROOT_PATH/$contentImage"))
			{
				$contentDetail .= '<img src="'."$_URL_BASE/$contentImage".'" align="left" style="margin:4px 7px 0px 0px">';
			}
			$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["news"."_shortdes"].'</p>';
			$contentDetail .= '<p id="itemContentDes" style="text-align:justify">'.$sql->farray["news"."_detail"].'</p>';
			$visited = $sql->farray["news"."_visited"];
			$insert = "news_visited = news_visited+1";
			$where = "news_id='".$itemId."'";
			$sql->update("vot_news", $insert, $where);
		}
//require_once("$_HTML_DIR/center_content_detail.php");
require_once("$_HTML_DIR/begin_html_page.php");
require_once("$_HTML_DIR/body_search_detail.php");
require_once("$_HTML_DIR/end_html_page.php");

?>		