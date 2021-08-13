<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > Typography and Color > Content
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
$options =  array(

    /* Typography and Color > Content > 404 Page */
    array(
        'type' => 'title',
        'name' => __( '404 Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-not-found-general-font',
        'type'            => 'typography',
        'name'            => __( 'Custom 404 page general font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#6d6c6c',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'linked_to'  => array(
	        'color' => 'theme-text-color',
        ),
        'style'           => array(
            'selectors'  => '.error-404-text',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    /* Typography and Color > Content > FAQ */
    array(
        'type' => 'title',
        'name' => __( 'FAQ', 'yit' ),
        'desc' => '',
    ),

    array(
        'id'              => 'content-faq-title-font',
        'type'            => 'typography',
        'name'            => __( 'FAQ\'s title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size, text transform and align for faq\'s.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'normal',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'linked_to'  => array(
	        'color' => 'theme-text-color',
        ),
        'style'           => array(
            'selectors'  => '#faqs-container .faq-wrapper .faq-title h4, .filters li a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             text-align'
        ),
    ),
    array(
        'id'         => 'faq-title-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Faq Title Color', 'yit' ),
            'hover'  => __( 'Faq Title Color Hover', 'yit' )
        ),
        'name'       => __( 'Faq Title Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the faqs title in normal state and on hover.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#b0b0b0',
                'hover'  => '#7caf00'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '#faqs-container .faq-wrapper .faq-title h4,
                                .filters li a,
                                .faq-icon.fa.fa-plus.closed',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '#faqs-container .faq-wrapper .faq-title h4:hover,
                                #faqs-container .faq-wrapper .faq-title.active h4,
                                .filters li a:hover,
                                .faq-icon.fa.fa-minus.open,
                                .faq-icon.fa.fa-plus.closed:hover',
                'properties' => 'color'
            )
        ),
    ),



    /* Typography and Color > Content > Blog & Portfolios */
    array(
        'type' => 'title',
        'name' => __( 'Blog', 'yit' ),
        'desc' => '',
    ),

    array(
        'id'              => 'content-blog-post-list-title-font',
        'type'            => 'typography',
        'name'            => __( 'Post list title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size, text transform and align for blog post list.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 20,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'bold',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.blog_section .title a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             text-align'
        ),
    ),

    array(
        'id'              => 'content-blog-title-font',
        'type'            => 'typography',
        'name'            => __( 'Blog page title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size, text transform and align for blog page.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '600',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.blog h3.post-title a,
                            .share-container .share-text',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             text-align'
        ),
    ),

    array(
        'id'         => 'content-blog-title-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Title Color', 'yit' ),
            'hover'  => __( 'Title Color Hover', 'yit' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2'
        ),
        'name'       => __( 'Blog Title Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links title in normal state and on hover.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#000000',
                'hover'  => '#434343'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.blog h3.post-title a,
                                 .blog h2.quote-title a,
                                 .blog_section.post_meta .title a,
                                 .cta-phone.call-to-action .cta-phone-phone,
                                 .widget.yit-recent-posts .recent-post .hentry-post h3 a.title',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.blog h3.post-title a:hover,
                                 .blog h2.quote-title a:hover,
                                 .blog_section.post_meta .title a:hover,
                                 .widget.yit-recent-posts .recent-post .hentry-post h3 a.title:hover',
                'properties' => 'color'
            )
        ),
    ),

    array(
        'id'              => 'content-blog-meta-font',
        'type'            => 'typography',
        'name'            => __( 'Meta info box', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for meta info box.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'color'     => '#787878',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '.blog .yit_post_meta,
                            .yit_shortcodes.recent-post .blog .yit_post_meta,
                            .yit_shortcodes.recent-post .yit_post_meta span.author,
                            .yit_shortcodes.recent-post span.author a,
                            .widget.yit-recent-posts .recent-post span.author,
                            .widget.yit-recent-posts .recent-post span.author a,
                            .widget.yit-recent-posts .recent-post span.num-comments,
                            .widget.yit-recent-posts .recent-post span.num-comments a,
                            .widget.yit-recent-posts .recent-post span.num-comments,
                            .blog_section.post_meta .info,
                            .widget.yit-recent-posts .recent-post .post-author,
                            .widget.yit-recent-posts .recent-post .post-author a,
                            .widget.yit-recent-posts .recent-post .post-categories,
                            .widget.yit-recent-posts .recent-post .post-categories a,
                            .widget.yit-recent-posts .recent-post .post-date',
            'properties' => 'font-size,
                              font-family,
                              color,
                              text-transform,
                              text-align'
        )
    ),

    array(
        'id'         => 'content-blog-meta-link-hover-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Meta Link', 'yit' ),
            'hover'  => __( 'Meta Link Hover', 'yit' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2'
        ),
        'name'       => __( 'Blog Meta Links', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in normal state and on hover.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#787878',
                'hover'  => '#5b8000'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '.blog .yit_post_meta a:not(.social-icon),
                                .blog .yit_post_meta a:visited:not(.social-icon),
                                .blog_section.post_meta .info a',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '.blog .yit_post_meta a:hover:not(.social-icon),
                                 .blog .yit_post_meta a:active:not(.social-icon),
                                 .blog_section.post_meta .info a:hover',
                'properties' => 'color'
            )
        ),
    ),

    array(
        'id'              => 'content-blog-font',
        'type'            => 'typography',
        'name'            => __( 'Content font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for content.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 13,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '500',
            'color'     => '#7b7b7b',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '.blog .yit_post_content p',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-align,
                              text-transform'
        ),
    ),

    /* Typography and Color > Content > Comments */
    array(
        'type' => 'title',
        'name' => __( 'Comments', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-comments-number-count-font',
        'type'            => 'typography',
        'name'            => __( 'Comments number count font', 'yit' ),
        'desc'            => __( 'the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#7caf00'
        ),
        'style'           => array(
            'selectors'  => '.blog_section .post_informations .yit_post_meta_comments a,
                             .blog .yit_post_content .yit_post_meta_comments a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             color'
        )
    ),

    array(
        'id'         => 'content-comment-number-count-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'border' => __( 'Border Color', 'yit' )
        ),
        'name'       => __( 'Comments number count colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the comments number tooltip.', 'yit' ),
        'std'        => array(
            'color' => array(
                'border' => '#7caf00'
            )
        ),
        'style' => array(

            'border' => array(
                'selectors' => '.blog_section .post_informations .yit_post_meta_comments,
                                .blog_section .post_informations .yit_post_meta_comments:before,
                                .blog .yit_post_content .yit_post_meta_comments,
                                .blog .yit_post_content .yit_post_meta_comments:before',
                'properties' => 'border-color'
            )
        ),
    ),

    array(
        'id'              => 'content-comments-font',
        'type'            => 'typography',
        'name'            => __( 'Comments Reply/Nav Link font', 'yit' ),
        'desc'            => __( 'the font type, size, text transform and align.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'transform' => 'uppercase',
            'color'     => '#626262'
        ),
        'style'           => array(
            'selectors'  => '.reply_link, #commentform .logged-in-as a, .comment-navigation .nav-previous a, .comment-navigation .nav-next a',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             color'
        )
    ),

    /* Typography and Color > Content > Pagination */
    array(
        'type' => 'title',
        'name' => __( 'Pagination', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-pagination-font',
        'type'            => 'typography',
        'name'            => __( 'Pagination font', 'yit' ),
        'desc'            => __( 'the font type, size, text transform and align.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'   => 11,
            'unit'   => 'px',
            'family' => 'default',
            'style'  => 'regular',
            'align'  => 'right',
        ),
        'style'           => array(
            'selectors'  => '.general-pagination, .woocommerce-pagination',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-align'
        )
    ),

    array(
        'id'         => 'content-pagination-text-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'   => __( 'Normal Color', 'yit' ),
            'hover'    => __( 'Hover Color', 'yit' ),
            'selected' => __( 'Selected Color', 'yit' )
        ),
        'name'       => __( 'Pagination Number Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the pagination links.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'   => '#6d6c6c',
                'hover'    => '#6d6c6c',
                'selected' => '#6d6c6c',
            )
        ),
        'linked_to'  => array(
            'normal'    => 'theme-color-3',
            'hover'     => 'theme-color-3',
            'selected'  => 'theme-color-3',
        ),
        'style'      => array(
            'normal'   => array(
                'selectors'  => '.general-pagination a, .woocommerce-pagination a',
                'properties' => 'color'
            ),
            'hover'    => array(
                'selectors'  => '.general-pagination a:hover, #commentform .logged-in-as a:hover, .comment-navigation .nav-previous a:hover, .comment-navigation .nav-next a:hover,
                                 .woocommerce-pagination a:hover',
                'properties' => 'color'
            ),
            'selected' => array(
                'selectors'  => '.general-pagination a.selected, .general-pagination a:hover.selected, .woocommerce-pagination span',
                'properties' => 'color'
            )
        )
    ),

    array(
        'id'         => 'content-pagination-background-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'   => __( 'Normal Color', 'yit' ),
            'hover'    => __( 'Hover Color', 'yit' ),
            'selected' => __( 'Selected Color', 'yit' )
        ),
        'name'       => __( 'Pagination Background Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the pagination links.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'   => '#ffffff',
                'hover'    => '#ffffff',
                'selected' => '#ffffff',
            )
        ),
        'style'      => array(
            'normal'   => array(
                'selectors'  => '.general-pagination a',
                'properties' => 'background-color'
            ),
            'hover'    => array(
                'selectors'  => '.general-pagination a:hover',
                'properties' => 'background-color'
            ),
            'selected' => array(
                'selectors'  => '.general-pagination a.selected',
                'properties' => 'background-color'
            )
        )
    ),

);

