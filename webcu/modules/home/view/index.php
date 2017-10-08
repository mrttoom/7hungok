<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `home` where `lang`= "'.$current_lang.'"';
	$database->setQuery($query);
	$row = $database->loadRow();
	if($row)
	{
		echo '<h1>'.$row['title'].'</h1>';
		echo '<p>'.$row['content'].'</p>';
		$query = 'SELECT * FROM `service` where `lang`= "'.$current_lang.'"';
		$database->setQuery($query);
		$rows = $database->loadResult();
		if($rows)
		{
			echo '<h1>'._ECO_SERVICE.':</h1>';
			echo '<ul>';
			foreach($rows as $one)
				echo '<li><a href="'.generate_url('service',array('id'=>$one['id'])).'">'.$one['title'].'</a></li>';
        	echo '</ul>';
		}
	}
	else
		echo '<p>'._NO_CONTENT.'</p>';
?>