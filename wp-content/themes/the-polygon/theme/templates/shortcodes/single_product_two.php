<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for show the products
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

global $yit_products_layout, $woocommerce_loop;

$woocommerce_loop['view'] = 'list';
$product_in_a_row = 1;

$query_args = array(
    'posts_per_page' => 1,
    'p'              => $product_id,
    'post_type'      => 'product',
);

$products = new WP_Query( $query_args );
$variation_title = ( isset($variation_title) && $variation_title != '' ) ?  $variation_title : '';
$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

if ( $products->have_posts() ) : ?>
    <div class="woocommerce show-single-product show-single-product-two show-products-list <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
        <div class="row">
            <ul class="products">

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                    <li <?php post_class(); ?> >


                        <div class="clearfix product-wrapper">

                            <?php do_action('woocommerce_before_shop_loop_item'); ?>

                            <div class="thumb-wrapper">

                                <?php
                                /**
                                 * woocommerce_before_shop_loop_item_title hook
                                 *
                                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                                 */
                                do_action('woocommerce_before_shop_loop_item_title');
                                ?>

                            </div>

                            <div class="product-info">

                                <?php if (has_action('woocommerce_after_shop_loop_item_title')) : ?>

                                    <div class="product-meta-wrapper clearfix">

                                        <?php

                                        /**
                                         * woocommerce_shop_loop_item_title hook
                                         *
                                         * @hooked woocommerce_template_loop_product_title - 10
                                         */
                                        do_action('woocommerce_shop_loop_item_title');

                                        /**
                                         * woocommerce_after_shop_loop_item_title hook
                                         *
                                         * @hooked woocommerce_template_loop_rating - 5
                                         * @hooked woocommerce_template_loop_price - 10
                                         */
                                        do_action('woocommerce_after_shop_loop_item_title'); ?>

                                    </div>

                                <?php endif; ?>

                                <div class="product_actions_container">
                                    <?php do_action('woocommerce_after_shop_loop_item'); ?>
                                </div>

                            </div>
                        </div>

                    </li>

                <?php endwhile; // end of the loop. ?>

            </ul>
        </div>
        <?php
        $product = wc_get_product(get_the_ID());
        if ($product->product_type == 'variable'):

            $variations = $product->get_available_variations();

            if ( !empty( $variations ) ) :

                echo '<div class="variations">';

                echo '<span class="variations-title">' . $variation_title . '</span>';

                foreach ( $variations as $pr ) :

                    $product_link = get_the_permalink();

                    if (!empty($pr['attributes'])) {
                        $product_link = add_query_arg($pr['attributes'], $product_link);
                    }
                    if (!empty($pr['image_link'])):
                        echo '<a class="product-variation" href="' . $product_link . '">';
                        yit_image(array('src' => $pr['image_link'], 'width' => '56', 'height' => '72', 'crop' => true));
                        echo '</a>';
                    endif;
                endforeach;

                echo '</div>';
            endif;
        endif;
        ?>

    </div>
    <div class="clear"></div>
<?php endif;

wp_reset_query();

$woocommerce_loop['loop'] = 0;

?>
