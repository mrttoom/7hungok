<?php
	global $database;
	global $current_lang;
	$id = getParam('id', 'int', 0);
	if($id)
		$con = ' AND `id`="'.$id.'" ';
	$query = 'SELECT * FROM `about_us` where `lang`= "'.$current_lang.'"'.$con.' ORDER BY region';
	$database->setQuery($query);
	$row = $database->loadRow();
	
		//replace_location('about_us');
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text"><?php echo _ABOUT_US;?></div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>
<div class="content_center">



<?php
	if($row){
		echo '<div class="content_center_heading">				
				'.$row['title'].'</div>
				
				<div class="content_news">';
				echo  	$row['content'].'					
		<div style="clear:both"></div>
	</div>
</div>';
	}	
	$query = 'SELECT * FROM `about_us` where `lang`= "'.$current_lang.'" AND id!='.$row['id'].' ORDER BY region';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		echo '<div style="clear:both"></div><div style="border:1px #86c1e3 solid; background:#e3f4fe; margin-top:10px; margin-bottom:10px; padding:5px; text-align:left; font-weight:bold;">'._OTHER_NEWS.':</div>';
	echo '<div class="news_other">';	
		foreach($rows as $one)
			echo '<img src="'.SITE_PATH.'themes/images/icon-news.gif" /><a style="padding-left:5px"  href="'.generate_url('about_us', array('id'=>$one['id'])).'">'.$one['title'].'</a><br />';
		echo '</div>
			</div>
		</div>';
	}
?>