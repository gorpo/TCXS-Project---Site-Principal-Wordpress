<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

global $post;

$enable_thumbnails = ($enable_thumbnails == 'yes') ? true : false;
$enable_title = ($enable_title == 'yes') ? true : false;
$enable_date = ($enable_date == 'yes') ? true : false;
$enable_author = ($enable_author == 'yes' && get_the_author() != false) ? true : false;
$enable_comments = ($enable_comments == 'yes') ? true : false;
$date_style = ( isset($date_style) && $date_style == 'yes') ? 'alternative' : false;
$show_read_more = yit_get_option('blog-show-read-more');
$read_more_text = yit_get_option('blog-read-more-text');
$args = array(
    'post_type' => 'post',
    'posts_per_page' => $nitems
);

if ( isset( $cat_name ) && ! empty( $cat_name ) && $cat_name != 'null' && $cat_name != "a:0:{}" ) {
    $args['category_name'] = $cat_name;
}
$show_categories = ($show_categories == 'yes') ? true : false;
$animate_data   = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data  .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate        = ( $animate != '' ) ? ' yit_animate' : '';

$blog = new WP_Query( $args );

if ( $blog->have_posts() ) :

    ?>
    <div class="clearfix  <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
                <ul class="blogs_posts" data-postid="<?php echo 'blog_section_' . mt_rand(); ?>">
                    <?php while ($blog->have_posts()) : $blog->the_post() ?>
                        <?php $thumbnails_class = has_post_thumbnail() ? 'thumbnails blog_section' : 'no-thumbnails blog_section'; ?>
                        <li class="blog_post row">
                            <?php if ($enable_thumbnails) : ?>
                            <div class="col-sm-5 col-xs-5 <?php echo esc_attr($thumbnails_class) ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a class="title_link" href="<?php the_permalink() ?>">
                                        <?php yit_image('size=blog_section&class=img-responsive'); ?>
                                    </a>
                                <?php endif; ?>

                                <?php if ($show_categories) :
                                    echo get_the_category_list();
                                endif; ?>
                            </div>
                            <?php endif; ?>
                            <div class="blog_section post_meta <?php echo $enable_thumbnails == true ? 'col-sm-7 col-xs-7 ' : 'col-sm-12 col-xs-12 '?>">

                                <div class="post_informations">
                                    <?php if ($enable_title) : ?>
                                        <h3 class="title">
                                            <a class="title_link"
                                               href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                        </h3>
                                    <?php endif; ?>


                                    <span class="info">
                                        <?php if ($enable_author) : ?>
                                            <span class="post-author">
                                                <i class="fa fa-user"></i>
                                                <?php echo __('by', 'yit') . ' '; the_author_posts_link(); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if ($enable_date) : ?>
                                            <i class="fa fa-calendar"></i>
                                            <?php echo '<span class="yit_post_meta_date">' . get_the_date('F j, Y') . '</span>'; ?>
                                        <?php endif; ?>
                                        <?php if ($enable_comments) : ?>
                                            <span class="yit_post_meta_comments"><a href="<?php comments_link() ?>"><?php comments_number('0', '1', '%'); ?></a></span>
                                        <?php endif; ?>
                                    </span>
                                    <p class="excerpt">
                                        <?php  echo ( true == $show_read_more ) ? yit_plugin_content( 'excerpt', 60, $read_more_text, '', false ) : yit_plugin_content( 'excerpt', 60, '', '', false ) ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
    </div>

<?php endif; ?>

<?php wp_reset_query(); ?>