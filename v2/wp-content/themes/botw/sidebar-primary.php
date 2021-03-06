<?php
/**
 * Primary Sidebar Template
 *
 * The Primary sidebar template houses the HTML used for the 'Primary' sidebar.
 * It will first check if the sidebar is active before displaying anything.
 * @link http://themehybrid.com/themes/hybrid/widget-areas
 *
 * @package Hybrid
 * @subpackage Template
 */

if ( is_active_sidebar( 'primary' ) && !is_page("Landing Page") ) : ?>

    <div id="primary-sidebar" class="grid_4 omega">

		<?php hybrid_before_primary(); // Before Primary hook ?>

		<?php dynamic_sidebar( 'primary' ); ?>

		<?php hybrid_after_primary(); // After Primary hook ?>
		
    </div>

<?php endif; ?>