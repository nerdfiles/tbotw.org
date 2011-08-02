<?php
/**
 * Category Taxonomy Template
 *
 * This template is loaded when viewing a category archive and replaces the default 
 * category.php template.  It can also be overwritten for individual categories using
 * taxonomy-category-$term.php.
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

		<?php hybrid_before_content(); // Before content hook ?>

        <h1 class="page-title entry-title"><a href="."><?php single_cat_title(); ?></a></h1>
		
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div style="border-bottom: 1px #ccc solid; margin: 0 0 1em;" class="clearfix">
                
				<?php get_the_image( array( 'custom_key' => array( 'Thumbnail' ), 'size' => 'thumbnail' ) ); ?>

				<?php hybrid_before_entry(); // Before entry hook ?>

					<p><?php the_excerpt(); ?></p>

				<?php hybrid_after_entry(); // After entry hook ?>
				</div>
				
				<style>
				    .thumbnail { float: left; margin: .5em 1em 1em 0; }
				</style>

			<?php endwhile; ?>

		<?php else: ?>

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>