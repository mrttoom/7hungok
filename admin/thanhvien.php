<? include "check.php";

?>
<br />
<table width="750" bgcolor="#FFFFFF" border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">

	 <tr id="tieude"  ><td  colspan="2"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">Quản lý Thành viên </span> </td>  </tr>
</table>


<? if ($_SESSION['modn']=='1')   {?> 


<?  
	 if($_POST['InsertNews']) {  	 
	 
				
				
			  		if(NumRow(username,admin,"username='".text($_POST['username'])."'")>0)  {
					echo "Tên truy cập này đã có";
					} else {
				mysql_query("INSERT INTO ".admin." SET 
				username = '".text($_POST['username'])."'
       			,fullname = '".textContent($_POST['fullname'])."'
				,email = '".textContent($_POST['email'])."'
				,modn = '".textContent($_POST['modn'])."'
				,password        = '".text(md5(md5(text($_POST['password']))))."'
				
				
				
				
				");
				
				echo "Thêm thành viên thành công";
		}	  
	  }
	
	
	
   if($_POST['ItemDel']) {  	
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("DELETE FROM ".admin." WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
		  }
		
	if($_POST['ItemHid']) {  	
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("UPDATE  ".admin." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
		  }	 
		  
	if($_POST['ItemShow']) {  	
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("UPDATE  ".admin." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
		  }	     

?>
<? if($_GET['AddNews']!='') {?>

<table width="750"  border="0" cellspacing="2" cellpadding="2"  align="center" style="border:#cccccc 1px solid">
<form action="" method="post" enctype="multipart/form-data" >
  <tr>
    <td width="19%" class="height_row"><div align="right">Tên truy cập</div></td>
    <td width="81%" class="height_row"><label>
      <input type="text" name="username" class="input_text"  />
    </label></td>
  </tr>
  
  
   <tr>
    <td width="19%" class="height_row"><div align="right">Tên đầy đủ</div></td>
    <td width="81%" class="height_row"><label>
      <input type="text" name="fullname" class="input_text"  />
    </label></td>
  </tr>
  
   <tr>
    <td width="19%" class="height_row"><div align="right">Email</div></td>
    <td width="81%" class="height_row"><label>
      <input type="text" name="email" class="input_text"  />
    </label></td>
  </tr>
   <tr>
    <td width="19%" class="height_row"><div align="right">Mật khẩu</div></td>
    <td width="81%" class="height_row"><label>
      <input name="password" class="input_text" type="password" size = "15" >
    </label></td>
  </tr>
    <tr>
    <td width="19%" class="height_row"><div align="right">Quản trị</div></td>
    <td width="81%" class="height_row"><select name="modn" >
                   <option value="0">Chọn</option>
                     <option value="0">Thành viên thường</option>
                     <option value="1">Người quản trị</option>
                       </select>
					   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>	  
      <input name="InsertNews" type="submit" id="InsertNews" value="Thêm thành viên" />
      <input type="reset" name="Submit2" value="Nhập Lại" />
    </label></td>
  </tr>
  </form>
</table>
<? }?>

<br />
<table width="750"  border="0" cellspacing="2" cellpadding="2"  align="center" style="border:#cccccc 1px solid">
<tr height="22px">
	  <form id="form1" name="form1" method="post" action="">
      <td  ><label></label>
         <label>
           <input  type="button" onClick="location.href='index.php?site=<?=$_GET['site']?>&AddNews=true'"  value="Thêm thành viên" />
           </label></td>
	 </form>
</tr>
</table>

<form method="post" action="">
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<tr id="tieude">
      <td width="5%" height="27" ><div align="center">#ID</div></td>
      <td width="40%" >username</td>
      <td  width="40%" ><div align="center">fullname </div></td>
	
      <td  width="10%" ><div align="center">Trạng Thái</div></td>        
</tr>

  <?
	      $p=10;
		  $sqlstr="SELECT 	*	FROM ".admin."  WHERE  username <>'huyen' 	";
				 
		  $page=mysql_query($sqlstr);
		  $n_record=mysql_num_rows($page);
		  num_page(); 
		  $link="index.php?site=".$_GET['site'].""; 
		  
		  $page=$_GET['page']?intval($_GET['page']):1;   
		  $s=($page-1)*$p;   
		  
		  $sqlstr.=" order by ID DESC limit $s,$p";		  
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	 {
	
?>	  
	  <tr>
	    <td  height="30"  align="center" >
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td ><?=$row['username']?></td>
		<td  ><?=$row['fullname']?></td>
				
		<td align="center"><?=$row['status']?></td>
	</tr>	  
<? }
}
?> 
<tr>
        <td  align="right" colspan="6"><? view_page($link)?></td>
      </tr>		  
<tr>
	    <td colspan="6" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa" name="ItemDel" > 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Ẩn " name="ItemHid" > 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Hiện" name="ItemShow" >		</td>
      </tr>		  
</table>
</form>


 <?  } else {  
echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; 
   }?> 
 