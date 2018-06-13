<?php
	$args = array(
		'prev_text'          => __( 'Previous page', 'maksimer-lang' ),
		'next_text'          => __( 'Next page', 'maksimer-lang' ),
		'before_page_number' => '<span class="screen-reader-text">' . __( 'Page', 'maksimer-lang' ) . ' </span>',
	);
	the_posts_pagination( $args );
