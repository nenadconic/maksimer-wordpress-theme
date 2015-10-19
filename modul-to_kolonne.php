<?php
	// Fra WP
	$bakgrunn_farge = maksimer_css_compiler( get_sub_field( 'bakgrunnsfarge' ), 'background' );
	$tekst_farge    = maksimer_css_compiler( get_sub_field( 'tekstfarge' ), 'color' );
	$luft_over      = maksimer_css_compiler( get_sub_field( 'luft_over' ), 'padding-top', '', 'px' );
	$luft_under     = maksimer_css_compiler( get_sub_field( 'luft_under' ), 'padding-bottom', '', 'px' );
	$unik_id        = get_sub_field( 'unik_id' );

	// Variabler
	$stiler  = '';
	$stiler .= $bakgrunn_farge;
	$stiler .= $tekst_farge;
	$stiler .= $luft_over;
	$stiler .= $luft_under;

	if ( !empty( $unik_id ) ) {
		$section_id = 'id="' . $unik_id . '"';
	} else {
		$section_id = false;
	}
?>

<section <?php echo $section_id; ?> class="innholdsbygger-seksjon modul-to-kolonne">

	<div class="innhold" style="<?php echo $stiler; ?>">

		<div class="ramme">

			<div class="to-kolonne">

				<div class="kol">
					<?php the_sub_field( 'venstre' ); ?>
				</div> <?php // .kol ?>

				<div class="kol">
					<?php the_sub_field( 'hoyre' ); ?>
				</div> <?php // .kol ?>

			</div> <?php // .to-kolonne ?>

		</div> <?php // .ramme ?>

	</div> <?php // .innholdsbygger-seksjon-innhold ?>

</section>