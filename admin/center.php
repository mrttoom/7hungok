<style type="text/css">
<!--
.style21 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

<table width="500" border="0" cellspacing="0" cellpadding="0">
<?    if($_SESSION['modn']!='1')   {?>
  <tr>
    <td height="100" valign="bottom"><span class="style21">Bạn không đủ quyền để thực hiện một số chức năng sau: </span>
	<p> 1- Không được xóa tin </p>
	<p> 2- Không được sửa tin </p>
	<p> 2- Không được upload file ( ngoại trừ file ảnh) </p>
	</td>
  </tr>
  
  
  <?  } else { ?>
  
  <tr>
    <td height="100" valign="bottom">
  
  <?  echo "<span id=\"thongbao\"> Xin chào bạn </span>"; } ?>

</td>
  </tr>
</table>
