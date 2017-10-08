<?php
//	Project            	:  	ToanPhat
//	Nguoi tao          	:   GiangNM (05/10/2008)
//	Sua doi            	: 
//	Chuc nang chinh  	: 	Quan tri danh muc san pham

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/product/category_admin/admin.html.php");
	require_once(ROOT_PATH."modules/product/category_admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listProductCategory();
			break;
		case "add":
			addProductCategory();
			break;
		case "edit":
			editProductCategory();
			break;	
		case "delete":
			deleteProductCategory();
			break;	
		default:
			listProductCategory();
			break;
	}
?>