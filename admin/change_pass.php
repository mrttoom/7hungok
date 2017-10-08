<? include "check.php";?>
<br />
<?  
  if($_POST['UpdatePass']) {
		
			  			
		
			 
				 if(mysql_num_rows(mysql_query("SELECT * FROM ".admin." WHERE password='".text(md5(md5(text($_POST['passold']))))."'"))>0)   {
				 
					mysql_query("UPDATE ".admin." SET password='".text(md5(md5(text($_POST['passnew']))))."'
					,fullname='".$_POST['fullname']."' 
					,email='".$_POST['email']."' 
					
					
					WHERE username='".$_SESSION['admin']."'");
					
					echo "<script>alert('Đổi mật khẩu thành công');</script>";
				 }	
				 else {
					echo "<script>alert('Đổi mật khẩu không thành công.Mời bạn đổi lại');</script>";
				 } 
		 
	}	  
	 
?>
 <?
	      $p=10;
		  $sqlstr="SELECT 	*	FROM ".admin."  WHERE  username ='".$_SESSION['admin']."' 	";
	
		  
		  $sqlstr.=" order by ID DESC limit $p";		  
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	 {?>



<form method="post" action="">
<table width="750" bgcolor="#FFFFFF" border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">
	 <tr id="tieude"  ><td  colspan="2"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">Đổi mật khẩu</span> </td>  </tr>

  <tr>
    <td width="30%" height="32" align="right"><div align="right">Mật khẩu cũ</div></td>
    <td width="70%"><label>
    <input type="password" name="passold">
    </label></td>
  </tr>
  <tr>
    <td height="32" align="right"><div align="right">Mật khẩu mới</div></td>
    <td><input type="password" name="passnew"></td>
  </tr>
  
 <tr>
    <td class="height_row"><div align="right">Tên đầy đủ</div></td>
    <td  class="height_row"><label>
      <input type="text" name="fullname"  value="<?=$row['fullname']?>"  />
    </label></td>
  </tr>
  
   <tr>
    <td  class="height_row"><div align="right">Email</div></td>
    <td  class="height_row"><label>
      <input type="text" name="email"  value="<?=$row['email']?>"  />
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="UpdatePass" value="Đổi mật khẩu">
   
    </label></td>
  </tr>
</table>
</form>


<? }
}
?> 