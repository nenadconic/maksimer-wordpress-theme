<?php
/**
 * Template part for displaying a single result in search results
 *
 * @package maksimer
 */
?>

<article id="post-id-<?php the_ID(); ?>" <?php post_class(); ?>>

	<h3>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>

	<?php
	$yoast_desc = get_post_meta( $post->ID, '_yoast_wpseo_metadesc', true );

	if ( ! empty( $yoast_desc ) ) {
		echo '<p>' . $yoast_desc . '</p>';
	} else {
		the_excerpt();
	}
	?>

</article>
