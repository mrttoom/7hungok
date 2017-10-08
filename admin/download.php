<? include "check.php";?>
<br />
<?  
		  if($_POST['InsertNews']) {

	 
				if($title!='')   {
				
			    uploadsb($file='picture',$folder = '../images/file/');				
				 
				mysql_query("INSERT INTO ".download." SET 
				title = '".text($_POST['title'])."'
				,link = '".text($_POST['link'])."'
				,loai='".$_POST['loai']."'
				,picture = '$picture'
       			,short = '".textContent($_POST['short'])."',full = '".textContent($_POST['full'])."'
				,postdate = '".time()."'");
				
				echo "Thêm tin  <b>".$title."</b> thành công";
		}	  
	  }
		  if($_POST['EditNews']) {
	 	  if($_SESSION['modn']=='1')   {
	 
				if($title!='')   {
				
			    uploadsb($file='picture',$folder = '../images/file/');
				 
				if($picture=='') {$picture=$_POST['picture_hidden'];	} else {  
				
				  unlink("../images/file/".$_POST['picture_hidden']); 
				
				 }								
				
				mysql_query("UPDATE ".download." SET 
				title = '".text($_POST['title'])."'
				,link = '".text($_POST['link'])."'
				,loai='".$_POST['loai']."'
				,picture = '$picture'
       			,short = '".textContent($_POST['short'])."',full = '".textContent($_POST['full'])."'
				,postdate='".time()."' WHERE id='".intval($_GET['Edit'])."'");
				
				echo "Cập nhật  <b>".$title."</b> thành công";
		}	
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
			  
			 
			 
			  	$sqlstr = "SELECT *	FROM ".download." WHERE  id in (".implode(",",$_POST['element']).") ";
	
		  $sqlstr=mysql_query($sqlstr);	
		   if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
					  
            while($row=mysql_fetch_array($sqlstr)) {      $i+=1;
			
         unlink("../images/file/".$row['picture']);   
                                               
            mysql_query("DELETE FROM ".download." WHERE id ='".$row['id']."'   "); 
           	   
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
		  
			  mysql_query("UPDATE  ".download." SET status='false' WHERE id in (".implode(",",$_POST['element']).")");
			 
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
		  
			  mysql_query("UPDATE  ".download." SET status='true' WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			  } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; }
		  }	     

?>
<? if($_GET['Edit']=='') {?>

<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form action="" method="post" enctype="multipart/form-data" >
 	 <tr id="tieude"  ><td  colspan="2" ><span id="TextLeftCenter2m">&nbsp;&nbsp;Thêm Download </span>  </td>  </tr>

 
 
  <tr >
    <td width="19%" class="height_row"><div align="right">Tiêu đề tin</div></td>
    <td width="81%" class="height_row"><label>
      <input type="text" size="90" name="title" id="inputRegister"   />
    </label></td>
  </tr>
  
  
  <tr>
    <td class="height_row"><div align="right">File</div></td>
    <td class="height_row"><label>
      <input name="picture" type="file" id="picture" />
    </label></td>
  </tr>
   <tr>
    <td width="19%" class="height_row"><div align="right">Link file</div></td>
    <td width="81%" class="height_row"><label>
      <input type="text" name="link" class="input_text" value="http://" />
    </label>
	
      <input type="checkbox" name="loai" id="loai"  value="true"/>
  ( nếu chọn link file từ nơi khác thì stick vào đây)
	
	</td>
  </tr>
 
   
  <tr>
    <td>&nbsp;</td>
    <td><label>	  
      <input name="InsertNews" type="submit" id="InsertNews" value="Thêm " />
      
    </label></td>
  </tr>
  </form>
</table>
<? }?>


<? if($_GET['Edit']!='') {?>

 <?


	  $sqlstr=mysql_query("SELECT * FROM ".download."  WHERE id='".intval($_GET['Edit'])."'");
	  if(mysql_num_rows($sqlstr)>0)   {
	   
      $row=mysql_fetch_array($sqlstr)
	
?>	 
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<form method="post" action=""  enctype="multipart/form-data">
    	 <tr id="tieude"  ><td  colspan="2" ><span id="TextLeftCenter2m"> &nbsp;&nbsp;&nbsp;Sửa Download </span>  </td>  </tr>

   
   <tr>
    <td width="19%" class="height_row"><div align="right">Tiêu đề tin</div></td>
    <td width="81%" class="height_row"><label> 
      <input type="text" size="90" name="title" id="inputRegister" value="<?=$row['title']?>"/>
    </label></td>
  </tr>
  
  
  <tr>
    <td class="height_row"><div align="right">File</div></td>
    <td class="height_row"><label>
      <input name="picture_hidden"  type="hidden"  value="<?=$row['picture']?>" />
      <input name="picture" type="file" id="picture" />
    </label></td>
  </tr>
  <tr>
    <td width="19%" class="height_row"><div align="right">Link File</div></td>
    <td width="81%" class="height_row"><label> 
      <input type="text" name="link" class="input_text"  value="<?=$row['link']?>"/>
    </label>
	 <input type="checkbox" name="loai" id="loai"  value="true" <? echo $row['loai']=='true'?'checked':''?> />
	 ( nếu chọn link file từ nơi khác thì stick vào đây)
	
	</td>
  </tr>
   
  <tr>
    <td>&nbsp;</td>
    <td><label>	  
      <input type="submit" name="EditNews" value="Sửa " />
     
    </label></td>
  </tr>
  </form>
</table>
<? } }?>
<br />



<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
 <form method="post" action="">

 <tr id="tieude">
      <td width="10%" height="27" ><div align="center">#ID</div></td>
      <td width="55%" >Tiêu đề tin</td>
      <td width="15%" ><div align="center">File</div></td>
	   <td width="10%" ><div align="center">Sửa</div></td>  
      <td width="10%" ><div align="center">Trạng Thái</div></td>        
</tr>

 
 
  <?
	      $p=30;
		  $sqlstr="SELECT 	*	FROM ".download."";
				 
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
	    <td  height="30"  align="center">
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td  ><?=$row['title']?></td>
		<td  >
		<? if($row['loai']=='true') { ?>
	<div align="center"><a  href="<?=$row['link']?>">Downdload</a> </div>
		<? } else  { ?>
		<div align="center">	<a  href="../images/file/<?=$row['picture']?>">Downdload</a></div>
		<? }  ?>
		
		</td>
		<td  ><div align="center"><a  href="index.php?site=<?=$_GET['site']?>&Edit=<?=$row['id']?>">Sửa</a>&nbsp;</div></td>
		<td  align="center"><?=$row['status']?></td>
	</tr>	  
<? }
}
?> 
<tr>
	  
        <td  align="right" colspan="5"><? view_page($link)?></td>
      </tr>		
	  <tr>
	    <td  colspan="5" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa tin này" name="ItemDel" > 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Ẩn tin này" name="ItemHid"> 
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Hiện tin này" name="ItemShow" >		</td>
      
      </tr>		  
  </form>

</table>

