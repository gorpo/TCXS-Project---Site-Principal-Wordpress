<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Notifications Area Constants definition
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 1.0.0
 *
 */


/**
 * The name of the YIT theme
 */
define( 'YIT_THEME_NAME', 'the-polygon' );

/**
 * URL to check a theme update
 */
define( 'YIT_THEME_NOTIFIER_URL', 'http://update.yithemes.com/' . YIT_THEME_NAME . '.xml');

/**
 * Define the marketplace: ThemeForest (tf) Yithemes (yit) or free
 *
 */
define( 'YIT_MARKETPLACE', 'yit' );

/**
 * Link to the theme documentation
 */
define( 'YIT_DOCUMENTATION_URL', 'http://docs.yithemes.com/' . YIT_THEME_NAME . '/');

/**
 * Define if the theme is a shop, to add supporto to woocommerce plugin
 */
define( 'YIT_IS_SHOP', true );

/**
 * Define if the theme support the skins system
 */
define( 'YIT_HAS_SKINS', false );

/**
 * Link to the support platform
 */
define( 'YIT_SUPPORT_URL', 'http://support.yithemes.com/');

if( ! defined( 'YIT_DEBUG' ) ) {
    /**
     * Define if Debug Mode is enabled (Default: disabled)
     */
    define( 'YIT_DEBUG', false );
}


/**
 * The options below allows you to remove all Yithemes brand details in Theme Options.
 * It's highly recommended to define those constants within your wp-config.php
 * in order to preserve the settings even after theme update.
 */
if( !defined( 'YIT_SHOW_PANEL_HEADER' ) ) {
    define( 'YIT_SHOW_PANEL_HEADER', 1 );
}

if( !defined( 'YIT_SHOW_PANEL_HEADER_LINKS' ) ) {
    define( 'YIT_SHOW_PANEL_HEADER_LINKS', 1 );
}

/**
 * If true show notification icon in admin area when an update are available
 */
if( !defined( 'YIT_SHOW_UPDATES' ) ) {
    define( 'YIT_SHOW_UPDATES', true );
}

/**
 * Default Dummy Data Link
 */
if( ! defined( 'YIT_DEFAULT_DUMMY_DATA' ) ) {
    define( 'YIT_DEFAULT_DUMMY_DATA', 'https://www.dropbox.com/s/89zpul3qien2he4/the-polygon.gz?dl=1' );
}

/**
 * Default Dummy Data Images Link
 */
if( ! defined( 'YIT_DEFAULT_DUMMY_DATA_IMAGES' ) ) {
    define( 'YIT_DEFAULT_DUMMY_DATA_IMAGES', 'https://www.dropbox.com/s/92bmto7y9u5ierj/the-polygon.zip?dl=1' );
}

/**
 * Remove unused framework modules
 */
function yit_unset_theme_modules( $modules ){
    unset( $modules['feature-tabs'] );
    unset( $modules['portfolio'] );
    unset( $modules['services'] );
    unset( $modules['logos'] );
    return $modules;
}
add_filter( 'yit_framework_modules', 'yit_unset_theme_modules' );

/**
 * Add recommended jetpack modules
 */
function yit_recommended_jetpack_modules( $modules ){

    $modules= array();

    $modules[]= 'yith-woocommerce-ajax-navigation' ;
    $modules[]= 'yith-woocommerce-ajax-search';
    $modules[]= 'yith-woocommerce-wishlist';
    $modules[]= 'yith-woocommerce-zoom-magnifier';

    return $modules;
}
add_filter( 'yith_jetpack_recommended_list', 'yit_recommended_jetpack_modules' );

/**
 * Remove unused and unnecessary shortcodes
 */
function yit_unset_unused_shortcodes( $shortcodes ){
    unset( $shortcodes['googlemap'] );
    unset( $shortcodes['price_table'] );
    unset( $shortcodes['price_table_three'] );
    unset( $shortcodes['price_table_four'] );
    unset( $shortcodes['show_category'] );
    return $shortcodes;
}
add_filter('yit-shortcode-plugin-init', 'yit_unset_unused_shortcodes');

/**
 * Licence
 */
define( 'YIT_THEPOLYGON_SLUG', 'the-polygon' );
define( 'YIT_THEPOLYGON_SECRETKEY', 'L6dwPfwABFsf5Do6rouL' );

$theme      = wp_get_theme();
$theme_name = strtolower( str_replace( ' ', '-', $theme->Name ) );

define( 'YIT_THEPOLYGON_INIT', $theme_name );

// REDIRECT CANONICAL

add_filter( 'redirect_canonical' ,  'yit_redirect_canonical' , 10 ,2) ;

if( ! function_exists('yit_redirect_canonical') ) {

    function yit_redirect_canonical( $redirect_url, $requested_url ) {
        if( is_front_page() && is_page_template( 'blog.php' ) ) {
            return false;
        }  else {
            return $redirect_url;
        }
    }

}