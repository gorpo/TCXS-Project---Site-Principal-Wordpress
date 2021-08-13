<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="meta clearfix row blog <?php echo esc_attr( $blog_type ) ?> single">

        <div class="col-sm-12 yit_post_content">

            <?php if( $show_thumbnail && $post_format == 'standard' ) : ?>
                <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', array( 'show_date' => $show_date, 'blog_type' => $blog_type, 'show_thumbnail' => $show_thumbnail, 'show_categories' => $show_categories ) ) ?>
            <?php else: ?>
                <?php $args = array(
                    'post_format'    => $post_format,
                    'image_size'     => $image_size,
                    'show_date'      => $show_date,
                    'title'          => $title,
                    'link'           => $link,
                    'blog_type'      => $blog_type,
                    'show_title'     => $show_title,
                    'show_categories'=> $show_categories
                ); ?>
                <?php
                    if( $post_format != 'standard' ){
                        yit_get_template( 'blog/post-formats/' . $post_format . '.php', $args );
                    }
                ?>
            <?php endif; ?>


            <?php if( ! $is_quote ) : ?>
                <div class="yit_post_information_wrapper clearfix">
                    <?php if( $show_title || $show_meta_box_1 ) : ?>
                        <div class="yit_post_title_and_meta clearfix border-2">
                            <?php if( $show_title ) : ?>
                                <h1 class="post-title"><?php echo $title ?></h1>
                            <?php endif; ?>

                            <?php if( $show_meta_box_1 ) : ?>
                                <div class="yit_post_meta">
                                    <?php if ($show_author) : ?>
                                        <span class="post-author">
                                                <i class="fa fa-user"></i>
                                            <?php echo __('by', 'yit') . ' ';
                                            the_author_posts_link(); ?>
                                            </span>
                                    <?php endif; ?>
                                    <?php if ($show_date) : ?>
                                        <i class="fa fa-calendar"></i>
                                        <?php echo '<span class="yit_post_meta_date">' . get_the_date('F j, Y') . '</span>'; ?>
                                    <?php endif; ?>
                                    <?php if ($show_comments) : ?>
                                        <span class="yit_post_meta_comments"><a href="<?php comments_link() ?>"><?php comments_number('0', '1', '%'); ?></a></span>
                                    <?php endif; ?>
                                    <?php if ($show_categories && !has_post_thumbnail()) : ?>
                                        <i class="fa fa-tags"></i>
                                        <?php echo __('Posted in: ', 'yit') . get_the_category_list();
                                    endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="yit_the_content">
                        <?php the_content() ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( $show_meta_box_2 ) : ?>
                <div class="yit_post_meta border <?php echo ( $show_tags && $has_tags ) ? 'tags' : 'no-tags' ?>">
                    <?php if( $show_tags && $has_tags ) : ?>
                        <span class="text">
                            <?php the_tags( __('Tags: ', 'yit') , ', '); ?>
                        </span>
                    <?php endif; ?>

                    <?php if( $show_share ) : ?>
                        <span class="share">
                            <span class="share-text"><?php echo $share_text ?></span>
                            <div class="socials-container">
                                <?php echo yit_get_social_share( 'icon' ) ?>
                            </div>
                        </span>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
