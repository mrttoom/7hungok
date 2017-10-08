<? include "check.php";?>
<br />


<?  
   if($_POST['InsertUsers']) {   

	 
							    
				 
				mysql_query("INSERT INTO ".website." SET 
				title='".text($_POST['title'])."'
				,website='".text($_POST['website'])."'
				
				");				
				echo "Thêm thành viên thành công";
			  
	  }
	   if($_POST['UpdateUsers']) {   
	 	  if($_SESSION['modn']=='1')   {
	 
						    			
				
				mysql_query("UPDATE ".website." SET 
				title='".text($_POST['title'])."'
				,website='".text($_POST['website'])."'
				
				WHERE id='".intval($_GET['Edit'])."'");
				
				echo "Cập nhật  thành viên thành công";
		 
		 } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 
	  }
	   if($_POST['ItemDel']) {   
	 	  if($_SESSION['modn']=='1')   {
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("DELETE FROM ".website." WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			   } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; }
		  }
		   if($_POST['ItemHid']) {   
	 	  if($_SESSION['modn']=='1')   {
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("UPDATE  ".website." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			   } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; }
		  }	 
		   if($_POST['ItemShow']) {     
	 	  if($_SESSION['modn']=='1')   {
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("UPDATE  ".website." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			   } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; }
		  }	     

?>
<? if($_GET['Edit']=='') {?>

<table style="border-collapse: collapse;" width="750" border="1" bordercolor="#bbbbbb" cellpadding="0" cellspacing="0" align="center" >
<form action="" method="post" enctype="multipart/form-data" >
 <tr  id="tieude"><td  colspan="2"  height="30">&nbsp;&nbsp;&nbsp;<strong>Thêm Website </strong>  </td>  </tr>
  <tr>
    <td class="height_row"><div align="right">Tiêu đề &nbsp;</div></td>
    <td class="height_row"><label>
      <input type="text" name="title" size="30" />
    </label></td>
  </tr>
  <tr>
    <td width="19%" class="height_row"><div align="right">Link &nbsp;</div></td>
    <td width="81%" class="height_row"><label>
      <input name="website" type="text"  size="40" />
    </label></td>
  </tr>
 
  

  <tr>
    <td>&nbsp;</td>
    <td><label>	  
      <input name="InsertUsers" type="submit" id="InsertUsers" value="Thêm " />
    
    </label></td>
  </tr>
  </form>
</table>

<? }?>
<? if($_GET['Edit']!='') {?>


 <?

	  $sqlstr=mysql_query("SELECT * FROM ".website."  WHERE id='".intval($_GET['Edit'])."' ");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<table style="border-collapse: collapse;" width="750" border="1" bordercolor="#bbbbbb" cellpadding="0" cellspacing="0" align="center" >
<form method="post" action=""  enctype="multipart/form-data">
   <tr id="tieude" ><td  colspan="2"  height="30">&nbsp;&nbsp;&nbsp;<strong>Sửa link</strong>  </td>  </tr>
  <tr>
   
    <tr>
      <td class="height_row"><div align="right">Tiêu đề &nbsp;</div></td>
      <td class="height_row"><input type="text" name="title"   value="<?=$row['title']?>"  size="40" /></td>
    </tr>
    <tr>
    <td width="19%" class="height_row"><div align="right">Link &nbsp;</div></td>
    <td width="81%" class="height_row"><label>
      <input name="nick" type="text"  size="40" value="<?=$row['website']?>" />
    </label></td>
  </tr>
  
 
  <tr>
    <td>&nbsp;</td>
    <td><label>	  
      <input type="submit" name="UpdateUsers" value="Sửa " />
    
    </label></td>
  </tr>
  </form>
</table>

<? } }?>
<br />


<form method="post" action="">
<table style="border-collapse: collapse;" width="750" border="1" bordercolor="#bbbbbb" cellpadding="0" cellspacing="0" align="center" >
<tr id="tieude">
      <td width="5%" height="27" ><div align="center">#ID</div></td>
	    <td width="25%" >Tiêu đề</td>
        <td width="50%" ><div align="center">Link</div></td>
      		 <td width="5%" ><div align="center">Sửa </div></td>
       
</tr>
  <?
	     $p=10;
		 $sqlstr="SELECT * FROM ".website." order by ID DESC limit $p	";		
	  
		 
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	{
	
?>	  
	  <tr >
	    <td  height="30"  align="center" >
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td   ><?=$row['title']?></td>
		
		<td  ><div align="center"><?=$row['website']?></div></td>
		<td  ><div align="center"><a  href="index.php?site=link&Edit=<?=$row['id']?>"  id="NewsContent2" >Sửa </a></div></td>
		
	</tr>	  
<? }
}
?> 
<tr>
	   
	    <td colspan="6" height="30" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa " name="ItemDel"> 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Ẩn " name="ItemHid"> 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Hiện" name="ItemShow">	</td>
      
      </tr>		  
</table>
</form>


