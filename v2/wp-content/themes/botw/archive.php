<?php
/**
 * Archive Template
 *
 * The archive template is basically a placeholder for archives that don't have a template file. 
 * Ideally, all archives would be handled by a more appropriate template according to the current
 * page context.
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php the_ID(); ?><?php hybrid_entry_class(); ?>

				<?php get_the_image( array( 'custom_key' => array( 'Thumbnail' ), 'size' => 'thumbnail' ) ); ?>

				<?php hybrid_before_entry(); // Before entry hook ?>

				<?php hybrid_after_entry(); // After entry hook ?>

			<?php endwhile; ?>

		<?php else: ?>

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>