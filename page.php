<?php the_post(); ?>
<?php get_header(); ?>

	<main role="main" id="main-content" class="main-content-wrap">
		<article id="post-id-<?php the_id(); ?>" <?php post_class( 'clearfix' ); ?>>
			<?php the_content(); ?>
		</article>
	</main> <?php // .main-content-wrap ?>

	<div class="wrapper">

		<?php get_template_part( 'nav', 'subpages' ); ?>

		<?php get_sidebar(); ?>

	</div> <?php // .wrapper ?>

<?php get_footer(); ?>
