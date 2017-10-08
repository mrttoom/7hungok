<?php
class HTML_profile
{
	function editProfile($row, $error_array)
	{
	?>
		<form name="FormEditProfile" method="post">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormEditProfile.action.value=pressbutton;
				try
				{
					document.FormEditProfile.onsubmit();
				}
				catch(e)
				{}
				document.FormEditProfile.submit();
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
								<?php echo _PROFILE; ?>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminform">
					<tbody>
						<tr>
							<th colspan="3">
								<?php echo _PROFILE; ?>
							</th>
						</tr>
						<tr>
							<td width="130">
								<?php echo _FULL_NAME; ?> <span class="require_field">(*)</span>
							</td>
							<td width="270">
								<input name="full_name" class="inputbox" size="40" value="<?php echo getParam('full_name', 'str', $row['full_name']);?>" maxlength="50" type="text">
							</td>
							<td>
							<?php echo $error_array['full_name']; ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _USER_NAME; ?>
							</td>
							<td colspan="2">
								<strong><?php echo $row['user_name'];?></strong>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _BIRTH_DATE; ?>
							</td>
							<td colspan="2">
								<select name="str_month">
									<?php 
										if($row['birth_date'])
											$month_select = date('m', $row['birth_date']);
										else
											$month_select = date('m', time());
										echo get_option_month(getParam('str_month', 'int', $month_select));
									?>
								</select>&nbsp;
								<select name="str_day">
									<?php
										if($row['birth_date'])
											$day_select = date('d', $row['birth_date']);
										else
											$day_select = date('d', time());
										echo get_option_day(getParam('str_day', 'int', $day_select));
									?>
								</select>&nbsp;
								<select name="str_year">
									<?php 
										if($row['birth_date'])
											$year_select = date('Y', $row['birth_date']);
										else
											$year_select = date('Y', time());
										echo get_option_year(getParam('str_year', 'int', $year_select));
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _GENDER; ?>
							</td>
							<td colspan="2">
								<select name="gender"><?php $gender_array = array('0'=>_MALE, '1'=>_FEMALE); echo get_option($gender_array, getParam('gender', 'int', $row['gender'])); ?></select>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _EMAIL; ?>
							</td>
							<td colspan="2">
								<input class="inputbox" name="email" size="40" value="<?php echo getParam('email', 'str', $row['email']);?>" type="text">
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _PHONE; ?>
							</td>
							<td colspan="2">
								<input class="inputbox" name="phone" size="40" value="<?php echo getParam('phone', 'str', $row['phone']);?>" type="text">
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _ADDRESS; ?>
							</td>
							<td colspan="2">
								<input class="inputbox" name="address" size="40" value="<?php echo getParam('address', 'str', $row['address']);?>" type="text">
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _LOCK; ?>
							</td>
							<td colspan="2">	
								<select name="lock" disabled="disabled">
									<?php
										$lock_arr = array(0=>_UNLOCK, 1=>_LOCK);
										echo get_option($lock_arr, getParam('lock', 'int', $row['lock'])); 
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _PERMISSION; ?>
							</td>
							<td colspan="2">	
								<select name="permission" disabled="disabled">
									<?php global $permission; echo get_option($permission, getParam('permission', 'int', $row['usergroup'])); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="2"><span class="require_field">(*)</span> <?php echo _REQUIRED_FILED; ?></td>
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
	<?php
	}
	function changePass($row, $error_array)
	{
	?>
		<form name="FormChangePass" method="post">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormChangePass.action.value=pressbutton;
				try
				{
					document.FormChangePass.onsubmit();
				}
				catch(e)
				{}
				document.FormChangePass.submit();
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
								<?php echo _PROFILE; ?>: <small><?php echo _CHANGE_PASS; ?></small>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminform">
					<tbody>
						<tr>
							<th colspan="3">
								<?php echo _CHANGE_PASS; ?>
							</th>
						</tr>
						<tr>
							<td width="130px">
								<?php echo _OLD_PASS; ?> <span class="require_field">(*)</span>
							</td>
							<td width="270px">
								<input name="old_pass" class="inputbox" size="40" value="" maxlength="50" type="password">
							</td>
							<td>
								<?php echo $error_array['old_pass'];  echo $error_array['old_pass_valid'];?>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _NEW_PASSWORD; ?> <span class="require_field">(*)</span>
							</td>
							<td>
							<input class="inputbox" name="password" size="40" value="" type="password">
							</td>
							<td>
							<?php echo $error_array['password']; ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _VERIFY_PASSWORD; ?> <span class="require_field">(*)</span>
							</td>
							<td>
							<input class="inputbox" name="verify_password" size="40" value="" type="password">
							</td>
							<td>
							<?php echo $error_array['verify_password']; echo $error_array['password_not_match']; ?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="2"><span class="require_field">(*)</span> <?php echo _REQUIRED_FILED; ?></td>
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
	<?php
	}
}
?>