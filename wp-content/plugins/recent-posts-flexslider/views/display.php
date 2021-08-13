<?php
// Frontend View of Slider

// Enqueue Stylesheet and Script only where loaded
wp_enqueue_style( 'recent-posts-flexslider-style' );
wp_enqueue_script( 'recent-posts-flexslider-script' );

// Set defaults for slider options
if ( empty( $slider_pause ) || ! isset( $slider_pause ) ) {
	$slider_pause = 5000;
}
if ( empty( $slider_duration ) || ! isset( $slider_duration ) ) {
	$slider_duration = 1000;
}
if ( empty( $slider_control ) || ! isset( $slider_control ) ) {
	$slider_control = 'true';
}
if ( empty( $slider_direction ) || ! isset( $slider_direction ) ) {
	$slider_direction = 'true';
}

// Query DB for slides
$flex_args = array(
	'cat'                 => $categories,
	'post_status'         => 'publish',
	'post_type'           => $post_type_array,
	'showposts'           => $slider_count,
	'ignore_sticky_posts' => true,
);

if ( 'true' == esc_attr( $only_thumb_post ) ) {
	$flex_args['meta_query'] = array(
		array(
			'key'     => '_thumbnail_id',
			'compare' => 'EXISTS',
		),
	);
}

$flex_query = new WP_Query( $flex_args );

// Call class to display slider
$display = new Recent_Posts_FlexSlider();


/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

if ( $title ) {
	echo $args['before_title'] . $title . $args['after_title'];
}

?>


<div id="slider-wrap">
	<div class="flexslider"
	<?php
	/* Remove margin if only one slide */ if ( 'true' === $slider_count ) {
		echo 'style="margin: 0;"'; }
	?>
	>
		<ul class="slides">
			<?php
			if ( $flex_query->have_posts() ) :
				while ( $flex_query->have_posts() ) :
					$flex_query->the_post();
					$output = '<li style="max-height: ' . $slider_height . 'px;">';

					// Start link of slide to post (option set on Appearance->Widgets)
					if ( 'true' === $post_link ) {
						$output .= '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
					}

					// Display Post Title and/or Excerpt (option set on Appearance->Widgets)
					if ( 'true' === $post_title || 'true' === $post_excerpt ) {
						$output .= '<div class="flexslider-caption"><div class="flexslider-caption-inner">';
						if ( 'true' === $post_title ) {
							$output .= '<h3>' . get_the_title() . '</h3>';
						}
						if ( 'true' === $post_excerpt ) {
							$output .= '<p>' . $display->recent_post_flexslider_excerpt( get_the_content(), $excerpt_length ) . '</p>';
						}
						$output .= '</div></div>';
					}

					$output     .= '<div class="slide-image-container" style="max-height: ' . $slider_height . 'px">';
						$output .= $display->get_recent_post_flexslider_image( $image_size );
					$output     .= '</div>';

					// End link of slide to post (if option is selected in widget options)
					if ( 'true' === $post_link ) {
						$output .= '</a>';
					}

					$output .= '</li>';

					echo $output;
				endwhile;
			endif;
			wp_reset_postdata();
			?>
		</ul>
	</div>
</div>

<script type="text/javascript">
(function ($) {
	"use strict";
	$(function () {
		jQuery('.flexslider').flexslider({
			animation: "<?php echo esc_attr( $slider_animate ); ?>",	// String: Set the slideshow animation (either slide or fade)
			slideshowSpeed: <?php echo esc_attr( $slider_pause ); ?>,	// Integer: Set the speed of the slideshow cycling, in milliseconds
			animationSpeed: <?php echo esc_attr( $slider_duration ); ?>,// Integer: Set the speed of animations, in milliseconds
			controlNav: <?php echo esc_attr( $slider_control ); ?>,		//Boolean: Create navigation for paging control of each slide? Note: Leave true for manualControls usage
			directionNav: <?php echo esc_attr( $slider_direction ); ?>,	//Boolean: Create navigation for previous/next navigation? (true/false)
		});
	});
}(jQuery));
</script>
