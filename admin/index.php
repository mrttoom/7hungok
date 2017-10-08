<?
ob_start();
session_start();
header("Pragma: no-cache");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
define("hdc","hdc",true);
if(!isset($_SESSION['idadminhdc5'])) {
	 header('location:login.php');
}
include "define_data.php";
include "config.php";
include "connect.php";
include "sql.php";
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/style.css"  rel="stylesheet" type="text/css">

<title>Hệ thống quản trị nội dung website</title>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="table">
  <tr>
    <td colspan="2"  height="50" bgcolor="#0066CC" align="center">
	<span id="TextLeftCenter3m">QUẢN TRỊ WEBSITE </span> 
	</td>    
  </tr>
   <tr>
    <td width="180" rowspan="3"  valign="top">
	<? include "left.php";?>
		</td>
    <td width="100%" valign="top" style="padding-left:10px" >		
			<?
	if(file_exists("./".$_GET['site'].".php"))	  {
	   include "./".$_GET['site'].".php";
	   
	}
                else {
                include "center.php";
                }
                ?> 
	</td>
  </tr>
 
  <tr>
    <td colspan="2" height="50px">&nbsp;</td>   
  </tr>
</table>
</body>