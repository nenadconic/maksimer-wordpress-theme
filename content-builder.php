<?php
	if ( function_exists( 'get_row_layout' ) ) {
		$content_builder = get_field( 'innholdsbygger' );
	} else {
		$content_builder = false;
	}

	if ( !empty( $content_builder ) ) {

		while ( has_sub_field( 'innholdsbygger' ) ) :
			get_template_part( 'modules/module', get_row_layout() );
		endwhile;

	} else {

		echo '<div class="wrapper">';
			the_content();
		echo '</div>';

	}

?>