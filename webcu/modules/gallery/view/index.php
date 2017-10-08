<?php
	global $database;
	global $current_lang;
		

	$condition = '';
	if($category_current)
		$condition = ' and category_id="'.$category_current['id'].'"';
	$search_text = urldecode(getParam('search_text'));
	if($search_text)
		$condition .= ' and (`title` like "%'.$search_text.'%" or `brief` like "%'.$search_text.'%") ';
	
	$totalRows = 0;
	$itemPerPage = 21;
	$numPageShow = 10;
	
	$totalRows = $database->getNumRows('gallery', ' `lang`= "'.$current_lang.'" '.$condition);
	
	$curPg = getParam('curPg', 'int', 1);
	
	$query = 'SELECT * FROM `gallery` where `lang`= "'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	
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
	<a href="<?php echo generate_url('gallery') ?>"><?php echo _GALLERY ?></a>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>
<div style="border:1px solid #CCCCCC;">
<div style="clear:both"></div>
<?php
	if($all_news)
	{
		foreach($all_news as $one)
		{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$news_url = generate_url('gallery_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id']));
			$image_src = get_image($one, 'small', 'gallery');
			$image_large_src = get_image($one, 'large', 'gallery');
			
			echo '<div id="lvkd1">
                     <a href="#" onclick="MM_openBrWindow(\''.$image_large_src.'\',\'\', \'scrollbars=no,width=750,height=500\')">
							<div class="lvkd11" style="background:url('.$image_src.')">
                                    <div class="lvkd_text1">'.$title.'</div>
                            </div>
					</a>
                  </div>';	

		}
		if($itemPerPage < $totalRows)
		{
			$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
			echo '<div style="margin:5px; clear:both;"><div class="phan_trang">'.$pagging.'</div></div>';
		}
	}else{
		echo '<div class="content_center">
					<div class="content_center_heading"><b>'._NO_NEWS_CATE.'</b></div></div>';
	}
		
?>
							 
	<div style="clear:both"></div>
</div>
<script language="JavaScript">
	function MM_openBrWindow(theURL,winName,features)
	{
		window.open(theURL,winName,features);
	}
</script>