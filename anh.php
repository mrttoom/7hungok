<? if(!defined("hdc")) exit ();?>

     <title>Album,<?=$tde?></title> 
<meta name="keywords" content="Album , <?=$key?> " />
  <meta name="description" content="Album , <?=$mota?>" />



<table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" id="bochinh" >
  
 <tr  id="asanpham"><td  colspan="4"><span id="sanpham">Album</span></td>   </tr>
  
  
  
     <tr >
 
 <?
          $sqlstr=mysql_query("SELECT * FROM ".menu_anh." WHERE status='true' 
		  AND parent='0' ORDER BY stt ASC");
		  if(mysql_num_rows($sqlstr)>0) { $i = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $i +=1;
  ?> 
                     <td     align="center" valign="top" width="25%"   >
                       
                         
								<table width="100%" border="0" align="center" cellspacing="2" cellpadding="2" >
  
  <tr align="center"    valign="middle" >
    <td  height="110"> 
	
	  <table  border="0" cellspacing="3" cellpadding="3" width="5" >
            <tr>
             <td id="bosanpham" width="2%"><a  href="album_<?=$row['id']?><?=$vip?>" id="tieude"><img src="images/anh/thumbs/<?=$row['picture']?>"  border="0" alt="<?=$row['category']?>" title="<?=$row['category']?>" /></a></td>
                </tr>
           </table>
  </td>
	 </tr>   
  <tr >
   <td  height="20"  align="center"  valign="top" >
       <a  href="album_<?=$row['id']?><?=$vip?>" id="tieude"><?=$row['category']?></a>        </td>
    
 
 
</table>

                                                       
									                    
								</td>
                                               
                       <? if($i%4==0) echo "</tr>";?>         	   
                       <?	} }		   ?>   
				  
		   
             
  
			  
         
</table>


