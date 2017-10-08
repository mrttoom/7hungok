<?php
	//List news_category
	function listNewsCategory()
	{
		global $database;
		global $current_lang;
			$totalRows = 0;
		$itemPerPage = 10;
		$numPageShow = 10;
		$curPg = getParam('curPg', 'int', 1);

		if(getParam('id', 'int', 0))
			$condition = ' and id="'.getParam('id', 'int', 0).'"';
		
		$totalRows = $database->getNumRows('economic_relations_category', ' lang="'.$current_lang.'"'.$condition);				
				
		$query = 'SELECT * FROM `economic_relations_category` WHERE lang="'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;	
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
					$query = 'UPDATE `economic_relations_category` SET `region`="'.getParam('region_'.$one['id'], 'int').'" WHERE lang="'.$current_lang.'" and `id`="'.$one['id'].'"';
					$database->setQuery($query);
					$database->query();
				}
			}
			replace_location('economic_relations_category_admin');
			exit;
		}
		$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
		HTML_news_category::listNewsCategory($rows, $pagging, ($curPg-1)*$itemPerPage);
	}
	function deleteNewsCategory()
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
					$database->setQuery('delete from economic_relations where category_id = "'.$id.'" and lang="'.$current_lang.'"');
					$database->query();
					$database->setQuery('delete from economic_relations_category where id = "'.$id.'" and lang="'.$current_lang.'"');
					$database->query();
				}
			}
		}
		replace_location('economic_relations_category_admin', array('curPg'));
	}
	function addNewsCategory()
	{
		global $database;
		global $current_lang;
		
		$action = getParam("action", 'str');
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
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
				$query = "INSERT INTO economic_relations_category (`title`, `user_create`, `time_create`, `user_update`, `time_update`, `lang`, `region`)
				 VALUES('$title', '$user_create', '$time_create', '$user_create', '$time_create', '$current_lang', '$region')";
				$database->setQuery($query);
				$database->query();
				
				if($database->getErrorNum()){
					echo $database->stderr();
					return;
				} 
				if($action == "save")
					replace_location('economic_relations_category_admin');
				else
					replace_location('economic_relations_category_admin', array('task'=>'add'));
			}
		}
		HTML_news_category::updateNewsCategory('', $error_array);
	}
	function editNewsCategory()
	{
		global $database;
		global $current_lang;
		
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$query = "SELECT * FROM economic_relations_category WHERE id = '".$id."' and lang='".$current_lang."'";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._NEWS_CATEGORY_NOT_EXISTS.'");
						window.location="'.generate_url('economic_relations_category_admin').'";
					</script>';
			return;
		}
		
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
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
				$query = "UPDATE economic_relations_category SET `title`='$title', `user_update`='$user_update', `time_update` = '$time_update', `lang`='$current_lang', `region`='$region' WHERE `id`='".$id."'";
				
				$database->setQuery($query);
				$database->query();
				
				if($database->getErrorNum()){
					echo $database->stderr();
					return;
				} 
				if($action == "save")
					replace_location('economic_relations_category_admin', array('curPg'));
				else
					replace_location('economic_relations_category_admin', array('task'=>'add'));
			}
		}
		HTML_news_category::updateNewsCategory($row, $error_array);
	}
?>