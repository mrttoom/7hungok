<?php
//	Project            	:  	CMS
//	Nguoi tao          	:   GiangNM (01/09/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Cac ham xu ly he thong

function printEditor(){
	echo '<script type="text/javascript" language="javascript" src="'.SITE_PATH.'editor/tiny_mce/tiny_mce.js"></script>';
	initEditor();
}
function getEditor($strName, $strContent="",$width='600',$height='300')
{
	 echo '<textarea name="'.$strName.'" id="'.$strName.'" mce_editable="true" style="width:'.$width.'px; height:'.$height.'px;">'.$strContent.'</textarea>';
}
function getEditorContent($strContent)
{
	return stripslashes($strContent);
}
function initEditor()
{
	echo '
	<script language="javascript" type="text/javascript"> 	
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "style,layer,table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable",
		//theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		//theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		//theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		/*theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops",*/
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		//theme_advanced_path_location : "bottom",
		//content_css : "example_full.css",
	   // plugin_insertdate_dateFormat : "%Y-%m-%d",
	   // plugin_insertdate_timeFormat : "%H:%M:%S",
		//extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		//external_link_list_url : "example_link_list.js",
		//external_image_list_url : "example_image_list.js",
		//flash_external_list_url : "example_flash_list.js",
		file_browser_callback : "OpenWinMsg",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true
	});</script>
	';
}
function get_layout_file()
{
	global $block_center;
	$module = getParam('module', 'str', 'home');
	if(!$block_center[$module])
		$module = 'home';
	if(file_exists(ROOT_PATH.'themes/'.$block_center[$module]['layout']))
		require_once ROOT_PATH.'themes/'.$block_center[$module]['layout'];
	else
	{
		echo _CANNOT_FIND_LAYOUT;
		return;
	}
}
function get_region_content()
{
	global $block_center;
	$module = getParam('module', 'str', 'home');
	if(!$block_center[$module])
		$module = 'home';
	if($block_center[$module]['module'])
		foreach($block_center[$module]['module'] as $k=>$v)
			require_once ROOT_PATH.$v.'index.php';
}
function generate_url($module='home', $params=false)
{
	$request_string = '?module='.$module;
	if ($params)
	{
		foreach($params as $param=>$value)
		{
			if(is_numeric($param))
			{
				if(isset($_REQUEST[$value]))
				{
					$request_string .= '&'.$value.'='.urlencode($_REQUEST[$value]);
				}
			}
			else
			{
				$request_string .= '&'.$param.'='.urlencode($value);
			}
		}
	}
	return $request_string;
}
function generate_url_all($except=array(), $addition=false)
{
	$url='';
	foreach($_GET as $key=>$value)
	{
		if(!in_array($key, $except))
		{
			if(!$url)
			{
				$url='?'.urlencode($key).'='.urlencode($value);
			}
			else
			{
				$url.='&'.urlencode($key).'='.urlencode($value);
			}
		}
	}
	foreach($_POST as $key=>$value)
	{
		if(!in_array($key, $except))
		{
			if(!$url)
			{
				$url='?'.urlencode($key).'='.urlencode($value);
			}
			else
			{
				$url.='&'.urlencode($key).'='.urlencode($value);
			}
		}
	}
	if($addition)
	{
		if($url)
		{
			$url.='&'.$addition;
		}
		else
		{
			$url.='?'.$addition;
		}
	}
	return $url;
}
function replace_location($module='home', $params=false)
{
	$redirect_url = '?module='.$module;
	if ($params)
	{
		foreach($params as $param=>$value)
		{
			if(is_numeric($param))
			{
				if(isset($_REQUEST[$value]))
				{
					$redirect_url .= '&'.$value.'='.urlencode($_REQUEST[$value]);
				}
			}
			else
			{
				$redirect_url .= '&'.$param.'='.urlencode($value);
			}
		}
	}
	//header('Location:'.$redirect_url);
	echo '
		<script>
			window.location = "'.$redirect_url.'";
		</script>
	';
}
function getParam($name, $type = '', $default = '')
{
	$value = '';
	
	if (!empty($_POST[$name]))
		$value = $_POST[$name];
	elseif(!empty($_GET[$name]))
		$value = $_GET[$name];
	elseif(!empty($_REQUEST[$name] ))
		$value = $_REQUEST[$name];
	elseif(!empty($_FILES[$name] ))
		$value = $_FILES[$name];
	elseif(!empty($_COOKIE[$name]))
		$value = $_COOKIE[$name];
	
	switch($type)
	{
		case 'def':
			break;
		case 'int':
			$value = convert_to_int($value);
			break;
		case 'sql':
			$value = convert_to_sql($value);
			break;
		default:
			$value = convert_to_str($value);
	}
	if($value)
		return $value;
	else
		return $default;
}
//Conver to String (Su dung khi get cac gia tri khong su dung Editor)
function convert_to_str($val)
{
	if(get_magic_quotes_gpc() == 0)
		$val = addslashes($val);
	settype($val, 'string');
	$val = htmlspecialchars($val);
	return $val;
}
function convert_to_sql($val)
{
	if(get_magic_quotes_gpc() == 0) $val = addslashes($val);
	return $val;
}
function convert_to_int($val)
{
	$val = (int)$val;
	return $val;
}
function encode_password($password)
{
	return md5($password.'giangnm_acs');
}
function is_admin()
{
	if(!is_login())
		return false;
	if($_SESSION["user"]['usergroup']==3)
		return true;
	return false;
}
function is_content_management()
{
	if(!is_login())
		return false;
	if($_SESSION["user"]['usergroup']==2 || $_SESSION["user"]['usergroup']==3)
		return true;
	return false;
}
function is_internal_admin()
{
	if(!is_login())
		return false;
	if($_SESSION["user"]['usergroup']==4 || $_SESSION["user"]['usergroup']==3)
		return true;
	return false;
}
function is_login(){
	if(isset($_SESSION["user"])){
		return true;
	}
	return false;
}
function paging($totalitem, $itemperpage, $numpageshow=10, $page_name='page_no')
{	
	$content = '';
	
	$totalpage = ceil($totalitem/$itemperpage);
	if ($totalpage<2)
	{
		return 0;
	}
	$currentpage = getParam($page_name, 'int', 1);
	$currentpage = round($currentpage);
	
	if($currentpage<=0 || $currentpage > $totalpage)
	{
		$currentpage = 1;
	}
	
	if($currentpage > ($numpageshow/2))
	{
		$startpage = $currentpage-floor($numpageshow/2);
		if($totalpage-$startpage<$numpageshow)
		{
			$startpage=$totalpage-$numpageshow+1;
		}
	}
	else
	{
		$startpage=1;
	}
	if($startpage<1)
	{
		$startpage=1;
	}
	$content.= '<B>'._TOTAL.'</B> '.$totalitem.'. ';
	if($currentpage>1)
	{
		$content.= '<a href = "'.generate_url_all(array($page_name), $page_name.'='.($currentpage-1)).'" >'._NEXT_PAGE.'</a>';
	}
	//Danh sach cac trang
	$content.= '&nbsp;';
	if($startpage>1)
	{
		$content.= '<a href= "'.generate_url_all(array($page_name), $page_name.'=1').' ">1</a> | ';
		if($startpage>2)
		{
			$content.= '... | ';
		}
	}
	for($i=$startpage; $i<=$startpage+$numpageshow-1&&$i<=$totalpage; $i++)
	{
		if($i!=$startpage)
		{
			$content.= ' | ';
		}
		if($i==$currentpage)
		{
			$content.= '['.$i.']';
		}
		else 
		{
			$content.= '<a href= "'.generate_url_all(array($page_name),$page_name.'='.$i).' ">'.$i.'</a>';
		}
	}
	if($i==$totalpage)
	{
		$content.= ' | <a href= "'.generate_url_all(array($page_name),$page_name.'='.$totalpage).' ">'.$totalpage.'</a>';
	}
	else
	if($i<$totalpage)
	{
		$content.= ' | ... | <a href= "'.generate_url_all(array($page_name),$page_name.'='.$totalpage).' ">'.$totalpage.'</a>';
	}
	$content.= '&nbsp;';
	//Trang sau
	if($currentpage<$totalpage)
	{
		$content.= '&nbsp;&nbsp;<a href = "'.generate_url_all(array($page_name),$page_name.'='.($currentpage+1)).'">'._PREVIOUS_PAGE.'</a>';
	}
	return $content;
}
function get_end_word($str) 
{
	$str = trim($str);
	$str_arr = explode(' ',$str);
	return strtolower($str_arr[count($str_arr)-1]);
}
function get_option($options, $selected)
{
	if ($options)
	foreach($options as $key=>$text)
	{
		$input .= '<option value="'.$key.'"';
		if($key==$selected )
		{
			$input .=  ' selected';
		}
		$input .= '>'.$text.'</option>';
	}
	return $input;
}
function get_option_year($selected)
{
	$start_year = 1900;
	$end_year = date('Y', time()) + 50;
	for($i = $start_year; $i<=$end_year; $i++)
	{
		$input .= '<option value="'.$i.'"';
		if($i==$selected )
		{
			$input .=  ' selected';
		}
		$input .= '>'.$i.'</option>';
	}
	return $input;
}
function get_option_month($selected)
{
	$month_arr = array(1=>_MONTH_1, 2=>_MONTH_2, 3=>_MONTH_3, 4=>_MONTH_4, 5=>_MONTH_5, 6=>_MONTH_6, 6=>_MONTH_6, 7=>_MONTH_7, 8=>_MONTH_8, 9=>_MONTH_9, 10=>_MONTH_10, 11=>_MONTH_11, 12=>_MONTH_12);
	
	foreach($month_arr as $key=>$text)
	{
		$input .= '<option value="'.$key.'"';
		if($key==$selected )
		{
			$input .=  ' selected';
		}
		$input .= '>'.$text.'</option>';
	}
	return $input;
}
function get_option_day($selected)
{
	$start_day = 1;
	$end_day = 31;
	for($i = $start_day; $i<=$end_day; $i++)
	{
		$input .= '<option value="'.$i.'"';
		if($i==$selected )
		{
			$input .=  ' selected';
		}
		$input .= '>'.$i.'</option>';
	}
	return $input;
}	
function get_option_multi($options, $select_array)
{
	if ($options)
	foreach($options as $key=>$text)
	{
		$input .= '<option value="'.$key.'"';
		if(in_array($key, $select_array))
		{
			$input .=  ' selected';
		}
		$input .= '>'.$text.'</option>';
	}
	return $input;
}
function to_time($day, $month, $year)
{
	if(checkdate($month, $day, $year))
	{
	
		return strtotime($month.'/'.$day.'/'.$year);
	}
	else
	{
		return false;
	}		
}
function create_file($filename, $content)
{
	$fr = fopen($filename,'w+');
	fwrite ($fr,$content);
	fclose($fr);
}
function get_file_content($filename)
{
	if (file_exists($filename))
	{
		$fr = fopen($filename, 'r');
		$content = @fread($fr, filesize($filename));
		fclose($fr);
		return $content;
	}
	else
	{	
		return false;
	}
}
function delete_file($filename)
{
	if(file_exists($filename))
		@unlink($filename);
}
function string_strip($text)
{
	return stripslashes(stripslashes(stripslashes($text)));
}
function makeimage($filename,$newfilename,$path,$newwidth,$newheight, $watermark=false) {

	//SEARCHES IMAGE NAME STRING TO SELECT EXTENSION (EVERYTHING AFTER . )
	$image_type = strstr($filename, '.');

	//SWITCHES THE IMAGE CREATE FUNCTION BASED ON FILE EXTENSION
		switch($image_type) {
			case '.jpg':
				$source = imagecreatefromjpeg($path.$filename);
				break;		
			case '.JPG':
				$source = imagecreatefromjpeg($path.$filename);
				break;	
			case '.jpeg':
				$source = imagecreatefromjpeg($path.$filename);
				break;	
			case '.pjpeg':
				$source = imagecreatefromjpeg($path.$filename);
				break;		
			case '.png':
				$source = imagecreatefrompng($path.$filename);
				break;
			case '.gif':
				$source = imagecreatefromgif($path.$filename);
				break;
			case '.GIF':
				$source = imagecreatefromgif($path.$filename);
				break;
			case '.bmp':
				$source = imagecreatefromgif($path.$filename);
				break;
			case '.BMP':
				$source = imagecreatefromgif($path.$filename);
				break;
			default:
				echo("Error Invalid Image Type");
				die;
				break;
			}
	
	//CREATES THE NAME OF THE SAVED FILE
	$file = $newfilename . $filename;
	
	//CREATES THE PATH TO THE SAVED FILE
	$fullpath = $path . $file;

	//FINDS SIZE OF THE OLD FILE
	list($width, $height) = getimagesize($path.$filename);
	if(!$watermark)
	{
		//CREATES IMAGE WITH NEW SIZES
		$thumb = imagecreatetruecolor($newwidth, $newheight);

		//RESIZES OLD IMAGE TO NEW SIZES
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	}
	else
	{
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		for($i=0;$i<$newheight;$i+=100)
		{
			$color=imagecolorallocate($thumb,intval(rand(160,224)),intval(rand(160,224)),intval(rand(160,224)));
			imageline($thumb,0,$i,$newwidth,$i,$color);
		}
		$black = imagecolorallocate($thumb, intval(rand(160,224)), intval(rand(160,224)), intval(rand(160,224)));
		$font = 'arial.ttf';
		$font_size = 14;
		imagettftext($thumb, $font_size, 0, 10, 20, $black, $font, $watermark);
	}

	//SAVES IMAGE AND SETS QUALITY || NUMERICAL VALUE = QUALITY ON SCALE OF 1-100
	imagejpeg($thumb, $fullpath, 100);

	//CREATING FILENAME TO WRITE TO DATABSE
	$filepath = $fullpath;
	
	//RETURNS FULL FILEPATH OF IMAGE ENDS FUNCTION
	return $filepath;
}
function upload_image($dir, $imgtmp, $imgname, $image_size='')
{	
	if(!$image_size)
	{
		$small_width = 130;
		$small_height = 100;
		$large_width = 195;
		$large_height = 150;
	}
	else
	{
		$small_width = $image_size['0'];
		$small_height = $image_size['1'];
		$large_width = $image_size['2'];
		$large_height = $image_size['3'];
	}
	list($width, $height) = getimagesize($imgtmp);
	if($width > $large_width) $width = $large_width;
	if($height > $large_height) $height = $large_height;
	
	if(copy($imgtmp, $dir.$imgname))
	{					
		makeimage($imgname, 'small_', $dir, $small_width, $small_height);
		makeimage($imgname, 'large_', $dir, $width, $height);
		unlink($dir.$imgname);
	}
}
function upload_gallery($dir, $imgtmp, $imgname, $image_size='')
{	
	$small_width = 180;
	$small_height = 140;

	list($width, $height) = getimagesize($imgtmp);
	if(copy($imgtmp, $dir.$imgname))
	{					
		makeimage($imgname, 'small_', $dir, $small_width, $small_height);
		makeimage($imgname, 'large_', $dir, $width, $height);
		unlink($dir.$imgname);
	}
}
function upload_adv($dir, $imgtmp, $imgname)
{	
	list($width, $height) = getimagesize($imgtmp);
	if(copy($imgtmp, $dir.$imgname))
	{					
		makeimage($imgname, 'small_', $dir, $width, $height);
		unlink($dir.$imgname);
	}
}
function upload_document($dir, $doctmp, $docname)
{	
	if(copy($doctmp, $dir.$docname))
	{					
		return true;
	}
	return false;
}
function check_type_file($file_name, $type=array())
{
	if(!$type)	return false;
	if(
		!in_array(strtolower(substr($file_name, -3)), $type) && 
		!in_array(strtolower(substr($file_name, -4)), $type)
	) return false;
	else return true;
}
function get_file_type($file_name)
{
	return strrchr($file_name, '.');
}
function get_image($row, $type, $where = 'news')
{
	$image_file = DATA_PATH.'images/'.$where.'/'.$type.'_'.$row['image_name'];
	if(file_exists($image_file) and $row['image_name'])
		return SITE_PATH.'data/images/'.$where.'/'.$type.'_'.$row['image_name'];
	else
		return 	false;
}
function delete_image($row, $where = 'news')
{
	if($row['image_name'])
	{
		@unlink(DATA_PATH.'images/'.$where.'/small_'.$row['image_name']);
		@unlink(DATA_PATH.'images/'.$where.'/large_'.$row['image_name']);
	}
}
function delete_photo($row)
{
	if($row['image_name'])
	{
		@unlink(DATA_PATH.'images/photo/size1_'.$row['image_name']);
		@unlink(DATA_PATH.'images/photo/size2_'.$row['image_name']);
		@unlink(DATA_PATH.'images/photo/size3_'.$row['image_name']);
		@unlink(DATA_PATH.'images/photo/size4_'.$row['image_name']);
		@unlink(DATA_PATH.'images/photo/large_'.$row['image_name']);
	}
}
function get_document($row, $where = 'download')
{
	$document_file = DATA_PATH.'document/'.$where.'/'.$row['document_name'];
	if(file_exists($document_file) and $row['document_name'])
		return SITE_PATH.'data/document/'.$where.'/'.$row['document_name'];
	else
		return 	false;
}
function delete_document($row, $where = 'download')
{
	if($row['document_name'])
	{
		@unlink(DATA_PATH.'document/'.$where.'/'.$row['document_name']);
	}
}

