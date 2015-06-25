<article id="post-id-<?php the_id(); ?>" <?php post_class(); ?>>
	<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
	<?php the_excerpt(); ?>
</article>