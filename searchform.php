<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="hidden"><?php _e( 'Search for…', 'maksimer_lang' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e( 'Search for…', 'maksimer_lang' ); ?>" value="<?php the_search_query() ?>" name="s" id="s" title="<?php _e( 'Search for…', 'maksimer_lang' ); ?>" />
	</label>
	<input type="submit" class="search-button button" value="<?php _e( 'Search', 'maksimer_lang' ); ?>" />
</form>