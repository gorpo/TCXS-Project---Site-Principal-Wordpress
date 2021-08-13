<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce;
define( 'WC_LATEST_VERSION', '3.1' );
define ( 'IS_PRIOR_3_0', version_compare( $woocommerce->version, '3.0', '<' ) );

/* === HOOKS === */
function yit_woocommerce_hooks() {

    global $yith_woocompare;

    if ( !defined( 'YIT_DEBUG' ) || !YIT_DEBUG ) {
        $message = get_option( 'woocommerce_admin_notices', array() );
        $message = array_diff( $message, array( 'template_files' ) );
        update_option( 'woocommerce_admin_notices', $message );
    }

    /*============= GENERAL ================*/


    add_filter( 'woocommerce_enqueue_styles', 'yit_enqueue_wc_styles' );
    add_filter( 'woocommerce_template_path', 'yit_set_wc_template_path' );
    if ( yit_is_old_ie() ) {
        add_action( 'wp_head', 'yit_add_wc_styles_to_assets', 0 );
    }
    add_action( 'wp_head', 'yit_size_images_style' );
    add_action( 'woocommerce_before_shop_loop', 'yit_shop_page_meta' );

    // Ajax search loading
    add_filter( 'yith_wcas_ajax_search_icon', 'yit_loading_search_icon' );

    // Use WC 2.0 variable price format, now include sale price strikeout
    add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
    add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

    // Add to cart button text
    add_filter( 'add_to_cart_text', 'yit_add_to_cart_text' );
    add_filter( 'woocommerce_product_single_add_to_cart_text', 'yit_add_to_cart_text' );

    // Custom Pagination
    add_filter( 'woocommerce_pagination_args', 'yit_pagination_shop_args' );

    // Add Custom metabox in My Account and checkout page
    add_action( 'admin_init', 'yit_register_shop_metabox' );

    // Wishlist options
    add_action( 'wp_head', 'yit_update_wishlist_option', 9 );
    if ( !function_exists( 'YITH_WCWL' ) ) {
        add_filter( 'yith_wcwl_add_to_wishlisth_button_html', 'yit_button_wishlist', 10, 4 );
    }

    /*============= SHOP PAGE ===============*/

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    if ( yit_get_option( 'shop-product-title' ) == 'yes' ) {


        if( has_action( 'woocommerce_shop_loop_item_title' ) ) {
            remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
            add_action( 'woocommerce_shop_loop_item_title', 'yit_shop_page_product_title', 10 );
        } else {
            add_action( 'woocommerce_after_shop_loop_item_title', 'yit_shop_page_product_title', 5 );
        }
    }
    if ( yit_get_option( 'shop-product-rating' ) == 'yes' ) {
        add_action( 'woocommerce_after_shop_loop_item_title', 'yit_shop_rating', 5 );
    }
    if ( yit_get_option( 'shop-product-description' ) == 'yes' ) {
        add_action( 'woocommerce_after_shop_loop_item_title', 'yit_shop_product_description', 25 );
    }

    add_filter( 'loop_shop_per_page', 'yit_products_per_page' );
    add_action( 'shop-page-meta', 'yit_wc_catalog_ordering', 15 );

    if ( yit_get_option( 'shop-view-type' ) != 'masonry' && yit_get_option( 'shop-grid-list-option' ) != 'no' ) {
        add_action( 'shop-page-meta', 'yit_wc_list_or_grid', 5 );
    }
    if ( yit_get_option( 'shop-products-per-page-option' ) != 'no' ) {
        add_action( 'shop-page-meta', 'yit_wc_num_of_products', 10 );
    }

    // quick view plugin
    if ( function_exists( 'YITH_WCQV_Frontend' ) ) {
        $enable             = get_option( 'yith-wcqv-enable' ) == 'yes' ? true : false;
        $enable_on_mobile   = get_option( 'yith-wcqv-enable-mobile' ) ==  'yes' ? true : false;
        if( ( ! wp_is_mobile() && $enable ) || ( wp_is_mobile() && $enable_on_mobile && $enable ) ) {
            remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
            add_action( 'woocommerce_before_shop_loop_item_title', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 16 );
            add_action( 'yith_quick_view_custom_style_scripts', 'yith_quick_view_assets' );
            remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );
        }
    }

    // product special actions
    if ( function_exists( 'YITH_WCQV_Frontend' ) || yit_get_option('shop-view-wishlist-button') == 'yes' || yit_get_option('shop-view-compare-button') == 'yes' || yit_get_option('shop-view-share-button') == 'yes') {
        add_action('woocommerce_before_shop_loop_item_title', 'yith_add_special_button_wrapper_start', 14);
        add_action('woocommerce_before_shop_loop_item_title', 'yith_add_special_button_wrapper_end', 20);
        add_action('woocommerce_before_shop_loop_item_title', 'yith_add_special_buttons', 15);

        function yith_add_special_buttons(){

            $wishlist = (yit_get_option('shop-view-wishlist-button') == 'yes' && get_option('yith_wcwl_enabled') == 'yes' && shortcode_exists('yith_wcwl_add_to_wishlist')) ? do_shortcode('[yith_wcwl_add_to_wishlist use_button_style="no"]') : '';

            $compare = (yit_get_option('shop-view-compare-button') == 'yes' && shortcode_exists('yith_compare_button')) ? do_shortcode('[yith_compare_button type="link"]') : '';

            $share = (yit_get_option('shop-view-share-button') == 'yes') ? sprintf('<div class="share-button"><a href="#" id="yit_share">' . __('Share it', 'yit') . '</a></div>') : '';

            $buttons = array($wishlist, $compare, $share);

            echo '<div class="wishlist-compare-share-special-buttons">'. implode("\n", $buttons) . '</div>';

            if (yit_get_option('shop-view-share-button') == 'yes') :
                echo '<div class="share-container"><h3>' . __('share on: ', 'yit') . '</h3>';
                yit_get_social_share('text');
                echo '</div>';
            endif;
        }
    }

    /*======== SINGLE PRODUCT PAGE =========*/

    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    add_action( 'yit_single_page_breadcrumb', 'woocommerce_breadcrumb', 20, 0 );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

    /* remove standard compare button */
    if ( isset( $yith_woocompare ) ) {
        remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
    }

    add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash' );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 40 );
    add_action( 'woocommerce_single_product_summary', 'yit_single_product_other_action', 35 );

    add_filter( 'woocommerce_breadcrumb_defaults', 'yit_shop_breadcrumb_options' );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 7 );

    if ( yit_get_option( 'shop-single-product-nav' ) == 'yes' ) {
        add_action( 'woocommerce_single_product_summary', 'yit_single_page_nav_links', 8 );
    }

    add_action( 'woocommerce_single_product_summary', 'yit_product_modal_window', 27 );

    if ( yit_get_option( 'shop-single-product-name' ) == 'no' ) {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
    }
    if ( yit_get_option( 'shop-single-metas' ) != 'no' ) {
        add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 50 );
    }

    /* related products */
    remove_action( 'woocommerce_after_single_product_summary','woocommerce_output_related_products', 20 );
    add_action ( 'woocommerce_after_main_content', 'woocommerce_output_related_products', 10 );

    if ( yit_get_option( 'shop-show-related' ) == 'no' ) {
        remove_action ( 'woocommerce_after_main_content', 'woocommerce_output_related_products', 10 );
    }
    if ( yit_get_option( 'shop-show-custom-related' ) == 'yes' ) {
        if (IS_PRIOR_3_0) {
            add_filter('woocommerce_related_products_args', 'yit_related_posts_per_page');
        }else{
            if( !function_exists('yit_custom_woocommerce_output_related_products_args') ){
                add_filter('woocommerce_output_related_products_args','yit_custom_woocommerce_output_related_products_args');
            }
        }

    }

    function yit_custom_woocommerce_output_related_products_args( $args ){
        $args['posts_per_page'] = yit_get_option( 'shop-number-related' );
        return $args;
    }

    /* tabs */
    if ( yit_get_option( 'shop-remove-reviews' ) == 'yes' ) {
        add_filter( 'woocommerce_product_tabs', 'yit_remove_reviews_tab', 98 );
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
    }

    add_action( 'woocommerce_after_single_product_summary', 'yit_add_extra_content', 12 );

    /* compare */
    add_action( 'woocommerce_after_add_to_cart_button', 'yit_shop_compare_action' );
    /* wishlist */
    add_action( 'woocommerce_after_add_to_cart_button', 'yit_shop_wishlist_action' );
    /* request a quote */
   /* if ( function_exists('YITH_YWRAQ_Frontend') ) {
        remove_action('woocommerce_single_product_summary', array(YITH_YWRAQ_Frontend(), 'add_button_single_page'), 35);
        add_action('woocommerce_after_add_to_cart_button', array(YITH_YWRAQ_Frontend(), 'add_button_single_page'), 15);
    }*/

    /*============== CART ============*/

    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

    /*============= CHECKOUT =========== */

    if ( yit_get_option( 'shop-checkout-form-coupon' ) == 'no' ) {
        remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );
    }

    /*===== MANAGE VAT AND SSN FIELDS =====*/

    if ( yit_get_option( 'shop-enable-vat' ) == 'yes' && yit_get_option( 'shop-enable-ssn' ) == 'yes' ) {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_ssn_vat' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_ssn_vat' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_fields_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_fields_admin' );
    }
    elseif ( yit_get_option( 'shop-enable-vat' ) == 'yes' ) {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_vat' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_vat' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_vat_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_vat_admin' );
        add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data_vat' );
    }
    elseif ( yit_get_option( 'shop-enable-ssn' ) == 'yes' ) {
        add_filter( 'woocommerce_billing_fields', 'yit_woocommerce_add_billing_ssn' );
        add_filter( 'woocommerce_shipping_fields', 'yit_woocommerce_add_shipping_ssn' );
        add_filter( 'woocommerce_admin_billing_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
        add_filter( 'woocommerce_admin_shipping_fields', 'woocommerce_add_billing_shipping_ssn_fields_admin' );
        add_filter( 'woocommerce_load_order_data', 'woocommerce_add_var_load_order_data_ssn' );
    }



    /*================ REVIEW ==================*/
    add_filter( 'comments_open', 'yit_woocommerce_show_review', 11, 2 );

    /* ========= YIT SHORTCODES =============*/

    add_filter( 'yit_sc_add_to_cart_btn_classes', 'yit_sc_add_to_cart_btn_classes' );

    /*======== Support to YITH Plugins =========*/

    add_action( 'init', 'yit_plugins_support' );

}

