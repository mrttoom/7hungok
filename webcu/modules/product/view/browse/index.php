<?php
	global $database;
	global $current_lang;
    global $condition;
	$totalRows = 0;
	$itemPerPage = 9;
	$numPageShow = 10;
	$curPg = getParam('curPg', 'int', 1);
	$idc = getParam('idc', 'int', 0);
	if($idc)
	{
		$list = $idc;
		$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" AND id ='.$idc;
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row['parent'])
		{
			$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" AND parent ='.$row['id'];
			$database->setQuery($query);
			$rows = $database->loadResult();
			
			if($rows)
				foreach($rows as $one)
					$list .= ', '.$one['id'];				
		}
		$con = ' AND category_id IN('.$list.')';
	}
	$totalRows = $database->getNumRows('product', '`lang`="'.$current_lang.'" '.$con);
	$query = 'SELECT * FROM `product` WHERE lang="'.$current_lang.'"'.$con;
	$database->setQuery($query);
	$cat = $database->loadRow();
	$query = 'SELECT * FROM `product` WHERE lang="'.$current_lang.'"'.$con.'   ORDER BY id DESC LIMIT '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
	$database->setQuery($query);
	$all_product = $database->loadResult();
	if($all_product)
	{
		$n=0;
		foreach($all_product as $one)
		{
			$pro[$one['id']] = $one;
		}
		
		$id = getParam('id', 'int', 0);
		if($id)
		{
			$ok = 1;
			if(!isset($_SESSION['ord']))
				$_SESSION['ord'] = 1;
			for($i = 1; $i<=$_SESSION['ord']; $i++)
				if($id == $_SESSION['sp'][$i]['id'])
				{
					$ok = 0;
					break;
				}		
			if(!isset($_SESSION['total']))
				$_SESSION['total'] = $pro[$id]['cost'];
			else
				$_SESSION['total'] +=  $pro[$id]['cost'];		
			if($ok==1)
			{	
				$_SESSION['sp'][$_SESSION['ord']] = $pro[$id];			
					$_SESSION['sp'][$_SESSION['ord']]['sl']=1;
				$_SESSION['ord']++;
			}
			else
				$_SESSION['sp'][$i]['sl'] +=1;
		}
	}
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text">
	 <a href="<?php echo generate_url('product_category');?>"><?php echo _PRODUCT;?></a> 
        <?php if($cat) echo ' &raquo; '.$cat['category_name']; ?>
	</div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>
<?php
	if($all_product) {
	foreach($all_product as $one)
	{
			$title = hightlight_keyword(string_strip($one['title']), $search_text);
			$brief = hightlight_keyword(string_strip($one['brief']), $search_text);
			$news_url = generate_url('product_detail', array('id'=>$one['id']));
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