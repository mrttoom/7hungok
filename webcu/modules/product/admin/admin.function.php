<?php
	//List product
	function listProduct()
	{
		global $database;
		global $current_lang;
		$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" ORDER BY region';
		$database->setQuery($query);
		$product_categorys = $database->loadResult();
		$product_category_arr[0] = _ALL;
		if($product_categorys)
		{
			foreach($product_categorys as $one_cat)
			{
				if(!$one_cat['parent'])
				{
					$product_category_arr[$one_cat['id']] = '--'.$one_cat['title'];
					foreach($product_categorys as $one_cat1)
					{
						if($one_cat1['parent']==$one_cat['id'])
							$product_category_arr[$one_cat1['id']] = '------'.$one_cat1['title'];
					}
				}
			}
		}
		
		$totalRows = 0;
		$itemPerPage = 10;
		$numPageShow = 10;
		$curPg = getParam('curPg', 'int', 1);

		if(getParam('category_id', 'int', 0))
			$condition = ' and category_id="'.getParam('category_id', 'int', 0).'"';
		
		$totalRows = $database->getNumRows('product', ' lang="'.$current_lang.'"'.$condition);
		
		$query = 'SELECT * FROM `product` WHERE lang="'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
		$database->setQuery($query);
		$rows = $database->loadResult();
		
		if($database->getErrorNum()){
			echo $database->stderr();
			return;
		}
		$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
		HTML_product::listProduct($rows, $product_category_arr, $pagging, ($curPg-1)*$itemPerPage);
	}
	function deleteProduct()
	{
		global $database;
		global $current_lang;
		$list_id = getParam('value', 'str');
		$list_id = explode(',', getParam('value', 'str'));
		if(count($list_id)>0)
		{
			foreach($list_id as $id)
			{
				if(isset($id) && $id>0 && is_numeric($id))
				{
					$database->setQuery('select id, image_name from product where id = "'.$id.'" and lang="'.$current_lang.'"');
					$row = $database->loadRow();
					delete_image($row, 'product');
					$database->setQuery('delete from product where id = "'.$id.'" and lang="'.$current_lang.'"');
					$database->query();
				}
			}
		}
		replace_location('product_admin', array('curPg'));
	}
	function deleteProductImage()
	{
		global $database;
		global $current_lang;
		$list_id = getParam('value', 'str');
		$list_id = explode(',', getParam('value', 'str'));
		if(count($list_id)>0)
		{
			foreach($list_id as $id)
			{
				if(isset($id) && $id>0 && is_numeric($id))
				{
					$database->setQuery('select id, image_name from product where id = "'.$id.'" and lang="'.$current_lang.'"');
					$row = $database->loadRow();
					delete_image($row, 'product');
					$database->setQuery('update product set `image_name`="" where id = "'.$id.'" and lang="'.$current_lang.'"');
					$row = $database->query();
				}
			}
		}
		replace_location('product_admin', array('curPg'));
	}
	function addProduct()
	{
		global $database;
		global $current_lang;
		
		$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" ORDER BY region';
		$database->setQuery($query);
		$product_categorys = $database->loadResult();
		if($product_categorys)
		{
			foreach($product_categorys as $one_cat)
			{
				if(!$one_cat['parent'])
				{
					$product_category_arr[$one_cat['id']] = '--'.$one_cat['title'];
					foreach($product_categorys as $one_cat1)
					{
						if($one_cat1['parent']==$one_cat['id'])
							$product_category_arr[$one_cat1['id']] = '------'.$one_cat1['title'];
					}
				}
			}
		}
		
		$action = getParam("action", 'str');
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
					
			$brief = getParam("brief", 'def');
			$content = getParam("content", 'def');			
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FIELD.'</span>';
				$is_valid = 0;
			}
			

			$image_name = '';
			$database->setQuery('SELECT max(id) as max_id from product');
			$row = $database->loadRow();
			$max_id = $row['max_id']+1;
			
			$error_upload = 0;
			if(isset($_FILES['imgfile']) and $_FILES['imgfile']['error']==0)
			{
				if(!check_type_file($_FILES['imgfile']['name'], array('jpg','gif','jpeg','png', 'bmp')))
				{
					$error_array['imagefile'] = '<span class="require_field">'._FILE_TYPE_NOT_VALID.'</span>';
					$error_upload = 1;
				}
				else
				{
					$image_name = date('m').'_'.date('Y').'_'.$max_id.get_file_type($_FILES['imgfile']['name']);
					upload_image(DATA_PATH.'images/product/', $_FILES['imgfile']['tmp_name'], $image_name, array('0'=>120, '1'=>88, '2'=>490, '3'=>300));
				}
			}
			if(!$error_upload)
			{
				$category_id = getParam('category_id', 'int', 0);
				$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" and id = "'.$category_id.'" ORDER BY id desc';
				$database->setQuery($query);
				$product_category = $database->loadRow();
				$category_name = $product_category['title'];
				$user_create = $_SESSION['user']['user_name'];
				$time_create = time();
				$query = "INSERT INTO product (`id`, `title`, `brief`, `content`, `category_id`, `category_name`, `user_create`, `time_create`, `user_update`, `time_update`, `lang`, `image_name`, `unit`)
				 VALUES('$max_id', '$title', '$brief', '$content', '$category_id', '$category_name', '$user_create', '$time_create', '$user_create', '$time_create', '$current_lang', '$image_name', '0')";
				$database->setQuery($query);
				$database->query();
				
				if($database->getErrorNum()){
					echo $database->stderr();
					return;
				} 
				if($action == "save")
					replace_location('product_admin');
				else
					replace_location('product_admin', array('task'=>'add'));
			}
		}
		HTML_product::updateProduct('', $product_category_arr, $error_array);
	}
	function editProduct()
	{
		global $database;
		global $current_lang;
		
		$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" ORDER BY region';
		$database->setQuery($query);
		$product_categorys = $database->loadResult();
		if($product_categorys)
		{
			foreach($product_categorys as $one_cat)
			{
				if(!$one_cat['parent'])
				{
					$product_category_arr[$one_cat['id']] = '--'.$one_cat['title'];
					foreach($product_categorys as $one_cat1)
					{
						if($one_cat1['parent']==$one_cat['id'])
							$product_category_arr[$one_cat1['id']] = '------'.$one_cat1['title'];
					}
				}
			}
		}		
		
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$query = "SELECT * FROM product WHERE id = '".$id."' and lang='".$current_lang."'";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._PRODUCT_NOT_EXISTS.'");
						window.location="'.generate_url('product_admin', array('curPg')).'";
					</script>';
			return;
		}
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
					
			$brief = getParam("brief", 'def');
			$content = getParam("content", 'def');			
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FIELD.'</span>';
				$is_valid = 0;
			}
			

			
			$is_valid = 1;

			$error_upload = 0;
			$image_name = $row['image_name'];
			if(isset($_FILES['imgfile']) and $_FILES['imgfile']['error']==0)
			{
				if(!check_type_file($_FILES['imgfile']['name'], array('jpg','gif','jpeg','png', 'bmp')))
				{
					$error_array['imagefile'] = '<span class="require_field">'._FILE_TYPE_NOT_VALID.'</span>';
					$error_upload = 1;
				}
				else
				{
					$image_name = date('m').'_'.date('Y').'_'.$row['id'].get_file_type($_FILES['imgfile']['name']);
					upload_image(DATA_PATH.'images/product/', $_FILES['imgfile']['tmp_name'], $image_name, array('0'=>120, '1'=>88, '2'=>490, '3'=>300));
					if($image_name != $row['image_name'])
						delete_image($row, 'product');
				}
			}
			if(!$error_upload)
			{
				$category_id = getParam('category_id', 'int', 0);
				$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" and id = "'.$category_id.'" ORDER BY id desc';
				$database->setQuery($query);
				$product_category = $database->loadRow();
				$category_name = $product_category['title'];
				$user_update = $_SESSION['user']['user_name'];
				$time_update = time();
				
				$query = "UPDATE product SET `title`='$title', `brief`='$brief', `content` = '$content', `category_id`='$category_id', `category_name`='$category_name', `image_name`='$image_name', `user_update`='$user_update', `time_update` = '$time_update', `lang`='$current_lang', `unit`='0' WHERE `id`='".$id."'";
				
				$database->setQuery($query);
				$database->query();
				
				if($database->getErrorNum()){
					echo $database->stderr();
					return;
				} 
				if($action == "save")
					replace_location('product_admin', array('curPg'));
				else
					replace_location('product_admin', array('task'=>'add'));
			}
		}
		HTML_product::updateProduct($row, $product_category_arr, $error_array);
	}
?>