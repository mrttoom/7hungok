<?php
if(is_login())
	replace_location('profile');
else
{ 
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
			}
			else
			{
				$user_pass_valid = '<br /><div class="message">'._USER_PASS_VALID.'</div>';
			}
		}
	}
?>
<div id="content">
  <div id="welcome">
    <div id="td_01">
	<div class="td_02">
		<div class="td_03"><img src="<?php echo SITE_PATH;?>themes/images/img_td_l.gif" /></div>
		<div class="td_04"><div class="td_04_text">
		<a href="<?php echo generate_url('home') ?>"><?php echo _HOME ?></a> &raquo; 
		<?php echo _LOGIN_LOGIN ?></div></div>
		<div class="td_03"><img src="<?php echo SITE_PATH;?>themes/images/img_td_r.gif" /></div>
	</div>
</div>		
        <form id="form1" name="form1" method="post" action="">
            <table width="100%" border="0" cellspacing="4" cellpadding="4">
              <tr>
                <td><?php echo _LOGIN_USER_NAME ?></td><td><input style="width:170px; height:20px; background:#FEFBDA; border:1px #CCCCCC solid"  onfocus="javascript:if(this.value=='User name'){this.value='';};" onblur="javascript:if(this.value==''){this.value='User name';};" name="user_name" type="text" value="User name" /><?php echo $user_error; ?></td>
              </tr>
              <tr>
                 <td><?php echo _LOGIN_PASSWORD ?></td><td ><input style="width:170px; height:20px; background:#FEFBDA; border:1px #CCCCCC solid" name="password" type="password" onfocus="javascript:if(this.value=='      '){this.value='';};" onblur="javascript:if(this.value==''){this.value='      ';};" value="      " /><?php echo $password_error ?></td>
              </tr>
              <tr>
              <td></td>
                <td>
                    <?php echo $user_pass_valid; ?>                            
                    <input name="login" type="submit" value="<?php echo _LOGIN_LOGIN ?>">
                 </td>
              </tr>
              <tr>
              <td></td>
                <td><input type="hidden" name="form_name" value="doLogin" /></td>
              </tr>
              
            </table>
        </form>
	</div>
</div>
<?php 
}
?>
	
