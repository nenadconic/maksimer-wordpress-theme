<form method="get" class="sok-skjema" action="<?php bloginfo( 'url' ); ?>/">
	<label class="skjult" for="s"><?php _e( 'Søk etter', 'maksimer_lang' ); ?></label>
	<input type="text" value="<?php the_search_query(); ?>" name="s" class="sok-felt" />
	<button type="submit" class="sok-knapp knapp"><?php _e( 'Søk', 'maksimer_lang' ); ?></button>
</form>