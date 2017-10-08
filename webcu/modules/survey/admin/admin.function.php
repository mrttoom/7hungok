<?php
	//List survey
	function listSurvey()
	{
		global $database;
		global $current_lang;
		$query = 'SELECT * FROM `survey` WHERE lang="'.$current_lang.'" ORDER BY id desc';
		$database->setQuery($query);
		$rows = $database->loadResult();
		if($database->getErrorNum()){
			echo $database->stderr();
			return;
		}
		if($rows)
		{
			$survey_option = array();
			foreach($rows as $one)
			{
				$query = "SELECT * FROM survey_option WHERE survey_id = '".$one['id']."'";
				$database->setQuery($query);
				$all_answer = $database->loadResult();
				if($all_answer)
				{
					$i = 1;
					foreach($all_answer as $one_a)
					{
						if($survey_option[$one['id']])
							$survey_option[$one['id']] .= '<br />'.$i.'. '.$one_a['name'];
						else
							$survey_option[$one['id']] .= $i.'. '.$one_a['name'];
						$i++;
					}
				}
			}
		}
		HTML_survey::listSurvey($rows, $survey_option);
	}
	function deleteSurvey()
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
					$database->setQuery('delete from survey where id = "'.$id.'" and lang="'.$current_lang.'"');
					$database->query();
					$database->setQuery('delete from survey_option where survey_id = "'.$id.'"');
					$database->query();
				}
			}
		}
		replace_location('survey_admin', array('curPg'));
	}
	function addSurvey()
	{
		global $database;
		global $current_lang;
		$action = getParam("action", 'str');
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			$type = getParam("type", 'int');
			$status = getParam("status", 'int');
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				$query = "SELECT id FROM survey WHERE `title` = '".$title."' and lang='".$current_lang."' ";
				$database->setQuery($query);
				$check = $database->loadRow();
				
				if($check!="")
				{
					$error_array['title'] = '<span class="require_field">'._TITLE_EXISTS.'</span>';;
				}
				else
				{
					$query = "INSERT INTO survey (`title`, `type`, `status`, `lang`)
					 VALUES('$title', '$type', '$status', '$current_lang')";
					$database->setQuery($query);
					$database->query();
					$survey_id = $database->get_id();
					if($database->getErrorNum()){
						echo $database->stderr();
						return;
					} 
					for($i=0; $i<6; $i++)
					{
						$answer = getParam('answer1_'.$i, 'str', '');
						if($answer)
						{
							$query = "INSERT INTO survey_option (`survey_id`, `name`, `count`)
							 VALUES('$survey_id', '$answer', '0')";
							$database->setQuery($query);
							$database->query();
						}
					}
					if($action == "save")
						replace_location('survey_admin');
					else
						replace_location('survey_admin', array('task'=>'add'));
				}
			}
		}
		HTML_survey::updateSurvey('', $error_array);
	}
	function editSurvey()
	{
		global $database;
		global $current_lang;
		$action = getParam("action", 'str');
		$id = getParam("id", 'int');
		$query = "SELECT * FROM survey WHERE id = '".$id."' and lang='".$current_lang."'";
		$database->setQuery($query);
		$row = $database->loadRow();
		if(!$row)
		{
			echo '	<script>
						alert("'._SURVEY_NOT_EXISTS.'!");
						window.location="'.generate_url('survey_admin', array('curPg')).'";
					</script>';
			return;
		}
		$query = "SELECT * FROM survey_option WHERE survey_id = '".$id."'";
		$database->setQuery($query);
		$all_answer = $database->loadResult();
		$error_array = array();
		if($action == "save" || $action == "apply")
		{
			$title = getParam("title", 'str');
			$type = getParam("type", 'int');
			$status = getParam("status", 'int');
			$is_valid = 1;
			if(!$title)
			{
				$error_array['title'] = '<span class="require_field">'._REQUIRED_FILED.'</span>';
				$is_valid = 0;
			}
			if($is_valid)
			{
				$query = "SELECT id FROM survey WHERE `title` = '".$title."' and lang='".$current_lang."' and id <>'".$id."'";
				$database->setQuery($query);
				$check = $database->loadRow();
				
				if($check!="")
				{
					$error_array['title'] = '<span class="require_field">'._TITLE_EXISTS.'</span>';;
				}
				else
				{
					$query = "UPDATE survey SET `title`='$title', `type`='$type', `status`='$status', `lang`='$current_lang' WHERE `id`='".$id."'";
					$database->setQuery($query);
					$database->query();
					if($database->getErrorNum()){
						echo $database->stderr();
						return;
					}
					foreach($all_answer as $one_a)
					{
						$answer = getParam('answer_'.$one_a['id'], 'str', '');
						if($answer)
						{
							$query = "UPDATE survey_option SET `name`='$answer' WHERE `id`='".$one_a['id']."'";
							$database->setQuery($query);
							$database->query();
						}
						else
						{
							$query = "DELETE from survey_option WHERE `id`='".$one_a['id']."'";
							$database->setQuery($query);
							$database->query();
						}
					}
					for($i=0; $i<6; $i++)
					{
						$answer = getParam('answer1_'.$i, 'str', '');
						if($answer)
						{
							$query = "INSERT INTO survey_option (`survey_id`, `name`, `count`)
							 VALUES('$id', '$answer', '0')";
							$database->setQuery($query);
							$database->query();
						}
					}
					if($action == "save")
						replace_location('survey_admin');
					else
						replace_location('survey_admin', array('task'=>'add'));
				}
			}
		}
		HTML_survey::updateSurvey($row, $error_array, $all_answer);
	}
?>