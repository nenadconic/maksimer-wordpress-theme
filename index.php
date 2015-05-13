<?php get_header(); ?>

	<div class="ramme">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'loop', 'single' ); ?>

		<?php endwhile; else : ?>

			<h3><?php _e( 'Ingen innlegg funnet', 'maksimer_lang' ); ?></h3>

		<?php endif; ?>

		<?php get_template_part( 'nav', 'post-pag' ); ?>

		<?php get_sidebar(); ?>

	</div> <?php // .ramme ?>

<?php get_footer(); ?>