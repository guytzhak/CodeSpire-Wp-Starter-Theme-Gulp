<?php
/**
 * Inspired by Simon Bradburys cleanup.php fromb4st theme https://github.com/SimonPadbury/b4st
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! function_exists( 'no_generator' ) ) {
	/**
	 * Removes the generator tag with WP version numbers. Hackers will use this to find weak and old WP installs
	 *
	 * @return string
	 */
	function no_generator() {
		return '';
	}
} // endif function_exists( 'no_generator' ).
add_filter( 'the_generator', 'no_generator' );
/*
Clean up wp_head() from unused or unsecure stuff
*/
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10);
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
function remove_api() {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11 );
}
add_action( 'after_setup_theme', 'remove_api' );


// Disalbe access to author page
add_action('template_redirect', 'cs_disable_author_page');

function cs_disable_author_page() {
	global $wp_query;
	
	if ( is_author() ) {
		/* @var \WP_Query $wp_query */
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
		//wp_redirect(home_url('404'));
		//locate_template( '404', 1, 1 );
	}
}
