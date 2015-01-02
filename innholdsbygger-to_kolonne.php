<?php
	global $innholdsbygger_teller;
	$bakgrunn_farge = maksimer_bg_farge();
	$tekst_farge = maksimer_tekst_farge();
	$padding = maksimer_padding();
?>
<section id="innholdsbygger-seksjon-<?php echo $innholdsbygger_teller; ?>" class="innholdsbygger-seksjon to-kolonne<?php echo $padding; ?>" style="<?php echo $bakgrunn_farge . $tekst_farge; ?>">

	<div class="ramme">

		<div class="venstre">
			<?php the_sub_field( 'venstre' ); ?>
		</div> <?php // .venstre ?>

		<div class="hoyre">
			<?php the_sub_field( 'hoyre' ); ?>
		</div> <?php // .hoyre ?>

	</div>

</section> <?php // .to-kolonne ?>