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
 * Template file for create a banner with an image, a link and text.
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */


$title = ( isset( $title ) ) ? $title : '';
$subtitle = ( isset( $subtitle ) ) ? $subtitle : '';
$image = ( isset( $image ) ) ? esc_url( $image ) : '';
$link = ( isset( $link ) ) ? esc_url( $link ) : '';
$hyperlink = ( isset( $hyperlink ) ) ? $hyperlink : 'no';
$click_class = '';
if( $link != '' && $hyperlink=='yes' ) {
    $click_class = 'hyperlink';
}
$slogan_position = ( isset( $slogan_position ) ) ? $slogan_position : '';
$button = ( isset( $button ) ) ? $button : '';
$button_class = ( isset( $button ) && $button != '' ) ? 'with_button' : 'no-button';
$button_style = ( isset( $button_style ) ) ? $button_style : '';
$button_font_size = ( isset( $button_font_size ) ) ? $button_font_size : '10';
$title_color = ( isset( $title_color ) ) ? $title_color : '#000000';
$title_size = ( isset( $title_size ) ) ? $title_size : '24';
$subtitle_color = ( isset( $subtitle_color ) ) ? $subtitle_color : '#000000';
$subtitle_size = ( isset( $subtitle_size ) ) ? $subtitle_size : '15';
$image_effect  = ( isset( $image_effect ) ) ? $image_effect : 'no_image_effect';

if ( $image != '' ) {
    $attachment_image_id = yit_plugin_get_attachment_id( $image );
    $attachment_image_info = yit_getimagesize( $image );
}

$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';
?>

<?php if ( $image != '' ) : ?>
        <div class="teaser-wrapper <?php echo esc_attr( $animate . ' '. $button_class.' '.$click_class . $vc_css )?>" <?php echo $animate_data ?>>
            <div class="image <?php echo $image_effect ?>" >
                <?php if ( $attachment_image_id != '') : ?>
                    <img src="<?php yit_image( "id={$attachment_image_id}&output=url" ) ?>" <?php echo $attachment_image_info[3] ?> alt="<?php _e( 'Image banner', 'yit' ) ?>">
                <?php else : ?>
                    <img src="<?php echo $image; ?>" <?php echo $attachment_image_info[3] ?> alt="<?php _e( 'Image banner', 'yit' ) ?>">
                <?php endif; ?>
                <div class="image_banner_inside" style="height: <?php echo $attachment_image_info[1] ?>px;">
                    <div class="image_banner_text <?php echo $slogan_position ?>">
                        <?php if( $link != '' && $button == '' ) : ?>
                            <a href="<?php echo $link ?>" class="teaser_link">
                        <?php endif; ?>
                            <p class="title" style="color:<?php echo $title_color ?>;font-size:<?php echo $title_size ?>px"><?php echo $title ?></p>
                            <p class="subtitle" style="color:<?php echo $subtitle_color ?>;font-size:<?php echo $subtitle_size ?>px"><?php echo $subtitle ?></p>
                            <?php if ( $button != '' ): ?>
                                <a href="<?php echo $link ?>" style="font-size:<?php echo $button_font_size ?>px" class="btn btn-mini btn-<?php echo $button_style ?> teaser_link"><?php echo  $button ?></a>
                            <?php endif ?>
                        <?php if( $link != '' && $button == '' ) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="overlay"></div>
            </div>
        </div>
<?php endif; ?>