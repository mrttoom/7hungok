<?php
		global $database;
	global $current_lang;
	$id = getParam('id', 'int', 0);
	if($id)
		$condition = ' AND `id`='.$id.' ';
	$query = 'SELECT * FROM `product` WHERE lang="'.$current_lang.'"'.$condition;
	$database->setQuery($query);
	$row = $database->loadRow();
	if(!$row)
		replace_location('home');
	
	$id = getParam('idc', 'int', 0);
    $num = $row['category_id'];
	if($id)
	{
		$ok = 1;
		if(!isset($_SESSION['ord']))
			$_SESSION['ord'] = 1;		 
		for($i = 1; $i<$_SESSION['ord']; $i++)
			if($id == $_SESSION['sp'][$i]['id'])
			{
				$ok = 0;
				break;
			}		
		if(!isset($_SESSION['total']))
			$_SESSION['total'] = $row['cost'];
		else
			$_SESSION['total'] = $_SESSION['total'] +  $row['cost'];		
		
		if($ok)
		{	
			$_SESSION['sp'][$_SESSION['ord']] = $row;			
			//if(!isset($_SESSION['sp'][$_SESSION['ord']]['sl']))
				$_SESSION['sp'][$_SESSION['ord']]['sl']=1;
			$_SESSION['ord']++;
		}
		else
			$_SESSION['sp'][$i]['sl']++;
	}
	
	$query = 'SELECT * FROM `product` WHERE lang="'.$current_lang.'" and category_id="'.$num.'" and id!="'.$row['id'].'" order by id desc ';
	$database->setQuery($query);
	$other_news = $database->loadResult();
	if($other_news)
	{
		foreach($other_news as $one)
		{			
			$image_src = get_image($one, 'small', 'product');
			$other_news_html .= '<div id="sp_moi">';
			if($image_src)
			$other_news_html .='<a href="'.generate_url('product_detail', array('id'=>$one['id'])).'"><img src="'.$image_src.'" alt="'.string_strip($one['title']).'" title="'.string_strip($one['title']).'"/></a><br />';
			
			$other_news_html .=' <div class="tensp"><a href="'.generate_url('product_detail', array('category_id'=>$one['category_id'], 'id'=>$one['id'])).'">'.string_strip($one['title']).'</a></div>
              </div>';						
		}
	}
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	<a href="<?php echo generate_url('product_category');?>"><?php echo _PRODUCT;?></a> &raquo; <a href="<?php echo generate_url('product', array('id'=>$row['id']));?>"><?php echo $row['category_name'];?></a>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>

<?php 
	$image_file = get_image($row, 'large', 'product');

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
 			echo '<div style="clear:both"></div><div style="border:1px #86c1e3 solid; background:#e3f4fe; margin-top:10px; margin-bottom:10px; padding:5px; text-align:left; font-weight:bold;">'._OTHER_PRODUCT.':</div>';
	echo '<div class="noidung1"><marquee onmouseover="this.stop()" onmouseout="this.start()" direction="left" scrollamount="1" scrolldelay="70" height="130" style="width:100%;">';	
		echo $other_news_html;
		echo '</marquee>
               </div>';
	}
	
?>