<?php
//	Project            	:  	EPAGE
//	Nguoi tao          	:   GiangNM (01/09/2008)
//	Sua doi            	:   
//	Chuc nang chinh  	: 	Quan tri thong tin lien he

	//Kiem tra quyen
	if(!is_content_management())
		replace_location('home');

	global $current_lang;
	$content = string_strip(getParam("content", 'def'));
	$file_name= DATA_PATH.'html/contact_info/contact_info_'.$current_lang.'.html';
		
	$action = getParam("action", 'str');
	if($action == "save")
	{
		create_file($file_name, $content);
		echo '
			<script>
				alert("'._UPDATE_SUCCESS.'!");
				window.location = \''.generate_url('profile').'\';
			</script>';
		exit;
	}
?>
<form name="FormContactInfoAdmin" method="post">
<script>
	function submitbutton(pressbutton)
	{
		document.FormContactInfoAdmin.action.value=pressbutton;
		try
		{
			document.FormContactInfoAdmin.onsubmit();
		}
		catch(e)
		{}
		document.FormContactInfoAdmin.submit();
	}
</script>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td class="menudottedline" align="right">
				<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
					<tbody>
						<tr align="center" valign="middle">
							<td>
								<a class="toolbar" href="javascript:submitbutton('save');">
									<img src="<?php echo SITE_PATH;?>themes/images/save.png" alt="<?php echo _SAVE;?>" name="<?php echo _SAVE;?>" title="<?php echo _SAVE;?>" align="middle" border="0">
									<br />
									<?php echo _SAVE;?>
								</a>
							</td>
							<td>&nbsp;</td>
							<td>
								<a class="toolbar" href="<?php echo generate_url('profile'); ?>">
									<img src="<?php echo SITE_PATH;?>themes/images/cancel.png" alt="<?php echo _CANCEL;?>" name="<?php echo _CANCEL;?>" title="<?php echo _CANCEL;?>" align="middle" border="0">
									<br /><?php echo _CANCEL;?>
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
						<?php echo _CONTACT_INFO_ADMIN;?>
					</th>
				</tr>
			</tbody>
		</table>
		<table class="adminform">
			<tbody>
				<tr>
					<th>
						<?php echo _CONTACT_INFO_ADMIN;?>
					</th>
				</tr>
				<tr>
					<td width="100%">
						<?php 
							printEditor(); 
							getEditor('content', get_file_content($file_name), 800, 400);
						?>
					</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<input type="hidden" name="action" value="" />
</form>