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
 * Template file for show a icon with a block text
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

$number_color = ( isset( $number_color ) && $number_color != '' ) ? $number_color : '';
$text = ( isset( $text ) && $text != '' ) ? $text : '';
$number = ( isset( $number ) && $number != '' ) ? $number : '';
$number_size = ( isset( $number_size ) && $number_size != '' ) ? $number_size : '';
$percent = ( isset( $percent ) && $percent == 'yes' ) ? true : false;
$percent_color = ( isset( $percent_color ) ) ? 'style="color:'.$percent_color.'"' : '';
$animate = ( isset( $animate ) && $animate == 'yes' ) ? true : false;
$animation_start_number = ( isset( $animation_start_number ) && $animation_start_number != '' ) ? $animation_start_number : '1';
$animation_duration = ( isset( $animation_duration ) && $animation_duration != '' ) ? intval( $animation_duration ) : 2000;
$animation_step = ( isset( $animation_step ) && $animation_step != '' ) ? intval( $animation_step ) : 10;
$hide_border = ( isset( $hide_border ) && $hide_border == 'yes' ) ? 'no-border' : '';



if ( $icon_type == 'theme-icon' ) :
    $color = ( $icon_color == '' ) ? '' : 'color:'. esc_attr( $icon_color ) . ';';
    $icon_size = ( $icon_size == '' ) ? '60' : esc_attr( $icon_size );
    $icon_theme = YIT_Icon()->get_icon_data( $icon_theme );
    $icon = '<i '. $icon_theme .' style="'. $color.' font-size: '.$icon_size.'px"></i>';
elseif ( $icon_type == 'custom' ) :
    $icon = '<img src="' . esc_url( $icon_url ) . '">';
endif;
?>
        <div class="counter <?php echo esc_attr( $hide_border . $vc_css ) ?>">
            <?php if ( isset( $icon ) ): echo '<div class="clearfix">'.$icon.'</div>'; endif; ?>
            <div class="number" data-animate="<?php echo esc_attr( $animate ) ?>" data-animationStart="<?php echo esc_attr( $animation_start_number ) ?>" data-animationDuration="<?php echo esc_attr( $animation_duration ) ?>" data-animationStep="<?php echo esc_attr( $animation_step ) ?>" style="color: <?php echo esc_attr( $number_color ) ?>;font-size:<?php echo esc_attr( $number_size ) ?>px;">
                <?php echo $number; ?><?php if ( $percent ): ?><span class="percent <?php echo ($animate) ? 'animate' : ''?>" <?php echo  $percent_color ?> >%</span><?php endif; ?>
            </div>
            <div class="text <?php echo ($animate) ? 'animate' : ''?>" style="color:<?php echo esc_attr( $text_color ) ?>; font-size: <?php echo esc_attr( $text_size ) ?>px"><?php echo  $text; ?></div>
        </div>

<?php
wp_enqueue_script( 'yit-shortcode-randomnumbers' );
?>