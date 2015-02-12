<?php 

require_once('wp_bootstrap_navwalker.php');
require_once('rain-custom-fields.php');
require_once('rain-widgets.php'); 

@ini_set( 'upload_max_size' , '32M' );
@ini_set( 'post_max_size', '32M');
@ini_set( 'max_execution_time', '300' );

function slider_item_post_type() {
	$labels = array(
		'name'               => _x( 'Slider items', 'Slider items' ),
		'singular_name'      => _x( 'Slider item', 'Slider item' ),
		'add_new'            => _x( 'Add New', 'slider item' ),
		'add_new_item'       => __( 'Add New slider item' ),
		'edit_item'          => __( 'Edit slider item' ),
		'new_item'           => __( 'New slider item' ),
		'all_items'          => __( 'All slider items' ),
		'view_item'          => __( 'View slider item' ),
		'search_items'       => __( 'Search slider items' ),
		'not_found'          => __( 'No slider items found' ),
		'not_found_in_trash' => __( 'No slider items found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Slider items'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds slider items',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
		'has_archive'   => true,
		'taxonomies' 	=> array('category'),
	);
	register_post_type( 'slider', $args );	
}
add_action( 'init', 'slider_item_post_type' );

function news_item_post_type() {
	$labels = array(
		'name'               => _x( 'News items', 'News items' ),
		'singular_name'      => _x( 'News item', 'News item' ),
		'add_new'            => _x( 'Add New', 'News item' ),
		'add_new_item'       => __( 'Add New news item' ),
		'edit_item'          => __( 'Edit news item' ),
		'new_item'           => __( 'New news item' ),
		'all_items'          => __( 'All news items' ),
		'view_item'          => __( 'View news item' ),
		'search_items'       => __( 'Search news items' ),
		'not_found'          => __( 'No news items found' ),
		'not_found_in_trash' => __( 'No news items found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'News items'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds news items',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author'),
		'has_archive'   => true,
		'taxonomies' 	=> array('category'),
		'yarpp_support' => true
	);
	register_post_type( 'news', $args );	
}
add_action( 'init', 'news_item_post_type' );


function publications_post_type() {
	$labels = array(
		'name'               => _x( 'Publications items', 'Publications items' ),
		'singular_name'      => _x( 'Publications item', 'Publications item' ),
		'add_new'            => _x( 'Add New', 'Publications item' ),
		'add_new_item'       => __( 'Add New publications item' ),
		'edit_item'          => __( 'Edit publications item' ),
		'new_item'           => __( 'New publications item' ),
		'all_items'          => __( 'All publications items' ),
		'view_item'          => __( 'View publications item' ),
		'search_items'       => __( 'Search publications items' ),
		'not_found'          => __( 'No publications items found' ),
		'not_found_in_trash' => __( 'No publications items found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Publication items'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds publication items',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author'),
		'has_archive'   => true,
		'taxonomies' 	=> array('category', 'publication_category'),
		'yarpp_support' => true
	);
	register_post_type( 'publication', $args );	
}
add_action( 'init', 'publications_post_type' );



// Register Custom Taxonomy
function create_publication_categories() {

	$labels = array(
		'name'                       => _x( 'Publication categories', 'Taxonomy General Name', 'rain' ),
		'singular_name'              => _x( 'Publication category', 'Taxonomy Singular Name', 'rain' ),
		'menu_name'                  => __( 'Publication categories', 'rain' ),
		'all_items'                  => __( 'All publication categories', 'rain' ),
		'parent_item'                => __( 'Parent publication category', 'rain' ),
		'parent_item_colon'          => __( 'Parent publication category:', 'rain' ),
		'new_item_name'              => __( 'New Publication Category Name', 'rain' ),
		'add_new_item'               => __( 'Add New Publication Category', 'rain' ),
		'edit_item'                  => __( 'Edit publication category', 'rain' ),
		'update_item'                => __( 'Update publication category', 'rain' ),
		'separate_items_with_commas' => __( 'Separate publication categories with commas', 'rain' ),
		'search_items'               => __( 'Search publication categories', 'rain' ),
		'add_or_remove_items'        => __( 'Add or remove publication categories', 'rain' ),
		'choose_from_most_used'      => __( 'Choose from the most used publication categories', 'rain' ),
		'not_found'                  => __( 'Not Found', 'rain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'publication-category', array('publication'), $args );
	
}

// Hook into the 'init' action
add_action( 'init', 'create_publication_categories', 0 );


// PROGRAMS

function programmes_post_type() {
	$labels = array(
		'name'               => _x( 'Programmes', 'Programmes' ),
		'singular_name'      => _x( 'Programme', 'Programme' ),
		'add_new'            => _x( 'Add new', 'programme' ),
		'add_new_item'       => __( 'Add new programme' ),
		'edit_item'          => __( 'Edit programme' ),
		'new_item'           => __( 'New programme' ),
		'all_items'          => __( 'All programmes' ),
		'view_item'          => __( 'View programme' ),
		'search_items'       => __( 'Search programmes' ),
		'not_found'          => __( 'No programmes found' ),
		'not_found_in_trash' => __( 'No programmes found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Programmes'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds programmes',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
		'has_archive'   => true
	);
	register_post_type( 'programmes', $args );	
}
add_action( 'init', 'programmes_post_type' );


function team_partners_post_type() {
	$labels = array(
		'name'               => _x( 'Team members', 'Team members' ),
		'singular_name'      => _x( 'Team member', 'Team member' ),
		'add_new'            => _x( 'Add new', 'team members' ),
		'add_new_item'       => __( 'Add new team member' ),
		'edit_item'          => __( 'Edit team member' ),
		'new_item'           => __( 'New team member' ),
		'all_items'          => __( 'All team members' ),
		'view_item'          => __( 'View team member' ),
		'search_items'       => __( 'Search team members' ),
		'not_found'          => __( 'No team members found' ),
		'not_found_in_trash' => __( 'No team members found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Team members'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds team members',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
		'has_archive'   => true,
		'taxonomies' 	=> array('category'),
	);
	register_post_type( 'team-members', $args );	
}
add_action( 'init', 'team_partners_post_type' );



// ABOUT

function about_post_type() {
	$labels = array(
		'name'               => _x( 'About blocks', 'About blocks' ),
		'singular_name'      => _x( 'About block', 'About block' ),
		'add_new'            => _x( 'Add new', 'about block' ),
		'add_new_item'       => __( 'Add new about block' ),
		'edit_item'          => __( 'Edit About block' ),
		'new_item'           => __( 'New About block' ),
		'all_items'          => __( 'All About blocks' ),
		'view_item'          => __( 'View About block' ),
		'search_items'       => __( 'Search About blocks' ),
		'not_found'          => __( 'No About blocks found' ),
		'not_found_in_trash' => __( 'No About blocks found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'About blocks'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds about items',
		'public'        => true,
		'menu_position' => 6,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'about'),
	);
	register_post_type( 'about-items', $args );	
}
add_action( 'init', 'about_post_type' );


function cb_about_meta_box( $post )
{
$values = get_post_custom( $post->ID );
$selected = isset( $values['custom_template'] ) ? esc_attr( $values['custom_template'][0] ) : ”;
	?>
	<p>
		<label for="custom_template">Select a template</label>
		<select name="custom_template" id="custom_template">
			<option value="text-left" <?php selected( $selected, 'text-left' ); ?>>Text left image right</option>
			<option value="text-right" <?php selected( $selected, 'text-right' ); ?>>Text right image left</option>
			<option value="organisation" <?php selected( $selected, 'organisation' ); ?>>Organisation</option>
			<option value="approach" <?php selected( $selected, 'approach' ); ?>>Approach</option>
			<option value="team" <?php selected( $selected, 'team' ); ?>>Team and partners</option>
			<option value="join" <?php selected( $selected, 'join' ); ?>>Join RAIN</option>
			<option value="contact" <?php selected( $selected, 'contact' ); ?>>Contact form</option>
			<option value="media" <?php selected( $selected, 'media' ); ?>>Media</option>
			<option value="partners" <?php selected( $selected, 'partners' ); ?>>Partners</option>
		</select>
	</p>
	<?php
}


// service-blocks

function service_block_post_type() {
	$labels = array(
		'name'               => _x( 'Service blocks', 'Service blocks' ),
		'singular_name'      => _x( 'Service block', 'Service block' ),
		'add_new'            => _x( 'Add new', 'service block' ),
		'add_new_item'       => __( 'Add new service block' ),
		'edit_item'          => __( 'Edit service block' ),
		'new_item'           => __( 'New service block' ),
		'all_items'          => __( 'All service blocks' ),
		'view_item'          => __( 'View service block' ),
		'search_items'       => __( 'Search service blocks' ),
		'not_found'          => __( 'No service blocks found' ),
		'not_found_in_trash' => __( 'No service blocks in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Service blocks'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds service items',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'service'),
	);
	register_post_type( 'service-blocks', $args );	
}
add_action( 'init', 'service_block_post_type' );


function news_block_post_type() {
	$labels = array(
		'name'               => _x( 'News blocks', 'News blocks' ),
		'singular_name'      => _x( 'News block', 'News block' ),
		'add_new'            => _x( 'Add new', 'news block' ),
		'add_new_item'       => __( 'Add new news block' ),
		'edit_item'          => __( 'Edit news block' ),
		'new_item'           => __( 'New news block' ),
		'all_items'          => __( 'All news blocks' ),
		'view_item'          => __( 'View news block' ),
		'search_items'       => __( 'Search news blocks' ),
		'not_found'          => __( 'No news blocks found' ),
		'not_found_in_trash' => __( 'No news blocks in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'News blocks'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds news blocks',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
		'has_archive'   => true
	);
	register_post_type( 'news-blocks', $args );	
}
add_action( 'init', 'news_block_post_type' );

function footer_post_type() {
	$labels = array(
		'name'               => _x( 'Footer', 'Footer' ),
		'singular_name'      => _x( 'footer', 'footer' ),
		'add_new'            => _x( 'Add new', 'footer block' ),
		'add_new_item'       => __( 'Add new footer' ),
		'edit_item'          => __( 'Edit footer' ),
		'new_item'           => __( 'New footer' ),
		'all_items'          => __( 'All footers' ),
		'view_item'          => __( 'View footer' ),
		'search_items'       => __( 'Search footers' ),
		'not_found'          => __( 'No footers found' ),
		'not_found_in_trash' => __( 'No footers in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Footer'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the footer',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail'),
		'has_archive'   => true
	);
	register_post_type( 'footer', $args );	
}
add_action( 'init', 'footer_post_type' );



// country-pages

function country_pages_post_type() {
	$labels = array(
		'name'               => _x( 'Country pages', 'Country pages' ),
		'singular_name'      => _x( 'Country page', 'Country page' ),
		'add_new'            => _x( 'Add new', 'country page' ),
		'add_new_item'       => __( 'Add new country page' ),
		'edit_item'          => __( 'Edit country page' ),
		'new_item'           => __( 'New country page' ),
		'all_items'          => __( 'All country pages' ),
		'view_item'          => __( 'View country page' ),
		'search_items'       => __( 'Search country pages' ),
		'not_found'          => __( 'No country pages found' ),
		'not_found_in_trash' => __( 'No country pages in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Country pages'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds country page items',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'country'),
	);
	register_post_type( 'countries', $args );	
}
add_action( 'init', 'country_pages_post_type' );


// country-pages

function tools_post_type() {
	$labels = array(
		'name'               => _x( 'Tool pages', 'Tool pages' ),
		'singular_name'      => _x( 'Tool page', 'Tool page' ),
		'add_new'            => _x( 'Add new', 'tool page' ),
		'add_new_item'       => __( 'Add new tool page' ),
		'edit_item'          => __( 'Edit tool page' ),
		'new_item'           => __( 'New tool page' ),
		'all_items'          => __( 'All tool pages' ),
		'view_item'          => __( 'View tool page' ),
		'search_items'       => __( 'Search tool pages' ),
		'not_found'          => __( 'No tool pages found' ),
		'not_found_in_trash' => __( 'No tool pages in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Tool pages'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds tool pages',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'custom-fields'),
		'has_archive'   => true,
		'rewrite' => array('slug' => 'tools'),
	);
	register_post_type( 'tools', $args );	
}
add_action( 'init', 'tools_post_type' );


add_filter( 'upload_size_limit', 'b5f_increase_upload' );

function b5f_increase_upload( $bytes )
{
    return 33554432; // 32 megabytes
}


add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the mimes array as below
    $existing_mimes['ai'] = 'application/postscript';
    $existing_mimes['eps'] = 'application/postscript';
    return $existing_mimes;
}


include( get_template_directory() .'/constants.php' );

// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );


function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

function disable_scripts () {

		wp_dequeue_script('jquery');
		wp_deregister_script('jquery');
	
}
add_action('wp_enqueue_scripts','disable_scripts');


if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'news-thumb', 350, 120, true); 
	add_image_size( 'news-thumb-square', 80, 80, true); 
	add_image_size( 'team-member-thumb', 80, 120, true); 
	add_image_size( 'team-member-full', 180, 270, true); 
	add_image_size( 'project-list-thumb', 220, 124, true); 
}

function custom_menu_order($menu_ord) {
	if (!$menu_ord) return true;
	
	return array(
		'index.php', // Dashboard
		'separator1', // First separator
		// 'edit.php?post_type=homepage-blocks',
		'edit.php?post_type=slider',
		'edit.php?post_type=service-blocks',
		'edit.php?post_type=project-blocks',
		'edit.php?post_type=programmes', 
		'edit.php?post_type=about-items',
		'edit.php?post_type=team-members', 
		'edit.php?post_type=news-blocks',
		'edit.php?post_type=news',
		'edit.php?post_type=footer',
    	'edit.php?post_type=page',
		'admin.php?page=wpcf7',
		'upload.php', // Media
		'separator2', // Second separator
		'themes.php', // Appearance
		'plugins.php', // Plugins
		'users.php', // Users
		'tools.php', // Tools
		'options-general.php', // Settings
		'separator-last', // Last separator
	);
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');


function check_valid_colorhex($colorCode) {

    // If user accidentally passed along the # sign, strip it off
    $colorCode = ltrim($colorCode, '#');

    if (
          ctype_xdigit($colorCode) &&
          (strlen($colorCode) == 6 || strlen($colorCode) == 3))
               return true;

    else return false;
}

function get_custom_background_color($id){
	$background_color = get_post_meta( $id, "background_color", true );
	if (check_valid_colorhex($background_color) == false){
		$background_color = "transparent";
	}
	return $background_color;
}

add_filter( 'request', 'my_request_filter' );
function my_request_filter( $query_vars ) {
	if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		$query_vars['s'] = " ";
	}
	return $query_vars;
}

function project_focus_widget() {
	include( get_template_directory() .'/ajax-project-focus.php' );
	die();
}
add_action('wp_ajax_project_focus_widget', 'project_focus_widget');
add_action('wp_ajax_nopriv_project_focus_widget', 'project_focus_widget');


function projects_list() {
	include( get_template_directory() .'/ajax-projects-list.php' );
	die();
}
add_action('wp_ajax_projects', 'projects_list');
add_action('wp_ajax_nopriv_projects', 'projects_list');


function news_archive() {
	include( get_template_directory() .'/news-ajax-archive.php' );
	die();
}
add_action('wp_ajax_news_archive', 'news_archive');
add_action('wp_ajax_nopriv_news_archive', 'news_archive');



add_action( 'generate_rewrite_rules', 'add_oipa_tags');
// add_action( 'init', 'generate_rewrite_rules' );  
function add_oipa_tags() { 
	add_rewrite_tag('%iati_id%','([^&]+)');
	add_rewrite_tag('%backlink%','([^&]+)');
}

function add_rewrite_rules( $wp_rewrite ) 
{
	$new_rules = array(
		'project/([^/]+)/?$' => 'index.php?pagename=project&iati_id='.$wp_rewrite->preg_index(1),
		'embed/([^/]+)/?$' => 'index.php?pagename=embed&iati_id='.$wp_rewrite->preg_index(1),
	);
	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_rewrite_rules');

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return '... ';
}
add_filter('excerpt_more', 'new_excerpt_more');

function rain_remove_wp_seo_meta_box() {
    remove_meta_box( 'wpseo_meta', 'slider', 'normal' ); // change custom-post-type into the name of your custom post type
    remove_meta_box( 'wpseo_meta', 'project-blocks', 'normal' ); // change custom-post-type into the name of your custom post type
    remove_meta_box( 'wpseo_meta', 'programmes', 'normal' ); // change custom-post-type into the name of your custom post type
    remove_meta_box( 'wpseo_meta', 'team-members', 'normal' ); // change custom-post-type into the name of your custom post type
    remove_meta_box( 'wpseo_meta', 'about-items', 'normal' ); // change custom-post-type into the name of your custom post type
    remove_meta_box( 'wpseo_meta', 'service-blocks', 'normal' ); // change custom-post-type into the name of your custom post type
    remove_meta_box( 'wpseo_meta', 'news-blocks','normal');
    remove_meta_box( 'wpseo_meta', 'footer', 'normal' ); // change custom-post-type into the name of your custom post type
}
add_action( 'add_meta_boxes', 'rain_remove_wp_seo_meta_box', 100000 );


// Add styles to the WYSIWYG editor 
add_editor_style('editor-style.css');

register_sidebar( array(
	'name' => 'Homepage - sidebar',
	'id' => 'homepage-side',
	'description' => 'This is the homepage sidebar (shown on the right side of the page)',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
) );

register_sidebar( array(
	'name' => 'Homepage - Project focus',
	'id' => 'homepage-project-focus',
	'description' => 'This is the homepage upper main sidebar',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
) );

register_sidebar( array(
	'name' => 'Homepage - Tools & countries',
	'id' => 'homepage-tools-countries',
	'description' => 'This is the homepage lower main sidebar',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
) );

register_sidebar( array(
	'name' => 'Service main bar',
	'id' => 'services-main',
	'description' => 'This is the main bar on the service detail pages',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
) );

register_sidebar( array(
	'name' => 'Service sidebar',
	'id' => 'services-side',
	'description' => 'This is the sidebar on the service detail pages',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
) );

register_sidebar( array(
	'name' => 'Countries sidebar',
	'id' => 'countries-side',
	'description' => 'This is the sidebar on the country detail pages',
	'before_widget' => '',
	'after_widget' => '',
	'before_title' => '',
	'after_title' => '',
) );



