<!-- #header -->
<div id="header">
	<!-- #header-inside -->
    <div id="header-inside" class="container_12 clearfix">
    	<!-- #header-inside-left -->
        <div id="header-inside-left" class="grid_8">
            
            <?php if ($logo): ?>
            <a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
            <?php endif; ?>
     
            <?php if ($site_name || $site_slogan): ?>
            <div class="clearfix">
            <?php if ($site_name): ?>
            <span id="site-name"><a href="<?php print check_url($front_page); ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a></span>
            <?php endif; ?>
            <?php if ($site_slogan): ?>
            <span id="slogan"><?php print $site_slogan; ?></span>
            <?php endif; ?>
            </div>
            <?php endif; ?>
            
        </div><!-- EOF: #header-inside-left -->
        
        <!-- #header-inside-right -->    
        <div id="header-inside-right" class="grid_4">

			<?php print render($page['search_area']); ?>

        </div><!-- EOF: #header-inside-right -->
    
    </div><!-- EOF: #header-inside -->

</div><!-- EOF: #header -->

<!-- #header-menu -->
<div id="header-menu">
	<!-- #header-menu-inside -->
    <div id="header-menu-inside" class="container_12 clearfix">
    
    	<div class="grid_12">
            <div id="navigation" class="clearfix">
            <?php if ($page['navigation']) :?>
            <?php print drupal_render($page['navigation']); ?>
            <?php else :
            if (module_exists('i18n_menu')) {
            $main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
            } else {
            $main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu')); 
            }
            print drupal_render($main_menu_tree);
            endif; ?>
            </div>
        </div>
        
    </div><!-- EOF: #header-menu-inside -->

</div><!-- EOF: #header-menu -->

<!-- #banner -->
<div id="banner">

	<?php print render($page['banner']); ?>
	
    <?php if (theme_get_setting('slideshow_display','corporateclean')): ?>
    
    <?php if ($is_front): ?>
    
    <!-- #slideshow -->
    <div id="slideshow">
    
        <!--slider-item-->
        <div class="slider-item">
            <div class="content container_12">
            	<div class="grid_12">
                
                <!--slider-item content-->
<br/>


<div style=" float: left; width:30%; min-height:350px; margin-right:100px;">
<div style="font-size:12pt;color:#000;"><strong>Zapisz sie teraz, otrzymasz</strong></div><br/>
<div style="text-align:justify;">
<ul>
<li>Kurs "Budowa krok po kroku strony firmowej w Drupalu" - <a href="#">sprawdź go!</a></li>
<li>Pełny dostęp do strony</li>
<li>Regularne maile z poradami i z nowościami na stronie</li>
</ul>

<script language="javascript"> function SprawdzFormularz(f) { if (f.email.value=='') { alert('Nie podałe/a adresu e-mail.'); return false; } if ( ((f.email.value.indexOf('@',1))==-1)||(f.email.value.indexOf('.',1))==-1 ) { alert('Podałe/a błędny adres e-mail'); return false; } else { return true; } } </script> <form target="_blank" action="http://www.implebot.pl/post.php" name="impleBOT.pl" method="post" onsubmit="return SprawdzFormularz(this)"> <input name="uid" type="hidden" value="50435"> <input name="zrodlo" type="hidden" value="standard"> <div style="clear:both; padding-top:5px;;"><label style="width:60px; display:block; float:left; margin-right:15px;" for="email">E-mail:</label> <input style="width:180px; display:block; float:left; margin-bottom:15px;" name="email" type="text"></div> <input style="clear:both; display:block; width:254px; margin-top:5px;" type="submit" value="Zapisz mnie"> </form>

</div>

</div>

<div style="text-align:justify;margin-right:20px">
<div style="font-size:12pt;text-align:justify; color:#000;"><strong>Obecnie na stronie znajdziesz</strong></div><br/>
<div style="font-size:11pt;padding:0px 10px 10px;"><a href="./kursy">Kursy</a></div><div style="text-align:justify;">To serie filmów instruktarzowych związanych z Drupalem. Najczęściej przedstawiają szczegółowe omówienie tematu związanego z systemem lub jego komponentami.</div>
<div style="font-size:11pt;padding:10px 10px 10px;"><a href="./gotowce">Gotowce</a></div><div style="text-align:justify;">To pakiety funkcjonalności gotowe do instalacji. Gotowcami mogą być całe dystrybucje np. strona firmowa lub pojedyncze skonfigurowane komponenty takie jak rozbudowana galeria zdjęć.</div>
<div style="font-size:11pt;padding:10px 10px 10px;"><a href="./blog">Blog</a></div><div style="text-align:justify;">To miejsce, w którym dzieje się najwięcej. Znajdziesz tam wpisy z kaĹźdego tematu związanego z Drupalem.</div>
</div>
                
