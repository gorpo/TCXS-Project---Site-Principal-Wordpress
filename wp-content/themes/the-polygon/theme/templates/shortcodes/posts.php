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
 * Template file for print list of posts
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */



	$loop = get_posts( array(
        'category_name' => (isset( $cat ) && ! empty( $cat ) && $cat != 'null' && $cat != "a:0:{}") ? $cat : '',
        'posts_per_page' => $items                  
    ) );

    $html = '';
   // while( $loop->have_posts() ) : $loop->the_post();
     if( !empty ($loop)){
         foreach ($loop as $post ) {
             setup_postdata( $post );
             $html .= '<div class="yit_shortcode post-list">';
             $title = the_title( '<h2><a class="title" href="' . get_permalink() . '">', '</a></h2>', false );
             //$title = '';
             $html .= ( $title == '' ) ? '<a class="title" href="' . get_permalink() . '">' . __( '(This post has no title)', 'yit' ) . '</a><br/>' : $title;

             $html .= ( isset( $show_description ) &&  $show_description == 'yes'  ) ? get_the_excerpt() : '';

             $html .= '</div>';
        }
         wp_reset_postdata();

     }
	
?>
<?php echo $html; ?>