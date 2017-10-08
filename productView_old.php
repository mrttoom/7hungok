<? if(!defined("hdc")) exit ();?>

   
          <?
		
          $sqlstr = "SELECT * FROM ".product."  WHERE status='true' 
					  AND id = '".intval($_GET['id'])."'  ";			
		  $sqlstr=mysql_query($sqlstr);	
		  	 mysql_query("UPDATE  ".product."  SET solan=solan+1 WHERE id='".intval($_GET['id'])."'");		 					  
          if(mysql_num_rows($sqlstr)>0) {	
					  
          $row=mysql_fetch_array($sqlstr);
           ?>
 
    <title> <?=$row['title']?> , <?=$tde?> </title> 
<meta name="keywords" content=" <?=$row['title']?> , <?=$key?>" />
  <meta name="description" content="<?=$row['title']?>, <?=$mota?>" />

 
<!---->
<table style="border-collapse: collapse;"   width="99%" align="center" border="1"  cellpadding="0" cellspacing="2" id="bochinh" >  
 
   <tr id="achitiet">
   <td  colspan="3" align="left" height="30" >
   <span id="chitiet"><?=$row['title']?></span>  </td>
  </tr>
				
   
                           <tr >
                     <td    colspan="3"   align="center" >
                       
                       
								<? if($row['picture2']) {?>
                                
                               <img src="images/product/goc/<?=$row['picture2']?>" border="0" >	    
							<? }?> 							
					
			</td>
  </tr>
                
                       <tr>
                         <td  colspan="3" height="30">&nbsp;&nbsp;&nbsp;&nbsp;     <strong>Giá: </strong> <span id="gia"><? if($row['price']) {?>  <?=number_format($row['price']*$explode[0],0,",",".")?> <?=$explode[1]?> <? } else {?>Call <? }?>           </td>
                       </tr>   
					    <tr>
                         <td  colspan="3" height="30">&nbsp;&nbsp;&nbsp;&nbsp;    <strong>Đặt mua: </strong>  <a  href="index.php?page=shoppingCart&action=add&viewParent=<?=$_GET['viewParent']?>&id=<?=$row['id']?>" id="tieude"><img src="images1/mua.gif" border="0" align="absmiddle" /></a>                      </td>
                       </tr>    	   
        
		  <tr>
                         <td  colspan="3"height="30"bgcolor="#EFEFEF">&nbsp;&nbsp;<strong>Thông tin chi tiết</strong></td>
                       </tr>    
					     <tr>
                         <td  colspan="3"  id="noidung" height="30"><?=textContent($row['tomtat'])?></td>
                       </tr>    
		    
		

                        </table>
						
					  
                     	   
            <?  }   ?>  


<br />





<table width="99%" border="0" align="center" cellspacing="1" cellpadding="1" id="bochinh">
 <tr id="asanpham">
    <td colspan="3"  ><span id="sanpham">&nbsp;&nbsp;Các sản phẩm cùng loại khác </span></td>
  </tr>
  
  
     <tr >
 
<?
  $p=15;				 
					  $sqlstr = "SELECT *	FROM ".product." WHERE status='true' AND category = '".intval($row['category'])."' AND id <> '".intval($_GET['id'])."'  ";
					
		  $sqlstr .=" ORDER BY postdate DESC limit $p";
		  $sqlstr=mysql_query($sqlstr);	
		  ?>
  
  <?  					  
            if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
					  
            while($row=mysql_fetch_array($sqlstr)) {      $i+=1;
           ?>
                   
                     <td     align="center" valign="top" width="33%"  id="bosanpham" >
                       
                         
						  
						 <table width="100%" border="0" cellspacing="3" cellpadding="3" >
  <tr>
  <tr>
 
    <td valign="top"  align="center" colspan="2" height="40"> <a  href="productView_<?=$row['category']?>_<?=$row['subCategory']?>_<?=$row['id']?><?=$vip?>" id="tieude"><?=$row['title']?></a> 
	  </td>
  </tr>
    <td  valign="middle" align="center"   colspan="2" height="160">
	
	<a  href="productView_<?=$row['category']?>_<?=$row['subCategory']?>_<?=$row['id']?><?=$vip?>" ><img src="images/product/thumbs/<?=$row['picture']?>"  border="0"  alt="<?=$row['title']?>" title="<?=$row['title']?>"/></a></td>
  </tr>
 
   <tr>
 
    <td  valign="bottom"  align="center"  colspan="2">        <strong>Giá: </strong> <span id="gia"><? if($row['price']) {?>  <?=number_format($row['price']*$explode[0],0,",",".")?> <?=$explode[1]?> <? } else {?>Call <? }?>  </span>                                              
	  </td>
  </tr>
    <tr>
  <td valign="top"  align="center"> <a  href="productView_<?=$row['category']?>_<?=$row['subCategory']?>_<?=$row['id']?><?=$vip?>" id="tieude"><img src="images1/chitiet.gif" border="0" /></a> 
	  </td>
    <td valign="top"  align="center"> <a  href="index.php?page=shoppingCart&action=add&viewParent=<?=$_GET['viewParent']?>&id=<?=$row['id']?>" id="tieude"><img src="images1/mua.gif" border="0" /></a> 
	  </td>
  </tr>
  
 
</table>
	
		
	
									                    
	   </td>
                    
                                               
                       <? if($i%3==0) echo "</tr>";?>         	   
                       <?	} }					 
                      else {
                       echo "<td style='color:#FF0000' >Chưa có tin nào</td> </tr> ";
                       }
                  ?>   
				  
		   
             

			  
         
</table>



