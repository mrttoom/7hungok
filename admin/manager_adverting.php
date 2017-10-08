<? include "check.php";?>
<br />

<? if($_GET['id']!='') {
	 	  if($_SESSION['modn']=='1')   {

 	$sqlstr = "SELECT *	FROM ".ads." WHERE  id = '".intval($_GET['id'])."' ";
	  $sqlstr=mysql_query($sqlstr);	
		   if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
			 $row=mysql_fetch_array($sqlstr);		  
           unlink("../images/ads/".$row['picture']);   
                   	} 	 
 
  mysql_query("DELETE FROM ".ads." WHERE id ='".$_GET['id']."' "); 
  echo "<script>alert('Bạn đã xóa tin thành công');location.href='".$_SERVER['HTTP_REFERER']."';</script>";

} else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 
 }?>





<?  
	 if($_POST['InsertAds']) {
	
	 
				if($link!='')   {
				
			    uploads($file='picture',$folder = '../images/ads/');
				 
				mysql_query("INSERT INTO ".ads." SET 
				link='".$_POST['link']."',picture='$picture', title='".$_POST['title']."',
				stt='".$_POST['order']."',alignment='".$_POST['alignment']."',
				postdate='".time()."'");
				
				echo "Thêm quảng cáo thành công";
		}	  
	  }
	 if($_POST['Ads']) {
	
	 	  if($_SESSION['modn']=='1')   {
				if($link!='')   {
				
			    uploads($file='picture',$folder = '../images/ads/');
				 
				if($picture=='') {$picture=$_POST['picture_hidden'];	} else {  
				
				  unlink("../images/ads/".$_POST['picture_hidden']); 
				
				 }			
				
				mysql_query("UPDATE ".ads." SET 
				link='".$_POST['link']."',picture='$picture', title='".$_POST['title']."',
				stt='".$_POST['order']."',alignment='".$_POST['alignment']."',
				postdate='".time()."' WHERE id='".intval($_GET['Edit'])."'");
				
				echo "Cập nhật  quảng cáo thành công";
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
		  
			  mysql_query("UPDATE  ".ads." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".ads." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			  } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 
		  }	     

?>
<? if($_GET['Edit']=='') {?>

<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form action="" method="post" enctype="multipart/form-data" >
  <tr  id="tieude" >
    <td  colspan="2"> <span id="TextLeftCenter2m">THÊM BANNER </span></td>
  
  </tr>
 
 <tr  >
    <td width="19%" class="height_row"><div align="right">Link &nbsp;</div></td>
    <td width="81%" class="height_row"><label>
      <input type="text" name="link"  size="50" value="http://" />
    </label></td>
  </tr>
   <tr>
    <td width="19%" class="height_row"><div align="right">Tiêu đề &nbsp;</div></td>
    <td width="81%" class="height_row"><label>
      <input type="text" name="title" class="input_text" />
    </label></td>
  </tr>
  <tr>
    <td class="height_row"><div align="right">Picture &nbsp;</div></td>
    <td class="height_row"><label>
      <input name="picture" type="file" id="picture" />
    </label></td>
  </tr>
  <tr>
    <td class="height_row"><div align="right">Số thứ tự &nbsp;</div></td>
    <td class="height_row">
	<select name="order" class="input_text" >
		<? order(1,11,$id)?>
	</select></td>
  </tr>
  <tr>
    <td class="height_row"><div align="right">Vị trí &nbsp;</div></td>
    <td class="height_row">
	<select name="alignment" class="input_text" >
		<option value="1">Bên trái</option>
        <option value="2">Bên phải</option>	
		 <option value="3">Giữa</option>	
		<option value="4">Banner</option>	
		
		
	</select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>	  
      <input name="InsertAds" type="submit" id="InsertAds" value="Thêm " />
     
    </label></td>
  </tr>
  </form>
</table>
<? }?>
<? if($_GET['Edit']!='') {?>

 <?

	  $sqlstr=mysql_query("SELECT * FROM ".ads."  WHERE id='".intval($_GET['Edit'])."'");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form action="" method="post" enctype="multipart/form-data" >
  <tr  id="tieude" >
    <td  colspan="2"> <span id="TextLeftCenter2m">SỬA BANNER </span></td>
  
  </tr>
 
   <tr>
    <td width="20%" class="height_row"><div align="right">Link  &nbsp;</div></td>
    <td width="80%" class="height_row"><label>
      <input type="text" name="link"  size="50" value="<?=$row['link']?>" />
    </label></td>
  </tr>
    <tr>
    <td width="20%" class="height_row"><div align="right">Tiêu đề &nbsp;</div></td>
    <td width="80%" class="height_row"><label>
      <input type="text" name="title" class="input_text" value="<?=$row['title']?>" />
    </label></td>
  </tr>
  <tr>
    <td class="height_row"><div align="right">Picture &nbsp;</div></td>
    <td class="height_row"><label>	
	  <input name="picture_hidden"  type="hidden"  value="<?=$row['picture']?>" />
      <input name="picture" type="file" id="picture" />	 
    </label></td>
  </tr>
  <tr>
    <td class="height_row"><div align="right">Số thứ tự &nbsp;</div></td>
    <td class="height_row">
	<select name="order" class="input_text" >
		<? order(1,11,$row['stt'])?>
	</select></td>
  </tr>
  <tr>
    <td class="height_row"><div align="right">Vị trí &nbsp;</div></td>
    <td class="height_row">
	<select name="alignment" class="input_text" >
		<option value="1" <? echo $row['alignment']=='1'?'Selected':''?>>Bên trái</option>
        <option value="2" <? echo $row['alignment']=='2'?'Selected':''?>>Bên phải</option>	
		   <option value="3" <? echo $row['alignment']=='3'?'Selected':''?>>Giữa</option>
		<option value="4" <? echo $row['alignment']=='4'?'Selected':''?>>Banner</option>
		
			
	</select>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>	  
      <input type="submit" name="Ads" value="Sửa" />
     
    </label></td>
  </tr>
  </form>
</table>
<? } }?>

<br />

<form method="post" action="">
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<tr id="tieude">
      <td width="5%" height="27" ><div align="center">#ID</div></td>
	    <td width="25%" >Tiêu đề </td>
        <td width="5%" ><div align="center">TT </div></td>
        <td width="15%" ><div align="center">Vị trí </div></td>
        <td width="30%" ><div align="center">Hình ảnh </div></td>
	   <td width="5%" ><div align="center">Sửa</div></td>
	    <td width="5%" ><div align="center">Xóa</div></td>
      <td width="10%" ><div align="center">Trạng Thái</div></td>        
</tr>
  <?
	     $p=30;
		 $sqlstr="SELECT * FROM ".ads."	";			
	  
		  $page=mysql_query($sqlstr);
		  $n_record=mysql_num_rows($page);
		  num_page(); 
		  $link="index.php?menu=".$_GET['menu']."&site=".$_GET['site'].""; 
		  $page=$_GET['page']?intval($_GET['page']):1;   
		  $s=($page-1)*$p;   
		  
		  $sqlstr.=" order by id DESC limit $s,$p";		  
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	{
	
?>	  
	  <tr >
	    <td height="15"  align="center" >
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td   ><?=$row['title']?></td>
		<td ><div align="center">&nbsp;<?=$row['stt']?></div></td>
		<td   ><div align="center">&nbsp;
		<? 
		if( $row['alignment']=='1') echo 'Bên Trái';
		if( $row['alignment']=='2') echo 'Bên Phải';
			if( $row['alignment']=='3') echo 'Giữa';
		if( $row['alignment']=='4') echo 'Banner';
	
		
		?>
		</div></td>
		<td  ><div align="center"><img src="../images/ads/<?=$row['picture']?>" height="40" border="0" /></div></td>
		<td  align="center"><a href="index.php?site=<?=$_GET['site']?>&Edit=<?=$row['id']?>">Sửa</a></td>
				<td  align="center"><a href="index.php?site=<?=$_GET['site']?>&id=<?=$row['id']?>" onClick="return confirm('Bạn có chắc không ?');">Xóa</a></td>
	
		<td align="center"><?=$row['status']?></td>
	</tr>	  
<? }
}
?> 
  <tr>
	
	  
        <td colspan="8" align="right" ><? view_page($link)?></td>
      </tr>	
<tr>
	
	    <td colspan="8" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Ẩn tin này" name="ItemHid" > 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Hiện tin này" name="ItemShow" >		</td>
        
      </tr>		
	 	
	  

</table>
</form>

