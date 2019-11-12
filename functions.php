<?php
/**
 * Theme setup
 */
function maksimer_theme_setup() {
	// Load textdomain.
	load_theme_textdomain( 'maksimer-lang', get_template_directory() . '/assets/languages' );

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	// Declare theme support.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'menus' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Changes default images values.
	update_option( 'image_default_align', 'none' );
	update_option( 'image_default_link_type', 'none' );
	update_option( 'image_default_size', 'large' );

	// Add custom image sizes.
	// add_image_size( 'maksimer-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// TODO:Maybe add retina setting?

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

}

add_action( 'after_setup_theme', 'maksimer_theme_setup' );


function maksimer_menus() {

	$locations = array(
		'main-menu' => __( 'Main menu', 'maksimer-lang' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'maksimer_menus' );


/**
 * Customizing the admin sidebar
 */
function maksimer_customize_sidebar_menu() {
	remove_menu_page( 'index.php' );
	remove_menu_page( 'separator1' );
	remove_menu_page( 'edit-comments.php' );
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	add_management_page(
		__( 'Updates', 'maksimer-lang' ),
		__( 'Updates', 'maksimer-lang' ),
		'update_core',
		'update-core.php'
	);

	if ( ! current_user_can( 'administrator' ) ) {
		remove_menu_page( 'wpcf7' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'edit.php?post_type=acf-field-group' );
		remove_menu_page( 'themes.php' );
		add_menu_page(
			__( 'Menu', 'maksimer-lang' ),
			__( 'Menu', 'maksimer-lang' ),
			'edit_theme_options',
			'nav-menus.php',
			'',
			'dashicons-menu',
			60
		);

		if ( current_theme_supports( 'widgets' ) ) {
			add_menu_page(
				__( 'Widgets', 'maksimer-lang' ),
				__( 'Widgets', 'maksimer-lang' ),
				'edit_theme_options',
				'widgets.php',
				'',
				'dashicons-welcome-widgets-menus',
				61
			);
		}
	}
}

add_action( 'admin_menu', 'maksimer_customize_sidebar_menu' );


/**
 * Register and Enqueue all the styles and scripts
 */
function maksimer_enqueue_all() {

	wp_enqueue_script(
		'maksimer-script',
		get_theme_file_uri( 'build/js/maksimer.min.js' ),
		array( 'jquery' ),
		filemtime( get_theme_file_path( 'build/js/maksimer.min.js' ) ),
		true
	);
	wp_script_add_data( 'maksimer', 'async', true );

	wp_enqueue_style(
		'maksimer-style',
		get_theme_file_uri( 'style.css' ),
		false,
		filemtime( get_theme_file_path( 'style.css' ) ),
		'all'
	);
	wp_style_add_data( 'maksimer-style', 'rtl', 'replace' );

}

add_action( 'wp_enqueue_scripts', 'maksimer_enqueue_all', 11 );


/**
 * Enqueue supplemental block editor styles.
 */
function maksimer_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style(
		'maksimer-block-editor-styles',
		get_theme_file_uri( 'editor-style-block.css' ),
		array(),
		filemtime( get_theme_file_path( 'style.css' ) ),
		'all'
	);
	wp_style_add_data( 'block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	//wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

}

add_action( 'enqueue_block_editor_assets', 'maksimer_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function maksimer_classic_editor_styles() {

	$classic_editor_styles = array(
		'editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'maksimer_classic_editor_styles' );


/**
 * Enqueue style and scripts in admin pages
 */
function maksimer_admin_enqueue() {
	if ( is_admin() ) {
		wp_enqueue_style(
			'maksimer-admin',
			get_theme_file_uri( 'admin.css' ),
			false,
			filemtime( get_theme_file_path( 'admin.css' ) ),
			'all'
		);
	}
}

add_action( 'admin_enqueue_scripts', 'maksimer_admin_enqueue' );


if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'maksimer_skip_link' ) ) {

	/**
	 * Include a skip to content link at the top of the page so that users can bypass the menu.
	 */
	function maksimer_skip_link() {
		echo '<a class="skip-link faux-button screen-reader-text" href="#site-content">' . __(
				'Skip to the content',
				'maksimer-lang'
			) . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- core trusts translations
	}

	add_action( 'wp_body_open', 'maksimer_skip_link', 5 );

}

if ( ! function_exists( 'maksimer_read_more_tag' ) ) {

	/**
	 * Read More Link
	 * Overwrite default (more ...) tag
	 */
	function maksimer_read_more_tag() {
		return sprintf(
			'<a href="%1$s" class="more-link faux-button">%2$s <span class="screen-reader-text">"%3$s"</span></a>',
			esc_url( get_permalink( get_the_ID() ) ),
			esc_html__( 'Continue reading', 'maksimer-lang' ),
			get_the_title( get_the_ID() )
		);
	}

	add_filter( 'the_content_more_link', 'maksimer_read_more_tag' );

}


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


// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

//Custom template tags (reusable functions)
require get_template_directory() . '/inc/template-tags.php';
