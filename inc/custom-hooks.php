<?php
/**
 * Custom hooks and functions
 *
 * @version 1.0.0
*/

defined( 'ABSPATH' ) || exit;

add_action('codeblowing_single_product_custom_meta', 'codeblowing_single_product_custom_meta_fields');
add_action('codeblowing_single_product_custom_metabox', 'codeblowing_single_product_custom_metabox_value');
add_action('codeblowing_single_related_product', 'codeblowing_woocommerce_output_related_products', 10);

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
?>
