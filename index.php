<?php get_header(); ?>

	<main role="main" id="main-content" class="main-content-wrap">

		<div class="wrapper">

			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();
					get_template_part( 'loop', 'single' );
				endwhile;

			else :
				echo '<h1>' . esc_attr__( 'No post found!', 'maksimer-lang' ) . '</h1>';
			endif;
			?>

			<?php get_template_part( 'nav', 'post-pag' ); ?>
			<?php get_sidebar(); ?>

		</div>

	</main>

<?php get_footer(); ?>
