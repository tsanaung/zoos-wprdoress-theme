<?php
add_action( 'after_setup_theme', 'zoos_setup' );
function zoos_setup() {
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'zoos' ) ) );
}
add_action( 'wp_enqueue_scripts', 'zoos_load_scripts' );
function zoos_load_scripts() {
	//Registering style
wp_enqueue_style( 'zoos-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'zoos_footer_scripts' );
function zoos_footer_scripts() {
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'zoos_document_title_separator' );
function zoos_document_title_separator( $sep ) {
$sep = '|';
return $sep;
}
add_filter( 'the_title', 'zoos_title' );
function zoos_title( $title ) {
if ( $title == '' ) {
return '...';
} else {
return $title;
}
}
add_filter( 'the_content_more_link', 'zoos_read_more_link' );
function zoos_read_more_link() {
if ( ! is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">...</a>';
}
}
add_filter( 'excerpt_more', 'zoos_excerpt_read_more_link' );
function zoos_excerpt_read_more_link( $more ) {
if ( ! is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">...</a>';
}
}
add_filter( 'intermediate_image_sizes_advanced', 'zoos_image_insert_override' );
function zoos_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
return $sizes;
}
add_action( 'widgets_init', 'zoos_widgets_init' );
function zoos_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'zoos' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'zoos_pingback_header' );
function zoos_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'zoos_enqueue_comment_reply_script' );
function zoos_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function zoos_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'zoos_comment_count', 0 );
function zoos_comment_count( $count ) {
if ( ! is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}


// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_custom_plugin_styles' );

/**
 * Register Mini CSS (minicss.org) style sheet.
 */
function register_custom_plugin_styles() {
    wp_register_style( 'minicss', 'https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css' );
    wp_enqueue_style( 'minicss' );
}
