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
    <div class="meta clearfix blog <?php echo esc_attr( $blog_type ) ?>">
        <div class="<?php echo esc_attr( $blog_type ) ?> post-wrapper clearfix">
            <?php if( ! $is_quote ) : ?>
                <?php yit_get_template( 'blog/post-formats/standard.php', array( 'show_thumbnail'           => $show_thumbnail,
                                                                                 'show_date'                => $show_date,
                                                                                 'post_format'              => $post_format,
                                                                                 'show_post_format_icon'    => $show_post_format_icon,
                                                                                 'blog_type'                => $blog_type,
                                                                                 'link'                     => $link,
                                                                                 'show_categories'          => $show_categories ) ) ?>
            <?php endif; ?>

            <?php if( $is_quote ) : ?>
                <?php $quote_args = array( 'show_date'      => $show_date,
                                           'blog_type'      => $blog_type,
                                           'title'          => $title,
                                           'link'           => $link,
                                           'show_title'     => $show_title,
                                           'show_read_more' => $show_read_more,
                                           'read_more_text' => $read_more_text,
                                           'show_meta_box'  => $show_meta_box ) ?>
                <?php yit_get_template( 'blog/post-formats/' . $post_format . '.php', $quote_args ) ?>
            <?php else : ?>
                <div class="yit_post_content clearfix <?php echo $show_thumbnail ? 'col-sm-8 col-xs-7' : 'col-sm-12'?>">
                    <div class="yit_post_information_wrapper clearfix border-2">


                        <div class="yit_post_title_and_meta">
                            <?php if( $show_title ) : ?>
                                <?php yit_string( "<h3 class='post-title'><a href='{$link}'>", $title, "</a></h3>" ); ?>
                            <?php endif; ?>

                            <?php if ($show_meta_box) : ?>
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
                                    <?php if ($show_tags && $has_tags) : ?>
                                        <span class="tags">
                                            <?php the_tags(__('Tags: ', 'yit'), ', '); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php yit_edit_post_link(__('Edit', 'yit'), '<span class="yit-edit-post">', '</span>'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="yit_the_content">
                        <?php  echo ( true == $show_read_more ) ? yit_plugin_content( 'excerpt', 60, $read_more_text, '', false ) : yit_plugin_content( 'excerpt', 60, '', '', false ) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>