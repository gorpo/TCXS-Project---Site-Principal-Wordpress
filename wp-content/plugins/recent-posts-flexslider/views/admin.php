<style>
#rpf-settings-grid {
	display: grid;
	grid-template-columns: 1fr 1fr;
	grid-column-gap: 24px;
	grid-row-gap: 24px;
	margin: 16px 0;
	min-height: 0;
	min-width: 0;
}
#rpf-settings-grid div,
#rpf-settings-grid input[type="text"],
#rpf-settings-grid input[type="number"],
#rpf-settings-grid select {
	max-width: 100%;
	min-height: 0;
	min-width: 0;
	width: 100%;
}
#rpf-settings-grid div:not(.checkbox-wrap) label {
	margin-bottom: 4px;
}
#rpf-settings-grid div {
	display: flex;
	flex-direction: column;
	justify-content: space-between;
}
#rpf-settings-grid .checkbox-wrap {
	display: block;
}
#rpf-settings-grid .span-two-cols {
	grid-column: span 2;
}
</style>

<div id="rpf-settings-grid">

	<div class="span-two-cols">
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title', 'recent-posts-flexslider' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" type="text" />
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php esc_attr_e( 'Filter by Category', 'recent-posts-flexslider' ); ?></label>
		<?php
		wp_dropdown_categories(
			array(
				'name'            => esc_attr( $this->get_field_name( 'categories' ) ),
				'selected'        => $instance['categories'],
				'orderby'         => 'Name',
				'hierarchical'    => 1,
				'show_option_all' => 'All Categories',
				'hide_empty'      => '0',
			)
		);
		?>
		<?php
		$post_type_args = array (
			'public' => true,
		);
		$post_types = get_post_types( $post_type_args );
		unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );
		?>
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>"><?php esc_attr_e( 'Filter by Post Type', 'recent-posts-flexslider' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
		<?php
		foreach ( $post_types as $post_type ) {
			$post_type_object = get_post_type_object( $post_type );
			?>
					<option value="<?php echo esc_attr( $post_type ); ?>" <?php selected( $post_type, $instance['post_type'], true ); ?>>
						<?php echo esc_attr( $post_type_object->label ); ?>
					</option>
				<?php } ?>
		</select>
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'slider_duration' ) ); ?>"><?php echo wp_kses( 'Slider Duration - Length of time to change slides <em>(In milliseconds)</em>', 'recent-posts-flexslider' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'slider_duration' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_duration' ) ); ?>" value="<?php echo esc_attr( $instance['slider_duration'] ); ?>" type="number" />
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'slider_pause' ) ); ?>"><?php echo wp_kses( 'Slider Pause - Length of time to pause on a slide <em>(In milliseconds)</em>', 'recent-posts-flexslider' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'slider_pause' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_pause' ) ); ?>" value="<?php echo esc_attr( $instance['slider_pause'] ); ?>" type="number" />
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'slider_count' ) ); ?>"><?php esc_attr_e( 'Number of slides to display', 'recent-posts-flexslider' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'slider_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_count' ) ); ?>" value="<?php echo esc_attr( $instance['slider_count'] ); ?>" type="number" />
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'slider_height' ) ); ?>"><?php echo wp_kses( 'Slider Height <em>(In pixels)</em>', 'recent-posts-flexslider' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'slider_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_height' ) ); ?>" value="<?php echo esc_attr( $instance['slider_height'] ); ?>" type="number" />
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>"><?php esc_attr_e( 'Image Size', 'recent-posts-flexslider' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'image_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_size' ) ); ?>" class="widefat">
			<option value="full" <?php selected( $instance['image_size'], 'full' ); ?>>Full Size</option>
			<?php
			global $_wp_additional_image_sizes;

			foreach ( get_intermediate_image_sizes() as $s ) {
				$sizes[ $s ] = array( 0, 0 );
				if ( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ) {
					$sizes[ $s ][0] = get_option( $s . '_size_w' );
					$sizes[ $s ][1] = get_option( $s . '_size_h' );
				} else {
					if ( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) ) {
						$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'] );
					}
				}
			}

			$option_image_size = '';
			foreach ( $sizes as $size => $atts ) {
				$option_image_size     .= '<option value="' . esc_attr( $size ) . '"' . esc_attr( selected( $instance['image_size'], $size, false ) ) . '>';
					$option_image_size .= ucwords( preg_replace( '/-/', ' ', $size ) ) . ' (' . implode( 'x', $atts ) . ')';
				$option_image_size     .= '</option>';
			}
			echo $option_image_size;
			?>
		</select>
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'slider_animate' ) ); ?>"><?php esc_attr_e( 'Slider Animation', 'recent-posts-flexslider' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'slider_animate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_animate' ) ); ?>">
			<option value="slide" <?php selected( 'slide', $instance['slider_animate'], true ); ?>>slide</option>
			<option value="fade" <?php selected( 'fade', $instance['slider_animate'], true ); ?>>fade</option>
		</select>
	</div>

	<div class="checkbox-wrap">
		<input class="checkbox" type="checkbox" <?php checked( $instance['post_title'], 'true' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'post_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_title' ) ); ?>" value="true" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_title' ) ); ?>"><?php esc_attr_e( 'Show Post Title', 'recent-posts-flexslider' ); ?></label>
	</div>

	<div class="checkbox-wrap">
		<input class="checkbox" type="checkbox" <?php checked( $instance['post_link'], 'true' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'post_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_link' ) ); ?>" value="true" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_link' ) ); ?>"><?php esc_attr_e( 'Link Slide to Post', 'recent-posts-flexslider' ); ?></label>
	</div>

	<div class="checkbox-wrap">
		<input class="checkbox" type="checkbox" <?php checked( $instance['slider_control'], 'true' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'slider_control' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_control' ) ); ?>" value="true" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'slider_control' ) ); ?>"><?php esc_attr_e( 'Show Slide Controls', 'recent-posts-flexslider' ); ?></label>
	</div>

	<div class="checkbox-wrap">
		<input class="checkbox" type="checkbox" <?php checked( $instance['slider_direction'], 'true' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'slider_direction' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'slider_direction' ) ); ?>" value="true" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'slider_direction' ) ); ?>"><?php esc_attr_e( 'Show Slide Navigation', 'recent-posts-flexslider' ); ?></label>
	</div>

	<div class="checkbox-wrap span-two-cols">
		<input class="checkbox" type="checkbox" <?php checked( $instance['only_thumb_post'], 'true' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'only_thumb_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'only_thumb_post' ) ); ?>" value="true" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'only_thumb_post' ) ); ?>"><?php esc_attr_e( 'Only show posts with featured image', 'only_thumb_post' ); ?></label>
	</div>

	<div class="checkbox-wrap">
		<input class="checkbox" type="checkbox" <?php checked( $instance['post_excerpt'], 'true' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'post_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_excerpt' ) ); ?>" value="true" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_excerpt' ) ); ?>"><?php esc_attr_e( 'Show Post Excerpt', 'recent-posts-flexslider' ); ?></label>
	</div>

	<div>
		<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>"><?php echo wp_kses( 'Excerpt Length <em>(in words)</em>', 'recent-posts-flexslider' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_length' ) ); ?>" value="<?php echo esc_attr( $instance['excerpt_length'] ); ?>" type="text" />
	</div>

</div>
