<?php get_header(); ?>

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

		<?php get_sidebar(); ?>

	</div> <?php // .wrapper ?>

<?php get_footer(); ?>