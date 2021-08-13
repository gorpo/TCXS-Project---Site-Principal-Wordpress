<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$style = "";
$size = yit_image_content_single_width();

if ( ! empty( $size ) && $size['content'] != 100 ) {
	$style = 'width:' . $size['content'] . '%; padding-left: 20px;';
}
elseif ( is_quick_view() ) {
	$style = 'width:50%;';
}
elseif ( ! empty( $size ) ) {
	$style = 'width:' . $size['content'] . '%;';
}

while ( have_posts() ) : the_post(); ?>

<div class="product">

	<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>

		<?php do_action( 'yith_wcqv_product_image' ); ?>

		<div class="summary entry-summary"  style="<?php echo esc_attr( $style ) ?>">
            <div class="summary-content">
                <?php do_action( 'yith_wcqv_product_summary' ); ?>
            </div>
		</div>

	</div>

</div>

<?php endwhile; // end of the loop.