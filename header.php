<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
		<?php wp_head(); ?>	
	</head>
	<body <?php body_class(); ?>>
		<a class="skip-link screen-reader-text" href="#main-menu-wrapper"><?php _e( 'Skip to navigation', 'maksimer_lang' ); ?></a>
		<a class="skip-link screen-reader-text" href="#main-content"><?php _e( 'Skip to content', 'maksimer_lang' ); ?></a>

		<header class="header" role="banner">

			<div class="wrapper">

				<div class="logo">
					<?php
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
							echo '<a href="' . get_home_url() . '">';
								bloginfo( 'name' );
							echo '</a>';
						}
					?>
				</div> <?php // .logo ?>

				<nav class="main-menu" id="main-menu-wrapper" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'fallback_cb' => false ) ); ?>
				</nav>

			</div> <?php // .wrapper ?>

		</header>
