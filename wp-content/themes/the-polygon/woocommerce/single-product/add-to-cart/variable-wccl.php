<?php
/**
 * Variable product add to cart
 *
 * @author  Your Inspiration Themes
 * @package YITH WooCommerce Colors and Labels Variations
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $product, $post;
?>

<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>


    <form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>" data-wccl="true">
        <?php if ( ! empty( $available_variations ) ) : ?>
            <ul class="variations" cellspacing="0">

                <?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop ++; ?>
                    <li>
                        <label for="<?php echo esc_attr( sanitize_title( $name ) ); ?>"><?php echo wc_attribute_label( $name ); ?></label>
                        <select id="<?php echo esc_attr( sanitize_title( $name ) ); ?>" name="attribute_<?php echo esc_attr( sanitize_title( $name ) ); ?>" data-type="<?php echo esc_attr( $attributes_types[$name] ); ?>" data-attribute_name="attribute_<?php echo sanitize_title( $name ); ?>">
                            <option value=""><?php echo __( 'Choose an option', 'yit' ) ?>&hellip;</option>
                            <?php
                        if ( is_array( $options ) ) {

                            if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $name ) ] ) ) {
                                $selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $name ) ];
                            } elseif ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) {
                                $selected_value = $selected_attributes[ sanitize_title( $name ) ];
                            } else {
                                $selected_value = '';
                            }

                            // Get terms if this is a taxonomy - ordered
                            if ( taxonomy_exists( $name ) ) {

                                $terms = wc_get_product_terms( $post->ID, $name, array( 'fields' => 'all' ) );

                                foreach ( $terms as $term ) {
                                    if ( ! in_array( $term->slug, $options ) ) {
                                        continue;
                                    }

                                    $value = get_woocommerce_term_meta( $term->term_id, $name . '_yith_wccl_value' );

                                    echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . ' data-value="'.$value.'">' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
                                }

                            } else {

                                foreach ( $options as $option ) {
                                    echo '<option value="' . esc_attr( $option ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
                                }

                            }
                        }
                        ?>
                        </select>
                    </li>
                <?php endforeach;?>
            </ul>

            <?php
            if ( sizeof( $attributes ) == $loop ) {
                        echo '<a class="reset_variations" href="#reset">x ' . __( 'Clear selection', 'yit' ) . '</a>';
            }
            ?>

            <div class="clearfix"></div>

            <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

            <div class="single_variation_wrap" style="display:none;">
                <?php do_action( 'woocommerce_before_single_variation' ); ?>

                <div class="single_variation"></div>

                <div class="variations_button group">
                    <h4 class="quantity_label"><?php _e( 'Quantity: ', 'yit' ) ?></h4>
                    <?php woocommerce_quantity_input(); ?>
                    <button type="submit" class="single_add_to_cart_button btn btn-flat-green"><?php echo apply_filters( 'add_to_cart_text', $product->single_add_to_cart_text() ); ?></button>
                </div>

                <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
                <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
                <input type="hidden" name="variation_id" value="" />

                <?php do_action( 'woocommerce_after_single_variation' ); ?>
            </div>

            <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

        <?php else : ?>

            <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'yit' ); ?></p>

        <?php endif; ?>
    </form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>