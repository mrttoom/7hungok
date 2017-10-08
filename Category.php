<Meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include "admin/define_data.php";
include "admin/config.php";
include "admin/connect.php";

?>


<select name="subCategory" style="width:165" >
    <option value="">---Chọn tất cả---</option>    
<?
$sqlstr = mysql_query("SELECT * FROM ".menu_product." WHERE parent='".intval($_GET['subID'])."'");

if(mysql_num_rows($sqlstr)>0) {
  while($row = mysql_fetch_array($sqlstr)) {
   echo "<option value=".$row['id']."  ".($row['id']==$_POST['SubCategory']?'Selected':'').">".$row['category']."</option>";
  }
}
?>
</select>
