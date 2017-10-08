<?php
class HTML_quick_link
{
	function listQuickLink($rows, $pagging, $start_count)
	{
	?>
		<script >
			function deleteQuickLink()
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
					document.location.href= "<?php echo generate_url('quick_link_admin', array('task'=>'delete', 'curPg')); ?>&value="+value;
				}
			}
			function editQuickLink()
			{	
				var nCount = countChecked();
				var value= valueChecked();
				value = parseInt(value);
				if (nCount==0)
				{
					alert("<?php echo _NOT_CHECK;?>" );
					return;
				}
				document.location.href= "<?php echo generate_url('quick_link_admin', array('task'=>'edit', 'curPg')); ?>&id="+value;
			}
			function countChecked() 
			{
				var nCount = 0;
				dml=document.FormListQuickLink;
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
				dml=document.FormListQuickLink;
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
				dml = document.FormListQuickLink;
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
				document.FormListQuickLink.action.value=pressbutton;
				try
				{
					document.FormListQuickLink.onsubmit();
				}
				catch(e)
				{}
				document.FormListQuickLink.submit();
			}
		</SCRIPT>
		<form name="FormListQuickLink" method="post">
		<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td class="menudottedline" align="right">
						<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr align="center" valign="middle">
									<td>
										<a class="toolbar" href="<?php echo generate_url('quick_link_admin', array('task'=>'add', 'curPg')); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/new.png" alt="<?php echo _NEW;?>" name="<?php echo _NEW;?>" title="<?php echo _NEW;?>" align="middle" border="0">
											<br /><?php echo _NEW;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return editQuickLink()">
											<img src="<?php echo SITE_PATH;?>themes/images/edit.png" alt="<?php echo _EDIT;?>" name="<?php echo _EDIT;?>" title="<?php echo _EDIT;?>" align="middle" border="0">
											<br /><?php echo _EDIT;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return deleteQuickLink()">
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
							<th class="quick_link">
								<?php echo _QUICK_LINK_ADMIN;?>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminlist">
					<tbody>
						<tr>
							<th class="title" width="5%"><input type="checkbox" name="all_check" onClick="setChecked()" /></th>
							<th class="title" width="5%"><?php echo _ORD;?></th>
							<th class="title" width="30%"><?php echo _TITLE;?></th>
							<th class="title" width="40%"><?php echo _PATH;?></th>
							<th class="title" width="10%"><?php echo _LANGUAGE;?></th>
							<th class="title" width="10%"><?php echo _REGION;?> <a href="javascript:submitbutton('save_order')"><img src="<?php echo SITE_PATH;?>themes/images/filesave.png" alt="<?php echo _SAVE; ?>" title="<?php echo _SAVE; ?>" border="0" height="16" width="16"></a></th>
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
						?>
						<tr class="<?php echo $class_row; ?>" valign="top">
							<td>
								<input type="checkbox" name="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" />
							</td>
							<td><?php echo $i; ?></td>
							<td>
								<a href="<?php echo generate_url('quick_link_admin', array('task'=>'edit', 'id'=>$row['id'])); ?>"><?php echo string_strip($row['title']); ?></a>
							</td>
							<td>
								<?php echo string_strip($row['link']); ?>
							</td>
							<td>
								<?php echo string_strip($row['lang']); ?>
							</td>
							<td>
								<input name="region_<?php echo $row['id']; ?>" class="inputbox" size="6" value="<?php echo getParam('region_'.$row['id'], 'str', $row['region']);?>" maxlength="50" type="text">
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
		<input type="hidden" name="action" value="" />
		</form>
	<?php
	}
	function updateQuickLink($row='', $error_array)
	{
	?>
		<form name="FormAddQuickLink" method="post">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormAddQuickLink.action.value=pressbutton;
				try
				{
					document.FormAddQuickLink.onsubmit();
				}
				catch(e)
				{}
				document.FormAddQuickLink.submit();
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
										<a class="toolbar" href="<?php echo generate_url('quick_link_admin'); ?>">
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
							<th class="quick_link">
								<?php echo _QUICK_LINK_ADMIN;?>: <small><?php echo _UPDATE_QUICK_LINK;?></small>
							</th>
						</tr>
					</tbody>
				</table>
				<table class="adminform">
					<tbody>
						<tr>
							<th colspan="2">
								<?php echo _UPDATE_QUICK_LINK;?>
							</th>
						</tr>
						<tr>
							<td width="130px">
								<?php echo _TITLE;?> <span class="require_field">(*)</span>
							</td>
							<td>
								<input name="title" class="inputbox" size="60" value="<?php echo getParam('title', 'str', $row['title']);?>" type="text">&nbsp;<?php echo $error_array['title']; ?>
							</td>
						</tr>
						<tr>
							<td width="130px">
								<?php echo _PATH;?> <span class="require_field">(*)</span>
							</td>
							<td>
								<input name="link" class="inputbox" size="60" value="<?php echo getParam('link', 'str', $row['link']);?>" type="text">&nbsp;<?php echo $error_array['link']; ?>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo _REGION;?>
							</td>
							<td>
								<input class="inputbox" name="region" size="10" value="<?php echo getParam('region', 'int', $row['region']);?>" type="region">
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