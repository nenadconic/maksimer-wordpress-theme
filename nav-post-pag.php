<?php
	$args = array(
		'prev_text'          => __( 'Forrige side', 'maksimer_lang' ),
		'next_text'          => __( 'Neste side', 'maksimer_lang' ),
		'before_page_number' => '<span class="screen-reader-text">' . __( 'Side', 'maksimer_lang' ) . ' </span>',
	);
	the_posts_pagination( $args );
?>