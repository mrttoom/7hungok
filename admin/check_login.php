<?
ob_start();
session_start();
include "define_data.php";
include "config.php";
include "connect.php";
	$username             =text($_POST['username']);
	$password             =md5(md5(text($_POST['password'])));
	
$sql=mysql_query("Select * from ".admin." where username='$username' AND password='$password' AND status='true'");
if(mysql_num_rows($sql)>0) {

	$row=mysql_fetch_array($sql);
	$_SESSION['idadminhdc5']               =$row['id'];
	$_SESSION['admin']            =$row['username'];
	$_SESSION['modn']              =$row['modn'];
	$_SESSION['mana_modul']       =$row['mana_modul'];
	$_SESSION['fullname']         =$row['fullname'];
	
	header('location:index.php');
}
else  
{
	header('location:login.php');
}
?>