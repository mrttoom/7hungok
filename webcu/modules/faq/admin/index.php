<?php
//	Project            	:  	EVNFC
//	Nguoi tao          	:   GiangNM (15/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri gioi thieu

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/faq/admin/admin.html.php");
	require_once(ROOT_PATH."modules/faq/admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listAboutUs();
			break;
		case "add":
			addAboutUs();
			break;
		case "edit":
			editAboutUs();
			break;	
		case "delete":
			deleteAboutUs();
			break;
		default:
			listAboutUs();
			break;
	}
?>