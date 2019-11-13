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

			<div class="entry-content">

				<h1><?php the_title(); ?></h1>

				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>

			</div>

		</article>

	</main>

<?php get_footer(); ?>
