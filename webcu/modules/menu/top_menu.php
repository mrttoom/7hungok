<script type="text/JavaScript">
<!--
function mmLoadMenus() {
  if (window.mm_menu_1226122804_0) return;
   window.mm_menu_1226122804_0 = new Menu("root",235,24,"Arial, Helvetica, sans-serif",12,"#1786CD","#ededed","#ededed","#1786CD","left","middle",3,0,1000,-5,7,true,true,true,0,true,false);
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `about_us` where `lang`= "'.$current_lang.'" ORDER BY region';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		$title = str_replace(array(' ', '-'), array('&nbsp;', '&minus;'),$one['title']);
?>	
mm_menu_1226122804_0.addMenuItem("<?php echo $title;?>","location='<?php echo generate_url('about_us', array('id'=>$one['id']));?>'");	
<?php	
		}
	}
?>			 
   mm_menu_1226122804_0.hideOnMouseOut=true;
   mm_menu_1226122804_0.bgColor='#CCCCCC';
   mm_menu_1226122804_0.menuBorder=0;
   mm_menu_1226122804_0.menuLiteBgColor='#CCCCCC';
   mm_menu_1226122804_0.menuBorderBgColor='#CCCCCC';

  window.mm_menu_1226123417_0 = new Menu("root",235,24,"Arial, Helvetica, sans-serif",12,"#1786CD","#ededed","#ededed","#1786CD","left","middle",3,0,1000,-5,7,true,true,true,0,true,false);
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `product_category` where `parent`=0 and `lang`= "'.$current_lang.'" ORDER BY region';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		$title = str_replace(array(' ', '-'), array('&nbsp;', '&minus;'),$one['title']);
		$product_link = generate_url('product_category', array('idc'=>$one['id']));
?>	
mm_menu_1226123417_0.addMenuItem("<?php echo $title;?>","location='<?php echo $product_link;?>'");	
<?php	
		}
	}
?>	 
 
   mm_menu_1226123417_0.hideOnMouseOut=true;
   mm_menu_1226123417_0.bgColor='#CCCCCC';
   mm_menu_1226123417_0.menuBorder=0;
   mm_menu_1226123417_0.menuLiteBgColor='#CCCCCC';
   mm_menu_1226123417_0.menuBorderBgColor='#CCCCCC';

  window.mm_menu_1226123532_0 = new Menu("root",235,24,"Arial, Helvetica, sans-serif",12,"#1786CD","#ededed","#ededed","#1786CD","left","middle",3,0,1000,-5,7,true,true,true,0,true,false);
  
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `news_category` where `lang`= "'.$current_lang.'" ORDER BY region';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		$title = str_replace(array(' ', '-'), array('&nbsp;', '&minus;'),$one['title']);
		$project_link = generate_url('news', array('category_id'=>$one['id']));
?>	
mm_menu_1226123532_0.addMenuItem("<?php echo $title;?>","location='<?php echo $project_link;?>'");	
<?php	
		}
	}
?>					  
  
  
   mm_menu_1226123532_0.hideOnMouseOut=true;
   mm_menu_1226123532_0.bgColor='#CCCCCC';
   mm_menu_1226123532_0.menuBorder=0;
   mm_menu_1226123532_0.menuLiteBgColor='#CCCCCC';
   mm_menu_1226123532_0.menuBorderBgColor='#CCCCCC';
  
	window.mm_menu_channel_distribute = new Menu("root",235,24,"Arial, Helvetica, sans-serif",12,"#1786CD","#ededed","#ededed","#1786CD","left","middle",3,0,1000,-5,7,true,true,true,0,true,false);
  
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `channel_distribute_category` where `lang`= "'.$current_lang.'" ORDER BY region';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		$title = str_replace(array(' ', '-'), array('&nbsp;', '&minus;'),$one['title']);
		$channel_distribute_link = generate_url('channel_distribute', array('category_id'=>$one['id']));
?>	
mm_menu_channel_distribute.addMenuItem("<?php echo $title;?>","location='<?php echo $channel_distribute_link;?>'");	
<?php	
		}
	}
?>					  
  
   mm_menu_channel_distribute.hideOnMouseOut=true;
   mm_menu_channel_distribute.bgColor='#CCCCCC';
   mm_menu_channel_distribute.menuBorder=0;
   mm_menu_channel_distribute.menuLiteBgColor='#CCCCCC';
   mm_menu_channel_distribute.menuBorderBgColor='#CCCCCC';  
  
	window.mm_menu_internal_company = new Menu("root",235,24,"Arial, Helvetica, sans-serif",12,"#1786CD","#ededed","#ededed","#1786CD","left","middle",3,0,1000,-5,7,true,true,true,0,true,false);
  
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `internal_company_category` where `lang`= "'.$current_lang.'" ORDER BY region';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		$title = str_replace(array(' ', '-'), array('&nbsp;', '&minus;'),$one['title']);
		$channel_distribute_link = generate_url('internal_company', array('category_id'=>$one['id']));
