<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Remove Unnecessary Code
function cs_remove_unnecessary_code_setup () {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    add_filter('the_generator', '__return_false');
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('set_comment_cookies', 'wp_set_comment_cookies');
    add_filter('jpeg_quality', create_function( '', 'return 85;' ) );
}
add_action('after_setup_theme', 'cs_remove_unnecessary_code_setup');

// Core Functions

function cs_embed_html( $html ) {
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'cs_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'cs_embed_html' );

if ( ! function_exists( 'show_less_login_info' ) ) {
    /**
     * Show less info to users on failed login for security.
     * (Will not let a valid username be known.)
     *
     * @return string
     */
    function show_less_login_info() {
        return '<strong>ERROR</strong>: Stop guessing!';
    }
} // endif function_exists( 'show_less_login_info' ).
add_filter( 'login_errors', 'show_less_login_info' );

// Allow Upload SVG
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// exclude theme scandir form optimize speed up
add_filter( 'theme_scandir_exclusions', 'ws_exclude_dir_scan', 10, 1 );
function ws_exclude_dir_scan( $exclusions ) {
  $exclusions[] = 'assets';
  $exclusions[] = 'inc';
  $exclusions[] = 'images';
  $exclusions[] = 'languages';
  $exclusions[] = 'css';
  $exclusions[] = 'js';

  return $exclusions;
}

/**
 * Auto Add Alt to images from iamge title
*/

add_filter('wp_get_attachment_image_attributes', 'auto_add_alt_to_image_from_image_title', 99, 2);
function auto_add_alt_to_image_from_image_title($arr1, $arr2) {

    if( empty($arr1['alt']) ) {
        $arr1['alt'] = $arr2->post_title;
    }

    return $arr1;
}

?>
