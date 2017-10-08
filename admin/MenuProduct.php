<? include "check.php";
$t=-1;
?>
<br />

<? if($_POST['InsertCategory']) { 
	 
			if(text($_POST['category'])=='') {
	   echo "<script>alert('Mời bạn nhập đầy đủ thông tin');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
					} else {	
			 
				mysql_query("INSERT INTO ".menu_product." SET category='".text($_POST['category'])."'
				,parent='".$_POST['parent']."'
				,stt='".$_POST['order']."'");
				
				echo "Thêm category  <b>".$category."</b> thành công";
		
	  }}
	  if($_POST['EditCategory']) { 
	 if($_SESSION['modn']=='1')   {
	 
			
			 
				mysql_query("UPDATE ".menu_product." SET category='".text($_POST['category'])."',parent='".$_POST['parent']."',stt='".$_POST['order']."' WHERE id='".intval($_GET['Edit'])."'");
				
				echo "Sửa  category  <b>".$category."</b> thành công";
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
		  
			  mysql_query("DELETE FROM ".menu_product." WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".menu_product." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".menu_product." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			  			    } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 

		  }	    
		  
		  
		  
		 if($_POST['capnhat']) {	
	 	 if($_SESSION['modn']=='1')   {
		     
			 
			 
			$stta=  $_POST['stta'];
			$sttb=  $_POST['sttb'];
			
	  $sqlstr=mysql_query("SELECT * FROM ".menu_product." WHERE parent='0'  order by stt ASC");
	  if(mysql_num_rows($sqlstr)>0)   {$i=-1;
	   
      while($row=mysql_fetch_array($sqlstr))	 {$i=$i+1;
	
		  mysql_query("UPDATE  ".menu_product." SET stt='$stta[$i]' WHERE id= '".$row['id']."' ");	  
			 
		
		
		
			  $sqlSub=mysql_query("SELECT * FROM ".menu_product." WHERE parent='".$row['id']."'  order by stt ASC");
			  if(mysql_num_rows($sqlSub)>0)   {$t=$t;
			   
			  while($rowSub=mysql_fetch_array($sqlSub))	 {$t=$t+1;
		  mysql_query("UPDATE  ".menu_product." SET stt='$sttb[$t]' WHERE id= '".$rowSub['id']."' ");	  
			
		}}
		
		
		}}
		
		
		
		
		 
			 
			  
			  			    } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 

		  }	       
		  
		  
		  
		  
		  
		  
		  
		  
		  
		   

?>




<? if($_GET['Edit']=='') {?>
<table style="border-collapse: collapse;"  align="center" width="700" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form method="post" action="" >
<tr id="tieude">
    <td  class="height_row" colspan="5"> <strong>Thêm Menu</strong></td>
    </tr>
  <tr>
    <td width="17%" class="height_row"><div align="right">Tên nhóm</div></td>
    <td width="30%" class="height_row">
	<input name="category" type="text" maxlength="100"  class="input_text"/> 	</td>
    <td width="15%" class="height_row">Thuộc nhóm</td>
    <td width="38%" class="height_row">
    <select  name="parent" class="input_text" >
      <option value="0">Không thuộc nhóm nào</option>
      <? CategoryParent($_POST['id'],menu_product)?>
    </select></td>
  </tr> 
  <tr>
    <td class="height_row"><div align="right">Số TT</div></td>
    <td colspan="3" class="height_row">
	<select name="order" class="input_text" >
		<? order(1,100,1)?>
	</select>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><label>	  
      <input type="submit" name="InsertCategory" value="Thêm Menu" />
    
    </label></td>
  </tr>
  </form>
</table>
<? }?>

<? if($_GET['Edit']!='') {?>
 <? $sqlstr=mysql_query("SELECT * FROM ".menu_product."  WHERE id='".intval($_GET['Edit'])."'");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<table style="border-collapse: collapse;"  align="center" width="700" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form method="post" action="" >
<tr id="tieude">
    <td  class="height_row" colspan="5" > <strong>Sửa Menu</strong></td>
    </tr>
  <tr>
    <td width="18%" class="height_row"><div align="right">Tên nhóm</div></td>
    <td width="31%" class="height_row">
	<input name="category" type="text" maxlength="100"  class="input_text" value="<?=$row['category']?>"/>	</td>
    <td width="15%" class="height_row">Thuộc nhóm</td>
    <td width="38%" class="height_row">
    <select name="parent" class="input_text" >
    <option value="0">Không thuộc nhóm nào</option>
		<? CategoryParent($row['parent'],menu_product)?>
	</select></td>
    </tr>
  <tr>
    <td class="height_row"><div align="right">Số TT</div></td>
    <td colspan="3" class="height_row">
	<select name="order" class="input_text" >
		<? order(1,100,$row['stt'])?>
	</select>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><label>	  
      <input type="submit" name="EditCategory" value="Sửa menu" />
     
    </label></td>
  </tr>
  </form>
</table>
<? } }?>
<br />

<form method="post" action="">


<table style="border-collapse: collapse;"  align="center" width="700" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<tr id="tieude">
      <td width="5%" ><div align="center">#ID</div></td>
	    <td width="30%" >Tên nhóm</td>
      <td width="30%" ><div align="center">Tên loại</div></td>
      <td width="15%" ><div align="center">Số TT <input type="submit"    value="lưu" name="capnhat" /> </div></td>
	  <td width="8%" ><div align="center">Sửa</div></td> 
      <td width="15%" ><div align="center">Trạng Thái</div></td>    
	         
</tr>

 <?
	  $sqlstr=mysql_query("SELECT * FROM ".menu_product." WHERE parent='0'  order by stt ASC");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      while($row=mysql_fetch_array($sqlstr))	 {
	
?>	  
	  <tr >
	    <td  height="25"  align="center"  >
		<input  type="checkbox" name="element[]"  value="<?=$row['id']?>" /></td>
		<td   ><?=$row['category']?></td>
		<td  align="center" >&nbsp;</td>
		<td   ><div align="center"><input name="stta[]" type="text"  value="<?=$row['stt']?>" size="1"/></div></td>
			<td  align="center"><a href="index.php?site=<?=$_GET['site']?>&Edit=<?=$row['id']?>">Sửa</a></td>
		<td  align="center"><?=$row['status']?></td>
	</tr>	  
            <?
			  $sqlSub=mysql_query("SELECT * FROM ".menu_product." WHERE parent='".$row['id']."'  order by stt ASC");
			  if(mysql_num_rows($sqlSub)>0)   {
			   
			  while($rowSub=mysql_fetch_array($sqlSub))	 {
			
			?>	  
		  <tr >
			<td  height="25"  align="center"  >
			<input  type="checkbox" name="element[]"  value="<?=$rowSub['id']?>" /></td>
			<td   >&nbsp;</td>
			<td  align="left" >&nbsp;<?=$rowSub['category']?></td>
			<td   ><div align="center"><input name="sttb[]" type="text"  value="<?=$rowSub['stt']?>" size="1"/></div></td>
			<td  align="center"><a href="index.php?site=<?=$_GET['site']?>&Edit=<?=$rowSub['id']?>">Sửa</a></td>
			<td  align="center"><?=$rowSub['status']?></td>
		</tr>	  
	   <? }}?> 
<? }}?> 
<tr>
	   
	    <td colspan="6"  height="30">
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa nhóm này" name="ItemDel" > 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Ẩn nhóm này" name="ItemHid" > 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Hiện nhóm này" name="ItemShow" >		</td>
  </tr>		  
</table>
</form>

