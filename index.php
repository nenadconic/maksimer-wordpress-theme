<?php get_header(); ?>
	<main role="main" id="main-content" class="main-content-wrap">
		
		<div class="wrapper">

			<?php
				if ( have_posts() ) {

					while ( have_posts() ) : the_post();
						get_template_part( 'loop', 'single' );
					endwhile;

				} else {

					echo '<h3>' . __( 'No post found', 'maksimer_lang' ) . '</h3>';

				}
			?>

			<?php get_template_part( 'nav', 'post-pag' ); ?>

			<?php get_sidebar(); ?>

		</div> <?php // .wrapper ?>

	</main>

<?php get_footer(); ?>
