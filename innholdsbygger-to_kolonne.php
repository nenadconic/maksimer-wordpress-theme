<?php
	global $innholdsbygger_teller;

	// Fra WP
	$bakgrunn_farge = maksimer_bg_farge();
	$tekst_farge    = maksimer_tekst_farge();
	$luft_over      = maksimer_luft_over();
	$luft_under     = maksimer_luft_under();
	$unik_id        = get_sub_field( 'unik_id' );

	// Variabler
	$stiler .= $bakgrunn_farge;
	$stiler .= $tekst_farge;
	$stiler .= $luft_over;
	$stiler .= $luft_under;

	if ( isset( $unik_id ) ) {
		$section_id = $unik_id;
	} else {
		$section_id = 'innholdsbygger-seksjon-' . $innholdsbygger_teller;
	}
?>

<section id="<?php echo $section_id; ?>" class="innholdsbygger-seksjon to-kolonne">

	<div class="innholdsbygger-seksjon-innhold" style="<?php echo $stiler; ?>">

		<div class="ramme">

			<div class="venstre">
				<?php the_sub_field( 'venstre' ); ?>
			</div> <?php // .venstre ?>

			<div class="hoyre">
				<?php the_sub_field( 'hoyre' ); ?>
			</div> <?php // .hoyre ?>

		</div> <?php // .ramme ?>

	</div> <?php // .innholdsbygger-seksjon-innhold ?>

</section> <?php // .to-kolonne ?>