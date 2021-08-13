<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
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

global $product, $woocommerce_loop;

$has_wishlist = yit_get_option( 'shop-view-wishlist-button' ) == 'yes' && shortcode_exists( 'yith_wcwl_add_to_wishlist' ) && get_option( 'yith_wcwl_enabled' ) == 'yes';
$in_stock     = $product->is_in_stock();
$is_wishlist  = function_exists( 'yith_wcwl_is_wishlist' ) && yith_wcwl_is_wishlist();

?>
<div class="product-actions-wrapper <?php echo ( $has_wishlist ) ? 'with-wishlist' : '' ?>">

    <div class="product-action-button">

        <?php if ( ! $in_stock ) : ?>

            <span class="out-of-stock">
                <?php echo apply_filters( 'yit_out_of_stock_product_text', __( 'Out of stock', 'yit' ) ); ?>
            </span>

        <?php else :

            $link = array(
                'url'      => $product->add_to_cart_url(),
                'label'    => $product->add_to_cart_text(),
                'class'    => isset( $class ) ? $class : '',
                'quantity' => isset( $quantity ) ? $quantity : 1
            );

            $handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->get_type(), $product );

            switch ( $handler ) {
                case "variable" :
                    $link['url'] = apply_filters( 'variable_add_to_cart_url', $link['url'] );
                    $link['label'] = apply_filters( 'variable_add_to_cart_text', $link['label'] );
                    break;

                case "grouped" :
                    $link['url'] = apply_filters( 'grouped_add_to_cart_url', $link['url'] );
                    $link['label'] = apply_filters( 'grouped_add_to_cart_text', $link['label'] );
                    break;

                case "external" :
                    $link['url'] = apply_filters( 'external_add_to_cart_url', $link['url'] );
                    $link['label'] = apply_filters( 'external_add_to_cart_text', $link['label'] );
                    break;

                default :
                    if ( $product->is_purchasable() ) {
                        $link['url'] = apply_filters( 'add_to_cart_url', $link['url'] );
                        $link['label'] = apply_filters( 'add_to_cart_text', $link['label'] );
                        $link['quantity'] = apply_filters( 'add_to_cart_quantity', $link['quantity'] );
                    }
                    else {
                        $link['url'] = apply_filters( 'not_purchasable_url', $link['url'] );
                        $link['label'] = apply_filters( 'not_purchasable_text', $link['label'] );
                    }
                    break;
            }

            echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="btn btn-alternative %s">%s</a>',
                    esc_url( $link['url'] ),
                    esc_attr( $link['quantity'] ),
                    esc_attr( $product->get_id() ),
                    esc_attr( $product->get_sku() ),
                    esc_attr( $link['class'] ),
                    esc_html( $link['label'] )
                ),
            $product );

        endif; ?>

    </div>

</div>
