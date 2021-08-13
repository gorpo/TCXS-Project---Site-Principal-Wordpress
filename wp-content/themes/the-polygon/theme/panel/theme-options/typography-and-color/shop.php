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
 * Return an array with the options for Theme Options > Typography and Color > Shop
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @author  Francesco Licandro <francesco.licandro@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'General Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'    => 'shop-general-background-section',
        'type'  => 'colorpicker',
        'name'  => __( 'General section background color', 'yit' ),
        'desc'  => __( 'Choose background color for shop section like cart totals or add to cart form.', 'yit' ),
        'std'   => array(
            'color' => '#fafafa'
        ),
        'style' => array(
            'selectors'     => '#review-order-wrapper,
                                .woocommerce .coupon-form-checkout,
                                .woocommerce .login-form-checkout,
                                .woocommerce ul.order_info,
                                #customer_login form.login',
            'properties'    => 'background-color'
        )
    ),

    array(
        'id'    => 'shop-in-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Stock Quantity" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Stock Quantity" label.', 'yit' ),
        'std'   => array(
            'color' => '#85ad74'
        ),
        'style' => array(
            'selectors'  => '.woocommerce div.product .stock,
                             .woocommerce-page div.product .stock,
                             .wishlist_table tr td.product-stock-status span.wishlist-in-stock',
            'properties' => 'color'
        )
    ),

    /* Typography and Color > Shop > Shop Page */
    array(
        'type' => 'title',
        'name' => __( 'Shop Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-page-product-name-font',
        'type'            => 'typography',
        'name'            => __( 'Product title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#2f2f2f',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.product-meta-wrapper h3.product-name,
                             .product-meta-wrapper h3.product-name a,
                             #product-nav > a h5,
                             .woocommerce table.cart td.product-name div.product-name a,
                             .widget.woocommerce ul.product_list_widget a .product_title,
                             .widget.featured-products div.info-featured-product .product_name,
                             .wishlist_table tr td.product-name a,
                             .added-to-cart-popup .added_to_cart h3.product-name,
                             .widget.yit_products_category ul.product_list_widget a .product_title,
                             .lookbook-listed-product .lookbook-information a,
                             .single-product.woocommerce div.product div.summary form.cart table.group_table tr td.label a,
                             .widget.yith-woocompare-widget ul.products-list li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-product-categories-in-title-font',
        'type'            => 'typography',
        'name'            => __( 'Product categories font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#787878',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => 'ul.products li.product .product-wrapper .product-meta-wrapper span.product-categories,
                             ul.products li.product .product-wrapper .product-meta-wrapper span.product-categories a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-product-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#2f2f2f',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.product-meta-wrapper .price,
                             .widget.woocommerce ul.product_list_widget span.product_price,
                             .widget.featured-products div.info-featured-product .price,
                             #yith-wcwl-form table.shop_table td.product-price,
                             .lookbook-listed-product .lookbook-information .lookbook-product-price,
                             .single-product.woocommerce div.product div.summary table.group_table .price',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-product-button-font',
        'type'            => 'typography',
        'name'            => __( 'Product "Add to cart" font', 'yit' ),
        'desc'            => __( 'Choose the font type and size.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 10,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => 'ul.products li.product .product-wrapper .product-actions-wrapper .product-action-button a,
                             ul.products li.product .product-wrapper .product-actions-wrapper .product-action-button span,
                             .yith-ywraq-add-button .add-request-quote-button.button,
                             .yith_ywraq_add_item_response_message,
                             .yith_ywraq_add_item_browse_message,
                             .product-special-button a.trigger-quick-view,
                             .quick-view-overlay .added-to-cart-icon,
                             .product-special-button a.yith-wcqv-button,
                             ul.products li.product .product-wrapper .product_actions_container a.compare,
			                ul.products li.product .product-wrapper .yith-wcdp a,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay,
							.woocommerce table.shop_table.order_details tr.order_item td a.view',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-page-layout-selector',
        'type'            => 'typography',
        'name'            => __( 'Page and Layout Selector font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '600',
            'color'     => '#6d6c6c',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#list-or-grid span, #number-of-products span,
                            #page-meta form.woocommerce-ordering .sbHolder .sbSelector,
                            #header-search .search_categories,
                            #page-meta .woocommerce-ordering .sbHolder .sbOptions li a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-notice-font',
        'type'            => 'typography',
        'name'            => __( 'Woocommerce Notice font', 'yit' ),
        'desc'            => __( 'Choose the font type and size.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '600',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.woocommerce-info, .woocommerce-message, .woocommerce-error li, .login-form-checkout > p, .coupon-form-checkout > p',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'    => 'shop-out-of-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Out of Stock" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Out of Stock" label.', 'yit' ),
        'std'   => array(
            'color' => '#ff1800'
        ),
        'style' => array(
            'selectors'  => 'ul.products li.product .product-wrapper .product-actions-wrapper .product-action-button span.out-of-stock',
            'properties' => 'color'
        )
    ),

    array(
        'id'    => 'shop-product-overlay-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Product hover overlay background color', 'yit' ),
        'desc'  => __( 'Select the color to use as overlay on your product when other actions are enabled ( quick-view, wishlist, compare and similar ) ', 'yit' ),
        'std'   => array(
            'color'   => '#7caf00',
            'opacity' => 60,
        ),
        'style' => array(
            'selectors'  => 'ul.products li.product .product-wrapper:hover .product-special-button',
            'properties' => 'background-color'
        )
    ),

    /* Typography and Color > Shop > Product Detail Page */

    array(
        'type' => 'title',
        'name' => __( 'Single Product Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-single-product-name-font',
        'type'            => 'typography',
        'name'            => __( 'Product name font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 25,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#222222',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary h1,
                             .single-product.woocommerce div.product div.product-title-section h1',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 20,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary .price, .woocommerce.sc_add_to_cart .sc_add_to_cart_price .amount',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-label-font',
        'type'            => 'typography',
        'name'            => __( 'Product page label font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary form.cart h4,
                            .single-product.woocommerce div.product form.cart ul.variations label,
                            .single-product.woocommerce div.product form.cart table.variations td.label,
                            .share-link-wrapper .share-label,
                            div.summary.entry-summary form.variations_form.cart .single_variation_wrap h4,
                            div.product-inquiry span.inquiry-title,
                            #modal-window .modal-opener a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-tabs-font',
        'type'            => 'typography',
        'name'            => __( 'Product tabs title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#898989',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.single-product.woocommerce div.woocommerce-tabs ul.tabs li a,
                             .tabs-container ul.tabs li a,
                             .wpb_content_element.wpb_tabs .ui-tabs > ul li a,
                             .tabs-container ul.tabs li h4 a:after',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'    => 'product-tabs-active-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Product tabs title active color', 'yit' ),
        'desc'  => __( 'Choose the color for the active tab title', 'yit' ),
        'std'   => array(
            'color' => '#434343'
        ),
        'style' => array(
            'selectors'  => '.tabs-container ul.tabs li.current a, .tabs-container ul.tabs li a:hover',
            'properties' => 'color'
        )
    ),

    array(
        'id'    => 'single-out-of-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Single Page "Out of Stock" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Out of Stock" label.', 'yit' ),
        'std'   => array(
            'color' => '#6d6c6c'
        ),
        'style' => array(
            'selectors'  => '.single-product.woocommerce div.product div.summary p.stock.out-of-stock',
            'properties' => 'color'
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Single Product Reviews', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-single-product-reviews-title',
        'type'            => 'typography',
        'name'            => __( 'Product name font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#reviews #comments .commentlist .comment-meta .meta,
                             #reviews #comments .commentlist .comment-meta .meta time',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'shop-single-product-new-review-title',
        'type'            => 'typography',
        'name'            => __( 'Product name font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#7caf00',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#review_form_wrapper #reply-title',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),


    /* Typography and Color > Shop > My-Account page */
    array(
        'type' => 'title',
        'name' => __( 'My Account Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'my-account-page-menu-font',
        'type'            => 'typography',
        'name'            => __( 'My Account sidebar menu font', 'yit' ),
        'desc'            => __( 'Choose the font type and size.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#my-account-sidebar ul li > a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'              => 'my-account-page-slogan-font',
        'type'            => 'typography',
        'name'            => __( 'My Account slogan font', 'yit' ),
        'desc'            => __( 'Choose the font type and size.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 25,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#slogan.yit-my-account-slogan h1,
                             #slogan.yit-my-account-slogan h1 span,
                             #slogan.yit-my-account-slogan h2,
                             #slogan.yit-my-account-slogan h2 span,
                             #slogan.yit-cart-checkout-slogan h1,
                             #slogan.yit-cart-checkout-slogan h1 span,
                             #slogan.yit-cart-checkout-slogan h2,
                             #slogan.yit-cart-checkout-slogan h2 span',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              text-transform'
        )
    ),

    array(
        'id'            => 'my-account-page-menu-color',
        'type'          => 'colorpicker',
        'variations'    => array(
            'normal' => __( 'Normal', 'yit' ),
            'hover'  => __( 'Hover', 'yit' )
        ),
        'name' => __( 'My Account sidebar menu color', 'yit' ),
        'desc' => __( 'Select the colors to use for the my account menu.', 'yit' ),
        'std'  => array(
            'color' => array(
                'normal' => '#9c9c9c',
                'hover'  => '#0e0d0d'
            )
        ),
        'style' => array(
            'normal' => array(
                'selectors'   => '#my-account-sidebar ul li > a',
                'properties'  => 'color'
            ),
            'hover' => array(
                'selectors'   => '#my-account-sidebar ul li > a:hover,
                                  #my-account-sidebar ul li > a.active',
                'properties'  => 'color'
            )
        )
    ),


    array(
        'id'              => 'my-account-content-title-font',
        'type'            => 'typography',
        'name'            => __( 'My Account content title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#6d6c6c',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#my-account-content h2,
                             #my-account-sidebar .user-profile span.username',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),


    array(
        'type' => 'title',
        'name' => __( 'Widget List Products', 'yit' ),
        'desc' => ''
    ),


    array(
        'id'              => 'shop-widget-price-font',
        'type'            => 'typography',
        'name'            => __( 'Widget Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#939393',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.widget.woocommerce ul.product_list_widget a span.product_price,
                            .single-product.woocommerce ul.product_list_widget a span.product_price,
                             .widget.yit_products_category a span.product_price',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'type' => 'title',
        'name' => __( 'Widget Single Product', 'yit' ),
        'desc' => ''
    ),


    array(
        'id'              => 'shop-widget-single-product-title',
        'type'            => 'typography',
        'name'            => __( 'Widget Single Product title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 17,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'color'     => '#2f2f2f',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.show-single-product.show-single-product-two ul.products li.product .product-wrapper .product-info .product-meta-wrapper h3,
                            .show-single-product.show-single-product-two ul.products li.product .product-wrapper .product-info .product-meta-wrapper h3 a',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Cart Header Widget', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-cart-header-widget-label-font',
        'type'            => 'typography',
        'name'            => __( 'Cart header title', 'yit' ),
        'desc'            => __( 'Select the font to use for the title before the products list.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#7caf00',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '#header .widget_shopping_cart .widget_shopping_cart_content h5.list-title, #header .widget_shopping_cart .widget_shopping_cart_content p.total,
            .widget_shopping_cart .widget_shopping_cart_content .total span',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'shop-cart-header-background-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'icon-background'     => __( 'Icon Background', 'yit' ),
            'total-background' => __( 'Total Background', 'yit' ),
        ),
        'name'       => __( 'Mini Cart Header Widget Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header mini cart widget icon and total background', 'yit' ),
        'std'        => array(
            'color' => array(
                'icon-background'     => '#9bdb00',
                'total-background' => '#7caf00',
            )
        ),
        'style'      => array(
            'icon-background'     => array(
                'selectors'  => '.widget_shopping_cart span.yit-mini-cart-image',
                'properties' => 'background'
            ),
            'total-background' => array(
                'selectors'  => '.widget_shopping_cart span.yit-mini-cart-icon',
                'properties' => 'background'
            )
        )
    ),

    array(
        'id'         => 'shop-cart-header-widget-link-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'     => __( 'Link', 'yit' ),
            'hover' => __( 'Link hover', 'yit' ),
        ),
        'name'       => __( 'Cart Header Widget Link Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header cart link', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'    => '#787878',
                'hover'     => '#5b8000',
            )
        ),
        'style'      => array(
            'normal'     => array(
                'selectors'  => '
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a,
                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a,
                .widget_shopping_cart .widget_shopping_cart_content .mini-cart-item-info a:visited,
                div.yit_cart_widget .product_list_widget .mini-cart-item-info a,
                .widget_shopping_cart .widget_shopping_cart_content .mini-cart-item-info a,
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal,
                #header .widget_shopping_cart .widget_shopping_cart_content .total span.amount,
                .widget_shopping_cart .widget_shopping_cart_content a.remove,
                .widget.woocommerce.widget_recent_reviews ul.product_list_widget li a,
                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info .subtotal',
                'properties' => 'color'
            ),
            'hover' => array(
                'selectors'  => '
                .woocommerce #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a:hover,
                #header-sidebar > div.yit_cart_widget .product_list_widget .mini-cart-item-info a:hover,
                div.yit_cart_widget .product_list_widget .mini-cart-item-info a:hover,
                .widget.woocommerce.widget_recent_reviews ul.product_list_widget li a:hover,
                .widget_shopping_cart .widget_shopping_cart_content a.remove:hover',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'shop-cart-header-widget-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Cart Header Widget Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header cart widget border and background', 'yit' ),
        'std'        => array(
            'color' => array(
                'border'     => '#dbd8d8',
                'background' => '#ffffff',
            )
        ),
        'style'      => array(
            'border'     => array(
                'selectors'  => '.woocommerce #header-sidebar .yit_cart_widget .cart_wrapper .widget_shopping_cart_content, #header-sidebar .yit_cart_widget .cart_wrapper .widget_shopping_cart_content',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '.woocommerce #header-sidebar .yit_cart_widget .cart_wrapper .widget_shopping_cart_content, #header-sidebar .yit_cart_widget .cart_wrapper .widget_shopping_cart_content',
                'properties' => 'background'
            )
        )
    )
);

