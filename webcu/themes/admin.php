<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Website admin</title>
	<link rel="stylesheet" href="<?php echo SITE_PATH;?>themes/admin.css" type="text/css">
	<script language="JavaScript" src="<?php echo SITE_PATH;?>themes/milonic_src.js" type="text/javascript"></script>
	<script language="JavaScript" src="<?php echo SITE_PATH;?>themes/mmenudom.js" type="text/javascript"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" href="<?php echo SITE_PATH;?>themes/images/icon.ico">
</head>
<body>
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
	<tr>
		<td class="bg_left" width="31px"></td>
		<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr>
					<td height="75px">
						<div class="bg_header"><div class="header_text">Website admin</div></div>
					</td>
				</tr>
				<tr><td><?php require_once ROOT_PATH.'modules/menu/menu_admin.php';?></td></tr>
				<tr><td><?php get_region_content();?></td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="bg_footer">
						<div class="footer_text"><?php echo _POWERED_BY;?> - <a href="http://acs.vn" target="_blank">www.acs.vn</a></div>
					</td>
				</tr>
			</table>
		</td>
		<td class="bg_right" width="31px"></td>
	</tr>
</table>
</body>
</html>