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
 * Return an array with the options for Theme Options > Typography and Color > Buttons
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Buttons */

	array(
		'type' => 'title',
		'name' => __( 'Buttons Ghost', 'yit' ),
		'desc' => ''
	),

	array(
		'id'              => 'button-ghost-font',
		'type'            => 'typography',
		'name'            => __( 'Buttons Typography', 'yit' ),
		'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
		'min'             => 1,
		'max'             => 80,
		'default_font_id' => 'typography-website-title',
		'std'             => array(
			'size'      => 12,
			'unit'      => 'px',
			'family'    => 'default',
			'style'     => '700',
			'transform' => 'uppercase',
		),
		'style'           => array(
			'selectors'  => '.btn-ghost, a.btn-ghost, .price-table div.button-container a.btn-flat, .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes,
							ul.products li.product .product-wrapper .product_actions_container a.compare',

			'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
		)
	),

	array(
		'id'         => 'button-ghost-text-color',
		'type'       => 'colorpicker',
		'name'       => __( 'Buttons Text color', 'yit' ),
		'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
		'variations' => array(
			'normal' => __( 'Text color', 'yit' ),
			'hover'  => __( 'Text hover color', 'yit' )
		),
		'std'        => array(
			'color' => array(
				'normal' => '#787878',
				'hover'  => '#ffffff'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-ghost, a.btn-ghost, a.btn-ghost.added,
				                 .price-table div.button-container a.btn-flat,
				                 .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes,
                                 .btn.btn-ghost i.fa,
								ul.products li.product .product-wrapper .product_actions_container a.compare',

				'properties' => 'color'
			),
			'hover'  => array(
				'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover,
                                .btn.btn-ghost:hover i.fa,
                                .price-table div.button-container a.btn-flat:hover,
                                .woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes:hover,
                                .btn.btn-ghost i.fa:hover,
								ul.products li.product .product-wrapper .product_actions_container a.compare:hover',

				'properties' => 'color'
			)
		)
	),

	array(
		'id'         => 'button-ghost-border-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Border color', 'yit' ),
			'hover'  => __( 'Border hover color', 'yit' )
		),
		'name'       => __( 'Buttons border color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#787878',
				'hover'  => '#787878'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-ghost, a.btn-ghost, .price-table div.button-container a.btn-flat,
								.woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes,
								ul.products li.product .product-wrapper .product_actions_container a.compare',

				'properties' => 'border-color'
			),
			'hover'  => array(
				'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover, .price-table div.button-container a.btn-flat:hover,
								.woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes:hover,
								ul.products li.product .product-wrapper .product_actions_container a.compare:hover',
				'properties' => 'border-color'
			)
		)
	),

	array(
		'id'         => 'button-ghost-background-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Background color', 'yit' ),
			'hover'  => __( 'Background hover color', 'yit ' )
		),
		'name'       => __( 'Buttons background color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => 'transparent',
				'hover'  => '#787878'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-ghost, a.btn-ghost, .price-table div.button-container a.btn-flat,
								.woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes,
								ul.products li.product .product-wrapper .product_actions_container a.compare',

				'properties' => 'background-color, background'
			),
			'hover'  => array(
				'selectors'  => '.btn-ghost:hover, a.btn-ghost:hover, .price-table div.button-container a.btn-flat:hover,
								.woocommerce .wishlist_manage_table tfoot button.submit-wishlist-changes:hover,
								ul.products li.product .product-wrapper .product_actions_container a.compare:hover',

				'properties' => 'background-color, background'
			)
		)
	),

	array(
		'type' => 'title',
		'name' => __( 'Buttons Flat Green', 'yit' ),
		'desc' => ''
	),

	array(
		'id'              => 'button-flat-green-font',
		'type'            => 'typography',
		'name'            => __( 'Buttons Typography', 'yit' ),
		'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
		'min'             => 1,
		'max'             => 80,
		'default_font_id' => 'typography-website-title',
		'std'             => array(
			'size'      => 12,
			'unit'      => 'px',
			'family'    => 'default',
			'style'     => '700',
			'transform' => 'uppercase',
		),
		'style'           => array(
			'selectors'  => '.btn-flat-green, a.btn-flat-green,a.comment-reply-link, a.stop-reply, .login-form-checkout input.button, #commentform #submit,
			                .wishlist_table .add_to_cart.button,
			                .price-table div.button-container a.btn-alternative,
			                #my-account-content div.woocommerce form p input[type="submit"],
			                .widget.widget_price_filter button[type="submit"],
			                table.compare-list .add-to-cart td a span,
			                .yith-woocompare-widget a.compare.button,
			                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a,
			                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"],
			                a.wihslist-submit.add_to_wishlist,
                            .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                            .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist,
			                input#place_order,
			                #yith-ywraq-form td.actions input.button,
			                .woocommerce-cart-notice a.button, .my_account_orders td.order-actions a.track-button,
			                .variations_button .single_add_to_cart_button.button.alt,
			                .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button,
			                input.button.raq-send-request,
			                ul.products li .product-wrapper .thumb-wrapper .onsale, .single-product.woocommerce div.product div.images span.onsale,
			                a.button,
			                .widget.yith-woo-ajax-reset-navigation a.yith-wcan-reset-navigation,
			                #searchform #searchsubmit,
			                .yith-wacp-related ul.products li.product .product-image .onsale,
			                a.wihslist-submit.add_to_wishlist, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button, .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist,
			                ul.products li.product .product-wrapper .yith-wcdp a,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay,
							.woocommerce table.shop_table.order_details tr.order_item td a.view',

			'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
		)
	),

	array(
		'id'         => 'button-flat-green-text-color',
		'type'       => 'colorpicker',
		'name'       => __( 'Buttons Text color', 'yit' ),
		'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
		'variations' => array(
			'normal' => __( 'Text color', 'yit' ),
			'hover'  => __( 'Text hover color', 'yit' )
		),
		'std'        => array(
			'color' => array(
				'normal' => '#ffffff',
				'hover'  => '#ffffff'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-green, a.btn-flat-green, a.btn-flat-green.added,
                                a.comment-reply-link, a.stop-reply, .login-form-checkout input.button, #commentform #submit,
                                .btn.btn-flat-green i.fa, .wishlist_table .add_to_cart.button,
                                .price-table div.button-container a.btn-alternative,
                                #my-account-content div.woocommerce form p input[type="submit"],
                                .widget.widget_price_filter button[type="submit"],
                                table.compare-list .add-to-cart td a span,
                                .yith-woocompare-widget a.compare.button,
                                a.wihslist-submit.add_to_wishlist,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                                .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist,
                                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a,
                                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"],
                                input#place_order,
                                #yith-ywraq-form td.actions input.button,
                                .woocommerce-cart-notice a.button, .my_account_orders td.order-actions a.track-button,
                                .variations_button .single_add_to_cart_button.button.alt,
                                a.add_to_cart_button,
                                .blog_section ul.post-categories li a,
                                .blog .thumbnail ul.post-categories li a,
                                .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button,
                                input.button.raq-send-request,
                                ul.products li .product-wrapper .thumb-wrapper .onsale, .single-product.woocommerce div.product div.images span.onsale,
                                a.button,
                                .widget.yith-woo-ajax-reset-navigation a.yith-wcan-reset-navigation,
                                #searchform #searchsubmit,
                                .yith-wacp-related ul.products li.product .product-image .onsale,
                                a.wihslist-submit.add_to_wishlist, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button, .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist,
			                ul.products li.product .product-wrapper .yith-wcdp a,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay,
							.woocommerce table.shop_table.order_details tr.order_item td a.view',

				'properties' => 'color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-green:hover, a.btn-flat-green:hover, a.comment-reply-link:hover, a.stop-reply:hover, .login-form-checkout input.button:hover, #commentform #submit:hover,
                                .btn.btn-flat-green:hover i.fa,
                                .btn.btn-flat-green i.fa:hover,
                                .btn-flat-green:focus, .btn-flat-green.focus,
                                .price-table div.button-container a.btn-alternative:hover,
                                .wishlist_table .add_to_cart.button:hover,
                                #my-account-content div.woocommerce form p input[type="submit"]:hover,
                                .widget.widget_price_filter button[type="submit"]:hover,
                                table.compare-list .add-to-cart td a span:hover,
                                .yith-woocompare-widget a.compare.button:hover,
                                a.wihslist-submit.add_to_wishlist,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover,
                                .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist:hover,
                                .yes-js .yith-wcwl-popup-content a.wihslist-submit.add_to_wishlist:hover,
                                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a:hover,
                                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]:hover,
                                input#place_order:hover,input#place_order:focus,
                                #yith-ywraq-form td.actions input.button:hover,
                                .woocommerce-cart-notice a.button:hover, .my_account_orders td.order-actions a.track-button:hover,
                                .variations_button .single_add_to_cart_button.button.alt:hover,
                                a.add_to_cart_button:hover,
                                .blog_section ul.post-categories li a:hover,
                                .blog .thumbnail ul.post-categories li a:hover,
                                .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button:hover,
                                input.button.raq-send-request:hover,
                                a.button:hover,
                                .widget.yith-woo-ajax-reset-navigation a.yith-wcan-reset-navigation:hover,
                                #searchform #searchsubmit:hover,
                                a.wihslist-submit.add_to_wishlist:hover, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover, .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist:hover,
			                ul.products li.product .product-wrapper .yith-wcdp a:hover,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay:hover,
							.woocommerce table.shop_table.order_details tr.order_item td a.view:hover',

				'properties' => 'color'
			)
		)
	),

	array(
		'id'         => 'button-flat-green-border-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Border color', 'yit' ),
			'hover'  => __( 'Border hover color', 'yit' )
		),
		'name'       => __( 'Buttons border color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#7caf00',
				'hover'  => '#5b8000'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-green, a.btn-flat-green, a.comment-reply-link, a.stop-reply, .login-form-checkout input.button, #commentform #submit,
                                 .wishlist_table .add_to_cart.button,
                                 .price-table div.button-container a.btn-alternative,
                                 .show-products.show-products-list ul.products li.product.list .product-wrapper .product-actions-wrapper .product-action-button,
                                 #my-account-content div.woocommerce form p input[type="submit"],
                                 .widget.widget_price_filter button[type="submit"],
                                 table.compare-list .add-to-cart td a span,
                                 .yith-woocompare-widget a.compare.button,
                                 a.wihslist-submit.add_to_wishlist,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                                .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist,
                                 .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a,
                                 div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"],
                                 input#place_order,
                                 #yith-ywraq-form td.actions input.button,
                                 .woocommerce-cart-notice a.button, .my_account_orders td.order-actions a.track-button,
                                 .variations_button .single_add_to_cart_button.button.alt,
                                 a.add_to_cart_button,
                                  .blog_section ul.post-categories li a,
                                  .blog .thumbnail ul.post-categories li a,
                                  #review_form #respond,
                                  .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button,
                                  input.button.raq-send-request,
                                  ul.products li .product-wrapper .thumb-wrapper .onsale, .single-product.woocommerce div.product div.images span.onsale,
                                  a.button,
                                  .widget.yith-woo-ajax-reset-navigation a.yith-wcan-reset-navigation,
                                  #searchform #searchsubmit,
                                  .yith-wacp-related ul.products li.product .product-image .onsale,
                                  a.wihslist-submit.add_to_wishlist, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button, .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist,
			                ul.products li.product .product-wrapper .yith-wcdp a,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay,
							.woocommerce table.shop_table.order_details tr.order_item td a.view',

				'properties' => 'border-color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-green:hover, a.btn-flat-green:hover, a.comment-reply-link:hover, a.stop-reply:hover, .login-form-checkout input.button:hover, #commentform #submit:hover,
				                .wishlist_table .add_to_cart.button:hover,
				                .price-table div.button-container a.btn-alternative:hover,
				                #my-account-content div.woocommerce form p input[type="submit"]:hover,
				                .widget.widget_price_filter button[type="submit"]:hover,
				                table.compare-list .add-to-cart td a span:hover,
				                .yes-js .yith-wcwl-popup-content a.wihslist-submit.add_to_wishlist:hover,
				                .yith-woocompare-widget a.compare.button:hover,
				                .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button a:hover,
				                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]:hover,
				                input#place_order:hover,
				                #yith-ywraq-form td.actions input.button:hover,
				                .woocommerce-cart-notice a.button:hover, .my_account_orders td.order-actions a.track-button:hover,
				                .variations_button .single_add_to_cart_button.button.alt:hover,
				                a.add_to_cart_button:hover,
				                .blog_section ul.post-categories li a:hover,
				                .blog .thumbnail ul.post-categories li a:hover,
				                .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button:hover,
				                input.button.raq-send-request:hover,
				                a.button:hover,
				                .widget.yith-woo-ajax-reset-navigation a.yith-wcan-reset-navigation:hover,
				                #searchform #searchsubmit:hover,
				                a.wihslist-submit.add_to_wishlist:hover, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover, .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist:hover,
			                ul.products li.product .product-wrapper .yith-wcdp a:hover,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay:hover,
							.woocommerce table.shop_table.order_details tr.order_item td a.view:hover',
				'properties' => 'border-color'
			)
		)
	),

	array(
		'id'         => 'button-flat-green-background-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Background color', 'yit' ),
			'hover'  => __( 'Background hover color', 'yit ' )
		),
		'name'       => __( 'Buttons background color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#7caf00',
				'hover'  => '#5b8000'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-green, a.btn-flat-green, a.comment-reply-link, a.stop-reply, .login-form-checkout input.button, #commentform #submit,
				                 .wishlist_table .add_to_cart.button,
				                 .price-table div.button-container a.btn-alternative,
				                 #my-account-content div.woocommerce form p input[type="submit"],
				                 .widget.widget_price_filter button[type="submit"],
				                 table.compare-list .add-to-cart td a span,
				                 .yith-woocompare-widget a.compare.button,
				                 a.wihslist-submit.add_to_wishlist,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button,
                                .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist
				                 .show-single-product ul.products li.product .product-wrapper .product-actions-wrapper.with-wishlist .product-action-button,
				                 div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"],
				                 input#place_order,
				                 #yith-ywraq-form td.actions input.button,
				                 .woocommerce-cart-notice a.button, .my_account_orders td.order-actions a.track-button,
				                 .variations_button .single_add_to_cart_button.button.alt,
				                 a.add_to_cart_button,
				                 .blog_section ul.post-categories li a,
				                 .blog .thumbnail ul.post-categories li a,
				                 .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button,
				                 input.button.raq-send-request,
				                 ul.products li .product-wrapper .thumb-wrapper .onsale, .single-product.woocommerce div.product div.images span.onsale,
				                 a.button,
				                 .widget.yith-woo-ajax-reset-navigation a.yith-wcan-reset-navigation,
				                 #searchform #searchsubmit,
				                 .yith-wacp-related ul.products li.product .product-image .onsale,
				                 a.wihslist-submit.add_to_wishlist, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button, .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist,
			                ul.products li.product .product-wrapper .yith-wcdp a,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay,
							.woocommerce table.shop_table.order_details tr.order_item td a.view',

				'properties' => 'background-color, background'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-green:hover, a.btn-flat-green:hover, a.comment-reply-link:hover, a.stop-reply:hover, .login-form-checkout input.button:hover, #commentform #submit:hover,
				                .wishlist_table .add_to_cart.button:hover,
				                .price-table div.button-container a.btn-alternative:hover,
				                #my-account-content div.woocommerce form p input[type="submit"]:hover,
				                .widget.widget_price_filter button[type="submit"]:hover,
				                table.compare-list .add-to-cart td a span:hover,
				                .yith-woocompare-widget a.compare.button:hover,
                                .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover,
                                .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist:hover,
				                div:not( .header-wrapper ) .widget.woocommerce.widget_product_search input[type="submit"]:hover,
				                input#place_order:hover,
				                #yith-ywraq-form td.actions input.button:hover,
				                .woocommerce-cart-notice a.button:hover, .my_account_orders td.order-actions a.track-button:hover,
				                .variations_button .single_add_to_cart_button.button.alt:hover,
				                a.add_to_cart_button:hover,
				                .blog_section ul.post-categories li a:hover,
				                .blog .thumbnail ul.post-categories li a:hover,
				                .single-product .summary.entry-summary .yith-ywraq-add-to-quote .yith-ywraq-add-button:hover,
				                input.button.raq-send-request:hover,
				                a.button:hover,
				                .widget.yith-woo-ajax-reset-navigation a.yith-wcan-reset-navigation:hover,
				                #searchform #searchsubmit:hover,
				                a.wihslist-submit.add_to_wishlist:hover, .woocommerce .yith-wcwl-wishlist-search-form button.wishlist-search-button:hover, .woocommerce .wishlist_manage_table tfoot a.create-new-wishlist:hover,
			                ul.products li.product .product-wrapper .yith-wcdp a:hover,
							.woocommerce table.shop_table.order_details tr.order_item td a.pay:hover,
							.woocommerce table.shop_table.order_details tr.order_item td a.view:hover',

				'properties' => 'background-color, background'
			)
		)
	),

	array(
		'type' => 'title',
		'name' => __( 'Buttons Flat Black', 'yit' ),
		'desc' => ''
	),

	array(
		'id'              => 'button-flat-black-font',
		'type'            => 'typography',
		'name'            => __( 'Buttons Typography', 'yit' ),
		'desc'            => __( 'Select the typography for buttons text.', 'yit' ),
		'min'             => 1,
		'max'             => 80,
		'default_font_id' => 'typography-website-title',
		'std'             => array(
			'size'      => 12,
			'unit'      => 'px',
			'family'    => 'default',
			'style'     => '700',
			'transform' => 'uppercase',
		),
		'style'           => array(
			'selectors'  => '.btn-flat-black, a.btn-flat-black,
			                 .widget .searchform #searchsubmit,
			                 .woocommerce.widget.widget_product_search #searchform #searchsubmit,.woocommerce.widget.widget_product_search .woocommerce-product-search input[type="submit"]',

			'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform'
		)
	),

	array(
		'id'         => 'button-flat-black-text-color',
		'type'       => 'colorpicker',
		'name'       => __( 'Buttons Text color', 'yit' ),
		'desc'       => __( 'Select the color of the text for the buttons of every page', 'yit' ),
		'variations' => array(
			'normal' => __( 'Text color', 'yit' ),
			'hover'  => __( 'Text hover color', 'yit' )
		),
		'std'        => array(
			'color' => array(
				'normal' => '#ffffff',
				'hover'  => '#ffffff'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-black, a.btn-flat-black, a.btn-flat-black.added,
                                .woocommerce.widget.widget_product_search #searchform #searchsubmit,.woocommerce.widget.widget_product_search .woocommerce-product-search input[type="submit"],
				                .widget .searchform #searchsubmit,
                                .btn.btn-flat-black i.fa,
                                .product-special-button a.trigger-quick-view,
                                .quick-view-overlay .added-to-cart-icon,
                                .product-special-button a.yith-wcqv-button',

				'properties' => 'color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-black:hover, a.btn-flat-black:hover,
				                .widget .searchform #searchsubmit:hover,
				                .woocommerce.widget.widget_product_search #searchform #searchsubmit:hover,.woocommerce.widget.widget_product_search .woocommerce-product-search input[type="submit"]:hover,
                                .btn.btn-flat-black:hover i.fa,
                                .btn.btn-flat-black i.fa:hover,
                                .product-special-button a.trigger-quick-view:hover,
                                .quick-view-overlay .added-to-cart-icon:hover,
                                .product-special-button a.yith-wcqv-button:hover',

				'properties' => 'color'
			)
		)
	),

	array(
		'id'         => 'button-flat-black-border-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Border color', 'yit' ),
			'hover'  => __( 'Border hover color', 'yit' )
		),
		'name'       => __( 'Buttons border color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons border of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#000000',
				'hover'  => '#434343'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-black, a.btn-flat-black, .woocommerce.widget.widget_product_search #searchform #searchsubmit,.woocommerce.widget.widget_product_search .woocommerce-product-search input[type="submit"],
				                 .widget .searchform #searchsubmit,
                                .product-special-button a.trigger-quick-view,
                                .quick-view-overlay .added-to-cart-icon,
                                .product-special-button a.yith-wcqv-button',


				'properties' => 'border-color'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-black:hover, a.btn-flat-black:hover,
								.woocommerce.widget.widget_product_search #searchform #searchsubmit:hover,
								.woocommerce.widget.widget_product_search .woocommerce-product-search input[type="submit"]:hover,
				                 .widget .searchform #searchsubmit:hover,
                                .product-special-button a.trigger-quick-view:hover,
                                .quick-view-overlay .added-to-cart-icon:hover,
                                .product-special-button a.yith-wcqv-button:hover',

				'properties' => 'border-color'
			)
		)
	),

	array(
		'id'         => 'button-flat-black-background-color',
		'type'       => 'colorpicker',
		'variations' => array(
			'normal' => __( 'Background color', 'yit' ),
			'hover'  => __( 'Background hover color', 'yit ' )
		),
		'name'       => __( 'Buttons background color', 'yit' ),
		'desc'       => __( 'Select a color for the buttons background of all pages.', 'yit' ),
		'std'        => array(
			'color' => array(
				'normal' => '#000000',
				'hover'  => '#434343'
			)
		),
		'style'      => array(
			'normal' => array(
				'selectors'  => '.btn-flat-black, a.btn-flat-black, .woocommerce.widget.widget_product_search #searchform #searchsubmit,.woocommerce.widget.widget_product_search .woocommerce-product-search input[type="submit"],
                                 .widget .searchform #searchsubmit,
                                .product-special-button a.trigger-quick-view,
                                .quick-view-overlay .added-to-cart-icon,
                                .product-special-button a.yith-wcqv-button',


				'properties' => 'background-color, background'
			),
			'hover'  => array(
				'selectors'  => '.btn-flat-black:hover, a.btn-flat-black:hover, .woocommerce.widget.widget_product_search #searchform #searchsubmit:hover,.woocommerce.widget.widget_product_search .woocommerce-product-search input[type="submit"]:hover,
				                 .widget .searchform #searchsubmit:hover,
                                .product-special-button a.trigger-quick-view:hover,
                                .quick-view-overlay .added-to-cart-icon:hover,
                                .product-special-button a.yith-wcqv-button:hover',


				'properties' => 'background-color, background'
			)
		)
	),
);

