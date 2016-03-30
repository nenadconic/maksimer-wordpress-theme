<?php
	// Custom fields from WordPress
	$background_color = maksimer_css_compiler( get_sub_field( 'background_color' ), 'background' );
	$text_color       = maksimer_css_compiler( get_sub_field( 'text_color' ), 'color' );
	$space_above      = maksimer_css_compiler( get_sub_field( 'padding_top' ), 'padding-top' );
	$space_below      = maksimer_css_compiler( get_sub_field( 'padding_bottom' ), 'padding-bottom' );
	$unique_id        = get_sub_field( 'unique_id' );

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
					<?php the_sub_field( 'left' ); ?>
				</div> <?php // .col ?>

				<div class="col">
					<?php the_sub_field( 'right' ); ?>
				</div> <?php // .col ?>

			</div> <?php // .col-set ?>

		</div> <?php // .wrapper ?>

	</div> <?php // .two-column ?>

</section>