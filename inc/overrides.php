<?php 
/**
 * Override woocommerce actions and filters
 *
 * @version 1.0.0
*/

defined( 'ABSPATH' ) || exit;

// Overrided Actions
add_action('woocommerce_shop_loop_item_title', 'codeblowing_woocommerce_template_loop_product_title', 10);
add_action( 'codeblowing_shop_loop_item_bottom_content', 'codeblowing_woocommerce_template_loop_rating', 10 );
add_action('woocommerce_before_main_content', 'codeblowing_woocommerce_output_all_notices', 40);
add_action('woocommerce_before_shop_loop', 'codeblowing_woocommerce_archive_page_title', 20);
add_action('codeblowing_woocommerce_before_single_product_summary', 'codeblowing_woocommerce_template_single_title', 10);
add_action('woocommerce_single_product_summary', 'codeblowing_woocommerce_template_single_price', 5);

// Overrided Filters
add_filter('woocommerce_is_sold_individually', 'codeblowing_hide_quantity_input_for_downloadable_products', 10, 2);
add_filter('woocommerce_cart_product_cannot_add_another_message', 'codeblowing_downloadable_product_error_message', 10, 2);
add_filter('the_title', 'codeblowing_cart_page_title', 10, 2);

if ( ! function_exists( 'codeblowing_woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function codeblowing_woocommerce_template_loop_product_title() {
		echo '<h4 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="'. get_the_permalink() . '">' . get_the_title() . '</a></h4>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'codeblowing_woocommerce_template_loop_rating' ) ) {

	/**
	 * Display the average rating in the loop.
	 */
	function codeblowing_woocommerce_template_loop_rating() {
		wc_get_template( 'loop/rating.php' );
	}
}

function codeblowing_woocommerce_output_all_notices() {
	echo '<div class="woocommerce-notices-wrapper">';
	wc_print_notices();
	echo '</div>';
}

function codeblowing_woocommerce_archive_page_title() {
    if( is_product_category() ){
        $category = get_queried_object();
        printf('<div class="page_title"><span>%s</span><h4 class="m-0 text-dark fw-bold">%s</h4></div>', 'Category:', $category->name);
    }
    if( is_shop() ){
        printf('<div class="page_title"><span>%s</span><h4 class="m-0 text-dark fw-bold">%s</h4><p class="text-secondary mb-0">%s</p></div>', '', 'All Products', 'Collect Your Desired Products');
    }
    
    if( is_cart() ){
        printf('<div class="page_title"><span>%s</span><h4 class="m-0 text-dark fw-bold">%s</h4><p class="text-secondary mb-0">%s</p></div>', '', 'All Products', 'Collect Your Desired Products');
    }
    
}

if ( ! function_exists( 'codeblowing_woocommerce_template_single_title' ) ) {

	/**
	 * Output the product title.
	 */
	function codeblowing_woocommerce_template_single_title() {
		wc_get_template( 'single-product/title.php' );
	}
}

function codeblowing_hide_quantity_input_for_downloadable_products($sold_individually, $product) {
    if ($product->is_downloadable()) {
        return true; // Set as "sold individually"
    }
    return $sold_individually;
}

function codeblowing_downloadable_product_error_message($message, $product) {
    if ($product->is_downloadable()) {
        return __('<strong>'. $product->name . '</strong>' .' already added your cart.', 'codeblowing'); // Custom message
    }
    return $message;
}

if ( ! function_exists( 'codeblowing_woocommerce_template_single_price' ) ) {

	/**
	 * Output the product price.
	 */
	function codeblowing_woocommerce_template_single_price() {
		wc_get_template( 'single-product/price.php' );
	}
}

function codeblowing_cart_page_title($title, $id) {
    if (is_cart() && get_the_ID() === $id) {
        $title = '<h4 class="fw-bold fs-3 text-dark">Shoping Cart</h4>';
    }
    return $title;
}
