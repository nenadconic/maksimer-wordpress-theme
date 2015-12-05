<?php
	// Custom fields from WordPress
	$background_color = maksimer_css_compiler( get_sub_field( 'bakgrunnsfarge' ), 'background' );
	$text_color       = maksimer_css_compiler( get_sub_field( 'tekstfarge' ), 'color' );
	$space_above      = maksimer_css_compiler( get_sub_field( 'luft_over' ), 'padding-top', '', 'px' );
	$space_below      = maksimer_css_compiler( get_sub_field( 'luft_under' ), 'padding-bottom', '', 'px' );
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

<section <?php echo $section_id; ?> class="module module-one-column">

	<div class="content" style="<?php  ?>">

		<div class="wrapper">

			<?php the_sub_field( 'innhold' ); ?>

		</div> <?php // .wrapper ?>

	</div> <?php // .content ?>

</section> <?php // .one-column ?>