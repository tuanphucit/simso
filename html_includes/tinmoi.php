<div id="middle-right3"><!-- phần tin tức -->
                    <p class="title">Tin khuyến mại</p>
<?
if(!$_PAGE_VALID)
{
	exit();
}
$sql = new mysql;
$froms = "vot_news";
$conds = "language_id='".$lang."' AND news_view=1";
$others = "ORDER BY news_date DESC,news_visited DESC LIMIT 5";
$sql->set_query($froms, "*", $conds, $others);
$count =0;
while($sql->set_farray())
{
	$count ++;
	
	$infoId = $sql->farray["news_id"];
	$modId = $sql->farray["modules_id"];
	$infoName = $sql->farray["news_name"];
	$infoVisited = $sql->farray["news_visited"];
	$linkto = "$_URL_BASE/index.php/$modId/$infoId/".str_replace(" ", "_", $sql->farray["news_name"]);
	//$listnew .= "<div class=\"newnews\"><a  href=\"$linkto\">* $infoName</a></div>";
	//$listnew .= "	<div><img src=\"$_IMG_DIR/line_newnews.jpg\" border=\"0\" style=\"margin:3px 0px 7px 0px\"></div>";
	if($count < 5)
	{
?>	<div class="news-box">
                       
                       
                        <a href="<?php echo $linkto?>">*<?php echo $infoName ?></a>
                       
                        
    
    </div>   
	
<?php
	}
}
 ?>	

  </div>