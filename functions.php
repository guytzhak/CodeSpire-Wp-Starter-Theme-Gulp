<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

Class CodeSpire_FrameWork {
    
    public function __construct() {
        
        $this->create_acf_support();

        add_action( 'after_setup_theme', array($this, 'cs_theme_setup') );
        add_action( 'wp_enqueue_scripts', array($this, 'cs_style_and_scripts'));
        add_action( 'enqueue_block_editor_assets', array($this, 'cs_admin_style_and_scripts'));
        add_action( 'init', array($this, 'cs_menus') );
	    add_filter( 'wpcf7_autop_or_not', '__return_false' );
        $this->helper();
        define('ACF_EARLY_ACCESS', '5');
    
        add_action( 'upload_mimes', array($this, 'add_file_types_to_uploads') );
    
        add_filter( 'block_editor_settings' , [$this, 'remove_guten_wrapper_styles'] );
        
    }
    
    public function remove_guten_wrapper_styles( $settings ) {
        unset($settings['styles'][0]);
        unset($settings['styles'][1]);
        
        return $settings;
    }
    
    public function add_file_types_to_uploads( $file_types ) {
        $new_filetypes = array();
        $new_filetypes['svg'] = 'image/svg+xml';
        $file_types = array_merge( $file_types, $new_filetypes );
        return $file_types;
    }
    
    public function create_acf_support() {
        if( function_exists('acf_add_options_page') ) {

            acf_add_options_page(array(
                'page_title' 	=> 'Theme General Settings',
                'menu_title'	=> 'Theme Settings',
                'menu_slug' 	=> 'theme-general-settings',
                'capability'	=> 'edit_posts',
                'redirect'		=> false
            ));

        }
    }

    /**
     * Setup Theme Functions
     */
    public function cs_theme_setup() {
        
        load_theme_textdomain( 'cs', get_template_directory() . '/languages' );
        
        add_theme_support('post-thumbnails');
        add_theme_support( 'title-tag' );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );
        add_theme_support( 'align-wide' );

    }

    /** Call to JS & CSS **/
    function cs_style_and_scripts() {

        //wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() .'/assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'main-css', get_stylesheet_uri() );
        
        //wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.1.0', true );
        wp_enqueue_script( 'csFramework', get_stylesheet_directory_uri() . '/assets/js/csFramework.js', array(''), '1.0.0', true );
        wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('csFramework'), '1.0.0', true );

    }
    
    function cs_admin_style_and_scripts() {
        wp_enqueue_style( 'editor-admin-css', get_stylesheet_directory_uri() .'/editor-styles.css' );
    }


    // Register Navigation Menus
    public function cs_menus() {
        $locations = array(
            'main_menu' => __( 'Main Menu', 'cs' ),
            'footer_menu' => __( 'Footer Menu', 'cs' ),
        );
        register_nav_menus( $locations );
    }
    
    public function helper(){

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        // check for plugin using plugin name
        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            include_once('inc/woo_func.php');
        }
        
        /* Classes */
        require get_template_directory() . '/classes/class-codespire-transients.php';
        // Custom page walker.
        require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';
        
        /* Includes */
        require get_template_directory() . '/inc/template-tags.php';
        require get_template_directory() . '/inc/blocks.php';
        
        require 'inc/wp_bootstrap_navwalker.php';
        include_once('inc/core_func.php');
        include_once('inc/security.php');
    }
    
}
// Install Theme
$theme = new CodeSpire_FrameWork();

?>
