
<select name="link" onchange="window.open(this.value);" id="select2" class="bg_search1_form" style="width:180px; margin-top:5px;">
	<option>-- <?php echo _LINK;?> --</option>
	<?php
		global $database;
		global $current_lang;
		$query = "SELECT * from quick_link where lang='".$current_lang."' order by region";
		$database->setQuery($query);
		$database->query();
		$all_quick_link = $database->loadResult();
		if($all_quick_link)
		{
			foreach($all_quick_link as $one)
			{
				echo '<option value="'.$one['link'].'">-&nbsp;'.get_num_word($one['title'],50).'</option>';
			}
		}
	?>	
</select>