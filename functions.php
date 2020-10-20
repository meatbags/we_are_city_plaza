<?php

// scripts & styles

add_action( 'wp_enqueue_scripts', 'cityplaza_load_scripts' );
function cityplaza_load_scripts()
{
	wp_register_style( 'cityplazastyle', get_template_directory_uri() . '/lib/css/style.css' );
	wp_enqueue_style( 'cityplazastyle' );
	
	// js deps
    wp_enqueue_script( 'cityplaza', get_template_directory_uri() . '/lib/js/build/cityplaza.min.js', array('jquery') );
}
// setup

function cityplaza_setup()
{
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'cityplaza_setup' );

// customise admin

function add_admin_post_types() {
	// photographers
	
	register_post_type('photographer', array(
		'label' => 'Photographers',
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'photographer'),
		'query_var' => true,
		'menu_icon' => 'dashicons-camera',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'revisions', 'thumbnail')
	));
	
	// exhibitions
	
	register_post_type('exhibition', array(
		'label' => 'Exhibitions',
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'exhibition'),
		'query_var' => true,
		'menu_icon' => 'dashicons-format-image',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'revisions', 'thumbnail')
	));
	
	// gallery
	
	register_post_type('gallery', array(
		'label' => 'Gallery',
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'gallery'),
		'query_var' => true,
		'menu_icon' => 'dashicons-format-gallery',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'revisions', 'thumbnail')
	));
	
	// about/ support
	
	register_post_type('about', array(
		'label' => 'About/ Support',
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'rewrite' => array('slug' => 'about'),
		'query_var' => true,
		'menu_icon' => 'dashicons-heart',
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array('title', 'editor', 'revisions', 'thumbnail')
	));
}
add_action('init', 'add_admin_post_types');

function remove_admin_post_types() {
	// remove admin options
	
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}

add_action('admin_menu', 'remove_admin_post_types');

// defaults

add_action( 'comment_form_before', 'cityplaza_enqueue_comment_reply_script' );
function cityplaza_enqueue_comment_reply_script()
{
	if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'cityplaza_title' );
function cityplaza_title( $title ) {
	if ( $title == '' ) {
		return '&rarr;';
	} else {
		return $title;
	}
}

add_filter( 'wp_title', 'cityplaza_filter_wp_title' );
function cityplaza_filter_wp_title( $title )
{
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'cityplaza_widgets_init' );
function cityplaza_widgets_init()
{
	register_sidebar( array (
		'name' => __( 'Sidebar Widget Area', 'cityplaza' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => "</li>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

function cityplaza_custom_pings( $comment )
{
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
	<?php 
}

add_action('get_header', 'remove_adminbar_pushdown');  
function remove_adminbar_pushdown() {  
  remove_action('wp_head', '_admin_bar_bump_cb');  
}

add_action( 'admin_init', 'posts_order_wpse_91866' );
function posts_order_wpse_91866() 
{
    add_post_type_support( 'photographer', 'page-attributes' );
}


/*
add_filter( 'get_comments_number', 'cityplaza_comments_number' );
function cityplaza_comments_number( $count )
{
	if ( !is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
		return count( $comments_by_type['comment'] );
	} else {
		return $count;
	}
}
*/