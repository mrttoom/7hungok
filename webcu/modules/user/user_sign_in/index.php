<?php
	//	Project            	:  	Vihatra
	//	Nguoi tao          	:   GiangNM (12/08/2008)
	//	Sua doi            	:   
	//	Chuc nang chinh  	: 	Module dang nhap
	if(is_login())
		replace_location('profile');
	
	$act = getParam("form_name");
	if($act == "doLogin")
	{
		$user_name = getParam("user_name");
		$password = getParam("password");
		if(trim($user_name)=="" || trim($password)=="")
		{
			if(trim($user_name)=="")
				$user_error = '<div class="message">'._USER_EMPTY.'</div>';
			if(trim($password)=="")
				$password_error = '<div class="message">'._PASSWORD_EMPTY.'</div>';
		}
		else
		{
			global $database;
			$password = encode_password($password);
			$query = 'SELECT * FROM user WHERE user_name = "'.$user_name.'" AND password = "'.$password.'"';
			$database->setQuery($query);
			$user = $database->loadRow();
			if($database->getErrorNum())
			{
				echo $database->stderr();
				exit();
			}
			if(is_array($user))
			{
				$_SESSION["user"] = $user;
				replace_location('profile');
				exit();
			}
			else
			{
				$user_pass_valid = '<br /><div class="message">'._USER_PASS_VALID.'</div>';
			}
		}
	}
?>
<div class="tdr">
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr1.jpg" /></div>
	<div class="tdr2"><div class="tdr2text"><?php echo _LOGIN_LOGIN;?></div></div>
	<div class="tdr1"><img src="<?php echo SITE_PATH;?>themes/images/tdr3.jpg" /></div>
	<div style="clear:both"></div>
</div>

<div id="boder1">
	<div id="news123">
		<div class="content_center">
		<form id="form1" name="form1" method="post" action="">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="left" valign="top"><?php echo _LOGIN_USER_NAME;?>: </td>
				<td align="left" valign="top">
					<input name="user_name" class="inputbox" size="15" type="text"><?php echo $user_error?>
				</td>
			</tr>
			<tr><td colspan="2" height="4px;"></td></tr>
			<tr>
				<td align="left" valign="middle"><?php echo _LOGIN_PASSWORD;?>: </td>
				<td align="left" valign="top">
					<input name="password" class="inputbox" size="15" type="password"><?php echo $password_error?>
				</td>
			</tr>
			<tr><td colspan="2" height="4px;"></td></tr>
			<tr>
				<td align="left" valign="top">&nbsp;</td>
				<td align="left" valign="top"><input type="submit" value="Login" /></td>
			</tr>
		</table>
		<input type="hidden" name="form_name" value="doLogin" />
		</form>
	<div style="clear:both"></div>
	</div>
</div>