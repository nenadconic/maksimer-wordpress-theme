<?php
/**
 * The template for displaying the footer
 *
 * @package maksimer
 */
?>

		<footer class="footer">
			<?php echo esc_attr( date( 'Y' ) ); ?> <a href="http://www.maksimer.no/" target="_blank"><?php esc_attr_e( 'Maksimer', 'maksimer-lang' ); ?></a>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>