return array_merge(
    $options,
    ( function_exists( 'YIT_Testimonial' ) ) ? array(
        array(
            'type' => 'title',
            'name' => __( 'Testimonials', 'yit' ),
            'desc' => ''
        ),
        array(
            'id'              => 'testimonials-small-quote-font',
            'type'            => 'typography',
            'name'            => __( 'Testimonials small quote font', 'yit' ),
            'desc'            => __( 'the font type, size, text transform and align.', 'yit' ),
            'min'             => 1,
            'max'             => 80,
            'default_font_id' => 'typography-website-title',
            'std'             => array(
                'size'      => 16,
                'unit'      => 'px',
                'family'    => 'default',
                'style'     => 'bold',
                'align'     => 'left',
                'transform' => 'none',
                'color'     => '#ffffff'
            ),
            'style'           => array(
                'selectors'  => '.testimonial-wrapper .testimonial-smallquote',
                'properties' => 'font-size,
                                 font-family,
                                 font-weight,
                                 text-align,
                                 text-transform,
                                 color'
            )
        ),
        array(
            'id'         => 'small-quote-background',
            'type'       => 'colorpicker',
            'name'       => __( 'Testimonials small quote background color', 'yit' ),
            'desc'       => __( 'Select the background colore to use.', 'yit' ),
            'std'        => array(
                'color' =>'#7caf00'
            ),
            'style'      => array(

                    'selectors'  => '.testimonial-wrapper .testimonial-smallquote',
                    'properties' => 'background-color'

            ),
        ),
    ) : array()
);

