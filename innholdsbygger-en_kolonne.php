<?php
	global $innholdsbygger_teller;
	$bakgrunn_farge = maksimer_bg_farge();
	$tekst_farge = maksimer_tekst_farge();
	$padding = maksimer_padding();
?>
<section id="innholdsbygger-seksjon-<?php echo $innholdsbygger_teller; ?>" class="innholdsbygger-seksjon en-kolonne<?php echo $padding; ?>" style="<?php echo $bakgrunn_farge . $tekst_farge; ?>">

	<div class="ramme">

		<?php the_sub_field( 'innhold' ); ?>

	</div>

</section> <?php // .en-kolonne ?>