<?php
	$stamfar_id = stamfar_id();
	$undersider = get_pages( 'child_of='.$stamfar_id );
	$utenforeldre = is_search() || is_404();
	if ( ! $utenforeldre && ( count( $undersider ) != 0 ) ) :
?>
	<section id="undersider-liste">
		<nav id="undersider" class="meny" role="navigation" aria-label="Undersider">
			<h6>
				<a href="<?php echo get_the_permalink( $stamfar_id ); ?>">
					<?php echo get_the_title( $stamfar_id ); ?>
				</a>
			</h6>
			<ul class="menu">
				<?php
					$args = array(
						'title_li'    => '',
						'child_of'    => $stamfar_id,
						'depth'       => 3,
						'sort_column' => 'menu_order',
						'sort_order'  => 'ASC'
					);
					wp_list_pages( $args );
				?>
			</ul>
		</nav>
	</section>
<?php endif; ?>