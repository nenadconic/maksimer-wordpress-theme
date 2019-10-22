<?php
/**
 * Theme setup
 */
function maksimer_theme_setup() {
	// Load textdomain.
	load_theme_textdomain( 'maksimer-lang', get_template_directory() . '/assets/languages' );

	// Declare theme support.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'menus' );
	add_theme_support( 'woocommerce' );
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add editor style. Uses editor-style.css from theme root.
	add_editor_style();

	// Changes default images values.
	update_option( 'image_default_align', 'none' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'large' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Custom image sizes
	// add_image_size( 'custom-size', 220, 180, true );

	// Register menus.
	register_nav_menus(
		array(
			'main-menu' => __( 'Main menu', 'maksimer-lang' ),
		)
	);
}
add_action( 'after_setup_theme', 'maksimer_theme_setup' );





/**
 * Customizing the admin sidebar
 */
function maksimer_customize_sidebar_menu() {
	remove_menu_page( 'index.php' );
	remove_menu_page( 'separator1' );
	remove_menu_page( 'edit-comments.php' );
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	add_management_page( __( 'Updates', 'maksimer-lang' ), __( 'Updates', 'maksimer-lang' ), 'update_core', 'update-core.php' );

	if ( ! current_user_can( 'administrator' ) ) {
		remove_menu_page( 'wpcf7' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'edit.php?post_type=acf-field-group' );
		remove_menu_page( 'themes.php' );
		add_menu_page( __( 'Menu', 'maksimer-lang' ), __( 'Menu', 'maksimer-lang' ), 'edit_theme_options', 'nav-menus.php', '', 'dashicons-menu', 60 );

		if ( current_theme_supports( 'widgets' ) ) {
			add_menu_page( __( 'Widgets', 'maksimer-lang' ), __( 'Widgets', 'maksimer-lang' ), 'edit_theme_options', 'widgets.php', '', 'dashicons-welcome-widgets-menus', 61 );
		}
	}
}
add_action( 'admin_menu', 'maksimer_customize_sidebar_menu' );





/**
 * Enqueue's all the scripts
 */
function maksimer_enqueue_scripts() {
	wp_enqueue_style( 'style', get_theme_file_uri( 'style.css' ), false, filemtime( get_theme_file_path( 'style.css' ) ), 'all' );
	wp_enqueue_script( 'maksimer', get_theme_file_uri( 'build/js/maksimer.min.js' ), array( 'jquery' ), filemtime( get_theme_file_path( 'build/js/maksimer.min.js' ) ), true );
}
add_action( 'wp_enqueue_scripts', 'maksimer_enqueue_scripts', 11 );





/**
 * Enqueue style and scripts in admin pages
 */
function maksimer_admin_enqueue() {
	if ( is_admin() ) {
		wp_enqueue_style( 'maksimer-admin', get_theme_file_uri( 'admin.css' ), false, filemtime( get_theme_file_path( 'admin.css' ) ), 'all' );
	}
}
add_action( 'admin_enqueue_scripts', 'maksimer_admin_enqueue' );





/**
 * Change yoast metabox priority
 * TODO: Add to maksimer control?
 */
function maksimer_wpseo_metabox_priority() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'maksimer_wpseo_metabox_priority' );





/**
 * Manage the admin bar, front-end
 */
function maksimer_admin_bar() {
	/** @var WP_Admin_Bar $wp_admin_bar */
	global $wp_admin_bar;

	$wp_admin_bar->remove_menu( 'widgets' );
	$wp_admin_bar->remove_menu( 'wpseo-menu' );
	$wp_admin_bar->remove_menu( 'wp-logo' );
	$wp_admin_bar->remove_menu( 'dashboard' );
	$wp_admin_bar->remove_menu( 'themes' );
	$wp_admin_bar->remove_menu( 'menus' );
	$wp_admin_bar->remove_menu( 'comments' );
	$wp_admin_bar->remove_menu( 'new-user' );
	$wp_admin_bar->remove_menu( 'new-media' );
}
add_action( 'wp_before_admin_bar_render', 'maksimer_admin_bar' );





/**
 * Custom template tags (reusable functions)
 */
require get_template_directory() . '/inc/template-tags.php';