?>	
mm_menu_internal_company.addMenuItem("<?php echo $title;?>","location='<?php echo $channel_distribute_link;?>'");	
<?php	
		}
	}
?>					  
	mm_menu_internal_company.addMenuItem("<?php echo _GALLERY;?>","location='<?php echo generate_url('gallery') ?>'");  
   mm_menu_internal_company.hideOnMouseOut=true;
   mm_menu_internal_company.bgColor='#CCCCCC';
   mm_menu_internal_company.menuBorder=0;
   mm_menu_internal_company.menuLiteBgColor='#CCCCCC';
   mm_menu_internal_company.menuBorderBgColor='#CCCCCC';  
   
   	window.mm_menu_economic_relations = new Menu("root",235,24,"Arial, Helvetica, sans-serif",12,"#1786CD","#ededed","#ededed","#1786CD","left","middle",3,0,1000,-5,7,true,true,true,0,true,false);
  
<?php
	global $database;
	global $current_lang;
	$query = 'SELECT * FROM `economic_relations_category` where `lang`= "'.$current_lang.'" ORDER BY region';
	$database->setQuery($query);
	$rows = $database->loadResult();
	if($rows)
	{		
		foreach($rows as $one)
		{
		$title = str_replace(array(' ', '-'), array('&nbsp;', '&minus;'),$one['title']);
		$channel_distribute_link = generate_url('economic_relations', array('category_id'=>$one['id']));
?>	
mm_menu_economic_relations.addMenuItem("<?php echo $title;?>","location='<?php echo $channel_distribute_link;?>'");	
<?php	
		}
	}
?>					  
   mm_menu_economic_relations.hideOnMouseOut=true;
   mm_menu_economic_relations.bgColor='#CCCCCC';
   mm_menu_economic_relations.menuBorder=0;
   mm_menu_economic_relations.menuLiteBgColor='#CCCCCC';
   mm_menu_economic_relations.menuBorderBgColor='#CCCCCC';   
 
mm_menu_1226122804_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript" src="<?php echo SITE_PATH;?>themes/mm_menu.js"></script>
<script language="JavaScript1.2">mmLoadMenus();</script>






<div class="mn_top1"><img src="<?php echo SITE_PATH;?>themes/images/bn-top-img-l.jpg" /></div>
<div class="mn_top1"><div class="mn_top1_text"><a href="<?php echo generate_url('home') ?>"><?php echo _HOME?></a></div>
</div>


<div class="mn_top1"><img src="<?php echo SITE_PATH;?>themes/images/bn-top-img-l.jpg" /></div>
<div class="mn_top1"><div class="mn_top1_text"><a href="<?php echo generate_url('about_us') ?>" name="link2" id="link1" onMouseOver="MM_showMenu(window.mm_menu_1226122804_0,0,21,null,'link2')" onMouseOut="MM_startTimeout();"><?php echo _ABOUT_US ?></a></div>
</div>

<div class="mn_top1"><img src="<?php echo SITE_PATH;?>themes/images/bn-top-line.jpg" /></div>
<div class="mn_top1"><div class="mn_top1_text"><a href="<?php echo generate_url('product') ?>" name="link3" id="link3" onMouseOver="MM_showMenu(window.mm_menu_1226123417_0,0,21,null,'link3')" onMouseOut="MM_startTimeout();"><?php echo _PRODUCT ?></a></div>
</div>

<div class="mn_top1"><img src="<?php echo SITE_PATH;?>themes/images/bn-top-line.jpg" /></div>
<div class="mn_top1"><div class="mn_top1_text"><a href="<?php echo generate_url('news') ?>" name="link4" id="link4" onMouseOver="MM_showMenu(window.mm_menu_1226123532_0,0,21,null,'link4')" onMouseOut="MM_startTimeout();"><?php echo _NEWS ?></a></div>
</div>


<div class="mn_top1"><img src="<?php echo SITE_PATH;?>themes/images/bn-top-img-l.jpg" /></div>
<div class="mn_top1"><div class="mn_top1_text"><a href="<?php echo generate_url('contact') ?>"><?php echo _CONTACT_US?></a></div>
</div>       
        