add_action( 'after_setup_theme', 'yit_woocommerce_hooks' );


// Useful for opening cart in header
function yit_remove_add_to_cart_redirect() {
    return false;
}

function yit_get_add_to_cart_redirect_filter_name() {
    /**
     * Get add to cart redirect filter name
     *
     *
     * @return string
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    $add_to_cart_redirect_filter = 'woocommerce_add_to_cart_redirect';

    return $add_to_cart_redirect_filter;
}

add_filter( yit_get_add_to_cart_redirect_filter_name(), 'yit_remove_add_to_cart_redirect' );

function yit_move_advanced_reviews() {

    global $YWAR_AdvancedReview;

    if ( !isset( $YWAR_AdvancedReview ) ) {
        return;
    }

    // remove original filter
    remove_filter( 'comments_template', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );
    add_action( 'yit_advanced_review', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );
}

add_action( 'init', 'yit_move_advanced_reviews', 20 );

/**
 * For WooCommerce 2.5.x
 */
if( ! function_exists('yit_woocommerce_shop_loop_subcategory_title') ) {

    function yit_woocommerce_shop_loop_subcategory_title( $category , $show_counter = 1 ) { ?>

        <div class="category-name">
            <h4>
                <?php echo $category->name; ?>
            </h4>
        </div>

        <?php
        if ( ( isset( $show_counter ) && $show_counter == 1 ) && $category->count > 0 ) : ?>

            <div class="category-count">
                <div class="category-count-content">
                    <?php
                    echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . _n( " product", " products", $category->count, "yit" ) . '</span>', $category );
                    ?>
                </div>
            </div>
        <?php endif; ?>

    <?php }

    remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
    add_action( 'woocommerce_shop_loop_subcategory_title' , 'yit_woocommerce_shop_loop_subcategory_title' , 10 , 2 );

}

/*****************
 * GENERAL
 *****************/

// shop small
if ( !function_exists( 'yit_shop_catalog_w' ) ) : function yit_shop_catalog_w() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['width'];
} endif;
if ( !function_exists( 'yit_shop_catalog_h' ) ) : function yit_shop_catalog_h() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['height'];
} endif;
if ( !function_exists( 'yit_shop_catalog_c' ) ) : function yit_shop_catalog_c() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['crop'];
} endif;

// shop thumbnail
if ( !function_exists( 'yit_shop_thumbnail_w' ) ) : function yit_shop_thumbnail_w() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['width'];
} endif;
if ( !function_exists( 'yit_shop_thumbnail_h' ) ) : function yit_shop_thumbnail_h() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['height'];
} endif;
if ( !function_exists( 'yit_shop_thumbnail_c' ) ) : function yit_shop_thumbnail_c() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['crop'];
} endif;

//shop large
if ( !function_exists( 'yit_shop_single_w' ) ) : function yit_shop_single_w() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['width'];
} endif;
if ( !function_exists( 'yit_shop_single_h' ) ) : function yit_shop_single_h() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['height'];
} endif;
if ( !function_exists( 'yit_shop_single_c' ) ) : function yit_shop_single_c() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['crop'];
} endif;

if ( !function_exists( 'yit_add_to_cart_text' ) ) {
    /**
     * Set Add to Cart label from Theme Options
     *
     * @param $std
     *
     * @return string
     *
     * @since 1.0.0
     */
    function yit_add_to_cart_text( $std ) {
        global $product;

        if ( is_object( $product ) ) {

            $product_type = property_exists( 'WC_Product', 'product_type' ) ? $product->product_type : $product->get_type();

            if ( $product_type == 'external' ) {
                return $std;
            } else {
                $text = __( 'Add to cart', 'yit' );
                return $text;
            }

        }
    }
}

