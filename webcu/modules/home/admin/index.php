<script language="javascript">
	function submitform()
	{
		document.FormHomeAdmin.submit();
	}
</script>
<?php
	//Kiem tra quyen
	if(!is_content_management())
		replace_location('sign_in');
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `home` WHERE lang="'.$current_lang.'" ';
	$database->setQuery($query);
	$home = $database->loadRow();
	
	if($database->getErrorNum()){
		echo $database->stderr();
		return;
	}
	
	$action = getParam("action", 'str');
	if($action == "save")
	{
		$title = getParam('title', 'str');
		$content = getParam('content', 'def');
		$total = $database->getNumRows('home', ' lang="'.$current_lang.'"');
		$is_valid = 1;
		if(!$title)
		{
			$error = '<span class="require_field">'._REQUIRED_FILED.'</span>';
			$is_valid = 0;
		}
		if($is_valid)
		{			
			$user_create = $_SESSION['user']['user_name'];
			$time_create = time();
			if($total==1)
			{
				$query = "UPDATE `home` SET `title`='$title', `content` = '$content', `user_update`='$user_update', `time_update` = '$time_update' WHERE `id`='".$home['id']."'";
				$database->setQuery($query);
				$database->query();
			}
			else
			{
				$database->setQuery('SELECT max(id) as max_id from home');
				$row = $database->loadRow();
				$max_id = $row['max_id']+1;
				$query = "INSERT INTO `home` (`id`, `title`, `content`, `user_create`, `time_create`, `user_update`, `time_update`, `lang`)
							 VALUES('$max_id', '$title', '$content', '$user_create', '$time_create', '$user_create', '$time_create', '$current_lang')";
				$database->setQuery($query);
				$database->query();
			}
			echo '
			<script>
				alert("Cập nhật thành công!");
								
			</script>';
			replace_location('profile');
		}		
	}
	
?>
<form name="FormHomeAdmin" id="FormHomeAdmin" method="post" action="" enctype="multipart/form-data">
<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td class="menudottedline" align="right">
				<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
					<tbody>
						<tr align="center" valign="middle">
							<td><a class="toolbar" href="javascript: submitform();"><img name="save"  src="<?php echo SITE_PATH;?>themes/images/save.png" alt="Cancel" name="Cancel" title="Cancel" align="middle" border="0">
									<br />Save
								</a>
							</td>
							<td>&nbsp;</td>
							<td>
								<a class="toolbar" href="<?php echo generate_url('profile'); ?>">
									<img src="<?php echo SITE_PATH;?>themes/images/cancel.png" alt="Cancel" name="Cancel" title="Cancel" align="middle" border="0">
									<br />Cancel
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<br />
<div class="centermain" align="center">
	<div class="main">
		<table class="adminheading">
			<tbody>
				<tr>
					<th>
						<?php echo _HOME_ADMIN ?>
					</th>
				</tr>
			</tbody>
		</table>
		<table class="adminform">
			<tbody>
				<tr>
					<th colspan="2">
						<?php echo _HOME_ADMIN;?>
					</th>
				</tr>
				<tr>
					<td width="130px">
						<?php echo _TITLE; ?>
					</td>
					<td>
						<input name="title" class="inputbox" style="width:500px;" value="<?php echo getParam('title', 'str', string_strip($home['title']));?>" type="text">&nbsp;<?php echo $error; ?>
					</td>
				</tr>
				<tr>
					<td><?php echo _CONTENT; ?></td>
					<td>
						<?php 
							printEditor();
							getEditor('content', $home['content'], 700, 350);
						?>
					</td>
				</tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><span class="require_field">(*)</span> <?php echo _REQUIRED_FILED; ?></td>
						</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>				
			</tbody>
		</table>
	</div>
</div>
<input type="hidden" name="action" value="save" />
</form>