<? include "check.php";?>
<br />

<?php
	  	 if(($_SESSION['modn']=='1')or($_GET['Edit']==''))    { 

// Khai bao 1 mang cac dinh dang dc phep upload
$arrExt = array('jpg','gif','png','jpeg'); 

// Ham tra ve dinh dang file getExt('mypicture.jpg') -> jpg
function getExt($filename){
	return $ext = strtolower(substr(strrchr($filename, '.'), 1));
}

if($_FILES['file']){

	$dir = '../images/anh/goc/';
	$thumb = '../images/anh/thumbs/';
	$thumbb = '../images/anh/goc/';
	$ThumbWidth = '100';
	$ThumbWidthb = '500';
	
	$ext = getExt($_FILES['file']['name']);
	$file_tmp = $_FILES['file']['tmp_name'];
	list($width, $height) = getimagesize($file_tmp);
	list($widthb, $heightb) = getimagesize($file_tmp);
	$imgratio=$width/$height;
	$imgratiob=$widthb/$heightb;
	if ($imgratio>1){

$w = $ThumbWidth;

$h = $ThumbWidth/$imgratio;

$wb = $ThumbWidthb;

$hb = $ThumbWidthb/$imgratiob;

}else{

$h = $ThumbWidth;

$w = $ThumbWidth*$imgratio;
$hb = $ThumbWidthb;

$wb = $ThumbWidthb*$imgratiob;

}
	
	if(in_array($ext, $arrExt)){
		if(move_uploaded_file($_FILES['file']['tmp_name'], $dir.time().$_FILES['file']['name'])){
		
		$anhgock= time().$_FILES['file']['name'];
		
			$image_p = imagecreatetruecolor($w, $h);
			$image_pb = imagecreatetruecolor($wb, $hb);
			//
			
				switch($ext){
					case "jpg":
						$image = imagecreatefromjpeg($dir.time().$_FILES['file']['name']);
					break;
					
					case "gif":
						$image = imagecreatefromgif($dir.time().$_FILES['file']['name']);
					break;
						case "jpeg":
						$image = imagecreatefromjpeg($dir.time().$_FILES['file']['name']);
					break;
					
					case "PNG":
						$image = imagecreatefrompng($dir.time().$_FILES['file']['name']);
					break;
					
					default :
						$image = imagecreatefromjpeg($dir.time().$_FILES['file']['name']);
					break;
				}
				
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $w, $h, $width, $height);
			// Output & save to file
			$thumb_file = 'thumb_'.time().'.jpg';
			$tmp_content = imagejpeg($image_p, $thumb.$thumb_file, 40);
			
				imagecopyresampled($image_pb, $image, 0, 0, 0, 0, $wb, $hb, $widthb, $heightb);
			// Output & save to file
			if ($widthb >500) {
			$anhgoc = 'goc_'.time().'.jpg';
			$tmp_contentb = imagejpeg($image_pb, $thumbb.$anhgoc, 80);
			 unlink("../images/anh/goc/".$anhgock);
			} else { 	$anhgoc = $anhgock;}
			
			
			
		}
		else{
			echo 'Failed';
		}
	}
	else{
		echo $ext.' file is not allowed';
	}

}

			  			    } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 





?>








