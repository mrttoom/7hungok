<? if(!defined("hdc")) exit ();?>
<table width="985" border="0" cellspacing="0" cellpadding="0" align="center"  >
   
   <tr >
       <td   style="background-image:url(images1/bt.png); background-repeat: no-repeat"  id="noidung">
	   
       <?
          $sqlstr=mysql_query("SELECT * FROM ".bottom."");
		  if(mysql_num_rows($sqlstr)>0) {
		   
		   while($row=mysql_fetch_array($sqlstr)) {
		   
		  echo $row['full_intro'];   
		   
		   }
		  }
   ?>
       </td>
    </tr>
</table>
