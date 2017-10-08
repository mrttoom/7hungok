<td valign="top">
<div id="hotnews1">
		<div class="hotnews2"><img src="<?php echo SITE_PATH;?>themes/images/hotnews1.jpg" /></div>
		<div class="hotnews3"><div class="hotnews3_text"><?php echo _ECONOMIC_RELATIONS;?></div></div>
		<div class="hotnews2"><img src="<?php echo SITE_PATH;?>themes/images/hotnews3.jpg" /></div>
  </div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="10" valign="bottom"><img src="<?php echo SITE_PATH;?>themes/images/tin1.jpg" /></td>
		<td style="background:url(<?php echo SITE_PATH;?>themes/images/tin3.jpg) bottom repeat-x; background-color:#FFFFFF;">
		  <div class="news_02">

<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `economic_relations` where `lang`= "'.$current_lang.'" ORDER BY id DESC LIMIT 0,6';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{
		$n=0;
		foreach($rows as $one)
		{
			$arr[$n]= $one;
			$n++;	
		}
		$img =  $arr[0];
		$image_file = get_image($img, 'small', 'economic_relations');
		if($image_file)
			$image = '<img src="'.$image_file.'" />';
		
		echo '<div class="news_02_td">
		<a href="'.generate_url('economic_relations_detail', array('category_id'=>$arr[0]['category_id'],'id'=>$arr[0]['id'])).'">'.$arr[0]['title'].'</a></div>';
		echo '<div class="news_02_img">'.$image.'</div>';
		echo $arr[0]['brief'];
		echo '&nbsp;<a class="chi_tiet" href="'.generate_url('economic_relations_detail', array('category_id'=>$arr[0]['category_id'],'id'=>$arr[0]['id'])).'">'._READ_MORE.' >></a></div><div style="clear:both"></div>
			 <div class="news_02_more">';
		if($n>1)
		{
			for($i=1; $i<$n; $i++)
				echo '<img src="'.SITE_PATH.'themes/images/icon-news.gif" /><a href="'.generate_url('economic_relations_detail', array('category_id'=>$arr[0]['category_id'],'id'=>$arr[$i]['id'])).'">'.$arr[$i]['title'].'</a><br />';
			echo '</div>';
		}
	}
?>

		</td>
		<td width="10" valign="bottom"><img src="<?php echo SITE_PATH;?>themes/images/tin2.jpg" /></td>
	  </tr>
	</table>
</td>
