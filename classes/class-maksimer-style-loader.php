<?php
/**
 * Style Loader Class
 *
 * Allow `async` and `defer` while enqueuing styles.
 *
 * Based on TwentyTwenty's Javascript Loader Class.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

if ( ! class_exists( 'Maksimer_Style_Loader' ) ) {
	/**
	 * A class that provides a way to add `async` or `defer` attributes to styles.
	 */
	class Maksimer_Style_Loader {

		/**
		 * Adds async/defer attributes to enqueued / registered styles.
		 *
		 * If #12009 lands in WordPress, this function can no-op since it would be handled in core.
		 *
		 * @link https://core.trac.wordpress.org/ticket/12009
		 *
		 * @param string $html    The link tag for the enqueued style
		 * @param string $handle  The script handle.
		 * @return string         Script HTML string.
		 */
		public function filter_style_loader_tag( $html, $handle, $href, $media ) {
			foreach ( [ 'async', 'defer' ] as $attr ) {
				if ( ! wp_styles()->get_data( $handle, $attr ) ) {
					continue;
				}
				//print_r(get_defined_vars());
				// Prevent adding attribute when already added in #12009.
				if ( ! preg_match( ":\s$attr(=|>|\s):", $html ) ) {
					$tag = preg_replace( ':(?=></script>):', " $attr", $html, 1 );
				}
				// Only allow async or defer, not both.
				break;
			}
			return $tag;
		}

	}
}
