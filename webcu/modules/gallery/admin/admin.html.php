<?php
class HTML_gallery
{
	function listGallery($rows, $news_category_arr, $pagging, $start_count)
	{
	?>
		<script >
			function deleteNews()
			{	
				var nCount = countChecked();
				var value= valueChecked();
				if (nCount==0)
				{
					alert("<?php echo _NOT_CHECK;?>" );
					return;
				}
				res=confirm("<?php echo _SURE_DELETE;?>");
				if (res) 
				{
					document.location.href= "<?php echo generate_url('gallery_admin', array('task'=>'delete', 'curPg')); ?>&value="+value;
				}
			}
			function deleteNewsImage()
			{	
				var nCount = countChecked();
				var value= valueChecked();
				if (nCount==0)
				{
					alert("<?php echo _NOT_CHECK;?>" );
					return;
				}
				res=confirm("<?php echo _SURE_DELETE_IMAGE;?>");
				if (res) 
				{
					document.location.href= "<?php echo generate_url('gallery_admin', array('task'=>'delete_image', 'curPg')); ?>&value="+value;
				}
			}
			function editNews()
			{	
				var nCount = countChecked();
				var value= valueChecked();
				value = parseInt(value);
				if (nCount==0)
				{
					alert("<?php echo _NOT_CHECK;?>" );
					return;
				}
				document.location.href= "<?php echo generate_url('gallery_admin', array('task'=>'edit', 'curPg')); ?>&id="+value;
			}
			function countChecked() 
			{
				var nCount = 0;
				dml=document.FormListNews;
				len = dml.elements.length;
				var i=0;
				for( i=0 ; i<len ; i++) 
				{
					if (dml.elements[i].type=='checkbox' && dml.elements[i].checked) 
					{
					   nCount++;
					}
				}    
				return nCount;
			}
			
			function valueChecked() 
			{
				var value = "";
				var check = 0;
				dml=document.FormListNews;
				len = dml.elements.length;
				var i=0;
				for( i=0 ; i<len ; i++) 
				{
					if (dml.elements[i].type=='checkbox' && dml.elements[i].checked) 
					{
						if(!isNaN(dml.elements[i].value))
						{
						   if(check== 0){
							 value= dml.elements[i].value;
							 check= 1;
						   }else{
							 value+= ","+dml.elements[i].value;
						   }
						}
					}
				}
				return value;
			}
			function setChecked() 
			{
				dml = document.FormListNews;
				val = dml.all_check.checked;
				len = dml.elements.length;
				var i=0;
				for( i=0 ; i<len ; i++) 
				{
					if (dml.elements[i].type=='checkbox') 
					{
					   dml.elements[i].checked=val;
					}
				}    
			}
		</SCRIPT>
		<form name="FormListNews" method="post">
		<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td class="menudottedline" align="right">
						<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr align="center" valign="middle">
									<td>
										<a class="toolbar" href="<?php echo generate_url('gallery_admin', array('task'=>'add', 'curPg')); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/new.png" alt="<?php echo _NEW;?>" name="<?php echo _NEW;?>" title="<?php echo _NEW;?>" align="middle" border="0">
											<br /><?php echo _NEW;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return editNews()">
											<img src="<?php echo SITE_PATH;?>themes/images/edit.png" alt="<?php echo _EDIT;?>" name="<?php echo _EDIT;?>" title="<?php echo _EDIT;?>" align="middle" border="0">
											<br /><?php echo _EDIT;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return deleteNews()">
											<img src="<?php echo SITE_PATH;?>themes/images/delete.png" alt="<?php echo _DELETE;?>" name="<?php echo _DELETE;?>" title="<?php echo _DELETE;?>" align="middle" border="0">
											<br /><?php echo _DELETE;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return deleteNewsImage()">
											<img src="<?php echo SITE_PATH;?>themes/images/delete.png" alt="<?php echo _DELETE_IMAGE;?>" name="<?php echo _DELETE_IMAGE;?>" title="<?php echo _DELETE;?>" align="middle" border="0">
											<br /><?php echo _DELETE_IMAGE;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="<?php echo generate_url('profile'); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/cancel.png" alt="<?php echo _CANCEL;?>" name="<?php echo _CANCEL;?>" title="<?php echo _CANCEL;?>" align="middle" border="0">
											<br /><?php echo _CANCEL;?>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<br />
		<div class="centermain" align="center">
			<div class="main">
				<table class="adminheading">
					<tbody>
						<tr>
							<th><?php echo _GALLERY_ADMIN;?></th>
						</tr>
					</tbody>
				</table>
				<table class="adminlist">
					<tbody>
						<tr>
							<th class="title" width="5%"><input type="checkbox" name="all_check" onClick="setChecked()" /></th>
							<th class="title" width="5%"><?php echo _ORD;?></th>
							<th class="title" width="45"><?php echo _TITLE;?></th>							
							<th class="title" width="15%"><?php echo _IMAGE;?></th>
							<th class="title" width="10%"><?php echo _LANGUAGE;?></th>
							<th class="title" width="10%"><?php echo _CREATE;?></th>
							<th class="title" width="10%"><?php echo _UPDATE;?></th>
						</tr>
			<?php
				if($rows)
				{
					$i = $start_count;
					foreach($rows as $row)
					{
						if($i%2 == 0)
							$class_row = 'row0';
						else
							$class_row = 'row1';
						$i++;
						?>
						<tr class="<?php echo $class_row; ?>" valign="top">
							<td>
								<input type="checkbox" name="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" />
							</td>
							<td><?php echo $i; ?></td>
							<td>
								<a href="<?php echo generate_url('gallery_admin', array('task'=>'edit', 'id'=>$row['id'])); ?>"><?php echo $row['title']; ?></a>
								<br />
								<?php echo string_strip($row['brief']);?>
							</td>
							<td>
								<?php
									$image_file = get_image($row, 'small', 'gallery');
									if($image_file)
										echo '<img src="'.$image_file.'" />';
									else
										echo _NO_IMAGE;
								?>
							</td>
							<td>
								<?php echo $row['lang']; ?>
							</td>
							<td>
								<?php echo '<b>'.$row['user_create'].'</b><br />'; echo date('d/m/Y, H:i:s', $row['time_create']); ?>
							</td>
							<td>
								<?php echo '<b>'.$row['user_update'].'</b><br />'; echo date('d/m/Y, H:i:s', $row['time_update']); ?>
							</td>
						</tr>
						<?php
					}
				}
				if($pagging)
					echo '
						<tr>
							<th colspan="20" align="left">
								'.$pagging.'
							</th>
						</tr>';
			?>
					</tbody>
				</table>
			</div>
		</div>
		</form>
	<?php
	}
	function addGallery($news_category_arr, $error_array)
	{
	?>
		<form name="FormAddGallery" method="post" enctype="multipart/form-data">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormAddGallery.action.value=pressbutton;
				try
				{
					document.FormAddGallery.onsubmit();
				}
				catch(e)
				{}
				document.FormAddGallery.submit();
			}
		</script>
		<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td class="menudottedline" align="right">
						<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr align="center" valign="middle">
									<td>
										<a class="toolbar" href="javascript:submitbutton('save');">
											<img src="<?php echo SITE_PATH;?>themes/images/save.png" alt="<?php echo _SAVE;?>" name="<?php echo _SAVE;?>" title="<?php echo _SAVE;?>" align="middle" border="0">
											<br />
											<?php echo _SAVE;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="javascript:submitbutton('apply');">
											<img src="<?php echo SITE_PATH;?>themes/images/apply.png" alt="<?php echo _APPLY;?>" name="<?php echo _APPLY;?>" title="<?php echo _APPLY;?>" align="middle" border="0">
											<br /><?php echo _APPLY;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="<?php echo generate_url('gallery_admin'); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/cancel.png" alt="<?php echo _CANCEL;?>" name="<?php echo _CANCEL;?>" title="<?php echo _CANCEL;?>" align="middle" border="0">
											<br /><?php echo _CANCEL;?>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<br />
		<div class="centermain" align="center">
			<div class="main">
				<table class="adminheading">
					<tbody>
						<tr>
							<th>
								<?php echo _GALLERY_ADMIN?>: <small><?php echo _UPDATE_GALLERY;?></small>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminform">
					<tbody>
						<tr>
							<th colspan="2">
								<?php echo _UPDATE_GALLERY;?>
							</th>
						</tr>						
						<?php 
							for($i=1; $i<=5; $i++)
							{
						?>
							<tr>
								<td width="130px">
									<?php echo _TITLE;?> <?php echo $i;?>
								</td>
								<td>
									<input name="title_<?php echo $i?>" class="inputbox" style="width:500px;" value="<?php echo getParam('title_'.$i, 'str');?>" maxlength="255" type="text">
								</td>
							</tr>
							<tr>
								<td><?php echo _IMAGE;?> <?php echo $i;?></td>
								<td>
									<input name="imgfile_<?php echo $i?>" class="inputbox" type="file" size="40" />
								</td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
						<?php
							}
						?>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<input type="hidden" name="action" value="" />
		</form>
	<?php
	}
	function updateGallery($row='', $news_category_arr, $error_array)
	{
	?>
		<form name="FormAddGallery" method="post" enctype="multipart/form-data">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormAddGallery.action.value=pressbutton;
				try
				{
					document.FormAddGallery.onsubmit();
				}
				catch(e)
				{}
				document.FormAddGallery.submit();
			}
		</script>
		<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td class="menudottedline" align="right">
						<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr align="center" valign="middle">
									<td>
										<a class="toolbar" href="javascript:submitbutton('save');">
											<img src="<?php echo SITE_PATH;?>themes/images/save.png" alt="<?php echo _SAVE;?>" name="<?php echo _SAVE;?>" title="<?php echo _SAVE;?>" align="middle" border="0">
											<br />
											<?php echo _SAVE;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="javascript:submitbutton('apply');">
											<img src="<?php echo SITE_PATH;?>themes/images/apply.png" alt="<?php echo _APPLY;?>" name="<?php echo _APPLY;?>" title="<?php echo _APPLY;?>" align="middle" border="0">
											<br /><?php echo _APPLY;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="<?php echo generate_url('gallery_admin'); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/cancel.png" alt="<?php echo _CANCEL;?>" name="<?php echo _CANCEL;?>" title="<?php echo _CANCEL;?>" align="middle" border="0">
											<br /><?php echo _CANCEL;?>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<br />
		<div class="centermain" align="center">
			<div class="main">
				<table class="adminheading">
					<tbody>
						<tr>
							<th>
								<?php echo _GALLERY_ADMIN?>: <small><?php echo _UPDATE_GALLERY;?></small>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminform">
					<tbody>
						<tr>
							<th colspan="2">
								<?php echo _UPDATE_GALLERY;?>
							</th>
						</tr>						
						<tr>
							<td width="130px">
								<?php echo _TITLE; ?>
							</td>
							<td>
								<input name="title" class="inputbox" style="width:500px;" value="<?php echo getParam('title', 'str', $row['title']);?>" maxlength="255" type="text">
							</td>
						</tr>
						<tr>
							<td><?php echo _IMAGE; ?></td>
							<td>
								<input name="imgfile" class="inputbox" type="file" size="40" />&nbsp;<?php echo $error_array['imagefile']; ?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td colspan="2"><span class="require_field">(*)</span> <?php echo _REQUIRED_FILED; ?></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<input type="hidden" name="action" value="" />
		</form>
	<?php
	}
}
?>