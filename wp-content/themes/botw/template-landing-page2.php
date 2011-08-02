<?php
/**
 * Template Name: Template - Landing Page - Proto
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
	<div id="hotline">
    	<span class="english">24 Hour<br />Hotline</span>
    	<span class="spanish">Linea de<br />24 Houra</span>
        <span class="phone">713.473.2801</span>    
    </div>
    <div id="hero-message-box" class="hero-message"></div>
    <div id="hero-message-text" class="hero-message">
    <h1>A Bridge to Healing and Self Sufficiency</h1>
        <span> Assisting survivors of domestic and/or sexual violence and those who are homeless due to these circumstances.  <a href="#" title="Learn More About Us">Learn More About Us »</a></span>
    </div>
</div>
	<div id="column1" class="grid_8 alpha">
    <div class="blockquote">
    	<div class="top">&nbsp;
        </div>
        
        <div class="bottom">
        	<div id="quote"><blockquote>The mission of The Bridge is to offer support, provide safety, and prevent domestic and sexual violence."</blockquote>

            <p>In hac habitasse platea dictumst. Nulla neque lectus, dictum viverra mollis ut, feugiat ut diam. Aenean posuere massa nec tortor imperdiet non adipiscing arcu ornare. In eget magna sed lectus iaculis eleifend. Proin posuere viverra dui eget vehicula. Praesent luctus vulputate nisi, fermentum suscipit nisl aliquam vitae.</p>
            <p>In hac habitasse platea dictumst. Nulla neque lectus, dictum viverra mollis ut, feugiat ut diam. Aenean posuere massa nec tortor imperdiet non adipiscing arcu ornare. In eget magna sed lectus iaculis eleifend. Proin posuere viverra dui eget vehicula. Praesent luctus vulputate nisi, fermentum suscipit nisl aliquam vitae.</p></div>
        </div>
    </div>
    </div>
    <div id="column2" class="grid_8 omega clearfix">
    	<div id="events">
            <div class="h2">
                <h2>Upcoming Events</h2>
                <a href="#" title="Show All Events">Show All Events »</a>
            </div>
            <div class="event clear-all">
                <h3>Group Skill Development Activities</h3>
                <div class="date">Oct. 31</div>
                <div>Group Skill Development Activities 6:00PMm The Bridge Events Center</div>
                <a href="#" title="Show This Event">Show Event »</a>
            </div>
            <div class="event clear-all">
                <h3>Group Skill Development Activities</h3>
                <div class="date">Oct. 31</div>
                <div>Group Skill Development Activities 6:00PMm The Bridge Events Center</div>
                <a href="#" title="Show This Event">Show Event »</a>
            </div>
            <div class="event clear-all">
                <h3>Group Skill Development Activities</h3>
                <div class="date">Oct. 31</div>
                <div>Group Skill Development Activities 6:00PMm The Bridge Events Center</div>
                <a href="#" title="Show This Event">Show Event »</a>
            </div>
         </div>
    </div>
    <div id="call-to-action-pods" class="grid_16 alpha omega">
    	<div class="grid_4 alpha pod">
        	<img src="<?php echo THEMEDIR; ?>/_img/volunteer.jpg" alt="People Volunteering in their community " width="220" height="169"/>
            <h3>Lend a Hand</h3>
            <p>In hac habitasse platea dictumst. Nulla neque lectus, dictum viverra mollis ut, feugiat ut diam. Aenean posuere massa nec tortor imperdiet non adipiscing arcu ornare. In eget magna sed lectus iaculis eleifend. Proin posuere viverra dui eget vehicula. Praesent luctus vulputate nisi, fermentum suscipit nisl aliquam vitae. In fringilla</p>
            <div class="call-to-action"><a href="#" title="Find out how you can lend a hand">Find out how you can lend a hand »</a></div>
        </div>
    	<div class="grid_4 pod">
        	<img src="<?php echo THEMEDIR; ?>/_img/donate.jpg" alt="A child's outstretchd hands - as if asking for money" width="220" height="169"/>
            <h3>Your Help is Needed</h3>
            <p>In hac habitasse platea dictumst. Nulla neque lectus, dictum viverra mollis ut, feugiat ut diam. Aenean posuere massa nec tortor imperdiet non adipiscing arcu ornare. In eget magna sed lectus iaculis eleifend. Proin posuere viverra dui eget vehicula. Praesent luctus vulputate nisi, fermentum suscipit nisl aliquam vitae. In fringilla</p>
            <div class="call-to-action"><a href="#" title="Find out how you can lend a hand">Find out how you can lend a hand »</a></div>
        </div>
    	<div class="grid_4 pod">
        	<img src="<?php echo THEMEDIR; ?>/_img/capital_campaign.jpg" alt="Ground breaking ceremony" width="220" height="169"/>
            <h3>Ground Breaking</h3>
            <p>In hac habitasse platea dictumst. Nulla neque lectus, dictum viverra mollis ut, feugiat ut diam. Aenean posuere massa nec tortor imperdiet non adipiscing arcu ornare. In eget magna sed lectus iaculis eleifend. Proin posuere viverra dui eget vehicula. Praesent luctus vulputate nisi, fermentum suscipit nisl aliquam vitae. In fringilla</p>
            <div class="call-to-action"><a href="#" title="Find out how you can lend a hand">Find out how you can lend a hand »</a></div>
            </div>
    	<div class="grid_4 pod omega">
        	<img src="<?php echo THEMEDIR; ?>/_img/resources.jpg" alt="A woman outdoors with outstretched arms" width="220" height="169"/>
            <h3>Resources</h3>
            <p>In hac habitasse platea dictumst. Nulla neque lectus, dictum viverra mollis ut, feugiat ut diam. Aenean posuere massa nec tortor imperdiet non adipiscing arcu ornare. In eget magna sed lectus iaculis eleifend. Proin posuere viverra dui eget vehicula. Praesent luctus vulputate nisi, fermentum suscipit nisl aliquam vitae. In fringilla</p>
            <div class="call-to-action"><a href="#" title="Find out how you can lend a hand">Find out how you can lend a hand »</a></div>
        </div>
    </div>
<!-- End Hardcoded Template -->

				<?php //hybrid_after_entry(); // After entry hook ?>

			<?php hybrid_after_singular(); // After singular hook ?>

			<?php //comments_template( '/comments.php', true ); //?>
			
			</div><!-- <?php the_ID(); ?> -->

			<?php endwhile; ?>

		<?php else: ?>
		
            <p>Nothing to see here.</p>

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

<?php get_footer(); ?>