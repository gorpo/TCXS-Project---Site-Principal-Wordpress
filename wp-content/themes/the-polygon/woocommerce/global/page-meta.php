<?php
/**
 * Content Wrappers
 */

if( is_product() ) return;
?>
<!-- PAGE META -->
<div id="page-meta">

    <?php if ( ( ! is_product_category() && ( yit_get_option( 'shop-show-page-title' ) == 'yes' || YIT_Layout()->show_title == 1 ) )
        || ( is_product_category() && ( yit_get_option( 'shop-category-show-page-title' ) == 'yes' ) ) ) : ?>
        <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php do_action( 'yith_before_shop_page_meta' );  ?>

    <div class="page-meta-wrapper border clearfix">
        <?php do_action( 'shop-page-meta' ); ?>
    </div>

</div>
<!-- END PAGE META -->