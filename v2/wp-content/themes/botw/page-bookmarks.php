<?php
/**
 * Template Name: Bookmarks
 *
 * The bookmarks template is a page template that displays a list of all your bookmarks/links
 * by link category below the main content of the page.
 * @link http://themehybrid.com/themes/hybrid/page-templates/bookmarks
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

	<div id="content" class="hfeed content">

		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

				<?php hybrid_before_entry(); // Before entry hook ?>

				<div class="entry-content">

					<?php the_content(); ?>

					<?php $args = array(
						'title_li' => false,
						'title_before' => '<h2>',
						'title_after' => '</h2>',
						'category_before' => false,
						'category_after' => false,
						'categorize' => true,
						'show_description' => true,
						'between' => '<br />',
						'show_images' => false,
						'show_rating' => false,
					); ?>
					<?php wp_list_bookmarks( $args ); ?>

					<?php wp_link_pages( array( 'before' => '<p class="page-links pages">' . __( 'Pages:', 'hybrid' ), 'after' => '</p>' ) ); ?>

				</div><!-- .entry-content -->

				<?php hybrid_after_entry(); // After entry hook ?>

			</div><!-- .hentry -->

			<?php hybrid_after_singular(); // After singular hook ?>

			<?php comments_template( '/comments.php', true ); ?>

			<?php endwhile; ?>

		<?php else: ?>

			<p class="no-data">
				<?php _e( 'Apologies, but no results were found.', 'hybrid' ); ?>
			</p><!-- .no-data -->

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); ?>