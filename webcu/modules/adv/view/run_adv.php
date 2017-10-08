<?php
	global $database;
	$query = "SELECT * from adv order by region limit 0,2";
	$database->setQuery($query);
	$database->query();
	$right_adv = $database->loadResult();
	if($right_adv)
	{
		$i = 0;
		foreach($right_adv as $one)
		{
			$image_src = get_image($one, 'small', 'adv');
			if($i==0)
			{
?>
				<div style="left: 131.5px; width: 100px; float: left; position: absolute; z-index: 10000; top: 0px; margin-left: 3px;" name="divAdLeft" id="divAdLeft" align="left">
					<span id="adv_top_left">
						<div style="padding-top: 2px;" align="center"><a href="#" target="_blank"><img src="<?php echo $image_src;?>"></a></div>
					</span>
					<span id="adv_bottom_left"></span>
				</div>
<?php
			}
			else
			{
?>
				<div style="left: 1031.5px; width: 100px; float: right; position: absolute; z-index: 10000; top: 71px; margin-right: 5px;" divadright="" id="divAdRight"> 
					<span id="adv_top_right">
					<div style="padding-top: 2px;" align="center"><a href="#" target="_blank"><img src="<?php echo $image_src;?>"></a></div></span>
				</div>
<?php
			}
			$i++;
		}
	}
?>
<script>
ShowAdDiv();
</script>