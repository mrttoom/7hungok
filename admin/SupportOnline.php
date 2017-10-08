<? include "check.php";?>
<br />


<?  
   if($_POST['InsertUsers']) {   

	 
							    
				 
				mysql_query("INSERT INTO ".support." SET 
				nick='".text($_POST['nick'])."'
								,stt='".$_POST['order']."'
				,kind='".$_POST['kind']."'
				,fullname='".text($_POST['fullname'])."'
				
				");				
				echo "Thêm thành viên thành công";
			  
	  }
	   if($_POST['UpdateUsers']) {   
	 	  if($_SESSION['modn']=='1')   {
	 
						    			
				
				mysql_query("UPDATE ".support." SET 
				nick='".text($_POST['nick'])."'
				,stt='".$_POST['order']."',
				kind='".$_POST['kind']."'
				,fullname='".text($_POST['fullname'])."'
				
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
		  
			  mysql_query("DELETE FROM ".support." WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".support." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".support." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			   } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; }
		  }	     

?>
<? if($_GET['Edit']=='') {?>

<table style="border-collapse: collapse;" width="750" border="1" bordercolor="#bbbbbb" cellpadding="0" cellspacing="0" align="center" >
<form action="" method="post" enctype="multipart/form-data" >
 <tr  id="tieude"><td  colspan="2"  height="30">&nbsp;&nbsp;&nbsp;<strong>Thêm Thành viên </strong>  </td>  </tr>
  <tr>
    <td class="height_row"><div align="right">Tên đầy đủ &nbsp;</div></td>
    <td class="height_row"><label>
      <input type="text" name="fullname" id="textfield" class="input_text" />
    </label></td>
  </tr>
  <tr>
    <td width="19%" class="height_row"><div align="right">Nick &nbsp;</div></td>
    <td width="81%" class="height_row"><label>
      <input name="nick" type="text" class="input_text" id="username" />
    </label></td>
  </tr>
   <tr>
    <td class="height_row"><div align="right">Số TT  &nbsp;</div></td>
    <td class="height_row">
	<select name="order" class="input_text" >
		<? order(1,11,$id)?>
	</select>	</td>
  </tr>
  
  <tr>
    <td class="height_row"><div align="right">Loại &nbsp;</div></td>
    <td class="height_row">
	<select name="kind" class="input_text" >
		<option value="1">Yahoo</option>
		<option value="2">Skype</option>
	</select></td>
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

	  $sqlstr=mysql_query("SELECT * FROM ".support."  WHERE id='".intval($_GET['Edit'])."' ");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<table style="border-collapse: collapse;" width="750" border="1" bordercolor="#bbbbbb" cellpadding="0" cellspacing="0" align="center" >
<form method="post" action=""  enctype="multipart/form-data">
   <tr id="tieude" ><td  colspan="2"  height="30">&nbsp;&nbsp;&nbsp;<strong>Sửa thành viên</strong>  </td>  </tr>
  <tr>
   
    <tr>
      <td class="height_row"><div align="right">Tên đầy đủ  &nbsp;</div></td>
      <td class="height_row"><input type="text" name="fullname" id="fullname"  value="<?=$row['fullname']?>" class="input_text" /></td>
    </tr>
    <tr>
    <td width="19%" class="height_row"><div align="right">Nick  &nbsp;</div></td>
    <td width="81%" class="height_row"><label>
      <input name="nick" type="text" class="input_text" id="username" value="<?=$row['nick']?>" />
    </label></td>
  </tr>
   <tr>
    <td class="height_row"><div align="right">Số TT  &nbsp;</div></td>
    <td class="height_row">
	<select name="order" class="input_text" >
		<? order(1,11,$row['stt'])?>
	</select>	</td>
  </tr>  
  <tr>
    <td class="height_row"><div align="right">Loại &nbsp;</div></td>
    <td class="height_row">
	<select name="kind" class="input_text" >
		<option value="1" <? echo $row['kind']=='1'?'Selected':''?>>Yahoo</option>
		<option value="2" <? echo $row['kind']=='2'?'Selected':''?>>Skype</option>
	</select></td>
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
	    <td width="25%" >Nick</td>
        <td width="25%" ><div align="center">Fullname</div></td>
        <td width="15%" ><div align="center">Loại</div></td>
        <td width="10%" ><div align="center">Số TT </div></td>
		 <td width="10%" ><div align="center">Sửa </div></td>
      <td width="10%" ><div align="center">Trạng Thái</div></td>        
</tr>
  <?
	     $p=10;
		 $sqlstr="SELECT * FROM ".support." order by ID DESC limit $p	";		
	  
		 
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	{
	
?>	  
	  <tr >
	    <td  height="30"  align="center" >
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td   ><?=$row['nick']?></td>
		<td    ><div align="center"><?=$row['fullname']?></div></td>
		<td   ><div align="center">
		<? echo $row['kind']=='1'?'Yahoo':'Skype';?></div></td>
		<td  ><div align="center"><?=$row['stt']?></div></td>
		<td  ><div align="center"><a  href="index.php?site=SupportOnline&Edit=<?=$row['id']?>"  id="NewsContent2" >Sửa </a></div></td>
		<td  align="center"><?=$row['status']?></td>
	</tr>	  
<? }
}
?> 
<tr>
	   
	    <td colspan="6" height="30" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa thành viên này" name="ItemDel"> 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Ẩn thành viên này" name="ItemHid"> 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Kích hoạt thành viên này" name="ItemShow">	</td>
      
      </tr>		  
</table>
</form>


