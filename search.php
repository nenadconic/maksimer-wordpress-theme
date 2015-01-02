<?php get_header(); ?>

	<div class="ramme">

		<?php if ( have_posts() && ! ( empty( $_GET['s'] ) ) ) : ?>

			<h2><?php _e('Søkeresultater', 'maksimer_lang'); ?></h2>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-id-<?php the_id(); ?>" <?php post_class( 'clearfiks' ); ?>>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<?php
						$yoast_desc = get_field( '_yoast_wpseo_metadesc' );
						if ( ! empty( $yoast_desc ) ) :
					?>
						<p><?php echo $yoast_desc; ?></p>
					<?php else : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
				</article>

			<?php endwhile; ?>

			<?php get_template_part( 'nav', 'post-pag' ); ?>

		<?php elseif ( empty( $_GET['s'] ) ) : ?>

			<?php
				// Videresender til forsiden hvis man ikke søker etter noe
				wp_redirect( home_url() );
				exit;
			?>

		<?php else: ?>

			<h2><?php _e( 'Ingen treff', 'maksimer_lang' ); ?></h2>

		<?php endif; ?>

	</div> <?php //.ramme ?>

<?php get_footer(); ?>