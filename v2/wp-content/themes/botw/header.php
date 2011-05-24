<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the top of the file. It is used mostly as an opening
 * wrapper, which is closed with the footer.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hybrid
 * @subpackage Template
 */?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php hybrid_document_title(); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo THEMEDIR; ?>/_css-lib/960gs/code/css/reset.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo THEMEDIR; ?>/_css-lib/960gs/code/css/text.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo THEMEDIR; ?>/_css-lib/960gs/code/css/960.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo THEMEDIR; ?>/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo THEMEDIR; ?>/_css/print.css" media="print" />

<?php hybrid_head(); // Hybrid head hook ?>
<?php wp_head(); // WP head hook ?>

</head>

<body class="<?php hybrid_body_class(); ?>">

<div id="page-background"></div>

<div id="container-page">

<?php hybrid_before_html(); // Before HTML hook ?>

<div id="body-container" class="container_16 clearfix">

    <div id="escape-info" class="grid_14 push_1 alpha omega"><span id="keep-safe">Keep yourself safe when visiting our site</span><p>The Domestic Violence Center provides an escape link on every page to prevent others from discovering your visit to this site.  Click anywhere on the ESCAPE button and you'll be immediately redirected to a default page.</p>
    <p>Also, we urge you to follow these web safety guidelines to protect yourself</p>
    <a title="close this window" id="close-escape">Close</a>
    </div>
    
	<?php hybrid_before_header(); // Before header hook ?>

	<div id="header-container" class="grid_16">

		<div id="header">
        <span id="text-logo">The Bridge Over Troubled Waters</span>
         <div id="logo" class="grid_6 alpha clearfix">
         	<div id="logo-box">
            	<a href="/" title="The Bridge Over Water - Home"><img src="<?php echo THEMEDIR; ?>/_img/tbotw-logo.gif" alt="The Bridge Over Troubled Waters Home - Logo"/></a>
            </div>
        </div>
        <div id="search" class="grid_7 omega">
            
            <div id="global-search<?php if ( $search_num ) echo '-' . $search_num; ?>" class="search">

				<form method="get" class="search-form" id="search-form<?php if ( $search_num ) echo '-' . $search_num; ?>" action="<?php echo home_url(); ?>/">
				<div>
					<label for="search-text">
                    <input class="search-text" type="text" name="s" id="search-text<?php if ( $search_num)  echo '-' . $search_num; ?>" tabindex="7" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else esc_attr_e( 'Search this site...', 'hybrid' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
					<input class="search-submit button" name="submit" type="submit" id="search-submit<?php if ( $search_num ) echo '-' . $search_num; ?>" tabindex="8" value="<?php esc_attr_e( 'Search', 'hybrid' ); ?>" />
				</label>
                </div>
				</form><!-- .search-form -->

			</div><!-- .search -->
            <a href="http://www.google.com"  id="escape" tabindex="1" title="Leave this page immediatly">Escape</a>
        </div>
            
         <div id="top-nav" class="grid_10 omega">
		 <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container_class' => 'menu', 'menu_class' => '', 'fallback_cb' => '' ) ); ?>
         </div>
   

			<?php hybrid_header(); // Header hook ?>

		</div><!-- #header -->

	</div><!-- #header-container -->

	<?php hybrid_after_header(); // After header hook ?>

	<div id="main-content" class="<?php
    global $post;
    $post_id = $post->ID;
    $post_parent = $post->post_parent;
    $child_of = ($post_parent == 0) ? $post_id : $post_parent;
    $args = array('child_of' => $child_of);
    $pages = get_pages($args);
    
    if (is_page("Landing Page")) :
       echo "grid_16";
    elseif (is_search()) : 
        echo "grid_12";
    else :
       if ($pages) :
           echo "grid_9";
       else :
           echo "grid_12";
       endif;
   endif; ?>">

		<?php hybrid_before_container(); // Before container hook ?>
		