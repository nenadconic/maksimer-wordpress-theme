<?php
/**
 * Template part for displaying post content in post loop's
 *
 * @package maksimer
 */
?>

<article id="post-id-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php maksimer_thumbnail(); ?>

	<h3>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>

	<?php the_excerpt(); ?>

</article>
