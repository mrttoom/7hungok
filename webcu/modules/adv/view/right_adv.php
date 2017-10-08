<div id="boder">
	<div class="td01">
		<div class="td01_icon"><img src="<?php echo SITE_PATH;?>themes/images/icon-quangcao.gif" /></div>
		<div class="td01_text"><?php echo _ADV;?></div>
	</div>
	<div class="noidung" align="center">
<?php
	global $database;
	$query = "SELECT * from adv order by region";
	$database->setQuery($query);
	$database->query();
	$right_adv = $database->loadResult();
	if($right_adv)
	foreach($right_adv as $one)
	{
		$content =explode('.', $one['image_name'], 2);
		if($content[1] == 'swf'){
		echo '<a href="'.$one['link'].'">
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="150">
			  <param name="movie" value="images/intro.swf" />
			  <param name="quality" value="high" />
			  <embed src="'.DATA_PATH.'images/adv/'.$one['image_name'].'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="150"></embed>
		  </object></a><br />';
		}else{
		echo '<a href="'.$one['link'].'"><img src="'.DATA_PATH.'images/adv/'.$one['image_name'].'" width="150px" /></a><br />';
		}
	}
?>
	</div>
</div>
