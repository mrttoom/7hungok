<?
ob_start();
session_start();
header("Pragma: no-cache");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
include "define_data.php";
include "config.php";
include "connect.php";

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


		<?   $sqlstra = "SELECT * FROM ".admin."  WHERE  id='".$_GET['id']."' and ma ='".$_GET['ma']."'  ";			
		  $sqlstra=mysql_query($sqlstra);	
		  		 					  
          if(mysql_num_rows($sqlstra)>0) {	
					  
          $rowa=mysql_fetch_array($sqlstra);
		   $nn= mt_rand(1000000,10000000);
		  
		          $headers = "From: admin@google.com.vn";
		
mail($rowa['email'],'Thay doi pass tren website','Ten truy cap: '.$rowa['username'].'  - Pass: '.$nn,$headers);

 echo "<script>alert('Mat khau da gui vao email cua ban');location.href='index.php';</script>";

          
			 mysql_query("UPDATE  ".admin."  SET  password  = '".md5(md5($nn))."'  WHERE email='".$rowa['email']."' ");
			

        }   else { 
		 echo "<script>alert('Ma kich hoat khong dung');location.href='index.php';</script>";
		 }
      
        ?>
		
  