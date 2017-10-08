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





		<?
	
		
            if($_POST['Send']) {
			
			   if($_POST['email']=='') {
                echo "Mời bạn nhập Email";} 
				
				elseif(text($_POST['code'])!=$_SESSION['stringcode']) {
					    echo '<script>alert(\'Mã xác nhận không đúng\')</script>'; }
				
				
				
				else {
			
			
			   $sqlstra = "SELECT * FROM ".admin."  WHERE  email='".$_POST['email']."'   ";			
		  $sqlstra=mysql_query($sqlstra);	
		  		 					  
          if(mysql_num_rows($sqlstra)>0) {	
					  
          $rowa=mysql_fetch_array($sqlstra);
		 $nn= mt_rand(1000000,10000000);
			 mysql_query("UPDATE  ".admin."  SET ma  = $nn
			  WHERE email='".$_POST['email']."'");
			
        $headers = "From: admin@google.com.vn";
mail($_POST['email'],'Xac nhan email dang ky tren website - Doi mat khau',
'De xac thuc email cua ban xin hay bam vao link sau:'.$tenmien.'/admin/kichhoat.php?id='.$rowa['id'].'&ma='.$nn,$headers);

 echo "<script>alert('Link kich hoat da gui vao email cua ban');location.href='".$domain."';</script>";

        }   else { 
		 echo "<script>alert('Email này chưa đăng ký vào website này');location.href='".$domain."';</script>";
		 }}
        }
        ?>
		
        <style type="text/css">
<!--
.style1 {color: #CC0000}
-->
        </style>
        <form method="post" action="">
  <table width="500" border="0" align="center"  cellpadding="0" cellspacing="0" style="border:#cccccc 1px solid" bgcolor="#FFFFCC">

            <tr  height="30"><td  colspan="2" align="center"><strong>Quên mật khẩu</strong></td>   </tr>
		  <tr>
            <td height="31"><div align="right">
                <?=$require?> 
            Email đăng ký:&nbsp;&nbsp;</div></td>
            <td><input name="email" class="Contact_text"   type="text"  ></td>
          </tr>
		   <tr>
            <td align="right">Nhập mã bảo vệ:  
            <span class="style1">  <?=createImage()?> &nbsp;&nbsp;</span>
              <input type="text" name="code"  size="3" maxlength="10">
		</td>
            <td>&nbsp;&nbsp;<input name="Send" type="submit" value="Gửi mật khẩu">
             </td>
          </tr>
		  
		  
		   <tr>
            
	
            <td height="40">&nbsp;&nbsp;
             </td>
          </tr>
</table>

    </form>	   
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	