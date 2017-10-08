<?php
	//List news
	function listGallery()
	{
		global $database;
		global $current_lang;
		
		
		$totalRows = 0;
		$itemPerPage = 10;
		$numPageShow = 10;
		$curPg = getParam('curPg', 'int', 1);

		if(getParam('category_id', 'int', 0))
			$condition = ' and category_id="'.getParam('category_id', 'int', 0).'"';
		
		$totalRows = $database->getNumRows('gallery', ' lang="'.$current_lang.'"'.$condition);
		
		$query = 'SELECT * FROM `gallery` WHERE lang="'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
		$database->setQuery($query);
		$rows = $database->loadResult();
		
		if($database->getErrorNum()){
			echo $database->stderr();
			return;
		}
		$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
		HTML_gallery::listGallery($rows, $news_category_arr, $pagging, ($curPg-1)*$itemPerPage);
	}
	function deleteGallery()
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
					$database->setQuery('select id, image_name from gallery where id = "'.$id.'" and lang="'.$current_lang.'"');
					$row = $database->loadRow();
					delete_image($row, 'gallery');
					$database->setQuery('delete from gallery where id = "'.$id.'" and lang="'.$current_lang.'"');
					$database->query();
				}
			}
		}
		replace_location('gallery_admin', array('curPg'));
	}
	function deleteGalleryImage()
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
					$database->setQuery('select id, image_name from gallery where id = "'.$id.'" and lang="'.$current_lang.'"');
					$row = $database->loadRow();
					delete_image($row, 'gallery');
					$database->setQuery('update gallery set `image_name`="" where id = "'.$id.'" and lang="'.$current_lang.'"');
					$row = $database->query();
				}
			}
		}
		replace_location('gallery_admin', array('curPg'));
	}
	function addGallery()
	{
		global $database;
		global $current_lang;
				
		
		$action = getParam("action", 'str');
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			for($i=1; $i<=5; $i++)
			{
				if(isset($_FILES['imgfile_'.$i]) and $_FILES['imgfile_'.$i]['error']==0)
				{
					if(check_type_file($_FILES['imgfile_'.$i]['name'], array('jpg','gif','jpeg','png', 'bmp')))
					{
						$database->setQuery('SELECT max(id) as max_id from gallery');
						$row = $database->loadRow();
						$max_id = $row['max_id']+1;
												
						
						$image_name = date('m').'_'.date('Y').'_'.$max_id.get_file_type($_FILES['imgfile_'.$i]['name']);
						upload_gallery(DATA_PATH.'images/gallery/', $_FILES['imgfile_'.$i]['tmp_name'], $image_name);
						$user_create = $_SESSION['user']['user_name'];
						$time_create = time();
						$title = getParam('title_'.$i, 'str');
						$query = "INSERT INTO gallery (`id`, `title`, `user_create`, `time_create`, `user_update`, `time_update`, `lang`, `image_name`)
						 VALUES('$max_id', '$title', '$user_create', '$time_create', '$user_create', '$time_create', '$current_lang', '$image_name')";
						$database->setQuery($query);
						$database->query();
											
						if($database->getErrorNum())
						{
							echo $database->stderr();
							return;
						} 
					}
				}
			}
			if($action == "save")
				replace_location('gallery_admin');
			else
				replace_location('gallery_admin', array('task'=>'add'));
		}
		HTML_gallery::addGallery($news_category_arr, $error_array);
	}
	function editGallery()
	{
		global $database;
		global $current_lang;
				
			
			
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$query = "SELECT * FROM gallery WHERE id = '".$id."' and lang='".$current_lang."'";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._GALLER_NOT_EXISTS.'");
						window.location="'.generate_url('gallery_admin', array('curPg')).'";
					</script>';
			return;
		}
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			
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
					upload_gallery(DATA_PATH.'images/gallery/', $_FILES['imgfile']['tmp_name'], $image_name);
					if($image_name != $row['image_name'])
						delete_image($row, 'gallery');
				}
			}
			if(!$error_upload)
			{
				$user_update = $_SESSION['user']['user_name'];
				$time_update = time();				
				
				$query = "UPDATE gallery SET `title`='$title', `image_name`='$image_name', `user_update`='$user_update', `time_update` = '$time_update', `lang`='$current_lang' WHERE `id`='".$id."'";
				
				$database->setQuery($query);
				$database->query();
				
				if($database->getErrorNum()){
					echo $database->stderr();
					return;
				} 
				if($action == "save")
					replace_location('gallery_admin', array('curPg'));
				else
					replace_location('gallery_admin', array('task'=>'add'));
			}
		}
		HTML_gallery::updateGallery($row, $news_category_arr, $error_array);
	}
?>