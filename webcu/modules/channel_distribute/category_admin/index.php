<?php
//	Project            	:  	EVNFC
//	Nguoi tao          	:   GiangNM (15/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri danh muc tin tuc

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/channel_distribute/category_admin/admin.html.php");
	require_once(ROOT_PATH."modules/channel_distribute/category_admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listNewsCategory();
			break;
		case "add":
			addNewsCategory();
			break;
		case "edit":
			editNewsCategory();
			break;	
		case "delete":
			deleteNewsCategory();
			break;
		default:
			listNewsCategory();
			break;
	}
?>