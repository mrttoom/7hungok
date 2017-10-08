
<?php
	global $database;
	global $current_lang;
	$modul = getParam('module');
	switch ($modul) {		
		case 'about_us':
			$query = 'SELECT * FROM about_us WHERE lang="'.$current_lang.'" ORDER BY region';
			$id = 'id';
			$url = generate_url('about_us', array($id=>$one['id']));
			$category = _ABOUT_US;
			$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{
		echo('<div class="tdbg1"><div class="tdbg2"><div class="tdbg3"><div class="tdtext">'.$category.'</div></div></div></div>');
		echo('<div id="menu_left" align="center">');
	
		foreach($rows as $one){
		
			echo '<div class="menu_text"><div class="text">
			<a href="'.$url.'">'.$one['title'].'</a></div></div>';
		}
		echo '</div>';
	}
			break; 			
		case 'internal_company_detail':
		case 'internal_company':
		case 'gallery':
			$query = 'SELECT * FROM internal_company_category WHERE lang="'.$current_lang.'" ORDER BY region';
			$id = 'category_id';
			$url = generate_url('internal_company', array($id=>$one['id']));
			$category = _INTERNAL_COMPANY;
			$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{
		echo('<div class="tdbg1"><div class="tdbg2"><div class="tdbg3"><div class="tdtext">'.$category.'</div></div></div></div>');
		echo('<div id="menu_left" align="center">');
	
		foreach($rows as $one){
		
			echo '<div class="menu_text"><div class="text">
			<a href="'.$url.'">'.$one['title'].'</a></div></div>';
		}
		echo '<div class="menu_text"><div class="text">
						<a href="'.generate_url('gallery').'">'._GALLERY.'</a></div></div>';
		echo '</div>';
	}
			break;
		case 'economic_relations_detail':
		case 'economic_relations':
			$query = 'SELECT * FROM economic_relations_category WHERE lang="'.$current_lang.'" ORDER BY region';
			$id = 'category_id';
			$url = generate_url('economic_relations', array($id=>$one['id']));
			$category = _ECONOMIC_RELATIONS;
			$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{
		echo('<div class="tdbg1"><div class="tdbg2"><div class="tdbg3"><div class="tdtext">'.$category.'</div></div></div></div>');
		echo('<div id="menu_left" align="center">');
	
		foreach($rows as $one){
		
			echo '<div class="menu_text"><div class="text">
			<a href="'.$url.'">'.$one['title'].'</a></div></div>';
		}
		echo '</div>';
	}
			break;
		case 'channel_distribute_detail':
		case 'channel_distribute':
		

			$query = 'SELECT * FROM channel_distribute_category WHERE lang="'.$current_lang.'" ORDER BY region';
			$id = 'category_id';
			$url = generate_url('channel_distribute', array($id=>$one['id']));
			$category = _CHANNEL_DISTRIBUTE;
			$database->setQuery($query);
				$rows = $database->loadResult();
				if($rows)
				{
					echo('<div class="tdbg1"><div class="tdbg2"><div class="tdbg3"><div class="tdtext">'.$category.'</div></div></div></div>');
					echo('<div id="menu_left" align="center">');
				
					foreach($rows as $one){
					
						echo '<div class="menu_text"><div class="text">
						<a href="'.$url.'">'.$one['title'].'</a></div></div>';
					}					
					echo '</div>';
				}
				
			break;
		case 'news_detail':
		case 'news':
			$query = 'SELECT * FROM news_category WHERE lang="'.$current_lang.'" ORDER BY region';
			$id = 'category_id';
			$url = generate_url('news', array($id=>$one['id']));
			$category = _NEWS;
			$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{
		echo('<div class="tdbg1"><div class="tdbg2"><div class="tdbg3"><div class="tdtext">'.$category.'</div></div></div></div>');
		echo('<div id="menu_left" align="center">');
	
		foreach($rows as $one){
		
			echo '<div class="menu_text"><div class="text">
			<a href="'.$url.'">'.$one['title'].'</a></div></div>';
		}
		echo '</div>';
	}
			break;
		case 'directly_under':
			$query = 'SELECT * FROM directly_under WHERE lang="'.$current_lang.'" ORDER BY region';
			$id = 'id';
			$url = generate_url('directly_under', array($id=>$one['id']));
			$category = _DIRECTLY_UNDER;
			$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{
		echo('<div class="tdbg1"><div class="tdbg2"><div class="tdbg3"><div class="tdtext">'.$category.'</div></div></div></div>');
		echo('<div id="menu_left" align="center">');
	
		foreach($rows as $one){
		
			echo '<div class="menu_text"><div class="text">
			<a href="'.$url.'">'.$one['title'].'</a></div></div>';
		}
		echo '</div>';
	}
			break;
		
		case 'faq':					
		case 'sign_in':
		case 'search':
		case 'contact':
		case 'product':
		case 'culture_detail':
		case 'product_detail':
		case 'product_category':
	?>	
		<div class="tdbg1"><div class="tdbg2"><div class="tdbg3"><div class="tdtext">
			<?php echo _PRODUCT; ?>
		</div></div></div></div>
         <div id="menu_left" align="center">		 
            	<?php
					global $database;
					global $current_lang;
					$query = 'SELECT * FROM product_category WHERE lang="'.$current_lang.'" AND parent=0 ORDER BY region';
					$category = _PRODUCT;
					$database->setQuery($query);
					$rows = $database->loadResult();
					if($rows)
						foreach($rows as $one){						
							{
								echo '<div class="menu_text"><div class="text">';
								echo '<a href="'.generate_url('product_category', array('idc'=>$one['id'])).'"><b>'.$one['title'].'</b></a>';		
				$subquery = 'SELECT * FROM product_category WHERE parent='.$one['id'];
				$database->setQuery($subquery);
				$subset = $database->loadResult();
				$id = 'idc';
				if($subset)
				{
					foreach($subset as $set)
						echo '<a href="'.generate_url('product_category', array('idc'=>$set['id'])).'">&nbsp;&nbsp;'.$set['title'].'</a>';
				}
								
								echo '</div></div>';
							}
						}
				?>        
     </div>
 
<?php
			break;	
		}

?>