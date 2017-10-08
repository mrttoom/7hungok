<?php
require_once(ROOT_PATH."includes/class.upload.php");
	//List adv
	function listAdv()
	{
		global $database;
		
		$totalRows = 0;
		$itemPerPage = 10;
		$numPageShow = 10;
		$curPg = getParam('curPg', 'int', 1);
		
		if(getParam('type_id', 'int', 0))
			$condition = ' and type_id="'.getParam('type_id', 'int', 0).'"';
			
		$totalRows = $database->getNumRows('adv', ' 1 '.$condition);
		
		$query = 'SELECT * FROM `adv` WHERE 1 '.$condition.' ORDER BY type_id, region limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
		$database->setQuery($query);
		$rows = $database->loadResult();
		
		$action = getParam("action", 'str');
		if($action == "save_order")
		{
			foreach($rows as $one)
			{
				if($one['region'] != getParam('region_'.$one['id'], 'int'))
				{
					$query = 'UPDATE `adv` SET `region`="'.getParam('region_'.$one['id'], 'int').'" WHERE lang="'.$current_lang.'" and `id`="'.$one['id'].'"';
					$database->setQuery($query);
					$database->query();
				}
			}
			replace_location('adv_admin');
			exit;
		}
		
		if($database->getErrorNum()){
			echo $database->stderr();
			return;
		}
		$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
		HTML_adv::listAdv($rows, $pagging, ($curPg-1)*$itemPerPage);
	}
	function deleteAdv()
	{
		global $database;
		$list_id = getParam('value', 'str');
		$list_id = explode(',', getParam('value', 'str'));
		if(count($list_id)>0)
		{
			foreach($list_id as $id)
			{
				if(isset($id) && $id>0 && is_numeric($id))
				{
					$database->setQuery('select id, image_name from adv where id = "'.$id.'"');
					$row = $database->loadRow();
					delete_image($row, 'adv');
					$database->setQuery('delete from adv where id = "'.$id.'" ');
					$database->query();
				}
			}
		}
		replace_location('adv_admin', array('curPg'));
	}
	function addAdv()
	{
		global $database;
		$action = getParam("action", 'str');
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$region = getParam("region");
			$fullname = getParam("fullname", 'str');
			$content = getParam("content", 'def');
			$link = getParam("link", 'str');
			$is_valid = 1;
			if(!$link)
			{
				$error_array['link'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				$image_name = '';
				$database->setQuery('SELECT max(id) as max_id from adv');
				$row = $database->loadRow();
				$max_id = $row['max_id']+1;
				
				$error_upload = 0;
				$handle = new Upload($_FILES['imgfile']);        				
				if ($handle->uploaded) {		
					$handle->Process(DATA_PATH.'images/adv/');	
					$image_name =$handle->file_dst_name;				
					
				} else {					
					$error_array['imagefile'] = '<span class="require_field">'._FILE_TYPE_NOT_VALID.'</span>';
						$error_upload = 1;
				}								
				
				if(!$error_upload)
				{
					$query = "INSERT INTO adv (`id`, `fullname`, `content`, `link`, `image_name`, `region`)
					 VALUES('$max_id', '$fullname', '$content', '$link', '$image_name', '$region')";
					$database->setQuery($query);
					$database->query();
					if($database->getErrorNum()){
						echo $database->stderr();
						return;
					} 
					if($action == "save")
						replace_location('adv_admin');
					else
						replace_location('adv_admin', array('task'=>'add'));
				}
			}
		}
		HTML_adv::updateAdv('', $error_array);
	}
	function editAdv()
	{
		global $database;
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$query = "SELECT * FROM adv WHERE id = '".$id."' ";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._ADV_NOT_EXISTS.'");
						window.location="'.generate_url('adv_admin', array('curPg')).'";
					</script>';
			return;
		}
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$fullname = getParam("fullname", 'str');
			$region = getParam("region");
			$content = getParam("content", 'def');
			$link = getParam("link", 'str');
			
			$is_valid = 1;
			if(!$link)
			{
				$error_array['link'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				
				$error_upload = 0;
				$handle = new Upload($_FILES['imgfile']);        				
				if ($handle->uploaded) {		
					$handle->Process(DATA_PATH.'images/adv/');	
					$image_name =$handle->file_dst_name;				
					if($image_name != $row['image_name'])
							delete_adv($row, 'adv');
				} else {					
					$error_array['imagefile'] = '<span class="require_field">'._FILE_TYPE_NOT_VALID.'</span>';
						$error_upload = 1;
				}			
												
				if(!$error_upload)
				{
					$query = "UPDATE adv SET `fullname`='$fullname', `region`='$region', `content` = '$content', `link`='$link', `image_name`='$image_name' WHERE `id`='".$id."'";
					$database->setQuery($query);
					$database->query();
					if($database->getErrorNum()){
						echo $database->stderr();
						return;
					} 
					if($action == "save")
						replace_location('adv_admin', array('curPg'));
					else
						replace_location('adv_admin', array('task'=>'add'));
				}
			}
		}
		HTML_adv::updateAdv($row, $error_array);
	}
?>