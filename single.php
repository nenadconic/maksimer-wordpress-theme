<?php the_post(); ?>
<?php get_header(); ?>

	<div class="ramme">

		<article id="post-id-<?php the_id(); ?>" <?php post_class( 'clearfiks' ); ?>>
		  <h1><?php the_title(); ?></h1>
		  <?php the_content(); ?>	
		</article>

		<?php get_sidebar(); ?>

	</div> <?php // .ramme ?>

<?php get_footer(); ?>