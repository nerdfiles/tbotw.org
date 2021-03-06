<?php
/**
 * Singular Template
 *
 * WordPress currently supports custom post types displayed on the singular post level. This template
 * is a catchall template for the singular views of these posts. It should only be used as a backup or if
 * your custom post type doesn't require a custom structure. The template hierarchy for singular views
 * of post types is like so: $post_type-$template.php, $post_type-$slug.php, $post_type-$id.php,
 * $post_type.php, and singular.php.
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php the_ID(); ?><?php hybrid_entry_class(); ?>

				<?php hybrid_before_entry(); // Before entry hook ?>

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<p class="page-links pages">' . __( 'Pages:', 'hybrid' ), 'after' => '</p>' ) ); ?>
				<?php hybrid_after_entry(); // After entry hook ?>

			<?php hybrid_after_singular(); // After singular hook ?>

			<?php comments_template( '/comments.php', true ); ?>

			<?php endwhile; ?>

		<?php else : ?>

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>