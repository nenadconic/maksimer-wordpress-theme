<?php
/**
 * The template for displaying all single posts
 *
 * @package maksimer
 */

get_header();
?>

	<div class="wrapper">

		<main role="main" id="main-content" class="main-content-wrap">

			<article id="post-id-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</article>

		</main>

	</div>

<?php get_footer(); ?>
