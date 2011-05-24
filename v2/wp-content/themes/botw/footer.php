<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hybrid
 * @subpackage Template
 */
?>
		<?php hybrid_after_container(); // After container hook ?>

	</div><!-- #main-content -->
	
    <?php hybrid_get_primary() ?>
	
	</div><!-- #container-page -->

	<div id="footer-container">

		<?php hybrid_before_footer(); // Before footer hook ?>

        <div id="footer-container-inner">
        
    		<div id="footer" class="container_16 clearfix">
    
    			<?php hybrid_footer(); // Hybrid footer hook ?>
    			
                <?php include_once("static-content/footer-contact.html"); ?>
                
                <div id="footer-links" class="grid_12">
                    <div class="grid_2 alpha">
                        <h4><a href="services/">Services</a></h4>
                        <?php wp_nav_menu( array( 'menu' => 'Footer Services Menu', 'theme_location' => 'footer-services-menu', 'container_class' => 'menu', 'menu_class' => 'no_indent', 'fallback_cb' => '' ) ); ?>
                    </div>
                    <div class="grid_2">
                        <h4><a href="about-us/">About Us</a></h4>
                        <?php wp_nav_menu( array( 'menu' => 'Footer About Us Menu', 'theme_location' => 'footer-about-us-menu', 'container_class' => 'menu', 'menu_class' => 'no_indent', 'fallback_cb' => '' ) ); ?>
                    </div>
                    <div class="grid_2">
                        <h4><a href="resource-center">Resource Center</a></h4>
                        <?php wp_nav_menu( array( 'menu' => 'Footer Resource Center Menu', 'theme_location' => 'footer-resource-center-menu', 'container_class' => 'menu', 'menu_class' => 'no_indent', 'fallback_cb' => '' ) ); ?>
                    </div>
                    <div class="grid_2">
                        <h4><a href="support/">Support</a></h4>
                        <?php wp_nav_menu( array( 'menu' => 'Footer Support Menu', 'theme_location' => 'footer-support-menu', 'container_class' => 'menu', 'menu_class' => 'no_indent', 'fallback_cb' => '' ) ); ?>
                    </div>
                    <div class="grid_2 omega">
                        <h4>Other</h4>
                        <?php wp_nav_menu( array( 'menu' => 'Footer Other Menu', 'theme_location' => 'footer-support-menu', 'container_class' => 'menu', 'menu_class' => 'no_indent', 'fallback_cb' => '' ) ); ?>
                    </div>
                </div><!-- #footer-links -->
                
                <?php include_once("static-content/footer-copyright.html"); ?>
    
    		</div><!-- #footer -->
		
		</div>

		<?php hybrid_after_footer(); // After footer hook ?>

	</div><!-- #footer-container -->

</div><!-- #body-container -->

<?php wp_footer(); // WordPress footer hook ?>
<?php hybrid_after_html(); // After HTML hook ?>

</body>
</html>