<?
	
	  if($_POST['InsertCategory']) { 
	 
			if(text($_POST['category'])=='') {
	   echo "<script>alert('Mời bạn nhập đầy đủ thông tin');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
					} else {	
			 
				mysql_query("INSERT INTO ".menu_anh." SET category='".text($_POST['category'])."'
				,parent='".$_POST['parent']."'
				,picture                   = '".$thumb_file."'
					,picture2                    = '".$anhgoc."'
				,stt='".$_POST['order']."'");
				
				echo "Thêm category  <b>".$category."</b> thành công";
		
	  }}
	  if($_POST['EditCategory']) { 
	
	 	  if($_SESSION['modn']=='1')   {

			if($file=='') {
			 
				mysql_query("UPDATE ".menu_anh." SET category='".text($_POST['category'])."'
				,parent='".$_POST['parent']."'
				
				
				,stt='".$_POST['order']."' WHERE id='".intval($_GET['Edit'])."'");
				
				} else {
							
					 unlink("../images/anh/thumbs/".$_POST['picture_hidden']);  
					  unlink("../images/anh/goc/".$_POST['picture_hidden2']);  
				
				mysql_query("UPDATE ".menu_anh." SET category='".text($_POST['category'])."'
				,parent='".$_POST['parent']."'
				,picture                   = '".$thumb_file."'
					,picture2                    = '".$anhgoc."'
				
				,stt='".$_POST['order']."' WHERE id='".intval($_GET['Edit'])."'");
				}
				
				
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
			  
			 
			 
			  	$sqlstr = "SELECT *	FROM ".menu_anh." WHERE  id in (".implode(",",$_POST['element']).") ";
	
		  $sqlstr=mysql_query($sqlstr);	
		   if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
					  
            while($row=mysql_fetch_array($sqlstr)) {      $i+=1;
			
         unlink("../images/anh/thumbs/".$row['picture']);   
		   unlink("../images/anh/goc/".$row['picture2']);    
	
                                               
            mysql_query("DELETE FROM ".menu_anh." WHERE id ='".$row['id']."'   "); 
           	   
                   	} }	
			  
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
		  
			  mysql_query("UPDATE  ".menu_anh." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".menu_anh." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			  			    } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 

		  }	     

?>
<? if($_GET['Edit']=='') {?>
<table style="border-collapse: collapse;"  align="center" width="700" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form method="post" action="" enctype="multipart/form-data">
<tr id="tieude">
    <td  class="height_row" colspan="5"> <strong>Thêm Menu ẢNH</strong></td>
    </tr>
  <tr>
    <td width="17%" class="height_row"><div align="right">Tên nhóm</div></td>
    <td width="30%" class="height_row">
	<input name="category" type="text" maxlength="100"  class="input_text"/> 	</td>
    <td width="15%" class="height_row">Thuộc nhóm</td>
    <td width="38%" class="height_row">
    <select  name="parent" class="input_text" >
      <option value="0">Không thuộc nhóm nào</option>
      <? CategoryParent($_POST['id'],menu_anh)?>
    </select></td>
  </tr> 
  <tr>
    <td class="height_row"><div align="right">Số TT</div></td>
    <td colspan="3" class="height_row">
	<select name="order" class="input_text" >
		<? order(1,100,1)?>
	</select>	</td>
  </tr>
   <tr >
	   <td height="27"><div align="right"> Hình ảnh:&nbsp;&nbsp; </div>  </td>
	   <td colspan="3">
	   	   
	   <input type="file" name="file" id="file"></td>
	 </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><label>	  
      <input type="submit" name="InsertCategory" value="Thêm " />
    
    </label></td>
  </tr>
  </form>
</table>
<? }?>

<? if($_GET['Edit']!='') {?>
 <? $sqlstr=mysql_query("SELECT * FROM ".menu_anh."  WHERE id='".intval($_GET['Edit'])."'");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<table style="border-collapse: collapse;"  align="center" width="700" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form method="post" action="" enctype="multipart/form-data">
<tr id="tieude">
    <td  class="height_row" colspan="5" > <strong>Sửa Menu ẢNH</strong></td>
    </tr>
  <tr>
    <td width="18%" class="height_row"><div align="right">Tên nhóm</div></td>
    <td width="31%" class="height_row">
	<input name="category" type="text" maxlength="100"  class="input_text" value="<?=$row['category']?>"/>	</td>
    <td width="15%" class="height_row">Thuộc nhóm</td>
    <td width="38%" class="height_row">
    <select name="parent" class="input_text" >
    <option value="0">Không thuộc nhóm nào</option>
		<? CategoryParent($row['parent'],menu_anh)?>
	</select></td>
    </tr>
  <tr>
    <td class="height_row"><div align="right">Số TT</div></td>
    <td colspan="3" class="height_row">
	<select name="order" class="input_text" >
		<? order(1,100,$row['stt'])?>
	</select>	</td>
  </tr>
  
  <tr >
	   <td height="27"><div align="right"> Hình ảnh:&nbsp;&nbsp;  </div> </td>
	   <td colspan="3">
	  
	     <input name="picture_hidden"  type="hidden"  value="<?=$row['picture']?>" />
	    <input name="picture_hidden2"  type="hidden"  value="<?=$row['picture2']?>" />
	   <input type="file" name="file" id="file"></td>
	 </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><label>	  
      <input type="submit" name="EditCategory" value="Sửa " />
     
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
	    <td width="25%" >Tên nhóm</td>
      <td width="25%" ><div align="center">Tên loại</div></td>
	    <td width="20%" ><div align="center">Ảnh</div></td> 
      <td width="10%" ><div align="center">Số TT</div></td>
	  <td width="5%" ><div align="center">Sửa</div></td> 
      <td width="10%" ><div align="center">Trạng Thái</div></td>    
	         
</tr>

 <?
	  $sqlstr=mysql_query("SELECT * FROM ".menu_anh." WHERE parent='0'  order by stt ASC");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      while($row=mysql_fetch_array($sqlstr))	 {
	
?>	  
	  <tr >
	    <td  height="25"  align="center"  >
		<input  type="checkbox" name="element[]"  value="<?=$row['id']?>" /></td>
		<td   ><?=$row['category']?></td>
		<td  align="center" >&nbsp;</td>
		<td  ><div align="center"> <? if($row['picture']) {?><img src="../images/anh/thumbs/<?=$row['picture']?>"  width="50" border="0"  />   <? } ?>    </div></td>
		<td   ><div align="center"><?=$row['stt']?></div></td>
			<td  align="center"><a href="index.php?site=<?=$_GET['site']?>&Edit=<?=$row['id']?>">Sửa</a></td>
		<td  align="center"><?=$row['status']?></td>
	</tr>	  
            <?
			  $sqlSub=mysql_query("SELECT * FROM ".menu_anh." WHERE parent='".$row['id']."'  order by stt ASC");
			  if(mysql_num_rows($sqlSub)>0)   {
			   
			  while($rowSub=mysql_fetch_array($sqlSub))	 {
			
			?>	  
		  <tr >
			<td  height="25"  align="center"  >
			<input  type="checkbox" name="element[]"  value="<?=$rowSub['id']?>" /></td>
			<td   >&nbsp;</td>
				
			<td  align="left" >&nbsp;<?=$rowSub['category']?></td>
			<td  ><div align="center"> <? if($rowSub['picture']) {?><img src="../images/anh/thumbs/<?=$rowSub['picture']?>"  width="50" border="0"   />   <? } ?>    </div></td>
			<td   ><div align="center"><?=$rowSub['stt']?></div></td>
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

