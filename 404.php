<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package maksimer
 */

get_header();
?>

	<main role="main" id="main-content" class="main-content-wrap">

		<article class="content-404">

			<div class="entry-content">

				<h1><?php esc_attr_e( '404 - Page not found', 'maksimer-lang' ); ?></h1>
				<h2><?php esc_attr_e( 'The page you are looking for does not exist', 'maksimer-lang' ); ?></h2>
				<p><a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php esc_attr_e( 'Home Page', 'maksimer-lang' ); ?></a></p>

			</div>

		</article>

	</main>

<?php get_footer(); ?>
