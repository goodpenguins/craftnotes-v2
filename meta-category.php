<div class='post-category'>
	<?php
	$categories = get_the_category(get_the_ID());
	if ($categories) :

		echo '<div class="wp-block-buttons d-flex justify-content-center align-items-center mb-3">';

		foreach($categories as $category) :
			
			$classes = strtolower( get_field( 'color_taxonomy', $category->taxonomy . '_' . $category->term_id ) ); ?>
			
			<div class="wp-block-button mx-1" >
				<a href="<?=esc_url(get_category_link($category->term_id))?>" class="wp-block-button__link <?=$classes?> px-3 py-1" >
					<?=esc_html($category->name)?>
				</a>
			</div>
			
		<?php
		endforeach;

		echo '</div>';

	endif; ?>
</div>