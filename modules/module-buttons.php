<?php
	// Custom fields from WordPress
	$background_color = maksimer_css_compiler( get_sub_field( 'background_color' ), 'background' );
	$space_above      = maksimer_css_compiler( get_sub_field( 'padding_top' ), 'padding-top' );
	$space_below      = maksimer_css_compiler( get_sub_field( 'padding_bottom' ), 'padding-bottom' );
	$unique_id        = get_sub_field( 'unique_id' );

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
				while ( have_rows( 'buttons' ) ) : the_row();

					$label     = get_sub_field( 'text' );
					$link_type = get_sub_field( 'choose_type_of_link' );

					if ( 'internal' == $link_type ) {

						$link   = get_sub_field( 'select_page' );
						$target = '';

					} elseif ( 'external' == $link_type ) {

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