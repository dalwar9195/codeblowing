<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<table class="table table-white mb-0">
    <tr class="d-flex justify-content-between align-items-center">
        <td>
            <div class="title">
                <h4 class="m-0 fs-6 text-dark fw-bold">Price:</h4>
            </div>
        </td>
        <td>
            <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price d-flex justify-content-between align-items-center' ) ); ?>">
                <div class="price-text"><?php echo $product->get_price_html(); ?></div>
            </div>
        </td>
    </tr>
</table>
