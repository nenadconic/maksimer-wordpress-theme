<?php get_header(); ?>

	<div class="ramme">

		<article class="innhold-404">
			<h1><?php _e('404 - Kunne ikke finne siden', 'maksimer_lang'); ?></h1>
			<h2><?php _e('Siden du leter etter eksisterer ikke', 'maksimer_lang'); ?>.</h2>
			<p><a href="<?php echo home_url(); ?>" class="knapp"><?php _e('Forsiden', 'maksimer_lang'); ?></a></p>
		</article>

		<?php get_sidebar(); ?>

	</div> <?php // .ramme ?>

<?php get_footer(); ?>