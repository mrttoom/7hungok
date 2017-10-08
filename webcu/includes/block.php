<?php
//	Project            	:  	Vihatra
//	Nguoi tao          	:   GiangNM (12/08/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Cau hinh cac trang

global $block_center;

/*
---- Trang quan tri
*/
//Upload anh
$block_center['upload_image']['layout'] = 'blank.php';
$block_center['upload_image']['module'] = array('0'=>'modules/upload/image/');
//Upload tai lieu
$block_center['upload_link']['layout'] = 'blank.php';
$block_center['upload_link']['module'] = array('0'=>'modules/upload/document/');
//Upload media
$block_center['upload_flash']['layout'] = 'blank.php';
$block_center['upload_flash']['module'] = array('0'=>'modules/upload/media/');
//Dang nhap
$block_center['sign_in']['layout'] = 'index1.php';
$block_center['sign_in']['module'] = array('0'=>'modules/user/user_sign_in/');
//Thoat
$block_center['sign_out']['layout'] = 'blank.php';
$block_center['sign_out']['module'] = array('0'=>'modules/user/user_sign_out/');
//Trang quan tri nguoi dung
$block_center['user_admin']['layout'] = 'admin.php';
$block_center['user_admin']['module'] = array('0'=>'modules/user/user_admin/');
//Trang ca nhan
$block_center['profile']['layout'] = 'admin.php';
$block_center['profile']['module'] = array('0'=>'modules/user/user_profile/');
//Quan tri Gioi thieu
$block_center['about_us_admin']['layout'] = 'admin.php';
$block_center['about_us_admin']['module'] = array('0'=>'modules/about_us/admin/');
//Quan tri mail lien he gui review
$block_center['review_mail_admin']['layout'] = 'admin.php';
$block_center['review_mail_admin']['module'] = array('0'=>'modules/review/mail_admin/');
//Quan tri thong tin lien he
$block_center['contact_info_admin']['layout'] = 'admin.php';
$block_center['contact_info_admin']['module'] = array('0'=>'modules/contact/contact_info/admin/');
//Quan tri lien he
$block_center['contact_admin']['layout'] = 'admin.php';
$block_center['contact_admin']['module'] = array('0'=>'modules/contact/contact/admin/');
//Quan tri noi dung footer
$block_center['footer_admin']['layout'] = 'admin.php';
$block_center['footer_admin']['module'] = array('0'=>'modules/footer/admin/');
//Quan tri lien ket
$block_center['quick_link_admin']['layout'] = 'admin.php';
$block_center['quick_link_admin']['module'] = array('0'=>'modules/quick_link/admin/');
//Quan tri tuyen dung
$block_center['recruit_admin']['layout'] = 'admin.php';
$block_center['recruit_admin']['module'] = array('0'=>'modules/recruit/admin/');
//Quan tri banner
$block_center['adv_admin']['layout'] = 'admin.php';
$block_center['adv_admin']['module'] = array('0'=>'modules/adv/admin/');
//Quan tri tham do y kien
$block_center['survey_admin']['layout'] = 'admin.php';
$block_center['survey_admin']['module'] = array('0'=>'modules/survey/admin/');
//Quan tri Danh muc tin 
$block_center['news_category_admin']['layout'] = 'admin.php';
$block_center['news_category_admin']['module'] = array('0'=>'modules/news/category_admin/');
//Quan tri tin
$block_center['news_admin']['layout'] = 'admin.php';
$block_center['news_admin']['module'] = array('0'=>'modules/news/admin/');
//Quan tri Danh muc du an
$block_center['product_category_admin']['layout'] = 'admin.php';
$block_center['product_category_admin']['module'] = array('0'=>'modules/product/category_admin/');
//Quan tri du an
$block_center['product_admin']['layout'] = 'admin.php';
$block_center['product_admin']['module'] = array('0'=>'modules/product/admin/');




