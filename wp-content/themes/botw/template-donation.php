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

<!-- Begin Hardcoded Template -->
<div class="cushycms-wysiwyg" title="Donation Form">
    <form id="donation-form" method="post" action="https://www.eProcessingNetwork.com/cgi-bin/wo/order.pl">
    
        <h2>Make a Donation</h2>
        
        <fieldset>
        <input type="hidden" name="ePNAccount" value="1010312" />
        <input type="hidden" name="URL" value="http://www.thebridgeovertroubledwaters.org/v2/donate/" />
        <input type="hidden" name="ItemDesc" value="Donation" />
        <input type="hidden" name="ItemQty" maxlength="3" value="1" />
            <legend class="position_zap">Enter a Donation Amount</legend>
            <dl class="clearfix no_margin">
                <dt class="grid_3 alpha"><label for="ItemCost">Donation Amount</label></dt>
                <dd class="grid_5 omega basement_2"><input type="text" id="ItemCost" name="ItemCost" value="0" tabindex="1" /></dd>
            </dl>
            <div class="push_3">
                <input type="submit" class="submit" value="Donate" tabindex="2" />
            </div>
        </fieldset>
    
    </form>
</div>

<!-- End Hardcoded Template -->

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