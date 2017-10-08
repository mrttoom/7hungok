<? if(!defined("hdc")) exit ();?>

 
  
  <table width="99%" border="0" cellspacing="0" cellpadding="0" align="center"  id="bochinh">
  
   <tr>
   <td id="asanpham" colspan="3" ><span id="sanpham">
   
   
    <?
         if($_GET['viewParent2']!='')   $sqlstr=mysql_query("SELECT * FROM ".menu_product2." WHERE status='true' 
		  AND id='".$_GET['viewParent2']."'  ");
		  
		  if(mysql_num_rows($sqlstr)>0) { $k = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $k +=1;
  ?> 
  
 <?=$row['category']?>
  <? $tda= $row['category']?> 
 
 
 
  <? } } ?> 
  
   <?  if($_GET['viewSub2']!='')
          $sqlstr=mysql_query("SELECT * FROM ".menu_product2." WHERE status='true' 
		  AND id='".$_GET['viewSub2']."'  ");
		  if(mysql_num_rows($sqlstr)>0) { $k = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $k +=1;
  ?> 
  
 > <?=$row['category']?> 
   <? $tdb= $row['category']?> 

 <? } } ?> 
 
  
   </span></td>
  </tr>
   

  
<?
  $p=20;				 
					  if($_GET['viewParent2']!='')  $sqlstr = "SELECT *	FROM ".product2." WHERE status='true' AND category = '".intval($_GET['viewParent2'])."' ";
					  if($_GET['viewSub2']!='') $sqlstr = "SELECT *	FROM ".product2." WHERE status='true' AND subCategory = '".intval($_GET['viewSub2'])."' ";
					  
		 
		  $page=mysql_query($sqlstr);
		  $n_record=mysql_num_rows($page);
		  num_page(); 
		   $link="service_".$_GET['viewParent2']."_".$_GET['viewSub2'].""; 
		
		  $view=$_GET['view']?intval($_GET['view']):1;   
		  $s=($view-1)*$p; 
		  $sqlstr .=" ORDER BY postdate DESC limit $s,$p";
		  $sqlstr=mysql_query($sqlstr);	
		  ?>
   <?  					  
            if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
					  
            while($row=mysql_fetch_array($sqlstr)) {      $i+=1;
           ?>
                 <tr>  <td    align="left"   valign="top">
                      <table  width="100%"border="0" cellspacing="0" cellpadding="0" align="left"  >
     
	  <tr>
       <td    id="ttat">
								
								 <? if($row['picture']) {?>
                               <a  href="serviceView_<?=$row['category']?>_<?=$row['subCategory']?>_<?=$row['id']?><?=$vip?>" id="TextLeftCenter4m" > <img src="images/product/thumbs/<?=$row['picture']?>"  width="100" border="0" align="left" title="<?=$row['title']?>" alt="<?=$row['title']?>"  /></a>		               <? } ?>     
								<a  href="serviceView_<?=$row['category']?>_<?=$row['subCategory']?>_<?=$row['id']?><?=$vip?>" id="tieude" title="<?=$row['title']?>"><?=$row['title']?></a>  <br />
								 <?=$row['tomtat']?>
								
      </tr>
     
       <tr>
       <td   id="ake" >	 <a  href="serviceView_<?=$row['category']?>_<?=$row['subCategory']?>_<?=$row['id']?><?=$vip?>" id="gia"> <p style="margin: 1px" align="right">Chi tiết &raquo;</p></a>
								 </td>
      </tr>
	  
    </table>
					       
						     </td>
                         	   </tr>
                    
        <?	} }					 
                      else {
                       echo "<td style='color:#FF0000'  id='ttat'  >Chưa có tin n� o</td> </tr> ";
                       }
                  ?>   
             
                  <tr  ><td colspan="2" align="right" ><? view_page_view2($link)?></td> </tr>  
			  
         
</table>

     <title> <?=$tda?> , <?=$tdb ?> ,<?=$tde?>, trang  <?=$_GET['view']?></title> 
<meta name="keywords" content="<?=$tda?> , <?=$tdb ?> , <?=$key?> , trang  <?=$_GET['view']?>" />
  <meta name="description" content="<?=$tda?> , <?=$tdb ?> , <?=$mota?> , trang  <?=$_GET['view']?>" />








































































































































































































