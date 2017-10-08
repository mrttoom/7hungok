<?php
	global $database;
	global $current_lang;
	$query = "SELECT * from survey where `lang`= '".$current_lang."' and `status` = '1' order by id desc limit 0, 1";
	$database->setQuery($query);
	$database->query();
	$row = $database->loadRow();
	if($row)
	{
		$query = "SELECT * from survey_option where `survey_id`=".$row['id']." order by id";
		$database->setQuery($query);
		$database->query();
		$all_answer = $database->loadResult();
	}
	if($row and $all_answer)
	{
		echo '<div id="boder"><div class="td01">
				<div class="td01_icon"><img src="'.SITE_PATH.'themes/images/icon-chung-cau-y-kien.gif" /></div>
				<div class="td01_text">'._SURVEY.'</div>
			</div>';
		
		echo '<form action="" method="get" class="noidung" style="width:170px;"><b><i>'.$row['title'].'</i></b><br />';
		foreach ($all_answer as $one_a)
		{
			if($row['type']==1)
			{
?>
				<input name="survey_id_<?php echo $row['id'];?>[]" type="radio" value="<?php echo $one_a['id']?>" id="survey_id[]" />&nbsp;<?php echo string_strip($one_a['name']);?><br />
<?php				
			}
			else
			{
?>				<input name="survey_id_<?php echo $row['id'];?>[]" type="radio" value="<?php echo $one_a['id']?>" id="survey_id[]" />&nbsp;<?php echo string_strip($one_a['name']);?><br />
<?php
			}
		}
		echo '			
			<a href="#" onclick="javascript:window.open(\''.generate_url('survey_result', array('id'=>$row['id'])).'\',\'\',\'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=600,left = 100,top = 10\')">
				<input name="'._RESULT.'" type="button" value="'._RESULT.'" />
			</a>';
		
		echo '<a href="#" onclick="javascript:window.open(\''.generate_url('survey_result', array('id'=>$row['id'])).'&ids=\'+survey_list(\'survey_id_'.$row['id'].'[]\'),\'\',\'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=600,left = 200,top = 10\')">		
				<input name="'._VOTE.'" type="button" value="'._VOTE.'" /></a>
		</form></div>';
	}
?>

<script>
function survey_list(item_name)
{
	var arr = document.getElementsByName(item_name);
	if (arr.length)
	{
		st='';
		for (i=0;i<arr.length;i++)
		{
			if(arr[i].checked)
			{
				if(st!='')
				{
					st+=',';
				}
				st+=arr[i].value;
			}
		}
		return st;
	}
	else
	{
		if(arr.checked)
		{
			return arr.value;
		}
	}
	return '';
}
</script>