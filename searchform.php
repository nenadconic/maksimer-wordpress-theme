<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="skjult"><?php _e( 'Søk etter:', 'maksimer_lang' ); ?></span>
		<input type="search" class="sok-felt" placeholder="<?php _e( 'Søk etter:', 'maksimer_lang' ); ?>" value="<?php the_search_query() ?>" name="s" title="<?php _e( 'Søk etter:', 'maksimer_lang' ); ?>" />
	</label>
	<input type="submit" class="sok-knapp knapp" value="<?php _e( 'Søk', 'maksimer_lang' ); ?>" />
</form>