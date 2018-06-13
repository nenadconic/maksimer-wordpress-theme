<?php
/**
 * The template for displaying search form
 *
 * @package maksimer
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="hidden"><?php esc_attr_e( 'Search for…', 'maksimer-lang' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search for…', 'maksimer-lang' ); ?>" value="<?php the_search_query(); ?>" name="s" id="s" title="<?php esc_attr_e( 'Search for…', 'maksimer-lang' ); ?>" />
	</label>
	<input type="submit" class="search-button button" value="<?php esc_attr_e( 'Search', 'maksimer-lang' ); ?>" />
</form>
