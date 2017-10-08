<?php
	//List product_category
	function listProductCategory()
	{
		global $database;
		global $current_lang;
		$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'"  ORDER BY region, parent';
		$database->setQuery($query);
		$rows = $database->loadResult();
		if($database->getErrorNum()){
			echo $database->stderr();
			return;
		}
		if($rows)
		{
			foreach($rows as $one_cat)
			{
				if(!$one_cat['parent'])
				{
					$product_category_arr[$one_cat['id']] = $one_cat;
					$product_category_arr[$one_cat['id']]['level'] = 1;
					foreach($rows as $one_cat1)
					{
						if($one_cat1['parent']==$one_cat['id'])
						{
							$product_category_arr[$one_cat1['id']] = $one_cat1;
							$product_category_arr[$one_cat1['id']]['level'] = 2;
							foreach($rows as $one_cat2)
							{
								if($one_cat2['parent']==$one_cat1['id'])
								{
									$product_category_arr[$one_cat2['id']] = $one_cat2;
									$product_category_arr[$one_cat2['id']]['level'] = 3;
								}
							}
						}
					}
				}
			}
		}
		$action = getParam("action", 'str');
		if($action == "save_order")
		{
			foreach($rows as $one)
			{
				if($one['region'] != getParam('region_'.$one['id'], 'int'))
				{
					$query = 'UPDATE `product_category` SET `region`="'.getParam('region_'.$one['id'], 'int').'" WHERE `id`="'.$one['id'].'"';
					$database->setQuery($query);
					$database->query();
				}
			}
			replace_location('product_category_admin');
			exit;
		}
		
		HTML_product_category::listProductCategory($product_category_arr);
	}
	function deleteProductCategory()
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
					$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" and id = "'.$id.'" ORDER BY id desc';
					$database->setQuery($query);
					$row = $database->loadRow();
					if(!$row['child_id'])
					{
						$database->setQuery('select id, image_name from product_category where id = "'.$id.'" and lang="'.$current_lang.'"');
					$row = $database->loadRow();
					delete_image($row, 'product_category');
						$database->setQuery('delete from product_category where id = "'.$id.'" and lang="'.$current_lang.'"');
						$database->query();
						$database->setQuery("delete from keyword where `content_id`='".$id."' and module='product' and lang='".$current_lang."'");
						$database->query();
						$database->setQuery('delete from product where category_id = "'.$id.'" and lang="'.$current_lang.'"');
						$database->query();
						if($row['parent'])
						{
							$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" and id = "'.$row['parent'].'" ORDER BY id desc';
							$database->setQuery($query);
							$row = $database->loadRow();
							$id_list = remove_id($row['child_id'], $id);
							$database->updateObject('product_category', array('child_id'=>$id_list), ' id="'.$row['id'].'"');
						}
					}
				}
			}
		}
		replace_location('product_category_admin', array('curPg'));
	}
	
	function addProductCategory()
	{
		global $database;
		global $current_lang;
		$action = getParam("action", 'str');
		$error_array = array();
		
		$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'" ORDER BY region';
		$database->setQuery($query);
		$product_categorys = $database->loadResult();
		$product_category_arr[0] = 'Danh mục gốc';
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
		
		if($action == "save" || $action == "apply")
		{
			$image_name = '';
			$database->setQuery('SELECT max(id) as max_id from product_category');
			$row = $database->loadRow();
			$max_id = $row['max_id']+1;
			
			$title = getParam("title", 'str');
			$title_url = getParam("title_url", 'str');
			$parent = getParam("parent", 'int', 0);
			$region = getParam("region", 'int', 0);
			$state = getParam("state", 'int');
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if(!$title)
			{
				$error_array['title_url'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				
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
						upload_gallery(DATA_PATH.'images/product_category/', $_FILES['imgfile']['tmp_name'], $image_name);
					}
				}
				if(!$error_upload)
				{
					$query = "SELECT * FROM product_category WHERE `title` = '".$title."' and lang='".$current_lang."' ";
					$database->setQuery($query);
					$check = $database->loadRow();
					
					if($check!="" and $check['title']==$title)
					{
						$error_array['title'] = '<span class="require_field">Tên danh mục đã tồn tại</span>';;
					}
					elseif($check!="" and $check['title_url']==$title_url)
					{
						$error_array['title_url'] = '<span class="require_field">Tên hiển thị trên URL đã tồn tại</span>';;
					}
					else
					{
						
					
						$query = "SELECT * from product_category where lang = '".$current_lang."' and id = '".$parent."'";
						$database->setQuery($query);
						$database->query();
						$parent_data = $database->loadRow();
						
						$query = "INSERT INTO product_category (`title`, `lang`, `parent`, `region`, `image_name`, `state`)
						VALUES('$title', '$current_lang', '$parent', '$region','$image_name','$state')";
						$database->setQuery($query);
						$database->query();
						
						if($database->getErrorNum()){
							echo $database->stderr();
							return;
						}					
						
						if($action == "save")
							replace_location('product_category_admin');
						else
							replace_location('product_category_admin', array('task'=>'add'));					
					}
				}
			}
		}
		HTML_product_category::updateProductCategory('', $product_category_arr, $error_array);
	}
	function editProductCategory()
	{
		global $database;
		global $current_lang;
		
		$query = 'SELECT * FROM `product_category` WHERE lang="'.$current_lang.'"AND parent=0 ORDER BY region';
		$database->setQuery($query);
		$product_categorys = $database->loadResult();
		$product_category_arr[0] = 'Danh mục gốc';
		if($product_categorys)
		{
			foreach($product_categorys as $one_cat)
			{ 
			    $product_category_arr[$one_cat['id']] = '--'.$one_cat['title'];
			}
		}
		$state = getParam("state", 'int');
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$query = "SELECT * FROM product_category WHERE id = '".$id."' and lang='".$current_lang."'";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._PRODUCT_CATEGORY_NOT_EXISTS.'");
						window.location="'.generate_url('product_category_admin').'";
					</script>';
			return;
		}
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			$parent = getParam("parent", 'int', 0);
			$region = getParam("region", 'int', 0);
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				
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
						upload_gallery(DATA_PATH.'images/product_category/', $_FILES['imgfile']['tmp_name'], $image_name);
						if($image_name != $row['image_name'])
							delete_image($row, 'product_category');
					}
				}
				
				if(!$error_upload)
				{
					$query = "SELECT * FROM product_category WHERE `title` ='".$title."' and lang='".$current_lang."' and id <>'".$id."'";
					$database->setQuery($query);
					$check = $database->loadRow();
					
					if($check!="" and $check['title']==$title)
					{
						$error_array['title'] = '<span class="require_field">Tên danh mục đã tồn tại</span>';;
					}
					elseif($check!="" and $check['title_url']==$title_url)
					{
						$error_array['title_url'] = '<span class="require_field">Tên hiển thị trên URL đã tồn tại</span>';;
					}
					else
					{
						$query = "SELECT * from product_category where lang = '".$current_lang."' and id = '".$parent."'";
						$database->setQuery($query);
						$database->query();
						$parent_data = $database->loadRow();
							
						$query = "UPDATE product_category SET `title`='$title', `image_name`='$image_name', `state`='$state', `parent`='$parent', `lang`='$current_lang', `region`='$region' WHERE `id`='".$id."'";
						$database->setQuery($query);
						$database->query();
						
						if($database->getErrorNum()){
							echo $database->stderr();
							return;
						}												
						
						$query = "UPDATE product SET `category_name`='$title' WHERE `category_id`='".$id."' and lang='$current_lang'";
						$database->setQuery($query);
						$database->query();
						
						if($action == "save")
							replace_location('product_category_admin');
						else
							replace_location('product_category_admin', array('task'=>'add'));
					}
				}
			}
		}
		HTML_product_category::updateProductCategory($row, $product_category_arr, $error_array);
	}
?>