
<?
function num_page()  {
    global $n_record;//lay bien toan cuc
    global $p;
    if($n_record%$p==0)    {
      $n_page=$n_record/$p;
      return $n_page;
    }
    else   {
      $n_page=($n_record-($n_record%$p))/$p+1;
      return $n_page;
    }
}
function view_page($link)    {

    global $n_record,$i,$links;
	$next=$_GET['page']+1;
	$back=$_GET['page']-1;
	$page=$_GET['page'];
	if($back<=1) $back=1;
	if($next>num_page()) $next=num_page();		
	if($_GET['page']>num_page()) $page=num_page();  	
	echo '<table border="0"  align="right" cellpadding="2" cellspacing="2" ><tr>'; 	
	echo '<td bgcolor="#EEEEEE"  width=100px align=center style="border:#cccccc 1px solid"><b>Trang:</b></td>';
    for($i=1;$i<=num_page();$i++)
    {
     echo '<td bgcolor="#EEEEEE" width=20px align=center style="border:#cccccc 1px solid">';
	  echo "<a href=\"$link&page=$i\" style=".($i==$_GET['page']?'color:#FF0000;font-weight:bold':'color:#000000;font-weight:normal')."  >&nbsp;".$i."&nbsp;</a>";
	  
    echo '</td>';
		  if($i%15 == 0) echo "</tr>";
		}
	echo '</tr></table>';	
   
}

function view_page_view($link)    {

   global $n_record,$i,$links;
	$next=$_GET['view']+1;
	$back=$_GET['view']-1;
	$page=$_GET['view'];
	if($back<=1) $back=1;
	if($next>num_page()) $next=num_page();		
	if($_GET['view']>num_page()) $page=num_page(); 
	
	echo '<table border="0"  align="right" cellpadding="2" cellspacing="2" ><tr>'; 	
	echo '<td bgcolor="#EEEEEE"  width=100px align=center style="border:#cccccc 1px solid">';
	echo " Page ("; echo $_GET['view']== ''?1:$_GET['view'];
	echo '/'.num_page().') ';
	echo "</td>";
	echo '<td bgcolor="#EEEEEE" width=40px align=center style="border:#cccccc 1px solid">';
	 echo "<a href=\"$link\" style=".($i==$_GET['view']?'color:#FF0000;text-decoration:none':'color:#000000;text-decoration:none')."  >&nbsp;"."First"."&nbsp;</a></td>";
	
	

	
	   if($_GET['view']>5) {
	   echo '<td width=15px>...</td>';
	   }
	
    for($i=1;$i<=num_page();$i++)
    {
	
	   if($i < $_GET['view']+5 && $i > $_GET['view']-5) {
	  
	  echo '<td bgcolor="#EEEEEE" width=10px align=center style="border:#cccccc 1px solid">';
      echo "<a href=\"$link&view=$i\" style=".($i==$_GET['view']?'color:#FF0000;text-decoration:none':'color:#000000;text-decoration:none')."  >&nbsp;".$i."&nbsp;</a>";
	   echo '</td>';
		 
		
		}
		}
		if(num_page()>=5) echo '<td width=15px>...</td>';
		$k=$i-1;
		echo '<td bgcolor="#EEEEEE"  width=40px align=center style="border:#cccccc 1px solid">';
	 echo "<a href=\"$link&view=$k\" style=".($i==$_GET['view']?'color:#FF0000;text-decoration:none':'color:#000000;text-decoration:none')."  >&nbsp;"."Last"."&nbsp;</a></td>";
		 
	echo '</tr></table>';		  
    }
	
	
		function view_page_view2($link)    {

   global $n_record,$i,$links;
	$next=$_GET['view']+1;
	$back=$_GET['view']-1;
	$page=$_GET['view'];
	if($back<=1) $back=1;
	if($next>num_page()) $next=num_page();		
	if($_GET['view']>num_page()) $page=num_page(); 
	
	echo '<table border="0"  align="right" cellpadding="2" cellspacing="2" ><tr>'; 	
	echo '<td bgcolor="#EEEEEE"  width=100px align=center style="border:#cccccc 1px solid">';
	echo " Page ("; echo $_GET['view']== ''?1:$_GET['view'];
	echo '/'.num_page().') ';
	echo "</td>";
	echo '<td bgcolor="#EEEEEE" width=40px align=center style="border:#cccccc 1px solid">';
	 echo "<a href=\"$link-1.html\" style=".($i==$_GET['view']?'color:#FF0000;text-decoration:none':'color:#000000;text-decoration:none')."  >&nbsp;"."First"."&nbsp;</a></td>";
	
	

	
	   if($_GET['view']>5) {
	   echo '<td width=15px>...</td>';
	   }
	
    for($i=1;$i<=num_page();$i++)
    {
	
	   if($i < $_GET['view']+5 && $i > $_GET['view']-5) {
	  
	  echo '<td bgcolor="#EEEEEE" width=10px align=center style="border:#cccccc 1px solid">';
      echo "<a href=\"$link-$i.html\" style=".($i==$_GET['view']?'color:#FF0000;text-decoration:none':'color:#000000;text-decoration:none')."  >&nbsp;".$i."&nbsp;</a>";
	   echo '</td>';
		 
		
		}
		}
		if(num_page()>=5) echo '<td width=15px>...</td>';
		$k=$i-1;
		echo '<td bgcolor="#EEEEEE"  width=40px align=center style="border:#cccccc 1px solid">';
	 echo "<a href=\"$link-$k.html\" style=".($i==$_GET['view']?'color:#FF0000;text-decoration:none':'color:#000000;text-decoration:none')."  >&nbsp;"."Last"."&nbsp;</a></td>";
		 
	echo '</tr></table>';		  
    }
  




 ?>