<?php
//	Project            	:  	EVNFC
//	Nguoi tao          	:   GiangNM (15/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri tin tuc

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/gallery/admin/admin.html.php");
	require_once(ROOT_PATH."modules/gallery/admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listGallery();
			break;
		case "add":
			addGallery();
			break;
		case "edit":
			editGallery();
			break;	
		case "delete":
			deleteGallery();
			break;
		case "delete_image":
			deleteGalleryImage();
			break;
		default:
			listGallery();
			break;
	}
?>