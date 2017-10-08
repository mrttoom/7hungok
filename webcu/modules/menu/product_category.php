<?php 
	$mo = getParam('module');
	$modul = getParam('module');
	switch ($modul) {
		case 'home':
		case 'product_category':
		case 'product':
		case 'contact_us':
		case 'help':
		case 'jobs':
		case 'jobs_detail':	
?>
<div class="block clearfix">
     <div class="block-top"> <a class="prod"><?php echo _PRODUCT; ?></a> </div>
          <div class="block-content">
            <ul id="Nav">
            	<?php
					global $database;
					global $current_lang;
					$query = 'SELECT * FROM product_category WHERE lang="'.$current_lang.'" AND parent=0 ORDER BY region';
					$category = _PRODUCT;
					$database->setQuery($query);
					$rows = $database->loadResult();
					if($rows)
					$num = 1;
					foreach($rows as $one){
						//if($num==1)
//						{
//							echo '<li class="first">';
//							echo '<a href="'.generate_url($url, array('id'=>$one['id'])).'">'.$one['title'].'</a>'.getSubCat($database, $one['id']);
//							echo '</li>';
//							
//						}
//						else
						{
							echo '<li>';
							echo '<a href="'.generate_url('product_category', array('idc'=>$one['id'])).'">'.$one['title'].'</a>'.getSubCat($database, $one['id']);
							echo '</li>';
						}
						$num++;
					}
				?>
        </ul>
     </div>
     <div class="block-bottom"> </div>
</div>
<?php
	 
	}
?>