<? if(!defined("hdc")) exit ();?>

     <title> <?=$tde?></title> 
<meta name="keywords" content=" <?=$key?> " />
  <meta name="description" content="<?=$mota?> " />

  <? include "center1.php";?>
  
  

<table width="99%" border="0" align="center" cellpadding="2" cellspacing="2" id="bochinh" >
  
   <tr>
   <td colspan="4" id="asanpham"><span id="sanpham">&nbsp;&nbsp;  
   SẢN PHẨM NỔI BẬT
 </span></td>
  </tr>
  
     

<?
  $p=6;				 
				
$sqltenloaisp="select h.category,h.id from hdc_menu_product h where h.status='true' ORDER by h.stt";
$sqltenloaisp=mysql_query($sqltenloaisp);


//	  $sqlstr = "SELECT *	FROM ".product." WHERE status='true' AND special = 'true' ";
					
//		  $sqlstr .=" ORDER BY postdate DESC limit $p";
//		  $sqlstr=mysql_query($sqlstr);	
	     if(mysql_num_rows($sqltenloaisp)>0) {	   
            while($rows=mysql_fetch_array($sqltenloaisp)) 

           {      
		   $tennhomsp=$rows[0];
		   $idcategory=$rows[1];
		   
           echo"       <tr >    <td id=\"aasanpham\" colspan=3 > &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$tennhomsp."</td> </tr>";
		   ?>

		   <tr>
		   
		   <?
		   					  $sqlstr = "SELECT *	FROM ".product." p,hdc_menu_product m WHERE p.status='true' AND p.special = 'true' and m.id=p.category and m.category='".$tennhomsp."'";

					
		  $sqlstr .=" ORDER BY postdate DESC limit $p";
		  $sqlstr=mysql_query($sqlstr);	
	     if(mysql_num_rows($sqlstr)>0) {	     $i=0; 
            while($row=mysql_fetch_array($sqlstr)) 
			{      $i+=1;
$cate_product=$row[2];
           ?>
                       <td     align="center" valign="top" width="33%"  id="bosanpham" >
                       
                         
						 <table width="100%" border="0" cellspacing="3" cellpadding="3" >
  <tr>
  <tr>
 
    <td valign="top"  align="center" colspan="2" height="40"> <a  href="productView_<?=$row[2]?>_<?=$row[11]?>_<?=$row[0]?><?=$vip?>" id="tieude"><?=$row['1']?></a> 
	  </td>
  </tr>

    <td  valign="middle" align="center"   colspan="2" height="160">
	
	

<div class="list_product">
<div>
	<div>
		<div>

<a   class="tooltip" href="productView_<?=$row[2]?>_<?=$row[11]?>_<?=$row[0]?><?=$vip?>" >
			<img src="images/product/thumbs/<?=$row[3]?>"  border="0"  alt="<?=$row['1']?>" title="<?=$row['1']?>"  / ></a>


</div>
	</div>
	<pre class="hidden"><div>
		<img src="images/product/goc/<?=$row[13]?>" width="350" /></div>
</pre>
</div>
<script type="text/javascript">strTooltipProductOb= (typeof(strTooltipProductOb) == "undefined" ? ".list_product pre," : strTooltipProductOb + ".list_product pre,");</script>
<script type="text/javascript">
$(function(){ tooltipReview(); });</script>
<script type="text/javascript">
$(window).load(function()
{ initLoaded(); });

</script></div>


</td>


 </tr>
 
   <tr>
 
    <td  valign="bottom"  align="center"  colspan="2">        <strong>Giá: </strong> <span id="gia"><? if($row['4']) {?>  <?=number_format($row['4']*$explode[0],0,",",".")?> <?=$explode[1]?> <? } else {?>Call <? }?>  </span>                                              
	  </td>
  </tr>
    <tr>
  <td valign="top"  align="center"> <a  href="productView_<?=$row[2]?>_<?=$row[11]?>_<?=$row['0']?><?=$vip?>" id="tieude"><img src="images1/chitiet.gif" border="0" /></a> 
	  </td>
    <td valign="top"  align="center"> <a  href="index.php?page=shoppingCart&action=add&viewParent=<?=$_GET['viewParent']?>&id=<?=$row['0']?>" id="tieude"><img src="images1/mua.gif" border="0" /></a> 
	  </td>
  </tr>
  
 
</table>
	
									                    
	   </td>
	   
					   
					     	   
	   
					     	
					     	   
                    
                       <? if($i%3==0) echo "</tr>";?>         	   
                       <?	}
					   }					 
                      else {
                       echo "<td style='color:#FF0000' colspan=3 id='bosanpham' >Ch&#432;a c&#243; s&#7843;n ph&#7849;m n&#224;o trong m&#7909;c n&#224;y.</td> </tr> ";
                       }
					   
					   }
					   }
                  ?>   
</table>


  
