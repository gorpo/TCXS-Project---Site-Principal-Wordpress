<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


echo '<div class="single-product-other-action">';

    if ( yit_get_option( 'shop-single-share' ) == 'yes' ) {
    echo '<div class="share-link-wrapper"><span class="share-label">' . __( 'Share', 'yit' ) . '</span>';
        yit_get_social_share( 'square' );
        echo '</div>';
    }

    do_action( 'yit_wishlist_in_other_action' );

echo '</div>';