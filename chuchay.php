<? if(!defined("hdc")) exit ();?>
<style type="text/css">

.style12 {
	color: #000000;
	font-weight: bold;
	font-size: 12px;
}

</style>

<marquee   direction="left"   scrollamount="3" onmouseover="this.stop()" onmouseout="this.start()">
   
<span class="style12">
       <?
          $sqlstr=mysql_query("SELECT * FROM ".intro." where id ='2'");
		  if(mysql_num_rows($sqlstr)>0) {
		   
		   while($row=mysql_fetch_array($sqlstr)) {
		   
		   echo $row['full_intro'];
		   
		   }
		  }
   ?>
</span>
</marquee>