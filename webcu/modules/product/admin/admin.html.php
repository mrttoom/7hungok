<?php
class HTML_product
{
	function listProduct($rows, $product_category_arr, $pagging, $start_count)
	{
	?>
		<script >
			function deleteProduct()
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
					document.location.href= "<?php echo generate_url('product_admin', array('task'=>'delete', 'curPg')); ?>&value="+value;
				}
			}
			function deleteProductImage()
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
					document.location.href= "<?php echo generate_url('product_admin', array('task'=>'delete_image', 'curPg')); ?>&value="+value;
				}
			}
			function editProduct()
			{	
				var nCount = countChecked();
				var value= valueChecked();
				value = parseInt(value);
				if (nCount==0)
				{
					alert("<?php echo _NOT_CHECK;?>" );
					return;
				}
				document.location.href= "<?php echo generate_url('product_admin', array('task'=>'edit', 'curPg')); ?>&id="+value;
			}
			function countChecked() 
			{
				var nCount = 0;
				dml=document.FormListProduct;
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
				dml=document.FormListProduct;
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
				dml = document.FormListProduct;
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
		<form name="FormListProduct" method="post">
		<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td class="menudottedline" align="right">
						<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr align="center" valign="middle">
									<td>
										<a class="toolbar" href="<?php echo generate_url('product_admin', array('task'=>'add', 'curPg')); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/new.png" alt="<?php echo _NEW;?>" name="<?php echo _NEW;?>" title="<?php echo _NEW;?>" align="middle" border="0">
											<br /><?php echo _NEW;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return editProduct()">
											<img src="<?php echo SITE_PATH;?>themes/images/edit.png" alt="<?php echo _EDIT;?>" name="<?php echo _EDIT;?>" title="<?php echo _EDIT;?>" align="middle" border="0">
											<br /><?php echo _EDIT;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return deleteProduct()">
											<img src="<?php echo SITE_PATH;?>themes/images/delete.png" alt="<?php echo _DELETE;?>" name="<?php echo _DELETE;?>" title="<?php echo _DELETE;?>" align="middle" border="0">
											<br /><?php echo _DELETE;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return deleteProductImage()">
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
							<th><?php echo _PRODUCT_ADMIN;?></th>
						</tr>
					</tbody>
				</table>
				<table class="adminlist">
					<tbody>
						<tr>
							<th class="title" width="5%"><input type="checkbox" name="all_check" onClick="setChecked()" /></th>
							<th class="title" width="5%"><?php echo _ORD;?></th>
							<th class="title" width="25"><?php echo _TITLE.' / '._BRIEF;?></th>
							<th class="title" width="20%">
								<?php echo _PRODUCT_CATEGORY;?>: <select name="category_id" onchange="this.form.submit()"><?php echo get_option($product_category_arr, getParam('category_id', 'int', 0)); ?></select>
							</th>
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
								<a href="<?php echo generate_url('product_admin', array('task'=>'edit', 'id'=>$row['id'])); ?>"><?php echo $row['title']; ?></a>
								<br />
								<?php echo string_strip($row['brief']);?>
							</td>
							<td><?php echo string_strip($row['category_name']);?></td>
							<td>
								<?php
									$image_file = get_image($row, 'small', 'product');
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
	function updateProduct($row='', $product_category_arr, $error_array)
	{
	?>
		<form name="FormAddProduct" method="post" enctype="multipart/form-data">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormAddProduct.action.value=pressbutton;
				try
				{
					document.FormAddProduct.onsubmit();
				}
				catch(e)
				{}
				document.FormAddProduct.submit();
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
										<a class="toolbar" href="<?php echo generate_url('product_admin'); ?>">
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
								<?php echo _PRODUCT_ADMIN;?>: <small><?php echo _UPDATE_PRODUCT;?></small>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminform">
					<tbody>
						<tr>
							<th colspan="2">
								<?php echo _UPDATE_PRODUCT;?>							</th>
						</tr>
						<tr>
							<td>
								<?php echo _PRODUCT_CATEGORY;?>							</td>
							<td>	
								<select name="category_id">
									<?php 
										echo get_option($product_category_arr, getParam('category_id', 'int', $row['category_id']));
									?>
								</select>							</td>
						</tr>                        
						<tr>
							<td width="130"><?php echo _NAME;?><span class="require_field">(*)</span></td>
<td>
								<input name="title" class="inputbox" style="width:500px;" value="<?php echo getParam('title', 'str', $row['title']);?>" maxlength="255" type="text">	&nbsp;<?php echo $error_array['title']; ?>						</td>
						</tr>
						<tr>
							<td>
								<?php echo _BRIEF;?>							</td>
							<td>
                            	<?php 
									printEditor(); 
									getEditor('brief', getParam('brief', 'def', string_strip($row['brief'])), 600, 200);
								?></td>
					  </tr>
						<tr>
							<td>
								<?php echo _READ_MORE;?>							</td>
							<td>
								<?php 
									printEditor(); 
									getEditor('content', getParam('content', 'def', string_strip($row['content'])), 800, 300);
								?>							</td>
						</tr>
						<tr>
							<td><?php echo _IMAGE; ?></td>
							<td>
								<input name="imgfile" class="inputbox" type="file" size="40" />&nbsp;<?php echo $error_array['imagefile']; ?>							</td>
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