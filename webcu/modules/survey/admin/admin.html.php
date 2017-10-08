<?php
class HTML_survey
{
	function listSurvey($rows, $survey_option)
	{
	?>
		<script >
			function deleteSurvey()
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
					document.location.href= "<?php echo generate_url('survey_admin', array('task'=>'delete', 'curPg')); ?>&value="+value;
				}
			}
			function editSurvey()
			{	
				var nCount = countChecked();
				var value= valueChecked();
				value = parseInt(value);
				if (nCount==0)
				{
					alert("<?php echo _NOT_CHECK;?>" );
					return;
				}
				document.location.href= "<?php echo generate_url('survey_admin', array('task'=>'edit', 'curPg')); ?>&id="+value;
			}
			function countChecked() 
			{
				var nCount = 0;
				dml=document.FormListSurvey;
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
				dml=document.FormListSurvey;
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
				dml = document.FormListSurvey;
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
		<form name="FormListSurvey" method="post">
		<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody>
				<tr>
					<td class="menudottedline" align="right">
						<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
							<tbody>
								<tr align="center" valign="middle">
									<td>
										<a class="toolbar" href="<?php echo generate_url('survey_admin', array('task'=>'add', 'curPg')); ?>">
											<img src="<?php echo SITE_PATH;?>themes/images/new.png" alt="<?php echo _NEW;?>" name="<?php echo _NEW;?>" title="<?php echo _NEW;?>" align="middle" border="0">
											<br /><?php echo _NEW;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return editSurvey()">
											<img src="<?php echo SITE_PATH;?>themes/images/edit.png" alt="<?php echo _EDIT;?>" name="<?php echo _EDIT;?>" title="<?php echo _EDIT;?>" align="middle" border="0">
											<br /><?php echo _EDIT;?>
										</a>
									</td>
									<td>&nbsp;</td>
									<td>
										<a class="toolbar" href="#" onclick="return deleteSurvey()">
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
							<th><?php echo _SURVEY_ADMIN;?></th>
						</tr>
					</tbody>
				</table>
				<table class="adminlist">
					<tbody>
						<tr>
							<th class="title" width="5%"><input type="checkbox" name="all_check" onClick="setChecked()" /></th>
							<th class="title" width="5%"><?php echo _ORD;?></th>
							<th class="title" width="30%"><?php echo _QUESTION;?></th>
							<th class="title" width="10%"><?php echo _LANGUAGE;?></th>
							<th class="title" width="10%"><?php echo _QUESTION_TYPE;?></th>
							<th class="title" width="30%"><?php echo _ANSWER;?></th>
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
						if($row['type']==1)
							$type_question = _ONE_SELECT;
						else
							$type_question = _MULTI_SELECT;
						
						if($row['status']==1)
							$status = _PUBLISH;
						else
							$status = _UN_PUBLISH;
						$i++;
						?>
						<tr class="<?php echo $class_row; ?>" valign="top">
							<td>
								<input type="checkbox" name="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" />
							</td>
							<td><?php echo $i; ?></td>
							<td>
								<a href="<?php echo generate_url('survey_admin', array('task'=>'edit', 'id'=>$row['id'])); ?>"><?php echo $row['title']; ?></a>
							</td>
							<td><?php echo $row['lang']; ?></td>
							<td><?php echo $type_question;?></td>
							<td><?php echo $survey_option[$row['id']]; ?></td>
							<td><?php echo $status;?></td>
						</tr>
						<?php
					}
				}
			?>
					</tbody>
				</table>
			</div>
		</div>
		<input type="hidden" name="action" value="" />
		</form>
	<?php
	}
	function updateSurvey($row='', $error_array='', $answer='')
	{
	?>
		<form name="FormAddSurvey" method="post">
		<script>
			function submitbutton(pressbutton)
			{
				document.FormAddSurvey.action.value=pressbutton;
				try
				{
					document.FormAddSurvey.onsubmit();
				}
				catch(e)
				{}
				document.FormAddSurvey.submit();
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
										<a class="toolbar" href="<?php echo generate_url('survey_admin'); ?>">
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
								<?php echo _SURVEY_ADMIN;?>: <small><?php echo _UPDATE_SURVEY;?></small>
							</th>
						</tr>
					</tbody>
				</table>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="50%" valign="top">
							<table class="adminform">
								<tbody>
									<tr>
										<th width="50%">
											<?php echo _UPDATE_SURVEY;?>
										</th>
										<th>
											<?php echo _ANSWER;?>
										</th>
									</tr>
									<tr>
										<td width="50%" valign="top">
											<table width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<td width="130px">
														<?php echo _QUESTION;?> <span class="require_field">(*)</span>
													</td>
													<td>
														<input name="title" class="inputbox" size="45" value="<?php echo getParam('title', 'str', $row['title']);?>" maxlength="255" type="text">&nbsp;<?php echo $error_array['title']; ?>
													</td>
												</tr>
												<tr>
													<td>
														<?php echo _QUESTION_TYPE;?>
													</td>
													<td colspan="2">	
														<select name="type">
															<?php
																$type_arr = array(1=>_ONE_SELECT, 2=>_MULTI_SELECT);
																echo get_option($type_arr, getParam('type', 'int', $row['type'])); 
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td>
														<?php echo _PUBLISH;?>
													</td>
													<td colspan="2">	
														<select name="status">
															<?php
																$status_arr = array(1=>_PUBLISH, 2=>_UN_PUBLISH);
																echo get_option($status_arr, getParam('status', 'int', $row['status'])); 
															?>
														</select>
													</td>
												</tr>
												<tr>
													<td>&nbsp;</td>
													<td colspan="2"><span class="require_field">(*)</span> <?php echo _REQUIRED_FILED; ?></td>
												</tr>
												<tr>
													<td colspan="3">&nbsp;</td>
												</tr>
											</table>
										</td>
										<td valign="top">
											<table width="100%" cellpadding="0" cellspacing="0">
												<?php
													if($answer)
													{
														foreach($answer as $one_a)
														{
												?>
															<tr>
																<td>
																	<input name="answer_<?php echo $one_a['id'];?>" value="<?php echo getParam('answer_'.$one_a['id'], 'str', $one_a['name']);?>" class="inputbox" size="40" />
																</td>
															</tr>
												<?php
														}
													}
													for($i=0; $i<6; $i++)
													{
												?>
														<tr>
															<td>
																<input name="answer1_<?php echo $i;?>" value="<?php echo getParam('answer_'.$i, 'str');?>" class="inputbox" size="40" />
															</td>
														</tr>
												<?php
													}
												?>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<input type="hidden" name="action" value="" />
		</form>
	<?php
	}
}
?>