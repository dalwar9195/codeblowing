<?php 
/**
 * Removed woocommerce actions and filters
 *
 * @version 1.0.0
*/

defined( 'ABSPATH' ) || exit;

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close');
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_filter( 'use_widgets_block_editor', '__return_false' );