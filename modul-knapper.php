<?php
	// Fra WP
	$bakgrunn_farge = maksimer_bg_farge();
	$luft_over      = maksimer_luft_over();
	$luft_under     = maksimer_luft_under();
	$unik_id        = get_sub_field( 'unik_id' );

	// Variabler
	$stiler  = '';
	$stiler .= $bakgrunn_farge;
	$stiler .= $luft_over;
	$stiler .= $luft_under;

	if ( !empty( $unik_id ) ) {
		$section_id = 'id="' . $unik_id . '"';
	} else {
		$section_id = false;
	}
?>

<section <?php echo $section_id; ?> class="innholdsbygger-seksjon modul-knapper">

	<div class="innhold" style="<?php echo $stiler; ?>">

		<div class="ramme">

			<?php while ( have_rows( 'knapper' ) ) : the_row(); ?>

				<?php
					$tekst = get_sub_field( 'tekst' );
					$link_type = get_sub_field( 'velg_link_type' );
					if ( 'intern' == $link_type ) {
						$link = get_sub_field( 'velg_side' );
						$target = '';
					} elseif ( 'ekstern' == $link_type ) {
						$link = get_sub_field( 'url' );
						$target = ' target="blank"';
					} else {
						return false;
					}

					// Knappen
					echo '<a href="' . $link . '"' . $target . 'class="knapp">' . $tekst . '</a>';
				?>

			<?php endwhile; ?>

		</div> <?php // .ramme ?>

	</div> <?php // .innhold ?>

</section> <?php // .knapper ?>