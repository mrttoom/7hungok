<?
	$dbhost = "localhost"; 
		$dbuser = "nguoimie_data"; 
		$dbpassword = "QMGP(+mIkbI#"; 
		$db = "nguoimie_7hung";
		$tenmien="http://home.banlong.org/votu";
		$link = mysql_connect("$dbhost", "$dbuser", "$dbpassword") or die("Could not connect"); 
        mysql_select_db("$db") or die("Could not select database"); 
		mysql_query("SET NAMES 'UTF8'"); 
?>