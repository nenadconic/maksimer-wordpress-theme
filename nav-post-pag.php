<?php
	$args = array(
		'prev_text'          => __( 'Previous page', 'maksimer_lang' ),
		'next_text'          => __( 'Next page', 'maksimer_lang' ),
		'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'maksimer_lang' ) . ' </span>',
	);
	the_posts_pagination( $args );
?>