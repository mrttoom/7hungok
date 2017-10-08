<Meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
include "define_data.php";
include "config.php";
include "connect.php";

?>

<select name="SubCategory" id="inputRegister" >
    <option value="">---Chọn tất cả---</option>    
<?
$sqlstr = mysql_query("SELECT * FROM ".menu_product2." WHERE parent='".intval($_GET['subID'])."'");

if(mysql_num_rows($sqlstr)>0) {
  while($row = mysql_fetch_array($sqlstr)) {
   echo "<option value=".$row['id']."  ".($row['id']==$_POST['SubCategory']?'Selected':'').">".$row['category']."</option>";
  }
}
?>
</select>
