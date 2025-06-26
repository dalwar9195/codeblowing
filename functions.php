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

if( class_exists('WooCommerce') ){
    add_filter('woocommerce_get_price_html', 'codeblowing_free_price_label', 100, 2);

    function codeblowing_free_price_label( $price, $product ) {
        if ($product->get_price() == 0) {
            return '<span class="woocommerce-Price-amount amount"><bdi>Free</bdi></span>';
        }
        return $price;
    }

    add_filter('woocommerce_add_to_cart_fragments', 'codeblowing_update_cart_count_fragment');

    function codeblowing_update_cart_count_fragment( $fragments ) {
        ob_start(); ?>
        <a class="mini-cart-icon" href="<?php echo wc_get_cart_url(); ?>" title="View your cart">
            <i class="fa-solid fa-cart-shopping"></i><span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </a>
        <?php
        $fragments['a.mini-cart-icon'] = ob_get_clean();
        return $fragments;
    }

    /**
     * Clears the WooCommerce cart if the `clear_cart=yes` parameter is present in the URL.
     */
    function codeblowing_handle_clear_cart() {
        if ( isset( $_GET['clear_cart'] ) && 'yes' === sanitize_text_field( $_GET['clear_cart'] ) ) {
            WC()->cart->empty_cart();

            wp_safe_redirect( wc_get_cart_url() );
            exit;
        }
    }
    add_action( 'template_redirect', 'codeblowing_handle_clear_cart' );

    add_filter( 'woocommerce_should_load_checkout_block', '__return_false' );
    add_filter( 'woocommerce_should_load_cart_block', '__return_false' );
    add_filter( 'woocommerce_should_load_checkout_block', '__return_false' );

    add_filter( 'woocommerce_checkout_fields', 'codeblowing_customize_checkout_fields_for_virtual_products' );

    function codeblowing_customize_checkout_fields_for_virtual_products( $fields ) {
        // Check if all cart items are virtual or downloadable
        $only_virtual = true;

        foreach ( WC()->cart->get_cart() as $cart_item ) {
            $product = $cart_item['data'];

            if ( ! $product->is_virtual() && ! $product->is_downloadable() ) {
                $only_virtual = false;
                break;
            }
        }

        if ( $only_virtual ) {
            // Remove or make optional billing fields
            unset( $fields['billing']['billing_address_1'] );
            unset( $fields['billing']['billing_address_2'] );
            unset( $fields['billing']['billing_city'] );
            unset( $fields['billing']['billing_postcode'] );
            unset( $fields['billing']['billing_country'] );
            unset( $fields['billing']['billing_state'] );

            // Example: make phone optional
            if ( isset( $fields['billing']['billing_phone'] ) ) {
                $fields['billing']['billing_phone']['required'] = false;
            }
        }

        foreach ( $fields['shipping'] as $key => $field ) {
            $fields['shipping'][$key]['input_class'][] = 'form-control';
        }

        foreach ( $fields['billing'] as $key => $field ) {
            $fields['billing'][$key]['input_class'][] = 'form-control';
        }

        $fields['order']['order_comments']['input_class'][] = 'form-control';

        return $fields;
    }

}