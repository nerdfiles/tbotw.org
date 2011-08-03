<?php
/**
 * Template Name: Template - Landing Page
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

				<?php // hybrid_before_entry(); // Before entry hook ?>

					<?php the_content(); ?>
					<?php //wp_link_pages( array( 'before' => '<p class="page-links pages">' . __( 'Pages:', 'hybrid' ), 'after' => '</p>' ) ); ?>
<!-- Begin Hardcoded Template -->
<div id="hero" class="grid_16 alpha omega">
    <a href="http://www.unitedwayhouston.org/">
        <img style="-webkit-box-shadow: 0 0 5px #333; position: absolute; right: .5em; top: .5em;" src="http://www.thebridgeovertroubledwaters.org/v2/wp-content/themes/botw/_img/united_way_logo.gif" alt="United Way of Greater Houston" width="96" height="60" class="" title="United Way of Greater Houston" />
    </a>
    <?php
        include_once("static-content/site-wide-hotline.html");
    ?>
    <div id="hero-message-box" class="hero-message"></div>
    <?php
        include_once("static-content/landing-page-hero-message.html");
    ?>
</div>
	<div id="column1" class="grid_8 alpha">
    <div class="blockquote">
    	<div class="top">&nbsp;
        </div>
        
        <div class="bottom">
            <?php
                include_once("static-content/landing-page-quote.html")
            ?>
        </div>
    </div>
    </div>
    <div id="column2" class="grid_8 omega clearfix">
        <!-- WP Stuff from Blog -->
    	<div id="events">
            <div class="h2">
                <h2>Upcoming Events</h2>
                <a href="topics/events/" title="Show All Events">Show All Events »</a>
            </div>
            <?php
            $args = array( 'numberposts' => 3, 'category_name' => 'Events', 'orderby' => 'date' );
            $postslist = get_posts( $args );
            
            if ( $postslist ) {
            foreach ($postslist as $post) :  setup_postdata($post); ?> 
              <div class="event clear-all">
                  <h3><?php echo get_the_title(); ?></h3>
                  <div class="date"><?php echo get_the_date("M\. j"); ?></div>
                  <div><?php the_excerpt(); ?></div>
                  <a href="<?php the_permalink(); ?>" title="View Event Info">Read more »</a>
              </div>
            <?php endforeach; 
            } else { 
              ?>
              <p class="no-events">There are currently no upcoming events.</p>
              <?php
            }
            ?>
         </div>
    </div>
    <div id="call-to-action-pods" class="grid_16 alpha omega">
    	<div class="grid_4 alpha pod">
            <?php
                include_once("static-content/landing-page-1st-pod.html")
            ?>
        </div>
    	<div class="grid_4 pod">
            <?php
                include_once("static-content/landing-page-2nd-pod.html")
            ?>
        </div>
    	<div class="grid_4 pod">
            <?php
                include_once("static-content/landing-page-3rd-pod.html")
            ?>
        </div>
    	<div class="grid_4 pod omega">
            <?php
                include_once("static-content/landing-page-4th-pod.html")
            ?>
        </div>
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