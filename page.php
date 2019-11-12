<?php
/**
 * The template for displaying all pages
 *
 * @package maksimer
 */

get_header();
?>

	<main role="main" id="main-content" class="main-content-wrap">

		<article id="post-id-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</article>

	</main>

<?php get_footer(); ?>
