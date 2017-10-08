<?php
	if(!is_login())
		replace_location('sign_in');
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td class="menubackgr" width="700px;">
				<script>
					_menuCloseDelay=400           // The time delay for menus to remain visible on mouse out
					_menuOpenDelay=100            // The time delay before menus open on mouse over
					_followSpeed=5                // Follow scrolling speed
					_followRate=50                // Follow scrolling Rate
					_subOffsetTop=0               // Sub menu top offset
					_subOffsetLeft=0            // Sub menu left offset
					_scrollAmount=3               // Only needed for Netscape 4.x
					_scrollDelay=20               // Only needed for Netcsape 4.x
					
					with(menuStyle=new mm_style()){
					onbgcolor="#F1E8E6";
					offbgcolor="#F1F3F5";
					offcolor = "#000000";
					oncolor = "#00689F";
					borderwidth=0;
					padding = 6;
					fontsize = "12";
					fontstyle = "normal;";
					fontweight = "bold";
					fontfamily="Arial, Helvetica, sans-serif";
					}
					
					with(DMStyle=new mm_style()){
					offbgcolor = "#F1F3F5";
					offcolor = "#333333";
					onbgcolor = "#F1E8E6";
					//onbgcolor = "#FBFCFD";
					oncolor = "#00689F";
					bordercolor = "#CCCCCC";
					borderstyle = "solid";
					borderwidth = 1
					separatorcolor = "#CCCCCC";
					separatorsize = 1;
					padding = 4;
					fontsize = "12";
					fontstyle = "normal";
					fontweight = "normal";
					fontfamily = "Arial, Helvetica, sans-serif";
					subimage="<?php echo SITE_PATH;?>themes/images/arrow_nav.gif";
					subimagepadding=3;
					}
				   	with(milonic=new menuname("persional")){
					borderwidth = 1;
					itemwidth=150;
					style = DMStyle;
					aI("text=<?php echo _PROFILE;?>;url=<?php echo generate_url('profile');?>;");
					aI("text=<?php echo _CHANGE_PASS;?>;url=<?php echo generate_url('profile', array('task'=>'change_pass'));?>;");
					}
					with(milonic=new menuname("system")){
					borderwidth = 1;
					itemwidth=150;
					style = DMStyle;
					aI("text=<?php echo _USER_ADMIN;?>;url=<?php echo generate_url('user_admin');?>;");
					}
					with(milonic=new menuname("website")){
					borderwidth = 1;
					itemwidth=220;
					style = DMStyle;
					aI("text=<?php echo _ABOUT_US_ADMIN;?>;url=<?php echo generate_url('about_us_admin');?>;");										
					aI("text=<?php echo _FAQ_ADMIN;?>;url=<?php echo generate_url('faq_admin');?>;");																							
					aI("text=<?php echo _ADV_ADMIN;?>;url=<?php echo generate_url('adv_admin');?>;");														
					aI("text=<?php echo _INTERNAL_COMPANY_ADMIN;?>;showmenu=internal_company_admin;");			
					aI("text=<?php echo _CHANNEL_DISTRIBUTE_ADMIN;?>;showmenu=channel_distribute_admin;");			
					aI("text=<?php echo _ECONOMIC_RELATIONS_ADMIN;?>;showmenu=economic_relations_admin;");			
					aI("text=<?php echo _PRODUCT_ADMIN;?>;showmenu=product_admin;");			
					aI("text=<?php echo _NEWS_ADMIN;?>;showmenu=news_admin;");											
					aI("text=<?php echo _CONTACT_ADMIN;?>;showmenu=contact_admin;");
					aI("text=<?php echo _QUICK_LINK_ADMIN;?>;url=<?php echo generate_url('quick_link_admin');?>;");
					aI("text=<?php echo _FOOTER_ADMIN;?>;url=<?php echo generate_url('footer_admin');?>;");
					}
															
					with(milonic=new menuname("product_admin")){
					borderwidth = 1;
					itemwidth=200;
					style = DMStyle;
					aI("text=<?php echo _PRODUCT_CATEGORY_ADMIN;?>;url=<?php echo generate_url('product_category_admin');?>;");
					aI("text=<?php echo _PRODUCT_ADMIN;?>;url=<?php echo generate_url('product_admin');?>;");
					}																				
																																					
															
					with(milonic=new menuname("news_admin")){
					borderwidth = 1;
					itemwidth=200;
					style = DMStyle;
					aI("text=<?php echo _NEWS_CATEGORY_ADMIN;?>;url=<?php echo generate_url('news_category_admin');?>;");
					aI("text=<?php echo _NEWS_ADMIN;?>;url=<?php echo generate_url('news_admin');?>;");
					}																				
																																				
					with(milonic=new menuname("channel_distribute_admin")){
					borderwidth = 1;
					itemwidth=200;
					style = DMStyle;
					aI("text=<?php echo _CHANNEL_DISTRIBUTE_CATEGORY_ADMIN;?>;url=<?php echo generate_url('channel_distribute_category_admin');?>;");
					aI("text=<?php echo _CHANNEL_DISTRIBUTE_ADMIN;?>;url=<?php echo generate_url('channel_distribute_admin');?>;");
					}																				
																																				
					with(milonic=new menuname("economic_relations_admin")){
					borderwidth = 1;
					itemwidth=200;
					style = DMStyle;
					aI("text=<?php echo _ECONOMIC_RELATIONS_CATEGORY_ADMIN;?>;url=<?php echo generate_url('economic_relations_category_admin');?>;");
					aI("text=<?php echo _ECONOMIC_RELATIONS_ADMIN;?>;url=<?php echo generate_url('economic_relations_admin');?>;");
					}																				
															
					with(milonic=new menuname("internal_company_admin")){
					borderwidth = 1;
					itemwidth=200;
					style = DMStyle;
					aI("text=<?php echo _INTERNAL_COMPANY_CATEGORY_ADMIN;?>;url=<?php echo generate_url('internal_company_category_admin');?>;");
					aI("text=<?php echo _INTERNAL_COMPANY_ADMIN;?>;url=<?php echo generate_url('internal_company_admin');?>;");
					aI("text=<?php echo _GALLERY_ADMIN;?>;url=<?php echo generate_url('gallery_admin');?>;");
					}																				
															
					with(milonic=new menuname("gallery_admin")){
					borderwidth = 1;
					itemwidth=200;
					style = DMStyle;
					aI("text=<?php echo _GALLERY_CATEGORY_ADMIN;?>;url=<?php echo generate_url('gallery_category_admin');?>;");
					aI("text=<?php echo _GALLERY_ADMIN;?>;url=<?php echo generate_url('gallery_admin');?>;");
					}																				
															
					with(milonic=new menuname("contact_admin")){
					borderwidth = 1;
					itemwidth=200;
					style = DMStyle;
					aI("text=<?php echo _CONTACT_ADMIN;?>;url=<?php echo generate_url('contact_admin');?>;");
					aI("text=<?php echo _CONTACT_INFO_ADMIN;?>;url=<?php echo generate_url('contact_info_admin');?>;");
					}
					
					with(milonic=new menuname("language")){
					borderwidth = 1;
					itemwidth=100;
					style = DMStyle;
					aI("text=English;url=<?php echo generate_url_all(array('lang'), 'lang=english'); ?>;");
					aI("text=Tiếng Việt;url=<?php echo generate_url_all(array('lang'), 'lang=vietnam'); ?>;");
					}
					drawMenus();
					menuDisplay(getMenuByName("Topbar"),1)
					with(milonic=new menuname("Topbar"))
					{
						style=menuStyle;
						alwaysvisible = 1;
						position="relative";
						orientation="horizontal";
						aI("text=<?php echo _HOME;?>;url=<?php echo generate_url('home'); ?>;");
						aI("text=<?php echo _PROFILE;?>;showmenu=persional");
						<?php
							if(is_admin())
							{
						?>
								aI("text=<?php echo _SYSTEM_ADMIN;?>;showmenu=system;");
						<?php
							}
						?>
						<?php
							if(is_content_management())
							{
						?>
								aI("text=<?php echo _WEBSITE_ADMIN;?>;showmenu=website");
						<?php
							}
						?>
						aI("text=<?php echo _SELECT_LANG;?>;showmenu=language");
						aI("text=<?php echo _LOGOUT;?>;url=<?php echo generate_url('sign_out');?>;");
					}
					drawMenus();
					menuDisplay(getMenuByName("Topbar"),1)
				</script>
			</td>
			<td class="menubackgr" style="padding-left: 5px;">
				<?php echo _CURRENT_LANG;?>: <font style="font-weight:bold; color:#FF0000">
				<?php
					global $current_lang;
					echo $current_lang;
				?>
				</font>
			</td>
		</tr>
	</tbody>
</table>