<?php
	//List quick_link
	function listQuickLink()
	{
		global $database;
		global $current_lang;
		$totalRows = 0;
		$itemPerPage = 10;
		$numPageShow = 10;
		$curPg = getParam('curPg', 'int', 1);

		if(getParam('id', 'int', 0))
			$condition = ' and id="'.getParam('id', 'int', 0).'"';
		
		$totalRows = $database->getNumRows('quick_link', ' lang="'.$current_lang.'"'.$condition);				
				
		$query = 'SELECT * FROM `quick_link` WHERE lang="'.$current_lang.'" '.$condition.' ORDER BY id desc limit '.(($curPg-1)*$itemPerPage).','.$itemPerPage;
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
					$query = 'UPDATE `quick_link` SET `region`="'.getParam('region_'.$one['id'], 'int').'" WHERE lang="'.$current_lang.'" and `id`="'.$one['id'].'"';
					$database->setQuery($query);
					$database->query();
				}
			}
			replace_location('quick_link_admin');
			exit;
		}
		$pagging = paging($totalRows, $itemPerPage, $numPageShow, 'curPg');
		HTML_quick_link::listQuickLink($rows, $pagging, ($curPg-1)*$itemPerPage);
	}
	function deleteQuickLink()
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
					$database->setQuery('delete from quick_link where id = "'.$id.'" and lang="'.$current_lang.'"');
					$database->query();
				}
			}
		}
		replace_location('quick_link_admin', array('curPg'));
	}
	function addQuickLink()
	{
		global $database;
		global $current_lang;
		$action = getParam("action", 'str');
		$region = getParam("region", 'int', 1);
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			$link = getParam("link", 'str');
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if(!$link)
			{
				$error_array['link'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				$query = "SELECT * FROM quick_link WHERE `title` = '".$title."' and lang='".$current_lang."' ";
				$database->setQuery($query);
				$check = $database->loadRow();
				
				if($check)
				{
					$error_array['title'] = '<span class="require_field">'._TITLE_EXISTS.'</span>';
				}
				else
				{
					$query = "INSERT INTO quick_link (`title`, `link`, `lang`, `region`)
					VALUES('$title', '$link', '$current_lang', '$region')";
					$database->setQuery($query);
					$database->query();

					if($database->getErrorNum()){
						echo $database->stderr();
						return;
					} 
					if($action == "save")
						replace_location('quick_link_admin');
					else
						replace_location('quick_link_admin', array('task'=>'add'));
				}
			}
		}
		HTML_quick_link::updateQuickLink('', $error_array);
	}
	function editQuickLink()
	{
		global $database;
		global $current_lang;
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$region = getParam("region", 'int', 1);
		$query = "SELECT * FROM quick_link WHERE id = '".$id."' and lang='".$current_lang."'";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._QUICK_LINK_NOT_EXISTS.'!");
						window.location="'.generate_url('quick_link_admin').'";
					</script>';
			return;
		}
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			$link = getParam("link", 'str');
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if(!$link)
			{
				$error_array['link'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				$query = "SELECT * FROM quick_link WHERE `title` = '".$title."' and lang='".$current_lang."' and id <>'".$id."'";
				$database->setQuery($query);
				$check = $database->loadRow();
				
				if($check)
				{
					$error_array['title'] = '<span class="require_field">'._TITLE_EXISTS.'</span>';;
				}
				else
				{
					$query = "UPDATE quick_link SET `title`='$title', `link`='$link', `lang`='$current_lang', `region`='$region' WHERE `id`='".$id."'";
					$database->setQuery($query);
					$database->query();
					
					if($database->getErrorNum()){
						echo $database->stderr();
						return;
					} 
					if($action == "save")
						replace_location('quick_link_admin');
					else
						replace_location('quick_link_admin', array('task'=>'add'));
				}
			}
		}
		HTML_quick_link::updateQuickLink($row, $error_array);
	}
?>