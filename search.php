<?php
/**
 * The template for displaying search results pages
 *
 * @package maksimer
 */

// Redirect back to homepage on empty search.
if ( empty( $_GET['s'] ) ) {
	wp_redirect( home_url() );
	exit;
}

get_header();
?>

	<div class="wrapper">

		<main role="main" id="main-content" class="main-content-wrap">

			<?php if ( have_posts() && ( ! empty( $_GET['s'] ) ) ) : ?>

				<h1>
					<?php esc_attr_e( 'Search results', 'maksimer-lang' ); ?>
				</h1>

				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'loop', 'search' );
				endwhile;

				the_posts_navigation();
				?>

			<?php else : ?>

				<h1>
					<?php esc_attr_e( 'No post found!', 'maksimer-lang' ); ?>
				</h1>

			<?php endif; ?>

		</main>

	</div>

<?php get_footer(); ?>
