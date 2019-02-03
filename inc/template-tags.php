<?php
/**
 * Custom template tags (Functions used elsewhere in theme).
 *
 * @package maksimer
 */

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function maksimer_thumbnail( $size = 'post-thumbnail' ) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :

		echo '<div class="post-thumbnail">';
		the_post_thumbnail( $size );
		echo '</div>';

	else :

		echo '<a class="post-thumbnail" href="' . get_the_permalink() . '" aria-hidden="true" tabindex="-1">';
		the_post_thumbnail(
			$size,
			array(
				'alt' => the_title_attribute(
					array(
						'echo' => false,
					)
				),
			)
		);
		echo '</a>';

	endif;
}
