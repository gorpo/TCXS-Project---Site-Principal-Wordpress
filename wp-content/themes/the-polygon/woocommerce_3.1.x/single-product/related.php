<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* prevent the realted to show in shop page and product categorie*/
if (is_shop() || is_product_category()) {
    return;
}

global $product;
$n_related = (yit_get_option( 'shop-related-slider' ) == 'yes' ) ? yit_get_option( 'shop-number-related' ) : $posts_per_page;
$is_slider = ( count( $related_products ) >= 4 && yit_get_option( 'shop-related-slider' ) == 'yes' ) ? true : false;

if ( $related_products ) : ?>

<div class="clearfix yit_related_products related products">
    <div class="container">

        <?php if ( shortcode_exists( 'box_title' ) ) :
            $related_title_text = __( 'Related Products', 'yit' );
            echo do_shortcode("[box_title class='releated-products-title' font_size='24' border_color='#e1e1e1' font_alignment='center' border='double' title='". $related_title_text ."']");
        else : ?>

        <h2><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>

        <?php endif; ?>

        <?php if ( $is_slider ) : ?>

            <div class="products-slider-wrapper" data-autoplay="true" data-columns="<?php echo $n_related ?>">
                <div class="products-slider">
                    <div class="row">
                        <ul class="products">
                            <?php foreach ( $related_products as $related_product ) : ?>

                                <?php
                                $post_object = get_post( $related_product->get_id() );

                                setup_postdata( $GLOBALS['post'] =& $post_object );

                                wc_get_template_part( 'content', 'product' ); ?>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="es-nav">
                    <div class="es-nav-prev"><span class="fa fa-angle-left"></span></div>
                    <div class="es-nav-next"><span class="fa fa-angle-right"></span></div>
                </div>
            </div>

        <?php else : ?>

            <?php woocommerce_product_loop_start(); ?>

                <?php foreach ( $related_products as $related_product ) : ?>

                    <?php
                        $post_object = get_post( $related_product->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                        wc_get_template_part( 'content', 'product' ); ?>

                <?php endforeach; ?>

            <?php woocommerce_product_loop_end(); ?>

        <?php endif; ?>
    </div>
</div>

<?php endif;

wp_reset_postdata();
