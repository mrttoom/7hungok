<?php
//	Project            	:  	Habeco
//	Nguoi tao          	:   GiangNM (28/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri quang cao

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/adv/admin/admin.html.php");
	require_once(ROOT_PATH."modules/adv/admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listAdv();
			break;
		case "add":
			addAdv();
			break;
		case "edit":
			editAdv();
			break;	
		case "delete":
			deleteAdv();
			break;
		case "delete_image":
			deleteAdvImage();
			break;
		default:
			listAdv();
			break;
	}
?>