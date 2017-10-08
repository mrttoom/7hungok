<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php

$fp = fopen("slides1.xml", "w+");
fwrite($fp, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n");

fwrite($fp, "<flash_parameters copyright=\"socusoftFSMTheme\">\n");

	fwrite($fp, "<preferences>\n"); 
	fwrite($fp, "<global>\n"); 
	fwrite($fp, "<basic_property movieWidth=\"580\" movieHeight=\"250\" startAutoPlay=\"true\" backgroundColor=\"0x999999\" continuum=\"true\" html_title=\"Title\" loadStyle=\"Bar\" socusoftMenu=\"false\" hideAdobeMenu=\"false\" photoDynamicShow=\"true\" enableURL=\"false\" transitionArray=\"\"/>\n"); 
	
fwrite($fp, " <title_property photoTitle=\"false\" photoTitleX=\"5\" photoTitleY=\"25\" photoTitleSize=\"20\" photoTitleFont=\"Verdana\" photoTitleColor=\"0xffffff\"/>\n"); 
fwrite($fp, " <music_property path=\"\" stream=\"true\" loop=\"true\"/>\n"); 
fwrite($fp, "<photo_property topPadding=\"0\" bottomPadding=\"0\" leftPadding=\"0\" rightPadding=\"0\"/>\n"); 
fwrite($fp, "<properties enable=\"false\" backgroundColor=\"0xffffff\" backgroundAlpha=\"30\" cssText=\"a:link{text-decoration: underline;} a:hover{color:#ff0000; text-decoration: none;} a:active{color:#0000ff;text-decoration: none;} .blue {color:#0000ff; font-size:15px; font-style:italic; text-decoration: underline;} .body{color:#ff5500;font-size:20px;}\" align=\"top\"/>\n"); 
fwrite($fp, "</global>\n"); 
fwrite($fp, "<control>\n"); 
fwrite($fp, "<basic_property showControl=\"false\" showControlX=\"-30\" showControlY=\"460\" showPreviousButton=\"res/previous01.gif\" showPreviousButtonX=\"50\" showStopButton=\"res/stop01.gif\" showStopButtonX=\"97\" showPlayButton=\"res/play01.gif\" showPlayButtonX=\"97\" showNextButton=\"res/next01.gif\" showNextButtonX=\"124\" showSoundButtonX=\"182\"/>\n"); 
fwrite($fp, "</control>\n"); 
fwrite($fp, "</preferences>\n"); 
fwrite($fp, "<album>\n"); 





                      $sqlstr=mysql_query("SELECT * FROM ".ads." WHERE status='true'  AND alignment='3'  ORDER BY stt DESC");
                      if(mysql_num_rows($sqlstr)>0) {
                     
                      while($row=mysql_fetch_array($sqlstr)) {
					             
				fwrite($fp, "<slide d_URL=\"images/ads/".$row[picture]."\" transition=\"0\" panzoom=\"1\" URLTarget=\"0\" phototime=\"2\"  title=\"1\" width=\"580\" height=\"250\"/>\n"); 	 
					 } }
					 
					 




fwrite($fp, " </album>\n"); 
fwrite($fp, " </flash_parameters>\n"); 





  echo "Bạn đã cập nhật thành công, Để xem ảnh flash hoạt động xin hãy xóa hết cokies trình duyệt, hoặc sang máy tính khác để xem";



 ?> 

 
