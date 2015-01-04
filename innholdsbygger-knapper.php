<?php
	global $innholdsbygger_teller;
	$bakgrunn_farge = maksimer_bg_farge();
	$padding = maksimer_padding();
?>
<section id="innholdsbygger-seksjon-<?php echo $innholdsbygger_teller; ?>" class="innholdsbygger-seksjon knapper<?php echo $padding; ?>" style="<?php echo $bakgrunn_farge; ?>">

	<?php if ( have_rows( 'knapper' ) ) : ?>

		<div class="ramme">

			<?php while ( have_rows( 'knapper' ) ) : the_row(); ?>

				<?php
					$tekst = get_sub_field( 'tekst' );
					$link_type = get_sub_field( 'velg_link_type' );
					if ( 'intern' == $link_type ) {
						$link = get_sub_field( 'velg_side' );
					} elseif ( 'ekstern' == $link_type ) {
						$link = get_sub_field( 'url' );
					} else {
						return false;
					}
				?>

				<a href="<?php echo $link; ?>"<?php if ( 'ekstern' == $link_type ) : ?> target="_blank"<?php endif; ?> class="knapp">
					<?php echo $tekst; ?>
				</a>

			<?php endwhile; ?>

		</div>

	<?php endif; ?>

</section> <?php // .knapper ?>