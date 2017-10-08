<?php


global $permission;
$permission = array(
	"1"=>"User",
	"2"=>"Content management",
	"3"=>"Admin"
);
if(file_exists(ROOT_PATH."includes/database.php")){
	require_once(ROOT_PATH."includes/database.php");
}else{
	echo _ERROR_CONNECT_DATABASE;
	exit();
}

global $database;
$database = new database('localhost', 'cokhivotu_cokhi', 'E5GhMoF5', 'cokhivotu_cokhi');

require_once(ROOT_PATH."includes/block.php");
if(file_exists(ROOT_PATH."includes/core.php")){
	require_once(ROOT_PATH."includes/core.php");
}else{
	echo _CANNOT_FIND_CORE;
	exit();
}
get_layout_file();
$database->close();
?>