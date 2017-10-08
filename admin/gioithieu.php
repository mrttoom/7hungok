<? include "check.php";
include_once("fckeditor/fckeditor.php") ;
?>

<br />
<table width="750" bgcolor="#FFFFFF" border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">

	 <tr id="tieude"  ><td  colspan="2"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">Quản lý Menu top </span> </td>  </tr>
</table>
<?  
	
		  if($_POST['ItemDel']) {
	 	  if($_SESSION['modn']=='1')   {
 
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("DELETE FROM ".guide." WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".guide." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".guide." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			  } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 
		  }	     

?>

<? if($_GET['AddNews']!='') {?>

<form action="" method="post" enctype="multipart/form-data">  
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
	 <tr id="tieude"  ><td  colspan="2" ><span id="TextLeftCenter2m">Thêm Menu  </span> </td>  </tr>
	 	      
			<?
			
			
			
			
		   if($_POST['Send']) {
		   
		   echo "<tr><td  colspan=2 style='color:#FF0000;text-align:left;padding-left:110px'>";
				$submit = '';			    	
					
					
					if(text($_POST['title'])=='') {
						$alert = "Mời bạn nhập tiêu đề tin";
					   $submit = true;
					}			
												
					if($submit=='') {				 
					
					 
					 	
					mysql_query("INSERT INTO ".guide." SET 
					title                       = '".text($_POST['title'])."'
				,stt                      = '".text($_POST['stt'])."'
				 ,full='".textContent($_POST['full'])."'
				 
				");
					
					echo "<script>alert('Bạn đã đăng tin thành công');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
					}	
					
			if($submit!='') {	
				  echo $alert;					
			}	
					
			echo "</td></tr>";		
			}
			?>	
	
	  <tr >
	   <td width="150" height="28"><div align="right"><?=$require?> Tiêu đề:&nbsp;&nbsp;</div></td>
	   <td width="600">
	    <input type="text" name="title" id="inputRegister" value="<?=$_POST['title']?>"  size="50">   </td>
	 </tr>
	 <tr>
    <td ><div align="right">Số TT</div></td>
    <td  >
	<select name="stt"  >
		<? order(1,100,1)?>
	</select>	</td>
  </tr>
  <tr>
    <td class="height_row"><div align="right">Thông tin chi tiết</div></td>
    <td class="height_row">
	<?php
$oFCKeditor = new FCKeditor('full') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $row['full'] ;

$oFCKeditor->Create() ;
?>
	
	</td>
 
  
	
	
	
	 <tr >
	   <td height="29">&nbsp;</td>
	   <td><label>
		 <input type="submit" name="Send" id="Send" value=" Thêm ">
		
	   </label></td>
	 </tr>	        
	</table>
 </form>    	

<? }?>


<br />
<? if($_GET['Edit']!='') {?>

 <?


	  $sqlstr=mysql_query("SELECT * FROM ".guide."  WHERE id='".intval($_GET['Edit'])."'");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<form action="" method="post" enctype="multipart/form-data">  
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
	 <tr id="tieude"  ><td  colspan="2" ><span id="TextLeftCenter2m">&nbsp;&nbsp;&nbsp;Sửa Menu </span> </td>  </tr>
	 	      
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
					
					
					
						
					
					mysql_query("UPDATE ".guide." SET 
					title                       = '".text($_POST['title'])."'
				   ,stt                      = '".text($_POST['stt'])."'
				 ,full='".textContent($_POST['full'])."'
				
					
					  WHERE id='".intval($_GET['Edit'])."'");
						
					
					
					
					echo "<script>alert('Bạn đã sửa tin thành công');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
					}	
					
			if($submit!='') {	
				  echo $alert;					
			}	
					
			echo "</td></tr>";	
			  } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 	
			}
			
			?>	
	
	  <tr >
	   <td width="150" height="28"><div align="right"><?=$require?> Tên menu:&nbsp;&nbsp;</div></td>
	   <td width="600">
	    <input type="text" name="title" id="inputRegister"  value="<?=$row['title']?>"  size="30">   </td>
	 </tr>
	 
	  <tr>
    <td class="height_row"><div align="right">Số TT</div></td>
    <td colspan="3" class="height_row">
	<select name="stt"  >
		<? order(1,100,$row['stt'])?>
	</select>	</td>
  </tr>
	
  
  <tr>
    <td class="height_row"><div align="right">Nội dung</div></td>
    <td class="height_row">
<?php
$oFCKeditor = new FCKeditor('full') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $row['full'] ;

$oFCKeditor->Create() ;
?>
	
	</td>
  </tr>
  
 
  
	 
	
	 <tr >
	   <td height="29">&nbsp;</td>
	   <td><label>
		 <input type="submit" name="Send" id="Send" value=" Sửa  ">
		
	   </label></td>
	 </tr>	
	         
	</table>
 </form>    	
<? } }?>


<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form id="form1" name="form1" method="post" action="">
<tr height="22px">
      
	 	  
      <td width="59%" >
         <label>
           <input  type="button" onClick="location.href='index.php?site=<?=$_GET['site']?>&AddNews=true'"  value="Thêm Menu" />
          </label></td>
	 
</tr>
</form>
</table>
<form method="post" action="">
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >


    <tr  id="tieude">
      <td width="8%" height="27" ><div align="center">#ID</div></td>
      <td width="43%" align="center" >TIÊU ĐỀ </td>
	    <td width="10%" align="center" >stt </td>
		 <td width="10%"  align="center">Sửa </td>
    
         
</tr>
  <?
	     $p=30;
		 if($_GET['category']!='')	{
		 
		 $sqlstr="SELECT
				*
				FROM
				".guide."
				 WHERE category='".$_GET['category']."'";
				 } else {  $sqlstr="SELECT
				*
				FROM
				".guide."
				 "; }
	  
	
		  $sqlstr.=" order by stt ASC limit $p";		  
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	 {
	
?>	  
	  <tr>
	    <td  height="25"  align="center">
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td ><?=$row['title']?></td>
		
			<td  align="center"><?=$row['stt']?> </td>
				<td  align="center"><a href="index.php?site=<?=$_GET['site']?>&Edit=<?=$row['id']?>">Sửa</a></td>
	</tr>	  
<? }
}
?> 
<tr>
	    
	    <td colspan="4" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa tin này" name="ItemDel" > 
		</td>
       
      </tr>		
		  
  
</table>
</form>

