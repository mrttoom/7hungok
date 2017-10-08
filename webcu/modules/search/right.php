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
	<form name="FormAddNews"  class="bg_search1_form" action="<?php echo generate_url('search'); ?>" method="get" onsubmit="return check_search();">

		<input type = 'hidden' name = 'module' value = 'search'>		
		<input type="text" name="keyword" alt="<?php echo _SEARCH; ?>"  value="<?php echo _SEARCH; ?>..."  onblur="if(this.value=='') this.value='<?php echo _SEARCH; ?>...';" onfocus="if(this.value=='<?php echo _SEARCH; ?>...') this.value='';"  />
	</form>
