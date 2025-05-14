<?php 
/**
 * Required functions and required files.
 *
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

require_once get_stylesheet_directory() . '/classes/class-customizer.php';
require_once get_stylesheet_directory() . '/inc/supports.php';
require_once get_stylesheet_directory() . '/inc/product-metabox.php';
require_once get_stylesheet_directory() . '/inc/excludes.php';
require_once get_stylesheet_directory() . '/inc/overrides.php';
require_once get_stylesheet_directory() . '/inc/custom-hooks.php';
require_once get_stylesheet_directory() . '/inc/custom-functions.php';
require_once get_stylesheet_directory() . '/inc/post-type-services.php';
require_once get_stylesheet_directory() . '/inc/customizer-options.php';
require_once get_stylesheet_directory() . '/widgets/about.php';
require_once get_stylesheet_directory() . '/elementor/init.php';

function codeblowing_handle_clear_cart() {
    if ( isset( $_GET['clear_cart'] ) && 'yes' === $_GET['clear_cart'] ) {
        WC()->cart->empty_cart();
        wp_safe_redirect( wc_get_cart_url() ); // Redirect to the cart page.
        exit;
    }
}