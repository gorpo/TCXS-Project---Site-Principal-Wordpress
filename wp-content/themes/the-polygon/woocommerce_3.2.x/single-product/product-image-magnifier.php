<?php
/**
 * Single Product Image
 *
 * @author 		YIThemes
 * @package 	YITH_Magnifier/Templates
 * @version     1.0.0
 */

global $post, $woocommerce, $product, $yith_wcmg;

$columns = apply_filters( 'woocommerce_product_thumbnails_columns', get_option( 'yith_wcmg_slider_items', 4 ) );

// get gallery attachment ids
$attachment_ids = $product->get_gallery_image_ids();
if ( ! empty( $attachment_ids ) && ! in_array( get_post_thumbnail_id(), $attachment_ids ) ) {
    array_unshift( $attachment_ids, get_post_thumbnail_id() );
}

$enable_slider = (bool) ( get_option('yith_wcmg_enableslider') == 'yes' && count( $attachment_ids ) > $columns );

$size = yit_image_content_single_width();

$style = "";

if ( ! empty( $size ) ) {
    $style = 'width:' . $size['image'] . '%';
}


$image_title      = esc_attr( get_the_title( get_post_thumbnail_id() ) );
$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
$image            = get_the_post_thumbnail( $post->ID, 'shop_single', array(
    'title' => $image_title
) );
$attachment_count = count( $product->get_gallery_image_ids() );

if ( $attachment_count > 0 ) {
    $gallery = '[product-gallery]';
}
else {
    $gallery = '';
}

?>

    <div class="images" style="<?php echo esc_attr( $style ); ?>">

        <?php if( ! yith_wcmg_is_enabled() ): ?>

            <!-- Default Woocommerce Template -->
            <?php if ( has_post_thumbnail() ) : ?>

                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID ); ?>

            <?php else : ?>

                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'yit' ) ), $post->ID ); ?>

            <?php endif; ?>
        <?php else: ?>

            <!-- YITH Magnifier Template -->
            <?php if ( has_post_thumbnail() ) : ?>

                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="yith_magnifier_zoom" title="%s" data-rel="prettyPhoto">%s</a>', esc_url( yit_image( 'size=shop_magnifier&output=url&echo=0' ) ), $image_title, $image ), $post->ID ); ?>

            <?php else: ?>

                <?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'yit' ) ), $post->ID ); ?>

            <?php endif ?>

        <?php endif ?>


        <?php do_action('woocommerce_product_thumbnails'); ?>

    </div>

<?php if( yith_wcmg_is_enabled() ): ?>
    <script type="text/javascript" charset="utf-8">
        var yith_magnifier_options = {
            <?php if ( $enable_slider ) : ?>
            enableSlider: true,


            slider: 'owlCarousel',
            sliderOptions: {
                items: <?php echo esc_js( apply_filters( 'woocommerce_product_thumbnails_columns', $columns ) ) ?>,
                margin: 16,
                nav: true,
                loop: <?php echo get_option('yith_wcmg_slider_infinite') == 'yes' ? 'true' : 'false' ?>,
                navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
            },

            <?php else : ?>
            enableSlider: false,
            <?php endif; ?>

            showTitle: false,
            zoomWidth: '<?php echo esc_js( get_option('yith_wcmg_zoom_width') )  ?>',
            zoomHeight: '<?php echo esc_js( get_option('yith_wcmg_zoom_height') ) ?>',
            position: '<?php echo esc_js( get_option('yith_wcmg_zoom_position') ) ?>',
            tint: <?php echo esc_js( get_option('yith_wcmg_tint') == '' ? 'false' : "'". get_option('yith_wcmg_tint')."'" ) ?>,
            lensOpacity: <?php echo esc_js( get_option('yith_wcmg_lens_opacity') ) ?>,
            softFocus: <?php echo esc_js( get_option('yith_wcmg_softfocus') == 'yes' ? 'true' : 'false' ) ?>,
            adjustY: 0,
            disableRightClick: false,
            phoneBehavior: '<?php echo esc_js( get_option('yith_wcmg_zoom_mobile_position') ) ?>',
            loadingLabel: '<?php echo esc_js( stripslashes(get_option('yith_wcmg_loading_label') ) ) ?>',
            zoom_wrap_additional_css: '<?php echo apply_filters ( 'yith_ywzm_zoom_wrap_additional_css', '' ); ?>'
        };

        if ( yith_magnifier_options.slider == 'bxSlider' ) {
            (function($){
                $('.yith_magnifier_gallery').on('yith_magnifier_slider_destroy', function () {
                    var slider = $(this).bxSlider();
                    slider.destroySlider();
                });
            })(jQuery);
        }
    </script>
<?php endif ?>