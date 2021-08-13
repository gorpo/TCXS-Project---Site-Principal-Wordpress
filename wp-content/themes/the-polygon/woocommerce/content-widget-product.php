<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product; ?>

<li>
        <a class="clearfix" href="<?php echo get_permalink($product->get_id()); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
            <?php echo $product->get_image(); ?>
            <div class="product-widget-info">
                <span class="product_title"><?php echo $product->get_title(); ?></span>

                <?php if (yit_get_option('woocommerce-widget-product-categories') == 'yes') {
                    echo '<span class="product-categories">';

                    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
                    $first = true;
                    foreach( $product_cats as $pc ){
                        if( !$first ){
                            echo ', ';
                        }
                        echo $pc->name;
                        $first = false;
                    }
                    echo '</span>';
                } ?>

                <?php if (yit_get_option('woocommerce-widget-product-rating') == 'yes') {
                    echo wc_get_rating_html( $product->get_average_rating() );
                } ?>
                <span class="product_price"><?php echo $product->get_price_html(); ?></span>
            </div>
        </a>

</li>