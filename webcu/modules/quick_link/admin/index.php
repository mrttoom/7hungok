<?php
//	Project            	:  	Habeco
//	Nguoi tao          	:   GiangNM (28/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri links

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/quick_link/admin/admin.html.php");
	require_once(ROOT_PATH."modules/quick_link/admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listQuickLink();
			break;
		case "add":
			addQuickLink();
			break;
		case "edit":
			editQuickLink();
			break;	
		case "delete":
			deleteQuickLink();
			break;	
		default:
			listQuickLink();
			break;
	}
?>	