if ( !function_exists( 'yit_enqueue_wc_styles' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_enqueue_wc_styles( $styles ) {

        $path    = 'woocommerce';
        $version = WC()->version;

        if ( version_compare( $version, WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x';
        }

        /* 2.3 and grather add select2 on cart page*/
        if ( version_compare( $version, '2.2', '>' ) ){
            if(is_cart()){
                wp_enqueue_script( 'select2' );
                wp_enqueue_style( 'select2', WC()->plugin_url() . '/assets/css/select2.css' );
            }
        }

        unset( $styles['woocommerce-general'], $styles['woocommerce-layout'], $styles['woocommerce-smallscreen'] );

        $styles ['yit-layout'] = array(
            'src'     => get_stylesheet_directory_uri() . '/' . $path . '/style.css',
            'deps'    => '',
            'version' => '1.0',
            'media'   => ''
        );
        return $styles;
    }
}

if ( !function_exists( 'yit_add_wc_styles_to_assets' ) ) {
    function yit_add_wc_styles_to_assets() {

        $path    = 'woocommerce';
        $version = WC()->version;

        if ( version_compare( $version, WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x';
        }

        $stylepicker_css = array(
            'src'     => get_stylesheet_directory_uri() . '/' . $path . '/style.css',
            'enqueue' => true,
            'media'   => 'all'
        );

        if ( function_exists( 'YIT_Asset' ) ) {
            YIT_Asset()->set( 'style', 'yit-woocommerce', $stylepicker_css, 'after', 'theme-stylesheet' );
        }

    }
}

if ( !function_exists( 'yit_set_wc_template_path' ) ) {
    /**
     * Return the folder of custom woocommerce templates
     *
     * @param $path
     *
     * @return string template folder
     *
     * @since    2.0.0
     */
    function yit_set_wc_template_path( $path ) {

        $version = WC()->version;

        if ( version_compare( WC()->version, WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x/';
        }

        return $path;
    }
}

if ( !function_exists( 'wc_wc20_variation_price_format' ) ) {

    /* variation price format */
    function wc_wc20_variation_price_format( $price, $product ) {
        // Main Price
        $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
        $price  = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
        // Sale Price
        $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
        sort( $prices );
        $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

        if ( $price !== $saleprice ) {
            $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
        }
        return $price;
    }

}

if ( !function_exists( 'yit_button_wishlist' ) ) {
    /**
     * Change wishlist button
     *
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_button_wishlist( $html, $url, $product_type, $exists ) {

        global $yith_wcwl, $product;

        $label_option   = get_option( 'yith_wcwl_add_to_wishlist_text' );

        $product_id = yit_get_base_product_id( $product );

        $html = '<div id="add_to_wishlist_' . $product_id . '" class="yith-wcwl-add-to-wishlist border">';
        $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row

        $html .= $exists ? ' hide" style="display:none;"' : ' show"';

        $html .= '><a href="' . esc_url( $yith_wcwl->get_addtowishlist_url() ) . '" data-product-id="' . $product_id . '" data-product-type="' . $product_type . '" class="with-tooltip add_to_wishlist" data-toggle="tooltip" data-placement="bottom" title="' . $label_option . '">';
        $html .= '<span data-icon="&#xe3e9;" data-font="retinaicon-font"></span></a>';
        $html .= '</div>';

        $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a href="' . esc_url( $url ) . '" class="with-tooltip" data-toggle="tooltip" data-placement="bottom" title="' . __( 'Added to wishlist', 'yit' ) . '">';
        $html .= '<span data-icon="&#xe3e9;" data-font="retinaicon-font"></span></a>';
        $html .= '</div>';

        $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="with-tooltip" data-toggle="tooltip" data-placement="bottom" title="' . __( 'Added to wishlist', 'yit' ) . '">';
        $html .= '<span data-icon="&#xe3e9;" data-font="retinaicon-font"></span></a>';
        $html .= '</div>';

        $html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';

        $html .= '</div>';
        $html .= '<div class="clear"></div>';

        return $html;
    }
}

/*************
 * SHOP PAGE
 *************/

if ( !function_exists( 'yit_shop_page_product_title' ) ) {
    /**
     * Add product title to main shop page
     *
     * @return void
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_shop_page_product_title() {
        global $product;

        if( yit_get_option('shop-product-category-in-title')=='yes' ) {
            $html = '<div class="product-categories">';
            if (function_exists( 'wc_get_product_category_list' )) {
                $html .= wc_get_product_category_list( get_the_ID(), ', ' );
            }
            $html .= '</div>';
        }
        else{
            $html = '';
        }

        $html .= '<h3 class="product-name">';
        $html .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
        $html .= '</h3>';

        echo $html;
    }

}

function woocommerce_template_loop_product_thumbnail() {

    global $product, $woocommerce_loop;

    $attachments = method_exists( 'WC_Product', 'get_gallery_image_ids' ) ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();

    $attachment_title = '';

    $original_size = wc_get_image_size( 'shop_catalog' );

    if ( isset( $woocommerce_loop['view'] ) && $woocommerce_loop['view'] == 'masonry_item' ) {
        $size           = $original_size;
        $size['height'] = 0;
        YIT_Registry::get_instance()->image->set_size( 'shop_catalog', $size );
    }

    if ( isset( $attachments[0] ) ) {

        $attachment_post = get_post( $attachments[0] );
        if ( isset( $attachment_post->post_title ) ) {
            $attachment_title = $attachment_post->post_title;
        }
        echo '<a href="' . get_permalink() . '" class="thumb backface"><span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
        echo '<span class="face back">';
        yit_image( "id=$attachments[0]&size=shop_catalog&class=image-hover&alt=" . $attachment_title );
        echo '</span></a>';
    }
    else {
        echo '<a href="' . get_permalink() . '" class="thumb"><span class="face">' . woocommerce_get_product_thumbnail() . '</span></a>';
    }

    if ( isset( $woocommerce_loop['view'] ) && $woocommerce_loop['view'] == 'masonry_item' ) {
        YIT_Registry::get_instance()->image->set_size( 'shop_catalog', $original_size );
    }
}

if ( !function_exists( 'yit_shop_rating' ) ) {

    function yit_shop_rating() {

        global $product, $ywpc_loop;

        if ( $ywpc_loop === 'ywpc_shortcode' && get_option( 'ywpc_shortcode_rating' ) != 'yes' ) {
            return;
        }

        if ( $ywpc_loop === 'ywpc_widget' && get_option( 'ywpc_widget_rating' ) != 'yes' ) {
            return;
        }

        echo '<div class="woocommerce-product-rating"><div class="star-rating"><span style="width:' . ( ( $product->get_average_rating() / 5 ) * 100 ) . '%"></span></div></div>';
    }
}

if ( !function_exists( 'yit_get_current_cart_info' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @internal param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_get_current_cart_info() {

        $items = yit_get_option( 'shop-mini-cart-total-items' ) ? WC()->cart->get_cart_contents_count() : count( WC()->cart->get_cart() );
        $total = WC()->cart->get_cart_subtotal();

        return array(
            sprintf( _n( '1 item', '%s items', $items, 'yit' ), $items ),
            $total
        );
    }
}

if ( !function_exists( 'yit_shop_product_description' ) ) {
    /**
     * Add short product description in shop
     *
     */
    function yit_shop_product_description() {

        global $product;

        $excerpt = property_exists( 'WC_Product', 'post' ) ? $product->post->post_excerpt : get_post_field( 'post_excerpt', $product->get_id() );

        if ( $excerpt != "" ) :
            echo '<div class="product-description"><p>';
            echo wp_trim_words( $excerpt, 20 );
            echo '</p></div>';
        endif;

    }
}

if ( !function_exists( 'yit_size_images_style' ) ) {

    function yit_size_images_style() {

        if ( !is_shop() && !is_product_category() && !is_product_taxonomy() ) {
            return;
        }

        $content_width      = $GLOBALS['content_width'];
        $shop_catalog_w     = ( 100 * yit_shop_catalog_w() ) / $content_width;
        $info_product_width = 100 - $shop_catalog_w;
        ?>
        <style type="text/css">
            .woocommerce ul.products li.product.list .product-wrapper .thumb-wrapper {
                width: <?php echo $shop_catalog_w ?>%;
                height: auto;
                margin-right: 2%;
            }

            .woocommerce ul.products li.product.list .product-wrapper .product-meta-wrapper,
            .woocommerce ul.products li.product.list .product-wrapper .product_actions_container {
                width: <?php echo $info_product_width-2?>%;
            }

        </style>
    <?php
    }
}

if ( !function_exists( 'yit_wc_list_or_grid' ) ) {
    /*
     * Add list/grid switch
     */
    function yit_wc_list_or_grid() {
        wc_get_template( '/global/list-or-grid.php' );
    }
}

if ( !function_exists( 'yit_wc_num_of_products' ) ) {
    /*
     * Custom number of products switch
     */
    function yit_wc_num_of_products() {
        wc_get_template( '/global/number-of-products.php' );
    }
}

if ( !function_exists( 'yit_products_per_page' ) ) {
    /*
     * Custom number of product per page
     */
    function yit_products_per_page() {

        $num_prod = ( isset( $_GET['products-per-page'] ) ) ? $_GET['products-per-page'] : yit_get_option( 'shop-products-per-page' );

        if ( $num_prod == 'all' ) {
            $num_prod = wp_count_posts( 'product' )->publish;
        }

        return $num_prod;
    }
}

if ( !function_exists( 'yit_shop_page_meta' ) ) {
    /*
     * Page meta for shop page
     */
    function yit_shop_page_meta() {
        if ( is_single() ) {
            return;
        }
        wc_get_template( '/global/page-meta.php' );
    }
}

if ( !function_exists( 'yit_wc_catalog_ordering' ) ) {

    function yit_wc_catalog_ordering() {
        if ( !is_single() && have_posts() ) {
            woocommerce_catalog_ordering();
        }
    }
}

/**
 * QUICK VIEW
 */

function yith_add_special_button_wrapper_start() {
    echo '<div class="product-special-button"><div class="centered">';
}

function yith_add_special_button_wrapper_end() {
    echo '</div></div>';
}

function yith_quick_view_assets() {
    wp_enqueue_script( 'yit_woocommerce_2_3', YIT_THEME_ASSETS_URL . '/js/woocommerce_2.3.js', array('jquery') );
}

/* CHECK IF IS PRODUCT QUICK VIEW */

function is_quick_view() {
    return ( defined('DOING_AJAX') && DOING_AJAX && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'yith_load_product_quick_view' ) ? true : false;
}

/**********************
 * SINGLE PRODUCT PAGE
 **********************/

if ( !function_exists( 'yit_shop_breadcrumb_options' ) ) {
    /**
     * Custom args for wc breadcrumb
     *
     * @since 1.0.0
     */
    function yit_shop_breadcrumb_options() {

        $args = array(
            'delimiter'   => ' &gt; ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Home', 'breadcrumb', 'yit' ),
        );

        return $args;
    }
}

if ( !function_exists( 'yit_single_page_nav_links' ) ) {

    function yit_single_page_nav_links() {
        wc_get_template( 'single-product/nav-links.php' );
    }
}

if ( !function_exists( 'yit_related_posts_per_page' ) ) {

    function yit_related_posts_per_page() {
        global $product;
        $related = IS_PRIOR_3_0 ? $product->get_related( yit_get_option( 'shop-number-related' ) ) : wc_get_related_products($product->get_id(),yit_get_option( 'shop-number-related' ));
        return array(
            'posts_per_page'      => - 1,
            'post_type'           => 'product',
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => 1,
            'post__in'            => $related
        );
    }
}

if ( !function_exists( 'yit_remove_reviews_tab' ) ) {

    function yit_remove_reviews_tab( $tabs ) {

        unset( $tabs['reviews'] );
        return $tabs;
    }
}

if ( !function_exists( 'yit_single_product_other_action' ) ) {
    /**
     * Add other actions in single product page ( share, compare, wishlist )
     *
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_single_product_other_action() {
        wc_get_template( 'single-product/other-actions.php' );

    }
}

/*******************
 * MY ACCOUNT
 *******************/

if ( !function_exists( 'yit_add_my_account_endpoint' ) ) {

    function yit_add_my_account_endpoint() {

        if ( function_exists( 'WC' ) ) {
            WC()->query->query_vars['recent-downloads']       = 'recent-downloads';
            WC()->query->query_vars['myaccount-wishlist']     = 'myaccount-wishlist';

        }

        if ( class_exists( 'YITH_WC_Subscription' ) ) {
            WC()->query->query_vars['myaccount-subscription'] = 'myaccount-subscription';
        }
    }

    add_action( 'after_setup_theme', 'yit_add_my_account_endpoint' );
}

//redirect to current wishlist page after add-to-cart
if ( !function_exists( 'yit_wcwl_add_to_cart_redirect_url' ) ) {

    function yit_wcwl_add_to_cart_redirect_url( $link ) {

        return wc_get_endpoint_url( 'myaccount-wishlist', '', get_permalink( wc_get_page_id( 'myaccount' ) ) );
    }
}
if ( wc_get_endpoint_url( 'myaccount-wishlist', '', get_permalink( wc_get_page_id( 'myaccount' ) ) ) === wp_get_referer() ) {
    add_filter( 'yit_wcwl_add_to_cart_redirect_url', 'yit_wcwl_add_to_cart_redirect_url' );
}


if( class_exists('YITH_WC_Subscription')){
    remove_action( 'woocommerce_before_my_account', array( YITH_WC_Subscription(), 'my_account_subscriptions' ) );
}


if ( !function_exists( 'yit_my_account_template' ) ) {
    /**
     * Add custom template form my-account page
     *
     * @return   void
     * @since    2.0.0
     * @author   Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_my_account_template() {

        if ( !function_exists( 'WC' ) || !is_page( wc_get_page_id( 'myaccount' ) ) ) {
            return;
        }

        global $wp;

        if ( is_user_logged_in() ) {

            echo '<div class="row" id="my-account-page">';

            echo '<div class="col-sm-12" id="my-account-content">';

            wc_print_notices();

            if ( isset( $wp->query_vars['view-order'] ) && empty( $wp->query_vars['view-order'] ) ) {
                wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => - 1 ) );
            }
            elseif ( isset( $wp->query_vars['recent-downloads'] ) ) {
                wc_get_template( 'myaccount/my-downloads.php' );
            }
            elseif ( isset( $wp->query_vars['myaccount-subscription'] ) ) {
                echo do_shortcode( '[ywsbs_my_account_subscriptions]' );
            }
            elseif ( isset( $wp->query_vars['myaccount-wishlist'] ) ) {
                echo do_shortcode( '[yith_wcwl_wishlist]' );
            }
            else {
                yit_content_loop();
            }
            echo '</div>';

            echo '</div>';

        }
        else {
            echo '<div id="my-account-content">';
            if ( isset( $wp->query_vars['lost-password'] ) ) {
                WC_Shortcode_My_Account::lost_password();
            }
            else {
                wc_get_template( 'myaccount/form-login.php' );
            }
            echo '</div>';
        }
    }
}

if ( !function_exists( 'yit_loading_search_icon' ) ) {

    function yit_loading_search_icon() {
        return '"' . YIT_THEME_ASSETS_URL . '/images/search.gif"';
    }
}

if ( !function_exists( 'yit_product_modal_window' ) ) {
    /**
     * Get template for modal in single product page
     */
    function yit_product_modal_window() {
        wc_get_template( 'single-product/modal-window.php' );
    }
}

if ( !function_exists( 'yit_pagination_shop_args' ) ) {
    /**
     * Custom pagination for shop page
     *
     * @return array
     * @since 1.0.0
     */
    function yit_pagination_shop_args() {

        global $wp_query;

        $args = array(
            'base'               => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'             => '',
            'current'            => max( 1, yit_get_post_current_page() ),
            'total'              => $wp_query->max_num_pages,
            'type'               => 'plain',
            'prev_next'          => true,
            'prev_text'          => '&lt;',
            'next_text'          => '&gt;',
            'end_size'           => 3,
            'mid_size'           => 3,
            'add_fragment'       => '',
            'before_page_number' => '',
            'after_page_number'  => ''
        );

        return $args;
    }
}

/***********************
 * VAT SSN FIELDS
 ***********************/

function yit_woocommerce_add_billing_ssn_vat( $fields ) {
    $fields['billing_vat'] = array(
        'label'       => apply_filters( 'yit_vat_label', __( 'VAT', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-first' ),
        'clear'       => false
    );

    $fields['billing_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-last' ),
        'clear'       => true
    );

    return $fields;
}

function yit_woocommerce_add_shipping_ssn_vat( $fields ) {
    $fields['shipping_vat'] = array(
        'label'       => apply_filters( 'yit_vat_label', __( 'VAT', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-first' ),
        'clear'       => false
    );

    $fields['shipping_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-last' ),
        'clear'       => true
    );

    return $fields;
}

function woocommerce_add_billing_shipping_fields_admin( $fields ) {
    $fields['vat'] = array(
        'label' => apply_filters( 'yit_vatssn_label', __( 'VAT', 'yit' ) )
    );
    $fields['ssn'] = array(
        'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
    );

    return $fields;
}

function yit_woocommerce_add_billing_vat( $fields ) {
    $fields['billing_vat'] = array(
        'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT / SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}

function yit_woocommerce_add_shipping_vat( $fields ) {
    $fields['shipping_vat'] = array(
        'label'       => apply_filters( 'yit_vatssn_label', __( 'VAT / SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}

function woocommerce_add_billing_shipping_vat_admin( $fields ) {
    $fields['vat'] = array(
        'label' => apply_filters( 'yit_vatssn_label', __( 'VAT/SSN', 'yit' ) )
    );

    return $fields;
}

function woocommerce_add_var_load_order_data_vat( $fields ) {
    $fields['billing_vat']  = '';
    $fields['shipping_vat'] = '';
    return $fields;
}

function yit_woocommerce_add_billing_ssn( $fields ) {
    $fields['billing_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}

function yit_woocommerce_add_shipping_ssn( $fields ) {
    $fields['shipping_ssn'] = array(
        'label'       => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) ),
        'placeholder' => '',
        'required'    => false,
        'class'       => array( 'form-row-wide' ),
        'clear'       => true
    );

    return $fields;
}

function woocommerce_add_billing_shipping_ssn_fields_admin( $fields ) {
    $fields['ssn'] = array(
        'label' => apply_filters( 'yit_ssn_label', __( 'SSN', 'yit' ) )
    );

    return $fields;
}

function woocommerce_add_var_load_order_data_ssn( $fields ) {
    $fields['billing_ssn']  = '';
    $fields['shipping_ssn'] = '';
    return $fields;
}


// SET LAYOUT FOR SHOP PAGE

function yit_sidebar_shop_page( $value, $key, $id ) {

    $new_layout = ( isset( $_GET['layout-shop'] ) ) ? $_GET['layout-shop'] : '';

    if ( isset( $value['layout'] ) && $new_layout != '' && $key == 'sidebars' ) {

        $value['layout'] = $new_layout;

        if ( $value['sidebar-left'] == - 1 ) {
            $value['sidebar-left'] = $value['sidebar-right'];
        }
        elseif ( $value['sidebar-right'] == - 1 ) {
            $value['sidebar-right'] = $value['sidebar-left'];
        }
    }

    return $value;
}

add_filter( 'yit_get_option_layout', 'yit_sidebar_shop_page', 10, 3 );


// add image for product category page
function woocommerce_taxonomy_archive_description() {

    if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {

        $description = apply_filters( 'the_content', term_description() );

        if ( $description && yit_get_option( 'shop-category-show-page-description' ) == 'yes' ) {
            echo '<div class="term-description">' . $description . '</div>';
        }
    }
}

if ( !function_exists( 'yit_image_content_single_width' ) ) {
    /**
     * Set image and content width for single product image
     *
     * @return array
     * @since  1.0.0
     * @author Francesco Licando <francesco.licandro@yithemes.it>
     */
    function yit_image_content_single_width() {

        $size = array();

        $img_size = yit_shop_single_w();

        $sidebar = YIT_Layout()->sidebars;

        if ( intval( $img_size ) < $GLOBALS['content_width'] ) {

            $size['image'] = ( intval( $img_size ) * 100 ) / $GLOBALS['content_width'];

            if ( $sidebar['layout'] != 'sidebar-no' && !wp_is_mobile() ) {
                $size['image'] -= 20;
            }
        }
        else {
            $size['image'] = 100;
        }

        $size['content'] = 100 - ( $size['image'] );
        $min_size        = ( wp_is_mobile() ) ? '40' : '20';

        if ( $size['content'] < $min_size ) {
            $size['content'] = 100;
        }

        return $size;

    }
}


function yit_update_wishlist_option() {
    update_option( 'yith_wcwl_button_position', 'shortcode' );
}

if ( !function_exists( 'yit_remove_unused_wishlist_options' ) ) {
    /**
     * Remove unused options from wishlist settings tab
     *
     * @param $options
     *
     * @return mixed
     * @since  1.0.0
     * @author Francesco LIcandro <francesco.licandro@yithemes.com>
     */
    function yit_remove_unused_wishlist_options( $options ) {

        if ( isset( $options['general_settings']['add_to_wishlist_position'] ) ) {
            unset( $options['general_settings']['add_to_wishlist_position'] );
        }
        else {
            unset( $options['general_settings'][5] );
        }

        if ( $options['styles']['use_buttons'] ) {
            unset( $options['styles']['use_buttons'] );
        }
        else {
            unset( $options['styles'][1] );
        }

        return $options;
    }

    add_filter( 'yith_wcwl_tab_options', 'yit_remove_unused_wishlist_options' );
}

if ( !function_exists( 'yit_shop_wishlist_action' ) ) {
    /**
     * Add wishlist to single product page
     *
     * @since 1.0.0
     */
    function yit_shop_wishlist_action() {
        if ( shortcode_exists( 'yith_wcwl_add_to_wishlist' ) && get_option( 'yith_wcwl_enabled' ) == 'yes' && yit_get_option( 'shop-single-show-wishlist' ) == 'yes' ) {
            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
        }
    }
}

if ( ! function_exists( 'yit_shop_compare_action') ) {
    /**
     * Add wishlist to single product page
     *
     * @since 1.0.0
     */
    function yit_shop_compare_action() {
        if ( shortcode_exists( 'yith_compare_button' ) && get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' && yit_get_option( 'shop-single-compare' ) == 'yes' ) {
            echo do_shortcode( '[yith_compare_button type="link"]' );
        }
    }
}

if ( !function_exists( 'yit_remove_unused_woocompare_options' ) ) {
    /**
     * Remove unused options from compare settings tab
     *
     * @param $options
     *
     * @return mixed
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_remove_unused_woocompare_options( $options ) {

        unset( $options['general'][1] );
        unset( $options['general'][2] );
        unset( $options['general'][4] );

        return $options;
    }

    add_filter( 'yith_woocompare_tab_options', 'yit_remove_unused_woocompare_options' );
}


function yit_add_extra_content() {

    global $post;

    $extra = '';

    $add_extra = yit_get_post_meta( $post->ID, '_add_extra_content' );
    if ( $add_extra == "yes" ) {
        $extra = yit_get_post_meta( $post->ID, '_extra_content' );
    }

    echo do_shortcode( $extra );
}

if ( !function_exists( 'yit_register_shop_metabox' ) ) {
    /**
     * Add custom metabox in shop page admin
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since  2.0.0
     * @return void
     */
    function yit_register_shop_metabox() {

        $post_id            = yit_admin_post_id();
        $my_account_page_id = wc_get_page_id( 'myaccount' );
        $checkout_page_id   = wc_get_page_id( 'checkout' );
        $cart_page_id       = wc_get_page_id( 'cart' );
        $metaboxes_file     = apply_filters( 'yit_extra_shop_metaboxes', YIT_THEME_PATH . '/shop-metabox.php' );
        $metaboxes          = include( $metaboxes_file );

        switch ( $post_id ) {

            case $my_account_page_id:
                YIT_Metabox( 'yit-page-setting' )->remove_fields( $metaboxes['remove'] );
                YIT_Metabox( 'yit-page-setting' )->add_field( 'settings', $metaboxes['myaccount'], 'last' );
                break;

            case $checkout_page_id:
            case $cart_page_id:
                YIT_Metabox( 'yit-page-setting' )->remove_fields( $metaboxes['remove'] );
                YIT_Metabox( 'yit-page-setting' )->add_field( 'settings', $metaboxes['checkout'], 'last' );
                break;
        }
    }
}



if ( !function_exists( 'yit_add_to_cart_success_ajax' ) ) {
    /*
     * Added to cart success popup box
     *
     * @param array
     * @return array
     * @since 1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_add_to_cart_success_ajax( $datas ) {

        if( isset( $_REQUEST['ywacp_is_single'] ) && $_REQUEST['ywacp_is_single'] == 'yes' ) {
            return $datas;
        }

        list( $cart_items, $cart_total ) = yit_get_current_cart_info();

        $datas['.yit_cart_widget .cart_label .yit-mini-cart-icon'] = '<span class="yit-mini-cart-icon">
                                        <span class="cart-items-number">' . $cart_items . '</span>
                                        <span class="cart-total">' . $cart_total . '</span>
                                        </span>';

        // add to cart popup
        ob_start();
        ?>

        <div class="added_to_cart">

            <?php if ( isset( $_REQUEST['product_id'] ) ):

                $id      = isset( $_REQUEST['variation_id'] ) ? $_REQUEST['variation_id'] : $_REQUEST['product_id'];
                $product = wc_get_product( $id );
                ?>

                <div class="product-image">
                    <?php echo $product->get_image( 'shop_thumbnail' ) ?>
                </div>
                <div class="product-info">
                    <h3 class="product-name"><?php echo $product->get_title() ?></h3>
                    <span class="message"><?php _e( 'was added to your cart', 'yit' ) ?></span>
                </div>

            <?php else: ?>

                <p><?php _e( 'You added', 'yit' ) ?> <?php _e( 'to your cart', 'yit' ) ?></p>

            <?php endif ?>

            <div class="actions">
                <a class="btn btn-ghost" href="<?php echo wc_get_cart_url() ?>"><?php _e( 'View cart', 'yit' ) ?></a>
                <a class="btn btn-flat-green continue-shopping" href="#"><?php _e( 'Continue to shop', 'yit' ) ?></a>
            </div>

        </div>

        <?php
        $datas['#popupWrap .message'] = ob_get_clean();

        return $datas;
    }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );

add_filter( 'woocommerce_add_to_cart_fragments', 'yit_add_widget_cart_classes' );

if ( !function_exists( 'yit_add_widget_cart_classes' ) ) {
    /**
     * add css classes to the mini cart
     *
     * @param array $array
     *
     * @return array
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_add_widget_cart_classes( $array ) {

        $scroll_class = yit_get_mini_cart_extra_classes();

        $array['div.widget_shopping_cart_content'] = str_replace( 'widget_shopping_cart_content', 'widget_shopping_cart_content group ' . $scroll_class, $array['div.widget_shopping_cart_content'] );

        return $array;
    }
}


if ( !function_exists( 'yit_woocommerce_show_review' ) ) {
    /**
     * hide or show reviews
     *
     * @param string $open    the product
     *
     * @param string $post_id the post ID
     *
     * @return bool
     * @since  2.0.0
     * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
     */
    function yit_woocommerce_show_review( $open, $post_id ) {
        $post = get_post( $post_id );
        if ( $post->post_type != 'product' ) {
            return $open;
        }
        else {
            if ( isset( $post ) ) {
                $open = $post->comment_status;
            }
            else {
                if ( !isset( $post_id ) ) {
                    global $product;
                    $product_id = yit_get_base_product_id( $product );
                    $open = get_post( $product_id )->comment_status;
                }
            }
        }
        return ( yit_get_option( 'shop-remove-reviews' ) == 'no' ) ? ( 'open' == $open ) : false;
    }
}

if ( !function_exists( 'yit_woocommerce_object' ) ) {

    function yit_woocommerce_object() {

        wp_localize_script( 'jquery', 'yit_woocommerce', array(
            'version'                          => WC()->version,
            'yit_shop_show_reviews_tab_opened' => yit_get_option( 'shop-show-reviews-tab-opened' ),
            'shop_minicart_scrollable'         => yit_get_option( 'shop-mini-cart-scrollable' )
        ) );

    }

}

if ( !function_exists( 'yit_sc_add_to_cart_btn_classes' ) ) {

    /**
     * Add a class to add to cart shortcode fronted
     *
     * @return string
     * @since 1.0
     */
    function yit_sc_add_to_cart_btn_classes() {
        return 'btn btn-flat-green';
    }

}

if ( defined( 'YITH_YWRAQ_VERSION' ) ) {

    add_filter( 'ywraq_product_in_list', 'yit_ywraq_change_product_in_list_message' );

    function yit_ywraq_change_product_in_list_message() {
        return __( 'In your quote list', 'yit' );
    }

    add_filter( 'ywraq_product_added_view_browse_list', 'yit_ywraq_product_added_view_browse_list_message' );

    function yit_ywraq_product_added_view_browse_list_message() {
        return __( 'View list &gt;', 'yit' );
    }

    add_filter( 'yith_admin_tab_params', 'yith_wraq_remove_layout_options' );

    if ( !function_exists( 'yith_wraq_remove_layout_options' ) ) {

        /**
         * Remove Layout option from Request a Quote
         *
         * @param array $array
         *
         * @return array
         * @since 1.0
         */
        function yith_wraq_remove_layout_options( $array ) {

            if ( $array['page'] == 'yith_woocommerce_request_a_quote' ) {
                unset( $array['available_tabs']['layout'] );
            }

            return $array;
        }
    }
}

if ( !function_exists( 'yit_get_mini_cart_extra_classes' ) ) {

    /**
     * Return the extra class name of mini cart
     *
     * @return string
     * @since 1.0
     */
    function yit_get_mini_cart_extra_classes() {
        $shop_mini_cart_scrollable = ( yit_get_option( 'shop-mini-cart-scrollable' ) == 'yes' );
        return ( $shop_mini_cart_scrollable ) ? 'scrollbar-outer' : '';
    }

}

if ( !function_exists( 'yit_plugins_support' ) ) {
    /**
     * YITH Plugins support
     *
     * @return string
     * @since 1.0
     */
    function yit_plugins_support() {

        $is_multi_vendor_premium_installed = class_exists( 'YITH_Vendors_Frontend_Premium' );
        $is_multi_vendor_installed = function_exists( 'YITH_Vendors' );

        /* === YITH WooCommerce Multi Vendor */
        if ( $is_multi_vendor_premium_installed && $is_multi_vendor_installed ) {
            $obj = YITH_Vendors()->frontend;
            remove_action( 'woocommerce_archive_description', array( $obj, 'add_store_page_header' ) );
            add_action( 'yith_before_shop_page_meta', array( $obj, 'add_store_page_header' ) );
            add_action( 'yith_before_no_products_found_message', array( $obj, 'add_store_page_header' ) );
            add_filter( 'yith_wpv_quick_info_button_class', 'yith_multi_vendor_button_class' );
            add_filter( 'yith_wpv_report_abuse_button_class', 'yith_multi_vendor_button_class' );
        }

        if ( !function_exists( 'yith_multi_vendor_quick_info_button_class' ) ) {

            /**
             * YITH Plugins support -> Multi Vendor widgets submit button
             *
             * @param string $class
             *
             * @return string
             * @since 1.0
             */
            function yith_multi_vendor_button_class( $class ) {
                return 'btn btn-flat-green alignright';
            }
        }

        /* ===== MULTI VENDOR ====== */

        if ( $is_multi_vendor_installed ) {

            if( ! function_exists( 'yit_contact_form_to_vendor' ) ) {
                function yit_contact_form_to_vendor( $to ){
                    $vendor_email = false;
                    if( ! empty( $_POST['yit_contact']['product_id'] ) && yit_get_option( 'send-email-to-vendor' ) == 'yes' ){
                        $vendor = yith_get_vendor( $_POST['yit_contact']['product_id'], 'product' );
                        if( $vendor->is_valid() ){
                            $vendor_email = $vendor->store_email;
                            if( empty( $vendor_email ) ){
                                $vendor_owner = get_user_by( 'id', absint( $vendor->get_owner() ) );
                                $vendor_email = $vendor_owner instanceof WP_User ? $vendor_owner->user_email : false;
                            }
                        }
                    }
                    return $vendor_email ? $vendor_email : $to;
                }
            }

            add_filter( 'yit_contact_form_email_to', 'yit_contact_form_to_vendor' );
        }

        /* =============================' */

        /* === YITH WooCommerce Advanced Review */

        if ( defined( 'YITH_YWAR_VERSION' ) ) {

            global $YWAR_AdvancedReview;

            remove_action( 'yith_advanced_reviews_before_reviews', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );

            add_action( 'yith_advanced_reviews_before_review_list', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );

        }


        if ( defined( 'YITH_YWAR_PREMIUM' ) ) {
            add_filter( 'yith_advanced_reviews_loader_gif', 'yit_loading_search_icon' );
        }


        /* === YITH WooCommerce Product Countdown */

        if ( defined( 'YWPC_PREMIUM' ) ) {

            add_filter( 'ywpc_shortcode_div_loop_class', 'ywpc_div_loop_class' );
            add_filter( 'ywpc_widget_div_loop_class', 'ywpc_div_loop_class' );
            add_filter( 'ywpc_shortcode_ul_loop_class', 'ywpc_ul_loop_class' );
            add_filter( 'ywpc_widget_ul_loop_class', 'ywpc_ul_loop_class' );

            if ( !function_exists( 'ywpc_div_loop_class' ) ) {

                /**
                 * YITH Plugins support -> Product Countdown loop class
                 *
                 * @param string $class
                 *
                 * @return string
                 * @since 1.0
                 */
                function ywpc_div_loop_class( $class ) {
                    return 'row';
                }
            }

            if ( !function_exists( 'ywpc_ul_loop_class' ) ) {

                /**
                 * YITH Plugins support -> Product Countdown loop class
                 *
                 * @param string $class
                 *
                 * @return string
                 * @since 1.0
                 */
                function ywpc_ul_loop_class( $class ) {
                    return 'clearfix' . ( ( yit_get_option( 'shop-view-type' ) == 'masonry_item' ) ? 'masonry' : '' );
                }
            }

        }

        /* ===== WISHLIST ====== */

        if( defined( 'YITH_WCWL' ) ) {

            add_action( 'woocommerce_account_myaccount-wishlist_endpoint' , 'yit_wishlist_content' );

            function yit_wishlist_content() {
                echo do_shortcode( '[yith_wcwl_wishlist]' );
            }

        }

        /* ===================== */

        /* === WPML === */

        function yit_wpml_endpoint_hack_for_after() {
            global $yit_wpml_hack_endpoint;
            $yit_wpml_hack_endpoint = WC()->query->query_vars;
            // add the options
            foreach ( $yit_wpml_hack_endpoint as $endpoint => $value ) {
                add_option( 'woocommerce_myaccount_' . $endpoint . '_endpoint', $value );
            }
        }

        add_action( 'after_setup_theme', 'yit_wpml_endpoint_hack_for_after', 11 );

        function yit_wpml_my_account_endpoint() {
            global $woocommerce_wpml, $yit_wpml_hack_endpoint;

            if ( !isset( $woocommerce_wpml->endpoints ) ) {
                return;
            }

            $endpoints = array(
                'recent-downloads',
                'myaccount-wishlist',
            );

            $wc_vars = WC()->query->query_vars;

            foreach ( $endpoints as $endpoint ) {
                if ( !isset( $yit_wpml_hack_endpoint[$endpoint] ) ) {
                    return;
                }

                $wc_vars_endpoint = isset( $wc_vars[ $endpoint ] ) ? $wc_vars[ $endpoint ] : $endpoint;

                WC()->query->query_vars[$endpoint] = $woocommerce_wpml->endpoints->get_endpoint_translation( $yit_wpml_hack_endpoint[$endpoint] , $wc_vars_endpoint );
            }

            unset( $yit_wpml_hack_endpoint );
        }

        add_action( 'init', 'yit_wpml_my_account_endpoint', 3 );


    }

}

add_filter( 'yith_wccl_add_to_cart_button_content', 'yit_wccl_add_to_cart_button_content' );

function yit_wccl_add_to_cart_button_content() {

    $text = yit_image( "echo=no&src=" . yit_get_option( 'shop-mini-cart-icon' ) . "&getimagesize=1&class=icon-add-to-cart&alt=" . __( 'Add to cart icon', 'yit' ) );
    $text .= '<span>' . apply_filters( 'add_to_cart_text', __( 'Add to cart', 'yit' ) ) . '</span>';

    return $text;
}

/* ********************** */
/* ***** WC 2.6 FIX ***** */
/* ********************** */

if ( version_compare( WC()->version, '2.6', '>=' ) ) {

    // My Account
    add_filter( 'woocommerce_account_menu_items' , 'yit_woocommerce_account_menu_items' );
    
    // Loop
    add_filter( 'post_class', 'yit_wc_product_post_class', 30, 3 );
    add_filter( 'product_cat_class', 'yit_wc_product_product_cat_class', 30, 3 );

    // remove unused template
    yit_wc_2_6_removed_unused_template() ;
    
}

/**
 * @author Andre Frascaspata
 */
function yit_wc_2_6_removed_unused_template () {

    if( function_exists( 'yit_remove_unused_template' ) ) {

        $option = 'yit_wc_2_6_template_remove';

        $files = array(
            'checkout/form-shipping.php',
            'myaccount/form-login.php',
            'myaccount/my-account.php',
            'myaccount/my-account-menu.php',
            'single-product/review.php',
            'single-product/share.php',
        );

        yit_remove_unused_template( 'woocommerce' , $option , $files );

    }

}

/*
 *  Remove unused templates in 3.1 version
 */

if ( version_compare( WC()->version, '3.1', '>=' ) ) {
    if( function_exists( 'yit_remove_unused_template' ) ) {

        $option = 'yit_wc_3_1_template_remove';

        $files = array(
            'cart/cart-empty.php',
        );

        yit_remove_unused_template( 'woocommerce' , $option , $files );
    }
}

if ( ! function_exists( 'yit_woocommerce_account_menu_items' ) ) {
    /**
     * @author Andrea Frascaspata
     */
    function yit_woocommerce_account_menu_items( $menu_list ) {

        unset( $menu_list['customer-logout'] );

        $menu_list['orders']       = __( 'My Orders', 'yit' );
        $menu_list['downloads']    = __( 'My Downloads', 'yit' );
        $menu_list['edit-address'] = __( 'Edit Address', 'yit' );
        $menu_list['edit-account'] = __( 'Edit Account', 'yit' );

        if ( defined( 'YITH_WCWL' ) ) {
            $menu_list['myaccount-wishlist'] = __( 'My Wishlist', 'yit' );
        }

        return $menu_list;

    }
}

if ( ! function_exists( 'yit_get_myaccount_menu_icon' ) ) {

    /**
     * @param $endpoint
     * @return mixed|string
     * @author Andrea Frascaspata
     */
    function yit_get_myaccount_menu_icon( $endpoint ) {

        $icon_list = apply_filters( 'yit_get_myaccount_menu_icon_list_fa' , array(
                'dashboard'       => 'fa-book',
                'orders'          => 'fa-folder-open',
                'downloads'       => 'fa-download',
                'edit-address'    => 'fa-pencil-square-o',
                'payment-methods' => 'fa-credit-card',
                'edit-account'    => 'fa-pencil-square-o',
                'myaccount-wishlist'    => 'fa-heart-o', )
        );

        if( isset( $icon_list[ $endpoint ] ) ) {
            return $icon_list[ $endpoint ];
        } else {
            return '';
        }

    }

}

if ( ! function_exists( 'yit_wc_product_post_class' ) ) {
    /**
     * @param        $classes
     * @param string $class
     * @param string $post_id
     *
     * @return array
     */
    function yit_wc_product_post_class( $classes, $class = '', $post_id = '' ) {

        global $product, $woocommerce_loop;

        if ( ( !isset( $woocommerce_loop['name'] ) || empty( $woocommerce_loop['name'] ) ) && !isset( $woocommerce_loop['view'] ) ) {
            return $classes;
        }

        // check if is mobile
        $isMobile = YIT_Mobile()->isMobile();
        $isPhone = $isMobile && ! YIT_Mobile()->isTablet();
        $isIPad = wp_is_mobile() && preg_match( '/iPad/', $_SERVER['HTTP_USER_AGENT'] );

        $woocommerce_loop['shown_product'] = true;

        // view
        if ( ! isset( $woocommerce_loop['view'] ) ) {
            $woocommerce_loop['view'] = yit_get_option( 'shop-view-type', 'grid' );
        }

        $classes[] = $woocommerce_loop['view'];

        //product countdown compatibility

        global $ywpc_loop;
        if ( $ywpc_loop && $ywpc_loop == 'ywpc_widget' ) {
            $woocommerce_loop['view'] = 'grid';
        }

        //--------------------------

        // Set column
        if ( ( is_shop() || is_product_category() || is_product_taxonomy() ) && ! $isMobile && yit_get_option( 'shop-custom-num-column' ) == 'yes' ) {
            $column_value = apply_filters( 'loop_shop_columns', intval( yit_get_option( 'shop-num-column' ) ) );
            $classes[] = 'col-sm-' . intval( 12 / $column_value );
            $woocommerce_loop['columns']    =  $column_value;
        }
        else if ( isset( $woocommerce_loop['product_in_a_row'] ) ){
           $product_in_a_row =  $woocommerce_loop['product_in_a_row'];
           $classes[] = 'col-sm-' . intval( 12 / intval( $product_in_a_row ) ) . ' col-xs-6';
           $woocommerce_loop['columns']    = intval( $product_in_a_row );
        }
        elseif( isset( $featured_widget ) ) {
            $woocommerce_loop['columns'] = '1';
        }
        else {

            $sidebar = YIT_Layout()->sidebars;

            if ( $sidebar['layout'] == 'sidebar-double' ) {
                $classes[] = 'col-sm-4 col-xs-4';
                $woocommerce_loop['columns']    = '3';
            }
            elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
                $classes[] = 'col-sm-3 col-xs-4';
                $woocommerce_loop['columns']    = '4';
            }
            else {
                $classes[] = 'col-sm-2 col-xs-4';
                $woocommerce_loop['columns']    = '6';
            }
        }

        //Set columns and class mobile phone
        $row_mobile_value = yit_get_option( 'shop-products-per-row-mobile' );
        $row_mobile = intval( ! empty( $row_mobile_value ) ? $row_mobile_value : 2 );


        if( $isPhone && ! isset( $featured_widget ) ) {
            $classes[]   = 'col-xxs-' . intval( 12 / $row_mobile );
            $woocommerce_loop['columns']      = $row_mobile;
        }

        return $classes;

    }
    
}

if ( ! function_exists( 'yit_wc_product_product_cat_class' ) ) {
    function yit_wc_product_product_cat_class( $classes, $class, $category ) {

        global $woocommerce_loop;

        // check if is mobile
        $isMobile = YIT_Mobile()->isMobile();
        $isPhone = $isMobile && ! YIT_Mobile()->isTablet();

        // Store loop count we're currently on
        if ( empty( $woocommerce_loop['loop'] ) ) {
            $woocommerce_loop['loop'] = 0;
        }

        //standard li class
        $classes[] = 'product-category product';

        $sidebar = YIT_Layout()->sidebars;

        if ( $sidebar['layout'] == 'sidebar-double' ) {
            $classes[] = 'col-sm-6 col-xs-6';
            $woocommerce_loop['columns']    = '2';
        }
        elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
            $classes[] = 'col-sm-4 col-xs-6';
            $woocommerce_loop['columns']    = '3';
        }
        else {
            $classes[] = 'col-sm-3 col-xs-6';
            $woocommerce_loop['columns']    = '4';
        }

        //Set columns and class mobile phone
        $row_mobile_value = yit_get_option( 'shop-products-per-row-mobile' );
        $row_mobile = intval( ! empty( $row_mobile_value ) ? $row_mobile_value : 2 );

        if( $isPhone ) {
            $classes[]   = 'col-xxs-' . intval( 12 / $row_mobile );
            $woocommerce_loop['columns']      = $row_mobile;
        }

        // Increase loop count
        $woocommerce_loop['loop'] ++;

        return $classes;

    }
}

/* ********************** */
/* ***** END WC 2.6 ***** */
/* ********************** */

/* ********************** */
/* ***** WC 3.0 FIX ***** */
/* ********************** */

if ( ! IS_PRIOR_3_0 ) {
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    // Review
    remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
    add_action( 'woocommerce_review_meta', 'yit_woocommerce_review_display_meta', 15 );
}

/**
 * @param $comment
 * author Andrea Frascaspata
 */
function yit_woocommerce_review_display_meta( $comment ) {

    $rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

    ?>

    <div class="woocommerce-product-rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'yit' ), $rating ) ?>">
        <div class="star-rating">
            <span style="width:<?php echo ( ( $rating / 5 ) * 100 ) ?>%"></span>
        </div>
        <meta itemprop="ratingValue" content="<?php echo $rating; ?>" />
    </div>

    <?php

}

/* ********************** */
/* ***** END WC 3.0 ***** */
/* ********************** */
