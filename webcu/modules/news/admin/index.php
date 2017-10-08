<?php
//	Project            	:  	EVNFC
//	Nguoi tao          	:   GiangNM (15/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri tin tuc

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/news/admin/admin.html.php");
	require_once(ROOT_PATH."modules/news/admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listNews();
			break;
		case "add":
			addNews();
			break;
		case "edit":
			editNews();
			break;	
		case "delete":
			deleteNews();
			break;
		case "delete_image":
			deleteNewsImage();
			break;
		default:
			listNews();
			break;
	}
?>