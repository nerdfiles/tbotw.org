<?php
/**
 * Before Content Sidebar Template
 *
 * The Before Content sidebar template houses the HTML used for the 'Utility: Before Content' 
 * sidebar. It will first check if the sidebar is active before displaying anything.
 * @link http://themehybrid.com/themes/hybrid/widget-areas
 *
 * @package Hybrid
 * @subpackage Template
 */

	if ( is_active_sidebar( 'utility-before-content' ) ) : ?>
    <?php dynamic_sidebar( 'utility-before-content' ); ?>
	<?php endif; ?>