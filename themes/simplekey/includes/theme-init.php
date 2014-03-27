<?php
/** 
 * Theme Initialize
 * @package VAN Framework
 * You can initialize this theme functions like menu,sidebar,thumbnail size,post format and so on.
 * And you can also include more advanced extendsions like custom post type or widgets here. 
 */

 /*The path of widgets an extendsions*/
$widgets_path = get_template_directory() . '/includes/widgets/';
$extendsions_path = get_template_directory() . '/includes/extendsions/';

/*Add custom field at post,page or category edit page*/
require_once($extendsions_path."theme-page-field.php");
require_once($extendsions_path."theme-category-field.php");
require_once($extendsions_path."portfolio-type.php");
require_once($extendsions_path."slider-type.php");
 
/*Add some useful support*/
add_editor_style('editor-style.css');
add_theme_support( 'automatic-feed-links' );
load_theme_textdomain( 'SimpleKey', get_template_directory().'/languages' ); 
$locale = get_locale(); 
$locale_file = get_template_directory_uri()."/languages/$locale.php"; 
if ( is_readable($locale_file) ) require_once($locale_file);

if ( ! isset( $content_width ) ) $content_width = 980;
remove_filter('the_content', 'wptexturize');
add_filter('widget_text', 'do_shortcode');

/*Add diffierent size for post thumbnails*/
add_theme_support('post-thumbnails');
if ( function_exists( 'add_image_size')){  
    add_image_size('blog_thumbnail', 260, 218,true);
	add_image_size('slider_thumbnail', 400, 510,true);
	add_image_size('image_single_slider', 980, 730,true);
	add_image_size('portfolio_thumbnail', 320, 320,true);
	add_image_size('portfolio_thumbnail_4', 241, 241,true);
	add_image_size('portfolio_thumbnail_5', 195, 195,true);
}
/*Init nav menus*/
register_nav_menus(array('primary_navi' => 'Primary Menu'));
register_nav_menus(array('footer_navi' => 'Footer Menu'));

/*Init widget*/
add_action( 'widgets_init', 'van_widgets_init' );
function van_widgets_init() {
	register_sidebar(array(
		'name' => __( 'Blog sidebar', 'SimpleKey' ),
		'id' => 'blog-sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
}

/*Load priority scripts*/
add_action('wp_head', 'van_prior_scripts');
function van_prior_scripts(){
	global $VAN;
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jpreloader.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.placeholder.js"></script>
<script type="text/javascript">
var isLoad=<?php if(is_home()){ if($VAN['isLoad']==1 || !isset($VAN['isLoad'])){echo 1;}else{echo 0;}}else{echo 0;}?>;
var isMobile=<?php if(van_is_mobile()){echo 1;}else{echo 0;}?>;
var slidePlayingSpeed=<?php if(isset($VAN['slidespeed']) && $VAN['slidespeed']<>''){echo $VAN['slidespeed'];}else{echo '7000';
}?>;
var slideTransitionSpeed=<?php if(isset($VAN['slideTransitionSpeed']) && $VAN['slideTransitionSpeed']<>''){echo $VAN['slideTransitionSpeed'];}else{echo '600';
}?>;
</script>
<?php
}

/*Load secondary scripts*/
add_action('wp_footer', 'van_secondary_scripts');
function van_secondary_scripts(){
    global $VAN;
    if(!isset($VAN['isRetina']) || $VAN['isRetina']==1):
?>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/retina.js"></script>
<?php endif;?>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.scrollTo-1.4.3.1-min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.sticky.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/FlexSlider/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/colorbox/jquery.colorbox.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.contact-form.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.tweet.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.mobilemenu.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.superfish.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery.simplekey.js"></script>
<script type="text/javascript">
var pixel="<?php bloginfo('template_url'); ?>/functions/images/pixel.gif";
var loadimg="<?php bloginfo('template_url'); ?>/functions/images/loader2.gif";
<?php if(!isset($VAN['isNiceScroll']) || $VAN['isNiceScroll']=='1'):?>
var isNiceScroll=1;
<?php else:?>
var isNiceScroll=0;
<?php endif;?>
</script>
<?php
}

/*Load Plugins CSS*/
add_action('wp_head', 'van_plugins_css');
function van_plugins_css(){
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/functions/css/shortcodes.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/FlexSlider/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/colorbox/colorbox.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/fonts.css" type="text/css" media="all" />
<?php
}
?>