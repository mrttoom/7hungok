<? if(!defined("hdc")) exit ();?>
<table width="99%" border="0" align="center" cellpadding="2" cellspacing="2" id="bochinh" >
    
    <tr>
      <td colspan="3"   height="30" style="color: #FF6600; font-weight:bold; padding-left:5px">Kết quả tìm kiếm với từ khóa <span style="color:#FF0000">" <?=$_GET['KeyWord']?> "</span></td>
     </tr>
            <tr>
      <td colspan="32"  >&nbsp;</td>
    </tr>       
       <tr>            <?
				   $name        = text($_GET['KeyWord']);
				   
				 
				      $p=21;
					  $sqlstr = "SELECT * FROM ".product." WHERE status='true'   AND (title like '%".$name."%' OR full like '%".$name."%'  OR tomtat like '%".$name."%') ";
					  if($_GET['category']!='') $sqlstr .=" AND ".product.".category = '".intval($_GET['category'])."'";	
					   if($_GET['subCategory']!='') $sqlstr .=" AND ".product.".subCategory = '".intval($_GET['subCategory'])."'";
                      $page=mysql_query($sqlstr);
					  $n_record=mysql_num_rows($page);
					  num_page(); 
					  $link="index.php?page=resultSearch&KeyWord=".$_GET['KeyWord'].""; 
					  $view=$_GET['view']?intval($_GET['view']):1;   
					  $s=($view-1)*$p; 
					  
					  $sqlstr.=" ORDER BY postdate DESC limit $s,$p";						  
					
					  $sqlstr=mysql_query($sqlstr);	
                      if(mysql_num_rows($sqlstr)>0) {	   $i=0; 
                      while($row=mysql_fetch_array($sqlstr)) {    $i+=1;
                   ?>                               
                      
                  
                              <td     align="center" valign="top" width="33%"   >
                       
                         
						 <table width="100%" border="0" cellspacing="3" cellpadding="3" id="bosanpham">
  <tr>
  <tr>
 
    <td valign="top"  align="center" colspan="2"> <a  href="productView_<?=$row['category']?>_<?=$row['subCategory']?>_<?=$row['id']?><?=$vip?>" id="tieude"><?=$row['title']?></a> 
	  </td>
  </tr>
    <td  valign="middle" align="center"   colspan="2" height="150">
	
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
                       echo "<td style='color:#FF0000' >Xin lỗi chưa có sản phẩm nào</td> </tr> ";
                       }
                  ?>   
             
 <tr  ><td colspan="3" align="right" height="50px" ><? view_page_view($link)?></td> </tr>
 </table>  
 
 
 
 
 
 
 	<link rel="stylesheet" type="text/css" href="balloontip.css" />

<script type="text/javascript" src="balloontip.js">

/***********************************************
* Rich HTML Balloon Tooltip- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>