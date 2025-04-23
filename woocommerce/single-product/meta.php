<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
    <table class="table table-white">
        <?php if( count( $product->get_category_ids() ) > 0 ) : ?>
        <tr>
            <td>
                <div class="title">
                    <h4 class="m-0 fs-6 text-dark fw-bold">Categories:</h4>
                </div>
            </td>
            <td>
                <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>
            </td>
        </tr>
        <?php endif; ?>

        <?php if( count( $product->get_tag_ids() ) > 0 ) : ?>
        <tr>
            <td>
                <div class="title">
                    <h4 class="m-0 fs-6 text-dark fw-bold">Tags:</h4>
                </div>
            </td>
            <td>
            <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as">' . _n( '', '', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>
            </td>
        </tr>
        <?php endif; ?>
    </table>
	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
