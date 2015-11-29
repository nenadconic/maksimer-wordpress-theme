<?php get_header(); ?>

	<div class="wrapper">

		<article class="content-404">
			<h1><?php _e( '404 - Page not found', 'maksimer_lang' ); ?></h1>
			<h2><?php _e( 'The page you are looking for does not exist', 'maksimer_lang' ); ?>.</h2>
			<p>
				<a href="<?php echo home_url(); ?>" class="button"><?php _e( 'Home Page', 'maksimer_lang' ); ?></a>
			</p>
		</article>

	</div> <?php // .wrapper ?>

<?php get_footer(); ?>