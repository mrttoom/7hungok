<?php
	//List about_us
	function listAboutUs()
	{
		global $database;
		global $current_lang;
		$totalRows = 0;
		$itemPerPage = 10;
		$numPageShow = 10;
		$curPg = getParam('curPg', 'int', 1);

		if(getParam('id', 'int', 0))
			$condition = ' and id="'.getParam('id', 'int', 0).'"';
		
		$totalRows = $database->getNumRows('faq', ' lang="'.$current_lang.'"'.$condition);				
				
		$query = 'SELECT * FROM `faq` WHERE lang="'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
		$database->setQuery($query);
		$rows = $database->loadResult();
		if($database->getErrorNum()){
			echo $database->stderr();
			return;
		}
		$action = getParam("action", 'str');
		if($action == "save_order")
		{
			foreach($rows as $one)
			{
				if($one['region'] != getParam('region_'.$one['id'], 'int'))
				{
					$query = 'UPDATE `faq` SET `region`="'.getParam('region_'.$one['id'], 'int').'" WHERE lang="'.$current_lang.'" and `id`="'.$one['id'].'"';
					$database->setQuery($query);
					$database->query();
				}
			}
			replace_location('faq_admin');
			return;
		}
		$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
		HTML_about_us::listAboutUs($rows, $pagging, ($curPg-1)*$itemPerPage);
	}
	function deleteAboutUs()
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
					$database->setQuery('delete from faq where id = "'.$id.'" and lang="'.$current_lang.'"');
					$database->query();
				}
			}
		}
		replace_location('faq_admin', array('curPg'));
	}
	function addAboutUs()
	{
		global $database;
		global $current_lang;
				
		$action = getParam("action", 'str');
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			$content = getParam("content", 'def');
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				$region = getParam('region', 'int', 0);
				$user_create = $_SESSION['user']['user_name'];
				$time_create = time();
				$query = "INSERT INTO faq (`title`, `content`, `user_create`, `time_create`, `user_update`, `time_update`, `lang`, `region`)
				 VALUES('$title', '$content', '$user_create', '$time_create', '$user_create', '$time_create', '$current_lang', '$region')";
				$database->setQuery($query);
				$database->query();
				
				if($database->getErrorNum()){
					echo $database->stderr();
					return;
				} 
				if($action == "save")
					replace_location('faq_admin');
				else
					replace_location('faq_admin', array('task'=>'add'));
			}
		}
		HTML_about_us::updateAboutUs('', $error_array);
	}
	function editAboutUs()
	{
		global $database;
		global $current_lang;
				
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$query = "SELECT * FROM faq WHERE id = '".$id."' and lang='".$current_lang."'";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._ABOUT_US_NOT_EXISTS.'");
						window.location="'.generate_url('faq_admin', array('curPg')).'";
					</script>';
			return;
		}
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			$content = getParam("content", 'def');
			$region = getParam('region', 'int', 0);
			
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				$user_update = $_SESSION['user']['user_name'];
				$time_update = time();
				$query = "UPDATE faq SET `title`='$title', `content` = '$content', `user_update`='$user_update', `time_update` = '$time_update', `lang`='$current_lang', `region`='$region' WHERE `id`='".$id."'";
				
				$database->setQuery($query);
				$database->query();
				
				if($database->getErrorNum()){
					echo $database->stderr();
					return;
				} 
				if($action == "save")
					replace_location('faq_admin', array('curPg'));
				else
					replace_location('faq_admin', array('task'=>'add'));
			}
		}
		HTML_about_us::updateAboutUs($row, $error_array);
	}
?>