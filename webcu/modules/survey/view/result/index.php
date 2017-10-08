<?php
	global $database;
	global $current_lang;
	$ids = getParam('ids');
	$idph = getParam('id');
	if ($ids!='')
	{
		$ids1='('.$ids.')';
		$database->setQuery('update `survey_option` set count=count+1 where id in '.$ids1);
		$database->query();
		
		replace_location('survey_result', array('id'=>$idph));
	}
	
	$query = "SELECT * from survey where `lang`= '".$current_lang."' and `status` = '1' and `id` = '".getParam('id')."' order by id desc limit 0, 1";
	$database->setQuery($query);
	$database->query();
	$row = $database->loadRow();
	if($row)
	{				
		$query = "SELECT * from survey_option where `survey_id`=".$row['id']." order by id";
		$database->setQuery($query);
		$database->query();
		$all_answer = $database->loadResult();
		
		$database->setQuery('select sum(count) as total from `survey_option` where survey_id="'.$row['id'].'"');
		$database->query();
		$num = $database->loadRow();
		$num = $num['total'];
	}
?>
<table border="0" width="350" height="400" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td align="center" valign="middle" height="50"><?php echo _SURVEY_RESULT;?></td>
    </tr>
	<tr>
		<td width='100%'>
			<?php echo $row['title'];?>
		</td>
	</tr>
     <tr>
        <td align="right"><hr></td>
    </tr>  
    <tr>
        <td width="100%" align="left">
            <table border="0" width="100%" cellpadding="0" cellspacing="0">
			<?php 
				$i = 0;
				foreach ($all_answer as $opt)
				{
					$color += 358346;
					if($color>1000000){$color=$color-1000000;}
					if($color<100000){$color+=300000;}
					$i++;
					if($num>0)
					{
						$percent = round($opt['count']/$num*100);
					}
					else 
					{
						$percent = 0;
					}
					echo '
						<tr>
							<td valign="top" colspan="3">&nbsp;&nbsp;'.string_strip($opt['name']).' ('.$opt['count'].' '._VOTE.')</td>
						</tr>
					';
					echo '
						<tr>
							<td width="5%">&nbsp;</td>	
							<td width="60%" height="35" valign="middle">
								<table width="'.$percent.'%" height="70%"><tr><td bgcolor="#'.$color.'"></td></tr></table>
							</td>
						   <td width="10%" valign="middle">'.$percent.'%</td>
						</tr>
					';
				}
			?>
            </table>
        </td>
    <tr>
        <td align="right"><hr></td>
    </tr>      
    <tr>
        <td align="center"><?php echo _TOTAL.': '.$num.' '._VOTE; ?></td>
    </tr>    
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td align="center"><input  class="button" type="submit" name="close" value="Close" onclick="javascript:window.close()"></td>
	</tr>
    </tr>
</table>