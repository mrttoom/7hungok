<? include "check.php";
include_once("fckeditor/fckeditor.php") ;
?>
<script language="javascript"> 
function change_page(i)	 {

	 location.href='index.php?site=<?=$_GET['site']?>&category='+i;
}
</script> 
<script src="subCategory.js"></script>
<script language="JavaScript">
function uncheck(){
for (i = 0; i < frm.length; i++)
if (frm[i].type == "checkbox") //Kiểm tra xem có phải là checkbox ?
if (frm[i].checked)
frm[i].checked = false
else
frm[i].checked = true;
}

</script>

<?php
	  	 if(($_SESSION['modn']=='1')or($_GET['Edit']==''))    { 

// Khai bao 1 mang cac dinh dang dc phep upload
$arrExt = array('jpg','gif','png','jpeg'); 

// Ham tra ve dinh dang file getExt('mypicture.jpg') -> jpg
function getExt($filename){
	return $ext = strtolower(substr(strrchr($filename, '.'), 1));
}

if($_FILES['file']){

	$dir = '../images/product/goc/';
	$thumb = '../images/product/thumbs/';
	$thumbb = '../images/product/goc/';
	$ThumbWidth = '150';
	$ThumbWidthb = '550';
	
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
			$tmp_content = imagejpeg($image_p, $thumb.$thumb_file, 70);
			
				imagecopyresampled($image_pb, $image, 0, 0, 0, 0, $wb, $hb, $widthb, $heightb);
			// Output & save to file
			if ($widthb >500) {
			$anhgoc = 'goc_'.time().'.jpg';
			$tmp_contentb = imagejpeg($image_pb, $thumbb.$anhgoc, 80);
			 unlink("../images/product/goc/".$anhgock);
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
  if($_POST['ItemDel']) {
	 	  if($_SESSION['modn']=='1')   {
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
			  
			 
			 
			  	$sqlstr = "SELECT *	FROM ".product." WHERE  id in (".implode(",",$_POST['element']).") ";
	
		  $sqlstr=mysql_query($sqlstr);	
		   if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
					  
            while($row=mysql_fetch_array($sqlstr)) {      $i+=1;
			
         unlink("../images/product/thumbs/".$row['picture']);   
		   unlink("../images/product/goc/".$row['picture2']);    
	
                                               
            mysql_query("DELETE FROM ".product." WHERE id ='".$row['id']."'   "); 
           	   
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
		  
			  mysql_query("UPDATE  ".product." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".product." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			  			  } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 

		  }	     

?>




<br />
<table width="750" bgcolor="#FFFFFF" border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">

	 <tr id="tieude"  ><td  colspan="2"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">Quản lý Sản phẩm </span> </td>  </tr>
</table>





<? if($_GET['AddNews']!='') {?>

	<?
		   if($_POST['Send']) {
		   	$submit = '';			    	
					if(text($_POST['title'])=='') {
						$alert = "Mời bạn nhập tiêu đề tin";
					   $submit = true;
					}			
				if($submit=='') {		
					mysql_query("INSERT INTO ".product." SET 
					title                       = '".text($_POST['title'])."'
					,category                   = '".text($_POST['category'])."'
					,subCategory                = '".text($_POST['SubCategory'])."'
			     ,price='".$_POST['price']."'
				  ,special='".$_POST['special']."'
				,discount='".$_POST['discount']."'
				,luachon='".$_POST['luachon']."'
				,full='".textContent($_POST['full'])."'
				,tomtat='".textContent($_POST['tomtat'])."'	
				,picture                   = '".$thumb_file."'
					,picture2                    = '".$anhgoc."'
					,postdate                   = '".time()."'");
	   echo "<script>alert('Bạn đã đăng tin thành công');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
					}	
					
			if($submit!='') {	
				  echo $alert;					
		         	}	
			
			}
			?>	

<form action="" method="post" enctype="multipart/form-data">  

<table width="750"  border="0" cellspacing="2" cellpadding="2"  align="center" style="border:#cccccc 1px solid">
	

	 <tr id="tieude"  ><td  colspan="2"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">THÊM SẢN PHẨM </span> </td>  </tr>
	 	     
   <tr >
	   <td width="150" height="28"><div align="right"><?=$require?> Tiêu đề:&nbsp;&nbsp;</div></td>
	   <td width="600">
	    <input type="text" name="title" id="inputRegister" value="<?=$_POST['title']?>"  size="60">   </td>
	 </tr>
	 <tr >
	   <td height="28"><div align="right"><?=$require?> Thuộc nhóm:&nbsp;&nbsp;</div></td>
	   <td>
		<select name="category" id="inputRegister" onChange="Category(this.value)">
		<option value="">---Chọn nhóm sản phẩm---</option>
		<? CategoryParent($_POST['category'],menu_product) ?>
	   </select>   </td>
	 </tr>
	 <tr >
	   <td height="28"><div align="right"> 
	Thuộc loại:&nbsp;&nbsp;</div></td>
	   <td>
	   <div id="showSubCategory">
	   <select name="SubCategory" id="inputRegister" >
		<option value="">---Chọn tất cả--</option>        
		<?=Category($_POST['subCategory'],$_POST['category'],menu_product)?>
       
	   </select>   
		</div>   </td>
	 </tr>
	  <tr >
	   <td width="150" height="28"><div align="right"><?=$require?> Giá:&nbsp;&nbsp;</div></td>
	   <td width="600">
	    <input type="text" name="price"  value="<?=$_POST['price']?>"  size="10">   </td>
	 </tr>
	 <tr >
	   <td height="27"><div align="right"> Hình ảnh:&nbsp;&nbsp; </div>  </td>
	   <td><input type="file" name="file"></td>
	 </tr>
	 	 
 
  <tr>
    <td class="height_row"><div align="right">Chi tiết </div></td>
    <td class="height_row">
	<?php
$oFCKeditor = new FCKeditor('tomtat') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $row['tomtat'] ;

$oFCKeditor->Create() ;
?>
	</td>
  </tr>
 

	 <tr>
    <td class="height_row"><div align="right">Sản phẩm nổi bật</div></td>
    <td class="height_row">
      <input type="checkbox" name="special" id="special"  value="true" <? echo $row['special']=='true'?'checked':''?> />
   </td>
  </tr>
	
	
	 <tr >
	   <td height="29">&nbsp;</td>
	   <td>
		 <input type="submit" name="Send" id="Send" value=" Đăng tin ">
	
	   </td>
	 </tr>
	 
	  	

	 	        
	</table>
	  </form>  
<? }?>




<? if($_GET['Edit']!='') {?>
 <?
  $sqlstr=mysql_query("SELECT * FROM ".product."  WHERE id='".intval($_GET['Edit'])."'");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<form action="" method="post" enctype="multipart/form-data">  

<table width="750"  border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">

	 <tr id="tieude"  ><td  colspan="2"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">SỬA SẢN PHẨM </span> </td>  </tr>
 	      
			<?
		   if($_POST['Send']) {
	 	  if($_SESSION['modn']=='1')   {
		   echo "<tr><td  colspan=2 style='color:#FF0000;text-align:left;padding-left:110px'>";
				$submit = '';			    	
					
					if(text($_POST['title'])=='') {
						$alert = "Mời bạn nhập tiêu đề tin";
					   $submit = true;
					}			
												
					if($submit=='') {				 
		
		if($anhgoc=='') {	
				
						mysql_query("UPDATE ".product." SET 
					title                       = '".text($_POST['title'])."'
					,category                   = '".text($_POST['category'])."'
					,subCategory                = '".text($_POST['SubCategory'])."'
					,price='".$_POST['price']."'
				,special='".$_POST['special']."'
				,discount='".$_POST['discount']."'
				,luachon='".$_POST['luachon']."'
				,full='".textContent($_POST['full'])."'
				,tomtat='".textContent($_POST['tomtat'])."'	
			
			
					
					,postdate                   = '".time()."'  WHERE id='".intval($_GET['Edit'])."'");		
						
					}else {
					
					
					 unlink("../images/product/thumbs/".$_POST['picture_hidden']);  
					  unlink("../images/product/goc/".$_POST['picture_hidden2']);  
					
						mysql_query("UPDATE ".product." SET 
					title                       = '".text($_POST['title'])."'
					,category                   = '".text($_POST['category'])."'
					,subCategory                = '".text($_POST['SubCategory'])."'
				,price='".$_POST['price']."'
				,special='".$_POST['special']."'
				,discount='".$_POST['discount']."'
				,luachon='".$_POST['luachon']."'
				,full='".textContent($_POST['full'])."'
				,tomtat='".textContent($_POST['tomtat'])."'	
				,picture                   = '".$thumb_file."'
					,picture2                    = '".$anhgoc."'
			     ,postdate                   = '".time()."'  WHERE id='".intval($_GET['Edit'])."'");		
					
					
					}	
						
					echo "<script>alert('Bạn đã sửa tin thành công');location.href='index.php?site=Product';</script>";
					}	
					
			if($submit!='') {	
				  echo $alert;					
			}
			  } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 
			}
			?>	
	
	  <tr >
	   <td width="150" height="28"><div align="right"><?=$require?> Tiêu đề:&nbsp;&nbsp;</div></td>
	   <td width="600">
	    <input type="text" name="title" id="inputRegister"  value="<?=$row['title']?>"   size="60">   </td>
	 </tr>
	 <tr >
	   <td height="28"><div align="right"><?=$require?> Thuộc nhóm:&nbsp;&nbsp;</div></td>
	   <td>
		<select name="category" id="inputRegister" onChange="Category(this.value)">
		<option value="">---Chọn nhóm sản phẩm---</option>
		<? CategoryParent($row['category'],menu_product) ?>
	   </select>   </td>
	 </tr>
	 <tr >
	   <td height="28"><div align="right"> 
	Thuộc loại:&nbsp;&nbsp;</div></td>
	   <td>
	   <div id="showSubCategory">
	   <select name="SubCategory" id="inputRegister" >
		<option value="">---Chọn tất cả--</option>        
		<?=Category($row['subCategory'],$row['category'],menu_product)?>
       
	   </select>   
		</div>   </td>
	 </tr>
	 <tr >
	   <td width="150" height="28"><div align="right"><?=$require?> Giá:&nbsp;&nbsp;</div></td>
	   <td width="600">
	    <input type="text" name="price"  value="<?=$row['price']?>"   size="10">   </td>
	 </tr>
	 <tr >
	   <td height="27"><div align="right"> Hình ảnh:&nbsp;&nbsp; </div>  </td>
	   <td>
	      <input name="picture_hidden"  type="hidden"  value="<?=$row['picture']?>" />
	    <input name="picture_hidden2"  type="hidden"  value="<?=$row['picture2']?>" /> 
	   <input type="file" name="file" value="" ></td>
	 </tr>
	
  <tr>
    <td class="height_row"><div align="right">Chi tiết </div></td>
    <td class="height_row">
				
	<?php
$oFCKeditor = new FCKeditor('tomtat') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $row['tomtat'] ;

$oFCKeditor->Create() ;
?>

	
	</td>
  </tr>
  

  <tr>
    <td class="height_row"><div align="right">Sản phẩm nổi bật</div></td>
    <td class="height_row">
      <input type="checkbox" name="special" id="special"  value="true" <? echo $row['special']=='true'?'checked':''?> />
   </td>
  </tr>
	
	
	 <tr >
	   <td height="29">&nbsp;</td>
	   <td>
		 <input type="submit" name="Send" id="Send" value=" Sửa tin ">
		
	 </td>
	 </tr>	
	 	
         
	</table>
	 </form>   
<? } }?>



<br />

	<? if((!$_GET['Edit']) and (!$_GET['AddNews'])) {?>
<form method="post" action="">


<table width="750" bgcolor="#FFFFFF" border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">
<tr height="22px">
      
	  
	  <td><select name="select" class="input_text"  onchange="change_page(this.value);">
        <option value="">---Tất cả---</option>
        <? CategoryParent($_GET['category'],menu_product) ?>
      </select></td>
	  
      <td width="59%" >
     
           <input  type="button" onClick="location.href='index.php?site=<?=$_GET['site']?>&AddNews=true'"  value="Thêm sản phẩm" />
         </td>
	 
</tr>
</table>
</form>

<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >

<form method="post" name="frm" action="">



<tr id="tieude"  >
      <td width="5%" height="27" ><div align="center">#ID</div></td>
      <td width="55%" >TIÊU ĐỀ </td>
      <td width="20%" ><div align="center">Hình ảnh </div></td>
    
	   <td width="10%" ><div align="center">Sửa</div></td>
	  
      <td width="10%" ><div align="center">Trạng Thái</div></td>        
</tr>

  <?
	     $p=30;
		 if($_GET['category']!='')	{
		 
		 $sqlstr="SELECT
				*
				FROM
				".product."
				 WHERE category='".$_GET['category']."'";
				 } else {  $sqlstr="SELECT
				*
				FROM
				".product."
				 "; }
	  
		  $page=mysql_query($sqlstr);
		  $n_record=mysql_num_rows($page);
		  num_page(); 
		  $link="index.php?site=".$_GET['site']."&category=".$_GET['category'].""; 
		  $page=$_GET['page']?intval($_GET['page']):1;   
		  $s=($page-1)*$p;   
		  
		  $sqlstr.=" order by ID DESC limit $s,$p";		  
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	 {
	
?>	  
	  <tr>
	    <td  height="15"  align="center" >
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td   ><?=$row['title']?></td>
		<td   ><div align="center"><img src="../images/product/thumbs/<?=$row['picture']?>" height="40" border="0" /></div></td>
		
			<td  align="center"><a href="index.php?site=<?=$_GET['site']?>&Edit=<?=$row['id']?>">Sửa</a></td>
			
		<td  align="center"><?=$row['status']?></td>
	</tr>	  
<? }

}
?> 
  <tr>
	   
        <td height="30" colspan="7"  align="right"><? view_page($link)?></td>
      </tr>		
<tr>
	  
	    <td colspan="7" height="30" >
		<input type="button" value="Chọn tất cả" onClick="uncheck()">
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa tin này" name="ItemDel"> 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Ẩn tin này" name="ItemHid"> 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Hiện tin này" name="ItemShow">		</td>
       
      </tr>	

	  
</form>

</table>

 <? }?> 	