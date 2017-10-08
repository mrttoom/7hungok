<?php
	global $database;
	global $current_lang;
	
	
	$totalRows = 0;
	$itemPerPage = 5;
	$numPageShow = 10;
	
	$totalRows = $database->getNumRows('product', ' `lang`= "'.$current_lang.'" ');
	
	$curPg = getParam('curPg', 'int', 1);
	
	$query = 'SELECT * FROM `product` where `lang`= "'.$current_lang.'" ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	
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
	<?php echo _PRODUCT ?>
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
			$news_url = generate_url('product_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			echo '<div class="content_center">
					<div class="content_center_heading"><a href="'.$news_url.'">'.$title.'</a></div>
						<div class="date_time_news_icon"><div class="date_time_news">';
						echo _UPDATE.' '.date("j - n - Y, g:i A", $one['time_update']).'</div></div>
						<div class="content_news">';	
						
			$image_src = get_image($one, 'small', 'product');
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