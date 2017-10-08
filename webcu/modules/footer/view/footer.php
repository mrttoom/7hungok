<?php
	global $current_lang;
	$file_name= DATA_PATH.'html/footer/footer_'.$current_lang.'.html';
	echo string_strip(get_file_content($file_name));
?>