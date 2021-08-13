<?php
/*
Plugin Name: Recent Posts FlexSlider
Plugin URI: https://davidwolfpaw.com/plugins/
Description: Using the responsive FlexSlider created by WooThemes and integrated into a widget, this slider pulls recent posts from categories of your choosing. You can also choose a Custom Post Type to display instead.
Version: 2.2.0
Author: David Wolfpaw
Author URI: https://davidwolfpaw.com/
Author Email: david@davidwolfpaw.com
Text Domain: recent-posts-flexslider
Domain Path: /lang
Network: false
License: GPL3+
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html<?php

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 3, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class Recent_Posts_FlexSlider extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		// load plugin text domain
		add_action( 'init', array( $this, 'recent_posts_flexslider_textdomain' ) );

		// Hooks fired when the Widget is activated and deactivated
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

		parent::__construct(
			'recent-posts-flexslider',
			__( 'Recent Posts FlexSlider', 'recent-posts-flexslider' ),
			array(
				'classname'   => 'recent-posts-flexslider-class',
				'description' => __( 'A responsive slider of recent posts.', 'recent-posts-flexslider' ),
			)
		);

		// Register site styles and scripts
		if ( is_active_widget( false, false, 'recent-posts-flexslider', true ) ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'register_recent_posts_flexslider_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_recent_posts_flexslider_scripts' ) );
		}

	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param   array   args        The array of form elements
	 * @param   array   instance    The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$title            = $instance['title'];
		$categories       = $instance['categories'];
		$post_type        = $instance['post_type'];
		$slider_duration  = $instance['slider_duration'];
		$slider_pause     = $instance['slider_pause'];
		$slider_count     = $instance['slider_count'];
		$slider_height    = $instance['slider_height'];
		$image_size       = $instance['image_size'];
		$slider_animate   = $instance['slider_animate'];
		$excerpt_length   = $instance['excerpt_length'];
		$slider_control   = $instance['slider_control'];
		$slider_direction = $instance['slider_direction'];
		$post_title       = $instance['post_title'];
		$post_excerpt     = $instance['post_excerpt'];
		$post_link        = $instance['post_link'];
		$only_thumb_post  = $instance['only_thumb_post'];

		echo $before_widget;

		$post_types = get_post_types();
		unset( $post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item'] );

		if ( $post_type == 'all' ) {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}

		include plugin_dir_path( __FILE__ ) . '/views/display.php';

		echo $after_widget;

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param   array   new_instance    The previous instance of values before the update.
	 * @param   array   old_instance    The new instance of values to be generated via the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']            = $new_instance['title'];
		$instance['categories']       = $new_instance['categories'];
		$instance['post_type']        = $new_instance['post_type'];
		$instance['slider_duration']  = $new_instance['slider_duration'];
		$instance['slider_pause']     = $new_instance['slider_pause'];
		$instance['slider_count']     = $new_instance['slider_count'];
		$instance['slider_height']    = $new_instance['slider_height'];
		$instance['slider_animate']   = $new_instance['slider_animate'];
		$instance['image_size']       = $new_instance['image_size'];
		$instance['excerpt_length']   = $new_instance['excerpt_length'];
		$instance['slider_control']   = isset( $new_instance['slider_control'] ) ? 'true' : 'false';
		$instance['slider_direction'] = isset( $new_instance['slider_direction'] ) ? 'true' : 'false';
		$instance['post_title']       = isset( $new_instance['post_title'] ) ? 'true' : 'false';
		$instance['post_excerpt']     = isset( $new_instance['post_excerpt'] ) ? 'true' : 'false';
		$instance['post_link']        = isset( $new_instance['post_link'] ) ? 'true' : 'false';
		$instance['only_thumb_post']  = isset( $new_instance['only_thumb_post'] ) ? 'true' : 'false';

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param   array   instance    The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$defaults = array(
			'title'            => '',
			'categories'       => 'all',
			'post_type'        => 'post',
			'slider_duration'  => '1000',
			'slider_control'   => 'true',
			'slider_direction' => 'true',
			'slider_pause'     => '5000',
			'slider_count'     => 3,
			'slider_height'    => 300,
			'image_size'       => 'full',
			'slider_animate'   => 'slide',
			'post_title'       => 'true',
			'post_excerpt'     => 'true',
			'excerpt_length'   => 20,
			'post_link'        => 'true',
			'only_thumb_post'  => 'true',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Display the admin form
		include plugin_dir_path( __FILE__ ) . '/views/admin.php';

	} // end form

	/*--------------------------------------------------*/
	/* Public Functions
	/*--------------------------------------------------*/

	/**
	 * Loads the Widget's text domain for localization and translation.
	 */
	public function recent_posts_flexslider_textdomain() {

		load_plugin_textdomain( 'recent-posts-flexslider', false, basename( dirname( __FILE__ ) ) . '/lang/' );

	} // end widget_textdomain

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_recent_posts_flexslider_styles() {

		wp_register_style( 'recent-posts-flexslider-style', plugins_url( 'recent-posts-flexslider/css/slider.css' ), array(), '2.1.1' );

	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_recent_posts_flexslider_scripts() {

		wp_enqueue_script( 'jquery' );

		wp_register_script( 'recent-posts-flexslider-script', plugins_url( 'recent-posts-flexslider/js/jquery.flexslider-min.js' ), array( 'jquery' ), '2.1.1', false );

	} // end register_widget_scripts


	// Get Image for Slider
	public function get_recent_post_flexslider_image( $image_size ) {
		$image     = '';
		$post_id   = get_the_ID();
		$the_title = get_the_title();
		$files     = get_children( 'post_parent=' . $post_id . '&post_type=attachment&post_mime_type=image&order=desc' );

		if ( has_post_thumbnail() ) : // Return Featured Image

			$image = get_the_post_thumbnail(
				$post_id,
				$image_size,
				array(
					'class' => $image_size,
					'title' => $the_title,
					'alt'   => $the_title,
				)
			);

		elseif ( $files && ! has_post_thumbnail() ) : // If no Featured Image search for images inside the post

			$keys       = array_reverse( array_keys( $files ) );
			$num        = $keys[0];
			$image_args = wp_get_attachment_image_src( $num, $image_size );
			$image      = '<img src="' . $image_args[0] . '" width="' . $image_args[1] . '" height="' . $image_args[2] . '" alt="' . $the_title . '" title="' . $the_title . '" class="' . $image_size . ' wp-post-image"/>';

		endif;

		return $image;
	}


	// Set Limit of Words in Excerpt
	public function recent_post_flexslider_excerpt( $string, $word_limit, $more = '&nbsp;&hellip;' ) {

		// Remove tags from excerpt
		$string = wp_strip_all_tags( $string );

		$words = explode( ' ', $string, ( $word_limit + 1 ) );
		if ( count( $words ) > $word_limit ) {
			array_pop( $words );
			$return = implode( ' ', $words ) . $more;
		} else {
			$return = implode( ' ', $words );
		}

		return $return;
	}

} // end class

function rpf_register_widget() {
	register_widget( 'Recent_Posts_FlexSlider' );
}

add_action( 'widgets_init', 'rpf_register_widget' );
