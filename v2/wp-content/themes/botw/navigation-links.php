<?php
/**
 * Navigation Links Template
 *
 * This template is used to show your your next/previous post links on singular pages and
 * the next/previous posts links on the home/posts page and archive pages. It also integrates
 * with the WP PageNavi plugin if activated.
 *
 * @package Hybrid
 * @subpackage Template
 */
?>

	<?php if ( is_attachment() ) : ?>
			<?php previous_post_link( '%link', '<span class="previous">' . __( '&laquo; Return to entry', 'hybrid' ) . '</span>' ); ?>
	<?php elseif ( is_singular( 'post' ) ) : ?>
			<?php previous_post_link( '%link', '<span class="previous">' . __( '&laquo; Previous', 'hybrid' ) . '</span>' ); ?>
			<?php next_post_link( '%link', '<span class="next">' . __( 'Next &raquo;', 'hybrid' ) . '</span>' ); ?>
	<?php elseif ( !is_singular() && function_exists( 'wp_pagenavi' ) ) : wp_pagenavi(); ?>

	<?php elseif ( !is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous">' . __( '&laquo; Previous', 'hybrid' ) . '</span>', 'nxtlabel' => '<span class="next">' . __( 'Next &raquo;', 'hybrid' ) . '</span>' ) ) ) : ?>

        <?php echo $nav; ?>

	<?php endif; ?>