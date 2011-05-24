<?php
/**
 * After Content Sidebar Template
 *
 * The After Content sidebar template houses the HTML used for the 'Utility: After Content' 
 * sidebar. It will first check if the sidebar is active before displaying anything.
 * @link http://themehybrid.com/themes/hybrid/widget-areas
 *
 * @package Hybrid
 * @subpackage Template
 */

	if ( is_active_sidebar( 'utility-after-content' ) ) : ?>

    <?php dynamic_sidebar( 'utility-after-content' ); ?>

	<?php endif; ?>