<? if(!defined("hdc")) exit ();?>
   <title>Liên hệ , <?=$tde?> </title> 
<meta name="keywords" content=" Liên hệ , <?=$key?>" />
  <meta name="description" content="Liên hệ , <?=$mota?>" />

   
   <form method="post" action="">
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center"   id="bochinh">
    <tr >
      <td   id="asanpham"  colspan="2"><span id="sanpham">Liên hệ </span></td>   
    </tr> 
   <tr >
       <td  colspan="2" id="noidung">
       <?
          $sqlstr=mysql_query("SELECT * FROM ".contact2."");
		  if(mysql_num_rows($sqlstr)>0) {
		   
		   while($row=mysql_fetch_array($sqlstr)) {
		   
		   echo $row['full_intro'];
		  $em= $row['email'];
		   
	} } ?>
   
   
   
    
<?
            if($_POST['Send']) {
            
            if($_POST['fullname']=='') {
               echo "<span id=\"gia\"> Bạn vui lòng điền đầy đủ các thông tin có dấu * </span>"; }
                
            elseif($_POST['address']=='') {
               echo "<span id=\"gia\"> Bạn vui lòng điền đầy đủ các thông tin có dấu * </span>"; }
            
            elseif($_POST['telephone']=='') {
               echo "<span id=\"gia\"> Bạn vui lòng điền đầy đủ các thông tin có dấu * </span>"; }
                
            elseif($_POST['email']=='') {
               echo "<span id=\"gia\"> Bạn vui lòng điền đầy đủ các thông tin có dấu * </span>"; }
                
            elseif($_POST['title']=='') {
               echo "<span id=\"gia\"> Bạn vui lòng điền đầy đủ các thông tin có dấu * </span>"; }
            
            elseif($_POST['content']=='') {
               echo "<span id=\"gia\"> Bạn vui lòng điền đầy đủ các thông tin có dấu * </span>"; }
			   
	       elseif(text($_POST['code'])!=$_SESSION['stringcode']) {
               echo "<span id=\"gia\"> Mã xác nhận không đúng</span>"; }
			   
            else {
            
            mysql_query("INSERT INTO ".contact." SET fullname='".$_POST['fullname']."'
            ,address='".$_POST['address']."',telephone='".$_POST['telephone']."',email='".$_POST['email']."'
            ,title='".$_POST['title']."',content='".$_POST['content']."' ,postdate= '".time()."'");
            
            echo "<script>alert('Nội dung liên hệ đã gửi tới chúng tôi. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất');location.href='".$domain."';</script>";
				$email = $_POST['email'];
			$headers = "From: $email";
mail($em,$_POST['title'],'Duoc gui tu website muaban365.org  -  Nguoi gui: '.$_POST['fullname'].' - Dia chi: '.$_POST['address'].'  - Dien thoai:'.$_POST['telephone'].'  - Noi dung: '.$_POST['content'],$headers);
            
            }	
        }
        ?>
       
       </td>
    </tr>

   
          <tr>
            <td  width="20%" height="31"><div align="right">
                <?=$require?> 
            Họ tên: &nbsp;&nbsp;</div></td>
            <td  width="80%"><input name="fullname"  type="text" size = "30" value="<?=$_POST['fullname']?>" ></td>
          </tr>
          <tr>
            <td height="30"><div align="right">
                <?=$require?>
                Địa chỉ:&nbsp;&nbsp;</div></td>
            <td><input name="address"  type="text" size = "30" value="<?=$_POST['address']?>"></td>
          </tr>
          <tr>
            <td height="31"><div align="right">
                <?=$require?> 
            Điện thoại:&nbsp;&nbsp;</div></td>
            <td><input name="telephone"  type="text" size = "30" value="<?=$_POST['telephone']?>" ></td>
          </tr>
          <tr>
            <td height="29"><div align="right">
                <?=$require?> 
            Email:&nbsp;&nbsp;</div></td>
            <td><input name="email" type="text" value="<?=$_POST['email']?>" size = "30" ></td>
          </tr>
          <tr>
            <td height="31"><div align="right">
                <?=$require?> 
            Tiêu đề:&nbsp;&nbsp;</div></td>
            <td><input name="title"    type="text" value="<?=$_POST['title']?>" size = "40" ></td>
          </tr>
          
          
       	  
		  
		   <tr>
            <td ><div align="right">
                <?=$require?> 
            Nội dung: &nbsp;&nbsp;</div></td>
            <td align="left"> 
			 <textarea name="content" id="content" cols="40" rows="5"><?=$_POST['content']?></textarea>
			
			
			  </td>
          </tr>
		    <tr>
            <td height="29"><div align="right">
                <?=$require?> 
            Mã xác nhận:&nbsp;&nbsp;</div></td>
            <td><input type="text" name="code"  size="3" maxlength="10">
		<?=createImage()?>	</td>
          </tr>
          <tr>
            <td></td>
            <td><input name="Send" type="submit" value="Send">
               </td>
          </tr>
		   <tr>
            <td height="50" colspan="2">
           &nbsp;&nbsp;</td>
          </tr>
        </table>  
        </form>	   
		
		
