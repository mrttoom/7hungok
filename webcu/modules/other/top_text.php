<div class="bg_search1_tin">
                	<marquee onMouseOver="this.stop()" onMouseOut="this.start()" direction="left" scrollamount="1" scrolldelay="70" style="width:auto;" height="20px">
                	<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `news` WHERE lang="'.$current_lang.'"  ORDER BY id desc';
	$database->setQuery($query);
	$database->query();
	$real_estate_news = $database->loadResult();
	if($real_estate_news)
	foreach($real_estate_news as $one)
	{
		echo '<img src="'.SITE_PATH.'themes/images/icon-news.gif" /><a href="'.generate_url('news_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id'])).'">'.$one['title'].'</a>';
		
	}
?>
                    </marquee>
                </div>