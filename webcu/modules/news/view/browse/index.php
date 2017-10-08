<?php
	global $database;
	global $current_lang;
	
	$query = 'SELECT * FROM `news_category` where `lang`= "'.$current_lang.'" and id = "'.getParam('category_id', 'id', 0).'"';
	$database->setQuery($query);
	$category_current = $database->loadRow();

	$condition = '';
	if($category_current)
		$condition = ' and category_id="'.$category_current['id'].'"';
	$search_text = urldecode(getParam('search_text'));
	if($search_text)
		$condition .= ' and (`title` like "%'.$search_text.'%" or `brief` like "%'.$search_text.'%") ';
	
	$totalRows = 0;
	$itemPerPage = 5;
	$numPageShow = 10;
	
	$totalRows = $database->getNumRows('news', ' `lang`= "'.$current_lang.'" '.$condition);
	
	$curPg = getParam('curPg', 'int', 1);
	
	$query = 'SELECT * FROM `news` where `lang`= "'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	
	$database->setQuery($query);
	$all_news = $database->loadResult();
	
	if($database->getErrorNum()){
		echo $database->stderr();
		return;
	}
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	<a href="<?php echo generate_url('news') ?>"><?php echo _NEWS ?></a><?php if($category_current) echo ' &raquo; '.$category_current['title'];?>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>
<?php
	if($all_news)
	{
		foreach($all_news as $one)
		{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$brief = hightlight_keyword(string_strip($one['brief']), $search_text);
			$news_url = generate_url('news_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			echo '<div class="content_center">
					<div class="content_center_heading"><a href="'.$news_url.'">'.$title.'</a></div>
						<div class="date_time_news_icon"><div class="date_time_news">';
						echo _UPDATE.' '.date("j - n - Y, g:i A", $one['time_update']).'</div></div>
						<div class="content_news">';	
						
			$image_src = get_image($one, 'small', 'news');
			if($image_src)
				echo '<div class="img_news"><a href="'.$news_url.'"><img src="'.$image_src.'" alt="'.$title.'" title="'.$title.'"/></a></div>'.$brief.' ';
			else
				echo $brief;	
			echo '<div style="float:right">
				<a href="'.$news_url.'">'._READ_MORE.'...</a> </div>
					<div style="clear:both"></div>
				</div>
		</div>
		<div style="clear:both"></div>
	</div>';	

		}
		if($itemPerPage < $totalRows)
		{
			$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
			echo '<div style="border:1px #86c1e3 solid; background:#e3f4fe; margin-top:10px; margin-bottom:10px; padding:5px; text-align:left; font-weight:bold;">'.$pagging.'</div>';
		}
	}else{
		echo '<div class="content_center">
					<div class="content_center_heading"><b>'._NO_NEWS_CATE.'</b></div></div>';
	}
	
	
?>