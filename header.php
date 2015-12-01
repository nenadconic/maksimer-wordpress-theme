<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />
		<?php wp_head(); ?>	
	</head>
	<body <?php body_class(); ?>>

		<header class="header">

			<div class="wrapper">

				<section class="logo">
					<a href="<?php echo get_home_url() ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
				</section> <?php // .logo ?>

				<nav class="main-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'fallback_cb' => false ) ); ?>
				</nav> <?php // .main-menu ?>

			</div> <?php // .wrapper ?>

		</header> <?php // .header ?>