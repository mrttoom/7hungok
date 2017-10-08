<? include "check.php";
include_once("fckeditor/fckeditor.php") ;

?>
<br />
<?  

			
			  			
		 if($_POST['UpdateIntro']) { 		
				mysql_query("UPDATE ".bottom." SET full_intro='".textContent($_POST['full_intro'])."'");
				
				echo "Cập nhật thành công";
		}	  
	 
?>
<?
  $sqlstr=mysql_query("SELECT * FROM ".bottom."");
  if(mysql_num_rows($sqlstr)>0)   {
		   
		$row=mysql_fetch_array($sqlstr);
	
?>
<form action="" method="post" enctype="multipart/form-data">  

	<table width="750"  border="0" cellspacing="2" cellpadding="2"  align="center"  style="border:#cccccc 1px solid">

	 <tr   ><td  colspan="2" id="tieude"  >&nbsp;&nbsp;&nbsp;<span id="TextLeftCenter2m">Cập nhật Bottom </span> </td>  </tr>
  
  <tr>
    <td colspan="2" align="center" >
	
<?php
$oFCKeditor = new FCKeditor('full_intro') ;
$oFCKeditor->BasePath = 'fckeditor/' ;
$oFCKeditor->Value = $row['full_intro'] ;

$oFCKeditor->Create() ;
?>	</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>	  
	  <input type="hidden" name="id" value="<?=$row['id']?>" />
      <input name="UpdateIntro" type="submit"  value="Cập nhật" />
    
    </td>
  </tr>
 
</table>
 </form>
<? }?>


