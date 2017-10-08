	
	<? if(!defined("hdc")) exit ();?>

	
	 <div style="font-size: 1px; height: 2px;"></div>
<table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td id="amdtrai" align="center"><span id="mdtrai">SẢN PHẨM</span></td>
              </tr>
			  </table>


<table width="200" border="0" cellspacing="0" cellpadding="0" align="center"  id="bomenu"  >
              
  <?
          $sqlstr=mysql_query("SELECT * FROM ".menu_product." WHERE status='true' 
		  AND parent='0' ORDER BY stt ASC");
		  if(mysql_num_rows($sqlstr)>0) { $k = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $k +=1;
  ?> 
              <tr >
                <td  width="20"  align="right">
           <img src="images1/cham.gif"  align="absmiddle"/>
                </td>
				 <td  width="180" id="amenutrai">
             <a href="product_<?=$row['id']?><?=$vip?>"  id="menutrai"> <?=$row['category']?></a>
                </td>
              </tr>
			 
				<? if($_GET['viewParent']!="") {
                   
                    $sqlstrSub=mysql_query("SELECT * FROM ".menu_product." WHERE status='true' 
                 AND parent='".intval($_GET['viewParent'])."'  AND parent='".$row['id']."' ORDER BY stt ASC");
                    if(mysql_num_rows($sqlstrSub)>0) {
                           
                    while($rowSub=mysql_fetch_array($sqlstrSub)) {
                ?> 
                  <tr >
				  <td  >&nbsp;</td>
                    <td  id="amenutrai2" >
                  <a href="product_<?=$row['id']?>_<?=$rowSub['id']?><?=$vip?>"  id="menutrai2" >-&nbsp;<?=$rowSub['category']?></a>             
                    </td>
                  </tr>
                <? } }  } ?>                   
      <? } } ?>   
	     
			            
</table>






	 <div style="font-size: 1px; height: 10px;"></div>
<table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td id="amdtrai" align="center"><span id="mdtrai">TIN TỨC</span></td>
              </tr>
			  </table>

<table width="200" border="0" cellspacing="0" cellpadding="0" align="center"  id="bomenu">
              
  <?
          $sqlstr=mysql_query("SELECT * FROM ".menu_product2." WHERE status='true' 
		  AND parent='0' ORDER BY stt ASC");
		  if(mysql_num_rows($sqlstr)>0) { $k = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $k +=1;
  ?> 
               <tr >
                <td  width="20"  align="right">
           <img src="images1/cham.gif"  align="absmiddle"/>
                </td>
				 <td  width="180" id="amenutrai">
             <a href="service_<?=$row['id']?><?=$vip?>"  id="menutrai"> <?=$row['category']?></a>
                </td>
              </tr>
			 
				<?
                    if($_GET['viewParent2']!="") {
                    $sqlstrSub=mysql_query("SELECT * FROM ".menu_product2." WHERE status='true' 
                    AND parent='".intval($_GET['viewParent2'])."' AND parent='".$row['id']."' ORDER BY stt ASC");
                    if(mysql_num_rows($sqlstrSub)>0) {
                           
                    while($rowSub=mysql_fetch_array($sqlstrSub)) {
                ?> 
                  <tr >
				  <td  >&nbsp;</td>
                    <td  id="amenutrai2" >
                 <a href="service_<?=$row['id']?>_<?=$rowSub['id']?><?=$vip?>"  id="menutrai2" >- &nbsp;<?=$rowSub['category']?></a>             
                    </td>
                  </tr>
                <? } }  }  ?>                   
      <? } } ?>   
	     
			            
</table>
	 <div style="font-size: 1px; height: 10px;"></div>

 	
			 <table width="200" border="0" cellspacing="0" cellpadding="0" align="center"  >
		 <tr>
                <td id="amdtrai" align="center"><span id="mdtrai" >HỖ TRỢ TRỰC TUYẾN</span></td>
              </tr>	 
			  </table>
			  <table width="200" border="0" cellspacing="0" cellpadding="0" align="center"  id="bomd">
 
        <?
          $sqlstr=mysql_query("SELECT * FROM ".support." WHERE status='true'   ORDER BY stt ASC");
		  if(mysql_num_rows($sqlstr)>0) {
		   

		  while($row=mysql_fetch_array($sqlstr)) {
		  ?>         
              <? if($row['kind'] !='2') {  ?> 
			  <tr>
                <td height="25"  align="center" ><b><?=$row['fullname']?></b>                
                </td>
              </tr>
             
			 
			        
			   <tr>
                <td align="center"  > 
				         
                <a href="ymsgr:sendim?<?=$row['nick']?>">
                <img src="http://opi.yahoo.com/online?u=<?=$row['nick']?>&amp;m=g&amp;t=2&amp;l=us" border="0"></a>
				
                </td>
              </tr>
			  <? }  else    {?>
			  <tr>
                <td height="25" align="center" ><b><?=$row['fullname']?></b>                
                </td>
              </tr>
			   <tr>
                <td   align="center" > 
				         
               <a href="skype:<?=$row['nick']?>?chat">
                <img src="images1/skypecall.gif" border="0"></a>
				
                </td>
              </tr>
			  
			   <? }?> 
			  
          <? } }?>     
		 
             <tr>
                <td   align="center" height="5" > 
			
				
                </td>
              </tr>
            </table>
	 <div style="font-size: 1px; height: 7px;"></div>
				 


		
		 			<table width="200" border="0" cellspacing="3" cellpadding="3" align="center"  id="bomd"  >			  <tr>
				<td>
				<select name="category" onchange="window.open(this.options[this.selectedIndex].value,'_blank');this.options[0].selected=true"  style="width:178px"  >
				<option value="">Liên kết website </option> 
			
<?	

 $p=7;				     
	$sqlstr = "SELECT * FROM ".website."  ";				  
		 
		
			 $sqlstr .=" ORDER BY id DESC ";		
	$sqlstr=mysql_query($sqlstr);	
    if(mysql_num_rows($sqlstr)>0) {	    
					  
    while($row=mysql_fetch_array($sqlstr)) {     
?>  

<option value="http://<?=$row['website']?>" ><?=$row['title']?> </option> <? } }?>
				
			 
				</select> 
				</td>
			  </tr>
	
</table>

	 <div style="font-size: 1px; height: 7px;"></div>
			
			<table width="200" border="0" cellspacing="0" cellpadding="0" align="center"   >
                
				 <tr>
                <td id="amdtrai2" align="center"><span id="mdtrai2" >QU&#7842;NG C&#193;O</span></td>
              </tr>	  
             <tr><td><img src="QC.jpg" width="198" height="288" /></td></tr>
         </table> 
		 			<table width="200" border="0" cellspacing="0" cellpadding="0" align="center"  id="bomd"  >
  
					  <?
                      $sqlstr=mysql_query("SELECT * FROM ".ads." WHERE status='true' AND alignment='1' ORDER BY stt DESC");
                      if(mysql_num_rows($sqlstr)>0) {
                       
                      while($row=mysql_fetch_array($sqlstr)) {
          	 $ext = substr($row['picture'],-3,3);
					  ?>   
					  <? if($ext=='swf') { ?>          
					  <tr >
						<td height="23"  align="center" >
						
						<? $width=getimagesize("images/ads/".$row['picture']);	?>
						<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="200" height="<?=number_format($width[1]*200/$width[0],0)?>">
            <param name="movie" value=" images/ads/<?=$row['picture']?>">
            <param name="quality" value="high">
            <embed src="  images/ads/<?=$row['picture']?> " quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="200" height="<?=number_format($width[1]*200/$width[0],0)?>"></embed>
          </object> 
						
						</td>
					  </tr>
					   <? } else { ?> 
					   
					    <tr >
						<td height="23"  align="center" >
						<a href="<?=$row['link']?>"  target="_blank"> <img src="images/ads/<?=$row['picture']?>"  border="0" width="198"/></a>
						</td>
					  </tr>
					   
					   
					   <? } ?>   
					 <? } }?>  
				  	
					                     
        </table>
<br />

	