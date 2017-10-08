<?php
//	Project            	:  	CMS
//	Nguoi tao          	:   GiangNM (08/06/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri thông tin cá nhân

	//Kiem tra quyen
	if(!is_login())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/user/user_profile/admin.html.php");
	require_once(ROOT_PATH."modules/user/user_profile/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "edit":
			editProfile();
			break;	
		case "change_pass":
			changePass();
			break;				
		default:
			editProfile();
			break;
	}
?>	