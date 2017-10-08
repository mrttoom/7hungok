<script type="text/javascript" language="javascript" src="<?php echo SITE_PATH;?>themes/him.js"></script>

	<script>
			function submitbutton(pressbutton)
			{
				document.FormAddNews.action.value=pressbutton;
				try
				{
					document.FormAddNews.onsubmit();
				}
				catch(e)
				{}
				document.FormAddNews.submit();
			}
			
			function check_search()
				{
					if(document.check_search.keyword.value=='')
					{
						alert('Nhập từ khóa tìm kiếm!');
						document.check_search.keyword.focus();
						return false;
					}					
				
					return true;
				}	
		</script>
	<form name="FormAddNews" action="<?php echo generate_url('search'); ?>" method="get" onsubmit="return check_search();">
	
		<input type = 'hidden' name = 'module' value = 'search'>		
			<div style="float:right; padding-top:15px; padding-right:5px;">
				<a href="javascript:submitbutton('search');"><img src="<?php echo SITE_PATH;?>themes/images/search.gif" /></a>
			</div>
			<div style="float:right; padding-top:15px; padding-right:5px;">
				<input type="text" name="keyword" style="width:150px; height:20px; background:#FFFFD2;" alt="<?php echo _SEARCH; ?>"  value="<?php echo _SEARCH; ?>..."  onblur="if(this.value=='') this.value='<?php echo _SEARCH; ?>...';" onfocus="if(this.value=='<?php echo _SEARCH; ?>...') this.value='';"  />
			</div>   		
	</form>
