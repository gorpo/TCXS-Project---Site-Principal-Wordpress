=== Recent Posts FlexSlider ===
Contributors: wolfpaw
Donate link: https://davidwolfpaw.com/
Tags: slider, responsive
Requires at least: 3.1
Tested up to: 5.3.2
Stable tag: 2.2.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

Simple setup responsive slider of recent posts selected by category or post type using FlexSlider by WooThemes.

== Description ==

This slider uses the FlexSlider framework by [WooThemes](http://www.woothemes.com/flexslider/). Recent posts are displayed as a responsive slider. Posts can be selected by category or by post type if your theme uses custom post types.

The slider exists only as a widget, no settings page required. Visit Appearance > Widgets in your site dashboard, and place the Recent Posts Flexslider widget in your sidebar of choice.

= Options that can be set: =
* Title
* Category
* Post Type
* Image Size
* Slide Pause
* Slider Height
* Slide Duration
* Number of Slides
* Slider Animation Style
* Show or Hide Post Link
* Show or Hide Post Title
* Show or Hide Slide Controls
* Show or Hide Navigation Arrows
* Show or Hide Post Excerpt & Length
* Only Show Posts With Featured Image

= Tested on the most popular WordPress themes for compatibility, including: =
* Astra
* Escapade
* Genesis
* Hestia
* OceanWP
* Primer
* Total
* Zerif
* Twenty Ten
* Twenty Eleven
* Twenty Twelve
* Twenty Thirteen
* Twenty Fourteen
* Twenty Fifteen
* Twenty Sixteen
* Twenty Seventeen
* Twenty Nineteen
* Twenty Twenty

== Installation ==

1. Upload the files to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `Recent Post Flexslider` onto a sidebar on the Appearance->Widgets page

== Frequently Asked Questions ==

= Can I use both categories and post type to select posts? =

No. If a custom post type is used, categories must be set to "All Categories".

= Can I use custom taxonomies? =

Currently the plugin allows the selection of a category of posts or a custom post type only.


== Changelog ==

= 2.2.0 - 25 January 2020 =
* Adds only featured image selection, props @mociofiletto

= 2.1.3 - 19 January 2020 =
* Updates compatibility to WordPress v5.3.2
* Fixes image size selection issue, props @mociofiletto

= 2.1.2 - 21 February 2019 =
* Updates compatibility to WordPress v5.1.0
* Fixes stylesheet enqueue, props @butleraj

= 2.1.1 - 14 February 2019 =
* Updates styles to remove unused code, style fixes after testing in multiple top download WordPress themes, and organizes+minifies styles
* Adds version to stylesheet to fix cache issues
* Updates POT translation file


= 2.1.0 - 26 January 2019 =
* Tested up to WordPress v5.0.3
* Updates layout of widget options
* Displays post type label instead of name
* Validates options on save and load
* Adds option to show or hide slide navigation
* Adds option to show or hide slide controls
* Style fixes to slider

= 2.0.0 - 19 August 2018 =
* Tested up to WordPress v4.9.8
* Updates to Flexslider v2.7.1
* Removes create_function for PHP v7.0+ compatibility
* Updates layout of widget options
* Style of slider is imporved for image positioning and caption heights
* Updates translation file

= 1.6.3 - 10 March 2017 =
* Tested up to WordPress v4.7.3
* Fixed widget title to use `widget_title` filter

= 1.6.2 - 13 December 2016 =
* Tested up to WordPress v4.7
* Updated default animation time
* Cleaned display of code

= 1.6.1 - 13 January 2015 =
* Fixed bug on slide height when using fade animation

= 1.6 - 5 January 2015 =
* Added ability to select image display size
* Updated caption CSS

= 1.5 - 13 January 2014 =
* Updated to Flexslider v2.2.2
* Fixed image positioning
* Added ability to toggle post links on/off
* Added functionality to allow multiple sliders on one page
* Changed from get_the_excerpt() to get_the_content and stripped tags to allow longer excerpt captions than set by theme

= 1.4 - 2 October 2013 =
* Added Slider Animation Style
* Updated dropdowns to select() function

= 1.3 =
* Updated WP_Query
* Sticky Posts now ignored in slider
* Sizing bug for single slide fixed
* Margin removed for single slide
* Image vertically aligned in slide

= 1.2 =
* Reupload of core files

= 1.1 =
* CSS Optimization
* Dynamically load scripts and stylesheet only on views that include widget
* Load scripts in footer

= 1.0 =
* First Version
