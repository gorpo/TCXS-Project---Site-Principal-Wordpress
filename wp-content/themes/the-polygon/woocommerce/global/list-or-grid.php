<?php
/**
 * Shop list or grid
*/

if ( is_single() || ! have_posts() ) return;

$shop_view = (isset($_GET['view'])) ? $_GET['view'] : wc_get_loop_prop('view');
if ( empty( $shop_view ) ) {
    wc_set_loop_prop('view', yit_get_option('shop-view-type', 'grid'));
    $shop_view = yit_get_option('shop-view-type', 'grid');
} else {
    wc_set_loop_prop('view', $shop_view);
}

?>

<div id="list-or-grid">
    <span class="view-title"><?php _e( 'view style', 'yit' ); ?>:</span>

    <a data-icon="&#xe42f;" data-font="retinaicon-font" class="grid-view<?php if ( $shop_view == 'grid' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'grid' ) ) ?>" title="<?php _e( 'Switch to grid view', 'yit' ) ?>"></a>

    <a data-icon="&#xe436;" data-font="retinaicon-font" class="list-view<?php if ( $shop_view == 'list' ) echo ' active'; ?>" href="<?php echo esc_url( add_query_arg( 'view', 'list' ) ) ?>" title="<?php _e( 'Switch to list view', 'yit' ) ?>"></a>
</div>