//Quan tri thuvien anh
$block_center['gallery_admin']['layout'] = 'admin.php';
$block_center['gallery_admin']['module'] = array('0'=>'modules/gallery/admin/');
//Quan tri faq
$block_center['faq_admin']['layout'] = 'admin.php';
$block_center['faq_admin']['module'] = array('0'=>'modules/faq/admin/');
//Quan tri bo suu tap
$block_center['internal_company_admin']['layout'] = 'admin.php';
$block_center['internal_company_admin']['module'] = array('0'=>'modules/internal_company/admin/');
//Quan tri danh muc noi bo
$block_center['internal_company_admin']['layout'] = 'admin.php';
$block_center['internal_company_admin']['module'] = array('0'=>'modules/internal_company/admin/');
//Quan tri noi bo
$block_center['internal_company_category_admin']['layout'] = 'admin.php';
$block_center['internal_company_category_admin']['module'] = array('0'=>'modules/internal_company/category_admin/');
//Quan tri danh muc kenh phan phoi
$block_center['channel_distribute_admin']['layout'] = 'admin.php';
$block_center['channel_distribute_admin']['module'] = array('0'=>'modules/channel_distribute/admin/');
//Quan tri kenh phan phoi
$block_center['channel_distribute_category_admin']['layout'] = 'admin.php';
$block_center['channel_distribute_category_admin']['module'] = array('0'=>'modules/channel_distribute/category_admin/');
//Quan tri danh muc quan he co dong
$block_center['economic_relations_admin']['layout'] = 'admin.php';
$block_center['economic_relations_admin']['module'] = array('0'=>'modules/economic_relations/admin/');
//Quan tri quan he co dong
$block_center['economic_relations_category_admin']['layout'] = 'admin.php';
$block_center['economic_relations_category_admin']['module'] = array('0'=>'modules/economic_relations/category_admin/');



/*
---- Trang hien thi
*/

//Trang chu
$block_center['home']['layout'] = 'index.php';
$block_center['home']['module'] = array('0'=>'modules/product/view/','1'=>'modules/news/view/');

//Trang gioi thieu
$block_center['about_us']['layout'] = 'index1.php';
$block_center['about_us']['module'] = array('0'=>'modules/about_us/view/');
//Trang tin lien he
$block_center['contact']['layout'] = 'index1.php';
$block_center['contact']['module'] = array('0'=>'modules/contact/view/');
//Trang tim kiem
$block_center['search']['layout'] = 'index1.php';
$block_center['search']['module'] = array('0'=>'modules/search/process/');
//Trang tin tin
$block_center['news']['layout'] = 'index1.php';
$block_center['news']['module'] = array('0'=>'modules/news/view/browse/');
//Trang tin tin
$block_center['news_detail']['layout'] = 'index1.php';
$block_center['news_detail']['module'] = array('0'=>'modules/news/view/detail/');
//Trang san pham
$block_center['product']['layout'] = 'index1.php';
$block_center['product']['module'] = array('0'=>'modules/product/view/view_all/');
//Trang san pham
$block_center['product_category']['layout'] = 'index1.php';
$block_center['product_category']['module'] = array('0'=>'modules/product/view/browse/');
//Trang san pham
$block_center['product_detail']['layout'] = 'index1.php';
$block_center['product_detail']['module'] = array('0'=>'modules/product/view/detail/');
//Trang thu vien anh
$block_center['gallery']['layout'] = 'index1.php';
$block_center['gallery']['module'] = array('0'=>'modules/gallery/view/');
//Trang tin tin
$block_center['channel_distribute']['layout'] = 'index1.php';
$block_center['channel_distribute']['module'] = array('0'=>'modules/channel_distribute/view/browse/');
//Trang tin tin
$block_center['channel_distribute_detail']['layout'] = 'index1.php';
$block_center['channel_distribute_detail']['module'] = array('0'=>'modules/channel_distribute/view/detail/');
//Trang tin tin
$block_center['economic_relations']['layout'] = 'index1.php';
$block_center['economic_relations']['module'] = array('0'=>'modules/economic_relations/view/browse/');
//Trang tin tin
$block_center['economic_relations_detail']['layout'] = 'index1.php';
$block_center['economic_relations_detail']['module'] = array('0'=>'modules/economic_relations/view/detail/');
//Trang tin tin
$block_center['internal_company']['layout'] = 'index1.php';
$block_center['internal_company']['module'] = array('0'=>'modules/internal_company/view/browse/');
//Trang tin tin
$block_center['internal_company_detail']['layout'] = 'index1.php';
$block_center['internal_company_detail']['module'] = array('0'=>'modules/internal_company/view/detail/');
//Trang gioi thieu
$block_center['faq']['layout'] = 'index1.php';
$block_center['faq']['module'] = array('0'=>'modules/faq/view/');

?>