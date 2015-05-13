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

<section id="<?php echo $section_id; ?>" class="innholdsbygger-seksjon en-kolonne">

	<div class="innholdsbygger-seksjon-innhold" style="<?php echo $stiler; ?>">

		<div class="ramme">

			<?php the_sub_field( 'innhold' ); ?>

		</div> <?php // .ramme ?>

	</div> <?php // .innholdsbygger-seksjon-innhold ?>

</section> <?php // .en-kolonne ?>