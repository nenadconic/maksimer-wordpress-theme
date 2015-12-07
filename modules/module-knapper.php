<?php
	// Custom fields from WordPress
	$background_color = maksimer_css_compiler( get_sub_field( 'bakgrunnsfarge' ), 'background' );
	$space_above      = maksimer_css_compiler( get_sub_field( 'luft_over' ), 'padding-top', '', 'px' );
	$space_below      = maksimer_css_compiler( get_sub_field( 'luft_under' ), 'padding-bottom', '', 'px' );
	$unique_id        = get_sub_field( 'unik_id' );

	// Variabler
	$style  = '';
	$style .= $background_color;
	$style .= $space_above;
	$style .= $space_below;

	if ( !empty( $unique_id ) ) {
		$section_id = 'id="' . $unique_id . '"';
	} else {
		$section_id = false;
	}
?>

<section <?php echo $section_id; ?> class="module module-buttons">

	<div class="content" style="<?php echo $style; ?>">

		<div class="wrapper">

			<?php
				while ( have_rows( 'knapper' ) ) : the_row();

					$label     = get_sub_field( 'tekst' );
					$link_type = get_sub_field( 'velg_link_type' );

					if ( 'intern' == $link_type ) {

						$link   = get_sub_field( 'velg_side' );
						$target = '';

					} elseif ( 'ekstern' == $link_type ) {

						$link   = get_sub_field( 'url' );
						$target = ' target="blank"';

					} else {

						return false;

					}

					echo '<a href="' . $link . '"' . $target . 'class="button">' . $label . '</a>';

				endwhile;
			?>

		</div> <?php // .wrapper ?>

	</div> <?php // .content ?>

</section>