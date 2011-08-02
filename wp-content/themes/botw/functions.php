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

add_action( 'after_setup_theme', 'wpse3882_after_setup_theme' );
function wpse3882_after_setup_theme()
{
    add_editor_style();
}

//add_filter('mce_buttons_2', 'wpse3882_mce_buttons_2');
function wpse3882_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('tiny_mce_before_init', 'wpse3882_tiny_mce_before_init');
function wpse3882_tiny_mce_before_init($settings)
{
    /*
    $settings['theme'] = "advanced";
    //$settings['plugins'] = "visualchars";
    $settings['theme_advanced_blockformats'] = 'p,pre,h1,h2,h3,h4,div,blockquote,dt,dd,code,samp';
    $settings['theme_advanced_buttons1'] = "bold,italic,underline,separator,styleselect,removeformat,cleanup,help,code,hr,formatselect,fontselect,fontsizeselect,sub,sup"; //"separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor";
    $settings['theme_advanced_buttons2'] = "forecolor,backcolor,forecolorpicker,backcolorpicker,charmap,visualaid,anchor,newdocument,blockquote,image,link,unlink,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,outdent,indent,cut,copy,paste,undo,redo"; //"bullist,numlist,separator,outdent,indent,separator,undo,redo,separator";
    $settings['theme_advanced_buttons3'] = "fullpage,fullscreen,advhr,iespell,media,nonbreaking,pagebreak,preview,print,spellchecker"; //"hr,removeformat,visualaid,separator,sub,sup,separator,charmap";
    
    $settings['theme_advanced_buttons3_add'] = "visualchars";
    */
    
    // From http://tinymce.moxiecode.com/examples/example_24.php
    $style_formats = array(
        //array('title' => 'Bold text', 'inline' => 'b'),
        //array('title' => 'Red text', 'inline' => 'span', 'styles' => array('color' => '#ff0000')),
        //array('title' => 'Red header', 'block' => 'h1', 'styles' => array('color' => '#ff0000')),
        //array('title' => 'Example 1', 'inline' => 'span', 'classes' => 'example1'),
        //array('title' => 'Example 2', 'inline' => 'span', 'classes' => 'example2'),
        //array('title' => 'Table styles'),
        //array('title' => 'Table row 1', 'selector' => 'tr', 'classes' => 'tablerow1'),
        array('title' => 'HTML5 Semantics'),
        array('title' => 'aside', 'block' => 'aside', 'classes' => ''),
        array('title' => 'dialog', 'block' => 'dialog', 'classes' => ''),
        array('title' => 'figure', 'block' => 'figure', 'classes' => ''),
        array('title' => 'figcaption', 'block' => 'figcaption', 'classes' => ''),
        array('title' => 'section', 'block' => 'section', 'classes' => ''),
        array('title' => 'footer', 'block' => 'footer', 'classes' => ''),
        array('title' => 'header', 'block' => 'header', 'classes' => ''),
        array('title' => 'hgroup', 'block' => 'hgroup', 'classes' => ''),
        array('title' => 'nav', 'block' => 'nav', 'classes' => ''),
        array('title' => 'article', 'block' => 'article', 'classes' => ''),
        array('title' => 'HTML5 Multimedia'),
        array('title' => 'audio', 'block' => 'audio', 'classes' => ''),
        array('title' => 'video', 'block' => 'video', 'classes' => ''),
        array('title' => 'List Styles'),
        array('title' => 'DL', 'block' => 'dl', 'wrapper' => 'dt,dd'),
        array('title' => '- DT', 'block' => 'dt', 'classes' => 'doctor'),
        array('title' => '- DD', 'block' => 'dd', 'classes' => 'patient'),
    );
    // Before 3.1 you needed a special trick to send this array to the configuration.
    // See this post history for previous versions.
    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;
}

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
    <!--script data-main="global" type="text/javascript" src="<?php echo THEMEDIR; ?>/_js/require-jquery-1.4.4.js"></script-->
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

add_action("init", "kill_stuff", 1);

function kill_stuff() {
  if (!is_admin()) {
  wp_deregister_script('l10n');
  wp_deregister_script('comment-reply');
  }
  //<script type='text/javascript' src='http://www.thebridgeovertroubledwaters.org/v2/wp-includes/js/l10n.js?ver=20101110'></script> 
  //<script type='text/javascript' src='http://www.thebridgeovertroubledwaters.org/v2/wp-includes/js/comment-reply.js?ver=20090102'></script> 
  
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
        <a href="http://www.unitedwayhouston.org/" class="uw-logo">
            <img src="http://www.thebridgeovertroubledwaters.org/v2/wp-content/themes/botw/_img/united_way_logo.gif" alt="United Way of Greater Houston" width="96" height="60" class="" title="United Way of Greater Houston" />
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
