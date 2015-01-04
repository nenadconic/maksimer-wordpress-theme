<?php
	global $innholdsbygger_teller;
	$bakgrunn_farge = maksimer_bg_farge();
	$padding = maksimer_padding();
?>
<section id="innholdsbygger-seksjon-<?php echo $innholdsbygger_teller; ?>" class="innholdsbygger-seksjon knapper<?php echo $padding; ?>" style="<?php echo $bakgrunn_farge; ?>">

	<?php if ( have_rows( 'knapper' ) ) : ?>

		<div class="ramme">

			<?php while ( have_rows( 'knapper' ) ) : the_row(); ?>

				<a href="<?php the_sub_field( 'link' ); ?>" class="knapp">
					<?php the_sub_field( 'tekst' ); ?>
				</a> 

			<?php endwhile; ?>

		</div>

	<?php endif; ?>

</section> <?php // .knapper ?>