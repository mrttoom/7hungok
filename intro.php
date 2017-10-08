<? if(!defined("hdc")) exit ();?>


<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center"  id="bochinh" >
    
       <?
          $sqlstr=mysql_query("SELECT * FROM ".guide."  WHERE  id='".intval($_GET['id'])."' limit 1");
		  if(mysql_num_rows($sqlstr)>0) {
		   
		   while($row=mysql_fetch_array($sqlstr)) {  ?>
		    
   <title><?=$row['title']?> , <?=$tde?> </title> 
<meta name="keywords" content=" <?=$row['title']?> , <?=$key?>" />
  <meta name="description" content="<?=$row['title']?> , <?=$mota?>" />

		  		   
		   <tr  id="asanpham" ><td >
		   
		   <span id="sanpham"><?=$row['title']?></span></td>   </tr>
   <tr >
       <td  id="noidung">
		   
		    <?=$row['full']?> 
		   </td>
		   
    </tr> 
		  <?  }  } ?>
         <tr >
       <td  height="200">&nbsp;
		   
		 
		   </td>
		   
    </tr> 

</table>