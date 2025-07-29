<?php
/**
 * Woocommerce hooks and functions
 *
 * @package Code Blowing
 * @version 1.0.0
*/

defined( 'ABSPATH' ) || exit;

// Actions
add_action('codeblowing_single_product_custom_meta', 'codeblowing_single_product_custom_meta_fields');
add_action('codeblowing_single_product_custom_metabox', 'codeblowing_single_product_custom_metabox_value');
add_action('codeblowing_single_related_product', 'codeblowing_woocommerce_output_related_products', 10);
add_action( 'template_redirect', 'codeblowing_handle_clear_cart' );
add_action('woocommerce_shop_loop_item_title', 'codeblowing_woocommerce_template_loop_product_title', 10);
add_action( 'codeblowing_shop_loop_item_bottom_content', 'codeblowing_woocommerce_template_loop_rating', 10 );
add_action('woocommerce_before_main_content', 'codeblowing_woocommerce_output_all_notices', 40);
add_action('woocommerce_before_shop_loop', 'codeblowing_woocommerce_archive_page_title', 20);
add_action('codeblowing_woocommerce_before_single_product_summary', 'codeblowing_woocommerce_template_single_title', 10);
add_action('woocommerce_single_product_summary', 'codeblowing_woocommerce_template_single_price', 5);

// Filters
add_filter('woocommerce_get_price_html', 'codeblowing_free_price_label', 100, 2);
add_filter('woocommerce_add_to_cart_fragments', 'codeblowing_update_cart_count_fragment');
add_filter( 'woocommerce_should_load_checkout_block', '__return_false' );
add_filter( 'woocommerce_should_load_cart_block', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );
add_filter( 'woocommerce_should_load_checkout_block', '__return_false' );
add_filter( 'woocommerce_checkout_fields', 'codeblowing_customize_checkout_fields_for_virtual_products' );
add_filter('woocommerce_is_sold_individually', 'codeblowing_hide_quantity_input_for_downloadable_products', 10, 2);
add_filter('woocommerce_cart_product_cannot_add_another_message', 'codeblowing_downloadable_product_error_message', 10, 2);
add_filter('the_title', 'codeblowing_cart_page_title', 10, 2);

// Hooked Functions
if ( ! function_exists( 'codeblowing_woocommerce_output_related_products' ) ) {

	/**
	 * Output the related products.
	 */
	function codeblowing_woocommerce_output_related_products() {

		$args = array(
			'posts_per_page' => 4,
			'columns'        => 4,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
		);

		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
	}
}

function codeblowing_single_product_custom_metabox_value() {
    global $product;

    if ( ! $product instanceof WC_Product ) {
        return;
    }

    $meta_fields = [
        'product_version'     => '_cb_product_version',
        'product_type'        => '_product_type',
        'high_resolution'     => '_high_resolution',
        'image_included'      => '_image_included',
        'compatible_browsers' => '_compatible_browsers',
        'frontend_framework'  => '_frontend_framework',
        'files_included'      => '_files_included',
        'wordpress_version'   => '_wordpress_version',
    ];

    $meta_values = [];

    foreach ( $meta_fields as $key => $meta_key ) {
        $meta_values[ $key ] = get_post_meta( $product->get_id(), $meta_key, true );
    }

    // Check if any of the meta fields are not empty
    if ( ! array_filter( $meta_values ) ) {
        return;
    }

    ?>
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-white product-single-meta mb-0">
                <?php if ( ! empty( $meta_values['product_type'] ) ) : ?>
                    <?php codeblowing_output_meta_row( 'Product Type', $meta_values['product_type'] ); ?>
                <?php endif; ?>

                <?php if ( ! empty( $meta_values['product_version'] ) ) : ?>
                    <?php codeblowing_output_meta_row( 'Product Version', $meta_values['product_version'] ); ?>
                <?php endif; ?>

                <?php if ( ! empty( $meta_values['high_resolution'] ) ) : ?>
                    <?php codeblowing_output_meta_row( 'High Resolution', $meta_values['high_resolution'] ); ?>
                <?php endif; ?>

                <?php if ( ! empty( $meta_values['compatible_browsers'] ) && is_array( $meta_values['compatible_browsers'] ) ) : ?>
                    <?php codeblowing_output_meta_row( 'Compatible Browsers', implode( ', ', $meta_values['compatible_browsers'] ) ); ?>
                <?php endif; ?>

                <?php if ( ! empty( $meta_values['frontend_framework'] ) && is_array( $meta_values['frontend_framework'] ) ) : ?>
                    <?php codeblowing_output_meta_row( 'Frontend Framework', implode( ', ', $meta_values['frontend_framework'] ) ); ?>
                <?php endif; ?>

                <?php if ( ! empty( $meta_values['wordpress_version'] ) && is_array( $meta_values['wordpress_version'] ) ) : ?>
                    <?php codeblowing_output_meta_row( 'WordPress Version', implode( ', ', $meta_values['wordpress_version'] ) ); ?>
                <?php endif; ?>

                <?php if ( ! empty( $meta_values['image_included'] ) ) : ?>
                    <?php codeblowing_output_meta_row( 'Image Included', $meta_values['image_included'] ); ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
    <?php
}

/**
 * Outputs a table row for a product meta field.
 *
 * @param string $label
 * @param string $value
 */
function codeblowing_output_meta_row( $label, $value ) {
    ?>
    <tr>
        <td>
            <div class="title">
                <h4 class="m-0 fs-6 text-dark fw-bold"><?php echo esc_html( $label ); ?>:</h4>
            </div>
        </td>
        <td>
            <div class="text-capitalize text-secondary"><?php echo esc_html( $value ); ?></div>
        </td>
    </tr>
    <?php
}

function codeblowing_free_price_label( $price, $product ) {
    if ($product->get_price() == 0) {
        return '<span class="woocommerce-Price-amount amount"><bdi>Free</bdi></span>';
    }
    return $price;
}

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
