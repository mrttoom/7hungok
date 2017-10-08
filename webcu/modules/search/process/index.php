<?php
global $database;
global $current_lang;
$ok = 0;
$search_text = urldecode(getParam('keyword'));
	
	if($search_text)
		$condition .= ' and (`title` like "%'.$search_text.'%" or `brief` like "%'.$search_text.'%" or `content` like "%'.$search_text.'%") ';
	
	$totalRows = 0;
	$itemPerPage = 5;
	$numPageShow = 10;
	
	$totalRows = $database->getNumRows('product', ' `lang`= "'.$current_lang.'" '.$condition);
	
	$curPg = getParam('curPg', 'int', 1);
	
	$query = 'SELECT * FROM `product` where `lang`= "'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	
	$database->setQuery($query);
	$all_news = $database->loadResult();
	
	if($database->getErrorNum()){
		echo $database->stderr();
		return;
	}

	if($all_news)
	{
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
		foreach($all_news as $one)
		{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$brief = hightlight_keyword(string_strip($one['brief']), $search_text);
			$news_url = generate_url('product_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			echo '<div id="news123">
					<div class="content_center">
						<div class="content_center_heading"><a href="'.$news_url.'">'.$title.'</a></div>
						<div class="date_time_news_icon"><div class="date_time_news">';
						echo _UPDATE.' '.date("j - n - Y, g:i A", $one['time_update']).'</div></div><div class="content_news">';	
						
			$image_src = get_image($one, 'small', 'project');
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
	}

?>
<?php
global $database;
global $current_lang;
$ok = 0;
$search_text = urldecode(getParam('keyword'));
	
	if($search_text)
		$condition .= ' and (`title` like "%'.$search_text.'%" or `brief` like "%'.$search_text.'%" or `content` like "%'.$search_text.'%") ';
	
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

	if($all_news)
	{
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	<?php echo _NEWS ?>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>

<?php
		foreach($all_news as $one)
		{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$brief = hightlight_keyword(string_strip($one['brief']), $search_text);
			$news_url = generate_url('news_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			echo '<div id="news123">
					<div class="content_center">
						<div class="content_center_heading"><a href="'.$news_url.'">'.$title.'</a></div>
						<div class="date_time_news_icon"><div class="date_time_news">';
						echo _UPDATE.' '.date("j - n - Y, g:i A", $one['time_update']).'</div></div><div class="content_news">';	
						
			$image_src = get_image($one, 'small', 'project');
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
	}

?>
<?php
global $database;
global $current_lang;
$ok = 0;
$search_text = urldecode(getParam('keyword'));
	
	if($search_text)
		$condition .= ' and (`title` like "%'.$search_text.'%" or `brief` like "%'.$search_text.'%" or `content` like "%'.$search_text.'%") ';
	
	$totalRows = 0;
	$itemPerPage = 5;
	$numPageShow = 10;
	
	$totalRows = $database->getNumRows('channel_distribute', ' `lang`= "'.$current_lang.'" '.$condition);
	
	$curPg = getParam('curPg', 'int', 1);
	
	$query = 'SELECT * FROM `channel_distribute` where `lang`= "'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	
	$database->setQuery($query);
	$all_news = $database->loadResult();
	
	if($database->getErrorNum()){
		echo $database->stderr();
		return;
	}

	if($all_news)
	{
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	<?php echo _CHANNEL_DISTRIBUTE ?>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>

<?php
		foreach($all_news as $one)
		{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$brief = hightlight_keyword(string_strip($one['brief']), $search_text);
			$news_url = generate_url('channel_distribute_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			echo '<div id="news123">
					<div class="content_center">
						<div class="content_center_heading"><a href="'.$news_url.'">'.$title.'</a></div>
						<div class="date_time_news_icon"><div class="date_time_news">';
						echo _UPDATE.' '.date("j - n - Y, g:i A", $one['time_update']).'</div></div><div class="content_news">';	
						
			$image_src = get_image($one, 'small', 'channel_distribute');
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
	}

?>
<?php
global $database;
global $current_lang;
$ok = 0;
$search_text = urldecode(getParam('keyword'));
	
	if($search_text)
		$condition .= ' and (`title` like "%'.$search_text.'%" or `brief` like "%'.$search_text.'%" or `content` like "%'.$search_text.'%") ';
	
	$totalRows = 0;
	$itemPerPage = 5;
	$numPageShow = 10;
	
	$totalRows = $database->getNumRows('economic_relations', ' `lang`= "'.$current_lang.'" '.$condition);
	
	$curPg = getParam('curPg', 'int', 1);
	
	$query = 'SELECT * FROM `economic_relations` where `lang`= "'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	
	$database->setQuery($query);
	$all_news = $database->loadResult();
	
	if($database->getErrorNum()){
		echo $database->stderr();
		return;
	}

	if($all_news)
	{
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	<?php echo _ECONOMIC_RELATIONS ?>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>

<?php
		foreach($all_news as $one)
		{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$brief = hightlight_keyword(string_strip($one['brief']), $search_text);
			$news_url = generate_url('economic_relations_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			echo '<div id="news123">
					<div class="content_center">
						<div class="content_center_heading"><a href="'.$news_url.'">'.$title.'</a></div>
						<div class="date_time_news_icon"><div class="date_time_news">';
						echo _UPDATE.' '.date("j - n - Y, g:i A", $one['time_update']).'</div></div><div class="content_news">';	
						
			$image_src = get_image($one, 'small', 'economic_relations');
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
	}

?>

<?php
global $database;
global $current_lang;
$ok = 0;
$search_text = urldecode(getParam('keyword'));
	
	if($search_text)
		$condition .= ' and (`title` like "%'.$search_text.'%" or `brief` like "%'.$search_text.'%" or `content` like "%'.$search_text.'%") ';
	
	$totalRows = 0;
	$itemPerPage = 5;
	$numPageShow = 10;
	
	$totalRows = $database->getNumRows('internal_company', ' `lang`= "'.$current_lang.'" '.$condition);
	
	$curPg = getParam('curPg', 'int', 1);
	
	$query = 'SELECT * FROM `internal_company` where `lang`= "'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	
	$database->setQuery($query);
	$all_news = $database->loadResult();
	
	if($database->getErrorNum()){
		echo $database->stderr();
		return;
	}

	if($all_news)
	{
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	<?php echo _INTERNAL_COMPANY ?>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>

<?php
		foreach($all_news as $one)
		{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$brief = hightlight_keyword(string_strip($one['brief']), $search_text);
			$news_url = generate_url('internal_company_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			echo '<div id="news123">
					<div class="content_center">
						<div class="content_center_heading"><a href="'.$news_url.'">'.$title.'</a></div>
						<div class="date_time_news_icon"><div class="date_time_news">';
						echo _UPDATE.' '.date("j - n - Y, g:i A", $one['time_update']).'</div></div><div class="content_news">';	
						
			$image_src = get_image($one, 'small', 'economic_relations');
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
	}

?>