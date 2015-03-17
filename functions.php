<?php
	function maksimer_theme_setup() {
		
		// Legger til støtte for WP-funksjoner
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		add_theme_support( 'title-tag' );
		add_theme_support( 'menus' );
		add_editor_style();

		// Setter standard bildestørrelse, bildelink og alignment
		update_option( 'image_default_align', 'none' );
		update_option( 'image_default_link_type', 'none' );
		update_option( 'image_default_size', 'large' );
	}
	add_action( 'after_setup_theme', 'maksimer_theme_setup' );



	// Endrer default wordpress markup til HTML5
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );



	// Legg til støtte for egne bildestørrelser i WordPress
	if ( function_exists( 'add_theme_support' ) ) {
		set_post_thumbnail_size( 150, 150, true );
		// add_image_size( 'EgenBildeStorrelse', 300, 300, true );
	}



	// Laster admin.css
	function maksimer_admin_css() {
		if ( is_admin() ) {
			wp_enqueue_style( 'maksimer_admin_css', get_template_directory_uri() . '/css/admin.css' );
		}
	}
	add_action( 'init', 'maksimer_admin_css' );



	// Dashboard videresending til "pages"
	function maksimer_dashboard_videresend() {
		if ( ! is_network_admin() ) {
			wp_redirect( admin_url( 'edit.php?post_type=page' ) );	
		}
	}
	add_action( 'load-index.php', 'maksimer_dashboard_videresend' );



	// Fjerner linker fra admin
	function maksimer_endrer_admin_lenker() {
		remove_menu_page( 'index.php' );
		remove_menu_page( 'separator1' );
		remove_menu_page( 'upload.php' );
		remove_menu_page( 'edit-comments.php' );
		remove_submenu_page( 'themes.php', 'customize.php' );
		remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
		add_management_page( __( 'Oppdateringer' ), __( 'Oppdateringer' ), 'update_core', 'update-core.php' );
		if ( ! current_user_can( 'administrator' ) ) {
			remove_menu_page( 'wpcf7' );
			remove_menu_page( 'tools.php' );
			remove_menu_page( 'edit.php?post_type=acf-field-group' );
			// Erstatter "appearance" med "menu/meny" for alle andre enn administratorer
			add_menu_page( __( 'Menu' ), __( 'Menu' ), 'edit_theme_options', 'nav-menus.php', '', 'dashicons-menu', 60 );
		}
	}
	add_action( 'admin_menu', 'maksimer_endrer_admin_lenker' );



	// Endrer rettighetene til brukergruppene
	function maksimer_endrer_brukerrettigheter() {
		$editor_role = get_role( 'editor' );
		if($editor_role)  {
    		$editor_role->add_cap( 'edit_published_posts' );
    		$editor_role->add_cap( 'publish_posts' );
    		$editor_role->add_cap( 'delete_published_posts' );
    		$editor_role->add_cap( 'delete_posts' );
    		$editor_role->add_cap( 'edit_post' );
    		$editor_role->add_cap( 'edit_theme_options' );
    	}
	}
	add_action( 'admin_init', 'maksimer_endrer_brukerrettigheter' );



	// Henter inn javascript og css filer
	function maksimer_enqueue_scripts() {
		wp_enqueue_style( 'reset', get_bloginfo('template_directory') . '/css/reset.css', false, null, 'all' );
		wp_enqueue_style( 'style', get_bloginfo( 'stylesheet_url' ), array( 'reset' ), filemtime( get_template_directory() . '/style.css' ), 'all' );
		// Dummy for wp_enqueue_script();
		// wp_enqueue_script( 'FILNAVN', get_bloginfo( 'template_directory' ) . '/js/FILNAVN.js', array( 'jquery' ) );
		wp_enqueue_script( 'maksimer', get_template_directory_uri() . '/js/maksimer.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/maksimer.js' ) );
		if ( ! is_admin() ) {
			wp_enqueue_script( 'analyse', get_template_directory_uri() . '/js/analyse.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/analyse.js' ), true );
		}
	}
	add_action( 'wp_enqueue_scripts', 'maksimer_enqueue_scripts', 11 );



	// Henter inn html5 shim til gamle IE versjoner, GO HTML5 <3
	function maksimer_html5shim() {
		global $is_IE;
		if ( $is_IE ) {
			echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
		}
	}
	add_action( 'wp_head', 'maksimer_html5shim' );



	// Endrer prioriteten til yoast meta-boksen 
	function maksimer_wpseo_metabox_prioritet() {
		return 'low';
	}
	add_filter( 'wpseo_metabox_prio', 'maksimer_wpseo_metabox_prioritet' );



	// Fjerner linker fra admin-bar
	function maksimer_admin_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'wpseo-menu' );
		$wp_admin_bar->remove_menu( 'wp-logo' );
		$wp_admin_bar->remove_menu( 'dashboard' );
		$wp_admin_bar->remove_menu( 'themes' );
		$wp_admin_bar->remove_menu( 'customize' );
		$wp_admin_bar->remove_menu( 'menus' );
		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'new-user' );
		$wp_admin_bar->remove_menu( 'new-media' );
	}
	add_action( 'wp_before_admin_bar_render', 'maksimer_admin_bar' );



	//// Innholdsbygger-funksjoner
	if ( function_exists ( 'get_row_layout' ) ) {
		// Bakgrunnsfarge til innholdsbyggeren
		function maksimer_bg_farge() {
			$bakgrunn_farge_acf = get_sub_field( 'bakgrunnsfarge' );
			if ( ! empty( $bakgrunn_farge_acf ) ) {
				$bakgrunn_farge = 'background-color: ' . $bakgrunn_farge_acf . ';';
				return $bakgrunn_farge;
			} else {
				return false;
			}
		}
		// Tekstfarge til innholdsbyggeren
		function maksimer_tekst_farge() {
			$tekst_farge_acf = get_sub_field( 'tekstfarge' );
			if ( ! empty( $tekst_farge_acf ) ) {
				$tekst_farge = 'color: ' . $tekst_farge_acf . ';';
				return $tekst_farge;
			} else {
				return false;
			}
		}
		// Padding til innholdsbyggeren
		function maksimer_padding() {
			$padding_acf = get_sub_field( 'padding' );
			if( in_array( 'over', $padding_acf ) ) {
				$padding_topp = ' med-luft-topp';
			} else {
				$padding_topp = ' uten-luft-topp';
			}
			if ( in_array( 'under', $padding_acf ) ) {
				$padding_bunn = ' med-luft-bunn';
			} else {
				$padding_bunn = ' uten-luft-bunn';
			}
			return $padding_topp . $padding_bunn;
		}
	} else {
		return false;
	}



	// Hent id fra den eldste forelder
	function stamfar_id( $post_id = '' ) {
		global $post;
		if ( empty( $post_id ) && empty( $post->ID ) ) {
			return false;
		} elseif ( empty( $post_id ) && ! ( empty( $post->ID ) ) ) {
			$post_id = $post->ID;
		}
		$page_ancestors = get_ancestors( $post->ID, 'page' );
		array_unshift( $page_ancestors, $post_id );
		return array_pop( $page_ancestors );
	};
?>