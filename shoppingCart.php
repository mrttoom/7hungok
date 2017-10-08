<? if(!defined("hdc")) exit ();?>
<Meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 
if($_GET['Cart'] != '') $_SESSION['cart'] = '';
$cart = $_SESSION['cart'];
$action = $_GET['action'];
switch ($action) {
	case 'add':
		if ($cart) {
			$cart .= ','.$_GET['id'];
		} else {
			$cart = $_GET['id'];
		}
		header('location:index.php?page=shoppingCart');
		break;
	case 'delete':
		if ($cart) {
			$items = explode(',',$cart);
			$newcart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newcart != '') {
						$newcart .= ','.$item;
					} else {
						$newcart = $item;
					}
				}
			}
			$cart = $newcart;
		}
		break;
	case 'update':
	if ($cart) {
		$newcart = '';
		foreach ($_POST as $key=>$value) {
			if (stristr($key,'qty')) {
				$id = str_replace('qty','',$key);
				$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
				$newcart = '';
				foreach ($items as $item) {
					if ($id != $item) {
						if ($newcart != '') {
							$newcart .= ','.$item;
						} else {
							$newcart = $item;
						}
					}
				}
				for ($i=1;$i<=$value;$i++) {
					if ($newcart != '') {
						$newcart .= ','.$id;
					} else {
						$newcart = $id;
					}
				}
			}
		}
	}
	$cart = $newcart;
	header('location:index.php?page=shoppingCart');
	break;
}
$_SESSION['cart'] = $cart;
/*function shoppingCart*/
function showCart() {
	global $db,$id,$explode;
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		    $output[] = '<form action="index.php?page=shoppingCart&action=update" method="post" id="cart">';
		    $output[] = '<table align="center"  style="border-collapse: collapse;" width="99%" border="1" bordercolor="#bbbbbb" cellpadding="1" cellspacing="1" >
';
		    $output[] = '<tr style="background-color:#8A8A8A;font-weight:bold;height:28px">';	
			
			$output[] = '<td style="padding-left:10px; color:#FFFFFF">Tên sản phẩm</td>';
			$output[] = '<td style="text-align:center; color:#FFFFFF">Đơn giá</td>';
			$output[] = '<td style="text-align:center; color:#FFFFFF">Số lượng</td>';
			$output[] = '<td style="text-align:center; color:#FFFFFF">Tổng</td>';
			$output[] = '<td style="text-align:center; color:#FFFFFF">Hủy</td>';			
			$output[] = '</tr>';
		foreach ($contents as $id=>$qty) {
		 if($id!='1'&&$id!='') {
		 
			$sql = 'SELECT * FROM '.product.' WHERE id = '.intval($id);
			$result =mysql_query($sql);
			$row = mysql_fetch_array($result);
			$output[] = '<tr height=25px>';	
			
		
			
			$output[] = '<td style="padding-left:10px"><a href="productView_'.$row['category'].'_'.$row['subCategory'].'_'.$row['id'].'.html" id="tieude">'.$row['title'].'</a></td>';
			$output[] = '<td align="center">'.number_format($row['price']*$explode[0],0,",",".").' '.$explode[1].'</td>';
			$output[] = '<td align="center"><input type="text" name="qty'.$row['id'].'" value="'.$qty.'" size="3" maxlength="3" /></td>';
			$output[] = '<td align="center">'.number_format(($row['price']*$explode[0]* $qty),0,",",".").' '.$explode[1].'</td>';
			$total   += ($row['price'] * $qty);$_SESSION['total'] = $total;
			$output[] = '<td align="center"><input type=button value="Hủy" style="border:0px; background-color:#8A8A8A;width:60px;color:#FFFFFF"  onclick="location.href=\'index.php?page=shoppingCart&action=delete&id='.$row['id'].'\'"></a></td>';
			$output[] = '</tr>';
		  }	
		}
		$output[] = '</table>';
		$output[] = '<p ><b>  &nbsp;&nbsp;&nbsp;Tổng giá trị:</b> <font color=#FF0000><strong>'.number_format($total*$explode[0],0,",",".").' '.$explode[1].'</strong></font></p>';
		$output[] = '<div>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit">Cập nhật giỏ hàng</button><button type="button" onclick="location.href=\'index.php\'">Tiếp tục mua hàng</button>&nbsp;<input onclick="location.href=\'index.php?page=shoppingCart&Cart=false\'" type="button" value="Hủy giỏ hàng" ></div>';
		$output[] = '</form>';
	} else {
		$output[] = '<p>Bạn chưa có gì trong giỏ.</p>';
		$_SESSION['cart']='';
		$_SESSION['total']='';
	}
	return join('',$output);
}



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
	$output[] = '<p>Bạn chưa có gì trong giỏ.</p>';
		$_SESSION['cart']='';
		$_SESSION['total']='';	
	}
	return join('',$output);
}

?>
      
	<?php
	 echo showCart();
    ?>
	
<? if($_SESSION['cart']) {?>

	
	<form action="index.php?page=payment" method="post">
	
         <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center" id="bochinh">
         <tr id="asanpham"    >
           <td colspan="2"><span id="sanpham"> Người gửi đơn hàng </span></td>
         </tr>
         <tr>
            <td height="28"></td>
            <td  style="color:#FF0000"><? echo $alert?></td>
          </tr>
          <tr>
            <td height="28"><div align="right"><?=$require?> Họ tên:&nbsp;&nbsp;</div></td>
            <td><label>
              <input type="text" name="fullname" value="<?=$_POST['fullname']?>" size="30" />
            </label></td>
          </tr>
          <tr>
            <td height="28"><div align="right"><?=$require?> Email:&nbsp;&nbsp;</div></td>
            <td><input type="text" name="email" value="<?=$_POST['email']?>" size="30"/></td>
          </tr>
          <tr>
            <td height="26"><div align="right"><?=$require?> Địa chỉ:&nbsp;&nbsp;</div></td>
            <td><input type="text" name="address"  value="<?=$_POST['address']?>" size="30"/></td>
          </tr>
          <tr>
            <td height="27"><div align="right">CMTND số:&nbsp;&nbsp;</div></td>
            <td><input type="text" name="cmtnd"   value="<?=$_POST['cmtnd']?>" size="30"/></td>
          </tr>
          <tr>
            <td height="27"><div align="right"><?=$require?> Điện thoại:&nbsp;&nbsp;</div></td>
            <td><input type="text" name="telephone"  value="<?=$_POST['telephone']?>" size="30"/></td>
          </tr>
         
          <tr>
            <td height="27"><div align="right"><?=$require?> Hình thức thanh toán:&nbsp;&nbsp;</div></td>
            <td>
              <input type="radio" name="bank"  value="Chuyển khoản ngân hàng" checked="checked"/>
              Ngân hàng
            
              <input type="radio" name="bank" value="Thanh toán tiền mặt" /> 
              Tiền mặt
			  
</td>
          </tr>
          <tr>
            <td height="27"><div align="right">Ghi chú thêm:&nbsp;&nbsp;</div></td>
            <td><label>
              <textarea name="detail" id="textarea" cols="25" rows="5"></textarea>
            </label></td>
          </tr>
          <tr>
            <td height="28">&nbsp;</td>
            <td><label>
              <input type="submit" name="submitShoppingCart" id="button" value=" Đặt hàng " />
             
            </label></td>
          </tr>
        </table>
    </form>
   
 <? }?>   
