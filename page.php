<?php the_post(); ?>
<?php get_header(); ?>

	<section class="hovedinnhold">

		<article id="post-id-<?php the_id(); ?>" <?php post_class( 'clearfiks' ); ?>>
			<?php get_template_part( 'innholdsbygger' ); ?>
		</article>

	</section> <?php // .hovedinnhold ?>

	<div class="ramme">

		<?php get_template_part( 'nav', 'undersider' ); ?>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>