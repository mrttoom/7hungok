<?php 
if(getParam("action", 'str') == "submit_form")
{
	if(isset($_FILES['imgfile']) and $_FILES['imgfile']['error']==0)
	{
		if(!check_type_file($_FILES['imgfile']['name'], array('swf', 'avi', 'mp3', 'wma')))
		{
			$error_upload = ' <font color=RED>Error Invalid Image Type</span>';
		}
		else
		{
			$imgname = DATA_PATH.'upload/media/'.time().'_'.$_FILES["imgfile"]["name"];
			if(copy($_FILES["imgfile"]["tmp_name"], $imgname))
			{
				$target = getParam('target', 'str', 'src');
				echo '
					<script>
						window.opener.document.getElementById("file").value="/'.$imgname.'";
						window.close();
					</script>';
				exit();
			}
			else
			{
				$error_upload = "Cannot Upload File";
			}
		}
	}
}
?>
<form method="post" enctype="multipart/form-data">
<table>
	<tr>
		<td><strong>File: </strong></td>
	  	<td><input type="file" name="imgfile" size="10" /></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $error_upload;?></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="submit" name="submit"></td>
	</tr>
</table>
<input type="hidden" name="action" value="submit_form" />
</form>