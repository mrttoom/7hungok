<td valign="top" width="396">
<div style="border:1px #CCCCCC dotted; margin-right:5px;">
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `product_category` where `parent`!=0 and `state`=1 and `lang`= "'.$current_lang.'" ORDER BY region LIMIT 0,4';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		$one['title']=get_num_word($one['title'],30);
		$product_link = generate_url('product_category', array('idc'=>$one['id']));
		$image_src = get_image($one, 'small', 'product_category');
?>			
		<div id="lvkd">
			<div class="lvkd1" style="background:url(<?php echo $image_src;?>) no-repeat">
				<div class="lvkd_text"><a href="<?php echo $product_link;?>"><?php echo $one['title'];?></a></div>
			</div>
		</div>
<?php	
		}
	}
?>	 	
		<div style="clear:both"></div>
  </div>
</td>
