<?php 
/**
 * Required functions and required files.
 *
 * @package Code Blowing
 * @version 1.0.0
*/
defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'codeblowing_styles' );

function codeblowing_styles() {
    wp_enqueue_style( 'cb-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'cb-fontawesome', get_stylesheet_directory_uri() . '/assets/css/all.min.css' );
    wp_enqueue_style( 'cb-meanmenu', get_stylesheet_directory_uri() . '/assets/css/meanmenu.min.css' );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/css/theme.css' );
    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
}

add_action( 'login_enqueue_scripts', 'codeblowing_login_styles' );
function codeblowing_login_styles() {
    wp_enqueue_style( 'codeblowing-login', get_stylesheet_directory_uri() . '/assets/css/login-style.css', array(), null, 'all' );
}

add_action( 'wp_enqueue_scripts', 'codeblowing_scripts' );

function codeblowing_scripts(){
    wp_enqueue_script( 'cb-meanmenu', get_stylesheet_directory_uri() . '/assets/js/jquery.meanmenu.min.js', array('jquery'), '1.0.0', array( 'in_footer'   => true ) );
    wp_enqueue_script( 'cb-bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.0', array( 'in_footer'    => true ) );
    wp_enqueue_script( 'cb-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery', 'cb-meanmenu', 'cb-bootstrap' ), '1.0.0', array( 'in_footer' => true ) );
    wp_enqueue_script( 'cb-promo-banner', get_stylesheet_directory_uri() . '/assets/js/promo-banner.js', array( 'jquery' ), '1.0.0', array( 'in_footer' => true ) );
}

function codeblowing_admin_enqueue_scripts() {
    wp_enqueue_media();  // Ensures the media uploader scripts are loaded
    wp_enqueue_script( 'cb-admin-script', get_stylesheet_directory_uri() . '/assets/js/admin.js', array( 'jquery' ), '1.0.0', array( 'in_footer' => true ) );
}
add_action('admin_enqueue_scripts', 'codeblowing_admin_enqueue_scripts');
