<? if(!defined("hdc")) exit ();?>
     <title>Album,<?=$tde?></title> 
<meta name="keywords" content="Album , <?=$key?> " />
  <meta name="description" content="Album , <?=$mota?>" />


<script type="text/javascript" src="slide/js/prototype.js"></script>
<script type="text/javascript" src="slide/js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="slide/js/lightbox.js"></script>
<link rel="stylesheet" href="slide/css/lightbox.css" type="text/css" media="screen" />




<? if($_GET['viewSub']=='') {?>

 <?
          $sqlstr=mysql_query("SELECT * FROM ".menu_anh." WHERE status='true' 
		  AND parent='".$_GET['viewParent']."' ORDER BY stt ASC");
		  if(mysql_num_rows($sqlstr)>0) { $b = 0; ?>
		  
	<table width="99%" border="0" align="center" cellpadding="2" cellspacing="2" id="bochinh">
     <tr >
	  
		   
   		 <?  while($row=mysql_fetch_array($sqlstr)) { $b +=1;
  ?> 
                     <td     align="center" valign="top" width="25%"   >
                       
								<table width="100%" border="0" align="center" cellspacing="2" cellpadding="2" >
  
  <tr align="center"    valign="middle" >
    <td  height="110"> 
	
	  <table  border="0" cellspacing="3" cellpadding="3" width="5" >
            <tr>
             <td id="bosanpham" width="2%"><a  href="album_<?=$_GET['viewParent']?>_<?=$row['id']?><?=$vip?>" id="tieude"><img src="images/anh/thumbs/<?=$row['picture']?>"  border="0" alt="<?=$row['title']?>" title="<?=$row['title']?>" /></a></td>
                </tr>
           </table>
  </td>
	 </tr>   
  <tr >
   <td  height="20"  align="center"  valign="top" >
       <a  href="album_<?=$row['id']?><?=$vip?>" id="tieude"><?=$row['category']?></a>        </td>
    
 
 
</table>

                                                       
									                    
								</td>
                                               
                       <? if($b%4==0) echo "</tr>";?>         	   
                        <?	}    ?>   
					</table>
	
						  <?	} 	    ?>  
				  
         


 <?	}  ?>   








<? if($b=='') {?>
<table width="99%" border="0" align="center" cellpadding="2" cellspacing="2" id="bochinh" >
<tr id="asanpham">
   <td  colspan="4" ><span id="sanpham">
   <?
          $sqlstr=mysql_query("SELECT * FROM ".menu_anh." WHERE status='true' 
		  AND id='".intval($_GET['viewParent'])."'  ");
		  if(mysql_num_rows($sqlstr)>0) { $k = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $k +=1;
  ?> 
  
  <a href="album_<?=$row['id']?><?=$vip?>"  id="tieude"><?=$row['category']?></a> <? } } ?>   
  <?
          $sqlstr=mysql_query("SELECT * FROM ".menu_anh." WHERE status='true' 
		  AND id='".$_GET['viewSub']."'  ");
		  if(mysql_num_rows($sqlstr)>0) { $k = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $k +=1;
  ?> 
  
  > <a href="album_<?=$row['parent']?>_<?=$row['id']?><?=$vip?>"  id="tieude"> <?=$row['category']?> > </a>
  
   <? $tda =$row['category']?> 
  <? } } ?> 
 
  </span>
   </td>
  </tr>

 
  <tr >
<?
  $p=60;				 
					  if($_GET['viewParent']!='')  $sqlstr = "SELECT *	FROM ".anh." WHERE status='true' AND category = '".intval($_GET['viewParent'])."' ";
					  if($_GET['viewSub']!='') $sqlstr = "SELECT *	FROM ".anh." WHERE status='true' AND subCategory = '".intval($_GET['viewSub'])."' ";
					  	 
		 
		  $page=mysql_query($sqlstr);
		  $n_record=mysql_num_rows($page);
		  num_page(); 
		  $link="album_".$_GET['viewParent']."_".$_GET['viewSub'].""; 
		  $view=$_GET['view']?intval($_GET['view']):1;   
		  $s=($view-1)*$p; 
		  $sqlstr .=" ORDER BY stt ASC limit $s,$p";
		  $sqlstr=mysql_query($sqlstr);	
		  ?>
 
  <?  					  
            if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
					  
            while($row=mysql_fetch_array($sqlstr)) {      $i+=1;
           ?>
                   <td     align="center" valign="top" width="25%"  >
                       
                         
								<table width="100%" border="0" align="center" cellspacing="2" cellpadding="2"  >
  
  <tr align="center"  valign="top" >
    <td  height="100" valign="middle" > 
	
	
	
	  <table  border="0" cellspacing="3" cellpadding="3" width="5" >
            <tr>
             <td id="bosanpham" width="2%"><a href="images/anh/goc/<?=$row['picture2']?>" rel="lightbox[roadtrip]"><img src="images/anh/thumbs/<?=$row['picture']?>"  border="0"  alt="<?=$tda?> , <?=$row['title']?>" title="<?=$tda?> , <?=$row['title']?>" /></a></td>
                </tr>
           </table>
	
								  
   </td>
								 
 </tr>   
 
</table>
					</td>
                                               
                       <? if($i%4==0) echo "</tr>";?>         	   
                       <?	} }					 
                      else {
                       echo "<td style='color:#FF0000' >Xin lỗi chưa có ảnh nào</td> </tr> ";
                       }
                  ?>   
				  
		    </tr>
             
  <tr  ><td colspan="4" align="right" ><? view_page_view2($link)?></td> </tr>  
			  
         
</table>

 <?	}  ?>   
