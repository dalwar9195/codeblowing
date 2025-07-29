<?php 
/**
 * Required functions and required files.
 *
 * @package Code Blowing
 * @version 1.0.0
*/
defined( 'ABSPATH' ) || exit;

require_once get_stylesheet_directory() . '/inc/supports.php';
require_once get_stylesheet_directory() . '/inc/scripts.php';
require_once get_stylesheet_directory() . '/hooks/theme-hooks.php';
require_once get_stylesheet_directory() . '/classes/class-customizer.php';
require_once get_stylesheet_directory() . '/inc/product-metabox.php';
require_once get_stylesheet_directory() . '/inc/custom-functions.php';
require_once get_stylesheet_directory() . '/inc/post-type-services.php';
require_once get_stylesheet_directory() . '/inc/customizer-options.php';
require_once get_stylesheet_directory() . '/widgets/about.php';
require_once get_stylesheet_directory() . '/elementor/init.php';

if( class_exists('WooCommerce') ){
    require_once get_stylesheet_directory() . '/hooks/wc-removed-hooks.php';
    require_once get_stylesheet_directory() . '/hooks/wc-added-hooks.php';
}