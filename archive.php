<?php get_header(); ?>

	<div class="ramme">

		<?php if ( have_posts() ) : ?>

			<h1><?php the_archive_title(); ?></h1>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-id-<?php the_id(); ?>" <?php post_class( 'clearfiks' ); ?>>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<?php the_excerpt(); ?>
				</article>

			<?php endwhile; ?>

		<?php else : ?>

			<h3><?php _e( 'Ingen innlegg funnet', 'maksimer_lang' ); ?></h3>

		<?php endif; ?>

		<?php get_template_part( 'nav', 'post-pag' ); ?>

		<?php get_sidebar(); ?>

	</div> <?php // .ramme ?>

<?php get_footer(); ?>