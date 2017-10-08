<? include "check.php";?>
<div style="width:96%"  align="center" ><strong>QUẢN LÝ ĐƠN HÀNG:</strong></div>

<?  	
     
	   if($_POST['ItemDel']) {
		      $action='';
			  if($_POST['element']=='') {
			  
			     echo '<script>alert(\'Mời bạn chọn ít nhất 1 bản tin\')</script>';
				 $action=true;
			  } 
			  if($action=='') {
		  
			  mysql_query("DELETE FROM ".shoppingCart." WHERE id in (".implode(",",$_POST['element']).")");
			 
			  }
		  }	
	 

?>
<? if($_GET['view']!='') {?>

<?
function showCart($view) {
 $sqlstr = 'SELECT * FROM '.shoppingCart.' WHERE id='.intval($view).'';
 $resultstr =mysql_query($sqlstr);
 $rowstr = mysql_fetch_array($resultstr);
   
	$cart = $rowstr['masp'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		   
		    $output[] = '<table align="center"  style="border-collapse: collapse;" width="99%" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >';
		    $output[] = '<tr  style="background-color:#CCCCCC;font-weight:bold;height:23px">';			
			$output[] = '<td style="padding-left:10px">Tên sản phẩm</td>';
			$output[] = '<td align="center">Đơn giá</td>';
			$output[] = '<td align="center">Số lượng</td>';
			$output[] = '<td align="center">Tổng</td>';					
			$output[] = '</tr>';
		foreach ($contents as $id=>$qty) {
		 if($id!='1'&&$id!='') {
		 
			$sql = 'SELECT * FROM '.product.' WHERE id = '.intval($id);
			$result =mysql_query($sql);
			
			$row = mysql_fetch_array($result);
			
			$output[] = '<tr height=25px>';			
			$output[] = '<td style="padding-left:10px">'.$row['title'].'</td>';
			$output[] = '<td align="center">'.number_format($row['price'],0,",",".").' VND</td>';
			$output[] = '<td align="center">'.$qty.'</td>';
			$output[] = '<td align="center">'.number_format(($row['price'] * $qty),0,",",".").' VND</td>';
			$total   += ($row['price'] * $qty);			
			$output[] = '</tr>';
		  }	
		}
		   $output[] = '<tr  style="background-color:#CCCCCC;font-weight:bold;height:23px">';			
		   $output[] = '<td style="padding-left:10px" colspan="4"><b>Tổng đơn giá:</b> <font color=#FF0000><strong>'.number_format($total,0,",",".").' VND</strong></font></td>';
		   $output[] = '</tr>';
		   $output[] = '</table>';	
		  
		
	} else {
		$output[] = '<p>You shopping cart is empty.</p>';
	}		
	return join('',$output); 
}
?>
<table  align="center" width="750" border="0" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >

<tr >
      <td  colspan="2" ><?php
    echo showCart($_GET['view']);
?>
</td>
<tr >
      <td  colspan="2" height="30" >
</td>	    
</tr> </table>



 <?
   
  $sqlstr=mysql_query("SELECT * FROM ".shoppingCart." WHERE id=".intval($view)."" );
  mysql_query("UPDATE ".shoppingCart." SET status='true' WHERE id=".intval($view)."" );
  if(mysql_num_rows($sqlstr)>0)   {
		   
  $row=mysql_fetch_array($sqlstr);	
?>
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
<tr id="tieude">
      <td  colspan="2" ><div align="center">Thông tin người gửi đơn hàng:</div></td>
	    
</tr>

  <tr>
    <td  width="30%"><div align="right">Người gửi</div></td>
    <td  width="70%"><?=$row['fullname']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Email</div></td>
    <td><?=$row['email']?>&nbsp;</td>
  </tr>
   <tr>
    <td><div align="right">Địa chỉ </div></td>
    <td><?=$row['address']?>&nbsp;</td>
  </tr>
   <tr>
    <td><div align="right">CMTND </div></td>
    <td><?=$row['cmtnd']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Điện thoại</div></td>
    <td><?=$row['telephone']?>&nbsp;</td>
  </tr>
 
 
  <tr>
    <td><div align="right">Hình thức thanh toán</div></td>
    <td><?=$row['bank']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Ghi chú thêm</div></td>
    <td><?=$row['detail']?>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Ngày gửi</div></td>
    <td><?=date("d/m/Y",$row['postdate'])?>&nbsp;</td>
  </tr>
</table>

<? } }?> 

<br />
<form method="post" action="">
<table style="border-collapse: collapse;"  align="center" width="750" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >


<tr id="tieude">
      <td width="5%" height="27" ><div align="center">#ID</div></td>
	    <td width="61%" >Người gửi</td>
        <td width="17%" ><div align="center">Ngày gửi </div></td>
        <td width="17%" ><div align="center">Trang thái </div></td>
</tr>
  <?
	      $p=10;
		  $sqlstr="SELECT * FROM ".shoppingCart."";			
	  
		  $page=mysql_query($sqlstr);
		  $n_record=mysql_num_rows($page);
		  num_page(); 
		  $link="index.php?menu=".$_GET['menu']."&site=".$_GET['site'].""; 
		  $page=$_GET['page']?intval($_GET['page']):1;   
		  $s=($page-1)*$p;   
		  
		  $sqlstr.=" order by ID DESC limit $s,$p";
		  
	  	
		  $sqlstr=mysql_query($sqlstr);	
			
		  if(mysql_num_rows($sqlstr)>0)   {
		   
		  while($row=mysql_fetch_array($sqlstr))	 {
	
?>	  
	  <tr >
	    <td width="20" height="15"  align="center" bgcolor="#EEEEEE">
		<input  type="checkbox" name="element[]" value="<?=$row['id']?>" />		</td>
		<td  ><a href="index.php?site=<?=$_GET['site']?>&view=<?=$row['id']?>"><?=$row['fullname']?></a></td>
	    <td width="112" style="cursor:pointer" ><div align="center"><?=date("d/m/Y",$row['postdate'])?></div></td>
	    <td width="100" style="cursor:pointer" ><div align="center"><? echo $row['status']=='true'?'Đã xem':'Chưa xem';?></div></td>
	  </tr>	  
<? }
}
?> 
 <tr>
	    
	   
        <td colspan="5"  align="right"><? view_page($link)?></td>
      </tr>		
<tr>
	    
	    <td  colspan="5" >
		<input type="submit"   onClick="return confirm('Bạn có chắc không ?');" value="Xóa đơn hàng này" name="ItemDel" ></td>
      </tr>	
	   
</table>
</form>
</div>

