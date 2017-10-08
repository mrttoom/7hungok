<? if(!defined("hdc")) exit ();

function showCartb() {
	global $db,$id,$explode;
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		    $output[] = '<table style="border-collapse: collapse;" width="99%" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >';
		    $output[] = '<tr style="background-color:#cccccc;font-weight:bold;height:23px">';	
			
			$output[] = '<td style="padding-left:10px; color:#000000">Tên sản phẩm</td>';
			$output[] = '<td style="text-align:center; color:#000000">Đơn giá</td>';
			$output[] = '<td style="text-align:center; color:#000000">Số lượng</td>';
			$output[] = '<td style="text-align:center; color:#000000">Tổng</td>';
			$output[] = '</tr>';
		foreach ($contents as $id=>$qty) {
		 if($id!='1'&&$id!='') {
		 
			$sql = 'SELECT * FROM '.product.' WHERE id = '.intval($id);
			$result =mysql_query($sql);
			$row = mysql_fetch_array($result);
			$output[] = '<tr height=25px>';	
			
			$output[] = '<td style="padding-left:10px">'.$row['title'].'</td>';
			$output[] = '<td align="center">'.number_format($row['price']*$explode[0],0,",",".").' '.$explode[1].'</td>';
			$output[] = '<td align="center">'.$qty.'</td>';
			$output[] = '<td align="center">'.number_format(($row['price']*$explode[0]* $qty),0,",",".").' '.$explode[1].'</td>';
			$total   += ($row['price'] * $qty);$_SESSION['total'] = $total;
			
			$output[] = '</tr>';
		  }	
		}
		$output[] = '</table>';
		
		$output[] = '<p ><font color=#FF0000> <b>Tổng đơn giá:</b> '.number_format($total*$explode[0],0,",",".").' '.$explode[1].'</font></p>';
		
	} else {
	$output[] = '<p>You shopping cart is empty.</p>';
		$_SESSION['cart']='';
		$_SESSION['total']='';	
	}
	return join('',$output);
}

















?>


 <?
          $sqlstr=mysql_query("SELECT * FROM ".contact2."");
		  if(mysql_num_rows($sqlstr)>0) {
		   
		   while($row=mysql_fetch_array($sqlstr)) {
		   
		   
		  $em= $row['email'];
		    $emb= $row['emailb'];
		   
	} } ?>
   
      
	        <title>Thông tin đơn hàng  , <?=$tde?> </title> 
