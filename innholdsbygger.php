<?php
	$innholdsbygger = get_field( 'innholdsbygger' );
	if ( function_exists ( 'get_row_layout' ) && !empty( $innholdsbygger ) ) :

		while ( has_sub_field( 'innholdsbygger' ) ) :

			get_template_part( 'modul', get_row_layout() );

		endwhile;

	else :
?>

	<div class="ramme">
		<?php the_content(); ?>
	</div>

<?php
	endif;
?>