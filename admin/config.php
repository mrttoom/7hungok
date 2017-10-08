<?

function format_date()
  {
    $str_1=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	 $str_2=array("Chủ nhật","Thứ hai","Thư ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bẩy");
	$str=str_replace($str_1,$str_2,date("l",time()));
	return $str;
  }
/*
function formatdate()
  {
    $str_1=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	 $str_2=array("Chủ nhật","Thứ hai","Thư ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bẩy");
	$str=str_replace($str_1,$str_2,date("l",time()));
	return $str;
  }
*/
function createImage(){
// Delete Old File
		if (is_file($_SESSION['stringcode']."gif")) @unlink($_SESSION['old_file_code']."gif");
		
// Creates the images, writes the file       
	   $fileRand = $_REQUEST["PHPSESSID"];
       $string_a = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","p","q","r","s","t","u","v","w","x","y","x","0","1","2","3","4","5","6","7","8","9");
       $keys = array_rand($string_a,6);
       foreach($keys as $n=>$v)
	    {
           $string .= $string_a[$v];
         }
		session_register("stringcode");
		$_SESSION['stringcode'] = $string;		
		//$backgroundimage = "security/bg_im.gif";
		//$im=imagecreatefromgif($backgroundimage);
		//$colour = imagecolorallocate($im, rand(0,0), rand(0,0), rand(0,0));
		//$font = 'security/arial.ttf';
		//$angle = rand(0,0);
// Add the text
		//imagefttext(
		//imagettftext($im, 11, $angle,14, 17, $colour, $font, $string);
		//$outfile= "security/$fileRand.gif";
		//imagegif($im,$outfile);
		return $string;
}


function NumRow($field,$table,$clause) {
    return  mysql_num_rows(mysql_query("SELECT $field FROM $table WHERE $clause"))  ;

}  
function order($m,$j,$k) {   

		for($i=$m;$i<$j;$i++)  {
		  
		 echo "<option value=".$i." ".($i==$k?'Selected':'').">".$i."</option>";
		 }	
 }
 /*Category news*/
function CategoryNews($id,$table)  {

	   $sqlstr=mysql_query("SELECT * FROM ".$table." WHERE status=true ORDER BY stt ASC");
	   if(mysql_num_rows($sqlstr)>0)   {
	   while($row=mysql_fetch_array($sqlstr))	    { 
		
		echo  "<option value=".$row['id']." ".($row['id']==$id?'Selected':'').">".$row['category']."</option>";		
		    $sqlsub=mysql_query("SELECT * FROM ".$table." WHERE parent='".$row['id']."'");
			 if(mysql_num_rows($sqlsub)>0)   {			
			 while($rowsub=mysql_fetch_array($sqlsub)) {
			 
			   echo  "<option value=".$rowsub['id']." ".($rowsub['id']==$id?'Selected':'').">&nbsp;&nbsp;&nbsp;&nbsp;".$rowsub['category']."</option>";
			}
		 }
		}
	 }
}
 /*Parent Category*/
function CategoryParent($id,$table)  {

	   $sqlstr=mysql_query("SELECT * FROM ".$table." WHERE status=true AND parent='0' ORDER BY stt ASC");
	   if(mysql_num_rows($sqlstr)>0)   {
	   while($row=mysql_fetch_array($sqlstr))	    { 
		
		echo  "<option value=".$row['id']." ".($row['id']==$id?'Selected':'').">".$row['category']."</option>";		
		}
	 }
}
 /*Category*/
function Category($id,$k,$table)  {
  
   if($k !='') {
   
	   $sqlstr=mysql_query("SELECT * FROM ".$table." WHERE status = true AND parent = '".intval($k)."' ORDER BY stt ASC");
	   if(mysql_num_rows($sqlstr)>0)   {
	   while($row=mysql_fetch_array($sqlstr))	    { 
		
		echo  "<option value=".$row['id']." ".($row['id']==$id?'Selected':'').">".$row['category']."</option>";		
		}
	 }
  }	 
}
/*Upload picture*/

function uploads($file='picture',$folder = '../images/')
{
  global $picture;
   $picture = time()."_".$_FILES[$file]['name'];	
           
			if($_FILES[$file]["size"] < 2000000)  {
		
			if(@copy($_FILES[$file]['tmp_name'],$folder.$picture))	{
			
			   $check=@getimagesize($folder.$picture);
			
		         if($check[0]!='') {	
				 
				    return $picture;
				 }	
				 			
				 else {	
					  @unlink($folder.$picture);
					  echo "<script>alert('Ảnh không đúng định dạng hoặc dung lượng');location.href='".$_SERVER['HTTP_REFERER']."'</script>";
					  
	            }			
	        }
			else {
			return $picture='';
			}
	  
	  
	  }
			else {
			 echo "<script>alert('Ảnh không đúng định dạng hoặc dung lượng');location.href='".$_SERVER['HTTP_REFERER']."'</script>";
			}
	  
}

/*Upload picture*/
function uploadsb($file='picture',$folder = '../images/')
{
 global $picture;
            $picture = time()."_".$_FILES[$file]['name'];	  
		
			if(@copy($_FILES[$file]['tmp_name'],$folder.$picture))	{
			
			   $check=@getimagesize($folder.$picture);
			return $picture;
		         	
	        }
			else {
			return $picture='';
			}
	  
}


function text(&$string) {	
    $string = trim($string);
	$string = str_replace("\\'","'",$string);
	$string = str_replace("'","''",$string);
	$string = str_replace('\"',"&quot;",$string);
	$string = str_replace("<", "&lt;", $string);
	$string = str_replace(">", "&gt;", $string);
	return $string;
}
function textContent($string) {   
	
	return $string;
}












?>