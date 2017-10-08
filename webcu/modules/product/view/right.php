<div class="td">
	<div class="td_text1"><?php echo _PROJECT_IMAGES?></div>
</div>
<div class="boder" align="center">
	<div style="padding:6px" align="center">
		<marquee onMouseOver="this.stop()" onMouseOut="this.start()" direction="up" scrollamount="1" scrolldelay="70" height="500">
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `project` WHERE lang="'.$current_lang.'"  ORDER BY id desc LIMIT 0,10';
	$database->setQuery($query);
			$database->query();
			$real_estate_news = $database->loadResult();
			if($real_estate_news)
			foreach($real_estate_news as $one)
			{
			
			$image_src = get_image($one, 'small', 'project');			
if($image_src)
	echo '<div class="hinh_anh_du_an" align="center"><a href="'.generate_url('project_detail', array('category_id'=>$one['category_id'],'id'=>$one['id'])).'"><img src="'.$image_src.'"  alt="'.$one['title'].'" title="'.$one['title'].'"/></div>
			<div class="ten_du_an"><a href="'.generate_url('project_detail', array('category_id'=>$one['category_id'],'id'=>$one['id'])).'">'.$one['title'].'</a></div>';
	
	}
	
?>		
		</marquee>
	</div>
</div>