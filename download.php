<? if(!defined("edocom")) exit ();?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<table width="98%" border="1" cellspacing="0" cellpadding="0">
  <tr  bgcolor="#336699" height="25">
    <td width="7%"  id="titleProductView"><div align="center" class="style1">TT</div></td>
    <td width="57%" id="titleProductView"><div align="center" class="style1">Tên </div></td>
    <td width="18%"  id="titleProductView"><div align="center" class="style1">Ngày cập nhật </div></td>
    <td width="18%"  id="titleProductView"><div align="center" class="style1">Download</div></td>
  </tr>
<?	
 $p=50;				     
	$sqlstr = "SELECT * FROM ".download."  WHERE status='true' ";				  
		 
		$page=mysql_query($sqlstr);
		  $n_record=mysql_num_rows($page);
		  num_page(); 
		  $link="index.php?page=".$_GET['page']."&service_name=".urlencode($_GET['service_name'])."&viewParent=".$_GET['viewParent'].""; 
		  $view=$_GET['view']?intval($_GET['view']):1;   
		  $s=($view-1)*$p; 
			 $sqlstr .=" ORDER BY id DESC limit $s,$p";		
	$sqlstr=mysql_query($sqlstr);	
    if(mysql_num_rows($sqlstr)>0) {	    $a=0;
					  
    while($row=mysql_fetch_array($sqlstr)) {     $a= $a+1;
?>  
 
  <tr height="30">
    <td align="center"><?=$a?></td>
    <td align="left"  id="NewsContent"><?=$row['title']?></td>
    <td align="center"><?=date("d/m/Y",$row['postdate'])?></td>
     <? if($row['loai']=="true") {?> <td align="center"> <a href="<?=$row['link']?>" id="MoreNews">Download</a></td>
	 <? } else {?>
	 
	 <td align="center"> <a href="images/news/<?=$row['picture']?>" id="MoreNews">Download</a></td>
	 <? }?>   

  </tr>
 
 
 
 
 
  
<? } }?>   

</table>



