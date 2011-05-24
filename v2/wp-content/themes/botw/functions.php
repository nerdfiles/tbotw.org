<?php
/**
 * Rather than lumping all theme functions into a single file, this functions file is used for
 * initializing the theme framework, which activates files in the order that it needs. Users
 * should create a child theme and make changes to its functions.php file (not this one).
 *
 * @package Hybrid
 * @subpackage Functions
 */

/* Load the Hybrid class. */
require_once( TEMPLATEPATH . '/library/classes/hybrid.php' );

/* Initialize the Hybrid framework. */
$hybrid = new Hybrid();
$hybrid->init();

/* ======= Kill Hybrid's Douche-y Actions ======= */

add_action("hybrid_init", "kill_hybrid");

function kill_hybrid() {
    remove_action("hybrid_header", "hybrid_site_title");
    remove_action("hybrid_header", "hybrid_site_description");
    remove_action("hybrid_before_content", "hybrid_breadcrumb");
    remove_action("hybrid_before_entry", "hybrid_byline");
    remove_action("hybrid_after_content", "hybrid_navigation_links");
    remove_action("hybrid_after_entry", "hybrid_entry_meta");
    remove_action("hybrid_after_header", "hybrid_get_primary_menu");
    remove_action("hybrid_after_container", "hybrid_get_primary");
}


/* ======= In-house JS ======= */

add_action('hybrid_after_html', 'load_js', 11);

function load_js() {
?>
    <script data-main="global" type="text/javascript" src="<?php echo THEMEDIR; ?>/_js/require-jquery-1.4.4.js"></script>
    <script type="text/javascript">
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-21125745-1']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>
<?php
}

add_action("hybrid_before_html", "skip_links");

function skip_links() {
    global $post;
    $post_id = $post->ID;
    $post_parent = $post->post_parent;
    $child_of = ($post_parent == 0) ? $post_id : $post_parent;
    $args = array('child_of' => $child_of);
    $pages = get_pages($args);

    ?>
    <div id="skip-links" class="position_zap">
        <ul>
            <li><a href="#main-content" title="Skip to content">Skip to content</a></li>
            <li><a href="#top-nav" title="Skip to navigation">Skip to navigation</a></li>
            <?php if ($pages) : ?>
            <li><a href="#subnav" title="Skip to Sub navigation">Skip to Sub navigation</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php
}

add_action("hybrid_after_header", "subnavigation", 2);

function subnavigation() {
    global $post;
    $post_id = $post->ID;
    $post_parent = $post->post_parent;
    $child_of = ($post_parent == 0) ? $post_id : $post_parent;
    $args = array('child_of' => $child_of);
    $pages = get_pages($args);

    if (is_page("Landing Page")) :
    elseif (is_page() && $pages) :
?>
        <div id="subnav" class="grid_3">
            <div id="subnav-inner">
                <ul class="subnav-menu">
                <?php wp_list_pages("title_li=&child_of=".$child_of); ?>
                </ul>
            </div>
        </div>
<?php
    endif;
}

add_action("hybrid_after_header", "page_hero",1);

function page_hero() {
    if (!is_page("Landing Page")) {
    ?>
    <div id="page-hero" class="grid_16" class="cushycms-wysiwyg" title="Site-wide Hotline">
        <a href="http://www.unitedwayhouston.org/">
            <img style="-webkit-box-shadow: 0 0 5px #333; position: absolute; right: 2.3em; bottom: .5em;" src="http://www.thebridgeovertroubledwaters.org/v2/wp-content/themes/botw/_img/united_way_logo.gif" alt="United Way of Greater Houston" width="96" height="60" class="" title="United Way of Greater Houston" />
        </a>
        <?php
            include_once("static-content/site-wide-hotline.html");
        ?>
    </div>
    <?php
    }
}

add_filter("hybrid_document_title", "seo_title");

function seo_title($title) {
    if(is_page("Landing Page")):
        $title = 'The Bridge Over Troubled Waters';
    else :
        $title = $title . ' &raquo; The Bridge Over Troubled Waters';
    endif;
    return $title;
}

?>