function ipCheck()
{
	if (getenv('HTTP_CLIENT_IP'))
	{
		$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif (getenv('HTTP_X_FORWARDED_FOR'))
	{
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_X_FORWARDED'))
	{
		$ip = getenv('HTTP_X_FORWARDED');
	}
	elseif (getenv('HTTP_FORWARDED_FOR'))
	{
		$ip = getenv('HTTP_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_FORWARDED'))
	{
		$ip = getenv('HTTP_FORWARDED');
	}
	else
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
function get_day_of_week($time, $lang)
{
	$array_date = array(
		'0'=>_SUNDAY,
		'1'=>_MONDAY,
		'2'=>_TUESDAY,
		'3'=>_WEDNESDAY,
		'4'=>_THURSDAY,
		'5'=>_FRIDAY,
		'6'=>_SATURDAY,
	);
	if($lang=='vietnam')
	{
		$html = $array_date[date('w', $time)].', ngày '.date('d', $time).' tháng '.date('m', $time).' năm '.date('Y', $time);
	}
	else
	{
		$html .= $array_date[date('w', $time)].', ';
		$html .= date("j F Y", $time);
	}
	/*
	if($lang=='vietnam')
	{
		$html = $array_date[date('w', $time)].', ';
		$html .= date('d/m/Y', $time).' | ';
		$html .= date('H:i', $time);
	}
	else
	{
		$html = date('H:i', $time).' ';
		$html .= $array_date[date('w', $time)].', ';
		$html .= date("j F Y", $time);
	}
	*/
	return $html;
}

function upload_one_image($dir, $imgtmp, $imgname, $image_size='')
{	
	if(!$image_size)
	{
		$small_width = 144;
		$small_height = 127;
	}
	else
	{
		$small_width = $image_size[0];
		$small_height = $image_size[1];
	}		
	if(copy($imgtmp, $dir.$imgname))
	{					
		makeimage($imgname, 'small_', $dir, $small_width, $small_height);
		unlink($dir.$imgname);
	}
}

function delete_adv($row, $where = 'adv')
{
	if($row['image_name'])
	{
		@unlink(DATA_PATH.'images/'.$where.'/'.$row['image_name']);
	}
}
function get_image_adv($row, $where = 'adv')
{
	$image_file = DATA_PATH.'images/'.$where.'/'.$row['image_name'];
	if(file_exists($image_file) and $row['image_name'])
		return SITE_PATH.'data/images/'.$where.'/'.$row['image_name'];
	else
		return 	false;
}

function hightlight_keyword($source, $keywords)
{
 if($keywords)
  $source=preg_replace(array("/^($keywords)([^\w])/i","/([^\w])($keywords)([^\w])/i"), array("<strong><font style='background-color:yellow' color=black>\\1</font></strong>\\2","\\1<strong><font style='background-color:yellow' color=black>\\2</font></strong>\\3"), $source);
 return $source;
}

function get_num_word($str, $num) //$num là số kí tự cần cắt
{
	$sub_str = substr($str, $num+1, 10).' ';
	$pos=strpos($sub_str,' ');
	$st=substr($str,0,$num+$pos+2);
	return $st;
}

function getSubCat($db, $cat_id)
	{
		$subquery = 'SELECT * FROM product_category WHERE parent='.$cat_id;
		$db->setQuery($subquery);
		$subset = $db->loadResult();
		$id = 'idc';
		if($subset)
		{
			echo '<ul class="Menu">';
			foreach($subset as $set)
				echo '<li><a href="'.generate_url('product_category', array('idc'=>$set['id'])).'">'.$set['title'].'</a></li>';
			echo '</ul>';
		}

	}
?>