<meta name="keywords" content=" Thông tin đơn hàng   , <?=$key?>" />
  <meta name="description" content="Thông tin đơn hàng   , <?=$mota?>" />

	  
	  <?
         if($_POST['submitShoppingCart']) {
		     
			 if(!$_POST['fullname'])    echo "<script>alert('Mời bạn nhập đầy đủ thông tin có dấu *');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
			 elseif(!$_POST['email'])       echo "<script>alert('Mời bạn nhập đầy đủ thông tin có dấu *');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
			 elseif(!$_POST['address'])       echo "<script>alert('Mời bạn nhập đầy đủ thông tin có dấu *');location.href='".$_SERVER['HTTP_REFERER']."';</script>";	 
			 elseif(!$_POST['telephone'])     echo "<script>alert('Mời bạn nhập đầy đủ thông tin có dấu *');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
			 elseif(!$_POST['bank'])         echo "<script>alert('Mời bạn nhập đầy đủ thông tin có dấu *');location.href='".$_SERVER['HTTP_REFERER']."';</script>";
			 else {
			 
			  mysql_query("INSERT INTO ".shoppingCart." SET 
			  fullname        = '".text($_POST['fullname'])."'
			  ,email          = '".text($_POST['email'])."'
			  ,address        = '".text($_POST['address'])."'
			  ,cmtnd          = '".text($_POST['cmtnd'])."'
			  ,telephone      = '".text($_POST['telephone'])."'
			  ,bank           = '".text($_POST['bank'])."'
			  ,detail         = '".text($_POST['detail'])."'
			  ,masp           = '".$_SESSION['cart']."'
			  ,postdate       = '".time()."' ");
			  
			   $gg=showCartb();
			  $mailk = $_POST['email'];
			$headers = "Content-type: text/html\r\nFrom: $mailk\r\nReply-to: $mailk";

mail($em,' Thông tin đặt hàng của khách tại website của bạn ',$gg,$headers); 
			$headersb = "Content-type: text/html\r\nFrom: $em\r\nReply-to: $em";

mail($mailk,' Thông tin đặt hàng của bạn tại website chúng tôi ',$gg,$headersb); 
			
			
			 }
		 
		 }
    ?>
<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center"   id="bochinh">
    <tr ><td   id="asanpham"  colspan="2"><span id="sanpham">Thông tin đơn hàng của bạn </span></td>   
    </tr>
	 <tr ><td height="10"   colspan="2">&nbsp;</td>
<tr ><td    colspan="2" align="center">
 <?php echo showCartb(); ?>
	</td>   
    </tr> 
 
         
  <tr ><td height="26"   colspan="2">&nbsp;</td>   
  </tr> 
  
		  
       <tr>
            <td  width="20%" height="31" id="ten"><div align="right">
         
            Họ tên: &nbsp;&nbsp;</div></td>
            <td  width="80%"><strong><?=$_POST['fullname']?></strong></td>
          </tr>
          <tr>
            <td height="30" id="ten"><div align="right">
               
            Địa chỉ:&nbsp;&nbsp;</div></td>
            <td><strong><?=$_POST['address']?></strong></td>
          </tr>
          <tr>
            <td height="31" id="ten"><div align="right">
                
            Điện thoại:&nbsp;&nbsp;</div></td>
            <td><strong><?=$_POST['telephone']?></strong></td>
          </tr>
          <tr>
            <td height="29" id="ten"><div align="right">
             
            Email:&nbsp;&nbsp;</div></td>
            <td><strong><?=$_POST['email']?></strong></td>
          </tr>
        
       	  
		   <tr>
            <td height="29" id="ten"><div align="right">
             
            CMTND số:&nbsp;&nbsp;</div></td>
            <td><strong><?=$_POST['email']?></strong></td>
          </tr>
		   <tr>
            <td height="29" id="ten"><div align="right">
             
            Hình thức thanh toán:&nbsp;&nbsp;</div></td>
            <td><strong><?=$_POST['bank']?></strong></td>
          </tr>
		   <tr>
            <td id="ten"><div align="right">
               
            Thông tin thêm: &nbsp;&nbsp;</div></td>
            <td align="left"> 
			 <?=$_POST['detail']?>
			
			
			  </td>
          </tr>
		    <tr>
            <td height="10" colspan="2">
           &nbsp;&nbsp;</td>
          </tr>
		<? if($_POST['bank']=='TT') {?>  
		     <tr>
			 <td height="30" valign="top"><div align="right">
               Thanh toán :</div></td>
            <td   align="left">
        
		<!-- BEGIN NGANLUONG.VN PAYMENT FORM -->
<form method=post action=https://www.nganluong.vn/advance_payment.php>
<input type=hidden name=receiver value="<?=$emb?>" />
<input type=hidden name=product value="Thanh toán theo đơn hàng" />
<input type=hidden name=price value="<?=$total?>" />
<input type=hidden name=return_url value="index.php" />
<input type=hidden name=cancel_url value="contact.html" />
<input type=hidden name=comments value="Ghi chú về đơn hàng" />
<input type=image src="https://www.nganluong.vn/data/images/buttons/7.gif" />
</form>
<!-- END OF NGANLUONG.VN PAYMENT FORM -->
		
		
		
		
</td>
          </tr>
         <? }?>   
		   <tr>
            <td height="50" colspan="2">
           &nbsp;&nbsp;</td>
          </tr>
        </table>  
		
		














