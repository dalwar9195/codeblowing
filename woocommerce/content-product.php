<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
$column = '';
switch ( wc_get_loop_prop( 'columns' ) ) {
    case '3':
        $column = 'col-lg-4 col-md-6';
        break;
    case '2':
        $column = 'col-lg-6 col-md-6';
        break;
    case '1':
        $column = 'col-lg-6 col-md-6';
        break;
    default:
        $column = 'col-lg-4 col-md-6';
        break;
}
?>
<div class="<?php echo $column; ?>">
    <div <?php wc_product_class( 'product-item type3 mb-3 ', $product ); ?>>
        <div class="thumb">
            <a class="d-block" href="<?php the_permalink(); ?>">
            <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
            </a>
        </div>
        <div class="content p-3">
            <div class="title">
            <?php
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title' );
            ?>
            </div>

            <div class="info d-flex justify-content-between mt-3 mb-2">
                <span class="border rounded ps-2 pe-2 text-secondary fw-semibold font-sm">
                    <?php
                        $categories = wp_get_post_terms($product->get_id(), 'product_cat');

                        if (!empty($categories) && !is_wp_error($categories)) {
                            // Get the first category (or apply your logic for primary category)
                            $primary_category = $categories[0];
                            printf('<small><a href="%s">%s</a></small>', get_term_link( $primary_category->term_id ), $primary_category->name);
                        } else {
                            echo '<small>' . 'No Category' . '</small>';
                        }
                    ?>
                </span>
                <div class="d-flex align-items-center">
                    <?php
                        /**
                         * Hook: woocommerce_after_shop_loop_item_title.
                         *
                         * @hooked woocommerce_template_loop_rating - 5 - Removed
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                    ?>
                </div>
            </div>
            <div class="bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="d-inline-block me-3 mb-3 text-secondary"><?php echo $product->get_total_sales(); ?> Sales</span>
                    
                    <?php 
                        /**
                         * Hook: codeblowing_shop_loop_item_bottom_content.
                         *
                         * @hooked codeblowing_woocommerce_template_loop_rating - 10
                         */
                        do_action('codeblowing_shop_loop_item_bottom_content');
                    ?>
                </div>

                <?php
                    /**
                     * Hook: woocommerce_after_shop_loop_item.
                     *
                     * @hooked woocommerce_template_loop_product_link_close - 5- Removed
                     * @hooked woocommerce_template_loop_add_to_cart - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item' );
                ?>        
            </div>
        </div>
    </div>
</div>