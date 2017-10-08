<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * from channel_distribute_category where lang="'.$current_lang.'" and id= "'.getParam('category_id', 'int', 0).'"';
	$database->setQuery($query);
	$database->query();
	$current_news_cat = $database->loadRow();
	if(!$current_news_cat)
	{
		replace_location('channel_distribute');
		return;
	}
	$query = 'SELECT * from channel_distribute where lang="'.$current_lang.'" and id= "'.getParam('id', 'int', 0).'"';
	$database->setQuery($query);
	$database->query();
	$row = $database->loadRow();
	if(!$row)
	{
		replace_location('channel_distribute');
		return;
	}
	$query = 'SELECT * FROM `channel_distribute` WHERE lang="'.$current_lang.'" and category_id="'.$row['category_id'].'" and id <"'.getParam('id', 'int', 0).'" order by id desc limit 0,5';
	$database->setQuery($query);
	$other_news = $database->loadResult();
	if($other_news)
	{
		foreach($other_news as $one)
		{			
			$other_news_html .= '<img src="'.SITE_PATH.'themes/images/icon-news.gif" /><a style="padding-left:5px" href="'.generate_url('channel_distribute_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id'])).'">'.string_strip($one['title']).'&nbsp;<b>('.date('d/m', $one['time_create']).')</b></a><br />';						
		}
	}
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	<a href="<?php echo generate_url('channel_distribute') ?>"><?php echo _CHANNEL_DISTRIBUTE ?></a>
		<?php if($row['category_id']) echo ' &raquo; <a href="'.generate_url('news', array('category_id'=>$current_news_cat['id'])).'">'.$current_news_cat['title'].'</a>';?>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>

<?php 
	$image_file = get_image($row, 'large', 'channel_distribute');

	echo '<div class="content_center">
				<div class="content_center_heading">'.$row['title'].'</div>
				<div class="date_time_news_icon"><div class="date_time_news">'._UPDATE.' '.date("j - n - Y, g:i A", $row['time_update']).'</div></div><div class="content_news">';
	if($image_file) 
		echo '<div class="img_news"><img src="'.$image_file.'" alt="'.$row['title'].'" title="'.$row['title'].'"/></a></div>';
		echo '<b>'.$row['brief'].'</b>'.$row['content'];
		
		echo'<div style="clear:both"></div>
				</div></div>';	
	
	if($other_news_html)
	{
 			echo '<div style="clear:both"></div><div style="border:1px #86c1e3 solid; background:#e3f4fe; margin-top:10px; margin-bottom:10px; padding:5px; text-align:left; font-weight:bold;">'._OTHER_NEWS.':</div>';
	echo '<div class="news_other">';	
		echo $other_news_html;
		echo '</div>
			<div style="clear:both"></div>
			</div>
		</div>';
	}
	
?>
