<?php
/**
 * 404 Template
 *
 * The 404 template is used when a reader visits an invalid URL on your site. By default,
 * the template will display a generic message. However, if the '404 Template' widget area
 * is active, its widgets will be displayed instead. This allows users to customize their error
 * pages in any way they want.
 *
 * For more information on how WordPress handles 404 errors:
 * @link http://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hybrid
 * @subpackage Template
 */

@header( 'HTTP/1.1 404 Not found', true, 404 );

get_header(); ?>

		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( is_active_sidebar( 'utility-404' ) ) : ?>

        <?php dynamic_sidebar( 'utility-404' ); ?>

		<?php else: ?>

			<?php hybrid_entry_class(); ?>

					<?php get_search_form(); ?>
					
		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>