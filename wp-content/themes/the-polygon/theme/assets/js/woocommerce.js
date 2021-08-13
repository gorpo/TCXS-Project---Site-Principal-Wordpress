jQuery(document).ready( function($){
    "use strict";

    var $body = $('body'),
        $topbar = $( document.getElementById('topbar') ),
        $header = $( document.getElementById('header') ),
        $products_sliders = $('.products-slider-wrapper, .categories-slider-wrapper'),
        $single_container = $('.fluid-layout.single-product .content');



    /***************************************
     * UPDATE CALCULATE SHIPPING SELECT
    ***************************************/

    // FIX SHIPPING CALCULATOR SHOW
    $( '.shipping-calculator-form' ).show();

    if (parseFloat(yit_woocommerce.version) < 2.3 && $.fn.selectbox ) {

        $('#calc_shipping_state').next('.sbHolder').addClass('stateHolder');

        $body.on('country_to_state_changing', function(){
            $('.stateHolder').remove();
            $('#calc_shipping_state').show().attr('sb', '');

            $('select#calc_shipping_state').selectbox({
                effect: 'fade',
                classHolder: 'stateHolder sbHolder'
            });
        });
    }

    /*************************
     * SHOP STYLE SWITCHER
     *************************/

    $('#list-or-grid').on( 'click', 'a', function(e) {
        e.preventDefault();
        var trigger = $(this),
                view = trigger.attr( 'class' ).replace('-view', '');

            $( '.content ul.products li' ).removeClass( 'list grid' ).addClass( view );
            trigger.parent().find( 'a' ).removeClass( 'active' );
            trigger.addClass( 'active' );

            $.cookie( yit_shop_view_cookie, view );

            return false;
    });


    /***************************************************
     * ADD TO CART
     **************************************************/

    var $pWrapper = new Array(),
        $i=0,
        $j= 0,
        $private = false,
        $storageSafari = 'SafariPrivate',
        $storage = window.sessionStorage;

    try {
        $storage.setItem( $storageSafari, 'safari_is_private' );
        $storage.removeItem( $storageSafari );
    } catch (e) {
        if ( e.code == DOMException.QUOTA_EXCEEDED_ERR && $storage.length == 0) {
            $private = true
        } else {
            throw e;
        }
    }

    var add_to_cart = function() {

        $('ul.products').on('click', 'li.product .add_to_cart_button', function () {

            $pWrapper[$i] = $(this).parents('.product-wrapper');

            if( typeof yit.load_gif != 'undefined' ) {
                $pWrapper[$i].block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.5, cursor: 'none'}});
            }
            else {
                $pWrapper[$i].block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
            }

            $i++;

            if( $private ) {
                setTimeout(function () {
                    $body.trigger('unblock_safari_private');
                }, 3000);
            }
        });

    };

    add_to_cart();
    $(document).on('yith-wcan-ajax-filtered', add_to_cart );

    $body.on( 'added_to_cart unblock_safari_private', function( fragmentsJSON, cart_hash ) {

        if ( typeof $pWrapper[$j] === 'undefined' )  return;

        var $thumb = $pWrapper[$j].find( '.thumb-wrapper' );

        var $ico = "<div class='added-to-cart-icon'><span>" + yit.added_to_cart_text + "</span></div>";

        $thumb.addClass( 'no-hover' );
        $thumb.append( $ico );

        setTimeout(function () {
            $thumb.find('.added-to-cart-icon').fadeOut(2000, function () {
                $thumb.removeClass( 'no-hover' );
                $(this).remove();
            });
        }, 3000);

        $pWrapper[$j].unblock();
        $j++;

    });

    /*******************************************
     * ADD TO WISHLIST
     *****************************************/

     $('ul.products, div.product div.summary').on( 'click', '.yith-wcwl-add-button a', function () {
         if( typeof yit.load_gif != 'undefined' ) {
             $(this).block({message: null, overlayCSS: {background: '#fff url(' + yit.load_gif + ') no-repeat center', opacity: 0.3, cursor: 'none'}});
         }
         else {
             $(this).block({message: null, overlayCSS: {background: '#fff url(' + woocommerce_params.ajax_loader_url.substring(0, woocommerce_params.ajax_loader_url.length - 7) + '.gif) no-repeat center', opacity: 0.3, cursor: 'none'}});
         }

     });

    /*************************
     * PRODUCTS SLIDER
     *************************/

    if( $.fn.owlCarousel && $.fn.imagesLoaded && $products_sliders.length ) {
        var product_slider = function(t) {

                t.imagesLoaded(function(){
                    var cols = t.data('columns') ? t.data('columns') : 4,
                        autoplay = ( t.attr('data-autoplay') == 'true' ) ? true : false;

                    var owl = t.find('.products').owlCarousel({
                        items             : cols,
                        responsiveClass   : true,
                        responsive:{
                            0 : {
                                items: 2
                            },
                            479 : {
                                items: 3
                            },
                            767 : {
                                items: 4
                            },
                            992 : {
                                items: cols
                            }
                        },
                        autoplay          : autoplay,
                        autoplayTimeout   : 2000,
                        autoplayHoverPause: true,
                        loop              : true
                    });

                    // Custom Navigation Events
                    t.on('click', '.es-nav-next', function () {
                        owl.trigger('next.owl.carousel');
                    });

                    t.on('click', '.es-nav-prev', function () {
                        owl.trigger('prev.owl.carousel');
                    });

                });
        };

        // initialize slider in only visible tabs
        $products_sliders.each(function(){
            var t = $(this);

            if( ( ! t.closest('.panel.group').length || t.closest('.panel.group').hasClass('showing') )
                && ( ! t.closest('.vc_tta-panel').length || t.closest('.vc_tta-panel').hasClass( 'vc_active' ) ) ){
                product_slider( t );
            }
        });

        $('.tabs-container').on( 'tab-opened', function( e, tab ) {
            product_slider( tab.find( $products_sliders ) );
        });

        $('.vc_tta-tab').on( 'show.vc.tab', this, function() {
            var tab = $(this).closest('.vc_tta-container').find('.vc_tta-panel.vc_active');
            product_slider( tab.find($products_sliders) );
        });


    }



    /*************************
     * VARIATIONS SELECT
     *************************/

    var variations_select = function(){
        // variations select
        if( $.fn.selectbox ) {
            var form = $('form.variations_form');
            var select = form.find('select:not(.yith_wccl_custom)');

            if( form.data('wccl') ) {
                select = select.filter(function(){
                    return $(this).data('type') == 'select'
                });
            }

            select.selectbox({
                effect: 'fade',
                onOpen: function() {
                    //$('.variations select').trigger('focusin');
                }
            });

            var update_select = function(event){
                select.selectbox("detach");
                select.selectbox("attach");
            };

            // fix variations select
            form.on( 'woocommerce_update_variation_values', update_select);
            form.find('.reset_variations').on('click.yit', update_select);
        }
    };

    variations_select();

     /*************************
     * INQUIRY FORM
     *************************/

    if(yit_woocommerce.yit_shop_show_reviews_tab_opened=='yes') {
        // open first reviews tab
        var $reviews_tab = $(document).find('.woocommerce-tabs ul.tabs li.reviews_tab a');

        if( $reviews_tab.length ) {
            $reviews_tab.click();
        }
    }




    /*************************
     * Login Form
     *************************/

    $('#login-form').on('submit', function(){
        var a = $('#reg_password').val();
        var b = $('#reg_password_retype').val();
        if(!(a==b)){
            $('#reg_password_retype').addClass('invalid');
            return false;
        }else{
            $('#reg_password_retype').removeClass('invalid');
            return true;
        }
    });

    /*************************
     * Widget Woo Price Filter
     *************************/

    if( typeof yit != 'undefined' && ( typeof yit.price_filter_slider == 'undefined' || yit.price_filter_slider == 'no' ) ) {
        var removePriceFilterSlider = function() {
            $( 'input#min_price, input#max_price' ).show();
            $('form > div.price_slider_wrapper').find( 'div.price_slider, div.price_label' ).hide();
        };

        $(document).on('ready', removePriceFilterSlider);
    }

    /*********************
     * SHARE IN SHOP PAGE
     **********************/

    $(document).on('click', '#yit_share', function(e){
        e.preventDefault();

        var share = $(this).closest('.product-special-button').find('.share-container');

        if( ! share.length )
            return;

        var template = '<div class="popupOverlay share"></div>' +
            '<div id="popupWrap" class="popupWrap share">' +
            '<div class="product-share">' +
            share.html() +
            '</div>' +
            '<i class="fa fa-times close-popup"></i>' +
            '</div>';

        $body.append(template);

        $('#popupWrap').center() ;
        $('.popupOverlay').css( { display: 'block', opacity:0 } ).animate( { opacity:0.7 }, 500 );
        $('#popupWrap').css( { display: 'block', opacity:0 } ).animate( { opacity:1 }, 500 );

        /** Close popup function **/
        var close_popup = function() {
            $('.popupOverlay').animate( {opacity:0}, 200);
            $('.popupOverlay').remove();
            $('.popupWrap').animate( {opacity:0}, 200);
            $('.popupWrap').remove();
        }

        /**
         *	Close popup on:
         *	- 'X button' click
         *   - wrapper click
         *   - esc key pressed
         **/
        $('.close-popup, .popupOverlay').click(function(){
            close_popup();
        });

        $(document).bind('keydown', function(e) {
            if (e.which == 27) {
                if($('.popupOverlay')) {
                    close_popup();
                }
            }
        });

        /** Center popup on windows resize **/
        $(window).resize(function(){
            $('#popupWrap').center();
        });
    });


    /****************************
     * COMPARE TOOLTIP
     ***************************/

    var $compare = $('.single-product .woocommerce.product.compare-button a');

    if( $compare.length ) {

        //init attr title
        $compare.attr( 'data-original-title', 'Add to compare' );

        $(document).on( 'yith_woocompare_open_popup', function(){
            $compare.attr( 'data-original-title', 'Added to compare' );
        });
    }


    /*************************
     * Header Search
     *************************/

    $.yit_trigger_search();
    $.yit_ajax_search();


    /***************************
     * DROPDOWN WIDGET SHOP
     **************************/

    var $widget_shop = $(document).find( '.widget_price_filter, .yith-woo-ajax-navigation, .widget.vendors-list, .yith-wpv-quick-info, .widget.store-location'),
        $widget_dropdown = function() {

            if ( $widget_shop.length ) {

                $widget_shop.each( function(){

                    var $title = $(this).find('h3');

                    $title.append( '<span class="widget-dropdown border"></span>' );
                    $title.addClass('with-dropdown border-2 open');

                    $title.on('click', function(){
                        $(this).toggleClass('open').next().slideToggle('slow');

                    })
                })
            }
        };

    $(document).on( 'ready yith-wcan-ajax-filtered', $widget_dropdown );


    /***********************************
     * Jquery Scrollbar
     */

    if (yit_woocommerce.shop_minicart_scrollable == 'yes') {

        var create_popup_scrollbar = function () {
            $('.cart_wrapper .widget_shopping_cart_content').scrollbar();
        }

        create_popup_scrollbar();

        $(document).on('added_to_cart', create_popup_scrollbar);
        $(document).on('wc_fragments_refreshed', create_popup_scrollbar);

    }

    /**
     * Request a quote
     */

    $(document).on('click', '.add-request-quote-button', function () {
        $(this).parent().removeClass('show')
    });

    /**
     * YITH WooCommerce Zoom Magnifier height fix
     * @author: Francesco Grasso - francesco.grasso@yithemes.com
     */
    var yith_zoom_fix = function () {
        var $image_container = $('.single-product.woocommerce div.product div.images .yith_magnifier_zoom_wrap a'),
            $image_contained = $('.single-product.woocommerce div.product div.images .yith_magnifier_zoom_wrap img').height();

        $image_container.css( 'height', $image_contained);
    };

    $(document).on('yith_magnifier_after_init_zoom', yith_zoom_fix );

    /*************************
     * END PRODUCT QUICK VIEW
     *************************/

    $(document).on( 'click' , '.cart_totals.calculated_shipping .cart_update_checkout input[type="submit"]' , function() {

        $('.woocommerce > form input[name="update_cart"]').click();

    } );

});