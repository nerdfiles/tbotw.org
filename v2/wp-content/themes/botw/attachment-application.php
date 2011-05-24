<?php
/**
 * Application Attachment Template
 *
 * This application attachment template is used when a reader is viewing a single application
 * attachment. Applications are uploads (i.e., attachments) that have a mime type of 'application'.
 * @link http://themehybrid.com/themes/hybrid/attachments
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>
		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php the_ID(); ?><?php hybrid_entry_class(); ?>

				<?php hybrid_before_entry(); // Before entry hook ?>

					<?php hybrid_attachment(); ?>

					<?php the_content( sprintf( __( 'Continue reading %1$s', 'hybrid' ), the_title( ' "', '"', false ) ) ); ?>

                    <?php echo wp_get_attachment_url(); ?><?php the_title_attribute(); ?><?php echo get_post_mime_type(); ?>
                    <?php printf( __( 'Download &quot;%1$s&quot;', 'hybrid' ), the_title( '<span class="fn">', '</span>', false) ); ?>

					<?php wp_link_pages( array( 'before' => '<p class="page-links pages">' . __( 'Pages:', 'hybrid' ), 'after' => '</p>' ) ); ?>

				<?php hybrid_after_entry(); // After entry hook ?>

			<?php hybrid_after_singular(); // After singular hook ?>

			<?php comments_template( '/comments.php', true ); ?>

			<?php endwhile; ?>

		<?php else: ?>

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>