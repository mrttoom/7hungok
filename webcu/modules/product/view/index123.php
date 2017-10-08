<td valign="top" width="445">
	<div style="border:1px #CCCCCC dotted; margin-right:5px; width:440px; height:280px;">
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `product_category` where `lang`= "'.$current_lang.'" ORDER BY region LIMIT 0,4';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		if(strlen($one['title'])>30){$one['title']=substr($one['title'],0,30); }
		$product_link = generate_url('product', array('category_id'=>$one['id']));
		$image_src = get_image($one, 'large', 'product_category');
?>			
		<div class="lvkd" style="background:url(<?php echo $image_src;?>)">
			<div class="lvkd_text"><a href="<?php echo $product_link;?>"><?php echo $one['title'];?></a></div></div>
<?php	
		}
	}
?>	 	
		<div style="clear:both"></div>
	</div>
</td>