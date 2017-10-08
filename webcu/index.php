<?php	
	session_start(1);
	header("Content-Type: text/html; charset=utf-8");
	
	define('ROOT_PATH', '');
	define('DATA_PATH', 'data/');
	define('SITE_PATH', '');
	define('USE_SEO', 0);
	if(USE_SEO)
	{
		global $url_array;
		$array_list = split('/', $_SERVER['REQUEST_URI']);
		if($array_list)
			foreach($array_list as $one)
			{
				if($one)
				{
					$one_list = split('=', $one);
					if($one_list)
						$url_array[$one_list[0]] = $one_list[1];
				}
			}
	}
	global $current_lang;
	$current_lang = 'vietnam';
	
	if(!empty($url_array['lang']))
	{
		$_REQUEST['lang'] = $url_array['lang'];
	}
	elseif(!empty($_POST['lang']))
	{
		$_REQUEST['lang'] = $_POST['lang'];
	}
	elseif(!empty( $_GET['lang'] ) )
	{
		$_REQUEST['lang'] = $_GET['lang'];
	}
	elseif(!empty($_SESSION['lang']))
	{
		$_REQUEST['lang'] = $_SESSION['lang'];
	}
	if(isset($_REQUEST['lang']))
	{
		if (!isset($_SESSION['lang']) && ($_REQUEST['lang'] != $current_lang))
		{	 
			$_SESSION['lang'] = $_REQUEST['lang'];
		}
		if(isset($_SESSION['lang']) && ($_REQUEST['lang'] != $_SESSION['lang']))
		{
			$_SESSION['lang'] = $_REQUEST['lang'];
		}
		$current_lang = $_REQUEST['lang'];
	}
	if(!file_exists(ROOT_PATH.'languages/'.$current_lang.'.php'))
		$current_lang = 'vietnam';
	
	include ROOT_PATH.'languages/'.$current_lang.'.php';
	
	if(file_exists(ROOT_PATH."includes/configuration.php"))
		require_once(ROOT_PATH."includes/configuration.php");
	else
	{
		echo _CANNOT_FIND_CONFIGURATION;
		exit();
	}
?>