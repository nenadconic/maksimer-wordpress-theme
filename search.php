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

	<main role="main" id="main-content" class="main-content-wrap">

		<?php
		if ( have_posts() ) {

			echo '<h1>' . esc_attr__( 'Search results', 'maksimer-lang' ) . '</h1>';

			while ( have_posts() ) :
				the_post();
				get_template_part( 'loop', 'search' );
			endwhile;

			the_posts_navigation();

		} else {

			echo '<h1>' . esc_attr__( 'No post found!', 'maksimer-lang' ) . '</h1>';

		}
		?>

	</main>

<?php get_footer(); ?>
