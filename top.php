<? if(!defined("hdc")) exit ();?>
<style type="text/css">

.style10 {
	color: #FFFFFF;
	font-weight: bold;
}

</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>
   <td width="20">&nbsp;</td>
    <td width="200">  <span class="style10">&nbsp;&nbsp;<? echo format_date(); echo ", Ngày&nbsp;".date("d/m/Y",time())?></span></td>
    <td width="60">      </td>
	 <td align="right"><table  border="0" cellspacing="0" cellpadding="0">
       <tr>
           <td  id="amenutop"  align="center">  <a href="index.php" id="menutop">Trang chủ</a>   </td>
	 
	   
         <? $sqlstr=mysql_query("SELECT * FROM ".guide." 
		  ORDER BY id ASC");
		  if(mysql_num_rows($sqlstr)>0) { $k = 0;
		   
   		  while($row=mysql_fetch_array($sqlstr)) { $k +=1;
             ?> 
              <td   id="amenutop"  align="center"> <a href="intro_<?=$row['id']?><?=$vip?>" id="menutop"> <?=$row['title']?></a>                 </td>
             <? } } ?>  
  

	            <td  id="amenutop"  align="center">  <a href="contact.html" id="menutop"> Liên hệ</a>   </td>

	 
               <td>&nbsp;</td>
        </tr>
             </table>
    </td>
  </tr>
   	

</table>








