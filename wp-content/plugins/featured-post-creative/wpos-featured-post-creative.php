<?php
/*
 * Plugin Name: Featured Post Creative
 * Plugin URI: https://www.wponlinesupport.com/plugins/
 * Description: Easy to add and display image gallery and gallery slider. Also work with Gutenberg shortcode block. 
 * Author: WP OnlineSupport
 * Text Domain: featured-post-creative
 * Domain Path: /languages/
 * Version: 1.1.2
 * Author URI: https://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author WP OnlineSupport
 */

if( !defined( 'WPFP_VERSION' ) ) {
	define( 'WPFP_VERSION', '1.1.2' ); // Version of plugin
}
if( !defined( 'WPFP_DIR' ) ) {
	define( 'WPFP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPFP_URL' ) ) {
	define( 'WPFP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPFP_PLUGIN_BASENAME' ) ) {
	define( 'WPFP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WPFP_POST_TYPE' ) ) {
	define( 'WPFP_POST_TYPE', 'post' ); // Plugin post type
}
if( !defined( 'WPFP_CAT' ) ) {
	define( 'WPFP_CAT', 'category' ); // Plugin category name
}
if( !defined( 'WPFP_META_PREFIX' ) ) {
	define( 'WPFP_META_PREFIX', '_wpfp_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Featured Post
 * @since 1.0.0
 */
add_action('plugins_loaded', 'wpfp_featured_post_load_textdomain');
function wpfp_featured_post_load_textdomain() {
	load_plugin_textdomain( 'featured-post-creative', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Featured Post
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpfp_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Featured Post
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpfp_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Featured Post
 * @since 1.0.0
 */
function wpfp_install() {

	// Get settings for the plugin
	$wpfp_options = get_option( 'wpfp_options' );
	
	if( empty( $wpfp_options ) ) { // Check plugin version option
		
		// Set default settings
		wpfp_default_settings();
		
		// Update plugin version to option
		update_option( 'wpfp_plugin_version', '1.0' );
	}

}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP Featured Post
 * @since 1.0.0
 */
function wpfp_uninstall() {
	// Uninstall functionality
}

// Taking some globals
global $wpfp_options;

// Functions file
require_once( WPFP_DIR . '/includes/wpfp-functions.php' );
$wpfp_options = wpfp_get_settings();

// Script Class
require_once( WPFP_DIR . '/includes/class-wpfp-script.php' );

// Admin Class
require_once( WPFP_DIR . '/includes/admin/class-wpfp-admin.php' );

// Public Class
require_once( WPFP_DIR . '/includes/class-wpfp-public.php' );

// Shortcode files for Block
require_once( WPFP_DIR . '/includes/shortcode/wpfp-recent-post.php' );

// Shortcode files for Grid
require_once( WPFP_DIR . '/includes/shortcode/wpfp-recent-post-grid.php' );

// Widget Class
require_once( WPFP_DIR . '/includes/widgets/class-wpfp-featured-widget-list.php' );

/* Plugin Analytics Data */
function wpos_analytics_anl62_load() {

	require_once dirname( __FILE__ ) . '/wpos-analytics/wpos-analytics.php';

	$wpos_analytics =  wpos_anylc_init_module( array(
							'id'            => 62,
							'file'          => plugin_basename( __FILE__ ),
							'name'          => 'Featured Post Creative',
							'slug'          => 'featured-post-creative',
							'type'          => 'plugin',
							'menu'          => 'wpfp-settings',
							'text_domain'   => 'featured-post-creative',
							'offers'        => array(
													'trial_premium' => array(
															1 => array(
																'image' => 'http://analytics.wponlinesupport.com/?anylc_img=62',
																'link'  => 'https://www.wponlinesupport.com/pricing/?utm_source=OptIn&utm_medium=Banner&utm_campaign=OptInBanner#fndtn-lifetime-combo',
																'desc'  => 'Or start using the plugin from admin menu',
															),
													),
												),
							
						));

	return $wpos_analytics;
}

// Init Analytics
wpos_analytics_anl62_load();
/* Plugin Analytics Data Ends */