<?php
	// Custom fields from WordPress
	$background_color = maksimer_css_compiler( get_sub_field( 'bakgrunnsfarge' ), 'background' );
	$text_color       = maksimer_css_compiler( get_sub_field( 'tekstfarge' ), 'color' );
	$space_above      = maksimer_css_compiler( get_sub_field( 'luft_over' ), 'padding-top' );
	$space_below      = maksimer_css_compiler( get_sub_field( 'luft_under' ), 'padding-bottom' );
	$unique_id        = get_sub_field( 'unik_id' );

	// Variables
	$style  = '';
	$style .= $background_color;
	$style .= $text_color;
	$style .= $space_above;
	$style .= $space_below;

	if ( !empty( $unique_id ) ) {
		$section_id = 'id="' . $unique_id . '"';
	} else {
		$section_id = false;
	}
?>

<section <?php echo $section_id; ?> class="module module-two-column">

	<div class="content" style="<?php echo $style; ?>">

		<div class="wrapper">

			<div class="col-set col-2">

				<div class="col">
					<?php the_sub_field( 'venstre' ); ?>
				</div> <?php // .col ?>

				<div class="col">
					<?php the_sub_field( 'hoyre' ); ?>
				</div> <?php // .col ?>

			</div> <?php // .col-set ?>

		</div> <?php // .wrapper ?>

	</div> <?php // .two-column ?>

</section>