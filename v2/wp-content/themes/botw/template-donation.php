<?php
/**
 * Template Name: Template - Donation
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

				<?php hybrid_before_entry(); // Before entry hook ?>

					<?php the_content(); ?>

				<?php hybrid_after_entry(); // After entry hook ?>

			<?php hybrid_after_singular(); // After singular hook ?>

			<?php //comments_template( '/comments.php', true ); //?>
			
			</div><!-- <?php the_ID(); ?> -->

			<?php endwhile; ?>

		<?php else: ?>
		
            <p>Nothing to see here.</p>

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>