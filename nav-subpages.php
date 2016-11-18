<?php
	$family_tree_arr = get_post_ancestors( $post->ID );
	$family_tree     = array_reverse( $family_tree_arr );

	if ( !empty( $family_tree_arr ) ) {
		$family_tree_top = $family_tree[0];
	} else {
		$family_tree_top = $post->ID;
	}

	$subpages = get_pages( 'child_of=' . $family_tree_top );
	$no_parent = is_search() || is_404();

	if ( ! $no_parent && ( count( $subpages ) != 0 ) ) :
?>
	<section class="subpages-menu">
		<nav class="subpages" role="navigation" aria-label="<?php _e( 'Subpages', 'maksimer_lang' ); ?>">

			<h6>
				<a href="<?php echo get_the_permalink( $family_tree_top ); ?>">
					<?php echo get_the_title( $family_tree_top ); ?>
				</a>
			</h6>

			<ul class="menu">
				<?php
					$args = array(
						'title_li'    => '',
						'child_of'    => $family_tree_top,
						'depth'       => 3,
						'sort_column' => 'menu_order',
						'sort_order'  => 'ASC',
					);
					wp_list_pages( $args );
				?>
			</ul>

		</nav>
	</section>
<?php endif; ?>