<br/>
                                <!--EOF:slider-item content-->

                </div>
            </div>
        </div>
        <!--EOF:slider-item-->

    
    </div>
    <!-- EOF: #slideshow -->
    <!-- #slider-controls-wrapper -->


    <!-- EOF: #slider-controls-wrapper -->    
 <?php endif; ?>
    
	<?php endif; ?>  

</div><!-- EOF: #banner -->


<!-- #content -->
<div id="content">
	<!-- #content-inside -->
    <div id="content-inside" class="container_12 clearfix">
    
        <?php if ($page['sidebar_first']) :?>
        <!-- #sidebar-first -->
        <div id="sidebar-first" class="grid_4">
        	<?php print render($page['sidebar_first']); ?>



        </div><!-- EOF: #sidebar-first -->
        <?php endif; ?>
        
        <?php if ($page['sidebar_first'] && $page['sidebar_second']) { ?>
        <div class="grid_4">
        <?php } elseif ($page['sidebar_first'] || $page['sidebar_second']) { ?>
        <div id="main" class="grid_8">
		<?php } else { ?>
        <div id="main" class="grid_12">    
        <?php } ?>
            
            <?php if (theme_get_setting('breadcrumb_display','corporateclean')): print $breadcrumb; endif; ?>
            
            <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
       
            <?php if ($messages): ?>
            <div id="console" class="clearfix">
            <?php print $messages; ?>
            </div>
            <?php endif; ?>
     
            <?php if ($page['help']): ?>
            <div id="help">
            <?php print render($page['help']); ?>
            </div>
            <?php endif; ?>
            
            <?php if ($action_links): ?>
            <ul class="action-links">
            <?php print render($action_links); ?>
            </ul>
            <?php endif; ?>
            
			<?php print render($title_prefix); ?>
            <?php if ($title): ?>
            <h1><?php print $title ?></h1>
            <?php endif; ?>
            <?php print render($title_suffix); ?>
            
            <?php if ($tabs): ?><?php print render($tabs); ?><?php endif; ?>
            
            <?php print render($page['content']); ?>
            
            <?php print $feed_icons; ?>
            
        </div><!-- EOF: #main -->
        
        <?php if ($page['sidebar_second']) :?>
        <!-- #sidebar-second -->
        <div id="sidebar-second" class="grid_4">
        	<?php print render($page['sidebar_second']); ?>
        </div><!-- EOF: #sidebar-second -->
        <?php endif; ?>  

    </div><!-- EOF: #content-inside -->

</div><!-- EOF: #content -->

<!-- #footer -->    
<div id="footer">
	<!-- #footer-inside -->
    <div id="footer-inside" class="container_12 clearfix">
    
        <div class="footer-area grid_4">
        <?php print render($page['footer_first']); ?>
        </div><!-- EOF: .footer-area -->
        
        <div class="footer-area grid_4">
        <?php print render($page['footer_second']); ?>
        </div><!-- EOF: .footer-area -->
        
        <div class="footer-area grid_4">
        <?php print render($page['footer_third']); ?>
        </div><!-- EOF: .footer-area -->
       
    </div><!-- EOF: #footer-inside -->

</div><!-- EOF: #footer -->

<!-- #footer-bottom -->    
<div id="footer-bottom">

	<!-- #footer-bottom-inside --> 
    <div id="footer-bottom-inside" class="container_12 clearfix">
    	<!-- #footer-bottom-left --> 
    	<div id="footer-bottom-left" class="grid_8">
        
            <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('class' => array('secondary-menu', 'links', 'clearfix')))); ?>
            
            <?php print render($page['footer']); ?>
            
        </div>
    	<!-- #footer-bottom-right --> 
        <div id="footer-bottom-right" class="grid_4">
        
        	<?php print render($page['footer_bottom_right']); ?>
        
        </div><!-- EOF: #footer-bottom-right -->
       
    </div><!-- EOF: #footer-bottom-inside -->
    
    <!-- #credits -->   
    <div id="credits" class="container_12 clearfix">
        <div class="grid_12">
        <p>Ported to Drupal by <a href="http://www.drupalizing.com">Drupalizing</a>, a Project of <a href="http://www.morethanthemes.com">More than (just) Themes</a>. Designed by <a href="http://www.kaolti.com/">Zsolt Kacso</a></p>
        </div>
    </div>
    <!-- EOF: #credits -->

</div><!-- EOF: #footer -->
