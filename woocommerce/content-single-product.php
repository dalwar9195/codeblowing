<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'row', $product ); ?>>
    <div class="col-lg-12">
        <div class="py-2 mb-2">
            <?php
            /**
             * Hook: codeblowing_woocommerce_before_single_product_summary.
             *
             * @hooked codeblowing_woocommerce_template_single_title - 10
             */
            do_action( 'codeblowing_woocommerce_before_single_product_summary' );
            ?>           
        </div>
    </div>
    <div class="col-xl-8">
        
        <div class="single-product-thumb position-relative mb-3">
            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action( 'woocommerce_before_single_product_summary' );
            ?>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="single-product-info">
                        <div class="identity text-secondary">
                            <?php echo '<strong>ID: </strong>CB00'. $product->get_id(); ?>
                        </div>
                        <div class="sales text-secondary">
                            <?php echo '<strong>Total Sale: </strong>'. $product->get_total_sales() . ' Sales'; ?>
                        </div>
                        <div class="create-date text-secondary">
                            <?php echo '<strong>Created: </strong>'. date('M j, Y', strtotime($product->post_date) ); ?>
                        </div>
                        <div class="updated-date text-secondary">
                            <?php echo '<strong>Updated: </strong>'. date('M j, Y', strtotime($product->post_modified) ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <?php
                /**
                 * Hook: woocommerce_after_single_product_summary.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20 -- Removed
                 */
                do_action( 'woocommerce_after_single_product_summary' );
                ?>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="summary entry-summary">
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked codeblowing_woocommerce_template_single_price - 5
                 * @hooked woocommerce_template_single_title - 5 -- Removed
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10  -- Removed
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action( 'woocommerce_single_product_summary' );
                ?>
                </div>
            </div>
        </div>
        <?php
        /**
         * Hook: codeblowing_single_product_custom_metabox.
         *
         */
        do_action( 'codeblowing_single_product_custom_metabox' );
        ?>
    </div>
    <div class="col-xl-12">
        
        <?php if( !is_null( do_action( 'codeblowing_single_related_product' ) )) : ?>
        <div class="card mt-3">
            <div class="card-body">
                <?php
                /**
                 * Hook: codeblowing_single_related_product.
                 *
                 * @hooked codeblowing_woocommerce_output_related_products - 10
                 */
                do_action( 'codeblowing_single_related_product' );
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>