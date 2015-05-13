<?php
	$innholdsbygger = get_field( 'innholdsbygger' );
	if ( function_exists ( 'get_row_layout' ) && !empty( $innholdsbygger ) ) :

		global $innholdsbygger_teller;
		$innholdsbygger_teller = 1;

		while ( has_sub_field( 'innholdsbygger' ) ) :

			get_template_part( 'innholdsbygger', get_row_layout() );

			$innholdsbygger_teller++;

		endwhile;

	else :
?>

	<div class="ramme">
		<?php the_content(); ?>
	</div>

<?php
	endif;
?>