<?php
class HTML_product_category
{
	function listProductCategory($rows)
	{
		global $letter_and;
        $letter_and = '&';
	?>
		<script >
			function deleteProductCategory()
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
					document.location.href= "<?php echo generate_url('product_category_admin', array('task'=>'delete', 'curPg')); echo $letter_and;?>value="+value;
				}
			}
			function editProductCategory()
			{	
				var nCount = countChecked();
				var value= valueChecked();
				value = parseInt(value);
				if (nCount==0)
				{
					alert("<?php echo _NOT_CHECK;?>" );
					return;
				}
				document.location.href= "<?php echo generate_url('product_category_admin', array('task'=>'edit', 'curPg')); echo $letter_and;?>id="+value;
			}
			function countChecked() 
			{
				var nCount = 0;
				dml=document.FormListProductCategory;
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
				dml=document.FormListProductCategory;
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
				dml = document.FormListProductCategory;
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
			function submitbutton(pressbutton)
			{
				document.FormListProductCategory.action.value=pressbutton;
				try
				{
					document.FormListProductCategory.onsubmit();
				}
				catch(e)
				{}
				document.FormListProductCategory.submit();
			}
		</SCRIPT>
		<form name="FormListProductCategory" method="post">
		<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td class="menudottedline" align="right">
						<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr align="center" valign="middle">
									<td>
										<a class="toolbar" href="<?php echo generate_url('product_category_admin', array('task'=>'add', 'curPg')); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/new.png" alt="<?php echo _NEW;?>" name="<?php echo _NEW;?>" title="<?php echo _NEW;?>" align="middle" border="0">
											<br /><?php echo _NEW;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return editProductCategory()">
											<img src="<?php echo SITE_PATH;?>themes/images/edit.png" alt="<?php echo _EDIT;?>" name="<?php echo _EDIT;?>" title="<?php echo _EDIT;?>" align="middle" border="0">
											<br /><?php echo _EDIT;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return deleteProductCategory()">
											<img src="<?php echo SITE_PATH;?>themes/images/delete.png" alt="<?php echo _DELETE;?>" name="<?php echo _DELETE;?>" title="<?php echo _DELETE;?>" align="middle" border="0">
											<br /><?php echo _DELETE;?>
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
							<th>
								<?php echo _PRODUCT_CATEGORY_ADMIN;?>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminlist">
					<tbody>
						<tr>
							<th class="title" width="5%"><input type="checkbox" name="all_check" onClick="setChecked()" /></th>
							<th class="title" width="5%"><?php echo _ORD;?></th>
							<th class="title" width="20%"><?php echo _TITLE;?></th>
							<th class="title" width="15%"><?php echo _IMAGE;?></th>
							<th class="title" width="20%">
								<?php echo _REGION; ?>&nbsp;<a href="javascript:submitbutton('save_order')"><img src="<?php echo SITE_PATH;?>themes/images/filesave.png" alt="<?php echo _SAVE; ?>" title="<?php echo _SAVE; ?>" border="0" height="16" width="16"></a>
							</th>
							<th class="title" width="10%"><?php echo _PUBLISH;?></th>
						</tr>
			<?php
				if($rows)
				{
					$i = 0;
					foreach($rows as $row)
					{
						if($i%2 == 0)
							$class_row = 'row0';
						else
							$class_row = 'row1';
						$i++;
						if($row['level']==1)
						{
							$tab = '';
							$region_tab = '';
						}
						elseif($row['level']==2)
						{
							$tab = '- - ';
							$region_tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else
						{
							$tab = '- - - - - ';
							$region_tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						if($row['state']==1)
							$status = _PUBLISH;
						else
							$status = _UN_PUBLISH;
						?>
						<tr class="<?php echo $class_row; ?>" valign="top">
							<td>
								<input type="checkbox" name="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" />
							</td>
							<td><?php echo $i; ?></td>
							<td>
								<?php echo $tab;?> <a href="<?php echo generate_url('product_category_admin', array('task'=>'edit', 'id'=>$row['id'])); ?>"><?php echo string_strip($row['title']); ?></a>
							</td>
							<td>
								<?php
									$image_file = get_image($row, 'small', 'product_category');
									if($image_file)
										echo '<img src="'.$image_file.'" />';
									else
										echo _NO_IMAGE;
								?>
							</td>
							<td><?php echo $region_tab;?><input name="region_<?php echo $row['id']; ?>" class="inputbox" size="6" value="<?php echo getParam('region_'.$row['id'], 'str', $row['region']);?>" maxlength="50" type="text"></td>
							<td><?php echo $status;?></td>
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
		<input type="hidden" name="action" value="" />
		</form>
	<?php
	}
	function updateProductCategory($row='', $product_category_arr, $error_array)
	{
	?>
		<form name="FormAddProductCategory" method="post"  enctype="multipart/form-data">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormAddProductCategory.action.value=pressbutton;
				try
				{
					document.FormAddProductCategory.onsubmit();
				}
				catch(e)
				{}
				document.FormAddProductCategory.submit();
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
										<a class="toolbar" href="<?php echo generate_url('product_category_admin'); ?>">
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
								<?php echo _PRODUCT_CATEGORY;?>: <small><?php echo _UPDATE_PRODUCT;?></small>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminform">
					<tbody>
						<tr>
							<th colspan="2">
								<?php echo _UPDATE_PRODUCT;?>
							</th>
						</tr>
						<tr>
							<td width="130px">
								<?php echo _TITLE;?> <span class="require_field">(*)</span>
							</td>
							<td>
								<input name="title" class="inputbox" size="60" value="<?php echo getParam('title', 'str', $row['title']);?>" maxlength="255" type="text">&nbsp;<?php echo $error_array['title']; ?>
							</td>
						</tr>
						<tr>
							<td><?php echo _PARENT_CATEGORY;?></td>
							<td colspan="2">
								<select name="parent">
									<?php
										echo get_option($product_category_arr, getParam('parent', 'int', $row['parent'])); 
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td><?php echo _IMAGE; ?></td>
							<td>
								<input name="imgfile" class="inputbox" type="file" size="40" />&nbsp;<?php echo $error_array['imagefile']; ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _PUBLISH;?>
							</td>
							<td colspan="2">	
								<select name="state">
									<?php
										$status_arr = array(1=>_PUBLISH, 2=>_UN_PUBLISH);
										echo get_option($status_arr, getParam('state', 'int', $row['state'])); 
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _REGION;?>
							</td>
							<td>
								<input name="region" class="inputbox" style="width:50px;" value="<?php echo getParam('region', 'str', $row['region']);?>" type="text">
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><span class="require_field">(*)</span> <?php echo _REQUIRED_FILED; ?></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
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