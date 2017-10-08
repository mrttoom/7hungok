<?php
//	Project            	:  	Habeco
//	Nguoi tao          	:   GiangNM (28/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri tham do y kien

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
		
	require_once(ROOT_PATH."modules/survey/admin/admin.html.php");
	require_once(ROOT_PATH."modules/survey/admin/admin.function.php");
	
	$task = getParam('task');	
	switch($task){
		case "list":	
			listSurvey();
			break;
		case "add":
			addSurvey();
			break;
		case "edit":
			editSurvey();
			break;	
		case "delete":
			deleteSurvey();
			break;	
		default:
			listSurvey();
			break;
	}
?>	