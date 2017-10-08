<?php
	$counter = 0;
	$timeout = 600;
	$user_ar=array(
			'ip'		=> 	ipCheck(),
			'timestamp'	=>	time(),
			'session_id'=>	session_id(),
			'ref_url'	=>	$_SERVER['HTTP_REFERER'],
			'user_agent'=>	$_SERVER['HTTP_USER_AGENT'],
			'user_name'	=>	'',
			'user_id'	=>	0,
		) ;
	if(isset($_SESSION['user']))
	{
		$user 					= 	$_SESSION['user'];
		$user_ar['user_name']	=	$user['user_name'];
		$user_ar['user_id']		=	$user['id'];
	}
	global $database;
	$database->setQuery('select * from counter where 1');
	$database->query();
	$counter_data = $database->loadRow();
	$counter = $counter_data['counter'];

	$database->setQuery('select id from user_online where ip="'.$user_ar['ip'].'" and timestamp >= '.(time()-$timeout));
	$database->query();
	if(!$database->loadRow())
	{
		$counter += 1;
		$query = "UPDATE counter SET `counter`='$counter' WHERE 1";		
		$database->setQuery($query);
		$database->query();
	}
	$database->setQuery("DELETE FROM `user_online` WHERE `timestamp` < '".(time()-600)."' OR `session_id` ='".$user_ar['session_id']."'");
	$database->query();
	$database->insertObject("user_online", $user_ar);
	$user_online = $database->getNumRows('user_online', ' timestamp > '.(time() - $timeout));
?>
<div id="boder">
	<div class="td01">
		<div class="td01_icon"><img src="<?php echo SITE_PATH;?>themes/images/icon-bo-dem.gif" /></div>
		<div class="td01_text"><?php echo _COUNTER;?></div>
	</div>
	<div class="noidung">
		<?php echo _PAGE_VIEW;?>: <b><?php echo $counter;?></b><br />
		<?php echo _USER_ONLINE;?>: <b><?php echo $user_online?></b>
	</div>
</div>
						
						
