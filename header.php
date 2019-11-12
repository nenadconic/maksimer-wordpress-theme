<?php
/**
 * The header for our theme
 *
 * @package maksimer
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<a class="skip-link screen-reader-text" href="#main-menu-wrapper"><?php esc_attr_e( 'Skip to navigation', 'maksimer-lang' ); ?></a>
		<a class="skip-link screen-reader-text" href="#main-content"><?php esc_attr_e( 'Skip to content', 'maksimer-lang' ); ?></a>

		<header class="header" role="banner">

			<div class="logo">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					echo '<a href="' . esc_url( get_home_url() ) . '">';
						bloginfo( 'name' );
					echo '</a>';
				}
				?>
			</div>

			<nav class="main-menu" id="main-menu-wrapper" role="navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'main-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

		</header>
