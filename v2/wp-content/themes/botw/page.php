<?php
/**
 * Page Template
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
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
					<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'hybrid' ), 'after' => '' ) ); ?>
				<?php hybrid_after_entry(); // After entry hook ?>

    			<?php hybrid_after_singular(); // After singular hook ?>
    
    			<?php //comments_template( '/comments.php', true ); ?>

            </div>
            
			<?php endwhile; ?>

		<?php else: ?>
		
            <p>Apologies, no page found.</p>

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>