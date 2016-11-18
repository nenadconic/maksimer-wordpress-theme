<?php get_header(); ?>

	<main role="main" class="main-content-wrap">

		<div class="wrapper">

			<?php
				if ( have_posts() ) {

					echo '<h1>' . get_the_archive_title() . '</h1>';

					while ( have_posts() ) : the_post();
						get_template_part( 'loop', 'single' );
					endwhile;

				} else {

					echo '<h3>' . __( 'No post found', 'maksimer_lang' ) . '</h3>';

				}
			?>

			<?php get_sidebar(); ?>

		</div>

	</main>

<?php get_footer(); ?>
