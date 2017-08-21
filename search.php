<?php
	if ( empty( $_GET['s'] ) ) {
		// Redirect back to homepage on empty search
		wp_redirect( home_url() );
		exit;
	}
?>

<?php get_header(); ?>

	<main role="main" id="main-content" class="main-content-wrap">

		<div class="wrapper">

			<?php if ( have_posts() && ( ! empty( $_GET['s'] ) ) ) : ?>

				<h2><?php _e( 'Search results', 'maksimer_lang' ); ?></h2>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-id-<?php the_id(); ?>" <?php post_class( 'clearfix' ); ?>>

						<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

						<?php
							$yoast_desc = get_post_meta( $post->ID, '_yoast_wpseo_metadesc' );
							if ( ! empty( $yoast_desc ) ) {
								echo '<p>' . $yoast_desc[0] . '</p>';
							} else {
								the_excerpt();
							}
						?>

					</article>

				<?php endwhile; ?>

				<?php get_template_part( 'nav', 'post-pag' ); ?>

			<?php else : ?>

				<h2><?php _e( 'No post found', 'maksimer_lang' ); ?></h2>

			<?php endif; ?>

		</div>

	</main>

<?php get_footer(); ?>
